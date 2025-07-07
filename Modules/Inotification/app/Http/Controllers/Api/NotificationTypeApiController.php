<?php

namespace Modules\Inotification\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Inotification\Models\NotificationType;
use Modules\Inotification\Repositories\NotificationTypeRepository;

class NotificationTypeApiController extends CoreApiController
{
  public function __construct(NotificationType $model, NotificationTypeRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
