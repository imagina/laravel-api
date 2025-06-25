<?php

/**
 * Return the supported locales from the Laravel localization configuration
 */
if (!function_exists('getSupportedLocales')) {

    function getSupportedLocales(): array
    {
        return config('app.supportedLocales', []);
    }
}

/**
 * Get translations for a given key. (Database or File)
 */
if (!function_exists('itrans')) {

    function itrans(string $key, array $replace = [], ?string $locale = null): string
    {

        $locale = $locale ?: app()->getLocale();
        $translationService = app('Modules\Itranslation\Services\TranslationService');

        return $translationService->get($key, $replace, $locale);
    }
}
