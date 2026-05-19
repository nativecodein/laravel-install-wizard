<?php

namespace Nativecodein\LaravelInstallWizard\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureApplicationIsInstalled
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->isInstalled()) {
            return $next($request);
        }

        if ($this->isWhitelisted($request)) {
            return $next($request);
        }

        if ($request->expectsJson() || $request->wantsJson()) {
            return response()->json([
                'message'      => 'Application is not yet installed.',
                'install_url'  => url(config('installwizard.route_prefix', 'install')),
            ], 503);
        }

        $sessionKey = config('installwizard.intended_url_key', 'installwizard.intended_url');

        if ($request->isMethod('GET') && ! $request->ajax()) {
            session()->put($sessionKey, $request->fullUrl());
        }

        return redirect()->route('installwizard.index');
    }

    protected function isInstalled(): bool
    {
        return is_file($this->installedFile());
    }

    protected function installedFile(): string
    {
        return (string) config('installwizard.installed_file', storage_path('.installed'));
    }

    protected function isWhitelisted(Request $request): bool
    {
        $prefix = trim((string) config('installwizard.route_prefix', 'install'), '/');

        $patterns = array_merge(
            [$prefix, $prefix.'/*'],
            (array) config('installwizard.path_whitelist', [])
        );

        return $request->is(...array_filter($patterns));
    }
}
