<?php

namespace Nativecodein\LaravelInstallWizard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWelcomeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'APP_NAME' => ['required', 'string', 'min:1', 'max:60', 'regex:/^[\w\s\-\.\']+$/u'],
        ];
    }

    public function messages(): array
    {
        return [
            'APP_NAME.regex' => 'The application name may only contain letters, numbers, spaces, dashes, dots and apostrophes.',
        ];
    }
}
