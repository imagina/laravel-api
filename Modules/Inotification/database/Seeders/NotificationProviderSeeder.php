<?php

namespace Modules\Inotification\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Modules\Inotification\Repositories\ProviderRepository;

class NotificationProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Model::unguard();

        $providerRepository =  app(ProviderRepository::class);

        $providers = config('inotification.providers');
        foreach ($providers as $provider) {

            //Validation Provider Exists
            $params = json_decode(json_encode(["filter" => ["field" => "system_name"]]));
            $databaseProvider = $providerRepository->getItem($provider['systemName'], $params);

            if (! isset($databaseProvider->id)) {
                //Create the Provider
                $dataToCreate = [
                    'title' => $provider['title'],
                    'system_name' => $provider['systemName'],
                    'status' => $provider['status'],
                    'default' => $provider['default'],
                    'type' => $provider['type'],
                    'fields' => $provider['fields'],
                ];
                $providerRepository->create($dataToCreate);
            }
        }
    }
}
