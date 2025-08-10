<?php

namespace Modules\Iinventory\Repositories\Cache;

use Modules\Iinventory\Repositories\InventoryItemRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheInventoryItemDecorator extends CoreCacheDecorator implements InventoryItemRepository
{
    public function __construct(InventoryItemRepository $inventoryitem)
    {
        parent::__construct();
        $this->entityName = 'iinventory.inventoryitems';
        $this->repository = $inventoryitem;
    }
}
