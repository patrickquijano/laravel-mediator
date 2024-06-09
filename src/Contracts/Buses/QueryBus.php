<?php

declare(strict_types=1);

namespace PatrickQuijano\LaravelCQRS\Contracts\Buses;

use PatrickQuijano\LaravelCQRS\Abstracts\Buses\Query;

interface QueryBus
{
    public function dispatch(Query $query): mixed;
}
