<?php

namespace Modules\Irentcar\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Irentcar\Models\DailyAvailability;
use Modules\Irentcar\Repositories\DailyAvailabilityRepository;

class DailyAvailabilityApiController extends CoreApiController
{
  public function __construct(DailyAvailability $model, DailyAvailabilityRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
