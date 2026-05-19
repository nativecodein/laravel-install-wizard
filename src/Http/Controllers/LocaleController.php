<?php

namespace Nativecodein\LaravelInstallWizard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LocaleController extends Controller
{
    public function update(Request $request)
    {
        $available = array_keys((array) config('installwizard.locales', ['en' => 'English']));

        $request->validate([
            'locale' => ['required', 'string', 'in:'.implode(',', $available)],
        ]);

        session()->put(
            (string) config('installwizard.locale_session_key', 'installwizard.locale'),
            $request->string('locale')->toString()
        );

        if ($request->wantsJson()) {
            return response()->json(['ok' => true]);
        }

        return back();
    }
}
