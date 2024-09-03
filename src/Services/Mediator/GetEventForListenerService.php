<?php

declare(strict_types=1);

namespace LaravelMediator\Services\Mediator;

use LaravelMediator\Contracts\Services\Mediator\GetEventForListenerService as GetEventForListenerServiceContract;
use ReflectionClass;

class GetEventForListenerService implements GetEventForListenerServiceContract
{
    public function handle(string $listener): ?string
    {
        $reflection = new ReflectionClass($listener);
        $method = $reflection->getMethod('handle');
        if ($method->getNumberOfParameters() === 0) {
            return null;
        }
        $parameter = $method->getParameters()[0];
        $type = $parameter->getType();
        if ($type === null) {
            return null;
        }

        return $type->getName();
    }
}
