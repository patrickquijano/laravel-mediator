<?php

declare(strict_types=1);

namespace PatrickQuijano\LaravelCQRS\Contracts\Buses;

use PatrickQuijano\LaravelCQRS\Abstracts\Buses\Command;

interface CommandBus
{
    public function dispatch(Command $command): mixed;
}
