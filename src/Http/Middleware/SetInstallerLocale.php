<?php

namespace Nativecodein\LaravelInstallWizard\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetInstallerLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $available = array_keys((array) config('installwizard.locales', ['en' => 'English']));
        $key       = (string) config('installwizard.locale_session_key', 'installwizard.locale');

        $locale = (string) (
            session($key)
            ?: config('installwizard.default_locale')
            ?: app()->getLocale()
            ?: 'en'
        );

        if (! in_array($locale, $available, true)) {
            $locale = in_array('en', $available, true) ? 'en' : ($available[0] ?? 'en');
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
