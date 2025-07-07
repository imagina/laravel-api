<?php

namespace Modules\Inotification\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Inotification\Models\Notification;
use Modules\Inotification\Repositories\NotificationRepository;

class NotificationApiController extends CoreApiController
{
  public function __construct(Notification $model, NotificationRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
