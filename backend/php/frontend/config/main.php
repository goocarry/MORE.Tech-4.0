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
    'language' => 'ru_RU',
    'name' => 'MoreTech Hackathon',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
            'parsers' => [
                'application/json' => [
                    'class' => \yii\web\JsonParser::class,
                    'asArray' => true,
                ],
            ],
            'enableCookieValidation' => false,
        ],
        'response' => [
            'format' => \yii\web\Response::FORMAT_JSON,
            'formatters' => [
                \yii\web\Response::FORMAT_JSON => [
                    'class' => 'yii\web\JsonResponseFormatter',
                    'prettyPrint' => YII_DEBUG, // use "pretty" output in debug mode
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                ],
            ],
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
                    'class' => 'codemix\streamlog\Target',
                    'url' => 'php://stdout',
                    'levels' => ['info', 'error', 'warning'],
                    'logVars' => ['_GET', '_POST'],
                ],
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['info', 'error', 'warning'],
                    'logVars' => ['_GET', '_POST'],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'blog/article'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'blog/reaction'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'blog/category'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'blog/comment'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'blog/user-reaction'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'task/task'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'task/task-progress'],

                '<action>' => 'api/<action>',
                '<controller>/<action>' => '<controller>/<action>',
                '<module>/<controller>/<action>' => '<module>/<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
];
