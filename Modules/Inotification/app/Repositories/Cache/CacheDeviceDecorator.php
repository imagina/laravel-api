<?php

namespace Modules\Inotification\Repositories\Cache;

use Modules\Inotification\Repositories\DeviceRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheDeviceDecorator extends CoreCacheDecorator implements DeviceRepository
{
    public function __construct(DeviceRepository $device)
    {
        parent::__construct();
        $this->entityName = 'inotification.devices';
        $this->repository = $device;
    }
}
