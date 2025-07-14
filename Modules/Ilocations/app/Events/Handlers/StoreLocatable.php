<?php

namespace Modules\Ilocations\Events\Handlers;

class StoreLocatable
{
    public function handle($event)
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

    public function syncExtraFillable($params, $model)
    {
        $cityId = $params['data']['locatable']['city_id'] ?? null;
        $countryId = $params['data']['locatable']['country_id'] ?? null;
        $provinceId = $params['data']['locatable']['province_id'] ?? null;
        $lat = $params['data']['locatable']['lat'] ?? null;
        $lng = $params['data']['locatable']['lng'] ?? null;

        if ($cityId || $countryId || $provinceId) {
            $locatableRepository = app('Modules\Ilocations\Repositories\LocatableRepository');
            $locatableRepository->updateOrCreate([
                'entity_type' => get_class($model),
                'entity_id' => $model->id,
            ], [
                'city_id' => $cityId,
                'country_id' => $countryId,
                'province_id' => $provinceId,
                'lat' => $lat,
                'lng' => $lng,
            ]);
        }
    }
}
