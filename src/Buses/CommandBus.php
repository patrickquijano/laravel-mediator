<?php

declare(strict_types=1);

namespace PatrickQuijano\LaravelCQRS\Buses;

use Illuminate\Support\Facades\Bus;
use PatrickQuijano\LaravelCQRS\Abstracts\Buses\Command;
use PatrickQuijano\LaravelCQRS\Contracts\Buses\CommandBus as CommandBusContract;

class CommandBus implements CommandBusContract
{
    public function dispatch(Command $command): mixed
    {
        return Bus::dispatch($command);
    }
}
