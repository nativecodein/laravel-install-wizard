<?php

namespace Nativecodein\LaravelInstallWizard\Tests\Feature;

use Nativecodein\LaravelInstallWizard\Tests\TestCase;

class LocaleSwitcherTest extends TestCase
{
    public function test_locale_is_persisted_in_session(): void
    {
        $this->post(route('installwizard.locale.update'), ['locale' => 'es'])
            ->assertRedirect();

        $this->assertSame('es', session(config('installwizard.locale_session_key')));
    }

    public function test_invalid_locale_is_rejected(): void
    {
        $this->post(route('installwizard.locale.update'), ['locale' => 'xx'])
            ->assertSessionHasErrors('locale');
    }

    public function test_unknown_locale_falls_back_to_english(): void
    {
        session([config('installwizard.locale_session_key') => 'xx']);

        $this->get(route('installwizard.welcome'))->assertOk();

        $this->assertSame('en', app()->getLocale());
    }

    public function test_translations_apply_per_locale(): void
    {
        session([config('installwizard.locale_session_key') => 'fr']);
        $this->get(route('installwizard.welcome'))->assertSee('Bienvenue', false);

        session([config('installwizard.locale_session_key') => 'ja']);
        $this->get(route('installwizard.welcome'))->assertSee('ようこそ', false);

        session([config('installwizard.locale_session_key') => 'ar']);
        $response = $this->get(route('installwizard.welcome'));
        $response->assertSee('dir="rtl"', false);
    }
}
