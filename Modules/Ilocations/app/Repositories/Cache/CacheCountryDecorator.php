<?php

namespace Modules\Ilocations\Repositories\Cache;

use Modules\Ilocations\Repositories\CountryRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheCountryDecorator extends CoreCacheDecorator implements CountryRepository
{
    public function __construct(CountryRepository $country)
    {
        parent::__construct();
        $this->entityName = 'ilocations.countries';
        $this->repository = $country;
    }
}
