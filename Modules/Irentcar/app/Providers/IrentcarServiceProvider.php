<?php

namespace Modules\Irentcar\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Nwidart\Modules\Traits\PathNamespace;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
// Bindings
use Modules\Irentcar\Repositories\Eloquent\EloquentOfficeRepository;
use Modules\Irentcar\Repositories\Cache\CacheOfficeDecorator;
use Modules\Irentcar\Repositories\OfficeRepository;
use Modules\Irentcar\Models\Office;
use Modules\Irentcar\Repositories\Eloquent\EloquentGammaRepository;
use Modules\Irentcar\Repositories\Cache\CacheGammaDecorator;
use Modules\Irentcar\Repositories\GammaRepository;
use Modules\Irentcar\Models\Gamma;
use Modules\Irentcar\Repositories\Eloquent\EloquentExtraRepository;
use Modules\Irentcar\Repositories\Cache\CacheExtraDecorator;
use Modules\Irentcar\Repositories\ExtraRepository;
use Modules\Irentcar\Models\Extra;
use Modules\Irentcar\Repositories\Eloquent\EloquentGammaOfficeRepository;
use Modules\Irentcar\Repositories\Cache\CacheGammaOfficeDecorator;
use Modules\Irentcar\Repositories\GammaOfficeRepository;
use Modules\Irentcar\Models\GammaOffice;
use Modules\Irentcar\Repositories\Eloquent\EloquentDailyAvailabilityRepository;
use Modules\Irentcar\Repositories\Cache\CacheDailyAvailabilityDecorator;
use Modules\Irentcar\Repositories\DailyAvailabilityRepository;
use Modules\Irentcar\Models\DailyAvailability;
use Modules\Irentcar\Repositories\Eloquent\EloquentGammaOfficeExtraRepository;
use Modules\Irentcar\Repositories\Cache\CacheGammaOfficeExtraDecorator;
use Modules\Irentcar\Repositories\GammaOfficeExtraRepository;
use Modules\Irentcar\Models\GammaOfficeExtra;
use Modules\Irentcar\Repositories\Eloquent\EloquentReservationRepository;
use Modules\Irentcar\Repositories\Cache\CacheReservationDecorator;
use Modules\Irentcar\Repositories\ReservationRepository;
use Modules\Irentcar\Models\Reservation;
// append-use-bindings








class IrentcarServiceProvider extends ServiceProvider
{
    use PathNamespace;

    protected string $name = 'Irentcar';

    protected string $nameLower = 'irentcar';

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
        $this->loadMigrationsFrom(module_path($this->name, 'database/Migrations'));
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
        $this->app->bind(OfficeRepository::class, function () {
    $repository = new EloquentOfficeRepository(new Office());

    return config('app.cache')
        ? new CacheOfficeDecorator($repository)
        : $repository;
});
$this->app->bind(GammaRepository::class, function () {
    $repository = new EloquentGammaRepository(new Gamma());

    return config('app.cache')
        ? new CacheGammaDecorator($repository)
        : $repository;
});
$this->app->bind(ExtraRepository::class, function () {
    $repository = new EloquentExtraRepository(new Extra());

    return config('app.cache')
        ? new CacheExtraDecorator($repository)
        : $repository;
});
$this->app->bind(GammaOfficeRepository::class, function () {
    $repository = new EloquentGammaOfficeRepository(new GammaOffice());

    return config('app.cache')
        ? new CacheGammaOfficeDecorator($repository)
        : $repository;
});
$this->app->bind(DailyAvailabilityRepository::class, function () {
    $repository = new EloquentDailyAvailabilityRepository(new DailyAvailability());

    return config('app.cache')
        ? new CacheDailyAvailabilityDecorator($repository)
        : $repository;
});
$this->app->bind(GammaOfficeExtraRepository::class, function () {
    $repository = new EloquentGammaOfficeExtraRepository(new GammaOfficeExtra());

    return config('app.cache')
        ? new CacheGammaOfficeExtraDecorator($repository)
        : $repository;
});
$this->app->bind(ReservationRepository::class, function () {
    $repository = new EloquentReservationRepository(new Reservation());

    return config('app.cache')
        ? new CacheReservationDecorator($repository)
        : $repository;
});
// append-bindings







    }
}
