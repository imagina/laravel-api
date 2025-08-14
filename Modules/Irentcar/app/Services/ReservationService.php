<?php

namespace Modules\Irentcar\Services;

use Modules\Irentcar\Repositories\GammaOfficeRepository;
use Modules\Irentcar\Repositories\GammaRepository;
use Modules\Irentcar\Repositories\GammaOfficeExtraRepository;
use Illuminate\Support\Facades\Http;

class ReservationService
{
    private $gammaOfficeRepository;
    private $gammaRepository;
    private $gammaOfficeExtraRepository;

    public function __construct(
        GammaOfficeRepository $gammaOfficeRepository,
        GammaRepository $gammaRepository,
        GammaOfficeExtraRepository $gammaOfficeExtraRepository
    ) {
        $this->gammaOfficeRepository = $gammaOfficeRepository;
        $this->gammaRepository = $gammaRepository;
        $this->gammaOfficeExtraRepository = $gammaOfficeExtraRepository;
    }

    /**
     * Get Attributes to create a Reservation
     * @param mixed $data
     */
    public function getDataToCreate($data)
    {
        //Get User ID
        $userId = \Auth::user()->id;
        $data['user_id'] = $userId;

        $this->getPriceFromGammaOffice($data);
        $this->getGammaData($data);
        $this->getExtrasData($data);
        $this->getTotalPrice($data);
        $this->getConvertionsData($data);

        return $data;
    }

    private function getPriceFromGammaOffice(&$data)
    {
        $gammaOffice = $this->gammaOfficeRepository->getItem($data['gamma_office_id']);
        $data['gamma_office_price'] = $gammaOffice->price;
    }

    private function getGammaData(&$data)
    {
        $gamma = $this->gammaRepository->getItem($data['gamma_id']);
        $data['gamma_data'] = $gamma->toArray();
    }

    /**
     * OPTIONAL
     */
    private function getExtrasData(&$data)
    {
        if (isset($data['gamma_office_extra_ids'])) {
            //Ids to array
            $ids =  json_decode($data['gamma_office_extra_ids']);

            //Params to Query
            $params = [
                'filter' => ['ids' => $ids],
                'include' => ['extra']
            ];

            $totalPrice = 0;
            $extras = [];

            $extrasBD = $this->gammaOfficeExtraRepository->getItemsBy(json_decode(json_encode($params)));

            foreach ($extrasBD as $key => $extra) {
                $extras[$key] = $extra->toArray();
                $totalPrice += $extra->price;
            }


            //Final Data
            $data['extras_data'] = $extras;
            $data['gamma_office_extra_total_price'] = $totalPrice;
        }
    }

    private function getTotalPrice(&$data)
    {
        $totalPrice = $data['gamma_office_price'];
        if (isset($data['gamma_office_extra_total_price']))
            $totalPrice += $data['gamma_office_extra_total_price'];

        $data['total_price'] = $totalPrice;
    }

    private function getConvertionsData(&$data)
    {

        $result = getConversionRates();

        if (isset($result['USDRates'])) {
            $data['options']['USDRates'] = $result['USDRates'];
        }
    }
}
