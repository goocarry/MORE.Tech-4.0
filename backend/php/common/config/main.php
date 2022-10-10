<?php

use yii\rbac\DbManager;

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => DbManager::class,
        ],
        'jwt' => [
            'class' => \bizley\jwt\Jwt::class,
            'signer' => \bizley\jwt\Jwt::HS256, // Signer ID, or signer object, or signer configuration
            'signingKey' => [ // Secret key string or path to the signing key file
                'key' => 'secretTooLong_AND_secretTooLong_much_more',
                'passphrase' => '',
                'store' => \bizley\jwt\Jwt::STORE_IN_MEMORY,
                'method' => \bizley\jwt\Jwt::METHOD_PLAIN,
            ],
            'validationConstraints' => [
                new \Lcobucci\JWT\Validation\Constraint\SignedWith(
                    new \Lcobucci\JWT\Signer\Hmac\Sha256(),
                    \Lcobucci\JWT\Signer\Key\InMemory::plainText('secretTooLong_AND_secretTooLong_much_more', '')
                ),
                new \Lcobucci\JWT\Validation\Constraint\IdentifiedBy(
                    '4f1g23a12aa'
                ),
                new \Lcobucci\JWT\Validation\Constraint\IssuedBy(
                    'http://localhost:3000'
                ),
                new \Lcobucci\JWT\Validation\Constraint\LooseValidAt(
                    \Lcobucci\Clock\SystemClock::fromSystemTimezone()
                ),
            ],
        ],
    ],
    'modules' => [
        'gii' => [
            'class' => \yii\gii\Module::className(),
            'allowedIPs' => ['*']
        ],
        'blog' => [
            'class' => \common\modules\blog\Module::className(),
        ],
        'task' => [
            'class' => \common\modules\task\Module::className(),
        ],
    ]
];
