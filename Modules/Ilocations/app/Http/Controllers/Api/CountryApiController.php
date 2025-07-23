<?php

namespace Modules\Ilocations\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Ilocations\Models\Country;
use Modules\Ilocations\Repositories\CountryRepository;

class CountryApiController extends CoreApiController
{
  public function __construct(Country $model, CountryRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
