<?php

namespace Modules\Inotification\Models;

use Imagina\Icore\Models\CoreModel;

class NotificationType extends CoreModel
{

    protected $table = 'inotification__notification_types';
    public string $transformer = 'Modules\Inotification\Transformers\NotificationTypeTransformer';
    public string $repository = 'Modules\Inotification\Repositories\NotificationTypeRepository';
    public array $requestValidation = [
        'create' => 'Modules\Inotification\Http\Requests\CreateNotificationTypeRequest',
        'update' => 'Modules\Inotification\Http\Requests\UpdateNotificationTypeRequest',
    ];
    //Instance external/internal events to dispatch with extraData
    public array $dispatchesEventsWithBindings = [
        //eg. ['path' => 'path/module/event', 'extraData' => [/*...optional*/]]
        'created' => [],
        'creating' => [],
        'updated' => [],
        'updating' => [],
        'deleting' => [],
        'deleted' => []
    ];

    protected $fillable = [
        'title',
        'system_name',
    ];
}
