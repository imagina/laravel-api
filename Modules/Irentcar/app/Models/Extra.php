<?php

namespace Modules\Irentcar\Models;

use Imagina\Icore\Models\CoreModel;

class Extra extends CoreModel
{

    protected $table = 'irentcar__extras';
    public string $transformer = 'Modules\Irentcar\Transformers\ExtraTransformer';
    public string $repository = 'Modules\Irentcar\Repositories\ExtraRepository';
    public array $requestValidation = [
        'create' => 'Modules\Irentcar\Http\Requests\CreateExtraRequest',
        'update' => 'Modules\Irentcar\Http\Requests\UpdateExtraRequest',
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
    public array $translatedAttributes = [];
    protected $fillable = [
        'title',
        'description'
    ];

    //TODO Revisar si esto es necesario
    public function gammaOffices()
    {
        return $this->belongsToMany(GammaOffice::class, 'irentcar__gamma_office_extra')
            ->withPivot('id', 'gamma_office_id', 'extra_id', 'price')
            ->withTimestamps();
    }
}
