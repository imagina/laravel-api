<?php

namespace Modules\Ilocation\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Imagina\Icore\Models\CoreModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Province extends CoreModel
{
  use Translatable;

  protected $table = 'ilocations__provinces';
  public string $transformer = 'Modules\Ilocation\Transformers\ProvinceTransformer';
  public string $repository = 'Modules\Ilocation\Repositories\ProvinceRepository';
  public array $requestValidation = [
    'create' => 'Modules\Ilocation\Http\Requests\CreateProvinceRequest',
    'update' => 'Modules\Ilocation\Http\Requests\UpdateProvinceRequest',
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
    'iso_2',
    'country_id',
  ];

  public function country(): BelongsTo
  {
    return $this->belongsTo(Country::class);
  }

  public function cities(): HasMany
  {
    return $this->hasMany(City::class);
  }


  public function children(): HasMany
  {
    return $this->hasMany(City::class);
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
      return $currentTranslations->toArray()["name"];
    });
  }
}
