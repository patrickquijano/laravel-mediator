<?php

declare(strict_types=1);

namespace LaravelMediator\Buses;

use Illuminate\Support\Facades\Bus;
use LaravelMediator\Abstracts\Buses\Command;
use LaravelMediator\Contracts\Buses\CommandBus as CommandBusContract;

class CommandBus implements CommandBusContract
{
    public function dispatch(Command $command): mixed
    {
        return Bus::dispatch($command);
    }
}
