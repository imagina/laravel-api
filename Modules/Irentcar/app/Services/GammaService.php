<?php

namespace Modules\Irentcar\Services;

use Carbon\Carbon;
use Modules\Irentcar\Models\Reservation;
use Modules\Irentcar\Models\GammaOffice;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;

class GammaService
{

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

        //Validar que la hora de pickup esté disponible
        $pickupDateTime = Carbon::parse($data['pickup_date']);
        $pickupHour = $pickupDateTime->format('H:i');

        $availableSlot = collect($response['pickupHourSlots']['slots'])
            ->first(fn($slot) => $slot['hour'] === $pickupHour && $slot['available']);

        if (!$availableSlot) {
            throw new \Exception(itrans('irentcar::reservation.validation.pickupHourNotValid'), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * Process to get available gammas
     */
    private function getAvailableGammas($data, $params): mixed
    {
        $pickupOfficeId = $data['pickup_office_id'];
        $pickupDate = Carbon::parse($data['pickup_date'])->startOfDay();
        $dropoffDate = Carbon::parse($data['dropoff_date'])->endOfDay();

        //Obtener cada fecha en ese rango
        $days = Carbon::parse($pickupDate)->daysUntil($dropoffDate)->map(fn($date) => $date->format('Y-m-d'));

        //Always include Gamma | TODO CHECK
        $include = empty($params->include) ? 'gamma' : $params->include;

        //Preload gamma quantities with full gamma info | TODO: CACHEAR
        $gammaOffices = GammaOffice::with($include)
            ->where('office_id', $pickupOfficeId)
            ->get()
            ->keyBy('gamma_id'); //Esto permite acceder rápidamente a cada GammaOffice por su gamma_id, sin hacer búsquedas lineales.

        // Inicialmente asumimos que todas las gammas están disponibles
        $viableGammaIds = collect($gammaOffices->keys())->flip(); // flip() para usar como mapa: [gamma_id => true]

        //Opcional: Verificar al final la cantidad disponible para esa gamma | Dejarlo mientras se prueba
        $gammaMinAvailable = collect(); // [gamma_id => min_available]

        //Reservaciones en ese rango, agrupadas por dias y gammas
        $reservations = Reservation::whereBetween('pickup_date', [$pickupDate, $dropoffDate])
            ->where('pickup_office_id', $pickupOfficeId)
            ->where('status', 1) // Approved
            ->selectRaw('gamma_id, DATE(pickup_date) as day, COUNT(*) as reserved_count')
            ->groupBy('gamma_id', 'day')
            ->get()
            ->groupBy('day'); // Agrupamos por día para simular el loop original

        //Se recorren los dias
        foreach ($days as $day) {
            //Obtener las reservaciones para ese dia
            $dailyReservations = $reservations[$day] ?? collect();
            // Reindexamos por gamma_id para facilitar el acceso
            $reservationsByGamma = $dailyReservations->keyBy('gamma_id');

            foreach ($viableGammaIds->keys() as $gammaId) {
                $reserved = $reservationsByGamma[$gammaId]->reserved_count ?? 0;
                $available = $gammaOffices[$gammaId]->quantity - $reserved;

                //Opcional: Verificar al final la cantidad disponible para esa gamma | Dejarlo mientras se prueba
                $currentMin = $gammaMinAvailable[$gammaId] ?? $gammaOffices[$gammaId]->quantity;
                $gammaMinAvailable[$gammaId] = min($currentMin, $available);

                if ($available <= 0) {
                    $viableGammaIds->forget($gammaId); // Ya no está disponible en todo el rango
                }
            }

            if ($viableGammaIds->isEmpty()) {
                break;
            }
        }

        // Construir el resultado final con las gammas que sobrevivieron todos los días
        $availableGammas = $viableGammaIds->keys()->map(function ($gammaId) use ($gammaOffices, $gammaMinAvailable) {
            $gamma = $gammaOffices[$gammaId]->gamma;
            //Opcional: Verificar al final la cantidad disponible para esa gamma | Dejarlo mientras se prueba
            $gamma->setAttribute('available_quantity', $gammaMinAvailable[$gammaId] ?? 0);
            //Return resul final
            return $gamma;
        })->values();


        return $availableGammas;
    }

    /**
     * Add pagination to gammas
     */
    private function addPagination($availableGammas, $params): LengthAwarePaginator
    {

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
