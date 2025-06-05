<?php

namespace Modules\Isetting\Repositories\Cache;

use Modules\Isetting\Repositories\SettingRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheSettingDecorator extends CoreCacheDecorator implements SettingRepository
{
    public function __construct(SettingRepository $setting)
    {
        parent::__construct();
        $this->entityName = 'isetting.settings';
        $this->repository = $setting;
    }
}
