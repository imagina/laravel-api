<?php

namespace Modules\Irentcar\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Irentcar\Models\Office;

class InitialOfficesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {

    if (Office::count() === 0) {

      $repository = app('Modules\Irentcar\Repositories\OfficeRepository');
      $offices = [
        [
          'title' => 'Oficina de Prueba 1',
          'description' => 'Esta es la descripcion de la oficina 1',
          'status' => 1,
          'locatable' => [
            'country_id' => 48,
            'province_id' => 721,
            'city_id' => 956,
            'address' => 'Calle 1, con Carrera 1',
            'lat' => '-142.545469874',
            'lng' => '85.639821'
          ]
        ],
        [
          'title' => 'Oficina de Prueba 2',
          'description' => 'Esta es la descripcion de la oficina 2',
          'status' => 1,
          'locatable' => [
            'country_id' => 48,
            'province_id' => 721,
            'city_id' => 956,
            'address' => 'Calle 2, con Carrera 2',
            'lat' => '-142.545469874',
            'lng' => '85.639821'
          ]
        ]
      ];

      //Create offices
      foreach ($offices as $data) {
        $locatable = $data['locatable'];
        unset($data['locatable']);

        $office = $repository->create($data);

        //Event to create location
        $params = [
          'data' => ['locatable' => $locatable],
          'model' => $office
        ];
        event(new \Modules\Ilocations\Events\CreateLocation($params));
      }
    }
  }
}
