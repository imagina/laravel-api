<?php

namespace Modules\Irentcar\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Irentcar\Models\GammaOfficeExtra;

class InitialGammaOfficeExtraSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {

    if (GammaOfficeExtra::count() === 0) {

      $repository = app('Modules\Irentcar\Repositories\GammaOfficeExtraRepository');
      $gammaOfficeExtra = [
        [
          'gamma_office_id' => 1,
          'extra_id' => 1,
          'price' => 20000
        ]
      ];

      //Create offices
      foreach ($gammaOfficeExtra as $go) {
        $gammaOfficeExtra = $repository->create($go);
      }
    }
  }
}
