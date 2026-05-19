@extends('installwizard::layout')

@section('content')
    <h1 class="h-page">{{ trans('installwizard::messages.database.heading') }}</h1>
    <p class="h-sub">{{ trans('installwizard::messages.database.subheading') }}</p>

    <form id="db-form" action="{{ route('installwizard.database.store') }}" method="POST" class="grid-2"
          data-test-url="{{ route('installwizard.database.test') }}">
        @csrf

        <div class="field col-2">
            <label class="label" for="DB_CONNECTION">{{ trans('installwizard::messages.database.driver') }}</label>
            <select id="DB_CONNECTION" name="DB_CONNECTION" required class="select">
                @foreach ($connections as $key => $label)
                    <option value="{{ $key }}" @selected(old('DB_CONNECTION', $values['DB_CONNECTION'] ?? 'mysql') === $key)>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div class="field db-field">
            <label class="label" for="DB_HOST">{{ trans('installwizard::messages.database.host') }}</label>
            <input id="DB_HOST" name="DB_HOST" type="text" class="input"
                   value="{{ old('DB_HOST', $values['DB_HOST'] ?? '127.0.0.1') }}" />
        </div>

        <div class="field db-field">
            <label class="label" for="DB_PORT">{{ trans('installwizard::messages.database.port') }}</label>
            <input id="DB_PORT" name="DB_PORT" type="text" class="input"
                   value="{{ old('DB_PORT', $values['DB_PORT'] ?? '3306') }}" />
        </div>

        <div class="field col-2">
            <label class="label" for="DB_DATABASE">{{ trans('installwizard::messages.database.name') }}</label>
            <input id="DB_DATABASE" name="DB_DATABASE" type="text" required class="input"
                   value="{{ old('DB_DATABASE', $values['DB_DATABASE'] ?? '') }}" />
        </div>

        <div class="field db-field">
            <label class="label" for="DB_USERNAME">{{ trans('installwizard::messages.database.username') }}</label>
            <input id="DB_USERNAME" name="DB_USERNAME" type="text" autocomplete="off" class="input"
                   value="{{ old('DB_USERNAME', $values['DB_USERNAME'] ?? '') }}" />
        </div>

        <div class="field db-field">
            <label class="label" for="DB_PASSWORD">{{ trans('installwizard::messages.database.password') }}</label>
            <input id="DB_PASSWORD" name="DB_PASSWORD" type="password" autocomplete="new-password" class="input"
                   value="{{ old('DB_PASSWORD', $values['DB_PASSWORD'] ?? '') }}" />
        </div>

        <div class="col-2">
            <div id="db-test-result" class="alert" hidden></div>
        </div>

        <div class="row-between col-2">
            <a href="{{ route('installwizard.environment') }}" class="btn btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                {{ trans('installwizard::messages.common.back') }}
            </a>
            <div style="display:inline-flex; gap:0.5rem;">
                <button type="button" id="test-btn" class="btn btn-outline">
                    <span class="test-label">{{ trans('installwizard::messages.database.test_connection') }}</span>
                    <span class="spinner" hidden></span>
                </button>
                <button type="submit" class="btn btn-primary">{{ trans('installwizard::messages.common.continue') }}</button>
            </div>
        </div>
    </form>

    @push('scripts')
    <script>
        (function () {
            const driver = document.getElementById('DB_CONNECTION');
            const dbFields = document.querySelectorAll('.db-field');
            function toggleSqlite() {
                const isSqlite = driver.value === 'sqlite';
                dbFields.forEach(el => el.style.display = isSqlite ? 'none' : '');
            }
            driver.addEventListener('change', toggleSqlite);
            toggleSqlite();

            const btn = document.getElementById('test-btn');
            const result = document.getElementById('db-test-result');
            const form = document.getElementById('db-form');
            const spinner = btn.querySelector('.spinner');
            const label = btn.querySelector('.test-label');
            const url = form.dataset.testUrl;
            const testingLabel = @json(trans('installwizard::messages.common.testing'));
            const originalLabel = label.textContent;

            btn.addEventListener('click', async () => {
                spinner.hidden = false;
                label.textContent = testingLabel;
                btn.disabled = true;
                result.hidden = true;
                result.classList.remove('alert-success', 'alert-error');

                try {
                    const fd = new FormData(form);
                    const res = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        body: fd,
                    });
                    const data = await res.json();
                    result.hidden = false;
                    result.classList.add(data.success ? 'alert-success' : 'alert-error');
                    result.textContent = (data.success ? '✓ ' : '✕ ') + data.message;
                } catch (e) {
                    result.hidden = false;
                    result.classList.add('alert-error');
                    result.textContent = '✕ ' + e.message;
                } finally {
                    spinner.hidden = true;
                    label.textContent = originalLabel;
                    btn.disabled = false;
                }
            });
        })();
    </script>
    @endpush
@endsection
