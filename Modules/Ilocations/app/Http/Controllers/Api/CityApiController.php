<?php

namespace Modules\Ilocations\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Ilocations\Models\City;
use Modules\Ilocations\Repositories\CityRepository;

class CityApiController extends CoreApiController
{
  public function __construct(City $model, CityRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
