<?php
/**
 * 后台基类
 * 
 */
namespace backend\base;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class BaseBackController extends Controller
{
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
	        if (empty($session[Yii::$app->params['admin_session_name']]) && (!defined('NO_LOGIN') || !NO_LOGIN)) {
	            $this->redirect(['login/index']);
	        }
	        return true;
	    }else{
	        return false;
	    }
    }
}