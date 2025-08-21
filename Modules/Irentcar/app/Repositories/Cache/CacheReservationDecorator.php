<?php

namespace Modules\Irentcar\Repositories\Cache;

use Modules\Irentcar\Repositories\ReservationRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheReservationDecorator extends CoreCacheDecorator implements ReservationRepository
{
    public function __construct(ReservationRepository $reservation)
    {
        parent::__construct();
        $this->entityName = 'irentcar.reservations';
        $this->repository = $reservation;
    }
}
