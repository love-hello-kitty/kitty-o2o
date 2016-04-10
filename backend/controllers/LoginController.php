<?php

namespace backend\controllers;

use Yii;
use backend\base\BaseBackController;
use backend\models\AdminUser;
use backend\helpers\Error;

//后台登录首页相关控制器
define('NO_LOGIN',true);
class LoginController extends BaseBackController
{
    //登录界面
    public function actionIndex() {
        $this->layout = 'login';
        $session = Yii::$app->session;
        //如果已经登陆，点击登陆跳到指定界面
    	if(!empty($session[Yii::$app->params['admin_session_name']])) {
    		$this->redirect(['admin/index']);
    	}else{
    		return $this->render('index');
    	}
    }

    //执行登录动作
    public function actionLogin() {
        $username = Yii::$app->request->post('username');
    	$password = Yii::$app->request->post('password');
    	if(empty($username)) {
    		$this->redirect(['login/index']);
    	}
    	if(empty($password)) {
    		$this->redirect(['login/index']);
    	}
    	$admin_user = new AdminUser();
    	$ret = $admin_user->login($username , $password);
    	if($ret === Error::SUCCESS) {
    		$this->redirect(['admin/index']);
    	}else{
    		$this->redirect(['login/index']);
    	}
    }

    //退出登陆
    public function actionLogout() {
        $session = Yii::$app->session;
    	if(isset($session[Yii::$app->params['admin_session_name']])) {
    		Yii::$app->session->remove(Yii::$app->params['admin_session_name']);
    	}
    	$this->redirect(['login/index']);
    }
}
