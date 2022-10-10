<?php

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=u0258205_moretech',
            'username' => 'u0258205_moretech',
            'password' => 'moretechmoretech',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'ssl://smtp.yandex.ru',
                'username' => 'garden-nefu@yandex.ru',
                'password' => 'izgwxgbhtkjxsxfu',
                'port' => '465',
            ],
        ],
    ],
];
