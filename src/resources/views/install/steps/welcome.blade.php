@extends('installwizard::layout')

@section('content')
    <div style="max-width: 32rem;">
        <h1 class="h-page">{{ trans('installwizard::messages.welcome.heading') }}</h1>
        <p class="h-sub">{{ trans('installwizard::messages.welcome.subheading') }}</p>

        <form action="{{ route('installwizard.welcome.store') }}" method="POST" class="grid-2">
            @csrf

            <div class="field col-2">
                <label for="APP_NAME" class="label">{{ trans('installwizard::messages.welcome.app_name') }}</label>
                <input id="APP_NAME"
                       name="APP_NAME"
                       type="text"
                       autocomplete="off"
                       autofocus
                       required
                       placeholder="{{ trans('installwizard::messages.welcome.placeholder') }}"
                       value="{{ old('APP_NAME', $appName ?? '') }}"
                       class="input input-lg" />
                <p class="hint">
                    {{ trans('installwizard::messages.common.preview') }}:
                    <span id="title-preview" style="color: hsl(var(--foreground)); font-weight: 500;">{{ trans('installwizard::messages.installer_title', ['app' => ($appName ?: 'Application')]) }}</span>
                </p>
            </div>

            <div class="row-between col-2">
                <span class="hint">{{ trans('installwizard::messages.steps.step_of', ['current' => 1, 'total' => count($steps)]) }}</span>
                <button type="submit" class="btn btn-primary">
                    {{ trans('installwizard::messages.common.continue') }}
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        (function () {
            const input = document.getElementById('APP_NAME');
            const preview = document.getElementById('title-preview');
            const titleTemplate = @json(trans('installwizard::messages.installer_title', ['app' => '__APP__']));
            if (!input || !preview) return;
            input.addEventListener('input', () => {
                const v = (input.value || '').trim() || 'Application';
                const t = titleTemplate.replace('__APP__', v);
                preview.textContent = t;
                document.title = t;
            });
        })();
    </script>
    @endpush
@endsection
