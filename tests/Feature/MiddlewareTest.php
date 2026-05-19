<?php

namespace Nativecodein\LaravelInstallWizard\Tests\Feature;

use Illuminate\Support\Facades\Route;
use Nativecodein\LaravelInstallWizard\Http\Middleware\EnsureApplicationIsInstalled;
use Nativecodein\LaravelInstallWizard\Tests\TestCase;

class MiddlewareTest extends TestCase
{
    protected function defineRoutes($router): void
    {
        $router->middleware(['web', EnsureApplicationIsInstalled::class])->group(function () use ($router) {
            $router->get('/protected', fn () => 'protected-content');
        });
    }

    public function test_redirects_to_installer_when_not_installed(): void
    {
        $this->get('/protected')
            ->assertRedirect(route('installwizard.index'));
    }

    public function test_allows_access_when_installed(): void
    {
        $this->markAsInstalled();

        $this->get('/protected')
            ->assertOk()
            ->assertSee('protected-content');
    }

    public function test_install_routes_are_always_accessible(): void
    {
        $this->get(route('installwizard.welcome'))->assertOk();
    }

    public function test_does_not_redirect_install_paths(): void
    {
        $this->get('/install')->assertStatus(302); // index -> welcome
    }

    public function test_returns_json_response_for_api_requests(): void
    {
        $this->getJson('/protected')
            ->assertStatus(503)
            ->assertJsonStructure(['message', 'install_url']);
    }

    public function test_stores_intended_url_in_session(): void
    {
        $this->get('/protected');

        $key = config('installwizard.intended_url_key');
        $this->assertSame(url('/protected'), session($key));
    }
}
