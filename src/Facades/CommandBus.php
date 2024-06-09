<?php

declare(strict_types=1);

namespace PatrickQuijano\LaravelMediator\Facades;

use Illuminate\Support\Facades\Facade as AbstractFacade;
use PatrickQuijano\LaravelMediator\Contracts\Buses\CommandBus as BusesCommandBus;

class CommandBus extends AbstractFacade
{
    protected static function getFacadeAccessor()
    {
        return BusesCommandBus::class;
    }
}
