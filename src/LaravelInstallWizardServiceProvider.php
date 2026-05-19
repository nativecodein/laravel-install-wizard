<?php

namespace Nativecodein\LaravelInstallWizard;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Nativecodein\LaravelInstallWizard\Http\Middleware\EnsureApplicationIsInstalled;
use Nativecodein\LaravelInstallWizard\Http\Middleware\SetInstallerLocale;
use Nativecodein\LaravelInstallWizard\Services\DatabaseTester;
use Nativecodein\LaravelInstallWizard\Services\EnvWriter;
use Nativecodein\LaravelInstallWizard\Services\Installer;
use Nativecodein\LaravelInstallWizard\Services\RequirementChecker;

class LaravelInstallWizardServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/config/installwizard.php', 'installwizard');

        $this->app->singleton(EnvWriter::class, fn ($app) => new EnvWriter($app->environmentFilePath()));
        $this->app->singleton(RequirementChecker::class, fn ($app) => new RequirementChecker(config('installwizard')));
        $this->app->singleton(DatabaseTester::class, fn () => new DatabaseTester());
        $this->app->singleton(Installer::class, function ($app) {
            return new Installer(
                $app->make(EnvWriter::class),
                config('installwizard'),
                $app
            );
        });
    }

    public function boot(Router $router): void
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'installwizard');
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'installwizard');

        $router->aliasMiddleware('installed', EnsureApplicationIsInstalled::class);
        $router->aliasMiddleware('installer.locale', SetInstallerLocale::class);

        if (config('installwizard.auto_apply_middleware', true)) {
            $this->pushMiddlewareToWebGroup();
        }

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/config/installwizard.php' => config_path('installwizard.php'),
            ], 'installwizard-config');

            $this->publishes([
                __DIR__.'/resources/views' => resource_path('views/vendor/installwizard'),
            ], 'installwizard-views');

            $this->publishes([
                __DIR__.'/resources/lang' => $this->langPath('vendor/installwizard'),
            ], 'installwizard-lang');

            $this->publishes([
                __DIR__.'/resources/css' => public_path('vendor/installwizard/css'),
                __DIR__.'/resources/js'  => public_path('vendor/installwizard/js'),
            ], 'installwizard-assets');

            $this->publishes([
                __DIR__.'/config/installwizard.php' => config_path('installwizard.php'),
                __DIR__.'/resources/views'              => resource_path('views/vendor/installwizard'),
                __DIR__.'/resources/lang'               => $this->langPath('vendor/installwizard'),
                __DIR__.'/resources/css'                => public_path('vendor/installwizard/css'),
                __DIR__.'/resources/js'                 => public_path('vendor/installwizard/js'),
            ], 'installwizard');
        }

        Blade::directive('installerTitle', fn () => "<?php echo e(app('installwizard.title')); ?>");

        $this->app->singleton('installwizard.title', function () {
            $name = trim((string) (
                session('installwizard.state.app.APP_NAME')
                ?: env('APP_NAME')
                ?: config('app.name')
                ?: config('installwizard.branding.fallback_app_name', 'Application')
            ));

            return trans('installwizard::messages.installer_title', ['app' => $name]);
        });
    }

    protected function langPath(string $path): string
    {
        if (function_exists('lang_path')) {
            return lang_path($path);
        }

        return resource_path('lang/'.$path);
    }

    protected function pushMiddlewareToWebGroup(): void
    {
        $router = $this->app->make(Router::class);

        if (method_exists($router, 'hasMiddlewareGroup') && $router->hasMiddlewareGroup('web')) {
            $router->pushMiddlewareToGroup('web', EnsureApplicationIsInstalled::class);

            return;
        }

        $kernel = $this->app->make(Kernel::class);

        if (method_exists($kernel, 'appendMiddlewareToGroup')) {
            $kernel->appendMiddlewareToGroup('web', EnsureApplicationIsInstalled::class);
        }
    }
}
