<?php

namespace Modules\Inotification\Services;

use Modules\Inotification\Mail\NotificationMailable;
use Illuminate\Support\Facades\Mail;
use Validator;

use Modules\Inotification\Repositories\NotificationRepository;
use Modules\Inotification\Repositories\ProviderRepository;

class NotificationManagerService
{

    private $notificationRepository;
    private $notification;
    private $recipient;
    private $type;
    private $provider;
    private $providerConfig;
    private $providerRepository;
    private $savedInDatabase;
    private $entity;
    private $setting;
    private $data;
    private $log = "Inotification:: Services|NotificationManagerService|";


    public function __construct(
        NotificationRepository $notificationRepository,
        ProviderRepository     $providerRepository,
    ) {
        $this->notificationRepository = $notificationRepository;
        $this->providerRepository = $providerRepository;
    }

    /**
     * Push a notification on the dashboard
     * @param string $title
     * @param string $message
     * @param string $icon
     * @param string|null $link
     */
    public function push($params = [])
    {
        \Log::info($this->log . 'Push');

        //Set Data from Params
        $this->entity = $params["entity"] ?? null;
        $this->setting = $params["setting"] ?? null;
        if (is_array($this->setting)) $this->setting = json_decode(json_encode($this->setting));
        $this->data = $params["data"] ?? $params ?? null;

        // if provider its not defined
        if (!isset($this->provider->id)) {
            // if the type of notification it's defined
            if ($this->type) {
                // the type of notification may be an array of strings for multiples notifications
                if (!is_array($this->type)) $this->type = [$this->type];

                foreach ($this->type as $type) {
                    $this->provider = $this->providerRepository->getItem($type, (object)["include" => [], "filter" => (object)["field" => "type", "default" => 1]]);
                    if (isset($this->provider->id) && $this->provider->status) {
                        $this->send();
                    }
                }
            } else {
                // if the provider and type is not defined, the $recipient can defined the type for notification
                // like ["push" => $user->id,"email" => $user->email]
                if (is_array($this->recipient)) {
                    $typeRecipients = $this->recipient;
                    foreach ($typeRecipients as $type => $recipients) {
                        $this->type = $type;
                        //Search Default Provider
                        $this->provider = $this->providerRepository->getItem($type, (object)["include" => [], "filter" => (object)["field" => "type", "default" => 1]]);
                        //Provider Exists
                        if (isset($this->provider->id) && $this->provider->status) {
                            //Validations Recipients to array
                            if (!is_array($recipients)) $recipients = [$recipients];
                            //Process To Send
                            foreach ($recipients as $recipient) {
                                $this->recipient = $recipient;
                                $this->send();
                            }
                        }
                    }
                }
            }
        } else {
            //Provider Defined - Check Status
            if ($this->provider->status) {
                $this->send();
            }
        }
    }

    /**
     * Set a user id to set the notification to
     * @param int $recipient
     * @return $this
     */
    public function to($recipient)
    {
        if (isset($recipient['email']) && !empty($recipient['email'])) {
            $emails = is_array($recipient['email']) ? $recipient['email'] : [$recipient['email']];
            $excludedEmails = config('iuser.emailsExcludedNotification', []);

            // Asegura que $excludedEmails sea un array
            if (!is_array($excludedEmails)) {
                $excludedEmails = [$excludedEmails];
            }

            $recipient['email'] = array_values(array_diff($emails, $excludedEmails));
        }
        $this->recipient = $recipient;

        return $this;
    }

    /**
     * Optional - Define Provider
     */
    public function provider($provider)
    {
        if (is_string($provider))
            $this->provider = $this->providerRepository->getItem($provider, (object)["include" => [], "filter" => (object)["field" => "system_name", "default" => 1]]);
        else
            $this->provider = $provider;

        return $this;
    }

    /**
     * Optional - Define type
     */
    public function type($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Valid the Recipient and Send the Notification
     */
    private function send()
    {
        \Log::info($this->log . 'Send');

        //validating $recipient with rules defined in the config of the provider
        $valid = $this->validateRecipient($this->recipient);

        if ($valid) {
            //configuring global laravel config with data in database
            $this->loadConfigFromDatabase();

            $this->savedInDatabase = false;
            //if provider is configured for save in database
            if (isset($this->provider->fields->saveInDatabase) && $this->provider->fields->saveInDatabase) {
                //if setting is configured for save in database (Setting from global params)
                if (isset($this->setting->saveInDatabase) && $this->setting->saveInDatabase) {
                    $this->createNotificationInDB();
                    $this->savedInDatabase = true;
                }
            }

            if (method_exists($this, $this->provider->system_name)) {
                \Log::info($this->log . "Send|Notification to: {$this->recipient}, provider: {$this->provider->system_name}, saveInDatabase: " . ($this->savedInDatabase ? 'YES' : 'NO'));

                $this->{$this->provider->system_name}();
            }
        }
    }

    /**
     * validating recipient with laravel request rules
     * @param $recipient
     * @param $providerConfig
     * @return bool
     */
    private function validateRecipient($recipient)
    {

        $providersConfig = collect(config("inotification.providers"));
        $providersConfig = $providersConfig->keyBy("systemName");
        $this->providerConfig = $providersConfig[$this->provider->system_name];

        $valid = true;
        if (isset($this->providerConfig["rules"])) {
            $result = Validator::make(["recipient" => $recipient], ["recipient" => $this->providerConfig["rules"]]);
            if ($result->fails()) {
                //$errors = $result->errors(); dd($errors);
                $valid = false;
            }
        }

        //\Log::info($this->log.'validateRecipient: '.$valid);

        return $valid;
    }

    /**
     * Get configurations from Database
     */
    private function loadConfigFromDatabase()
    {
        foreach ($this->providerConfig["fields"] as $field) {
            if (isset($field["configRoute"])) {
                config([$field["configRoute"] => $this->provider->fields->{$field["name"]}]);
            }
        }
    }

    /**
     * Case to Save in database
     */
    private function createNotificationInDB()
    {

        $dataToSave = [
            'recipient' => $this->recipient ?? \Auth::id(),
            'icon_class' => $this->data["icon"] ?? '',
            'type' => $this->provider->type ?? $this->type ?? '',
            'provider' => $this->provider->system_name ?? '',
            'link' => $this->data["link"] ?? null,
            'title' => $this->data["title"] ?? '',
            'message' => $this->data["message"] ?? '',
            'options' => $this->data["options"] ?? '',
            'is_action' => $this->data["isAction"] ?? false,
            'user_id' => $this->data['user_id'] ?? null,
            'source' => $this->data['source'] ?? null
        ];

        //Validation Media
        if (isset($this->data['medias_single'])) $dataToSave['medias_single'] = $this->data['medias_single'];

        //Save Notification
        $this->notification = $this->notificationRepository->create($dataToSave);
    }

    /**
     * PROVIDER: EMAIL
     */
    private function email()
    {
        \Log::info($this->log . 'Email-Provider');
        try {

            //Add entity data to email
            $this->data['notification'] = $this->notification;

            // subject like notification title
            $subject = $this->data["title"] ?? '';

            //default notification view
            $defaultContent = setting('inotification::contentEmail');

            //validating view from event data
            $view = $this->data["view"] ?? $defaultContent;

            //Mailable
            $mailable = new NotificationMailable(
                $this->data,
                $subject,
                (view()->exists($view) ? $view : $defaultContent),
                $this->data["fromAddress"] ?? $this->provider->fields->fromAddress ?? null,
                $this->data["fromName"] ?? $this->provider->fields->fromName ?? null,
                $this->data["replyTo"] ?? []
            );

            //Send
            Mail::to($this->recipient)->send($mailable);

            \Log::info($this->log . 'Email-Provider|Succesfully');
        } catch (\Exception $e) {
            \Log::error($this->log . "ERROR|:" . $e->getMessage() . "\n" . $e->getFile() . "\n" . $e->getLine() . $e->getTraceAsString());
        }
    }
}
