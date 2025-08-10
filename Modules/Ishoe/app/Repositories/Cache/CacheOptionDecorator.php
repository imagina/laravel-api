<?php

namespace Modules\Ishoe\Repositories\Cache;

use Modules\Ishoe\Repositories\OptionRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheOptionDecorator extends CoreCacheDecorator implements OptionRepository
{
    public function __construct(OptionRepository $option)
    {
        parent::__construct();
        $this->entityName = 'ishoe.options';
        $this->repository = $option;
    }
}
