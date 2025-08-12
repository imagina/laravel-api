<?php

namespace Modules\Irentcar\Services;

use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class ValidationDateService
{
    protected string $localTz;

    public function __construct()
    {
        $this->localTz = config('app.local_timezone');
    }

    /**
     * @param $data['pickup_date']
     * @param $data['pickup_office_id']
     * @return array[]
     */
    public function init($data): array
    {
        $response = [];
        $now = Carbon::now($this->localTz);

        // Fecha de la Reserva
        $pickupDate = $data["pickup_date"];
        $pickupDateCarbon = Carbon::parse($pickupDate, $this->localTz);

        // Proceso de fechas
        $response["reservationDates"] = $this->getReservationDates($pickupDateCarbon, $now);

        // Proceso de slots
        $response["pickupHourSlots"] = $this->getPickupSlots($pickupDateCarbon, $now);

        return $response;
    }

    public function getReservationDates(Carbon $pickupDateCarbon, Carbon $now): array
    {

        // Validar si la fecha ya pasó (solo por día)
        if ($pickupDateCarbon->lessThan($now->copy()->startOfDay())) {
            throw new \Exception(itrans('irentcar::reservation.messages.pickupDateAlreadyPassed'), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        //Tiempo minimo en dias de la Reserva
        $minDropoffDays = setting("irentcar::minDropoffDays");
        //Tiempo maximo en dias de la Reserva
        $maxDropoffDays = setting("irentcar::maxDropoffDays");

        //Add days
        $minDateCarbon = $pickupDateCarbon->copy()->addDays($minDropoffDays);
        $maxDateCarbon = $pickupDateCarbon->copy()->addDays($maxDropoffDays);

        return [
            "pickupDate" => $pickupDateCarbon->format("Y-m-d"),
            "minDropoffDate" => $minDropoffDays == 0 ? null : $minDateCarbon->format("Y-m-d"),
            "maxDropoffDate" => $maxDropoffDays == 0 ? null : $maxDateCarbon->format("Y-m-d"),
            "extraInfor" => [
                "minDropoffDays" => $minDropoffDays,
                "maxDropoffDays" => $maxDropoffDays,
                "localTime" => $now->format("Y-m-d H:i")
            ]
        ];
    }

    public function getPickupSlots(Carbon $pickupDateCarbon, Carbon $now): array
    {
        $minAdvanceMinutes = setting("irentcar::minAdvanceMinutes");
        $slotsIntervalMinutes = setting("irentcar::slotsInvervalMinutes");

        $slotRangeStart = setting("irentcar::slotRangeStart"); // Ej: "08:00"
        $slotRangeEnd = setting("irentcar::slotRangeEnd");     // Ej: "20:00"

        // Asegurar que el rango esté en el mismo día del pickup
        $startTime = Carbon::parse($slotRangeStart, $this->localTz)->setDateFrom($pickupDateCarbon);
        $endTime = Carbon::parse($slotRangeEnd, $this->localTz)->setDateFrom($pickupDateCarbon);

        $hourSlots = [];

        //Create Range with validations
        while ($startTime <= $endTime) {
            $isToday = $pickupDateCarbon->isSameDay($now);
            $diffInMinutes = $now->diffInMinutes($startTime, false);

            $available = !($isToday && $diffInMinutes < $minAdvanceMinutes);

            $hourSlots[] = [
                "hour" => $startTime->format("H:i"),
                "available" => $available,
            ];

            $startTime->addMinutes($slotsIntervalMinutes);
        }

        return [
            "slots" => $hourSlots,
            "extraInfor" => [
                "minAdvanceMinutes" => $minAdvanceMinutes,
                "slotsIntervalMinutes" => $slotsIntervalMinutes,
                "slotRangeStart" => $slotRangeStart,
                "slotRangeEnd" => $slotRangeEnd
            ]
        ];
    }
}
