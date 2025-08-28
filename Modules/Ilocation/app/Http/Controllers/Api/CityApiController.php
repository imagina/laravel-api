<?php

namespace Modules\Ilocation\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Ilocation\Models\City;
use Modules\Ilocation\Repositories\CityRepository;

class CityApiController extends CoreApiController
{
  public function __construct(City $model, CityRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
