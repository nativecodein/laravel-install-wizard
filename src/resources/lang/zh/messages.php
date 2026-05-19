<?php

return [

    'installer_title' => ':app 安装向导',
    'tagline'         => '只需几步即可完成应用程序的初始设置',
    'powered_by'      => '由 installwizard 提供支持',
    'install_failed'  => '安装失败。请查看日志后重试。',

    'theme' => [
        'label'  => '主题',
        'light'  => '浅色',
        'dark'   => '深色',
        'system' => '跟随系统',
    ],

    'language' => [
        'label' => '语言',
    ],

    'steps' => [
        'welcome'      => '欢迎',
        'environment'  => '环境',
        'database'     => '数据库',
        'requirements' => '要求',
        'permissions'  => '权限',
        'install'      => '安装',
        'step_of'      => '第 :current / :total 步',
    ],

    'common' => [
        'continue'   => '继续',
        'back'       => '返回',
        'save'       => '保存',
        'cancel'     => '取消',
        'preview'    => '预览',
        'testing'    => '测试中…',
        'loading'    => '加载中…',
        'installing' => '安装中…',
        'optional'   => '可选',
    ],

    'welcome' => [
        'heading'     => '开始设置',
        'subheading'  => '先告诉我们应用的名称,我们将在整个安装过程中使用它。',
        'app_name'    => '应用名称',
        'placeholder' => '例如:NativeCode',
    ],

    'environment' => [
        'heading'    => '环境',
        'subheading' => '配置应用程序的运行时参数。',
        'app_name'   => '应用名称',
        'env'        => '环境',
        'debug'      => '调试模式',
        'url'        => '应用 URL',
        'timezone'   => '时区',
        'locale'     => '语言',
        'envs' => [
            'local'       => '本地',
            'development' => '开发',
            'staging'     => '预发布',
            'production'  => '生产',
            'testing'     => '测试',
        ],
        'debug_on'   => '启用',
        'debug_off'  => '关闭',
    ],

    'database' => [
        'heading'         => '数据库',
        'subheading'      => '我们将在继续前测试连接。',
        'driver'          => '驱动',
        'host'            => '主机',
        'port'            => '端口',
        'name'            => '数据库名',
        'username'        => '用户名',
        'password'        => '密码',
        'test_connection' => '测试连接',
        'connection_failed' => '数据库连接失败::error',
        'connected_to'    => '成功连接到 :driver。',
    ],

    'requirements' => [
        'heading'     => 'PHP 要求',
        'php_running' => '当前 PHP :current(要求::required)。',
        'loaded'      => '已加载',
        'missing'     => '缺失',
    ],

    'permissions' => [
        'heading'      => '文件夹权限',
        'subheading'   => 'Laravel 需要 Web 服务器对这些目录具有写入权限。',
        'writable'     => '可写',
        'not_writable' => '不可写',
        'not_found'    => '不存在',
    ],

    'finish' => [
        'heading'    => '准备安装',
        'subheading' => '我们即将写入配置、准备应用并完成安装。',
        'actions'    => [
            'env'        => '将配置值写入 .env 文件',
            'app_key'    => '如缺失则生成 APP_KEY',
            'migrations' => '运行数据库迁移',
            'seeders'    => '运行数据库填充器',
            'caches'     => '清理 config、route、view 和缓存',
            'lock'       => '创建安装锁 storage/.installed',
        ],
        'cta'    => '安装 :app',
        'notice' => '这可能需要几秒钟。',
    ],

    'complete' => [
        'heading'  => ':app 已就绪',
        'subhead'  => '安装完成,马上为您跳转…',
        'log'      => '安装日志',
        'open_app' => '立即打开 :app',
    ],

];
