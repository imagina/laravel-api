<?php

namespace Modules\Inotification\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Nwidart\Modules\Traits\PathNamespace;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
// Bindings
use Modules\Inotification\Repositories\Eloquent\EloquentNotificationRepository;
use Modules\Inotification\Repositories\Cache\CacheNotificationDecorator;
use Modules\Inotification\Repositories\NotificationRepository;
use Modules\Inotification\Models\Notification;
use Modules\Inotification\Repositories\Eloquent\EloquentProviderRepository;
use Modules\Inotification\Repositories\Cache\CacheProviderDecorator;
use Modules\Inotification\Repositories\ProviderRepository;
use Modules\Inotification\Models\Provider;
use Modules\Inotification\Repositories\Eloquent\EloquentNotificationTypeRepository;
use Modules\Inotification\Repositories\Cache\CacheNotificationTypeDecorator;
use Modules\Inotification\Repositories\NotificationTypeRepository;
use Modules\Inotification\Models\NotificationType;
use Modules\Inotification\Repositories\Eloquent\EloquentDeviceRepository;
use Modules\Inotification\Repositories\Cache\CacheDeviceDecorator;
use Modules\Inotification\Repositories\DeviceRepository;
use Modules\Inotification\Models\Device;
// append-use-bindings





class InotificationServiceProvider extends ServiceProvider
{
    use PathNamespace;

    protected string $name = 'Inotification';

    protected string $nameLower = 'inotification';

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
                    $config = str_replace($configPath . DIRECTORY_SEPARATOR, '', $file->getPathname());
                    $config_key = str_replace([DIRECTORY_SEPARATOR, '.php'], ['.', ''], $config);
                    $segments = explode('.', $this->nameLower . '.' . $config_key);

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
        $viewPath = resource_path('views/modules/' . $this->nameLower);
        $sourcePath = module_path($this->name, 'resources/views');

        $this->publishes([$sourcePath => $viewPath], ['views', $this->nameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->nameLower);

        Blade::componentNamespace(config('modules.namespace') . '\\' . $this->name . '\\View\\Components', $this->nameLower);
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
            if (is_dir($path . '/modules/' . $this->nameLower)) {
                $paths[] = $path . '/modules/' . $this->nameLower;
            }
        }

        return $paths;
    }

    private function registerBindings(): void
    {
        $this->app->bind(NotificationRepository::class, function () {
            $repository = new EloquentNotificationRepository(new Notification());

            return config('app.cache')
                ? new CacheNotificationDecorator($repository)
                : $repository;
        });
        $this->app->bind(ProviderRepository::class, function () {
            $repository = new EloquentProviderRepository(new Provider());

            return config('app.cache')
                ? new CacheProviderDecorator($repository)
                : $repository;
        });
        $this->app->bind(NotificationTypeRepository::class, function () {
            $repository = new EloquentNotificationTypeRepository(new NotificationType());

            return config('app.cache')
                ? new CacheNotificationTypeDecorator($repository)
                : $repository;
        });
        $this->app->bind(DeviceRepository::class, function () {
            $repository = new EloquentDeviceRepository(new Device());

            return config('app.cache')
                ? new CacheDeviceDecorator($repository)
                : $repository;
        });
        // append-bindings




    }
}
