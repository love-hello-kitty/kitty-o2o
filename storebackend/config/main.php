<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/params.php')
);

$config = [
    'id' => 'app-storebackend',
    'name' => 'KITTY--商家后台',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'storebackend\controllers',
    'defaultRoute' => 'admin',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\StoreAccount',
            'enableAutoLogin' => true
        ],
        'session' => [
            'class' => 'yii\web\Session',
            'name' => 'STOREBACKENDSSID',
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
        'request' => [
            'cookieValidationKey' => 'Utph0VKUe5XJF_FkB6MMDApnQ1BZeotl',
        ],
        'errorHandler' => [
            'errorAction' => 'error/error',
        ],
         'urlManager' => [
               'enablePrettyUrl' => true,
               'showScriptName' => true,
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