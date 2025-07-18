<?php

namespace Modules\Iform\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Nwidart\Modules\Traits\PathNamespace;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
// Bindings
use Modules\Iform\Repositories\Eloquent\EloquentBlockRepository;
use Modules\Iform\Repositories\Cache\CacheBlockDecorator;
use Modules\Iform\Repositories\BlockRepository;
use Modules\Iform\Models\Block;
use Modules\Iform\Repositories\Eloquent\EloquentFieldRepository;
use Modules\Iform\Repositories\Cache\CacheFieldDecorator;
use Modules\Iform\Repositories\FieldRepository;
use Modules\Iform\Models\Field;
use Modules\Iform\Repositories\Eloquent\EloquentFormRepository;
use Modules\Iform\Repositories\Cache\CacheFormDecorator;
use Modules\Iform\Repositories\FormRepository;
use Modules\Iform\Models\Form;
use Modules\Iform\Repositories\Eloquent\EloquentLeadRepository;
use Modules\Iform\Repositories\Cache\CacheLeadDecorator;
use Modules\Iform\Repositories\LeadRepository;
use Modules\Iform\Models\Lead;
use Modules\Iform\Repositories\Eloquent\EloquentTypeRepository;
use Modules\Iform\Repositories\Cache\CacheTypeDecorator;
use Modules\Iform\Repositories\TypeRepository;
use Modules\Iform\Models\Type;
// append-use-bindings






class IformServiceProvider extends ServiceProvider
{
    use PathNamespace;

    protected string $name = 'Iform';

    protected string $nameLower = 'iform';

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
        $this->app->bind(BlockRepository::class, function () {
            $repository = new EloquentBlockRepository(new Block());

            return config('app.cache')
                ? new CacheBlockDecorator($repository)
                : $repository;
        });
        $this->app->bind(FieldRepository::class, function () {
            $repository = new EloquentFieldRepository(new Field());

            return config('app.cache')
                ? new CacheFieldDecorator($repository)
                : $repository;
        });
        $this->app->bind(FormRepository::class, function () {
            $repository = new EloquentFormRepository(new Form());

            return config('app.cache')
                ? new CacheFormDecorator($repository)
                : $repository;
        });
        $this->app->bind(LeadRepository::class, function () {
            $repository = new EloquentLeadRepository(new Lead());

            return config('app.cache')
                ? new CacheLeadDecorator($repository)
                : $repository;
        });
        $this->app->bind(TypeRepository::class, function () {
            $repository = new EloquentTypeRepository(new Type());

            return config('app.cache')
                ? new CacheTypeDecorator($repository)
                : $repository;
        });
        // append-bindings





    }
}
