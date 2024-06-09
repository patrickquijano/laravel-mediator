<?php

declare(strict_types=1);

namespace PatrickQuijano\LaravelCQRS\Buses;

use Illuminate\Support\Facades\Bus;
use PatrickQuijano\LaravelCQRS\Abstracts\Buses\Query;
use PatrickQuijano\LaravelCQRS\Contracts\Buses\QueryBus as QueryBusContract;

class QueryBus implements QueryBusContract
{
    public function dispatch(Query $query): mixed
    {
        return Bus::dispatch($query);
    }
}
