<?php

return [

    'installer_title' => 'Instalador do :app',
    'tagline'         => 'Configure sua aplicação em alguns passos',
    'powered_by'      => 'Desenvolvido com installwizard',
    'install_failed'  => 'Instalação falhou. Verifique os logs e tente novamente.',

    'theme' => [
        'label'  => 'Tema',
        'light'  => 'Claro',
        'dark'   => 'Escuro',
        'system' => 'Sistema',
    ],

    'language' => [
        'label' => 'Idioma',
    ],

    'steps' => [
        'welcome'      => 'Boas-vindas',
        'environment'  => 'Ambiente',
        'database'     => 'Banco de dados',
        'requirements' => 'Requisitos',
        'permissions'  => 'Permissões',
        'install'      => 'Instalar',
        'step_of'      => 'Passo :current de :total',
    ],

    'common' => [
        'continue'   => 'Continuar',
        'back'       => 'Voltar',
        'save'       => 'Salvar',
        'cancel'     => 'Cancelar',
        'preview'    => 'Pré-visualização',
        'testing'    => 'Testando…',
        'loading'    => 'Carregando…',
        'installing' => 'Instalando…',
        'optional'   => 'Opcional',
    ],

    'welcome' => [
        'heading'     => 'Vamos configurar',
        'subheading'  => 'Comece informando o nome da sua aplicação. Vamos usá-lo no restante do instalador.',
        'app_name'    => 'Nome da aplicação',
        'placeholder' => 'ex. NativeCode',
    ],

    'environment' => [
        'heading'    => 'Ambiente',
        'subheading' => 'Configure os valores de execução da sua aplicação.',
        'app_name'   => 'Nome da aplicação',
        'env'        => 'Ambiente',
        'debug'      => 'Modo debug',
        'url'        => 'URL da aplicação',
        'timezone'   => 'Fuso horário',
        'locale'     => 'Idioma',
        'envs' => [
            'local'       => 'Local',
            'development' => 'Desenvolvimento',
            'staging'     => 'Homologação',
            'production'  => 'Produção',
            'testing'     => 'Testes',
        ],
        'debug_on'   => 'Ativado',
        'debug_off'  => 'Desativado',
    ],

    'database' => [
        'heading'         => 'Banco de dados',
        'subheading'      => 'Vamos testar a conexão antes de continuar.',
        'driver'          => 'Driver',
        'host'            => 'Host',
        'port'            => 'Porta',
        'name'            => 'Nome do banco',
        'username'        => 'Usuário',
        'password'        => 'Senha',
        'test_connection' => 'Testar conexão',
        'connection_failed' => 'Falha na conexão: :error',
        'connected_to'    => 'Conectado com sucesso a :driver.',
    ],

    'requirements' => [
        'heading'     => 'Requisitos do PHP',
        'php_running' => 'Executando PHP :current (requerido: :required).',
        'loaded'      => 'carregada',
        'missing'     => 'ausente',
    ],

    'permissions' => [
        'heading'      => 'Permissões de diretórios',
        'subheading'   => 'O Laravel precisa que estes diretórios sejam graváveis pelo servidor web.',
        'writable'     => 'gravável',
        'not_writable' => 'sem permissão',
        'not_found'    => 'não encontrado',
    ],

    'finish' => [
        'heading'    => 'Pronto para instalar',
        'subheading' => 'Vamos escrever sua configuração, preparar a aplicação e finalizar a instalação.',
        'actions'    => [
            'env'        => 'Escrever os valores configurados no .env',
            'app_key'    => 'Gerar APP_KEY se ausente',
            'migrations' => 'Executar migrações',
            'seeders'    => 'Executar seeders',
            'caches'     => 'Limpar config, rotas, views e cache',
            'lock'       => 'Criar lock storage/.installed',
        ],
        'cta'    => 'Instalar :app',
        'notice' => 'Pode levar alguns segundos.',
    ],

    'complete' => [
        'heading'  => ':app está pronto',
        'subhead'  => 'Instalação concluída. Redirecionando em instantes…',
        'log'      => 'Log da instalação',
        'open_app' => 'Abrir :app agora',
    ],

];
