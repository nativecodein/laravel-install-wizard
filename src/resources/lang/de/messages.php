<?php

return [

    'installer_title' => ':app Installer',
    'tagline'         => 'Richte deine Anwendung in wenigen Schritten ein',
    'powered_by'      => 'Bereitgestellt von installwizard',
    'install_failed'  => 'Installation fehlgeschlagen. Bitte prüfe die Logs und versuche es erneut.',

    'theme' => [
        'label'  => 'Design',
        'light'  => 'Hell',
        'dark'   => 'Dunkel',
        'system' => 'System',
    ],

    'language' => [
        'label' => 'Sprache',
    ],

    'steps' => [
        'welcome'      => 'Willkommen',
        'environment'  => 'Umgebung',
        'database'     => 'Datenbank',
        'requirements' => 'Voraussetzungen',
        'permissions'  => 'Berechtigungen',
        'install'      => 'Installieren',
        'step_of'      => 'Schritt :current von :total',
    ],

    'common' => [
        'continue'   => 'Weiter',
        'back'       => 'Zurück',
        'save'       => 'Speichern',
        'cancel'     => 'Abbrechen',
        'preview'    => 'Vorschau',
        'testing'    => 'Teste…',
        'loading'    => 'Lädt…',
        'installing' => 'Installiere…',
        'optional'   => 'Optional',
    ],

    'welcome' => [
        'heading'     => 'Lass uns loslegen',
        'subheading'  => 'Nenne uns den Namen deiner Anwendung. Wir verwenden ihn für den Rest des Installers.',
        'app_name'    => 'Anwendungsname',
        'placeholder' => 'z. B. NativeCode',
    ],

    'environment' => [
        'heading'    => 'Umgebung',
        'subheading' => 'Konfiguriere die Laufzeitwerte deiner Anwendung.',
        'app_name'   => 'Anwendungsname',
        'env'        => 'Umgebung',
        'debug'      => 'Debug-Modus',
        'url'        => 'Anwendungs-URL',
        'timezone'   => 'Zeitzone',
        'locale'     => 'Sprache',
        'envs' => [
            'local'       => 'Lokal',
            'development' => 'Entwicklung',
            'staging'     => 'Staging',
            'production'  => 'Produktion',
            'testing'     => 'Test',
        ],
        'debug_on'   => 'Aktiviert',
        'debug_off'  => 'Deaktiviert',
    ],

    'database' => [
        'heading'         => 'Datenbank',
        'subheading'      => 'Wir testen die Verbindung, bevor es weitergeht.',
        'driver'          => 'Treiber',
        'host'            => 'Host',
        'port'            => 'Port',
        'name'            => 'Datenbankname',
        'username'        => 'Benutzername',
        'password'        => 'Passwort',
        'test_connection' => 'Verbindung testen',
        'connection_failed' => 'Verbindung fehlgeschlagen: :error',
        'connected_to'    => 'Verbindung zu :driver erfolgreich.',
    ],

    'requirements' => [
        'heading'     => 'PHP-Voraussetzungen',
        'php_running' => 'PHP :current läuft (benötigt: :required).',
        'loaded'      => 'geladen',
        'missing'     => 'fehlt',
    ],

    'permissions' => [
        'heading'      => 'Ordner-Berechtigungen',
        'subheading'   => 'Laravel benötigt Schreibrechte für diese Verzeichnisse.',
        'writable'     => 'schreibbar',
        'not_writable' => 'nicht schreibbar',
        'not_found'    => 'fehlt',
    ],

    'finish' => [
        'heading'    => 'Bereit zur Installation',
        'subheading' => 'Wir schreiben deine Konfiguration, bereiten die Anwendung vor und schließen die Installation ab.',
        'actions'    => [
            'env'        => 'Werte in deine .env-Datei schreiben',
            'app_key'    => 'APP_KEY generieren, falls fehlt',
            'migrations' => 'Datenbank-Migrationen ausführen',
            'seeders'    => 'Datenbank-Seeder ausführen',
            'caches'     => 'Config-, Route-, View- und Cache-Speicher leeren',
            'lock'       => 'Lock-Datei storage/.installed anlegen',
        ],
        'cta'    => ':app installieren',
        'notice' => 'Das kann einen Moment dauern.',
    ],

    'complete' => [
        'heading'  => ':app ist bereit',
        'subhead'  => 'Installation abgeschlossen. Du wirst gleich weitergeleitet…',
        'log'      => 'Installationsprotokoll',
        'open_app' => ':app jetzt öffnen',
    ],

];
