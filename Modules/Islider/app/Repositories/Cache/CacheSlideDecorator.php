<?php

namespace Modules\Islider\Repositories\Cache;

use Modules\Islider\Repositories\SlideRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheSlideDecorator extends CoreCacheDecorator implements SlideRepository
{
    public function __construct(SlideRepository $slide)
    {
        parent::__construct();
        $this->entityName = 'islider.slides';
        $this->repository = $slide;
    }
}
