<?php

namespace Modules\Irentcar\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Irentcar\Models\Extra;

class InitialExtrasSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {

    if (Extra::count() === 0) {

      $repository = app('Modules\Irentcar\Repositories\ExtraRepository');
      $extras = [
        [
          'title' => 'Asientos para Bebes',
          'description' => 'Estos asientos son muy confortables , seguros etc',
        ]
      ];

      //Create gammas
      foreach ($extras as $data) {
        $extra = $repository->create($data);
      }
    }
  }
}
