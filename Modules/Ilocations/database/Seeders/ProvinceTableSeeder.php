<?php

namespace Modules\Ilocations\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Ilocations\Models\Country;
use Modules\Ilocations\Models\Province;

class ProvinceTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run()
  {
    Model::unguard();
    if (Province::count() == 0) {
      $path = base_path('/Modules/Ilocations/app/Assets/js/provinces.json');
      $provinces = collect(json_decode(file_get_contents($path), false));
      $countries = Country::all();

      foreach ($provinces as $province) {
        $currentProvince = Province::where('iso_2', $province->iso_2)->first();
        if (!isset($currentProvince->id)) {
          $country = $countries->where('iso_2', $province->country)->first();
          Province::create([
            'name' => $province->region,
            'iso_2' => $province->iso_2,
            'country_id' => $country->id,
          ]);
        }
      }
    }
  }
}
