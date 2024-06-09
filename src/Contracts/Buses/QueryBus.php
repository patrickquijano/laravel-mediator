<?php

declare(strict_types=1);

namespace PatrickQuijano\LaravelMediator\Contracts\Buses;

use PatrickQuijano\LaravelMediator\Abstracts\Buses\Query;

interface QueryBus
{
    public function dispatch(Query $query): mixed;
}
