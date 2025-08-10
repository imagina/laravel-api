<?php

namespace Modules\Ishoe\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Ishoe\Models\Option;
use Modules\Ishoe\Repositories\OptionRepository;

class OptionApiController extends CoreApiController
{
  public function __construct(Option $model, OptionRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
