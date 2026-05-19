@extends('installwizard::layout')

@section('content')
    <h1 class="h-page">{{ trans('installwizard::messages.environment.heading') }}</h1>
    <p class="h-sub">{{ trans('installwizard::messages.environment.subheading') }}</p>

    <form action="{{ route('installwizard.environment.store') }}" method="POST" class="grid-2">
        @csrf

        <div class="field col-2">
            <label class="label" for="APP_NAME">{{ trans('installwizard::messages.environment.app_name') }}</label>
            <input id="APP_NAME" name="APP_NAME" type="text" required class="input"
                   value="{{ old('APP_NAME', $values['APP_NAME'] ?? '') }}" />
        </div>

        <div class="field">
            <label class="label" for="APP_ENV">{{ trans('installwizard::messages.environment.env') }}</label>
            <select id="APP_ENV" name="APP_ENV" required class="select">
                @foreach (['local','development','staging','production','testing'] as $env)
                    <option value="{{ $env }}" @selected(old('APP_ENV', $values['APP_ENV'] ?? '') === $env)>
                        {{ trans('installwizard::messages.environment.envs.'.$env) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="field">
            <label class="label" for="APP_DEBUG">{{ trans('installwizard::messages.environment.debug') }}</label>
            <select id="APP_DEBUG" name="APP_DEBUG" required class="select">
                @php $dbg = old('APP_DEBUG', ($values['APP_DEBUG'] ?? 'false')); $dbg = ($dbg === true || $dbg === 'true' || $dbg === '1') ? 'true' : 'false'; @endphp
                <option value="false" @selected($dbg === 'false')>{{ trans('installwizard::messages.environment.debug_off') }}</option>
                <option value="true"  @selected($dbg === 'true')>{{ trans('installwizard::messages.environment.debug_on') }}</option>
            </select>
        </div>

        <div class="field col-2">
            <label class="label" for="APP_URL">{{ trans('installwizard::messages.environment.url') }}</label>
            <input id="APP_URL" name="APP_URL" type="url" required class="input" placeholder="https://example.com"
                   value="{{ old('APP_URL', $values['APP_URL'] ?? '') }}" />
        </div>

        <div class="field">
            <label class="label" for="APP_TIMEZONE">{{ trans('installwizard::messages.environment.timezone') }}</label>
            <input id="APP_TIMEZONE" name="APP_TIMEZONE" type="text" required class="input" placeholder="UTC"
                   value="{{ old('APP_TIMEZONE', $values['APP_TIMEZONE'] ?? 'UTC') }}" />
        </div>

        <div class="field">
            <label class="label" for="APP_LOCALE">{{ trans('installwizard::messages.environment.locale') }}</label>
            <input id="APP_LOCALE" name="APP_LOCALE" type="text" class="input" placeholder="en"
                   value="{{ old('APP_LOCALE', $values['APP_LOCALE'] ?? 'en') }}" />
        </div>

        <div class="row-between col-2">
            <a href="{{ route('installwizard.welcome') }}" class="btn btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                {{ trans('installwizard::messages.common.back') }}
            </a>
            <button type="submit" class="btn btn-primary">{{ trans('installwizard::messages.common.continue') }}</button>
        </div>
    </form>
@endsection
