<?php

declare(strict_types=1);

namespace LaravelMediator\Tests\Unit\Services\Mediator;

use LaravelMediator\Services\Mediator\GetEventForListenerService;
use PHPUnit\Framework\TestCase;

class GetEventForListenerServiceTest extends TestCase
{
    public function test_handle_returns_event_class_name()
    {
        // Arrange
        $service = new GetEventForListenerService();
        $listener = new class
        {
            public function handle(\App\Events\UserRegistered $event)
            {
            }
        };
        // Act
        $result = $service->handle(get_class($listener));
        // Assert
        $this->assertEquals(\App\Events\UserRegistered::class, $result);
    }

    public function test_handle_returns_null_when_no_parameters()
    {
        // Arrange
        $service = new GetEventForListenerService();
        $listener = new class
        {
            public function handle()
            {
            }
        };
        // Act
        $result = $service->handle(get_class($listener));
        // Assert
        $this->assertNull($result);
    }

    public function test_handle_returns_null_when_no_type_hint()
    {
        // Arrange
        $service = new GetEventForListenerService();
        $listener = new class
        {
            public function handle($event)
            {
            }
        };
        // Act
        $result = $service->handle(get_class($listener));
        // Assert
        $this->assertNull($result);
    }
}
