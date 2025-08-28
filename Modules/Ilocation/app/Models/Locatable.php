<?php

namespace Modules\Ilocation\Models;

use Astrotomic\Translatable\Translatable;
use Imagina\Icore\Models\CoreModel;

class Locatable extends CoreModel
{

  protected $table = 'ilocations__locatables';
  public string $transformer = 'Modules\Ilocation\Transformers\LocatableTransformer';
  public string $repository = 'Modules\Ilocation\Repositories\LocatableRepository';
  public array $requestValidation = [
    'create' => 'Modules\Ilocation\Http\Requests\CreateLocatableRequest',
    'update' => 'Modules\Ilocation\Http\Requests\UpdateLocatableRequest',
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
    'entity_id',
    'entity_type',
    'city_id',
    'province_id',
    'country_id',
    'lat',
    'lng',
    'address'
  ];
}
