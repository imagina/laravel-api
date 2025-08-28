<?php

namespace Modules\Ilocation\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Ilocation\Models\City;
use Modules\Ilocation\Models\Country;
use Modules\Ilocation\Models\Province;

class CityTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Model::unguard();
    if (City::count() == 0) {
      $countries = Country::get();
      $provinces = Province::get();
      $cities = [];
      $countriesToSeedCities = json_decode(setting('ilocation::countriesToSeedCities', '["citiesCO"]'));

      foreach ($countriesToSeedCities as $citiesJsonName) {
        $path = base_path("/Modules/Ilocation/app/Assets/js/$citiesJsonName.json");
        $citiesJson = json_decode(file_get_contents($path), true);
        $cities = array_merge($cities, $citiesJson);
      }

      $currentCities = City::all();

      foreach ($cities as $key => $city) {
        $currentCity = $currentCities->where('code', $city['code'])->first();
        if (!isset($currentCity->id)) {
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
}
