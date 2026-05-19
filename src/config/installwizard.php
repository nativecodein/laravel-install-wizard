<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Installed Lock File
    |--------------------------------------------------------------------------
    */
    'installed_file' => storage_path('.installed'),

    /*
    |--------------------------------------------------------------------------
    | Route Configuration
    |--------------------------------------------------------------------------
    */
    'route_prefix' => 'install',

    'route_middleware' => ['web'],

    'auto_apply_middleware' => true,

    'redirect_after_install' => '/',

    /*
    |--------------------------------------------------------------------------
    | Required PHP Extensions
    |--------------------------------------------------------------------------
    */
    'required_extensions' => [
        'bcmath',
        'ctype',
        'curl',
        'dom',
        'fileinfo',
        'json',
        'mbstring',
        'openssl',
        'pcre',
        'pdo',
        'tokenizer',
        'xml',
    ],

    /*
    |--------------------------------------------------------------------------
    | Writable Paths
    |--------------------------------------------------------------------------
    */
    'writable_paths' => [
        'storage',
        'storage/framework',
        'storage/framework/cache',
        'storage/framework/sessions',
        'storage/framework/views',
        'storage/logs',
        'bootstrap/cache',
    ],

    /*
    |--------------------------------------------------------------------------
    | Final Installation Actions
    |--------------------------------------------------------------------------
    */
    'final' => [
        'run_migrations' => false,
        'run_seeders'    => false,
        'generate_key'   => true,
        'clear_caches'   => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Supported Database Connections
    |--------------------------------------------------------------------------
    */
    'database_connections' => [
        'mysql'  => 'MySQL',
        'pgsql'  => 'PostgreSQL',
        'sqlite' => 'SQLite',
        'sqlsrv' => 'SQL Server',
    ],

    /*
    |--------------------------------------------------------------------------
    | Branding
    |--------------------------------------------------------------------------
    */
    'branding' => [
        'fallback_app_name' => 'Application',
    ],

    /*
    |--------------------------------------------------------------------------
    | Localization
    |--------------------------------------------------------------------------
    |
    | Locales available in the language switcher. Set "default" to override
    | the fallback locale; otherwise the app's locale is used. RTL locales
    | are listed in "rtl" to force right-to-left layout.
    |
    */
    'locales' => [
        'en' => 'English',
        'es' => 'Español',
        'fr' => 'Français',
        'de' => 'Deutsch',
        'pt' => 'Português',
        'it' => 'Italiano',
        'ja' => '日本語',
        'zh' => '中文',
        'ar' => 'العربية',
        'hi' => 'हिन्दी',
    ],

    'rtl_locales' => ['ar', 'he', 'fa', 'ur'],

    'default_locale' => null,

    'locale_session_key' => 'installwizard.locale',

    /*
    |--------------------------------------------------------------------------
    | Theming
    |--------------------------------------------------------------------------
    |
    | Available color modes. The user's selection persists in localStorage.
    | "system" follows the OS preference via prefers-color-scheme.
    |
    */
    'themes' => ['light', 'dark', 'system'],

    'default_theme' => 'system',

    /*
    |--------------------------------------------------------------------------
    | Path Whitelist
    |--------------------------------------------------------------------------
    */
    'path_whitelist' => [
        'install*',
        'installwizard/*',
        'vendor/*',
        'storage/*',
        '_debugbar*',
        'livewire/*',
        'health*',
        'up',
        'favicon.ico',
        'robots.txt',
    ],

    'intended_url_key' => 'installwizard.intended_url',

    'session_key' => 'installwizard.state',

];
