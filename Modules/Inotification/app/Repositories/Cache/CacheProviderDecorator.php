<?php

namespace Modules\Inotification\Repositories\Cache;

use Modules\Inotification\Repositories\ProviderRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheProviderDecorator extends CoreCacheDecorator implements ProviderRepository
{
    public function __construct(ProviderRepository $provider)
    {
        parent::__construct();
        $this->entityName = 'inotification.providers';
        $this->repository = $provider;
    }
}
