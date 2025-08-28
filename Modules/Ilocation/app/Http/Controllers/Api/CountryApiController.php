<?php

namespace Modules\Ilocation\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Ilocation\Models\Country;
use Modules\Ilocation\Repositories\CountryRepository;

class CountryApiController extends CoreApiController
{
  public function __construct(Country $model, CountryRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
