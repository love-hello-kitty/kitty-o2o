<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$config = [
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
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Utph0VKUe5XJF_FkB6MMDApnQ1BZeotl',
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

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;


