<?php

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=db;dbname=yii-template-db',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
        ],
    ],
];
