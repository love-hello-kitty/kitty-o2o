<?php
namespace backend\controllers;

use Yii;
use backend\base\BaseBackController;

//后台管理员相关操作的控制器
class AdminController extends BaseBackController
{
    //后台首页
    public function actionIndex() {
        return $this->render('index');
    }
}
