<?php

namespace Modules\Irentcar\Repositories\Cache;

use Modules\Irentcar\Repositories\GammaOfficeExtraRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheGammaOfficeExtraDecorator extends CoreCacheDecorator implements GammaOfficeExtraRepository
{
    public function __construct(GammaOfficeExtraRepository $gammaofficeextra)
    {
        parent::__construct();
        $this->entityName = 'irentcar.gammaofficeextras';
        $this->repository = $gammaofficeextra;
    }
}
