<?php

return [
    'id' => 'app-backend-tests',
    'basePath' => dirname(__DIR__),
    'components' => [
        'assetManager' => [
            'basePath' => __DIR__ . '/../web/assets',
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
        'request' => [
            'cookieValidationKey' => 'test',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=db;dbname=yii-template-db',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
        ],
    ],
];
