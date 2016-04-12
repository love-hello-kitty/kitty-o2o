<?php
//业务层面的帮助类
namespace common\helpers;

use Yii;

class Helper
{
    //获取登录的会员信息
    public static function getUser() {
        if (isset(Yii::$app->session['__memberinfo'])) {
	        return Yii::$app->session['__memberinfo'];
	    }else{
	        return [];
	    }
    }
}