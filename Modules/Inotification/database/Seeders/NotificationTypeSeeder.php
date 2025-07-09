<?php

namespace Modules\Inotification\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Modules\Inotification\Repositories\NotificationTypeRepository;

class NotificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Model::unguard();

        DB::table('inotification__notification_types')->truncate();
        $notificationTypes = config('inotification.notificationTypes');

        foreach ($notificationTypes as $type) {
            app(NotificationTypeRepository::class)->create($type);
        }
    }
}
