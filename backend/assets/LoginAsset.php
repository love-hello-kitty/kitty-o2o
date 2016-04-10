<?php

namespace backend\assets;

use yii\web\AssetBundle;

//登陆用到的资源包
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/common/bootstrap.min.css',
        'css/common/bootstrap-responsive.min.css',
        'css/common/unicorn.login.css',
    ];
    public $js = [
        'js/common/jquery.min.js',
        'js/common/unicorn.login.js',
    ];
}
