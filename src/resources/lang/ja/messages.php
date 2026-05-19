<?php

return [

    'installer_title' => ':app インストーラー',
    'tagline'         => '数ステップでアプリケーションをセットアップ',
    'powered_by'      => 'installwizard 提供',
    'install_failed'  => 'インストールに失敗しました。ログを確認して再度お試しください。',

    'theme' => [
        'label'  => 'テーマ',
        'light'  => 'ライト',
        'dark'   => 'ダーク',
        'system' => 'システム',
    ],

    'language' => [
        'label' => '言語',
    ],

    'steps' => [
        'welcome'      => 'ようこそ',
        'environment'  => '環境',
        'database'     => 'データベース',
        'requirements' => '要件',
        'permissions'  => '権限',
        'install'      => 'インストール',
        'step_of'      => 'ステップ :current / :total',
    ],

    'common' => [
        'continue'   => '次へ',
        'back'       => '戻る',
        'save'       => '保存',
        'cancel'     => 'キャンセル',
        'preview'    => 'プレビュー',
        'testing'    => 'テスト中…',
        'loading'    => '読み込み中…',
        'installing' => 'インストール中…',
        'optional'   => '任意',
    ],

    'welcome' => [
        'heading'     => 'セットアップを始めましょう',
        'subheading'  => 'まずアプリケーション名を教えてください。残りのインストーラー全体で使用します。',
        'app_name'    => 'アプリケーション名',
        'placeholder' => '例：NativeCode',
    ],

    'environment' => [
        'heading'    => '環境',
        'subheading' => 'アプリケーションの実行時の値を設定します。',
        'app_name'   => 'アプリケーション名',
        'env'        => '環境',
        'debug'      => 'デバッグモード',
        'url'        => 'アプリケーション URL',
        'timezone'   => 'タイムゾーン',
        'locale'     => 'ロケール',
        'envs' => [
            'local'       => 'ローカル',
            'development' => '開発',
            'staging'     => 'ステージング',
            'production'  => '本番',
            'testing'     => 'テスト',
        ],
        'debug_on'   => '有効',
        'debug_off'  => '無効',
    ],

    'database' => [
        'heading'         => 'データベース',
        'subheading'      => '続行前に接続をテストします。',
        'driver'          => 'ドライバー',
        'host'            => 'ホスト',
        'port'            => 'ポート',
        'name'            => 'データベース名',
        'username'        => 'ユーザー名',
        'password'        => 'パスワード',
        'test_connection' => '接続をテスト',
        'connection_failed' => 'データベース接続に失敗しました: :error',
        'connected_to'    => ':driver への接続に成功しました。',
    ],

    'requirements' => [
        'heading'     => 'PHP 要件',
        'php_running' => 'PHP :current 実行中（必要: :required）',
        'loaded'      => '読み込み済み',
        'missing'     => '不足',
    ],

    'permissions' => [
        'heading'      => 'フォルダーの権限',
        'subheading'   => 'Laravel はこれらのディレクトリへの書き込み権限を必要とします。',
        'writable'     => '書き込み可能',
        'not_writable' => '書き込み不可',
        'not_found'    => '見つかりません',
    ],

    'finish' => [
        'heading'    => 'インストールの準備ができました',
        'subheading' => '設定を書き込み、アプリケーションを準備してインストールを完了します。',
        'actions'    => [
            'env'        => '設定値を .env に書き込み',
            'app_key'    => '不足している APP_KEY を生成',
            'migrations' => 'データベースマイグレーションを実行',
            'seeders'    => 'データベースシーダーを実行',
            'caches'     => 'config、route、view、cache をクリア',
            'lock'       => 'インストールロック storage/.installed を作成',
        ],
        'cta'    => ':app をインストール',
        'notice' => '数秒かかる場合があります。',
    ],

    'complete' => [
        'heading'  => ':app の準備ができました',
        'subhead'  => 'インストールが完了しました。まもなくリダイレクトします…',
        'log'      => 'インストールログ',
        'open_app' => ':app を開く',
    ],

];
