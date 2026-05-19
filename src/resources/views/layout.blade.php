@php
    $locale = app()->getLocale();
    $rtl    = in_array($locale, (array) config('installwizard.rtl_locales', []), true);
    $dir    = $rtl ? 'rtl' : 'ltr';
    $locales = (array) config('installwizard.locales', ['en' => 'English']);
    $defaultTheme = (string) config('installwizard.default_theme', 'system');
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $dir }}" data-theme-default="{{ $defaultTheme }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $installerTitle ?? trans('installwizard::messages.installer_title', ['app' => config('app.name', 'Application')]) }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <script>
        (function () {
            try {
                const stored = localStorage.getItem('installwizard.theme');
                const def = document.documentElement.dataset.themeDefault || 'system';
                const theme = stored || def;
                const root = document.documentElement;
                const sysDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                const isDark = theme === 'dark' || (theme === 'system' && sysDark);
                root.classList.toggle('dark', isDark);
                root.dataset.theme = theme;
            } catch (e) {}
        })();
    </script>

    <style>
        :root {
            --background: 0 0% 100%;
            --foreground: 240 10% 3.9%;
            --card: 0 0% 100%;
            --card-foreground: 240 10% 3.9%;
            --popover: 0 0% 100%;
            --popover-foreground: 240 10% 3.9%;
            --primary: 240 5.9% 10%;
            --primary-foreground: 0 0% 98%;
            --secondary: 240 4.8% 95.9%;
            --secondary-foreground: 240 5.9% 10%;
            --muted: 240 4.8% 95.9%;
            --muted-foreground: 240 3.8% 46.1%;
            --accent: 240 4.8% 95.9%;
            --accent-foreground: 240 5.9% 10%;
            --destructive: 0 84.2% 60.2%;
            --destructive-foreground: 0 0% 98%;
            --success: 142.1 76.2% 36.3%;
            --success-foreground: 355.7 100% 97.3%;
            --warning: 38 92% 50%;
            --warning-foreground: 48 96% 89%;
            --border: 240 5.9% 90%;
            --input: 240 5.9% 90%;
            --ring: 240 5.9% 10%;
            --radius: 0.625rem;
        }

        .dark {
            --background: 240 10% 3.9%;
            --foreground: 0 0% 98%;
            --card: 240 10% 5.5%;
            --card-foreground: 0 0% 98%;
            --popover: 240 10% 5.5%;
            --popover-foreground: 0 0% 98%;
            --primary: 0 0% 98%;
            --primary-foreground: 240 5.9% 10%;
            --secondary: 240 3.7% 15.9%;
            --secondary-foreground: 0 0% 98%;
            --muted: 240 3.7% 15.9%;
            --muted-foreground: 240 5% 64.9%;
            --accent: 240 3.7% 15.9%;
            --accent-foreground: 0 0% 98%;
            --destructive: 0 72% 50%;
            --destructive-foreground: 0 0% 98%;
            --success: 142 70% 45%;
            --success-foreground: 144 70% 10%;
            --border: 240 3.7% 15.9%;
            --input: 240 3.7% 15.9%;
            --ring: 240 4.9% 83.9%;
        }

        * { box-sizing: border-box; }
        html, body { height: 100%; }
        body {
            margin: 0;
            font-family: 'Outfit', ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-feature-settings: "rlig" 1, "calt" 1;
            background: hsl(var(--background));
            color: hsl(var(--foreground));
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
        }
        [dir="rtl"] body { font-family: 'Outfit', 'Noto Sans Arabic', system-ui, sans-serif; }

        .container { max-width: 56rem; margin: 0 auto; padding: 2.5rem 1.25rem; }
        @media (min-width: 640px) { .container { padding: 3rem 1.5rem; } }

        .h-header { display: flex; align-items: center; justify-content: space-between; gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap; }
        .brand { display: inline-flex; align-items: center; gap: 0.625rem; text-decoration: none; color: hsl(var(--foreground)); }
        .brand-mark {
            display: inline-flex; align-items: center; justify-content: center;
            height: 2rem; width: 2rem; border-radius: 0.5rem;
            background: hsl(var(--primary)); color: hsl(var(--primary-foreground));
        }
        .brand-name { font-weight: 600; font-size: 0.95rem; letter-spacing: -0.01em; }

        .toolbar { display: inline-flex; align-items: center; gap: 0.5rem; }

        .theme-toggle, .lang-toggle {
            position: relative;
        }
        .icon-button {
            display: inline-flex; align-items: center; justify-content: center; gap: 0.375rem;
            height: 2.25rem; padding: 0 0.625rem; min-width: 2.25rem;
            border-radius: calc(var(--radius) - 2px);
            background: hsl(var(--background));
            color: hsl(var(--foreground));
            border: 1px solid hsl(var(--border));
            font: inherit; font-size: 0.875rem; line-height: 1;
            cursor: pointer; transition: background .15s ease, border-color .15s ease, color .15s ease;
        }
        .icon-button:hover { background: hsl(var(--accent)); }
        .icon-button:focus-visible { outline: 2px solid hsl(var(--ring)); outline-offset: 2px; }
        .icon-button svg { width: 1rem; height: 1rem; }

        .menu {
            position: absolute; top: calc(100% + 0.375rem); inset-inline-end: 0;
            min-width: 11rem; padding: 0.25rem;
            background: hsl(var(--popover)); color: hsl(var(--popover-foreground));
            border: 1px solid hsl(var(--border)); border-radius: var(--radius);
            box-shadow: 0 8px 24px -8px rgba(0,0,0,0.18), 0 2px 4px rgba(0,0,0,0.06);
            opacity: 0; transform: translateY(-4px) scale(0.98); transform-origin: top right;
            transition: opacity .12s ease, transform .12s ease;
            pointer-events: none; z-index: 50;
        }
        .menu[data-open="true"] { opacity: 1; transform: translateY(0) scale(1); pointer-events: auto; }
        .menu-item {
            display: flex; align-items: center; gap: 0.5rem;
            width: 100%; padding: 0.5rem 0.625rem;
            background: transparent; border: 0; color: inherit;
            font: inherit; font-size: 0.875rem; text-align: start;
            border-radius: calc(var(--radius) - 4px); cursor: pointer;
        }
        .menu-item:hover, .menu-item[aria-selected="true"] { background: hsl(var(--accent)); color: hsl(var(--accent-foreground)); }
        .menu-item .check { margin-inline-start: auto; opacity: 0; }
        .menu-item[aria-selected="true"] .check { opacity: 1; }
        .menu-section-label { padding: 0.5rem 0.625rem 0.25rem; font-size: 0.75rem; color: hsl(var(--muted-foreground)); }

        .progress { margin-bottom: 1.5rem; }
        .step-list {
            list-style: none; padding: 0; margin: 0 0 0.625rem;
            display: grid; grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 0.5rem;
        }
        @media (min-width: 640px) { .step-list { grid-template-columns: repeat(3, minmax(0, 1fr)); } }
        @media (min-width: 768px) { .step-list { grid-template-columns: repeat(6, minmax(0, 1fr)); } }
        .step-item { display: flex; align-items: center; gap: 0.5rem; min-width: 0; }
        .step-dot {
            display: inline-flex; align-items: center; justify-content: center;
            height: 1.5rem; width: 1.5rem; border-radius: 999px;
            font-size: 0.7rem; font-weight: 600;
            background: hsl(var(--background)); color: hsl(var(--muted-foreground));
            border: 1px solid hsl(var(--border));
            transition: all .2s ease;
        }
        .step-dot.done { background: hsl(var(--primary)); color: hsl(var(--primary-foreground)); border-color: hsl(var(--primary)); }
        .step-dot.active { background: hsl(var(--primary)); color: hsl(var(--primary-foreground)); border-color: hsl(var(--primary)); }
        .step-dot svg { width: 0.75rem; height: 0.75rem; }
        .step-label { font-size: 0.8rem; color: hsl(var(--muted-foreground)); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .step-label.active { color: hsl(var(--foreground)); font-weight: 500; }
        .progress-track { height: 0.25rem; width: 100%; background: hsl(var(--secondary)); border-radius: 999px; overflow: hidden; }
        .progress-bar { height: 100%; background: hsl(var(--primary)); border-radius: 999px; transition: width .4s ease; }

        .card {
            background: hsl(var(--card)); color: hsl(var(--card-foreground));
            border: 1px solid hsl(var(--border)); border-radius: var(--radius);
            padding: 1.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }
        @media (min-width: 640px) { .card { padding: 2.25rem; } }

        h1.h-page { font-size: 1.75rem; font-weight: 600; letter-spacing: -0.025em; line-height: 1.1; margin: 0 0 0.5rem; }
        @media (min-width: 640px) { h1.h-page { font-size: 2rem; } }
        p.h-sub { color: hsl(var(--muted-foreground)); font-size: 0.95rem; margin: 0 0 1.75rem; }

        .grid-2 { display: grid; grid-template-columns: 1fr; gap: 1rem; }
        @media (min-width: 640px) { .grid-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        .col-2 { grid-column: span 1; }
        @media (min-width: 640px) { .col-2 { grid-column: span 2; } }

        .field { display: flex; flex-direction: column; gap: 0.375rem; }
        .label { font-size: 0.85rem; font-weight: 500; color: hsl(var(--foreground)); }
        .hint  { font-size: 0.75rem; color: hsl(var(--muted-foreground)); }

        .input, .select {
            height: 2.5rem; padding: 0 0.75rem;
            background: hsl(var(--background)); color: hsl(var(--foreground));
            border: 1px solid hsl(var(--input)); border-radius: calc(var(--radius) - 2px);
            font: inherit; font-size: 0.9rem;
            transition: border-color .15s ease, box-shadow .15s ease;
            width: 100%;
        }
        .input::placeholder { color: hsl(var(--muted-foreground)); }
        .input:focus, .select:focus { outline: none; border-color: hsl(var(--ring)); box-shadow: 0 0 0 3px hsl(var(--ring) / 0.15); }
        .input-lg { height: 3rem; font-size: 1rem; padding: 0 1rem; }

        .btn {
            display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem;
            height: 2.5rem; padding: 0 1rem; min-width: 5rem;
            font: inherit; font-size: 0.9rem; font-weight: 500; line-height: 1;
            border-radius: calc(var(--radius) - 2px); cursor: pointer;
            transition: background .15s ease, color .15s ease, border-color .15s ease, opacity .15s ease, transform .08s ease;
            border: 1px solid transparent;
        }
        .btn:active { transform: translateY(1px); }
        .btn:focus-visible { outline: 2px solid hsl(var(--ring)); outline-offset: 2px; }
        .btn:disabled { opacity: 0.6; cursor: not-allowed; }
        .btn-primary { background: hsl(var(--primary)); color: hsl(var(--primary-foreground)); }
        .btn-primary:hover:not(:disabled) { background: hsl(var(--primary) / 0.9); }
        .btn-secondary { background: hsl(var(--secondary)); color: hsl(var(--secondary-foreground)); border-color: hsl(var(--border)); }
        .btn-secondary:hover:not(:disabled) { background: hsl(var(--accent)); }
        .btn-outline { background: hsl(var(--background)); color: hsl(var(--foreground)); border-color: hsl(var(--border)); }
        .btn-outline:hover:not(:disabled) { background: hsl(var(--accent)); }
        .btn-ghost { background: transparent; color: hsl(var(--muted-foreground)); padding: 0 0.5rem; }
        .btn-ghost:hover:not(:disabled) { color: hsl(var(--foreground)); }
        .btn-lg { height: 3rem; padding: 0 1.25rem; font-size: 1rem; min-width: 8rem; }

        .alert {
            border-radius: calc(var(--radius) - 2px); border: 1px solid; padding: 0.625rem 0.875rem;
            font-size: 0.875rem; margin-bottom: 1rem;
        }
        .alert-success { background: hsl(var(--success) / 0.1); color: hsl(var(--success)); border-color: hsl(var(--success) / 0.3); }
        .alert-error   { background: hsl(var(--destructive) / 0.1); color: hsl(var(--destructive)); border-color: hsl(var(--destructive) / 0.3); }

        .row-between { display: flex; align-items: center; justify-content: space-between; gap: 0.75rem; margin-top: 1.25rem; }
        .row-end     { display: flex; align-items: center; justify-content: flex-end; gap: 0.5rem; margin-top: 1.25rem; }

        .badge {
            display: inline-flex; align-items: center; gap: 0.25rem;
            padding: 0.125rem 0.5rem; border-radius: 999px;
            font-size: 0.7rem; font-weight: 500; border: 1px solid;
        }
        .badge-ok   { background: hsl(var(--success) / 0.1); color: hsl(var(--success)); border-color: hsl(var(--success) / 0.3); }
        .badge-bad  { background: hsl(var(--destructive) / 0.1); color: hsl(var(--destructive)); border-color: hsl(var(--destructive) / 0.3); }
        .badge-warn { background: hsl(var(--warning) / 0.1); color: hsl(var(--warning)); border-color: hsl(var(--warning) / 0.3); }

        .check-list { list-style: none; padding: 0; margin: 0; display: grid; grid-template-columns: 1fr; gap: 0.5rem; }
        @media (min-width: 640px) { .check-list.cols-2 { grid-template-columns: 1fr 1fr; } }
        .check-row {
            display: flex; align-items: center; justify-content: space-between; gap: 0.75rem;
            padding: 0.625rem 0.875rem; border: 1px solid hsl(var(--border)); border-radius: calc(var(--radius) - 2px);
            background: hsl(var(--card));
        }
        .check-row .name { font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace; font-size: 0.85rem; }
        .check-row .meta { font-size: 0.7rem; color: hsl(var(--muted-foreground)); }

        .footer { text-align: center; font-size: 0.75rem; color: hsl(var(--muted-foreground)); margin-top: 2.5rem; }

        .spinner {
            width: 0.875rem; height: 0.875rem; border-radius: 50%;
            border: 2px solid currentColor; border-top-color: transparent;
            animation: liw-spin .8s linear infinite; display: inline-block;
        }
        @keyframes liw-spin { to { transform: rotate(360deg); } }

        .fade-in { animation: liw-fade .4s ease both; }
        @keyframes liw-fade { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }

        .sr-only { position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0,0,0,0); white-space: nowrap; border: 0; }

        canvas#confetti-canvas { position: fixed; inset: 0; pointer-events: none; z-index: 50; }

        [dir="rtl"] .menu { transform-origin: top left; }
        [dir="rtl"] .menu-item .check { margin-inline-start: auto; }
    </style>
    @stack('head')
</head>
<body>
    <div class="container">
        <header class="h-header">
            <a href="{{ route('installwizard.welcome') }}" class="brand">
                <span class="brand-mark" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2 4 7v6c0 5 4 8 8 9 4-1 8-4 8-9V7l-8-5Z" />
                        <path d="m9 12 2 2 4-4" />
                    </svg>
                </span>
                <span class="brand-name">{{ $installerTitle ?? trans('installwizard::messages.installer_title', ['app' => 'Application']) }}</span>
            </a>

            <div class="toolbar">
                <div class="lang-toggle" data-menu>
                    <button type="button" class="icon-button" data-menu-trigger aria-haspopup="menu" aria-expanded="false" aria-label="{{ trans('installwizard::messages.language.label') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M2 12h20"></path>
                            <path d="M12 2a15 15 0 0 1 0 20"></path>
                            <path d="M12 2a15 15 0 0 0 0 20"></path>
                        </svg>
                        <span>{{ strtoupper($locale) }}</span>
                    </button>
                    <div class="menu" role="menu" data-menu-content>
                        <div class="menu-section-label">{{ trans('installwizard::messages.language.label') }}</div>
                        @foreach ($locales as $code => $name)
                            <form method="POST" action="{{ route('installwizard.locale.update') }}" role="none">
                                @csrf
                                <input type="hidden" name="locale" value="{{ $code }}" />
                                <button type="submit" class="menu-item" role="menuitemradio" aria-selected="{{ $locale === $code ? 'true' : 'false' }}">
                                    <span>{{ $name }}</span>
                                    <svg class="check" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                </button>
                            </form>
                        @endforeach
                    </div>
                </div>

                <div class="theme-toggle" data-menu>
                    <button type="button" class="icon-button" data-menu-trigger aria-haspopup="menu" aria-expanded="false" aria-label="{{ trans('installwizard::messages.theme.label') }}">
                        <svg data-theme-icon="light" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="12" cy="12" r="4"></circle>
                            <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"></path>
                        </svg>
                        <svg data-theme-icon="dark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="display:none">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                        </svg>
                        <svg data-theme-icon="system" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="display:none">
                            <rect x="2" y="3" width="20" height="14" rx="2"></rect>
                            <line x1="8" y1="21" x2="16" y2="21"></line>
                            <line x1="12" y1="17" x2="12" y2="21"></line>
                        </svg>
                    </button>
                    <div class="menu" role="menu" data-menu-content>
                        <div class="menu-section-label">{{ trans('installwizard::messages.theme.label') }}</div>
                        @foreach (['light', 'dark', 'system'] as $t)
                            <button type="button" class="menu-item" role="menuitemradio" data-theme-option="{{ $t }}">
                                <span>{{ trans('installwizard::messages.theme.'.$t) }}</span>
                                <svg class="check" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </header>

        @isset($steps)
            @php
                $currentIndex = collect($steps)->search(fn ($s) => $s['key'] === ($step ?? null));
                $currentIndex = $currentIndex === false ? 0 : $currentIndex;
                $progress = max(0, min(100, (($currentIndex + 1) / max(count($steps), 1)) * 100));
            @endphp
            <nav aria-label="Progress" class="progress">
                <ol class="step-list">
                    @foreach ($steps as $i => $s)
                        @php $done = $i < $currentIndex; $active = $i === $currentIndex; @endphp
                        <li class="step-item">
                            <span class="step-dot {{ $done ? 'done' : ($active ? 'active' : '') }}" aria-current="{{ $active ? 'step' : 'false' }}">
                                @if ($done)
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                @else
                                    {{ $i + 1 }}
                                @endif
                            </span>
                            <span class="step-label {{ $active ? 'active' : '' }}">{{ $s['label'] }}</span>
                        </li>
                    @endforeach
                </ol>
                <div class="progress-track" role="progressbar" aria-valuenow="{{ (int) $progress }}" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar" style="width: {{ $progress }}%"></div>
                </div>
            </nav>
        @endisset

        <main class="card fade-in" id="wizard-card">
            @if (session('status'))
                <div class="alert alert-success" role="status">{{ session('status') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-error" role="alert">{{ session('error') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-error" role="alert">
                    <ul style="margin:0; padding-inline-start:1rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="footer">
            {{ trans('installwizard::messages.powered_by') }}
        </footer>
    </div>

    <canvas id="confetti-canvas" hidden></canvas>

    <script>
        (function () {
            'use strict';

            // ---------- Theme manager ----------
            const themeToggle = document.querySelector('.theme-toggle');
            function applyTheme(theme) {
                const root = document.documentElement;
                const sysDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                const isDark = theme === 'dark' || (theme === 'system' && sysDark);
                root.classList.toggle('dark', isDark);
                root.dataset.theme = theme;

                document.querySelectorAll('[data-theme-icon]').forEach(el => el.style.display = 'none');
                const iconEl = document.querySelector('[data-theme-icon="' + theme + '"]');
                if (iconEl) iconEl.style.display = '';

                document.querySelectorAll('[data-theme-option]').forEach(el => {
                    el.setAttribute('aria-selected', el.dataset.themeOption === theme ? 'true' : 'false');
                });

                try { localStorage.setItem('installwizard.theme', theme); } catch (e) {}
            }
            const initialTheme = document.documentElement.dataset.theme || document.documentElement.dataset.themeDefault || 'system';
            applyTheme(initialTheme);

            if (themeToggle) {
                themeToggle.querySelectorAll('[data-theme-option]').forEach(btn => {
                    btn.addEventListener('click', () => {
                        applyTheme(btn.dataset.themeOption);
                        closeAllMenus();
                    });
                });
            }

            window.matchMedia('(prefers-color-scheme: dark)').addEventListener?.('change', () => {
                const current = document.documentElement.dataset.theme || 'system';
                if (current === 'system') applyTheme('system');
            });

            // ---------- Menus (theme & language) ----------
            function closeAllMenus(except) {
                document.querySelectorAll('[data-menu]').forEach(m => {
                    if (m === except) return;
                    const c = m.querySelector('[data-menu-content]');
                    const t = m.querySelector('[data-menu-trigger]');
                    if (c) c.dataset.open = 'false';
                    if (t) t.setAttribute('aria-expanded', 'false');
                });
            }
            document.querySelectorAll('[data-menu]').forEach(menu => {
                const trigger = menu.querySelector('[data-menu-trigger]');
                const content = menu.querySelector('[data-menu-content]');
                if (!trigger || !content) return;
                trigger.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const open = content.dataset.open === 'true';
                    closeAllMenus(menu);
                    content.dataset.open = open ? 'false' : 'true';
                    trigger.setAttribute('aria-expanded', !open);
                });
            });
            document.addEventListener('click', () => closeAllMenus());
            document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeAllMenus(); });
        })();
    </script>

    @stack('scripts')
</body>
</html>
