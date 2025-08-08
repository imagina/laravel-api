<?php

namespace Modules\Irentcar\Repositories\Cache;

use Modules\Irentcar\Repositories\DailyAvailabilityRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheDailyAvailabilityDecorator extends CoreCacheDecorator implements DailyAvailabilityRepository
{
    public function __construct(DailyAvailabilityRepository $dailyavailability)
    {
        parent::__construct();
        $this->entityName = 'irentcar.dailyavailabilities';
        $this->repository = $dailyavailability;
    }
}
