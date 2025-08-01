<?php

namespace Modules\Irentcar\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Irentcar\Models\GammaOfficeExtra;
use Modules\Irentcar\Repositories\GammaOfficeExtraRepository;

class GammaOfficeExtraApiController extends CoreApiController
{
  public function __construct(GammaOfficeExtra $model, GammaOfficeExtraRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
