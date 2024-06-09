<?php

declare(strict_types=1);

namespace PatrickQuijano\LaravelMediator\Buses;

use Illuminate\Support\Facades\Bus;
use PatrickQuijano\LaravelMediator\Abstracts\Buses\Query;
use PatrickQuijano\LaravelMediator\Contracts\Buses\QueryBus as QueryBusContract;

class QueryBus implements QueryBusContract
{
    public function dispatch(Query $query): mixed
    {
        return Bus::dispatch($query);
    }
}
