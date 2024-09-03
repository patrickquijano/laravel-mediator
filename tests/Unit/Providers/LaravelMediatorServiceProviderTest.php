<?php

declare(strict_types=1);

namespace LaravelMediator\Tests\Unit\Providers;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;
use LaravelMediator\Contracts\Services\Mediator\DiscoverEventsService;
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
        $discoverEventsServiceMock = Mockery::mock(DiscoverEventsService::class);
        $discoverEventsServiceMock->shouldReceive('handle')
            ->once()
            ->andReturn(['Event' => 'Listener']);
        $this->app->instance(DiscoverEventsService::class, $discoverEventsServiceMock);
        Cache::shouldReceive('rememberForever')
            ->once()
            ->with(LaravelMediatorServiceProvider::CACHE_KEY, Mockery::on(function ($callback) {
                return $callback() === ['Event' => 'Listener'];
            }))
            ->andReturn(['Event' => 'Listener']);
        Bus::shouldReceive('map')
            ->once()
            ->with(['Event' => 'Listener']);
        // Act
        $serviceProvider = new LaravelMediatorServiceProvider($this->app);
        $serviceProvider->register();
        $this->app->booted(function () use ($serviceProvider) {
            $serviceProvider->boot();
        });
        $this->app->boot();
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
            \LaravelMediator\Services\Mediator\DiscoverEventsService::class,
            $this->app->make(\LaravelMediator\Contracts\Services\Mediator\DiscoverEventsService::class)
        );
        $this->assertInstanceOf(
            \LaravelMediator\Services\Mediator\GetClassFromFileService::class,
            $this->app->make(\LaravelMediator\Contracts\Services\Mediator\GetClassFromFileService::class)
        );
        $this->assertInstanceOf(
            \LaravelMediator\Services\Mediator\GetEventForListenerService::class,
            $this->app->make(\LaravelMediator\Contracts\Services\Mediator\GetEventForListenerService::class)
        );
    }

    protected function getPackageProviders($app)
    {
        return [LaravelMediatorServiceProvider::class];
    }
}
