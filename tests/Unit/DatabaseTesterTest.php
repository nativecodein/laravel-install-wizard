<?php

namespace Nativecodein\LaravelInstallWizard\Tests\Unit;

use Nativecodein\LaravelInstallWizard\Services\DatabaseTester;
use PHPUnit\Framework\TestCase;

class DatabaseTesterTest extends TestCase
{
    public function test_sqlite_memory_succeeds(): void
    {
        if (! extension_loaded('pdo_sqlite')) {
            $this->markTestSkipped('pdo_sqlite not loaded');
        }

        $result = (new DatabaseTester())->test([
            'DB_CONNECTION' => 'sqlite',
            'DB_DATABASE'   => ':memory:',
        ]);

        $this->assertTrue($result['success']);
        $this->assertSame('sqlite', $result['driver']);
    }

    public function test_mysql_invalid_credentials_fails_gracefully(): void
    {
        if (! extension_loaded('pdo_mysql')) {
            $this->markTestSkipped('pdo_mysql not loaded');
        }

        $result = (new DatabaseTester())->test([
            'DB_CONNECTION' => 'mysql',
            'DB_HOST'       => '127.0.0.1',
            'DB_PORT'       => '1', // unreachable port
            'DB_DATABASE'   => 'nonexistent',
            'DB_USERNAME'   => 'invalid',
            'DB_PASSWORD'   => 'invalid',
        ]);

        $this->assertFalse($result['success']);
        $this->assertNotEmpty($result['message']);
    }

    public function test_unknown_driver_returns_error(): void
    {
        $result = (new DatabaseTester())->test([
            'DB_CONNECTION' => 'not_a_real_driver',
        ]);

        $this->assertFalse($result['success']);
    }
}
