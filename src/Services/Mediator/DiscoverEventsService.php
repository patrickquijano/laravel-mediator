<?php

declare(strict_types=1);

namespace LaravelMediator\Services\Mediator;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use LaravelMediator\Contracts\Services\Mediator\DiscoverEventsService as DiscoverEventsServiceContract;
use LaravelMediator\Contracts\Services\Mediator\GetClassFromFileService;
use LaravelMediator\Contracts\Services\Mediator\GetEventForListenerService;
use Symfony\Component\Finder\Finder;

class DiscoverEventsService implements DiscoverEventsServiceContract
{
    public function __construct(
        private readonly Finder $finder,
        private readonly GetClassFromFileService $getClassFromFileService,
        private readonly GetEventForListenerService $getEventForListenerService
    ) {
    }

    public function handle(): array
    {
        $paths = Config::get('mediator.paths', []);
        $eventsMap = [];
        foreach ($paths as $path) {
            $this->finder->files()->in($path);
            foreach ($this->finder as $file) {
                $class = $this->getClassFromFileService->handle($file->getRealPath());
                if (Str::endsWith($file->getFilename(), 'Listener.php')) {
                    $event = $this->getEventForListenerService->handle($class);
                    if ($event) {
                        $eventsMap[$event] = $class;
                    }
                }
            }
        }

        return $eventsMap;
    }
}
