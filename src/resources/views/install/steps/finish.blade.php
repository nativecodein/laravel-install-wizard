@extends('installwizard::layout')

@section('content')
    <div style="max-width: 36rem; margin: 0 auto; text-align: center;">
        <h1 class="h-page">{{ trans('installwizard::messages.finish.heading') }}</h1>
        <p class="h-sub">{{ trans('installwizard::messages.finish.subheading') }}</p>

        <ul class="check-list" style="text-align: start; margin-bottom: 1.75rem;">
            <li class="check-row">
                <span class="name" style="font-family: inherit; font-size: 0.875rem;">{{ trans('installwizard::messages.finish.actions.env') }}</span>
            </li>
            @if (config('installwizard.final.generate_key', true))
                <li class="check-row">
                    <span class="name" style="font-family: inherit; font-size: 0.875rem;">{{ trans('installwizard::messages.finish.actions.app_key') }}</span>
                </li>
            @endif
            @if (config('installwizard.final.run_migrations', false))
                <li class="check-row">
                    <span class="name" style="font-family: inherit; font-size: 0.875rem;">{{ trans('installwizard::messages.finish.actions.migrations') }}</span>
                </li>
            @endif
            @if (config('installwizard.final.run_seeders', false))
                <li class="check-row">
                    <span class="name" style="font-family: inherit; font-size: 0.875rem;">{{ trans('installwizard::messages.finish.actions.seeders') }}</span>
                </li>
            @endif
            @if (config('installwizard.final.clear_caches', true))
                <li class="check-row">
                    <span class="name" style="font-family: inherit; font-size: 0.875rem;">{{ trans('installwizard::messages.finish.actions.caches') }}</span>
                </li>
            @endif
            <li class="check-row">
                <span class="name" style="font-family: inherit; font-size: 0.875rem;">{{ trans('installwizard::messages.finish.actions.lock') }}</span>
            </li>
        </ul>

        <form action="{{ route('installwizard.finish.run') }}" method="POST" id="install-form">
            @csrf
            <button type="submit" id="install-btn" class="btn btn-primary btn-lg">
                <span class="install-label">{{ trans('installwizard::messages.finish.cta', ['app' => $appName]) }}</span>
                <span class="spinner" hidden></span>
            </button>
        </form>

        <p class="hint" style="margin-top: 0.75rem;">{{ trans('installwizard::messages.finish.notice') }}</p>
    </div>

    @push('scripts')
    <script>
        (function () {
            const form = document.getElementById('install-form');
            const btn  = document.getElementById('install-btn');
            if (!form || !btn) return;
            const label = btn.querySelector('.install-label');
            const spin  = btn.querySelector('.spinner');
            const installing = @json(trans('installwizard::messages.common.installing'));
            form.addEventListener('submit', () => {
                btn.disabled = true;
                if (label) label.textContent = installing;
                if (spin) spin.hidden = false;
            });
        })();
    </script>
    @endpush
@endsection
