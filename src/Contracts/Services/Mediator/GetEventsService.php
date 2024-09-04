<?php

declare(strict_types=1);

namespace LaravelMediator\Contracts\Services\Mediator;

interface GetEventsService
{
    public function handle(): ?array;
}
