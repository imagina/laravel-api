<?php

namespace Modules\Ishoe\Repositories\Cache;

use Modules\Ishoe\Repositories\ShoeRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheShoeDecorator extends CoreCacheDecorator implements ShoeRepository
{
    public function __construct(ShoeRepository $shoe)
    {
        parent::__construct();
        $this->entityName = 'ishoe.shoes';
        $this->repository = $shoe;
    }
}
