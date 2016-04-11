<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%kt_goods_sort}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $store_id
 */
class GoodsSort extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%kt_goods_sort}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['store_id'], 'integer'],
            [['name'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '分类名称',
            'store_id' => '所属商家',
        ];
    }
}
