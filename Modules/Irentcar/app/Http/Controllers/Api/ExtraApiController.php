<?php

namespace Modules\Irentcar\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Irentcar\Models\Extra;
use Modules\Irentcar\Repositories\ExtraRepository;

class ExtraApiController extends CoreApiController
{
  public function __construct(Extra $model, ExtraRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
