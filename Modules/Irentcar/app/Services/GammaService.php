<?php

namespace Modules\Irentcar\Services;

use Carbon\Carbon;
use Modules\Irentcar\Models\GammaOffice;
use Modules\Irentcar\Models\DailyAvailability;
use Modules\Irentcar\Repositories\GammaOfficeRepository;

use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;

class GammaService
{

    private $gammaOfficeRepository;

    public function __construct(
        GammaOfficeRepository $gammaOfficeRepository
    ) {
        $this->gammaOfficeRepository = $gammaOfficeRepository;
    }

    /**
     * MAIN PROCESS
     * @param $data['pickup_office_id']
     * @param $data['pickup_date']
     * @param $data['dropoff_office_id']
     * @param $data['dropoff_date']
     * @param $params (From Request)
     */
    public function getGammasToReservations($data, $params): mixed
    {
        //Validation Dates
        $this->previousValidations($data);

        //Base Process
        $availableGammas = $this->getAvailableGammas($data, $params);

        //Add Pagination
        $availableGammas = $this->addPagination($availableGammas, $params);

        return $availableGammas;
    }

    /**
     * Check Validations
     */
    private function previousValidations($data)
    {
        //Get information [validation date]
        $validationService = app("Modules\Irentcar\Services\ValidationDateService");
        $response = $validationService->init($data);

        //Validar dropoff_date dentro del rango permitido
        $dropoffDate = Carbon::parse($data['dropoff_date']);
        $minDropoff = Carbon::parse($response['reservationDates']['minDropoffDate']);
        $maxDropoff = Carbon::parse($response['reservationDates']['maxDropoffDate']);

        if ($dropoffDate->isBefore($minDropoff->startOfDay()) || $dropoffDate->isAfter($maxDropoff->endOfDay())) {
            throw new \Exception(itrans('irentcar::reservation.validation.dropoffDateNotValid'), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        //Validar que la Hora de Pickup esté disponible
        $pickupDateTime = Carbon::parse($data['pickup_date']);
        $pickupHour = $pickupDateTime->format('H:i');

        $availableSlot = collect($response['pickupHourSlots']['slots'])
            ->first(fn($slot) => $slot['hour'] === $pickupHour && $slot['available']);

        if (!$availableSlot) {
            throw new \Exception(itrans('irentcar::reservation.validation.pickupHourNotValid'), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * Process to get Available Gammas
     */
    private function getAvailableGammas(array $data, $paramsFromRequest)
    {
        $pickupOfficeId = $data['pickup_office_id'];
        $pickupDate = Carbon::parse($data['pickup_date'])->startOfDay();
        $dropoffDate = Carbon::parse($data['dropoff_date'])->startOfDay();

        //Get Range from setting configuration
        [$startDate, $endDate] = $this->getDateRange($pickupDate, $dropoffDate);

        //Get gammas to pickup office
        $params = [
            "include" => (array) (empty($paramsFromRequest->include) ? 'gamma' : $paramsFromRequest->include),
            "filter" => ["office_id" => $pickupOfficeId]
        ];
        $paramsFromRequest = array_merge((array)$paramsFromRequest, $params);
        $gammasOffice = $this->gammaOfficeRepository->getItemsBy(json_decode(json_encode($paramsFromRequest)));

        //Get Daily Availabilities
        $dailyAvailabilities = $this->getGroupedDailyAvailabilities($gammasOffice, $startDate, $endDate);

        $availableGammas = [];

        // Recorre cada gamma de esa oficina
        foreach ($gammasOffice as $gammaOffice) {
            if ($this->isGammaAvailableAllDays($gammaOffice, $dailyAvailabilities, $startDate, $endDate)) {
                $availableGammas[] = $gammaOffice->gamma;
            }
        }

        //Resultado Final
        return $availableGammas;
    }

    /**
     * Determina el rango de fechas según la configuración.
     */
    private function getDateRange(Carbon $pickupDate, Carbon $dropoffDate): array
    {
        $configurationProcess = setting("irentcar::configurationToGetAvailableGammas");

        if ($configurationProcess === 'by-pickup-date') {
            return [$pickupDate, $pickupDate];
        }

        //By default: by-date-range
        return [$pickupDate, $dropoffDate];
    }

    /**
     * Consulta todos los registros de disponibilidad (DailyAvailability) para los gamma_office_ids involucrados (gammas de esa oficina), dentro del rango de fechas.
     * Agrupa los resultados por gamma_office_id.
     * Para cada grupo, reorganiza los elementos usando keyBy, donde la clave es la fecha sin hora (Y-m-d).
     */
    private function getGroupedDailyAvailabilities($gammasOffice, $pickupDate, $dropoffDate)
    {
        return DailyAvailability::whereIn('gamma_office_id', $gammasOffice->pluck('id'))
            ->whereBetween('date', [$pickupDate->toDateString(), $dropoffDate->toDateString()])
            ->get()
            ->groupBy('gamma_office_id')
            ->map(function ($items) {
                return $items->keyBy(function ($item) {
                    return Carbon::parse($item->date)->toDateString();
                });
            });
    }

    /**
     * Verificar si la gamma esta disponible para el rango de fechas o hasta que cumpla con la cantidad de reservas.
     */
    private function isGammaAvailableAllDays($gammaOffice, $dailyAvailabilities, $pickupDate, $dropoffDate)
    {
        $currentDate = $pickupDate->copy();

        while ($currentDate->lte($dropoffDate)) {
            $dateKey = $currentDate->toDateString();
            $daily = $dailyAvailabilities[$gammaOffice->id][$dateKey] ?? null;

            $availableQuantity = $daily
                ? $daily->quantity - $daily->reserved_quantity
                : $gammaOffice->quantity;

            if ($availableQuantity <= 0) {
                return false;
            }

            $currentDate->addDay();
        }

        return true;
    }

    /**
     * Add pagination to gammas
     */
    private function addPagination($availableGammas, $params): LengthAwarePaginator
    {

        $availableGammas = collect($availableGammas);

        $page = $params->page;
        $perPage = $params->take;

        $paginator = new LengthAwarePaginator(
            items: $availableGammas->forPage($page, $perPage),
            total: $availableGammas->count(),
            perPage: $perPage,
            currentPage: $page
        );

        return $paginator;
    }
}
