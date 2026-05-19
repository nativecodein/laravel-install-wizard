<?php

return [

    'installer_title' => ':app इंस्टॉलर',
    'tagline'         => 'कुछ ही चरणों में अपना ऐप्लिकेशन सेटअप करें',
    'powered_by'      => 'installwizard द्वारा संचालित',
    'install_failed'  => 'इंस्टॉलेशन विफल। कृपया लॉग देखें और पुनः प्रयास करें।',

    'theme' => [
        'label'  => 'थीम',
        'light'  => 'लाइट',
        'dark'   => 'डार्क',
        'system' => 'सिस्टम',
    ],

    'language' => [
        'label' => 'भाषा',
    ],

    'steps' => [
        'welcome'      => 'स्वागत',
        'environment'  => 'एनवायरनमेंट',
        'database'     => 'डेटाबेस',
        'requirements' => 'आवश्यकताएँ',
        'permissions'  => 'अनुमतियाँ',
        'install'      => 'इंस्टॉल',
        'step_of'      => 'चरण :current / :total',
    ],

    'common' => [
        'continue'   => 'जारी रखें',
        'back'       => 'वापस',
        'save'       => 'सेव करें',
        'cancel'     => 'रद्द',
        'preview'    => 'झलक',
        'testing'    => 'जाँच हो रही है…',
        'loading'    => 'लोड हो रहा है…',
        'installing' => 'इंस्टॉल हो रहा है…',
        'optional'   => 'वैकल्पिक',
    ],

    'welcome' => [
        'heading'     => 'चलिए सेटअप शुरू करें',
        'subheading'  => 'सबसे पहले अपने ऐप का नाम बताइए। हम इसका उपयोग बाकी इंस्टॉलर में करेंगे।',
        'app_name'    => 'ऐप्लिकेशन नाम',
        'placeholder' => 'उदा. NativeCode',
    ],

    'environment' => [
        'heading'    => 'एनवायरनमेंट',
        'subheading' => 'अपने ऐप्लिकेशन के रनटाइम मान कॉन्फ़िगर करें।',
        'app_name'   => 'ऐप्लिकेशन नाम',
        'env'        => 'एनवायरनमेंट',
        'debug'      => 'डिबग मोड',
        'url'        => 'ऐप्लिकेशन URL',
        'timezone'   => 'टाइमज़ोन',
        'locale'     => 'भाषा',
        'envs' => [
            'local'       => 'लोकल',
            'development' => 'डेवलपमेंट',
            'staging'     => 'स्टेजिंग',
            'production'  => 'प्रोडक्शन',
            'testing'     => 'टेस्टिंग',
        ],
        'debug_on'   => 'सक्षम',
        'debug_off'  => 'अक्षम',
    ],

    'database' => [
        'heading'         => 'डेटाबेस',
        'subheading'      => 'आगे बढ़ने से पहले हम कनेक्शन की जाँच करेंगे।',
        'driver'          => 'ड्राइवर',
        'host'            => 'होस्ट',
        'port'            => 'पोर्ट',
        'name'            => 'डेटाबेस का नाम',
        'username'        => 'यूज़रनेम',
        'password'        => 'पासवर्ड',
        'test_connection' => 'कनेक्शन जाँचें',
        'connection_failed' => 'डेटाबेस कनेक्शन विफल: :error',
        'connected_to'    => ':driver से सफलतापूर्वक कनेक्ट हो गए।',
    ],

    'requirements' => [
        'heading'     => 'PHP आवश्यकताएँ',
        'php_running' => 'PHP :current चल रहा है (आवश्यक: :required)।',
        'loaded'      => 'लोडेड',
        'missing'     => 'अनुपस्थित',
    ],

    'permissions' => [
        'heading'      => 'फ़ोल्डर अनुमतियाँ',
        'subheading'   => 'Laravel को इन डायरेक्ट्री में लिखने की अनुमति चाहिए।',
        'writable'     => 'राइटेबल',
        'not_writable' => 'राइटेबल नहीं',
        'not_found'    => 'नहीं मिला',
    ],

    'finish' => [
        'heading'    => 'इंस्टॉल के लिए तैयार',
        'subheading' => 'हम कॉन्फ़िगरेशन लिखेंगे, ऐप्लिकेशन तैयार करेंगे और सेटअप पूरा करेंगे।',
        'actions'    => [
            'env'        => 'कॉन्फ़िगर किए गए मान .env में लिखें',
            'app_key'    => 'अनुपस्थित होने पर APP_KEY उत्पन्न करें',
            'migrations' => 'डेटाबेस माइग्रेशन चलाएँ',
            'seeders'    => 'डेटाबेस सीडर चलाएँ',
            'caches'     => 'config, route, view और cache साफ़ करें',
            'lock'       => 'इंस्टॉल लॉक storage/.installed बनाएँ',
        ],
        'cta'    => ':app इंस्टॉल करें',
        'notice' => 'इसमें कुछ सेकंड लग सकते हैं।',
    ],

    'complete' => [
        'heading'  => ':app तैयार है',
        'subhead'  => 'इंस्टॉलेशन पूरा हुआ। थोड़ी देर में आपको रीडायरेक्ट किया जाएगा…',
        'log'      => 'इंस्टॉलेशन लॉग',
        'open_app' => ':app अभी खोलें',
    ],

];
