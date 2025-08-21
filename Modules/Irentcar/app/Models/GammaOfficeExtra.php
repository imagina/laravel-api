<?php

namespace Modules\Irentcar\Models;

use Imagina\Icore\Models\CoreModel;

class GammaOfficeExtra extends CoreModel
{

    protected $table = 'irentcar__gamma_office_extra';
    public string $transformer = 'Modules\Irentcar\Transformers\GammaOfficeExtraTransformer';
    public string $repository = 'Modules\Irentcar\Repositories\GammaOfficeExtraRepository';
    public array $requestValidation = [
        'create' => 'Modules\Irentcar\Http\Requests\CreateGammaOfficeExtraRequest',
        'update' => 'Modules\Irentcar\Http\Requests\UpdateGammaOfficeExtraRequest',
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
        'gamma_office_id',
        'extra_id',
        'price'
    ];


    public function extra()
    {
        return $this->belongsTo(Extra::class);
    }

    public function gammaOffice()
    {
        return $this->belongsTo(GammaOffice::class);
    }
}
