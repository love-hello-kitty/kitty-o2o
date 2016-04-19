<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%membership}}".
 *
 * @property integer $store_id
 * @property integer $member_id
 * @property integer $create_time
 */
class Membership extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%membership}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_id', 'member_id', 'create_time'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'store_id' => 'Store ID',
            'member_id' => 'Member ID',
            'create_time' => 'Create Time',
        ];
    }
    
    //获取关联的用户
    public function getMember() {
        return $this->hasOne(Members::className(), ['id' => 'member_id']);
    }
}
