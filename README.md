<h1 align="center">laravel-install-wizard</h1>

<p align="center">
  A minimal, modern, multilingual Laravel installation wizard.<br />
  shadcn-style UI · light / dark / system theme · 10 languages · zero CDN runtime deps.
</p>

<p align="center">
  <a href="https://packagist.org/packages/nativecodein/laravel-install-wizard"><img src="https://img.shields.io/packagist/v/nativecodein/laravel-install-wizard.svg?style=flat-square" alt="Latest Version on Packagist" /></a>
  <a href="https://packagist.org/packages/nativecodein/laravel-install-wizard"><img src="https://img.shields.io/packagist/dt/nativecodein/laravel-install-wizard.svg?style=flat-square" alt="Total Downloads" /></a>
  <a href="https://packagist.org/packages/nativecodein/laravel-install-wizard"><img src="https://img.shields.io/packagist/php-v/nativecodein/laravel-install-wizard.svg?style=flat-square" alt="PHP Version" /></a>
  <a href="https://github.com/nativecodein/laravel-install-wizard/actions"><img src="https://img.shields.io/github/actions/workflow/status/nativecodein/laravel-install-wizard/tests.yml?branch=main&style=flat-square&label=tests" alt="Tests" /></a>
  <a href="LICENSE"><img src="https://img.shields.io/packagist/l/nativecodein/laravel-install-wizard.svg?style=flat-square" alt="License" /></a>
</p>

---

When a fresh Laravel app has not yet been installed, `laravel-install-wizard` gently redirects every route to a clean web-based installer. The user names the app, configures the environment and database, sees PHP requirement and folder permission checks, then clicks **Install**. A `.installed` lock file is written and the wizard never appears again.

## Table of contents

- [Highlights](#highlights)
- [Screenshots](#screenshots)
- [Requirements](#requirements)
- [Installation](#installation)
- [Quick start](#quick-start)
- [Configuration](#configuration)
- [Multilingual support](#multilingual-support)
- [Theming](#theming)
- [Customizing views and assets](#customizing-views-and-assets)
- [Resetting installation](#resetting-installation)
- [Security](#security)
- [Testing](#testing)
- [Contributing](#contributing)
- [Versioning](#versioning)
- [Credits](#credits)
- [License](#license)

## Highlights

- **Multi-step wizard** — Welcome → Environment → Database → Requirements → Permissions → Install
- **Dynamic branding** — enter `NativeCode` and the installer becomes the *NativeCode Installer* everywhere
- **Live database test** — MySQL, PostgreSQL, SQLite, SQL Server, validated before continuing
- **Safe `.env` writer** — preserves comments, leaves unrelated keys alone, validates key format
- **10 languages out of the box** — English, Spanish, French, German, Portuguese, Italian, Japanese, Chinese, Arabic (RTL), Hindi
- **Light / Dark / System theme** — `localStorage` persistence, OS-preference reactive, no FOUC
- **shadcn-style UI** — HSL CSS variables, Outfit font, accessible menus, keyboard nav
- **Zero CDN runtime deps** — all CSS, JS and confetti inlined; only Google Fonts for Outfit
- **Production-ready** — works without JavaScript via progressive enhancement
- **Auto-discovered** — drop in via Composer, no service-provider wiring required

## Screenshots

> Add screenshots here once the package is hosted. Suggested shots:
> `docs/welcome-light.png`, `docs/database-dark.png`, `docs/complete-rtl.png`.

```
[ welcome — light ]   [ database — dark ]   [ complete — confetti ]
```

## Requirements

- PHP 8.1, 8.2, 8.3 or 8.4
- Laravel 10, 11 or 12

## Installation

```bash
composer require nativecodein/laravel-install-wizard
```

The service provider is auto-registered. On first request, since `storage/.installed` doesn't exist yet, every route redirects to `/install`.

### Publishing files (optional)

```bash
# everything
php artisan vendor:publish --tag=installwizard

# or individually
php artisan vendor:publish --tag=installwizard-config
php artisan vendor:publish --tag=installwizard-views
php artisan vendor:publish --tag=installwizard-lang
php artisan vendor:publish --tag=installwizard-assets
```

## Quick start

1. Install via Composer.
2. Open any route in your Laravel app — you'll be redirected to `/install`.
3. Enter your application name (e.g. `NativeCode`).
4. Fill in environment, database, watch the requirement and permission checks pass.
5. Click **Install NativeCode**. The package writes `.env`, generates `APP_KEY`, clears caches, creates `storage/.installed`.
6. Confetti fires. You're sent back to the route you originally requested.
7. Future visits never see the wizard again.

## Configuration

After publishing the config, all behavior lives in `config/installwizard.php`:

| Key | Default | Description |
|---|---|---|
| `installed_file` | `storage_path('.installed')` | Lock file that gates the wizard |
| `route_prefix` | `install` | URL prefix for wizard routes |
| `auto_apply_middleware` | `true` | Append the gating middleware to the `web` group automatically |
| `redirect_after_install` | `/` | Fallback target after install if no intended URL |
| `required_extensions` | 12 standard exts | PHP extensions checked in step 4 |
| `writable_paths` | storage + bootstrap/cache | Paths verified in step 5 |
| `final.run_migrations` | `false` | Run `migrate --force` at the end |
| `final.run_seeders` | `false` | Run `db:seed --force` at the end |
| `final.generate_key` | `true` | Generate `APP_KEY` if missing |
| `final.clear_caches` | `true` | Clear config/route/view/cache stores |
| `locales` | 10 locales | Languages offered in the switcher |
| `rtl_locales` | `['ar','he','fa','ur']` | Forced right-to-left layout |
| `default_theme` | `system` | Initial theme: `light`, `dark`, or `system` |

## Multilingual support

Ten locales ship out of the box. A globe button in the header opens a language picker; the choice persists in the user's session.

| Code | Language | Code | Language |
|---|---|---|---|
| `en` | English | `it` | Italiano |
| `es` | Español | `ja` | 日本語 |
| `fr` | Français | `zh` | 中文 |
| `de` | Deutsch | `ar` | العربية (RTL) |
| `pt` | Português | `hi` | हिन्दी |

### Adding a language

```bash
php artisan vendor:publish --tag=installwizard-lang
```

Create `lang/vendor/installwizard/{locale}/messages.php`, copy keys from `en/messages.php`, translate, then declare it in config:

```php
// config/installwizard.php
'locales' => [
    'en' => 'English',
    'tr' => 'Türkçe', // new
],
'rtl_locales' => ['ar', 'he', 'fa', 'ur'], // add new RTL locales here
```

RTL locales render with `dir="rtl"` automatically.

## Theming

The theme toggle in the header offers three modes:

- **Light** — `<html>` has no `dark` class
- **Dark** — `<html class="dark">`
- **System** — follows `prefers-color-scheme` and reacts live to OS changes

The choice is stored in `localStorage` under `installwizard.theme`. An inline `<script>` in `<head>` applies the class before paint, so there is no flash.

### Customizing colors

Publish the views, then edit the CSS variables at the top of `resources/views/vendor/installwizard/layout.blade.php`:

```css
:root {
    --primary: 240 5.9% 10%;
    --background: 0 0% 100%;
    /* … */
}
.dark {
    --primary: 0 0% 98%;
    /* … */
}
```

All variables follow [shadcn/ui](https://ui.shadcn.com) conventions — HSL component triplets consumed with `hsl(var(--token))`.

## Customizing views and assets

```bash
php artisan vendor:publish --tag=installwizard-views
```

Views land in `resources/views/vendor/installwizard/` and override the package versions automatically. Edit them however you like — the package will pick up your changes immediately.

Assets are inlined into the layout by default, so publishing CSS/JS is only needed if you want to bundle the wizard into your own Vite pipeline.

## Resetting installation

```bash
# wipe the lock file — wizard appears on the next request
rm storage/.installed
```

Or programmatically:

```php
app(\Nativecodein\LaravelInstallWizard\Services\Installer::class)->removeLockFile();
```

## Security

- The `EnvWriter` validates env keys against `/^[A-Z_][A-Z0-9_]*$/` and rejects anything else.
- Existing comments and unrelated `.env` values are preserved during writes.
- All forms are CSRF-protected through the `web` middleware group.
- The locale switcher validates against the configured allow-list before persisting.
- The gating middleware only stores intended URLs for GET requests (never AJAX/XHR), preventing redirect loops.
- API requests get a 503 JSON response instead of a redirect, preventing fetch/axios redirect loops.
- No external CDN dependencies at runtime — all CSS, JS and confetti are inlined.

If you discover a security vulnerability, please email **security@nativecode.in** rather than opening a public issue.

## Testing

```bash
composer install
vendor/bin/phpunit
```

The suite uses [Orchestra Testbench](https://github.com/orchestral/testbench) and covers:

- redirects when not installed / access granted when installed
- creation of the `.installed` lock file
- safe `.env` writing (comment & key preservation)
- database tester (success & failure paths)
- requirement checker (extensions, writable paths)
- middleware redirect-loop avoidance
- locale persistence, RTL detection, per-locale translation rendering

## Contributing

Contributions are welcome. To get started:

```bash
git clone https://github.com/nativecodein/laravel-install-wizard.git
cd laravel-install-wizard
composer install
vendor/bin/phpunit
```

### Submitting changes

1. Fork the repo and create a feature branch: `git checkout -b feature/your-thing`
2. Write or update tests for your change.
3. Ensure `vendor/bin/phpunit` passes locally.
4. Open a pull request describing the *why* (motivation) and the *what* (change summary).

### Reporting issues

When opening a bug report, please include:

- Laravel and PHP versions (`php artisan --version`, `php -v`)
- The contents of `config/installwizard.php` if you've customized it
- Browser and OS for UI bugs
- A minimal reproduction repo if possible

### Translations

To contribute a new language, copy `src/resources/lang/en/messages.php`, translate, and submit a PR. Native speakers reviewing existing translations are also very welcome.

### Code style

This project follows PSR-12. Keep controllers thin, services pure, and Blade views accessible. Avoid introducing runtime CDN dependencies — everything that ships in the layout is inlined deliberately.

## Versioning

This package follows [Semantic Versioning](https://semver.org). Breaking changes only ship in major releases.

## Credits

- [NativeCode](https://nativecode.in) — original author and maintainer
- [Laravel](https://laravel.com) — the framework this package extends
- [shadcn/ui](https://ui.shadcn.com) — design tokens and component vocabulary that inspired the UI
- [Outfit](https://fonts.google.com/specimen/Outfit) — typeface
- All [contributors](https://github.com/nativecodein/laravel-install-wizard/contributors)

## License

The MIT License (MIT). Please see the [LICENSE](LICENSE) file for more information.

---

<p align="center">
  Contributed by <a href="https://nativecode.in"><strong>NativeCode</strong></a><br />
  <a href="https://nativecode.in">https://nativecode.in</a>
</p>
