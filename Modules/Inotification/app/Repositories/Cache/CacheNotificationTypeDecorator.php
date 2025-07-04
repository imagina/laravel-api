<?php

namespace Modules\Inotification\Repositories\Cache;

use Modules\Inotification\Repositories\NotificationTypeRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheNotificationTypeDecorator extends CoreCacheDecorator implements NotificationTypeRepository
{
    public function __construct(NotificationTypeRepository $notificationtype)
    {
        parent::__construct();
        $this->entityName = 'inotification.notificationtypes';
        $this->repository = $notificationtype;
    }
}
