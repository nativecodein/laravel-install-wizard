@extends('installwizard::layout')

@section('content')
    <div style="text-align: center; max-width: 28rem; margin: 0 auto;">
        <h1 class="h-page">{{ $installerTitle ?? 'Installer' }}</h1>
        <p class="h-sub">{{ trans('installwizard::messages.tagline') }}</p>
    </div>

    @push('scripts')
    <script>setTimeout(() => window.location.href = @json(route('installwizard.welcome')), 400);</script>
    @endpush
@endsection
