<?php

namespace Modules\Itranslation\Repositories\Cache;

use Modules\Itranslation\Repositories\TranslationRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheTranslationDecorator extends CoreCacheDecorator implements TranslationRepository
{
    public function __construct(TranslationRepository $translation)
    {
        parent::__construct();
        $this->entityName = 'itranslation.translations';
        $this->repository = $translation;
    }
}
