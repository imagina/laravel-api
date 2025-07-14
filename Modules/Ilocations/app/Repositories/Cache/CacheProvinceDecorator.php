<?php

namespace Modules\Ilocations\Repositories\Cache;

use Modules\Ilocations\Repositories\ProvinceRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheProvinceDecorator extends CoreCacheDecorator implements ProvinceRepository
{
    public function __construct(ProvinceRepository $province)
    {
        parent::__construct();
        $this->entityName = 'ilocations.provinces';
        $this->repository = $province;
    }
}
