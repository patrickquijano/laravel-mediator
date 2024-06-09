<?php

declare(strict_types=1);

namespace PatrickQuijano\LaravelCQRS\Tests\Unit\Facades;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Bus;
use PatrickQuijano\LaravelCQRS\Abstracts\Buses\Query;
use PatrickQuijano\LaravelCQRS\Facades\QueryBus;
use PatrickQuijano\LaravelCQRS\Tests\Unit\TestCase as AbstractTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(QueryBus::class)]
class QueryBusTest extends AbstractTestCase
{
    public function test_dispatch_method_returns_a_collection_instance(): void
    {
        // Arrange
        $query = new class extends Query
        {
        };
        Bus::shouldReceive('dispatch')
            ->once()
            ->with($query)
            ->andReturn(new Collection());
        // Act
        $actual = QueryBus::dispatch($query);
        // Assert
        $this->assertInstanceOf(Collection::class, $actual);
    }

    public function test_dispatch_method_returns_an_array(): void
    {
        // Arrange
        $query = new class extends Query
        {
        };
        Bus::shouldReceive('dispatch')
            ->once()
            ->with($query)
            ->andReturn([]);
        // Act
        $actual = QueryBus::dispatch($query);
        // Assert
        $this->assertIsArray($actual);
    }

    public function test_dispatch_method_returns_false(): void
    {
        // Arrange
        $query = new class extends Query
        {
        };
        Bus::shouldReceive('dispatch')
            ->once()
            ->with($query)
            ->andReturnFalse();
        // Act
        $actual = QueryBus::dispatch($query);
        // Assert
        $this->assertFalse($actual);
    }

    public function test_dispatch_method_returns_null(): void
    {
        // Arrange
        $query = new class extends Query
        {
        };
        Bus::shouldReceive('dispatch')
            ->once()
            ->with($query)
            ->andReturnNull();
        // Act
        $actual = QueryBus::dispatch($query);
        // Assert
        $this->assertNull($actual);
    }

    public function test_dispatch_method_returns_true(): void
    {
        // Arrange
        $query = new class extends Query
        {
        };
        Bus::shouldReceive('dispatch')
            ->once()
            ->with($query)
            ->andReturnTrue();
        // Act
        $actual = QueryBus::dispatch($query);
        // Assert
        $this->assertTrue($actual);
    }
}
