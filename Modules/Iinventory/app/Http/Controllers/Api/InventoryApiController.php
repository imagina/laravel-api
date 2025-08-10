<?php

namespace Modules\Iinventory\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Iinventory\Models\Inventory;
use Modules\Iinventory\Repositories\InventoryRepository;

class InventoryApiController extends CoreApiController
{
  public function __construct(Inventory $model, InventoryRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
