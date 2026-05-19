<?php

return [

    'installer_title' => 'مثبّت :app',
    'tagline'         => 'قم بإعداد تطبيقك في خطوات قليلة',
    'powered_by'      => 'مدعوم بواسطة installwizard',
    'install_failed'  => 'فشل التثبيت. يرجى مراجعة السجلات والمحاولة مرة أخرى.',

    'theme' => [
        'label'  => 'السمة',
        'light'  => 'فاتح',
        'dark'   => 'داكن',
        'system' => 'النظام',
    ],

    'language' => [
        'label' => 'اللغة',
    ],

    'steps' => [
        'welcome'      => 'مرحبًا',
        'environment'  => 'البيئة',
        'database'     => 'قاعدة البيانات',
        'requirements' => 'المتطلبات',
        'permissions'  => 'الصلاحيات',
        'install'      => 'تثبيت',
        'step_of'      => 'الخطوة :current من :total',
    ],

    'common' => [
        'continue'   => 'متابعة',
        'back'       => 'رجوع',
        'save'       => 'حفظ',
        'cancel'     => 'إلغاء',
        'preview'    => 'معاينة',
        'testing'    => 'جارٍ الاختبار…',
        'loading'    => 'جارٍ التحميل…',
        'installing' => 'جارٍ التثبيت…',
        'optional'   => 'اختياري',
    ],

    'welcome' => [
        'heading'     => 'لنبدأ الإعداد',
        'subheading'  => 'ابدأ بإخبارنا باسم تطبيقك. سنستخدمه في باقي خطوات المثبّت.',
        'app_name'    => 'اسم التطبيق',
        'placeholder' => 'مثال: NativeCode',
    ],

    'environment' => [
        'heading'    => 'البيئة',
        'subheading' => 'قم بضبط قيم تشغيل تطبيقك.',
        'app_name'   => 'اسم التطبيق',
        'env'        => 'البيئة',
        'debug'      => 'وضع التصحيح',
        'url'        => 'رابط التطبيق',
        'timezone'   => 'المنطقة الزمنية',
        'locale'     => 'اللغة',
        'envs' => [
            'local'       => 'محلي',
            'development' => 'تطوير',
            'staging'     => 'تجريبي',
            'production'  => 'إنتاج',
            'testing'     => 'اختبار',
        ],
        'debug_on'   => 'مفعّل',
        'debug_off'  => 'معطّل',
    ],

    'database' => [
        'heading'         => 'قاعدة البيانات',
        'subheading'      => 'سنقوم باختبار الاتصال قبل المتابعة.',
        'driver'          => 'برنامج التشغيل',
        'host'            => 'المضيف',
        'port'            => 'المنفذ',
        'name'            => 'اسم قاعدة البيانات',
        'username'        => 'اسم المستخدم',
        'password'        => 'كلمة المرور',
        'test_connection' => 'اختبار الاتصال',
        'connection_failed' => 'فشل الاتصال بقاعدة البيانات: :error',
        'connected_to'    => 'تم الاتصال بـ :driver بنجاح.',
    ],

    'requirements' => [
        'heading'     => 'متطلبات PHP',
        'php_running' => 'يعمل PHP :current (المطلوب: :required).',
        'loaded'      => 'مُحمَّل',
        'missing'     => 'مفقود',
    ],

    'permissions' => [
        'heading'      => 'صلاحيات المجلدات',
        'subheading'   => 'يحتاج Laravel إلى صلاحيات الكتابة على هذه المجلدات.',
        'writable'     => 'قابل للكتابة',
        'not_writable' => 'غير قابل للكتابة',
        'not_found'    => 'غير موجود',
    ],

    'finish' => [
        'heading'    => 'جاهز للتثبيت',
        'subheading' => 'سنقوم بكتابة الإعدادات وتجهيز التطبيق وإنهاء التثبيت.',
        'actions'    => [
            'env'        => 'كتابة القيم المُكوَّنة في ملف .env',
            'app_key'    => 'توليد APP_KEY إذا كان مفقودًا',
            'migrations' => 'تشغيل ترحيلات قاعدة البيانات',
            'seeders'    => 'تشغيل بذور قاعدة البيانات',
            'caches'     => 'تنظيف ذاكرة config وroute وview والكاش',
            'lock'       => 'إنشاء ملف قفل التثبيت storage/.installed',
        ],
        'cta'    => 'تثبيت :app',
        'notice' => 'قد يستغرق ذلك بضع ثوانٍ.',
    ],

    'complete' => [
        'heading'  => ':app جاهز',
        'subhead'  => 'اكتمل التثبيت. سنقوم بتحويلك خلال لحظات…',
        'log'      => 'سجلّ التثبيت',
        'open_app' => 'فتح :app الآن',
    ],

];
