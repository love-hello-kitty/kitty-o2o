<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%kt_members}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $sex
 * @property integer $avatar_id
 * @property string $password
 * @property string $salt
 * @property string $email
 * @property string $phone
 * @property double $balance
 * @property integer $points
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $order_id
 */
class Members extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%kt_members}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'salt'], 'required'],
            [['avatar_id', 'points', 'status', 'create_time', 'update_time', 'order_id'], 'integer'],
            [['balance'], 'number'],
            [['username', 'phone'], 'string', 'max' => 20],
            [['sex'], 'string', 'max' => 1],
            [['password', 'email'], 'string', 'max' => 60],
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
            'username' => '用户名(昵称)',
            'sex' => '性别:M男F女',
            'avatar_id' => '头像ID',
            'password' => '密码',
            'salt' => '干扰码',
            'email' => '邮箱',
            'phone' => '手机号',
            'balance' => '账户金额',
            'points' => '积分',
            'status' => '用户状态1:正常 2被封禁',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
            'order_id' => '排序ID',
        ];
    }
}
