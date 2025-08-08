<?php

namespace Modules\Isetting\Services;

use Modules\Isetting\Repositories\SettingRepository;
use Modules\Isetting\Models\Setting;

class SettingsService
{
    /**
     * @param string $systemName
     * @param mixed|null $default
     * @param string|null $locale
     * @return mixed
     */
    public function get(string $systemName, mixed $default = null, ?string $locale = null): mixed
    {
        $configDefault = $this->getFromConfig($systemName, $default);
        $setting = $this->getFromDatabase($systemName);

        if (is_null($setting)) {
            return $configDefault;
        }

        //TODO: Include validation with MEDIA
        if ($setting->is_translatable) {
            $locale = $locale ?: app()->getLocale();
            return $setting->hasTranslation($locale) ? $setting->translate($locale)->value : $configDefault;
        } else {
            return $setting->plain_value ?: $configDefault;
        }
    }

    /**
     * @param string $systemName
     * @param mixed|null $default
     * @return mixed
     */
    public function getFromConfig(string $systemName, mixed $default = null): mixed
    {
        [$module, $key] = explode('::', $systemName, 2);
        return config("$module.settings.$key.default", $default);
    }

    /**
     * @param string $systemName
     * @param mixed|null $default
     * @return mixed
     */
    public function getFromDatabase(string $systemName, mixed $default = null): mixed
    {
        if (env('DB_DATABASE', 'forge') === 'forge') {
            return $default;
        }

        //Retrieve all settings on the first request, then cache the result for subsequent access.
        $settings = app(SettingRepository::class)->getItemsBy((object)['include' => ['translations']]);

        //Search the setting
        $setting = $settings->firstWhere('system_name', $systemName);

        return $setting ?: $default;
    }


    /**
     * Summary of getFormatedSettings
     * @param mixed $configSettings
     * @param mixed $dbSettings
     */
    public function getFormatedSettings($configSettings, $dbSettings)
    {
        $settings = collect();
        $locales = getSupportedLocales();

        foreach ($configSettings as $config) {
            //Validation to Exist or not in DB
            $existSettingInDB = $dbSettings->firstWhere('system_name', $config['name']);
            if ($existSettingInDB) {
                $setting = clone $existSettingInDB;
            } else {
                $setting = $this->buildFromConfig($config['name'], $config, $locales);
            }

            //Add Translations
            $configWithTranslations = $this->translateConfigLabels($config);

            //Add data from config
            $setting->dataConfig = $configWithTranslations;

            //Final Setting Formated
            $settings->push($setting);
        }

        return $settings;
    }

    /**
     * Build a setting with data from config
     * @param string $key
     * @param array $config
     * @param mixed $locales
     * @return Setting
     */
    private function buildFromConfig(string $key, array $config, $locales): Setting
    {

        $setting = new Setting();
        $setting->system_name = $key;
        $setting->is_translatable = false;
        $setting->plain_value = $config['default'] ?? null;

        // If translatable, you could simulate translations
        if (isset($config['translatable']) && $config['translatable']) {
            $setting->is_translatable = true;

            // Optional: add fake translations for all supported locales
            foreach ($locales  as $locale => $language) {
                $setting->translateOrNew($locale)->value = $config['default'] ?? null;
            }
        }

        return $setting;
    }

    /**
     * Get translations for label,hint etc
     * @param array $config
     * @return array
     */
    function translateConfigLabels(array $config): array
    {
        foreach ($config as $key => &$value) {
            if (is_array($value)) {
                //Recursividad
                $value = $this->translateConfigLabels($value);
            } elseif (in_array($key, ['label', 'hint', 'groupTitle']) && is_string($value)) {
                //Get translation
                $value = itrans($value);
            }
        }
        return $config;
    }
}
