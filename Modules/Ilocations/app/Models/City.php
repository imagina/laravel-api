<?php

namespace Modules\Ilocations\Models;

use Astrotomic\Translatable\Translatable;
use Imagina\Icore\Models\CoreModel;

class City extends CoreModel
{
  use Translatable;

  protected $table = 'ilocations__cities';
  public string $transformer = 'Modules\Ilocations\Transformers\CityTransformer';
  public string $repository = 'Modules\Ilocations\Repositories\CityRepository';
  public array $requestValidation = [
      'create' => 'Modules\Ilocations\Http\Requests\CreateCityRequest',
      'update' => 'Modules\Ilocations\Http\Requests\UpdateCityRequest',
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
  protected $fillable = [];
}
