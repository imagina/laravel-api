<?php

namespace Modules\Ilocation\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Ilocation\Models\Locatable;
use Modules\Ilocation\Repositories\LocatableRepository;

class LocatableApiController extends CoreApiController
{
  public function __construct(Locatable $model, LocatableRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
