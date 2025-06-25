<?php

namespace Modules\Itranslation\Services;

use Modules\Itranslation\Repositories\TranslationRepository;

class TranslationService
{

    public function get(string $key, array $replace = [], string $locale)
    {

        $translation = $this->getFromDatabase($key, $replace, $locale);

        //Not translation from DB. Set normal process
        if (is_null($translation)) {
            return trans($key, $replace, $locale);
        }

        return $translation;
    }

    private function getFromDatabase(string $key, array $replace, string $locale)
    {
        $translation = app(TranslationRepository::class)->getItem(
            $key,
            (object)['filter' => ['field' => 'key'], 'include' => ['translations']]
        );

        if ($translation && $translation->hasTranslation($locale)) {
            //Get translation from DB
            $phrase = $translation->translate($locale)->value;
            //Process to variables
            if (!empty($replace)) {
                foreach ($replace as $varKey => $val) {
                    $phrase = str_replace(':' . $varKey, $val, $phrase);
                }
            }
            return $phrase;
        }
        //Exist translation but not for this locale
        return null;
    }
}
