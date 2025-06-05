<?php

namespace Modules\Isetting\Models;

use Astrotomic\Translatable\Translatable;
use Imagina\Icore\Models\CoreModel;

class Setting extends CoreModel
{
  use Translatable;

  protected $table = 'isetting__settings';
  public string $transformer = 'Modules\Isetting\Transformers\SettingTransformer';
  public string $repository = 'Modules\Isetting\Repositories\SettingRepository';
  public array $requestValidation = [
    'create' => 'Modules\Isetting\Http\Requests\CreateSettingRequest',
    'update' => 'Modules\Isetting\Http\Requests\UpdateSettingRequest',
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
  public array $translatedAttributes = ['value'];
  protected $fillable = ['system_name', 'plain_value', 'is_translatable'];
  protected $casts = [
    'plain_value' => 'json',
    'is_translatable' => 'boolean',
  ];
}
