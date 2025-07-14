<?php

namespace Modules\Ilocations\Models;

use Astrotomic\Translatable\Translatable;
use Imagina\Icore\Models\CoreModel;

class Province extends CoreModel
{
  use Translatable;

  protected $table = 'ilocations__provinces';
  public string $transformer = 'Modules\Ilocations\Transformers\ProvinceTransformer';
  public string $repository = 'Modules\Ilocations\Repositories\ProvinceRepository';
  public array $requestValidation = [
      'create' => 'Modules\Ilocations\Http\Requests\CreateProvinceRequest',
      'update' => 'Modules\Ilocations\Http\Requests\UpdateProvinceRequest',
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
