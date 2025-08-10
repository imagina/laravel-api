<?php

namespace Modules\Iinventory\Repositories\Cache;

use Modules\Iinventory\Repositories\InventoryRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheInventoryDecorator extends CoreCacheDecorator implements InventoryRepository
{
    public function __construct(InventoryRepository $inventory)
    {
        parent::__construct();
        $this->entityName = 'iinventory.inventories';
        $this->repository = $inventory;
    }
}
