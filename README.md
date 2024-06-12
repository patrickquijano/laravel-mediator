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

1. Define Commands and Queries:

    Create separate classes extending ```Abstracts\Buses\Command``` and ```Abstracts\Buses\Query``` for your commands and queries, respectively.

2. Implement Handlers:

    Implement your handlers extending a relevant abstract handler class like ```Abstracts\Handlers\CommandHandler``` or ```Abstracts\Handlers\QueryHandler```. These handlers will contain the logic for processing commands and queries.

3. Register Handlers (Extend Service Provider):

    Create a new service provider extending ```LaravelMediator\Abstracts\Providers\HandlersServiceProvider```. In the ```$handlers``` property of your service provider, register your command and query handlers with their corresponding commands and queries.

4. Dispatching Commands and Queries:

    - Use the ```CommandBus``` facade to dispatch commands:

        ```php
        use LaravelMediator\Facades\CommandBus;

        $command = new YourCommand();
        CommandBus::dispatch($command);
        ```

    - Use the ```QueryBus``` facade to dispatch queries:
        ```php
        use LaravelMediator\Facades\QueryBus;

        $query = new YourQuery();
        $result = QueryBus::dispatch($query);
        ```

5. Registering Service Provider:

    Register your custom service provider in the array of your ```bootstrap/providers.php``` file.

    Example:

    ```php
    // app/Providers/MyHandlersServiceProvider.php
    <?php

    namespace App\Providers;

    use App\Handlers\MyCommandHandler;
    use App\Handlers\MyQueryHandler;
    use App\Commands\MyCommand;
    use App\Queries\MyQuery;
    use LaravelMediator\Abstracts\Providers\HandlersServiceProvider;

    class MyHandlersServiceProvider extends HandlersServiceProvider
    {
        protected $handlers = [
            MyCommand::class => MyCommandHandler::class,
            MyQuery::class => MyQueryHandler::class,
        ];
    }
    ```

    ```php
    // bootstrap/providers.php
    <?php

    return [
        App\Providers\MyHandlersServiceProvider::class,
    ];
    ```
