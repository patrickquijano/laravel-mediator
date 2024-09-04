<?php

declare(strict_types=1);

namespace LaravelMediator\Services\Mediator;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use LaravelMediator\Contracts\Services\Mediator\GetBusEventsService as GetBusEventsServiceContract;

class GetBusEventsService implements GetBusEventsServiceContract
{
    public function handle(?array $events): array
    {
        $collection = new Collection();
        if (! is_null($events)) {
            foreach ($events as $event => $listeners) {
                $collection->put($event, Str::replaceMatches('/@(handle|__invoke)/i', '', Arr::first($listeners)));
            }
        }

        return $collection->toArray();
    }
}
