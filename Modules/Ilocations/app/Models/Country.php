<?php

namespace Modules\Ilocations\Models;

use Astrotomic\Translatable\Translatable;
use Imagina\Icore\Models\CoreModel;
use Illuminate\Database\Eloquent\Casts\Attribute;

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
    public array $translatedAttributes = [
        'name',
        'full_name'
    ];
    protected $fillable = [
        'currency',
        'currency_symbol',
        'currency_code',
        'currency_sub_unit',
        'region_code',
        'sub_region_code',
        'country_code',
        'iso_2',
        'iso_3',
        'calling_code',
        'status'
    ];

    public function provinces()
    {
        return $this->hasMany(Province::class);
    }

    public function children()
    {
        return $this->hasMany(Province::class)->with("children");
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function name()
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

    public function flagUrl()
    {
        return Attribute::get(function () {
            //Default
            $url = url('modules/ilocations/img/countries/flags/default.jpg');
            //Format to with Imgs
            $fileName = strtolower($this->iso_2) . ".svg";

            //Validaiton Img
            $imgPath = public_path('/modules/ilocations/img/countries/flags/' . $fileName);
            if (file_exists($imgPath)) $url = url('/modules/ilocations/img/countries/flags/' . $fileName);

            return $url;
        });

    }

    public function iconUrl()
    {
        return Attribute::get(function () {
            //Default
            $url = url('modules/ilocations/img/countries/icons/default.jpg');
            //Format to with Imgs
            $fileName = strtolower($this->iso_2) . ".svg";

            //Validaiton Img
            $imgPath = public_path('/modules/ilocations/img/countries/icons/' . $fileName);
            if (file_exists($imgPath)) $url = url('/modules/ilocations/img/countries/icons/' . $fileName);

            return $url;
        });
    }
}
