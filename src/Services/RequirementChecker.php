<?php

namespace Nativecodein\LaravelInstallWizard\Services;

class RequirementChecker
{
    public function __construct(protected array $config)
    {
    }

    public function extensions(): array
    {
        $required = array_values((array) ($this->config['required_extensions'] ?? []));

        $results = [];

        foreach ($required as $extension) {
            $results[] = [
                'name'   => $extension,
                'loaded' => extension_loaded($extension),
            ];
        }

        return $results;
    }

    public function missingExtensions(): array
    {
        return array_values(array_filter(
            $this->extensions(),
            fn ($e) => $e['loaded'] === false
        ));
    }

    public function allExtensionsLoaded(): bool
    {
        return count($this->missingExtensions()) === 0;
    }

    public function permissions(): array
    {
        $paths = array_values((array) ($this->config['writable_paths'] ?? []));

        $results = [];

        foreach ($paths as $path) {
            $absolute = $this->resolvePath($path);

            $results[] = [
                'path'     => $path,
                'absolute' => $absolute,
                'exists'   => file_exists($absolute),
                'writable' => is_writable($absolute),
            ];
        }

        return $results;
    }

    public function nonWritablePaths(): array
    {
        return array_values(array_filter(
            $this->permissions(),
            fn ($p) => ! ($p['exists'] && $p['writable'])
        ));
    }

    public function allPathsWritable(): bool
    {
        return count($this->nonWritablePaths()) === 0;
    }

    public function phpVersion(): array
    {
        $required = $this->config['min_php'] ?? '8.1.0';

        return [
            'required' => $required,
            'current'  => PHP_VERSION,
            'ok'       => version_compare(PHP_VERSION, $required, '>='),
        ];
    }

    protected function resolvePath(string $path): string
    {
        if ($this->isAbsolute($path)) {
            return $path;
        }

        if (function_exists('base_path')) {
            return base_path($path);
        }

        return getcwd().DIRECTORY_SEPARATOR.$path;
    }

    protected function isAbsolute(string $path): bool
    {
        if ($path === '') {
            return false;
        }

        if ($path[0] === DIRECTORY_SEPARATOR || $path[0] === '/') {
            return true;
        }

        return (bool) preg_match('/^[A-Za-z]:[\\\\\\/]/', $path);
    }
}
