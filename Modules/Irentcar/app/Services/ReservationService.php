<?php

namespace Modules\Irentcar\Services;

use Modules\Irentcar\Repositories\GammaOfficeRepository;
use Modules\Irentcar\Repositories\GammaRepository;
use Modules\Irentcar\Repositories\GammaOfficeExtraRepository;
use Modules\Irentcar\Repositories\DailyAvailabilityRepository;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

use Symfony\Component\HttpFoundation\Response;

class ReservationService
{
    private $gammaOfficeRepository;
    private $gammaRepository;
    private $gammaOfficeExtraRepository;
    private $dailyAvailabilityRepository;

    private $gammaOffice;

    public function __construct(
        GammaOfficeRepository $gammaOfficeRepository,
        GammaRepository $gammaRepository,
        GammaOfficeExtraRepository $gammaOfficeExtraRepository,
        DailyAvailabilityRepository $dailyAvailabilityRepository
    ) {
        $this->gammaOfficeRepository = $gammaOfficeRepository;
        $this->gammaRepository = $gammaRepository;
        $this->gammaOfficeExtraRepository = $gammaOfficeExtraRepository;
        $this->dailyAvailabilityRepository  = $dailyAvailabilityRepository;
    }

    /**
     * Used by ReservationRepository (BeforeCreate)
     * Get Attributes to create a Reservation
     * @param mixed $data
     */
    public function getDataToCreate($data)
    {

        $this->validationsUser($data);
        $this->getGammaData($data);
        $this->getPriceFromGammaOffice($data);
        $this->getExtrasData($data);
        $this->getTotalPrice($data);
        $this->getConvertionsData($data);
        $this->processToDailyAvailabilities($data);

        return $data;
    }

    /**
     * Get user and validate age
     */
    private function validationsUser(&$data)
    {
        //Get User
        $user = \Auth::user();
        //Configration from Setting
        $ageSetting = setting("irentcar::minDriveAge");

        //Get age from User Profile
        $ageField = collect($user->fields)->firstWhere('title', 'age');
        $age = $ageField->value ?? null;

        //Validation Aage
        if (!$age || $age <= $ageSetting) {
            throw new \Exception(
                itrans('irentcar::reservation.validation.minimunUserAge', ['age' => $ageSetting]),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        //Set user id
        $data['user_id'] = $user->id;
    }

    /**
     * Get price from gammaOffice and priority in DailyAvailability
     */
    private function getPriceFromGammaOffice(&$data)
    {

        $gammaOfficeId = $data['gamma_office_id'];
        $pickupDate = Carbon::parse($data['pickup_date'])->format('Y-m-d');

        //Priority check in dailyAvailability to this specific Date and this gamma_office_id
        $params = [
            'filter' => [
                'field' => 'date',
                'gamma_office_id' => $gammaOfficeId
            ]
        ];
        $dailyAvailability = $this->dailyAvailabilityRepository->getItem($pickupDate, json_decode(json_encode($params)));

        //To specific date get the price
        if ($dailyAvailability && !is_null($dailyAvailability->price)) {
            $data['gamma_office_price'] = $dailyAvailability->price;
        } else {
            //Get Base price
            $data['gamma_office_price'] = $this->gammaOffice->price;
        }
    }

    /**
     * Get gammaOffice, get gamma and set data
     */
    private function getGammaData(&$data)
    {
        //Get Gamma Office with Gamma and DailyAvailabilities
        $params = ['include' => ['gamma', 'dailyAvailabilities']];
        $this->gammaOffice = $this->gammaOfficeRepository->getItem($data['gamma_office_id'], json_decode(json_encode($params)));

        $gamma = $this->gammaOffice->gamma->toArray();

        //Set gamma data
        $data['gamma_id'] = $gamma['id'];
        //Save data as backup
        $data['gamma_data'] = $gamma;
    }

    /**
     * OPTIONAL Get Extras data and total price to the extras
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

    /**
     * Get total price from gamma Office price + extras total price
     */
    private function getTotalPrice(&$data)
    {
        $totalPrice = $data['gamma_office_price'];
        if (isset($data['gamma_office_extra_total_price']))
            $totalPrice += $data['gamma_office_extra_total_price'];

        $data['total_price'] = $totalPrice;
    }

    /**
     * Get Convertion Rates
     */
    private function getConvertionsData(&$data)
    {

        $result = getConversionRates();

        if (isset($result['USDRates'])) {
            $data['options']['USDRates'] = $result['USDRates'];
        }
    }

    /**
     * Process to DailyAvailabilities: Create or Update reserved_quantity
     */
    private function processToDailyAvailabilities(array &$data): void
    {
        $pickupDate = Carbon::parse($data['pickup_date'])->startOfDay();
        $dropoffDate = Carbon::parse($data['dropoff_date'])->startOfDay();

        //Global Gamma Office
        $gammaOffice = $this->gammaOffice;

        //Iterar por cada día del rango segun la reserva
        $period = CarbonPeriod::create($pickupDate, $dropoffDate);
        foreach ($period as $date) {
            $dateKey = $date->format('Y-m-d');

            //Buscar si ya existe disponibilidad para ese día
            $daily = $gammaOffice->dailyAvailabilities->first(function ($item) use ($dateKey) {
                return Carbon::parse($item->date)->format('Y-m-d') === $dateKey;
            });

            if ($daily) {
                // Ya existe: incrementar reserved_quantity
                $daily->reserved_quantity += 1;
                $daily->save();
            } else {
                // No existe: crear nuevo registro con algunos datos del padre
                $this->dailyAvailabilityRepository->create([
                    'gamma_office_id'    => $gammaOffice->id,
                    'quantity'           => $gammaOffice->quantity,
                    'date'               => $dateKey,
                    'reserved_quantity'  => 1,
                    'reason'             => null,
                    'price'              => null
                ]);
            }
        }
    }
}
