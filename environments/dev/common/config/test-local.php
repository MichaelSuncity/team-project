<?php
return [
    'components' => [
        'db' => [
        	'class' => 'yii\db|connection',
            'dsn' => 'mysql:host=localhost;dbname=myfinance_test',
            'username'=>'root',
            'password'=>'',
            'charset'=>'utf8',
        ],
    ],
];
