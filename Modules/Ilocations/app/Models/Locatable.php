<?php

namespace Modules\Ilocations\Models;

use Astrotomic\Translatable\Translatable;
use Imagina\Icore\Models\CoreModel;

class Locatable extends CoreModel
{

  protected $table = 'ilocations__locatables';
  public string $transformer = 'Modules\Ilocations\Transformers\LocatableTransformer';
  public string $repository = 'Modules\Ilocations\Repositories\LocatableRepository';
  public array $requestValidation = [
      'create' => 'Modules\Ilocations\Http\Requests\CreateLocatableRequest',
      'update' => 'Modules\Ilocations\Http\Requests\UpdateLocatableRequest',
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
      'entity_id',
      'entity_type',
      'city_id',
      'province_id',
      'country_id',
      'lat',
      'lng'
  ];
}
