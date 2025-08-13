<?php

namespace Modules\Iredirect\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Iredirect\Models\Redirect;
use Modules\Iredirect\Repositories\RedirectRepository;

class RedirectApiController extends CoreApiController
{
  public function __construct(Redirect $model, RedirectRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
