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
    public function beforeAction($action) {
	    if (parent::beforeAction($action)) {
    	    if (Yii::$app->user->isGuest && (!defined('NO_LOGIN') || !NO_LOGIN)) {
                $this->redirect(['account/index']);
            }
	        return true;
	    }else{
	        return false;
	    }
    }
}