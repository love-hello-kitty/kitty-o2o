<?php
namespace storebackend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use storebackend\base\BaseBackController;
use storebackend\helpers\Error;
use common\models\StoreAccount;
use common\helpers\Common;

//商家账号管理模块
class StoreAccountController extends BaseBackController
{
    //账号详情页面
    public function actionIndex() {
        //获取本商家的账号
        $account = StoreAccount::findOne(['store_id' => intval($this->store_id)]);
        if (empty($account)) {
            throw new NotFoundHttpException('您没有权限查看此账号');
        }
        $account = $account->attributes;
        return $this->render('index',[
            'model' => $account
        ]);
    }

    //修改密码
    public function actionModifyPassword() {
        $account = StoreAccount::findOne(['store_id' => intval($this->store_id)]);
        if (empty($account)) {
            Error::output(Error::ERR_ILLEGAL);
        }
        
        $cur_password = Yii::$app->request->post('old_password');//原始密码
		$new_password = Yii::$app->request->post('new_password');//新密码
		$comfirm_password = Yii::$app->request->post('comfirm_password');//确认密码

		if(empty($cur_password) || empty($new_password) || empty($comfirm_password)) {
			Error::output(Error::ERR_NOPWD);
		}elseif (md5($account->salt . $cur_password) != $account->password) {
		    Error::output(Error::ERR_OLD_PASSWORD_ERROR);
		}elseif(strlen($new_password) > 15 || strlen($comfirm_password) > 15) {
			Error::output(Error::ERR_PASSWORD_TOO_LONG);
		}else if($new_password !== $comfirm_password) {
            Error::output(Error::ERR_PWDNOEQUAL);
		}

		//随机长生一个干扰码
		$salt = Common::getGenerateSalt();
		$account->salt = $salt;
		$account->password = md5($salt . $new_password);
		$account->update_time = time();
		if($account->save()) {
		    Error::output(Error::SUCCESS);
		}else{
			Error::output(Error::ERR_FAIL);
		}
    }
}