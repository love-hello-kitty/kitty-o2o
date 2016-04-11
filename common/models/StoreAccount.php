<?php

namespace common\models;

use Yii;

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
class StoreAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%kt_store_account}}';
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
}