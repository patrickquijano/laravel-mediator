<?php

declare(strict_types=1);

namespace LaravelMediator\Tests\Unit\Services\Mediator;

use LaravelMediator\Services\Mediator\GetClassFromFileService;
use LaravelMediator\Tests\Unit\TestCase as AbstractTestCase;

class GetClassFromFileServiceTest extends AbstractTestCase
{
    private string $testDirectory = 'dummy/path';

    protected function setUp(): void
    {
        if (! is_dir($this->testDirectory)) {
            mkdir($this->testDirectory, 0777, true);
        }
    }

    protected function tearDown(): void
    {
        array_map('unlink', glob("{$this->testDirectory}/*.*"));
        rmdir($this->testDirectory);
        parent::tearDown();
    }

    public function test_handle_returns_correct_class_name()
    {
        // Arrange
        $service = new GetClassFromFileService();
        $fileContent = <<<'PHP'
<?php

namespace App\Listeners;

class UserRegisteredListener
{
}
PHP;
        $filePath = $this->testDirectory.'/UserRegisteredListener.php';
        file_put_contents($filePath, $fileContent);
        // Act
        $result = $service->handle($filePath);
        // Assert
        $this->assertEquals('App\Listeners\UserRegisteredListener', $result);
        unlink($filePath);
    }

    public function test_handle_returns_empty_string_when_no_namespace_or_class()
    {
        // Arrage
        $service = new GetClassFromFileService();
        $fileContent = <<<'PHP'
<?php

// No namespace or class
PHP;

        $filePath = $this->testDirectory.'/NoClass.php';
        file_put_contents($filePath, $fileContent);
        // Act
        $result = $service->handle($filePath);
        // Assert
        $this->assertEquals('\\', $result);
        unlink($filePath);
    }
}
