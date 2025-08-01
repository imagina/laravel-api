<?php

namespace Modules\Irentcar\Models;

use Imagina\Icore\Models\CoreModel;

class GammaOffice extends CoreModel
{

    protected $table = 'irentcar__gamma_office';
    public string $transformer = 'Modules\Irentcar\Transformers\GammaOfficeTransformer';
    public string $repository = 'Modules\Irentcar\Repositories\GammaOfficeRepository';
    public array $requestValidation = [
        'create' => 'Modules\Irentcar\Http\Requests\CreateGammaOfficeRequest',
        'update' => 'Modules\Irentcar\Http\Requests\UpdateGammaOfficeRequest',
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
        'office_id',
        'gamma_id',
        'quantity',
        'price',
    ];

    //TODO - Duda de como funciona esto, si es necesario o no
    /* public $modelRelations = [
        'dailyAvailabilities' => [
            'relation' => 'hasMany', //Important: For this relationship remember the mandatory parameters to create and update
            'model' => 'Modules\Irentcar\Models\DailyAvailability'
        ]
    ]; */

    //TODO Revisar si esto es necesario
    public function dailyAvailabilities()
    {
        return $this->hasMany(DailyAvailability::class);
    }

    //TODO Revisar si esto es necesario
    public function extras()
    {
        return $this->belongsToMany(Extras::class, 'irentcar__gamma_office_extra')
            ->withPivot('id', 'gamma_office_id', 'extra_id', 'price')
            ->withTimestamps();
    }

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id');
    }
}
