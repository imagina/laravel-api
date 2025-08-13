<?php

namespace Modules\Iredirect\Repositories\Cache;

use Modules\Iredirect\Repositories\RedirectRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheRedirectDecorator extends CoreCacheDecorator implements RedirectRepository
{
    public function __construct(RedirectRepository $redirect)
    {
        parent::__construct();
        $this->entityName = 'iredirect.redirects';
        $this->repository = $redirect;
    }
}
