<?php

namespace Modules\Isetting\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Isetting\Models\Setting;
use Modules\Isetting\Repositories\SettingRepository;

class SettingApiController extends CoreApiController
{
  public function __construct(Setting $model, SettingRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
