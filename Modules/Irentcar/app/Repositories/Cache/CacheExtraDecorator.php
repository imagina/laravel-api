<?php

namespace Modules\Irentcar\Repositories\Cache;

use Modules\Irentcar\Repositories\ExtraRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheExtraDecorator extends CoreCacheDecorator implements ExtraRepository
{
    public function __construct(ExtraRepository $extra)
    {
        parent::__construct();
        $this->entityName = 'irentcar.extras';
        $this->repository = $extra;
    }
}
