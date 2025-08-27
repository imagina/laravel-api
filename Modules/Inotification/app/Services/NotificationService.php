<?php

namespace Modules\Inotification\Services;

use Illuminate\Http\Response;
use Modules\Inotification\Services\NotificationDispatcherService;

class NotificationService
{

    /**
     * get Data Example to test notification layout (email)
     * @param mixed $request
     */
    public function getDataExample(mixed $request): mixed
    {
        $to = $request->query('email');
        $config = $request->query('config');

        //Validation Data from Config
        if ($config) {
            $dataFromConfig = config($config);
            if (isset($dataFromConfig['extraParams'])) {
                foreach ($dataFromConfig['extraParams'] as $key => $value) {
                    $resolvedParams[$key] = is_callable($value) ? $value() : $value;
                }
                $dataFromConfig['extraParams'] = $resolvedParams;
            }
        }

        $dataDefault = [
            'title' => itrans("inotification::notification.email.default.title"),
            'message' => itrans("inotification::notification.email.default.message")
        ];

        if (isset($dataFromConfig))
            $data = array_merge($dataDefault, $dataFromConfig);

        //Validation to Send Email
        if ($to) {
            //Validation Email
            if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
                return response()->json(['error' => 'Invalid Email'], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            app(NotificationDispatcherService::class)->execute(['email' => $to]);
        }

        return $data ?? $dataDefault;
    }
}
