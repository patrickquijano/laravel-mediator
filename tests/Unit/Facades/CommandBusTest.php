<?php

declare(strict_types=1);

namespace PatrickQuijano\LaravelMediator\Tests\Unit\Facades;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Bus;
use PatrickQuijano\LaravelMediator\Abstracts\Buses\Command;
use PatrickQuijano\LaravelMediator\Facades\CommandBus;
use PatrickQuijano\LaravelMediator\Tests\Unit\TestCase as AbstractTestCase;

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
        // Act
        $actual = CommandBus::dispatch($command);
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
        // Act
        $actual = CommandBus::dispatch($command);
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
        // Act
        $actual = CommandBus::dispatch($command);
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
        // Act
        $actual = CommandBus::dispatch($command);
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
        // Act
        $actual = CommandBus::dispatch($command);
        // Assert
        $this->assertTrue($actual);
    }
}
