<?php

namespace Modules\Ilocation\Repositories\Cache;

use Modules\Ilocation\Repositories\CountryRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheCountryDecorator extends CoreCacheDecorator implements CountryRepository
{
    public function __construct(CountryRepository $country)
    {
        parent::__construct();
        $this->entityName = 'ilocation.countries';
        $this->repository = $country;
    }
}
