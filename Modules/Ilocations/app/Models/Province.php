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
  public array $translatedAttributes = [
      'name'
  ];
  protected $fillable = [
      'iso_2',
      'country_id',
  ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }


    public function children()
    {
        return $this->hasMany(City::class);
    }

    public function name()
    {

        $currentTranslations = $this->getTranslation(locale());

        if (empty($currentTranslations) || empty($currentTranslations->toArray()["name"])) {

            $model = $this->getTranslation(app()->getLocale());

            if(empty($model)) return "";
            return $model->toArray()["name"] ?? "";
        }

        return $currentTranslations->toArray()["name"];

    }

}
