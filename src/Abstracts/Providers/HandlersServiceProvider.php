<?php

declare(strict_types=1);

namespace LaravelMediator\Abstracts\Providers;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\ServiceProvider as AbstractServiceProvider;

/**
 * @codeCoverageIgnore
 */
abstract class HandlersServiceProvider extends AbstractServiceProvider
{
    /**
     * @var array<string, string>
     */
    public array $handlers = [];

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Bus::map($this->handlers);
    }
}
