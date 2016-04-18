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
    public function beforeAction($action) {
	    if (parent::beforeAction($action)) {
    	    if (Yii::$app->user->isGuest && (!defined('NO_LOGIN') || !NO_LOGIN)) {
                $this->redirect(['account/index']);
            }
	        //如果已经登录就保存store_id,方便在子类中使用
	        if (!empty(Yii::$app->user->identity->store_id)) {
	            $this->store_id = intval(Yii::$app->user->identity->store_id);
	        }
	        return true;
	    }else{
	        return false;
	    }
    }
}