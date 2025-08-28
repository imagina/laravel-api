<?php

namespace Modules\Ilocation\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Ilocation\Models\Province;
use Modules\Ilocation\Repositories\ProvinceRepository;

class ProvinceApiController extends CoreApiController
{
  public function __construct(Province $model, ProvinceRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
