<?php

namespace Modules\Irentcar\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Irentcar\Models\Office;
use Modules\Irentcar\Repositories\OfficeRepository;

class OfficeApiController extends CoreApiController
{
  public function __construct(Office $model, OfficeRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
