<?php

namespace Modules\Ilocation\Repositories\Cache;

use Modules\Ilocation\Repositories\ProvinceRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheProvinceDecorator extends CoreCacheDecorator implements ProvinceRepository
{
    public function __construct(ProvinceRepository $province)
    {
        parent::__construct();
        $this->entityName = 'ilocation.provinces';
        $this->repository = $province;
    }
}
