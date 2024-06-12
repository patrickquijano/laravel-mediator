<?php

declare(strict_types=1);

namespace LaravelMediator\Providers;

use Illuminate\Support\ServiceProvider as AbstractServiceProvider;

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
    ];
}
