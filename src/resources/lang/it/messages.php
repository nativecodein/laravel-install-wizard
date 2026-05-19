<?php

return [

    'installer_title' => 'Installer :app',
    'tagline'         => "Configura la tua applicazione in pochi passi",
    'powered_by'      => 'Realizzato con installwizard',
    'install_failed'  => 'Installazione non riuscita. Controlla i log e riprova.',

    'theme' => [
        'label'  => 'Tema',
        'light'  => 'Chiaro',
        'dark'   => 'Scuro',
        'system' => 'Sistema',
    ],

    'language' => [
        'label' => 'Lingua',
    ],

    'steps' => [
        'welcome'      => 'Benvenuto',
        'environment'  => 'Ambiente',
        'database'     => 'Database',
        'requirements' => 'Requisiti',
        'permissions'  => 'Permessi',
        'install'      => 'Installa',
        'step_of'      => 'Passo :current di :total',
    ],

    'common' => [
        'continue'   => 'Continua',
        'back'       => 'Indietro',
        'save'       => 'Salva',
        'cancel'     => 'Annulla',
        'preview'    => 'Anteprima',
        'testing'    => 'Test in corso…',
        'loading'    => 'Caricamento…',
        'installing' => 'Installazione…',
        'optional'   => 'Opzionale',
    ],

    'welcome' => [
        'heading'     => 'Iniziamo la configurazione',
        'subheading'  => "Indica il nome della tua applicazione. Lo useremo per personalizzare l'installer.",
        'app_name'    => "Nome dell'applicazione",
        'placeholder' => 'es. NativeCode',
    ],

    'environment' => [
        'heading'    => 'Ambiente',
        'subheading' => "Configura i valori di runtime della tua applicazione.",
        'app_name'   => "Nome dell'applicazione",
        'env'        => 'Ambiente',
        'debug'      => 'Modalità debug',
        'url'        => "URL dell'applicazione",
        'timezone'   => 'Fuso orario',
        'locale'     => 'Lingua',
        'envs' => [
            'local'       => 'Locale',
            'development' => 'Sviluppo',
            'staging'     => 'Staging',
            'production'  => 'Produzione',
            'testing'     => 'Test',
        ],
        'debug_on'   => 'Attivo',
        'debug_off'  => 'Disattivato',
    ],

    'database' => [
        'heading'         => 'Database',
        'subheading'      => 'Verificheremo la connessione prima di continuare.',
        'driver'          => 'Driver',
        'host'            => 'Host',
        'port'            => 'Porta',
        'name'            => 'Nome database',
        'username'        => 'Utente',
        'password'        => 'Password',
        'test_connection' => 'Verifica connessione',
        'connection_failed' => 'Connessione fallita: :error',
        'connected_to'    => 'Connesso correttamente a :driver.',
    ],

    'requirements' => [
        'heading'     => 'Requisiti PHP',
        'php_running' => 'PHP :current in esecuzione (richiesto: :required).',
        'loaded'      => 'caricata',
        'missing'     => 'mancante',
    ],

    'permissions' => [
        'heading'      => 'Permessi delle cartelle',
        'subheading'   => 'Laravel ha bisogno che queste directory siano scrivibili dal web server.',
        'writable'     => 'scrivibile',
        'not_writable' => 'non scrivibile',
        'not_found'    => 'non trovata',
    ],

    'finish' => [
        'heading'    => 'Pronto per installare',
        'subheading' => "Stiamo per scrivere la configurazione, preparare l'applicazione e completare l'installazione.",
        'actions'    => [
            'env'        => 'Scrivere i valori nel file .env',
            'app_key'    => 'Generare APP_KEY se mancante',
            'migrations' => 'Eseguire le migrazioni',
            'seeders'    => 'Eseguire i seeder',
            'caches'     => 'Pulire config, route, view e cache',
            'lock'       => 'Creare il lock storage/.installed',
        ],
        'cta'    => 'Installa :app',
        'notice' => 'Potrebbe richiedere alcuni secondi.',
    ],

    'complete' => [
        'heading'  => ':app è pronto',
        'subhead'  => 'Installazione completata. Reindirizzamento in corso…',
        'log'      => 'Log di installazione',
        'open_app' => 'Apri :app ora',
    ],

];
