<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'zh-CN',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=kitty_o2o',
            'username' => 'root',
            'password' => '123456',
            'charset' => 'utf8',
            'tablePrefix' => 'kt_',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => true,
        ],
        'cache' => [
            'class' => 'yii\caching\MemCache',
            'servers' => [
                [
                    'host' => '127.0.0.1',
                    'port' => 11211
                ],
            ],
        ],
        'uploader' => [
			'class' => 'common\components\Uploader',
			'allowExts' => ['jpg','jpeg','bmp','png','gif']
		],
		'lbscloud' => [
		    'class'  => 'common\components\LbsCloud',
		    'config' => [
		                    'ak' => 'i1Pf71ChI2rHYR8lX2fbG6QhwKqH1XMV',//LBS服务端的密钥
		                    'geotable_id' => '138613',//数据表ID
		                ]
		],
		'geohash' => [
		    'class' => 'common\components\GeoHash',
		]
    ],
];
