<?php

declare(strict_types=1);

namespace LaravelMediator\Tests\Unit\Services\Mediator;

use LaravelMediator\Services\Mediator\GetBusEventsService;
use LaravelMediator\Tests\Unit\TestCase as AbstractTestCase;

class GetBusEventsServiceTest extends AbstractTestCase
{
    public function test_handle_returns_empty_array_when_no_events()
    {
        // Act
        $service = new GetBusEventsService();
        $actual = $service->handle(null);
        // Assert
        $this->assertIsArray($actual);
        $this->assertEmpty($actual);
    }

    public function test_handle_returns_formatted_events()
    {
        // Arrange
        $events = [
            'App\Events\SomeEvent' => [
                'App\Listeners\SomeListener@handle',
            ],
        ];
        // Act
        $service = new GetBusEventsService();
        $actual = $service->handle($events);
        // Assert
        $this->assertIsArray($actual);
        $this->assertArrayHasKey('App\Events\SomeEvent', $actual);
        $this->assertEquals('App\Listeners\SomeListener', $actual['App\Events\SomeEvent']);
    }
}
