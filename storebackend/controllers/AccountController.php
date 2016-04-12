<?php
namespace storebackend\controllers;

use Yii;
use storebackend\base\BaseBackController;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use common\models\StoreAccount;
define('NO_LOGIN',true);
//商家后台管理相关操作的控制器
class AccountController extends BaseBackController
{
    //登录界面
    public function actionIndex() {
        $this->layout = 'login';
        $session = Yii::$app->session;
        //如果已经登陆，点击登陆跳到指定界面
    	if(isset($session[Yii::$app->params['store_admin_session_name']])) {
    		$this->redirect(['admin/index']);
    	}else{
    		return $this->render('login');
    	}
    }

    //执行登录动作
    public function actionDologin() {
        $account_name = Yii::$app->request->post('account_name');
    	$password = Yii::$app->request->post('password');
    	if(empty($username)) {
    		$this->redirect(['account/index']);
    	}
    	if(empty($password)) {
    		$this->redirect(['account/index']);
    	}
    	$account = new StoreAccount();
    	$ret = $account->login($account_name , $password);
    	if($ret === Error::SUCCESS) {
    		$this->redirect(['admin/index']);
    	}else{
    		$this->redirect(['account/index']);
    	}
    }

    //退出登陆
    public function actionLogout() {
        $session = Yii::$app->session;
    	if(isset($session[Yii::$app->params['store_admin_session_name']])) {
    		Yii::$app->session->remove(Yii::$app->params['store_admin_session_name']);
    	}
    	$this->redirect(['account/index']);
    }
}
