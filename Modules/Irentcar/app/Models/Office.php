<?php

namespace Modules\Irentcar\Models;

use Imagina\Icore\Models\CoreModel;

use Illuminate\Database\Eloquent\Casts\Attribute;

class Office extends CoreModel
{

    protected $table = 'irentcar__offices';
    public string $transformer = 'Modules\Irentcar\Transformers\OfficeTransformer';
    public string $repository = 'Modules\Irentcar\Repositories\OfficeRepository';
    public array $requestValidation = [
        'create' => 'Modules\Irentcar\Http\Requests\CreateOfficeRequest',
        'update' => 'Modules\Irentcar\Http\Requests\UpdateOfficeRequest',
    ];
    //Instance external/internal events to dispatch with extraData
    public array $dispatchesEventsWithBindings = [
        'created' => [['path' => 'Modules\Ilocations\Events\CreateLocation']],
        'creating' => [],
        'updated' => [['path' => 'Modules\Ilocations\Events\UpdateLocation']],
        'updating' => [],
        'deleting' => [['path' => 'Modules\Ilocations\Events\DeleteLocation']],
        'deleted' => []
    ];
    public array $translatedAttributes = [];
    protected $fillable = [
        'title',
        'description',
        'status'
    ];

    protected $appends = [
        'status_title'
    ];

    public function statusTitle(): Attribute
    {
        return Attribute::get(function () {
            $status = new Status();
            return $status->get($this->status);
        });
    }

    //TODO Revisar si esto es necesario
    public function gammas()
    {
        return $this->belongsToMany(Gamma::class, 'irentcar__gamma_office')
            ->withPivot('id', 'office_id', 'gamma_id', 'quantity', 'price')
            ->withTimestamps();
    }

    /**
     * Locatable Implementation
     */
    public function locations()
    {
        if (isModuleEnabled('Ilocations')) {
            return app(\Modules\Ilocations\Relations\LocationsRelation::class)->resolve($this);
        }
        return new \Imagina\Icore\Relations\EmptyRelation();
    }
}
