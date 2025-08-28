<?php

namespace Modules\Ilocation\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Ilocation\Models\Country;

class CountryTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Model::unguard();
    if (Country::count() === 0) {
      $path = base_path('/Modules/Ilocation/app/Assets/js/countries.json');
      $countries = json_decode(file_get_contents($path), true);

      foreach ($countries as $key => $country) {
        $currentCountry = Country::where('iso_3', $country['iso_3'])->first();

        if (!isset($currentCountry->id)) {
          Country::create($country);
        }
      }
    }
  }
}
