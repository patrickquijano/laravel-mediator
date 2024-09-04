<?php

declare(strict_types=1);

namespace LaravelMediator\Contracts\Services\Mediator;

interface GetBusEventsService
{
    public function handle(array $events): array;
}
