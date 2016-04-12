<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-storebackend',
    'name' => 'KITTY--商家后台',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'storebackend\controllers',
    'defaultRoute' => 'admin',
    'language' => 'zh-CN',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
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
            'errorAction' => 'error/error',
        ],
         'urlManager' => [
               'enablePrettyUrl' => true,
//             'showScriptName' => false,
//             'suffix' => '.html' //定义伪静态
         ],
    ],
    'params' => $params,
];
