<?php

namespace Modules\Ilocation\Repositories\Cache;

use Modules\Ilocation\Repositories\LocatableRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheLocatableDecorator extends CoreCacheDecorator implements LocatableRepository
{
    public function __construct(LocatableRepository $locatable)
    {
        parent::__construct();
        $this->entityName = 'ilocation.locatables';
        $this->repository = $locatable;
    }
}
