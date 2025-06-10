<?php

namespace Modules\Isetting\Services;

use Modules\Isetting\Repositories\SettingRepository;

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

        $setting = app(SettingRepository::class)->getItem(
            $systemName,
            (object)['filter' => ['field' => 'system_name'], 'include' => ['translations']]
        );

        return $setting ?: $default;
    }
}
