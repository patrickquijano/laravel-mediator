<?php

declare(strict_types=1);

namespace LaravelMediator\Services\Mediator;

use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Illuminate\Support\Facades\App;
use LaravelMediator\Contracts\Services\Mediator\GetEventsService as GetEventsServiceContract;

class GetEventsService implements GetEventsServiceContract
{
    public function handle(): ?array
    {
        /** @var \Illuminate\Foundation\Support\Providers\EventServiceProvider */
        $eventServiceProvider = App::getProvider(EventServiceProvider::class);
        // dd($eventServiceProvider);

        return $eventServiceProvider?->getEvents();
    }
}
