<?php

declare(strict_types=1);

namespace PatrickQuijano\LaravelMediator\Buses;

use Illuminate\Support\Facades\Bus;
use PatrickQuijano\LaravelMediator\Abstracts\Buses\Command;
use PatrickQuijano\LaravelMediator\Contracts\Buses\CommandBus as CommandBusContract;

class CommandBus implements CommandBusContract
{
    public function dispatch(Command $command): mixed
    {
        return Bus::dispatch($command);
    }
}
