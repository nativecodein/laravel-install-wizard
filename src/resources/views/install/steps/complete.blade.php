@extends('installwizard::layout')

@section('content')
    <div style="max-width: 32rem; margin: 0 auto; text-align: center;">
        <div style="margin: 0 auto 1.25rem; height: 3.5rem; width: 3.5rem; border-radius: 999px; display:inline-flex; align-items:center; justify-content:center; background: hsl(var(--success) / 0.12); color: hsl(var(--success));">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
        </div>

        <h1 class="h-page">{{ trans('installwizard::messages.complete.heading', ['app' => $appName]) }}</h1>
        <p class="h-sub">{{ trans('installwizard::messages.complete.subhead') }}</p>

        @if (! empty($log))
            <details style="text-align: start; background: hsl(var(--card)); border: 1px solid hsl(var(--border)); border-radius: var(--radius); padding: 0.75rem 1rem; margin-bottom: 1.25rem;">
                <summary style="cursor:pointer; color: hsl(var(--muted-foreground)); font-size: 0.875rem;">{{ trans('installwizard::messages.complete.log') }}</summary>
                <ul style="margin: 0.5rem 0 0; padding: 0; list-style: none;">
                    @foreach ($log as $line)
                        <li style="display:flex; align-items:flex-start; gap:0.5rem; font-family: ui-monospace, SFMono-Regular, Menlo, monospace; font-size: 0.8rem; padding: 0.2rem 0;">
                            <span style="color: hsl(var(--success));">✓</span>
                            <span>{{ $line }}</span>
                        </li>
                    @endforeach
                </ul>
            </details>
        @endif

        <a href="{{ $redirect }}" id="redirect-btn" class="btn btn-primary btn-lg">
            {{ trans('installwizard::messages.complete.open_app', ['app' => $appName]) }}
        </a>
    </div>

    @push('scripts')
    <script>
        (function () {
            const canvas = document.getElementById('confetti-canvas');
            if (canvas) canvas.hidden = false;

            function fireConfetti() {
                if (!canvas) return;
                const ctx = canvas.getContext('2d');
                const W = canvas.width = window.innerWidth;
                const H = canvas.height = window.innerHeight;
                const colors = ['#0ea5e9', '#a855f7', '#10b981', '#f59e0b', '#ef4444', '#6366f1'];
                const pieces = [];
                for (let i = 0; i < 160; i++) {
                    pieces.push({
                        x: Math.random() * W,
                        y: -20 - Math.random() * H * 0.5,
                        vx: (Math.random() - 0.5) * 6,
                        vy: 2 + Math.random() * 4,
                        size: 4 + Math.random() * 6,
                        rot: Math.random() * Math.PI,
                        vr: (Math.random() - 0.5) * 0.2,
                        color: colors[i % colors.length],
                    });
                }
                const start = Date.now();
                (function loop() {
                    ctx.clearRect(0, 0, W, H);
                    pieces.forEach(p => {
                        p.x += p.vx;
                        p.y += p.vy;
                        p.vy += 0.05;
                        p.rot += p.vr;
                        ctx.save();
                        ctx.translate(p.x, p.y);
                        ctx.rotate(p.rot);
                        ctx.fillStyle = p.color;
                        ctx.fillRect(-p.size / 2, -p.size / 2, p.size, p.size * 0.4);
                        ctx.restore();
                    });
                    if (Date.now() - start < 3200) requestAnimationFrame(loop);
                    else ctx.clearRect(0, 0, W, H);
                })();
            }
            fireConfetti();

            setTimeout(() => { window.location.href = @json($redirect); }, 3800);
        })();
    </script>
    @endpush
@endsection
