<?php
namespace frontend\controllers;

use Yii;
use frontend\base\BaseFrontController;

//前端控制器
class SiteController extends BaseFrontController
{
    //首页
    public function actionIndex() {
        return $this->render('index');
    }
}