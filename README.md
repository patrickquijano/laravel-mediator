# Laravel Mediator
This package provides a simple implementation of the Mediator pattern and CQRS (Command Query Responsibility Segregation) for Laravel applications.

## Features
- Decouples commands and queries from their handlers
- Promotes loose coupling and testability
- Improves code organization

## Installation
```bash
composer require patrickquijano/laravel-mediator
```

## Usage
1. Create commands or queries or events:
    ```php
    <?php

    namespace App\Commands;

    use LaravelMediator\Abstracts\Buses\Command;

    class MyCommand extends Command
    {
        public function __construct(public string $data)
        {
        }
    }
    ```
    ```php
    <?php

    namespace App\Queries;

    use LaravelMediator\Abstracts\Buses\Query;

    class GetUserDataQuery extends Query
    {
        public function __construct(public int $userId)
        {
        }
    }
    ```
2. Create handlers:
    ```php
    <?php

    namespace App\Handlers;

    use LaravelMediator\Abstracts\Buses\Handlers\CommandHandler;

    class MyCommandHandler extends CommandHandler
    {
        public function handle(MyCommand $command): void
        {
            // Handle the command
        }
    }
    ```
    ```php
    <?php

    namespace App\Handlers;

    use LaravelMediator\Abstracts\Buses\Handlers\QueryHandler;

    class GetUserDataQueryHandler extends QueryHandler
    {
        public function handle(GetUserDataQuery $query): array
        {
            // Fetch user data and return it
        }
    }
    ```
3. Configure event listeners in `bootstrap/app.php`:
    ```php
    <?php

    use Illuminate\Foundation\Application;

    return Application::configure(basePath: dirname(__DIR__))
        ->withEvents([
            __DIR__.'/../app/Handlers',
        ]);

    ```
4. Dispatch commands or queries:
    ```php
    use LaravelMediator\Facades\CommandBus;

    CommandBus::dispatch(new MyCommand('data'));
    ```
    ```php
    use LaravelMediator\Facades\QueryBus;

    $userData = QueryBus::dispatch(new GetUserDataQuery(123));
    ```

## Contributing:
Feel free to contribute by opening issues or pull requests.
