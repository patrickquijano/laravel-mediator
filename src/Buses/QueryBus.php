<?php

declare(strict_types=1);

namespace LaravelMediator\Buses;

use Illuminate\Support\Facades\Bus;
use LaravelMediator\Abstracts\Buses\Query;
use LaravelMediator\Contracts\Buses\QueryBus as QueryBusContract;

class QueryBus implements QueryBusContract
{
    public function dispatch(Query $query): mixed
    {
        return Bus::dispatch($query);
    }
}
