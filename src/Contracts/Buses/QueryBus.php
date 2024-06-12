<?php

declare(strict_types=1);

namespace LaravelMediator\Contracts\Buses;

use LaravelMediator\Abstracts\Buses\Query;

interface QueryBus
{
    public function dispatch(Query $query): mixed;
}
