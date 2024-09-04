<?php

declare(strict_types=1);

namespace LaravelMediator\Providers;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\ServiceProvider as AbstractServiceProvider;
use LaravelMediator\Contracts\Services\Mediator\GetBusEventsService;
use LaravelMediator\Contracts\Services\Mediator\GetEventsService;

class LaravelMediatorServiceProvider extends AbstractServiceProvider
{
    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        \LaravelMediator\Contracts\Buses\CommandBus::class => \LaravelMediator\Buses\CommandBus::class,
        \LaravelMediator\Contracts\Buses\QueryBus::class => \LaravelMediator\Buses\QueryBus::class,
        \LaravelMediator\Contracts\Services\Mediator\GetBusEventsService::class => \LaravelMediator\Services\Mediator\GetBusEventsService::class,
        \LaravelMediator\Contracts\Services\Mediator\GetEventsService::class => \LaravelMediator\Services\Mediator\GetEventsService::class,
    ];

    public function boot(): void
    {
        $events = $this->app->make(GetEventsService::class)->handle();
        $busEvents = $this->app->make(GetBusEventsService::class)->handle($events);
        Bus::map($busEvents);
    }
}
