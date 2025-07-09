<?php

namespace Modules\Inotification\Database\Seeders;

use Illuminate\Database\Seeder;

class InotificationDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(NotificationTypeSeeder::class);
        $this->call(NotificationProviderSeeder::class);
    }
}
