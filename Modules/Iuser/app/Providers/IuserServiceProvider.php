<?php

namespace Modules\Iuser\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Nwidart\Modules\Traits\PathNamespace;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
// Bindings
use Modules\Iuser\Repositories\Eloquent\EloquentUsersRepository;
use Modules\Iuser\Repositories\Cache\CacheUsersDecorator;
use Modules\Iuser\Repositories\UsersRepository;
use Modules\Iuser\Models\Users;
use Modules\Iuser\Repositories\Eloquent\EloquentUserRepository;
use Modules\Iuser\Repositories\Cache\CacheUserDecorator;
use Modules\Iuser\Repositories\UserRepository;
use Modules\Iuser\Models\User;
use Modules\Iuser\Repositories\Eloquent\EloquentRoleRepository;
use Modules\Iuser\Repositories\Cache\CacheRoleDecorator;
use Modules\Iuser\Repositories\RoleRepository;
use Modules\Iuser\Models\Role;
// append-use-bindings

use Modules\Iuser\Http\Middleware\AuthCan;

use Laravel\Passport\Passport;
use Carbon\CarbonInterval;

use Modules\Iuser\Console\CreateSuperAdmin;

class IuserServiceProvider extends ServiceProvider
{
    use PathNamespace;

    protected string $name = 'Iuser';

    protected string $nameLower = 'iuser';

    protected $middleware = [
        'auth-can' =>  AuthCan::class
    ];

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->registerMiddleware();
        $this->registerPassportConfigurations();
        $this->registerCommands();
        $this->registerCommandSchedules();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->name, 'database/Migrations'));
    }

    /**
     * Register the middleware.
     */
    private function registerMiddleware()
    {
        foreach ($this->middleware as $name => $class) {
            $this->app['router']->aliasMiddleware($name, $class);
        }
    }

    /**
     * Register Passport configurations.
     */
    protected function registerPassportConfigurations(): void
    {

        Passport::enablePasswordGrant();

        $hours = app()->environment('local') ? 12 : config('passport.tokensExpireIn', 1);

        Passport::tokensExpireIn(CarbonInterval::hours($hours));
        Passport::refreshTokensExpireIn(CarbonInterval::days(config('passport.refreshTokensExpireIn', 7)));
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
        $this->commands([
            CreateSuperAdmin::class
        ]);
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
            $this->loadTranslationsFrom($moduleLangPath, 'iuser');
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
        $sourcePath = module_path($this->name, '$resources/views$');

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

        $this->app->bind(UserRepository::class, function () {
            $repository = new EloquentUserRepository(new User());

            return config('app.cache')
                ? new CacheUserDecorator($repository)
                : $repository;
        });
        $this->app->bind(RoleRepository::class, function () {
            $repository = new EloquentRoleRepository(new Role());

            return config('app.cache')
                ? new CacheRoleDecorator($repository)
                : $repository;
        });
        // append-bindings



    }
}
