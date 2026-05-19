<?php

namespace Nativecodein\LaravelInstallWizard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Nativecodein\LaravelInstallWizard\Http\Requests\StoreDatabaseRequest;
use Nativecodein\LaravelInstallWizard\Http\Requests\StoreEnvironmentRequest;
use Nativecodein\LaravelInstallWizard\Http\Requests\StoreWelcomeRequest;
use Nativecodein\LaravelInstallWizard\Services\DatabaseTester;
use Nativecodein\LaravelInstallWizard\Services\Installer;
use Nativecodein\LaravelInstallWizard\Services\RequirementChecker;

class InstallController extends Controller
{
    public function __construct(protected Installer $installer)
    {
    }

    public function index()
    {
        if ($this->installer->isInstalled()) {
            return redirect(config('installwizard.redirect_after_install', '/'));
        }

        return redirect()->route('installwizard.welcome');
    }

    public function welcome()
    {
        return view('installwizard::install.steps.welcome', $this->stepData('welcome'));
    }

    public function storeWelcome(StoreWelcomeRequest $request)
    {
        $name = Installer::normalizeAppName($request->string('APP_NAME')->toString());
        $this->putState('app', ['APP_NAME' => $name]);

        return redirect()->route('installwizard.environment');
    }

    public function environment()
    {
        $defaults = array_merge(
            Installer::defaultEnvironmentValues(),
            $this->getState('environment', []),
            ['APP_NAME' => $this->appName()],
        );

        return view('installwizard::install.steps.environment', $this->stepData('environment', [
            'values' => $defaults,
        ]));
    }

    public function storeEnvironment(StoreEnvironmentRequest $request)
    {
        $this->putState('environment', $request->validated());
        $this->putState('app', ['APP_NAME' => $request->string('APP_NAME')->toString()]);

        return redirect()->route('installwizard.database');
    }

    public function database()
    {
        $defaults = array_merge(
            Installer::defaultDatabaseValues(),
            $this->getState('database', [])
        );

        $connections = (array) config('installwizard.database_connections', []);

        return view('installwizard::install.steps.database', $this->stepData('database', [
            'values'      => $defaults,
            'connections' => $connections,
        ]));
    }

    public function testDatabase(Request $request, DatabaseTester $tester)
    {
        $credentials = $request->only([
            'DB_CONNECTION', 'DB_HOST', 'DB_PORT', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD',
        ]);

        $result = $tester->test($credentials);

        if ($request->wantsJson()) {
            return response()->json($result, $result['success'] ? 200 : 422);
        }

        return back()->with($result['success'] ? 'status' : 'error', $result['message']);
    }

    public function storeDatabase(StoreDatabaseRequest $request, DatabaseTester $tester)
    {
        $data = $request->validated();

        $result = $tester->test($data);

        if (! $result['success']) {
            return back()
                ->withInput()
                ->withErrors(['DB_DATABASE' => trans('installwizard::messages.database.connection_failed', ['error' => $result['message']])]);
        }

        $this->putState('database', $data);

        return redirect()->route('installwizard.requirements');
    }

    public function requirements(RequirementChecker $checker)
    {
        return view('installwizard::install.steps.requirements', $this->stepData('requirements', [
            'extensions' => $checker->extensions(),
            'php'        => $checker->phpVersion(),
            'allOk'      => $checker->allExtensionsLoaded(),
        ]));
    }

    public function permissions(RequirementChecker $checker)
    {
        return view('installwizard::install.steps.permissions', $this->stepData('permissions', [
            'paths' => $checker->permissions(),
            'allOk' => $checker->allPathsWritable(),
        ]));
    }

    public function finish()
    {
        return view('installwizard::install.steps.finish', $this->stepData('finish', [
            'state' => $this->state(),
        ]));
    }

    public function runInstall(Request $request)
    {
        $state  = $this->state();
        $result = $this->installer->run($state);

        if (! $result['success']) {
            return back()->withErrors([
                'install' => $result['error'] ?? trans('installwizard::messages.install_failed'),
            ]);
        }

        $intended = session()->pull(config('installwizard.intended_url_key', 'installwizard.intended_url'));

        session()->put('installwizard.completed', [
            'intended_url' => $intended,
            'log'          => $result['log'],
        ]);

        session()->forget(config('installwizard.session_key', 'installwizard.state'));

        return redirect()->route('installwizard.complete');
    }

    public function complete()
    {
        $payload = session('installwizard.completed');

        if (! $payload) {
            return redirect(config('installwizard.redirect_after_install', '/'));
        }

        return view('installwizard::install.steps.complete', array_merge($this->stepData('complete'), [
            'redirect' => $payload['intended_url'] ?? config('installwizard.redirect_after_install', '/'),
            'log'      => $payload['log'] ?? [],
        ]));
    }

    protected function stepData(string $step, array $extra = []): array
    {
        return array_merge([
            'step'           => $step,
            'appName'        => $this->appName(),
            'installerTitle' => trans('installwizard::messages.installer_title', ['app' => $this->appName()]),
            'steps'          => $this->stepDefinitions(),
        ], $extra);
    }

    protected function stepDefinitions(): array
    {
        return [
            ['key' => 'welcome',      'label' => trans('installwizard::messages.steps.welcome'),      'route' => 'installwizard.welcome'],
            ['key' => 'environment',  'label' => trans('installwizard::messages.steps.environment'),  'route' => 'installwizard.environment'],
            ['key' => 'database',     'label' => trans('installwizard::messages.steps.database'),     'route' => 'installwizard.database'],
            ['key' => 'requirements', 'label' => trans('installwizard::messages.steps.requirements'), 'route' => 'installwizard.requirements'],
            ['key' => 'permissions',  'label' => trans('installwizard::messages.steps.permissions'),  'route' => 'installwizard.permissions'],
            ['key' => 'finish',       'label' => trans('installwizard::messages.steps.install'),      'route' => 'installwizard.finish'],
        ];
    }

    protected function appName(): string
    {
        return (string) (
            $this->getState('app.APP_NAME')
            ?: env('APP_NAME')
            ?: config('app.name')
            ?: config('installwizard.branding.fallback_app_name', 'Application')
        );
    }

    protected function state(): array
    {
        return (array) session(config('installwizard.session_key', 'installwizard.state'), []);
    }

    protected function getState(string $key, mixed $default = null): mixed
    {
        return data_get($this->state(), $key, $default);
    }

    protected function putState(string $bucket, array $values): void
    {
        $key   = config('installwizard.session_key', 'installwizard.state');
        $state = (array) session($key, []);

        $state[$bucket] = array_merge((array) ($state[$bucket] ?? []), $values);

        session()->put($key, $state);
    }
}
