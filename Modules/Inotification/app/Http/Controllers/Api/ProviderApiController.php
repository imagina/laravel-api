<?php

namespace Modules\Inotification\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Inotification\Models\Provider;
use Modules\Inotification\Repositories\ProviderRepository;

class ProviderApiController extends CoreApiController
{
  public function __construct(Provider $model, ProviderRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
