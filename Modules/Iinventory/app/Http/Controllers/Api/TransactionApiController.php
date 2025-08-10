<?php

namespace Modules\Iinventory\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Iinventory\Models\Transaction;
use Modules\Iinventory\Repositories\TransactionRepository;

class TransactionApiController extends CoreApiController
{
  public function __construct(Transaction $model, TransactionRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
