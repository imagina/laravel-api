<?php

namespace Modules\Iinventory\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Iinventory\Models\InventoryItem;
use Modules\Iinventory\Repositories\InventoryItemRepository;

class InventoryItemApiController extends CoreApiController
{
  public function __construct(InventoryItem $model, InventoryItemRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
