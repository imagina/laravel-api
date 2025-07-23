<?php

namespace Modules\Ilocations\Repositories\Cache;

use Modules\Ilocations\Repositories\CityRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheCityDecorator extends CoreCacheDecorator implements CityRepository
{
    public function __construct(CityRepository $city)
    {
        parent::__construct();
        $this->entityName = 'ilocations.cities';
        $this->repository = $city;
    }
}
