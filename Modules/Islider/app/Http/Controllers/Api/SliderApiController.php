<?php

namespace Modules\Islider\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Islider\Models\Slider;
use Modules\Islider\Repositories\SliderRepository;

class SliderApiController extends CoreApiController
{
  public function __construct(Slider $model, SliderRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
