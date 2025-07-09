<?php

namespace Modules\Inotification\Models;

use Imagina\Icore\Models\CoreModel;

class Device extends CoreModel
{


    protected $table = 'inotification__devices';
    public string $transformer = 'Modules\Inotification\Transformers\DeviceTransformer';
    public string $repository = 'Modules\Inotification\Repositories\DeviceRepository';
    public array $requestValidation = [
        'create' => 'Modules\Inotification\Http\Requests\CreateDeviceRequest',
        'update' => 'Modules\Inotification\Http\Requests\UpdateDeviceRequest',
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
        "user_id",
        "device",
        "token",
        "provider_id"
    ];
}
