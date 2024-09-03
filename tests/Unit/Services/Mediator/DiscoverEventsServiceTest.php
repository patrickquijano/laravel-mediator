<?php

declare(strict_types=1);

namespace Tests\Unit\Services\Mediator;

use Illuminate\Support\Facades\Config;
use LaravelMediator\Services\Mediator\DiscoverEventsService;
use LaravelMediator\Services\Mediator\GetClassFromFileService;
use LaravelMediator\Services\Mediator\GetEventForListenerService;
use Mockery;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class DiscoverEventsServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_handle_discovers_events()
    {
        // Arrange
        $finderMock = Mockery::mock(Finder::class);
        $getClassFromFileServiceMock = Mockery::mock(GetClassFromFileService::class);
        $getEventForListenerServiceMock = Mockery::mock(GetEventForListenerService::class);
        $service = new DiscoverEventsService(
            $finderMock,
            $getClassFromFileServiceMock,
            $getEventForListenerServiceMock
        );
        Config::shouldReceive('get')
            ->with('mediator.paths', [])
            ->andReturn(['dummy/path']);
        $fileMock = Mockery::mock(SplFileInfo::class);
        $fileMock->shouldReceive('getRealPath')->andReturn('dummy/path/UserRegisteredListener.php');
        $fileMock->shouldReceive('getFilename')->andReturn('UserRegisteredListener.php');
        $finderMock->shouldReceive('files')->andReturnSelf();
        $finderMock->shouldReceive('in')->with('dummy/path')->andReturnSelf();
        $finderMock->shouldReceive('getIterator')->andReturn(new \ArrayIterator([$fileMock]));
        $getClassFromFileServiceMock->shouldReceive('handle')
            ->with('dummy/path/UserRegisteredListener.php')
            ->andReturn('App\Listeners\UserRegisteredListener');
        $getEventForListenerServiceMock->shouldReceive('handle')
            ->with('App\Listeners\UserRegisteredListener')
            ->andReturn('App\Events\UserRegistered');
        // Act
        $result = $service->handle();
        $expected = [
            'App\Events\UserRegistered' => 'App\Listeners\UserRegisteredListener',
        ];
        // Assert
        $this->assertEquals($expected, $result);
    }

    public function test_handle_returns_empty_array_when_no_listeners()
    {// Arrange
        $finderMock = Mockery::mock(Finder::class);
        $getClassFromFileServiceMock = Mockery::mock(GetClassFromFileService::class);
        $getEventForListenerServiceMock = Mockery::mock(GetEventForListenerService::class);
        $service = new DiscoverEventsService(
            $finderMock,
            $getClassFromFileServiceMock,
            $getEventForListenerServiceMock
        );
        Config::shouldReceive('get')
            ->with('mediator.paths', [])
            ->andReturn(['dummy/path']);
        $finderMock->shouldReceive('files')->andReturnSelf();
        $finderMock->shouldReceive('in')->with('dummy/path')->andReturnSelf();
        $finderMock->shouldReceive('getIterator')->andReturn(new \ArrayIterator([]));
        // Act
        $result = $service->handle();
        // Assert
        $this->assertEquals([], $result);
    }

    public function test_handle_skips_files_without_listener_suffix()
    {// Arrange
        $finderMock = Mockery::mock(Finder::class);
        $getClassFromFileServiceMock = Mockery::mock(GetClassFromFileService::class);
        $getEventForListenerServiceMock = Mockery::mock(GetEventForListenerService::class);
        $service = new DiscoverEventsService(
            $finderMock,
            $getClassFromFileServiceMock,
            $getEventForListenerServiceMock
        );
        Config::shouldReceive('get')
            ->with('mediator.paths', [])
            ->andReturn(['dummy/path']);
        $fileMock = Mockery::mock(SplFileInfo::class);
        $fileMock->shouldReceive('getRealPath')->andReturn('dummy/path/SomeClass.php');
        $fileMock->shouldReceive('getFilename')->andReturn('SomeClass.php');
        $finderMock->shouldReceive('files')->andReturnSelf();
        $finderMock->shouldReceive('in')->with('dummy/path')->andReturnSelf();
        $finderMock->shouldReceive('getIterator')->andReturn(new \ArrayIterator([$fileMock]));
        $getClassFromFileServiceMock->shouldReceive('handle')
            ->with('dummy/path/SomeClass.php')
            ->andReturn('App\SomeClass');
        $getEventForListenerServiceMock->shouldNotReceive('handle');
        // Act
        $result = $service->handle();
        // Assert
        $this->assertEquals([], $result);
    }
}
