<?php

namespace Nativecodein\LaravelInstallWizard\Services;

use PDO;
use PDOException;
use Throwable;

class DatabaseTester
{
    public function test(array $credentials): array
    {
        $connection = strtolower((string) ($credentials['DB_CONNECTION'] ?? 'mysql'));

        try {
            $dsn      = $this->buildDsn($connection, $credentials);
            $username = $credentials['DB_USERNAME'] ?? null;
            $password = $credentials['DB_PASSWORD'] ?? null;

            $options = [
                PDO::ATTR_TIMEOUT   => 5,
                PDO::ATTR_ERRMODE   => PDO::ERRMODE_EXCEPTION,
            ];

            $pdo = $connection === 'sqlite'
                ? new PDO($dsn)
                : new PDO($dsn, $username, $password, $options);

            $pdo->query('SELECT 1');

            return [
                'success' => true,
                'driver'  => $connection,
                'message' => 'Successfully connected to '.$connection.'.',
            ];
        } catch (PDOException|Throwable $e) {
            return [
                'success' => false,
                'driver'  => $connection,
                'message' => $e->getMessage(),
            ];
        }
    }

    protected function buildDsn(string $connection, array $c): string
    {
        return match ($connection) {
            'mysql'  => sprintf(
                'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
                $c['DB_HOST'] ?? '127.0.0.1',
                $c['DB_PORT'] ?? '3306',
                $c['DB_DATABASE'] ?? ''
            ),
            'pgsql'  => sprintf(
                'pgsql:host=%s;port=%s;dbname=%s',
                $c['DB_HOST'] ?? '127.0.0.1',
                $c['DB_PORT'] ?? '5432',
                $c['DB_DATABASE'] ?? ''
            ),
            'sqlite' => 'sqlite:'.($this->resolveSqlitePath($c['DB_DATABASE'] ?? '')),
            'sqlsrv' => sprintf(
                'sqlsrv:Server=%s,%s;Database=%s',
                $c['DB_HOST'] ?? '127.0.0.1',
                $c['DB_PORT'] ?? '1433',
                $c['DB_DATABASE'] ?? ''
            ),
            default  => throw new \InvalidArgumentException("Unsupported DB driver: {$connection}"),
        };
    }

    protected function resolveSqlitePath(string $value): string
    {
        if ($value === '' || $value === ':memory:') {
            return ':memory:';
        }

        if ($this->isAbsolute($value)) {
            return $value;
        }

        if (function_exists('database_path')) {
            return database_path($value);
        }

        return $value;
    }

    protected function isAbsolute(string $path): bool
    {
        if ($path === '') {
            return false;
        }
        if ($path[0] === '/' || $path[0] === DIRECTORY_SEPARATOR) {
            return true;
        }

        return (bool) preg_match('/^[A-Za-z]:[\\\\\\/]/', $path);
    }
}
