<?php
namespace frontend\controllers;

use Yii;
use frontend\base\BaseFrontController;

//前端商家相关页面
class StoreController extends BaseFrontController
{
    //首页
    public function actionIndex() {
        return $this->render('index');
    }
}