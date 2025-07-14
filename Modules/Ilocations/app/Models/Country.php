<?php

namespace Modules\Ilocations\Models;

use Astrotomic\Translatable\Translatable;
use Imagina\Icore\Models\CoreModel;

class Country extends CoreModel
{
  use Translatable;

  protected $table = 'ilocations__countries';
  public string $transformer = 'Modules\Ilocations\Transformers\CountryTransformer';
  public string $repository = 'Modules\Ilocations\Repositories\CountryRepository';
  public array $requestValidation = [
      'create' => 'Modules\Ilocations\Http\Requests\CreateCountryRequest',
      'update' => 'Modules\Ilocations\Http\Requests\UpdateCountryRequest',
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
