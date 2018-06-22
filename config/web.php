<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'jasper' => [
'class' => 'chrmorandi\jasper\Jasper',
'db' => [
'host' => 'localhost',
'port' => 5432,
'driver' => 'postgres',
'dbname' => 'proyecto',
'username' => 'postgres',
'password' => 'postgres',
]
],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'kMpUH6I3EEdP5xbMym8pOUP5yEpdyFev',
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
       /* 'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],*/
    
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                //'__class' => Swift_SmtpTransport::class,
                //'host' => 'localhost',
                // 'username' => 'root',
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'tis.umss.2018@gmail.com',
                'password' => 'bpxrmmfrqcncqujk',
                'port' => '587',
                'encryption' => 'tls',
                
            ],
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
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
      ],
      ],
     
    ],
    /**asignacion de los modules */
    'modules' => [
            'proyecto' => [
                'class' => 'app\modules\proyecto\Module',
            ],
          'empleado' => [
            'class' => 'app\modules\empleado\Module',
        ],
        'parametro' => [
            'class' => 'app\modules\parametro\Module',
        ],
        ],
    'params' => $params,
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
            //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
