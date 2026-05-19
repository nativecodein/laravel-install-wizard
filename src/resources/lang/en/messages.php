<?php

return [

    'installer_title' => ':app Installer',
    'tagline'         => 'Set up your application in a few steps',
    'powered_by'      => 'Powered by installwizard',
    'install_failed'  => 'Installation failed. Please check the logs and try again.',

    'theme' => [
        'label'  => 'Theme',
        'light'  => 'Light',
        'dark'   => 'Dark',
        'system' => 'System',
    ],

    'language' => [
        'label' => 'Language',
    ],

    'steps' => [
        'welcome'      => 'Welcome',
        'environment'  => 'Environment',
        'database'     => 'Database',
        'requirements' => 'Requirements',
        'permissions'  => 'Permissions',
        'install'      => 'Install',
        'step_of'      => 'Step :current of :total',
    ],

    'common' => [
        'continue'   => 'Continue',
        'back'       => 'Back',
        'save'       => 'Save',
        'cancel'     => 'Cancel',
        'preview'    => 'Preview',
        'testing'    => 'Testing…',
        'loading'    => 'Loading…',
        'installing' => 'Installing…',
        'optional'   => 'Optional',
    ],

    'welcome' => [
        'heading'     => "Let's set things up",
        'subheading'  => "Start by telling us the name of your application. We'll use it to brand the rest of the installer.",
        'app_name'    => 'Application name',
        'placeholder' => 'e.g. NativeCode',
    ],

    'environment' => [
        'heading'    => 'Environment',
        'subheading' => 'Configure the runtime values for your application.',
        'app_name'   => 'Application name',
        'env'        => 'Environment',
        'debug'      => 'Debug mode',
        'url'        => 'Application URL',
        'timezone'   => 'Timezone',
        'locale'     => 'Locale',
        'envs' => [
            'local'       => 'Local',
            'development' => 'Development',
            'staging'     => 'Staging',
            'production'  => 'Production',
            'testing'     => 'Testing',
        ],
        'debug_on'   => 'Enabled',
        'debug_off'  => 'Disabled',
    ],

    'database' => [
        'heading'         => 'Database',
        'subheading'      => "We'll test the connection before continuing.",
        'driver'          => 'Driver',
        'host'            => 'Host',
        'port'            => 'Port',
        'name'            => 'Database name',
        'username'        => 'Username',
        'password'        => 'Password',
        'test_connection' => 'Test connection',
        'connection_failed' => 'Database connection failed: :error',
        'connected_to'    => 'Successfully connected to :driver.',
    ],

    'requirements' => [
        'heading'        => 'PHP requirements',
        'php_running'    => 'Running PHP :current (required: :required).',
        'loaded'         => 'loaded',
        'missing'        => 'missing',
    ],

    'permissions' => [
        'heading'    => 'Folder permissions',
        'subheading' => 'Laravel needs these directories to be writable by the web server.',
        'writable'   => 'writable',
        'not_writable' => 'not writable',
        'not_found'  => 'missing',
    ],

    'finish' => [
        'heading'    => 'Ready to install',
        'subheading' => "We're about to write your configuration, prepare the application and finish setup.",
        'actions'    => [
            'env'         => 'Write configured values into your .env file',
            'app_key'     => 'Generate APP_KEY if missing',
            'migrations'  => 'Run database migrations',
            'seeders'     => 'Run database seeders',
            'caches'      => 'Clear config, route, view and cache stores',
            'lock'        => 'Create the installed lock file at storage/.installed',
        ],
        'cta'    => 'Install :app',
        'notice' => 'This may take a few seconds.',
    ],

    'complete' => [
        'heading'  => ':app is ready',
        'subhead'  => 'Installation finished. Redirecting you in a moment…',
        'log'      => 'Installation log',
        'open_app' => 'Open :app now',
    ],

];
