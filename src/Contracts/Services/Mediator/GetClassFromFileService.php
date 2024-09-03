<?php

declare(strict_types=1);

namespace LaravelMediator\Contracts\Services\Mediator;

interface GetClassFromFileService
{
    public function handle(string $file): string;
}
