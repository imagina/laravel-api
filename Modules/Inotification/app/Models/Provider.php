<?php

namespace Modules\Inotification\Models;

use Imagina\Icore\Models\CoreModel;

class Provider extends CoreModel
{

    protected $table = 'inotification__providers';
    public string $transformer = 'Modules\Inotification\Transformers\ProviderTransformer';
    public string $repository = 'Modules\Inotification\Repositories\ProviderRepository';
    public array $requestValidation = [
        'create' => 'Modules\Inotification\Http\Requests\CreateProviderRequest',
        'update' => 'Modules\Inotification\Http\Requests\UpdateProviderRequest',
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
        'status',
        'default',
        'type',
        'options',
        'fields',
    ];
    protected function casts(): array
    {
        return [
            'options' => 'json',
            'fields' => 'json'
        ];
    }
}
