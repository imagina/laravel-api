<?php

namespace Modules\Irentcar\Models;

use Imagina\Icore\Models\CoreModel;

class DailyAvailability extends CoreModel
{


    protected $table = 'irentcar__daily_availabilities';
    public string $transformer = 'Modules\Irentcar\Transformers\DailyAvailabilityTransformer';
    public string $repository = 'Modules\Irentcar\Repositories\DailyAvailabilityRepository';
    public array $requestValidation = [
        'create' => 'Modules\Irentcar\Http\Requests\CreateDailyAvailabilityRequest',
        'update' => 'Modules\Irentcar\Http\Requests\UpdateDailyAvailabilityRequest',
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
        'quantity',
        'date',
        'reason',
        'price',
        'reserved_quantity'
    ];

    /*
     * Relationships
     */
    public function gammaOffice()
    {
        return $this->belongsTo(GammaOffice::class);
    }
}
