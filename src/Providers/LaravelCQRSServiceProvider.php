<?php

declare(strict_types=1);

namespace PatrickQuijano\LaravelCQRS\Providers;

use Illuminate\Support\ServiceProvider as AbstractServiceProvider;

class LaravelCQRSServiceProvider extends AbstractServiceProvider
{
    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        \PatrickQuijano\LaravelCQRS\Contracts\Buses\CommandBus::class => \PatrickQuijano\LaravelCQRS\Buses\CommandBus::class,
        \PatrickQuijano\LaravelCQRS\Contracts\Buses\QueryBus::class => \PatrickQuijano\LaravelCQRS\Buses\QueryBus::class,
    ];
}
