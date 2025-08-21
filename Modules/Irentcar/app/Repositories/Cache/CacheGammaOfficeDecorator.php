<?php

namespace Modules\Irentcar\Repositories\Cache;

use Modules\Irentcar\Repositories\GammaOfficeRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheGammaOfficeDecorator extends CoreCacheDecorator implements GammaOfficeRepository
{
    public function __construct(GammaOfficeRepository $gammaoffice)
    {
        parent::__construct();
        $this->entityName = 'irentcar.gammaoffices';
        $this->repository = $gammaoffice;
    }
}
