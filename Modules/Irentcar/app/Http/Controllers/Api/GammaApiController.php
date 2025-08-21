<?php

namespace Modules\Irentcar\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Irentcar\Models\Gamma;
use Modules\Irentcar\Repositories\GammaRepository;

class GammaApiController extends CoreApiController
{
  public function __construct(Gamma $model, GammaRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
