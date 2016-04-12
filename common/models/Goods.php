<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%kt_goods}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $store_id
 * @property integer $sort_id
 * @property integer $pic_id
 * @property double $price
 * @property string $brief
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $order_id
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['store_id', 'sort_id', 'pic_id', 'status', 'create_time', 'update_time', 'order_id'], 'integer'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 50],
            [['brief'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '商品名称',
            'store_id' => '所属商家ID',
            'sort_id' => '商品所属类别',
            'pic_id' => '商品图片ID',
            'price' => '商品单价',
            'brief' => '商品描述',
            'status' => '商品状态1:待上架2:已上架3已下架',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
            'order_id' => '排序ID',
        ];
    }
}
