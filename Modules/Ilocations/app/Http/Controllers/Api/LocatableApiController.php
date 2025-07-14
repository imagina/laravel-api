<?php

namespace Modules\Ilocations\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Ilocations\Models\Locatable;
use Modules\Ilocations\Repositories\LocatableRepository;

class LocatableApiController extends CoreApiController
{
  public function __construct(Locatable $model, LocatableRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
