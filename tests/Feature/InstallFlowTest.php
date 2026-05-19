<?php

namespace Nativecodein\LaravelInstallWizard\Tests\Feature;

use Nativecodein\LaravelInstallWizard\Services\EnvWriter;
use Nativecodein\LaravelInstallWizard\Services\Installer;
use Nativecodein\LaravelInstallWizard\Tests\TestCase;

class InstallFlowTest extends TestCase
{
    public function test_welcome_step_saves_app_name(): void
    {
        $this->post(route('installwizard.welcome.store'), ['APP_NAME' => 'NativeCode'])
            ->assertRedirect(route('installwizard.environment'));

        $state = session(config('installwizard.session_key'));
        $this->assertSame('NativeCode', $state['app']['APP_NAME']);
    }

    public function test_welcome_validates_app_name(): void
    {
        $this->post(route('installwizard.welcome.store'), ['APP_NAME' => ''])
            ->assertSessionHasErrors('APP_NAME');
    }

    public function test_finish_runs_install_and_creates_lock_file(): void
    {
        config()->set('installwizard.final.run_migrations', false);
        config()->set('installwizard.final.run_seeders', false);

        $this->withSession([
            config('installwizard.session_key') => [
                'app' => ['APP_NAME' => 'NativeCode'],
                'environment' => [
                    'APP_ENV'      => 'production',
                    'APP_DEBUG'    => 'false',
                    'APP_URL'      => 'http://localhost',
                    'APP_TIMEZONE' => 'UTC',
                ],
                'database' => [],
            ],
        ])->post(route('installwizard.finish.run'))
          ->assertRedirect(route('installwizard.complete'));

        $this->assertFileExists($this->installedFile);

        $env = (new EnvWriter($this->envFile))->all();
        $this->assertSame('NativeCode', $env['APP_NAME']);
        $this->assertSame('production', $env['APP_ENV']);
    }

    public function test_install_redirects_to_configured_route_when_already_installed(): void
    {
        $this->markAsInstalled();

        $this->get(route('installwizard.index'))
            ->assertRedirect('/');
    }

    public function test_installer_run_creates_lock_file_via_service(): void
    {
        config()->set('installwizard.final.run_migrations', false);
        config()->set('installwizard.final.run_seeders', false);
        config()->set('installwizard.final.generate_key', false);
        config()->set('installwizard.final.clear_caches', false);

        $installer = $this->app->make(Installer::class);

        $result = $installer->run([
            'app' => ['APP_NAME' => 'NativeCode'],
            'environment' => ['APP_ENV' => 'production'],
        ]);

        $this->assertTrue($result['success']);
        $this->assertFileExists($this->installedFile);
    }
}
