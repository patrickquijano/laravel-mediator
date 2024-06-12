<?php

declare(strict_types=1);

namespace LaravelMediator\Tests\Unit\Buses;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Bus;
use LaravelMediator\Abstracts\Buses\Command;
use LaravelMediator\Buses\CommandBus;
use LaravelMediator\Tests\Unit\TestCase as AbstractTestCase;

class CommandBusTest extends AbstractTestCase
{
    public function test_dispatch_method_returns_a_collection_instance(): void
    {
        // Arrange
        $command = new class extends Command
        {
        };
        Bus::shouldReceive('dispatch')
            ->once()
            ->with($command)
            ->andReturn(new Collection());
        $commandBus = new CommandBus();
        // Act
        $actual = $commandBus->dispatch($command);
        // Assert
        $this->assertInstanceOf(Collection::class, $actual);
    }

    public function test_dispatch_method_returns_an_array(): void
    {
        // Arrange
        $command = new class extends Command
        {
        };
        Bus::shouldReceive('dispatch')
            ->once()
            ->with($command)
            ->andReturn([]);
        $commandBus = new CommandBus();
        // Act
        $actual = $commandBus->dispatch($command);
        // Assert
        $this->assertIsArray($actual);
    }

    public function test_dispatch_method_returns_false(): void
    {
        // Arrange
        $command = new class extends Command
        {
        };
        Bus::shouldReceive('dispatch')
            ->once()
            ->with($command)
            ->andReturnFalse();
        $commandBus = new CommandBus();
        // Act
        $actual = $commandBus->dispatch($command);
        // Assert
        $this->assertFalse($actual);
    }

    public function test_dispatch_method_returns_null(): void
    {
        // Arrange
        $command = new class extends Command
        {
        };
        Bus::shouldReceive('dispatch')
            ->once()
            ->with($command)
            ->andReturnNull();
        $commandBus = new CommandBus();
        // Act
        $actual = $commandBus->dispatch($command);
        // Assert
        $this->assertNull($actual);
    }

    public function test_dispatch_method_returns_true(): void
    {
        // Arrange
        $command = new class extends Command
        {
        };
        Bus::shouldReceive('dispatch')
            ->once()
            ->with($command)
            ->andReturnTrue();
        $commandBus = new CommandBus();
        // Act
        $actual = $commandBus->dispatch($command);
        // Assert
        $this->assertTrue($actual);
    }
}
