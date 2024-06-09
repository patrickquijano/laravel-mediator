<?php

declare(strict_types=1);

namespace PatrickQuijano\LaravelMediator\Providers;

use Illuminate\Support\ServiceProvider as AbstractServiceProvider;

class LaravelMediatorServiceProvider extends AbstractServiceProvider
{
    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        \PatrickQuijano\LaravelMediator\Contracts\Buses\CommandBus::class => \PatrickQuijano\LaravelMediator\Buses\CommandBus::class,
        \PatrickQuijano\LaravelMediator\Contracts\Buses\QueryBus::class => \PatrickQuijano\LaravelMediator\Buses\QueryBus::class,
    ];
}
