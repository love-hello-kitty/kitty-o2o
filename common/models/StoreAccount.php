<?php

namespace common\models;

use Yii;
use storebackend\helpers\Error;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%kt_store_account}}".
 *
 * @property integer $id
 * @property integer $store_id
 * @property string $account_name
 * @property string $password
 * @property string $salt
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $order_id
 */
class StoreAccount extends ActiveRecord implements IdentityInterface
{
    const STATUS_ACTIVE = 1;  //正常状态
    const STATUS_BLOCK  = 2; //被封禁

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%store_account}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_id', 'status', 'create_time', 'update_time', 'order_id'], 'integer'],
            [['account_name', 'password', 'salt'], 'required'],
            [['account_name'], 'string', 'max' => 20],
            [['password'], 'string', 'max' => 60],
            [['salt'], 'string', 'max' => 10],
            [['account_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '自增ID',
            'store_id' => '所属商家',
            'account_name' => '账户名称',
            'password' => '密码',
            'salt' => '干扰码',
            'status' => '用户状态1:正常 2被封禁',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
            'order_id' => '排序ID',
        ];
    }

	/**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        return static::findOne(['account_name' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        //return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    //验证密码(自定义)
    public function validatePassword($password) {
        //根据规则生成用于验证的密码与库里面密码进行比较
    	$validate_password = md5($this->salt . $password);
    	return $validate_password == $this->password;
    }

 	/**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {
        //$this->auth_key = Yii::$app->security->generateRandomString();
    }
}
