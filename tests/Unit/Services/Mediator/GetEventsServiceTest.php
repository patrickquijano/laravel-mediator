<?php

declare(strict_types=1);

namespace LaravelMediator\Tests\Unit\Services\Mediator;

use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Illuminate\Support\Facades\App;
use LaravelMediator\Services\Mediator\GetEventsService;
use LaravelMediator\Tests\Unit\TestCase as AbstractTestCase;
use Mockery;

class GetEventsServiceTest extends AbstractTestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_handle_method_returns_events()
    {
        // Arrange
        $mockEventServiceProvider = Mockery::mock(EventServiceProvider::class);
        $mockEventServiceProvider->shouldReceive('getEvents')
            ->once()
            ->andReturn(['event' => 'listener']);
        App::shouldReceive('getProvider')
            ->once()
            ->with(EventServiceProvider::class)
            ->andReturn($mockEventServiceProvider);
        // Act
        $service = new GetEventsService();
        $actual = $service->handle();
        // Assert
        $this->assertIsArray($actual);
        $this->assertArrayHasKey('event', $actual);
    }

    public function test_handle_method_returns_null_when_no_provider()
    {
        // Arrange
        App::shouldReceive('getProvider')
            ->once()
            ->with(EventServiceProvider::class)
            ->andReturn(null);
        // Act
        $service = new GetEventsService();
        $actual = $service->handle();
        // Assert
        $this->assertNull($actual);
    }
}
