<?php
namespace storebackend\controllers;

use Yii;
use storebackend\base\BaseBackController;
//商家后台管理首页
class AdminController extends BaseBackController
{
    //后台首页
    public function actionIndex() {
        return $this->render('index');
    }
}
