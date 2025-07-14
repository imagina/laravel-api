<?php

namespace Modules\Ilocations\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Nwidart\Modules\Traits\PathNamespace;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
// Bindings
use Modules\Ilocations\Repositories\Eloquent\EloquentCountryRepository;
use Modules\Ilocations\Repositories\Cache\CacheCountryDecorator;
use Modules\Ilocations\Repositories\CountryRepository;
use Modules\Ilocations\Models\Country;
use Modules\Ilocations\Repositories\Eloquent\EloquentProvinceRepository;
use Modules\Ilocations\Repositories\Cache\CacheProvinceDecorator;
use Modules\Ilocations\Repositories\ProvinceRepository;
use Modules\Ilocations\Models\Province;
use Modules\Ilocations\Repositories\Eloquent\EloquentCityRepository;
use Modules\Ilocations\Repositories\Cache\CacheCityDecorator;
use Modules\Ilocations\Repositories\CityRepository;
use Modules\Ilocations\Models\City;
use Modules\Ilocations\Repositories\Eloquent\EloquentLocatableRepository;
use Modules\Ilocations\Repositories\Cache\CacheLocatableDecorator;
use Modules\Ilocations\Repositories\LocatableRepository;
use Modules\Ilocations\Models\Locatable;
// append-use-bindings





class IlocationsServiceProvider extends ServiceProvider
{
    use PathNamespace;

    protected string $name = 'Ilocations';

    protected string $nameLower = 'ilocations';

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->registerCommands();
        $this->registerCommandSchedules();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->name, 'database/migrations'));
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->register(EventServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
        $this->registerBindings();
    }

    /**
     * Register commands in the format of Command::class
     */
    protected function registerCommands(): void
    {
        // $this->commands([]);
    }

    /**
     * Register command Schedules.
     */
    protected function registerCommandSchedules(): void
    {
        // $this->app->booted(function () {
        //     $schedule = $this->app->make(Schedule::class);
        //     $schedule->command('inspire')->hourly();
        // });
    }

    /**
     * Register translations.
     */
    public function registerTranslations(): void
    {
        $langPath = base_path('resources/lang/modules/' . $this->nameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->nameLower);
        } else {
            $moduleLangPath = module_path($this->name, 'resources/lang');
            $this->loadTranslationsFrom($moduleLangPath, $this->nameLower);
        }
    }

    /**
     * Register config.
     */
    protected function registerConfig(): void
    {
        $configPath = module_path($this->name, config('modules.paths.generator.config.path'));

        if (is_dir($configPath)) {
            $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($configPath));

            foreach ($iterator as $file) {
                if ($file->isFile() && $file->getExtension() === 'php') {
                    $config = str_replace($configPath.DIRECTORY_SEPARATOR, '', $file->getPathname());
                    $config_key = str_replace([DIRECTORY_SEPARATOR, '.php'], ['.', ''], $config);
                    $segments = explode('.', $this->nameLower.'.'.$config_key);

                    // Remove duplicated adjacent segments
                    $normalized = [];
                    foreach ($segments as $segment) {
                        if (end($normalized) !== $segment) {
                            $normalized[] = $segment;
                        }
                    }

                    $key = ($config === 'config.php') ? $this->nameLower : implode('.', $normalized);

                    $this->publishes([$file->getPathname() => config_path($config)], 'config');
                    $this->merge_config_from($file->getPathname(), $key);
                }
            }
        }
    }

    /**
     * Merge config from the given path recursively.
     */
    protected function merge_config_from(string $path, string $key): void
    {
        $existing = config($key, []);
        $module_config = require $path;

        config([$key => array_replace_recursive($existing, $module_config)]);
    }

    /**
     * Register views.
     */
    public function registerViews(): void
    {
        $viewPath = resource_path('views/modules/'.$this->nameLower);
        $sourcePath = module_path($this->name, 'resources/views');

        $this->publishes([$sourcePath => $viewPath], ['views', $this->nameLower.'-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->nameLower);

        Blade::componentNamespace(config('modules.namespace').'\\' . $this->name . '\\View\\Components', $this->nameLower);
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (config('view.paths') as $path) {
            if (is_dir($path.'/modules/'.$this->nameLower)) {
                $paths[] = $path.'/modules/'.$this->nameLower;
            }
        }

        return $paths;
    }

    private function registerBindings(): void
    {
        $this->app->bind(CountryRepository::class, function () {
    $repository = new EloquentCountryRepository(new Country());

    return config('app.cache')
        ? new CacheCountryDecorator($repository)
        : $repository;
});
$this->app->bind(ProvinceRepository::class, function () {
    $repository = new EloquentProvinceRepository(new Province());

    return config('app.cache')
        ? new CacheProvinceDecorator($repository)
        : $repository;
});
$this->app->bind(CityRepository::class, function () {
    $repository = new EloquentCityRepository(new City());

    return config('app.cache')
        ? new CacheCityDecorator($repository)
        : $repository;
});
$this->app->bind(LocatableRepository::class, function () {
    $repository = new EloquentLocatableRepository(new Locatable());

    return config('app.cache')
        ? new CacheLocatableDecorator($repository)
        : $repository;
});
// append-bindings




    }
}
