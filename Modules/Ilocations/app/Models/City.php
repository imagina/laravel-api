<?php

namespace Modules\Ilocations\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Imagina\Icore\Models\CoreModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
  public array $translatedAttributes = [
    'name'
  ];
  protected $fillable = [
    'code',
    'province_id',
    'country_id'
  ];

  public function country(): BelongsTo
  {
    return $this->belongsTo(Country::class);
  }

  public function province(): BelongsTo
  {
    return $this->belongsTo(Province::class);
  }

  public function name(): Attribute
  {
    return Attribute::get(function () {

      $currentTranslations = $this->getTranslation(locale());

      if (empty($currentTranslations) || empty($currentTranslations->toArray()["name"])) {

        $model = $this->getTranslation(app()->getLocale());

        if (empty($model)) return "";
        return $model->toArray()["name"] ?? "";
      }

      return ucwords(strtolower($currentTranslations->toArray()["name"]));
    });
  }

}
