<?php

declare(strict_types=1);

namespace PatrickQuijano\LaravelCQRS\Facades;

use Illuminate\Support\Facades\Facade as AbstractFacade;
use PatrickQuijano\LaravelCQRS\Contracts\Buses\CommandBus as BusesCommandBus;

class CommandBus extends AbstractFacade
{
    protected static function getFacadeAccessor()
    {
        return BusesCommandBus::class;
    }
}
