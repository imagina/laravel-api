<?php

namespace Modules\Irentcar\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Irentcar\Models\Reservation;
use Modules\Irentcar\Repositories\ReservationRepository;

class ReservationApiController extends CoreApiController
{
  public function __construct(Reservation $model, ReservationRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
