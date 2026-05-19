/*
 * installwizard — published JS.
 *
 * The layout ships behaviour inline, so this file is only needed if you
 * bundle the wizard JS into your own pipeline. Publish with:
 *
 *   php artisan vendor:publish --tag=installwizard-assets
 *
 * Exposes window.LaravelInstallWizard with:
 *   - applyTheme(theme)     // 'light' | 'dark' | 'system'
 *   - fireConfetti(opts?)   // canvas-id, duration, colors
 *   - setupMenus()          // (re)bind menus after dynamic content
 */

(function (global) {
    'use strict';

    const onReady = (cb) => (document.readyState !== 'loading') ? cb() : document.addEventListener('DOMContentLoaded', cb);

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

    function closeAllMenus(except) {
        document.querySelectorAll('[data-menu]').forEach(m => {
            if (m === except) return;
            const c = m.querySelector('[data-menu-content]');
            const t = m.querySelector('[data-menu-trigger]');
            if (c) c.dataset.open = 'false';
            if (t) t.setAttribute('aria-expanded', 'false');
        });
    }

    function setupMenus() {
        document.querySelectorAll('[data-menu]').forEach(menu => {
            const trigger = menu.querySelector('[data-menu-trigger]');
            const content = menu.querySelector('[data-menu-content]');
            if (!trigger || !content || trigger.dataset.bound) return;
            trigger.dataset.bound = '1';
            trigger.addEventListener('click', (e) => {
                e.stopPropagation();
                const open = content.dataset.open === 'true';
                closeAllMenus(menu);
                content.dataset.open = open ? 'false' : 'true';
                trigger.setAttribute('aria-expanded', !open);
            });
        });
    }

    function fireConfetti(opts) {
        opts = opts || {};
        const canvas = document.getElementById(opts.canvasId || 'confetti-canvas');
        if (!canvas) return;
        canvas.hidden = false;
        const ctx = canvas.getContext('2d');
        const W = canvas.width = window.innerWidth;
        const H = canvas.height = window.innerHeight;
        const colors = opts.colors || ['#0ea5e9', '#a855f7', '#10b981', '#f59e0b', '#ef4444', '#6366f1'];
        const duration = opts.duration || 3200;
        const pieces = [];
        for (let i = 0; i < (opts.count || 160); i++) {
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
                p.x += p.vx; p.y += p.vy; p.vy += 0.05; p.rot += p.vr;
                ctx.save();
                ctx.translate(p.x, p.y);
                ctx.rotate(p.rot);
                ctx.fillStyle = p.color;
                ctx.fillRect(-p.size / 2, -p.size / 2, p.size, p.size * 0.4);
                ctx.restore();
            });
            if (Date.now() - start < duration) requestAnimationFrame(loop);
            else ctx.clearRect(0, 0, W, H);
        })();
    }

    onReady(() => {
        let theme = 'system';
        try { theme = localStorage.getItem('installwizard.theme') || document.documentElement.dataset.themeDefault || 'system'; } catch (e) {}
        applyTheme(theme);
        setupMenus();
        document.addEventListener('click', () => closeAllMenus());
        document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeAllMenus(); });
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener?.('change', () => {
            const current = document.documentElement.dataset.theme || 'system';
            if (current === 'system') applyTheme('system');
        });
        document.querySelectorAll('[data-theme-option]').forEach(btn => {
            btn.addEventListener('click', () => { applyTheme(btn.dataset.themeOption); closeAllMenus(); });
        });
    });

    global.LaravelInstallWizard = { applyTheme, fireConfetti, setupMenus };
})(typeof window !== 'undefined' ? window : globalThis);
