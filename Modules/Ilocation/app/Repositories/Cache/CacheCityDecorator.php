<?php

namespace Modules\Ilocation\Repositories\Cache;

use Modules\Ilocation\Repositories\CityRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheCityDecorator extends CoreCacheDecorator implements CityRepository
{
    public function __construct(CityRepository $city)
    {
        parent::__construct();
        $this->entityName = 'ilocation.cities';
        $this->repository = $city;
    }
}
