<?php

namespace Modules\Ilocation\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Ilocation\Events\CreateLocation;
use Modules\Ilocation\Events\DeleteLocation;
use Modules\Ilocation\Events\Handlers\DeleteLocatable;
use Modules\Ilocation\Events\Handlers\StoreLocatable;
use Modules\Ilocation\Events\UpdateLocation;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array<string, array<int, string>>
     */
    protected $listen = [
        CreateLocation::class => [
            StoreLocatable::class,
        ],
        UpdateLocation::class => [
            StoreLocatable::class,
        ],
        DeleteLocation::class => [
            DeleteLocatable::class,
        ],
    ];

    /**
     * Indicates if events should be discovered.
     *
     * @var bool
     */
    protected static $shouldDiscoverEvents = true;

    /**
     * Configure the proper event listeners for email verification.
     */
    protected function configureEmailVerification(): void {}
}
