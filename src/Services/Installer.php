<?php

namespace Nativecodein\LaravelInstallWizard\Services;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Throwable;

class Installer
{
    public function __construct(
        protected EnvWriter $env,
        protected array $config,
        protected Application $app
    ) {
    }

    public function run(array $state): array
    {
        $log = [];

        try {
            $envValues = $this->collectEnvValues($state);

            if (! empty($envValues)) {
                $this->env->write($envValues);
                $log[] = 'Wrote .env values';
            }

            if (($this->config['final']['generate_key'] ?? true) && empty($this->env->get('APP_KEY'))) {
                $this->generateAppKey();
                $log[] = 'Generated APP_KEY';
            }

            if ($this->config['final']['clear_caches'] ?? true) {
                $this->clearCaches();
                $log[] = 'Cleared config/route/view caches';
            }

            if ($this->config['final']['run_migrations'] ?? false) {
                Artisan::call('migrate', ['--force' => true]);
                $log[] = 'Ran migrations';
            }

            if ($this->config['final']['run_seeders'] ?? false) {
                Artisan::call('db:seed', ['--force' => true]);
                $log[] = 'Ran seeders';
            }

            $this->createLockFile();
            $log[] = 'Created installation lock file';

            return [
                'success' => true,
                'log'     => $log,
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'log'     => $log,
                'error'   => $e->getMessage(),
            ];
        }
    }

    public function createLockFile(): void
    {
        $path = (string) ($this->config['installed_file'] ?? storage_path('.installed'));

        $dir = dirname($path);
        if (! is_dir($dir)) {
            @mkdir($dir, 0775, true);
        }

        file_put_contents($path, sprintf(
            "Installed at: %s\nVia: installwizard\n",
            date('c')
        ));
    }

    public function removeLockFile(): bool
    {
        $path = (string) ($this->config['installed_file'] ?? storage_path('.installed'));

        if (is_file($path)) {
            return unlink($path);
        }

        return true;
    }

    public function isInstalled(): bool
    {
        return is_file((string) ($this->config['installed_file'] ?? storage_path('.installed')));
    }

    public function clearCaches(): void
    {
        foreach (['config:clear', 'route:clear', 'view:clear', 'cache:clear'] as $command) {
            try {
                Artisan::call($command);
            } catch (Throwable $e) {
                // ignore — some caches may not exist on a fresh install
            }
        }
    }

    protected function generateAppKey(): void
    {
        $key = 'base64:'.base64_encode(random_bytes(32));
        $this->env->write(['APP_KEY' => $key]);
    }

    protected function collectEnvValues(array $state): array
    {
        $values = [];

        foreach (['app', 'database', 'environment'] as $bucket) {
            if (! empty($state[$bucket]) && is_array($state[$bucket])) {
                foreach ($state[$bucket] as $key => $value) {
                    if ($value === null || $value === '') {
                        continue;
                    }
                    $values[(string) $key] = $value;
                }
            }
        }

        return $values;
    }

    public static function defaultEnvironmentValues(): array
    {
        return [
            'APP_NAME'     => env('APP_NAME', 'Laravel'),
            'APP_ENV'      => env('APP_ENV', 'production'),
            'APP_DEBUG'    => env('APP_DEBUG', false) ? 'true' : 'false',
            'APP_URL'      => env('APP_URL', 'http://localhost'),
            'APP_TIMEZONE' => env('APP_TIMEZONE', 'UTC'),
            'APP_LOCALE'   => env('APP_LOCALE', 'en'),
        ];
    }

    public static function defaultDatabaseValues(): array
    {
        return [
            'DB_CONNECTION' => env('DB_CONNECTION', 'mysql'),
            'DB_HOST'       => env('DB_HOST', '127.0.0.1'),
            'DB_PORT'       => env('DB_PORT', '3306'),
            'DB_DATABASE'   => env('DB_DATABASE', ''),
            'DB_USERNAME'   => env('DB_USERNAME', ''),
            'DB_PASSWORD'   => env('DB_PASSWORD', ''),
        ];
    }

    public static function normalizeAppName(string $name): string
    {
        $name = trim($name);

        return $name === '' ? 'Application' : (string) Str::of($name)->limit(60, '');
    }
}
