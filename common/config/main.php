<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'uploader' => [
			'class' => 'common\components\Uploader',
			'allowExts' => ['jpg','jpeg','bmp','png','gif']
		]
    ],
];
