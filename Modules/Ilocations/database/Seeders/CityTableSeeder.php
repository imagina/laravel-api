<?php

namespace Modules\Ilocations\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Ilocations\Models\City;
use Modules\Ilocations\Models\Country;
use Modules\Ilocations\Models\Province;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Model::unguard();

        $countries = Country::get();
        $provinces = Province::get();
        $pathCO = base_path('/Modules/Ilocations/app/Assets/js/citiesCO.json');
        $pathUS = base_path('/Modules/Ilocations/app/Assets/js/citiesUS.json');
        $pathMX = base_path('/Modules/Ilocations/app/Assets/js/citiesMX.json');
        $cities = [];
        $countriesToSeedCities = json_decode(setting('ilocations::countriesToSeedCities', '["citiesCO"]'));

        foreach ($countriesToSeedCities as $citiesJsonName) {
            $path = base_path("/Modules/Ilocations/app/Assets/js/$citiesJsonName.json");
            $citiesJson = json_decode(file_get_contents($path), true);
            $cities = array_merge($cities, $citiesJson);
        }

        $currentCities = City::all();

        $citiesToCreate = [];
        foreach ($cities as $key => $city) {
            $currentCity = $currentCities->where('code', $city['code'])->first();
            if (! isset($currentCity->id)) {
                $countryCity = $countries->where('iso_2', $city['country_iso_2'])->first();
                $provinceCity = $provinces->where('iso_2', $city['province_iso_2'])->first();
                $city['country_id'] = $countryCity->id;
                $city['province_id'] = $provinceCity->id;
                unset($city['country_iso_2']);
                unset($city['province_iso_2']);
                City::create($city);
            }
        }
    }
}
