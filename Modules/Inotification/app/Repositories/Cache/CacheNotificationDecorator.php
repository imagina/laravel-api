<?php

namespace Modules\Inotification\Repositories\Cache;

use Modules\Inotification\Repositories\NotificationRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheNotificationDecorator extends CoreCacheDecorator implements NotificationRepository
{
    public function __construct(NotificationRepository $notification)
    {
        parent::__construct();
        $this->entityName = 'inotification.notifications';
        $this->repository = $notification;
    }
}
