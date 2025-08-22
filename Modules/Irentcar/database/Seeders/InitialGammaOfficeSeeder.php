<?php

namespace Modules\Irentcar\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Irentcar\Models\GammaOffice;

class InitialGammaOfficeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {

    if (GammaOffice::count() === 0) {

      $repository = app('Modules\Irentcar\Repositories\GammaOfficeRepository');
      $gammaOffice = [
        [
          'office_id' => 1,
          'gamma_id' => 1,
          'quantity' => 5,
          'price' => 100000

        ],
        [
          'office_id' => 1,
          'gamma_id' => 2,
          'quantity' => 5,
          'price' => 200000
        ],
      ];

      //Create offices
      foreach ($gammaOffice as $go) {
        $gammaOffice = $repository->create($go);
      }
    }
  }
}
