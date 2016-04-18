<?php
namespace storebackend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use storebackend\base\BaseBackController;
use storebackend\helpers\Error;
use storebackend\models\LoginForm;

define('NO_LOGIN',true);
//商家后台管理相关操作的控制器
class AccountController extends BaseBackController
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
        $model->username = $post['account_name'];
        $model->password = $post['password'];
        if ($model->validate() && $model->login()) {
            //登录成功就跳转到后台首页
            $this->redirect(['admin/index']);
        } else {
            //登录失败就回到登录界面
            return $this->render('login');
        }
    }

    //退出登陆
    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->redirect(['account/index']);
    }
}
