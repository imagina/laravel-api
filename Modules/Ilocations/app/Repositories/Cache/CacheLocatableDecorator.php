<?php

namespace Modules\Ilocations\Repositories\Cache;

use Modules\Ilocations\Repositories\LocatableRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheLocatableDecorator extends CoreCacheDecorator implements LocatableRepository
{
    public function __construct(LocatableRepository $locatable)
    {
        parent::__construct();
        $this->entityName = 'ilocations.locatables';
        $this->repository = $locatable;
    }
}
