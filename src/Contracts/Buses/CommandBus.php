<?php

declare(strict_types=1);

namespace LaravelMediator\Contracts\Buses;

use LaravelMediator\Abstracts\Buses\Command;

interface CommandBus
{
    public function dispatch(Command $command): mixed;
}
