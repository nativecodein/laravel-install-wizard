<?php

return [

    'installer_title' => 'Instalador de :app',
    'tagline'         => 'Configura tu aplicación en unos pocos pasos',
    'powered_by'      => 'Desarrollado por installwizard',
    'install_failed'  => 'Instalación fallida. Revisa los registros y vuelve a intentarlo.',

    'theme' => [
        'label'  => 'Tema',
        'light'  => 'Claro',
        'dark'   => 'Oscuro',
        'system' => 'Sistema',
    ],

    'language' => [
        'label' => 'Idioma',
    ],

    'steps' => [
        'welcome'      => 'Bienvenida',
        'environment'  => 'Entorno',
        'database'     => 'Base de datos',
        'requirements' => 'Requisitos',
        'permissions'  => 'Permisos',
        'install'      => 'Instalar',
        'step_of'      => 'Paso :current de :total',
    ],

    'common' => [
        'continue'   => 'Continuar',
        'back'       => 'Atrás',
        'save'       => 'Guardar',
        'cancel'     => 'Cancelar',
        'preview'    => 'Vista previa',
        'testing'    => 'Probando…',
        'loading'    => 'Cargando…',
        'installing' => 'Instalando…',
        'optional'   => 'Opcional',
    ],

    'welcome' => [
        'heading'     => 'Vamos a configurarlo todo',
        'subheading'  => 'Empecemos con el nombre de tu aplicación. Lo usaremos para personalizar el resto del instalador.',
        'app_name'    => 'Nombre de la aplicación',
        'placeholder' => 'p. ej. NativeCode',
    ],

    'environment' => [
        'heading'    => 'Entorno',
        'subheading' => 'Configura los valores de ejecución de tu aplicación.',
        'app_name'   => 'Nombre de la aplicación',
        'env'        => 'Entorno',
        'debug'      => 'Modo de depuración',
        'url'        => 'URL de la aplicación',
        'timezone'   => 'Zona horaria',
        'locale'     => 'Idioma',
        'envs' => [
            'local'       => 'Local',
            'development' => 'Desarrollo',
            'staging'     => 'Pruebas',
            'production'  => 'Producción',
            'testing'     => 'Testing',
        ],
        'debug_on'   => 'Activado',
        'debug_off'  => 'Desactivado',
    ],

    'database' => [
        'heading'         => 'Base de datos',
        'subheading'      => 'Probaremos la conexión antes de continuar.',
        'driver'          => 'Controlador',
        'host'            => 'Host',
        'port'            => 'Puerto',
        'name'            => 'Nombre de la base de datos',
        'username'        => 'Usuario',
        'password'        => 'Contraseña',
        'test_connection' => 'Probar conexión',
        'connection_failed' => 'Conexión fallida: :error',
        'connected_to'    => 'Conexión exitosa a :driver.',
    ],

    'requirements' => [
        'heading'     => 'Requisitos de PHP',
        'php_running' => 'PHP :current en ejecución (requerido: :required).',
        'loaded'      => 'cargado',
        'missing'     => 'falta',
    ],

    'permissions' => [
        'heading'      => 'Permisos de carpetas',
        'subheading'   => 'Laravel necesita que estos directorios sean escribibles por el servidor web.',
        'writable'     => 'escribible',
        'not_writable' => 'sin permisos',
        'not_found'    => 'no encontrado',
    ],

    'finish' => [
        'heading'    => 'Listo para instalar',
        'subheading' => 'Vamos a escribir tu configuración, preparar la aplicación y finalizar la instalación.',
        'actions'    => [
            'env'        => 'Escribir los valores configurados en tu archivo .env',
            'app_key'    => 'Generar APP_KEY si falta',
            'migrations' => 'Ejecutar las migraciones',
            'seeders'    => 'Ejecutar los seeders',
            'caches'     => 'Limpiar config, rutas, vistas y caché',
            'lock'       => 'Crear el archivo de bloqueo storage/.installed',
        ],
        'cta'    => 'Instalar :app',
        'notice' => 'Esto puede tardar unos segundos.',
    ],

    'complete' => [
        'heading'  => ':app está listo',
        'subhead'  => 'Instalación finalizada. Redirigiéndote en un momento…',
        'log'      => 'Registro de instalación',
        'open_app' => 'Abrir :app ahora',
    ],

];
