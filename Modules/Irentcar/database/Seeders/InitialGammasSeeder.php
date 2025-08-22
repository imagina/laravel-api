<?php

namespace Modules\Irentcar\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Irentcar\Models\Gamma;

class InitialGammasSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {

    if (Gamma::count() === 0) {

      $repository = app('Modules\Irentcar\Repositories\GammaRepository');
      $gammas = [
        [
          'title' => 'Gama ZX',
          'summary' => 'Kia Picanto o Similar',
          'description' => ' Lorem ipsum dolor sit amet, consectetur adipiscing elit',
          'passengers_number' => 3,
          'luggages' => 1,
          'doors' => 2,
        ],
        [
          'title' => 'Gama AB',
          'summary' => 'Fiat Pulse o Similar',
          'description' => ' Lorem ipsum dolor sit amet, consectetur adipiscing elit',
          'passengers_number' => 5,
          'luggages' => 1,
          'doors' => 4,
        ]
      ];

      //Create gammas
      foreach ($gammas as $data) {
        $gamma = $repository->create($data);
      }
    }
  }
}
