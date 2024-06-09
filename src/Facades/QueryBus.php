<?php

declare(strict_types=1);

namespace PatrickQuijano\LaravelMediator\Facades;

use Illuminate\Support\Facades\Facade as AbstractFacade;
use PatrickQuijano\LaravelMediator\Contracts\Buses\QueryBus as BusesQueryBus;

class QueryBus extends AbstractFacade
{
    protected static function getFacadeAccessor()
    {
        return BusesQueryBus::class;
    }
}
