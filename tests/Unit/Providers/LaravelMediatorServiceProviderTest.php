<?php

declare(strict_types=1);

namespace LaravelMediator\Tests\Unit\Providers;

use Illuminate\Support\Facades\Bus;
use LaravelMediator\Contracts\Services\Mediator\GetBusEventsService;
use LaravelMediator\Contracts\Services\Mediator\GetEventsService;
use LaravelMediator\Providers\LaravelMediatorServiceProvider;
use LaravelMediator\Tests\Unit\TestCase as AbstractTestCase;
use Mockery;

class LaravelMediatorServiceProviderTest extends AbstractTestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_boot_method()
    {
        // Arrange
        $eventsServiceMock = Mockery::mock(GetEventsService::class);
        $busEventsServiceMock = Mockery::mock(GetBusEventsService::class);
        $eventsServiceMock->shouldReceive('handle')
            ->once()
            ->andReturn(['event' => ['listener']]);
        $busEventsServiceMock->shouldReceive('handle')
            ->once()
            ->with(['event' => ['listener']])
            ->andReturn(['event' => 'listener']);
        $this->app->instance(GetEventsService::class, $eventsServiceMock);
        $this->app->instance(GetBusEventsService::class, $busEventsServiceMock);
        Bus::shouldReceive('map')
            ->once()
            ->with(['event' => 'listener']);
        // Act
        $serviceProvider = new LaravelMediatorServiceProvider($this->app);
        $serviceProvider->register();
        $this->app->booted(function () use ($serviceProvider) {
            $serviceProvider->boot();
        });
        // Assert
        $this->assertTrue(true);
    }

    public function test_singletons_are_registered()
    {
        // Act
        $serviceProvider = new LaravelMediatorServiceProvider($this->app);
        $serviceProvider->register();
        // Assert
        $this->assertInstanceOf(
            \LaravelMediator\Buses\CommandBus::class,
            $this->app->make(\LaravelMediator\Contracts\Buses\CommandBus::class)
        );
        $this->assertInstanceOf(
            \LaravelMediator\Buses\QueryBus::class,
            $this->app->make(\LaravelMediator\Contracts\Buses\QueryBus::class)
        );
        $this->assertInstanceOf(
            \LaravelMediator\Services\Mediator\GetBusEventsService::class,
            $this->app->make(\LaravelMediator\Contracts\Services\Mediator\GetBusEventsService::class)
        );
        $this->assertInstanceOf(
            \LaravelMediator\Services\Mediator\GetEventsService::class,
            $this->app->make(\LaravelMediator\Contracts\Services\Mediator\GetEventsService::class)
        );
    }

    protected function getPackageProviders($app)
    {
        return [LaravelMediatorServiceProvider::class];
    }
}
