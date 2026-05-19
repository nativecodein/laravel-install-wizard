<?php

return [

    'installer_title' => 'Installateur :app',
    'tagline'         => 'Configurez votre application en quelques étapes',
    'powered_by'      => 'Propulsé par installwizard',
    'install_failed'  => "L'installation a échoué. Consultez les logs et réessayez.",

    'theme' => [
        'label'  => 'Thème',
        'light'  => 'Clair',
        'dark'   => 'Sombre',
        'system' => 'Système',
    ],

    'language' => [
        'label' => 'Langue',
    ],

    'steps' => [
        'welcome'      => 'Bienvenue',
        'environment'  => 'Environnement',
        'database'     => 'Base de données',
        'requirements' => 'Prérequis',
        'permissions'  => 'Permissions',
        'install'      => 'Installer',
        'step_of'      => 'Étape :current sur :total',
    ],

    'common' => [
        'continue'   => 'Continuer',
        'back'       => 'Retour',
        'save'       => 'Enregistrer',
        'cancel'     => 'Annuler',
        'preview'    => 'Aperçu',
        'testing'    => 'Test…',
        'loading'    => 'Chargement…',
        'installing' => 'Installation…',
        'optional'   => 'Facultatif',
    ],

    'welcome' => [
        'heading'     => 'Commençons la configuration',
        'subheading'  => "Indiquez le nom de votre application. Il servira à personnaliser le reste de l'installateur.",
        'app_name'    => "Nom de l'application",
        'placeholder' => 'ex. NativeCode',
    ],

    'environment' => [
        'heading'    => 'Environnement',
        'subheading' => "Configurez les valeurs d'exécution de votre application.",
        'app_name'   => "Nom de l'application",
        'env'        => 'Environnement',
        'debug'      => 'Mode debug',
        'url'        => "URL de l'application",
        'timezone'   => 'Fuseau horaire',
        'locale'     => 'Langue',
        'envs' => [
            'local'       => 'Local',
            'development' => 'Développement',
            'staging'     => 'Pré-production',
            'production'  => 'Production',
            'testing'     => 'Test',
        ],
        'debug_on'   => 'Activé',
        'debug_off'  => 'Désactivé',
    ],

    'database' => [
        'heading'         => 'Base de données',
        'subheading'      => 'Nous testerons la connexion avant de continuer.',
        'driver'          => 'Pilote',
        'host'            => 'Hôte',
        'port'            => 'Port',
        'name'            => 'Nom de la base',
        'username'        => 'Utilisateur',
        'password'        => 'Mot de passe',
        'test_connection' => 'Tester la connexion',
        'connection_failed' => 'Échec de la connexion : :error',
        'connected_to'    => 'Connexion établie à :driver.',
    ],

    'requirements' => [
        'heading'     => 'Prérequis PHP',
        'php_running' => 'PHP :current en cours (requis : :required).',
        'loaded'      => 'chargé',
        'missing'     => 'manquant',
    ],

    'permissions' => [
        'heading'      => 'Permissions des dossiers',
        'subheading'   => 'Laravel a besoin que ces répertoires soient accessibles en écriture par le serveur web.',
        'writable'     => 'inscriptible',
        'not_writable' => 'non inscriptible',
        'not_found'    => 'introuvable',
    ],

    'finish' => [
        'heading'    => 'Prêt à installer',
        'subheading' => "Nous allons écrire votre configuration, préparer l'application et finaliser l'installation.",
        'actions'    => [
            'env'        => 'Écrire les valeurs dans votre fichier .env',
            'app_key'    => 'Générer APP_KEY si manquante',
            'migrations' => 'Exécuter les migrations',
            'seeders'    => 'Exécuter les seeders',
            'caches'     => 'Vider config, routes, vues et cache',
            'lock'       => 'Créer le verrou storage/.installed',
        ],
        'cta'    => 'Installer :app',
        'notice' => 'Cela peut prendre quelques secondes.',
    ],

    'complete' => [
        'heading'  => ':app est prêt',
        'subhead'  => 'Installation terminée. Redirection en cours…',
        'log'      => "Journal de l'installation",
        'open_app' => 'Ouvrir :app maintenant',
    ],

];
