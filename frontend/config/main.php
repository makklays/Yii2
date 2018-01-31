<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'sourceLanguage' => 'en',
    'language' => 'en',
    'aliases' => [
        '@imgs' => '/imgs/',
        //'@name2' => 'path/to/path2',
    ],
    //'catchAll' => ['site/offline'], // отображает одно информационное сообщение для всех запросов
    //'defaultRoute' => 'post/index', // по умолчанию site/index, указываем свое значение
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'defaultRoles' => ['user','moder','admin'],
        ],
        'urlManager' => [
            //'class'=>'yii\web\UrlManager',
            'showScriptName' => true,
            'enablePrettyUrl' => true,
            //'scriptUrl'=>'/index.php',
            //'baseUrl' => 'index.php',
            'class' => 'codemix\localeurls\UrlManager',
            'languages' => ['ru', 'en'],
            'enableDefaultLanguageUrlCode' => true,
            'rules' => [
                '' => 'site/index',
                'post/index' => 'post/index',
                'post/my' => 'post/my',
                'post/pdf' => 'post/pdf',
                'post/day/<date:[0-9_\-]+>' => 'post/day',
                'post/create' => 'post/create',
                'post/delete' => 'post/delete',
                'post/update/<id:\d+>' => 'post/update',
                'post/<slug:[a-z0-9_\-]+>' => 'post/view',
                '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
            ],
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@frontend/messages',
                    'fileMap' => [
                        'app' => 'app.php',
                        'post' => 'post.php',
                        'app/auth' => 'auth.php'
                    ]
                ],
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
        ],
        'pdf' => [
            'class' => kartik\mpdf\Pdf::className(),
            'format' => kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => kartik\mpdf\Pdf::DEST_BROWSER,
        ],
        /*'assetManager' => [
            'basePath' => '@webroot/assets',
            'baseUrl' => '@web/assets'
        ],*/
    ],
    'params' => $params,
];
