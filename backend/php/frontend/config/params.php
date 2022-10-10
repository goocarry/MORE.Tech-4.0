<?php
return [
    'adminEmail' => 'garden-nefu@yandex.ru',

    'custom_view_for_modules' => [
        'page_front' => [
            'view' => '@frontend/views/page/view',
        ],
        'blog_front' => [
            'index' => '@frontend/views/news/index',
            'view' => '@frontend/views/news/view',
        ],
        'collective_front' => [
            'index' => '@frontend/views/collective/index',
            'view' => '@frontend/views/collective/view',
        ]
    ],

    // Meta Tags for default
    'meta_keywords' => [
		'name' => 'keywords',
		'content' => 'Ботанический сад',
	],
    'meta_description' => [
	    'name' => 'description',
	    'content' => 'Ботанический сад',
	],
    'meta_image' => ['name' => 'image', 'content' => '/theme/img/logo/icon.jpg'],
    'meta_type' => ['name' => 'type', 'content' => 'website'],
    'meta_url' => ['name' => 'url', 'content' => null],
];
