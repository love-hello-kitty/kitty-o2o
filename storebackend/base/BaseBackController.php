<?php
/**
 * 商家后台基类
 * 
 */
namespace storebackend\base;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class BaseBackController extends Controller
{
    public $store_id;
	public function behaviors() {
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'logout' => ['post','get'],
				],
			],
		];
	}
	
	public function beforeAction($action) {
	    if (parent::beforeAction($action)) {
	        $session = Yii::$app->session;
	        if (empty($session[Yii::$app->params['store_admin_session_name']]) && (!defined('NO_LOGIN') || !NO_LOGIN)) {
	            //跳转到登录页面
	            $this->redirect(['account/index']);
	        }
	        //如果已经登录就保存store_id
	        if (!empty($session[Yii::$app->params['store_admin_session_name']])) {
	            $this->store_id = intval($session[Yii::$app->params['store_admin_session_name']]['store_id']);
	        }
	        return true;
	    }else{
	        return false;
	    }
    }
}