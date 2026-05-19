<?php

namespace Nativecodein\LaravelInstallWizard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDatabaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $supported = array_keys((array) config('installwizard.database_connections', [
            'mysql' => 'MySQL',
        ]));

        $rules = [
            'DB_CONNECTION' => ['required', Rule::in($supported)],
            'DB_DATABASE'   => ['required', 'string', 'max:255'],
        ];

        if ($this->input('DB_CONNECTION') !== 'sqlite') {
            $rules += [
                'DB_HOST'     => ['required', 'string', 'max:255'],
                'DB_PORT'     => ['required', 'string', 'max:10'],
                'DB_USERNAME' => ['required', 'string', 'max:255'],
                'DB_PASSWORD' => ['nullable', 'string', 'max:255'],
            ];
        }

        return $rules;
    }
}
