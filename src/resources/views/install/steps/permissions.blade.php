@extends('installwizard::layout')

@section('content')
    <h1 class="h-page">{{ trans('installwizard::messages.permissions.heading') }}</h1>
    <p class="h-sub">{{ trans('installwizard::messages.permissions.subheading') }}</p>

    <ul class="check-list">
        @foreach ($paths as $p)
            <li class="check-row">
                <div style="min-width:0;">
                    <p class="name" style="margin:0;">{{ $p['path'] }}</p>
                    <p class="meta" style="margin:0; overflow:hidden; text-overflow:ellipsis;">{{ $p['absolute'] }}</p>
                </div>
                @if ($p['exists'] && $p['writable'])
                    <span class="badge badge-ok">{{ trans('installwizard::messages.permissions.writable') }}</span>
                @elseif (! $p['exists'])
                    <span class="badge badge-warn">{{ trans('installwizard::messages.permissions.not_found') }}</span>
                @else
                    <span class="badge badge-bad">{{ trans('installwizard::messages.permissions.not_writable') }}</span>
                @endif
            </li>
        @endforeach
    </ul>

    <div class="row-between">
        <a href="{{ route('installwizard.requirements') }}" class="btn btn-ghost">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            {{ trans('installwizard::messages.common.back') }}
        </a>
        <a href="{{ route('installwizard.finish') }}" class="btn {{ $allOk ? 'btn-primary' : 'btn-secondary' }}" {{ $allOk ? '' : 'aria-disabled=true style=pointer-events:none;opacity:0.5' }}>
            {{ trans('installwizard::messages.common.continue') }}
        </a>
    </div>
@endsection
