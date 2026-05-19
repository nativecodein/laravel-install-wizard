<?php

namespace Nativecodein\LaravelInstallWizard\Tests;

use Nativecodein\LaravelInstallWizard\LaravelInstallWizardServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected string $installedFile;
    protected string $envFile;

    protected function setUp(): void
    {
        parent::setUp();

        $this->installedFile = sys_get_temp_dir().'/installwizard-test-'.uniqid().'.installed';
        $this->envFile = sys_get_temp_dir().'/installwizard-test-'.uniqid().'.env';

        @unlink($this->installedFile);
        @unlink($this->envFile);

        config()->set('installwizard.installed_file', $this->installedFile);

        $this->app->bind(\Nativecodein\LaravelInstallWizard\Services\EnvWriter::class, function () {
            return new \Nativecodein\LaravelInstallWizard\Services\EnvWriter($this->envFile);
        });
    }

    protected function tearDown(): void
    {
        @unlink($this->installedFile);
        @unlink($this->envFile);

        parent::tearDown();
    }

    protected function getPackageProviders($app): array
    {
        return [LaravelInstallWizardServiceProvider::class];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('app.key', 'base64:'.base64_encode(random_bytes(32)));
        $app['config']->set('installwizard.admin_enabled', false);
    }

    protected function markAsInstalled(): void
    {
        file_put_contents($this->installedFile, 'installed');
    }
}
