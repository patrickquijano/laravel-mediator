<?php

declare(strict_types=1);

namespace LaravelMediator\Services\Mediator;

use LaravelMediator\Contracts\Services\Mediator\GetClassFromFileService as GetClassFromFileServiceContract;

class GetClassFromFileService implements GetClassFromFileServiceContract
{
    public function handle(string $file): string
    {
        $content = file_get_contents($file);
        preg_match('/namespace\s+(.+?);/', $content, $namespaceMatches);
        preg_match('/class\s+(\w+)/', $content, $classMatches);
        $namespace = $namespaceMatches[1] ?? '';
        $class = $classMatches[1] ?? '';

        return $namespace.'\\'.$class;
    }
}
