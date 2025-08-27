<?php

namespace Modules\Inotification\Events\Handlers;

use Modules\Inotification\Services\NotificationDispatcherService;

class ProcessToNotification
{

    public function handle($event): void
    {
        // All params Event
        $params = $event->params;

        // Get specific data
        $dataFromRequest = $params['data'];
        $model = $params['model'];
        $extraData = $params['extraData'];

        //Validation Method in Model
        if (method_exists($model, 'getNotificableParams')) {
            $notificableParams = $model->getNotificableParams();
            if (isset($extraData['event'])) {
                //Get params notification from Model
                $paramsNotification = $notificableParams[$extraData['event']];
                //Execute Notification Dispatcher
                app(NotificationDispatcherService::class)->execute($paramsNotification);
            }
        } else {
            throw new \Exception("Not Exist Method [getNotificableParams] in the model: " . get_class($model));
        }
    }
}
