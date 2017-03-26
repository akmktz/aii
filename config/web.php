<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU',
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'tBdQkD8FmvCwqZdTPOR9t7b9c3vfABMR',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/admin/' => 'admin/default/index',
                '/admin/login' => 'admin/default/login',
                '/admin/logout' => 'admin/default/logout',
                '/admin/set_status' => 'admin/default/set-status',
                'admin/<module:[\w-]+>/<controller:[\w-]+>' => '<module>/admin/<controller>',
                //'admin/<action:[\w]+>' => 'admin/default/<action>',
                'admin/<module:[\w-]+>/<controller:[\w-]+>/<action:[\w]+>/<id>' => '<module>/admin/<controller>/<action>',
                'admin/<module:[\w-]+>/<controller:[\w-]+>/<action:[\w]+>' => '<module>/admin/<controller>/<action>',

                'about' => 'site/about',
                'contact' => 'site/contact',
                'login' => 'site/login',
                'logout' => 'site/logout',
                '/' => 'blog/default/index',
                '/<groupAlias>' => 'blog/default/group',
                '/<groupAlias>/<postAlias>' => 'blog/default/post',
            ],
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'php:d-M-Y',
            'datetimeFormat' => 'php:d-M-Y H:i:s',
            'timeFormat' => 'php:H:i:s',
        ]
    ],
    'params' => $params,
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        'blog' => [
            'class' => 'app\modules\blog\Module',
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
