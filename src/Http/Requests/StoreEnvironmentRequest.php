<?php

namespace Nativecodein\LaravelInstallWizard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEnvironmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'APP_NAME'     => ['required', 'string', 'max:60'],
            'APP_ENV'      => ['required', Rule::in(['local', 'development', 'staging', 'production', 'testing'])],
            'APP_DEBUG'    => ['required', Rule::in(['true', 'false'])],
            'APP_URL'      => ['required', 'url', 'max:255'],
            'APP_TIMEZONE' => ['required', 'string', 'max:64'],
            'APP_LOCALE'   => ['nullable', 'string', 'max:8'],
        ];
    }
}
