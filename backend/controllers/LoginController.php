<?php

namespace backend\controllers;

use Yii;
use backend\base\BaseBackController;
use backend\helpers\Error;
use backend\models\LoginForm;

//后台登录首页相关控制器
define('NO_LOGIN',true);
class LoginController extends BaseBackController
{
    public $layout = 'login';
    //执行登录动作
    public function actionIndex() {
        //已经登录就跳到后台首页
        if (!\Yii::$app->user->isGuest) {
            $this->redirect(['admin/index']);
        }
        $model = new LoginForm();
        $post = Yii::$app->request->post();
        $model->username = $post['username'];
        $model->password = $post['password'];
        if ($model->validate() && $model->login()) {
            //登录成功就跳转到后台首页
            $this->redirect(['admin/index']);
        } else {
            //登录失败就回到登录界面
            return $this->render('index');
        }
    }

    //退出登陆
    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->redirect(['login/index']);
    }
}
