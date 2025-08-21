<?php

namespace Modules\Irentcar\Repositories\Cache;

use Modules\Irentcar\Repositories\GammaRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheGammaDecorator extends CoreCacheDecorator implements GammaRepository
{
    public function __construct(GammaRepository $gamma)
    {
        parent::__construct();
        $this->entityName = 'irentcar.gammas';
        $this->repository = $gamma;
    }
}
