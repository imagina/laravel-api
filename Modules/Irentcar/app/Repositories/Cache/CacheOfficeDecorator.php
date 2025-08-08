<?php

namespace Modules\Irentcar\Repositories\Cache;

use Modules\Irentcar\Repositories\OfficeRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheOfficeDecorator extends CoreCacheDecorator implements OfficeRepository
{
    public function __construct(OfficeRepository $office)
    {
        parent::__construct();
        $this->entityName = 'irentcar.offices';
        $this->repository = $office;
    }
}
