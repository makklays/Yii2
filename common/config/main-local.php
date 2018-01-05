<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii', // dbname=yii2advanced
            'username' => 'dbuser',
            'password' => 'dbpswd',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],
        'echo' => [
            'class' => 'common\components\EchoPrint',
        ],
        'ReadHttpHeader' => [
            'class' => 'common\components\ReadHttpHeader',
        ],
        'slug' => [
            'class' => 'common\components\Slug',
        ],
    ],
];
