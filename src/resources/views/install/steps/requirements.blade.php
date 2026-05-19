@extends('installwizard::layout')

@section('content')
    <h1 class="h-page">{{ trans('installwizard::messages.requirements.heading') }}</h1>
    <p class="h-sub">{{ trans('installwizard::messages.requirements.php_running', ['current' => $php['current'], 'required' => $php['required']]) }}</p>

    <ul class="check-list cols-2">
        @foreach ($extensions as $ext)
            <li class="check-row">
                <span class="name">{{ $ext['name'] }}</span>
                @if ($ext['loaded'])
                    <span class="badge badge-ok">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        {{ trans('installwizard::messages.requirements.loaded') }}
                    </span>
                @else
                    <span class="badge badge-bad">{{ trans('installwizard::messages.requirements.missing') }}</span>
                @endif
            </li>
        @endforeach
    </ul>

    <div class="row-between">
        <a href="{{ route('installwizard.database') }}" class="btn btn-ghost">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            {{ trans('installwizard::messages.common.back') }}
        </a>
        <a href="{{ route('installwizard.permissions') }}" class="btn {{ $allOk ? 'btn-primary' : 'btn-secondary' }}" {{ $allOk ? '' : 'aria-disabled=true style=pointer-events:none;opacity:0.5' }}>
            {{ trans('installwizard::messages.common.continue') }}
        </a>
    </div>
@endsection
