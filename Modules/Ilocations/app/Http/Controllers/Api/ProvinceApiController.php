<?php

namespace Modules\Ilocations\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Ilocations\Models\Province;
use Modules\Ilocations\Repositories\ProvinceRepository;

class ProvinceApiController extends CoreApiController
{
  public function __construct(Province $model, ProvinceRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
