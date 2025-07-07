<?php

namespace Modules\Inotification\Services;

use Modules\Inotification\Services\NotificationManagerService;

class NotificationDispatcherService
{

    private $log = "Inotification:: Services|NotificationDispatcherService|";


    /**
     * Fix Params and execute the notifcations
     */
    public function execute($params)
    {
        \Log::info($this->log . 'execute');

        try {

            //Default
            $title = isset($params['title']) ? $params['title'] : itrans("inotification::notification.email.default.title");
            $message = isset($params['message']) ? $params['message'] : itrans("inotification::notification.email.default.message");

            //Destinations
            if (isset($params['email'])) $to['email'] = $params['email'];
            else throw new \Exception("Email Required", 500);
            if (isset($params['broadcast'])) $to['broadcast'] = $params['broadcast'];

            //Set Base Params
            $push = [
                "title" => $title,
                "message" => $message,
                "setting" => ["saveInDatabase" => 1],
            ];

            //Optional
            if (isset($params['link'])) $push['link'] = $params['link'];
            if (isset($params['userId'])) $push['user_id'] = $params['userId'];
            if (isset($params['source'])) $push['source'] = $params['source'];

            //Custom Layout
            if (isset($params['content'])) $push['content'] = $params['content'];
            if (isset($params['layout'])) $push['layout'] = $params['layout'];

            //Extras
            if (isset($params['extraParams'])) $push['extraParams'] = $params['extraParams'];

            //Send Notification
            app(NotificationManagerService::class)->to($to)->push($push);
        } catch (\Exception $e) {
            \Log::error($this->log . 'Message: ' . $e->getMessage() . ' | FILE: ' . $e->getFile() . ' | LINE: ' . $e->getLine());
        }
    }
}
