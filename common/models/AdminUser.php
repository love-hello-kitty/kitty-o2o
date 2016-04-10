<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%kt_admin_user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $salt
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $order_id
 */
class AdminUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%kt_admin_user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'salt'], 'required'],
            [['status', 'create_time', 'update_time', 'order_id'], 'integer'],
            [['username'], 'string', 'max' => 20],
            [['password'], 'string', 'max' => 60],
            [['salt'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '自增ID',
            'username' => '用户名称',
            'password' => '密码',
            'salt' => '干扰码',
            'status' => '用户状态1:正常 2被封禁',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
            'order_id' => '排序ID',
        ];
    }

    //执行后台登录操作
    public function login($username = '' , $password = '') {
    	$admin_user = AdminUser::find()
    			->where(['username' => $username,'status' => 1])
    			->one();
    	if (!$admin_user) {
    		return Error::ERR_NOUSER;
    	}
    	$_password = md5($admin_user->salt . $password);
    	if ($_password != $admin_user->password) {
    		return Error::ERR_PASSWORD;
    	} else {
    		Yii::$app->session->set(Yii::$app->params['admin_session_name'],array(
    			'id'			=> $admin_user->id,
    			'username'      => $admin_user->username
    		));
    		return Error::SUCCESS;
    	}
    }
}