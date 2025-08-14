<?php

namespace Modules\Irentcar\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Irentcar\Models\GammaOffice;
use Modules\Irentcar\Repositories\GammaOfficeRepository;

class GammaOfficeApiController extends CoreApiController
{
  public function __construct(GammaOffice $model, GammaOfficeRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
