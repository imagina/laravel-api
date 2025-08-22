<?php

namespace Modules\Irentcar\Database\Seeders;

use Illuminate\Database\Seeder;

class IrentcarDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            InitialOfficesSeeder::class,
            InitialGammasSeeder::class,
            InitialExtrasSeeder::class,
            InitialGammaOfficeSeeder::class,
            InitialGammaOfficeExtraSeeder::class,
        ]);
    }
}
