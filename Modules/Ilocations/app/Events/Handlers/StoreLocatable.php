<?php

namespace Modules\Ilocations\Events\Handlers;

class StoreLocatable
{
    public function handle($event): void
    {
        $params = $event->params;

        // Get specific data
        $dataFromRequest = $params['data'];
        $model = $params['model'];

        // Handle Form
        if (!empty($dataFromRequest['locatable'])) {
            $this->syncExtraFillable($dataFromRequest, $model);
        }
    }

    public function syncExtraFillable($params, $model): void
    {
        $cityId = $params['locatable']['city_id'] ?? null;
        $countryId = $params['locatable']['country_id'] ?? null;
        $provinceId = $params['locatable']['province_id'] ?? null;
        $address = $params['locatable']['address'] ?? null;
        $lat = $params['locatable']['lat'] ?? null;
        $lng = $params['locatable']['lng'] ?? null;

        if ($cityId || $countryId || $provinceId || $lat || $lng || $address) {
            $locatableRepository = app('Modules\Ilocations\Repositories\LocatableRepository');
            $locatableRepository->updateOrCreate([
                'entity_type' => get_class($model),
                'entity_id' => $model->id,
            ], [
                'city_id' => $cityId,
                'country_id' => $countryId,
                'province_id' => $provinceId,
                'address' => $address,
                'lat' => $lat,
                'lng' => $lng,
            ]);
        }
    }
}
