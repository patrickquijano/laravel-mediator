<?php

declare(strict_types=1);

namespace LaravelMediator\Contracts\Services\Mediator;

interface DiscoverEventsService
{
    public function handle(): array;
}
