<?php

declare(strict_types=1);

namespace LaravelMediator\Providers;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider as AbstractServiceProvider;
use LaravelMediator\Contracts\Services\Mediator\DiscoverEventsService;

class LaravelMediatorServiceProvider extends AbstractServiceProvider
{
    public const CACHE_KEY = 'event-listeners-map';

    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        \LaravelMediator\Contracts\Buses\CommandBus::class => \LaravelMediator\Buses\CommandBus::class,
        \LaravelMediator\Contracts\Buses\QueryBus::class => \LaravelMediator\Buses\QueryBus::class,
        \LaravelMediator\Contracts\Services\Mediator\DiscoverEventsService::class => \LaravelMediator\Services\Mediator\DiscoverEventsService::class,
        \LaravelMediator\Contracts\Services\Mediator\GetClassFromFileService::class => \LaravelMediator\Services\Mediator\GetClassFromFileService::class,
        \LaravelMediator\Contracts\Services\Mediator\GetEventForListenerService::class => \LaravelMediator\Services\Mediator\GetEventForListenerService::class,
    ];

    public function boot(): void
    {
        $this->publishes([__DIR__.'/../../config/mediator.php' => config_path('mediator.php')], 'mediator-config');
        $eventsMap = Cache::rememberForever(self::CACHE_KEY, function () {
            return $this->app->make(DiscoverEventsService::class)->handle();
        });
        Bus::map($eventsMap);
    }
}
