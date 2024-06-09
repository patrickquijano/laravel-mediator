<?php

declare(strict_types=1);

namespace PatrickQuijano\LaravelCQRS\Facades;

use Illuminate\Support\Facades\Facade as AbstractFacade;
use PatrickQuijano\LaravelCQRS\Contracts\Buses\QueryBus as BusesQueryBus;

class QueryBus extends AbstractFacade
{
    protected static function getFacadeAccessor()
    {
        return BusesQueryBus::class;
    }
}
