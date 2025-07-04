<?php

namespace Modules\Inotification\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Inotification\Models\Device;
use Modules\Inotification\Repositories\DeviceRepository;

class DeviceApiController extends CoreApiController
{
  public function __construct(Device $model, DeviceRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
