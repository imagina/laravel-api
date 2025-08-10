<?php

namespace Modules\Ishoe\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Ishoe\Models\Shoe;
use Modules\Ishoe\Repositories\ShoeRepository;

class ShoeApiController extends CoreApiController
{
  public function __construct(Shoe $model, ShoeRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
