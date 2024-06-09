<?php

declare(strict_types=1);

namespace PatrickQuijano\LaravelMediator\Contracts\Buses;

use PatrickQuijano\LaravelMediator\Abstracts\Buses\Command;

interface CommandBus
{
    public function dispatch(Command $command): mixed;
}
