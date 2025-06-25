<?php

namespace Modules\Islider\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Islider\Models\Slide;
use Modules\Islider\Repositories\SlideRepository;

class SlideApiController extends CoreApiController
{
  public function __construct(Slide $model, SlideRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
