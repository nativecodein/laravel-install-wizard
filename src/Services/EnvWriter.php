<?php

namespace Nativecodein\LaravelInstallWizard\Services;

class EnvWriter
{
    public function __construct(protected string $path)
    {
    }

    public function path(): string
    {
        return $this->path;
    }

    public function exists(): bool
    {
        return is_file($this->path);
    }

    public function ensureExists(): void
    {
        if ($this->exists()) {
            return;
        }

        $example = dirname($this->path).DIRECTORY_SEPARATOR.'.env.example';

        if (is_file($example)) {
            copy($example, $this->path);

            return;
        }

        file_put_contents($this->path, "APP_NAME=Laravel\nAPP_ENV=local\nAPP_DEBUG=true\nAPP_URL=http://localhost\n");
    }

    public function all(): array
    {
        if (! $this->exists()) {
            return [];
        }

        $values = [];

        foreach (file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }

            if (! str_contains($line, '=')) {
                continue;
            }

            [$key, $value] = explode('=', $line, 2);
            $values[trim($key)] = $this->unquote(trim($value));
        }

        return $values;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->all()[$key] ?? $default;
    }

    public function write(array $values): bool
    {
        $this->ensureExists();

        $original = file_get_contents($this->path) ?: '';
        $contents = $original;
        $remaining = $values;

        foreach ($values as $key => $value) {
            if (! $this->isValidKey($key)) {
                continue;
            }

            $escaped = $this->escapeValue((string) $value);
            $pattern = '/^(\s*'.preg_quote($key, '/').'\s*=).*$/m';

            if (preg_match($pattern, $contents)) {
                $contents = preg_replace($pattern, $key.'='.$escaped, $contents);
                unset($remaining[$key]);
            }
        }

        if (! empty($remaining)) {
            $contents = rtrim($contents, "\r\n")."\n";
            foreach ($remaining as $key => $value) {
                if (! $this->isValidKey($key)) {
                    continue;
                }
                $contents .= $key.'='.$this->escapeValue((string) $value)."\n";
            }
        }

        return (bool) file_put_contents($this->path, $contents, LOCK_EX);
    }

    protected function isValidKey(string $key): bool
    {
        return (bool) preg_match('/^[A-Z_][A-Z0-9_]*$/', $key);
    }

    protected function escapeValue(string $value): string
    {
        if ($value === '') {
            return '';
        }

        $needsQuotes = preg_match('/[\s"#\'=]/', $value) === 1;

        if ($needsQuotes) {
            $escaped = str_replace(['\\', '"'], ['\\\\', '\\"'], $value);

            return '"'.$escaped.'"';
        }

        return $value;
    }

    protected function unquote(string $value): string
    {
        if (strlen($value) >= 2) {
            $first = $value[0];
            $last  = $value[strlen($value) - 1];

            if (($first === '"' && $last === '"') || ($first === "'" && $last === "'")) {
                $inner = substr($value, 1, -1);

                if ($first === '"') {
                    return str_replace(['\\"', '\\\\'], ['"', '\\'], $inner);
                }

                return $inner;
            }
        }

        return $value;
    }
}
