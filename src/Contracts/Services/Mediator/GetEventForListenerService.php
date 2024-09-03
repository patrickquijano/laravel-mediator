<?php

declare(strict_types=1);

namespace LaravelMediator\Contracts\Services\Mediator;

interface GetEventForListenerService
{
    public function handle(string $listener): ?string;
}
