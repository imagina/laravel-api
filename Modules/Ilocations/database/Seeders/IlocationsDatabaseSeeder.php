<?php

namespace Modules\Ilocations\Database\Seeders;

use Illuminate\Database\Seeder;

class IlocationsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(CountryTableSeeder::class);
        $this->call(ProvinceTableSeeder::class);
        $this->call(CityTableSeeder::class);
    }
}
