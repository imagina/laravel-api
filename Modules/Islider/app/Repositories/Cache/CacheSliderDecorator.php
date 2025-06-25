<?php

namespace Modules\Islider\Repositories\Cache;

use Modules\Islider\Repositories\SliderRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheSliderDecorator extends CoreCacheDecorator implements SliderRepository
{
    public function __construct(SliderRepository $slider)
    {
        parent::__construct();
        $this->entityName = 'islider.sliders';
        $this->repository = $slider;
    }
}
