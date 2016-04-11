<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%kt_goods_order}}".
 *
 * @property integer $id
 * @property integer $store_id
 * @property string $order_number
 * @property string $goods_info
 * @property integer $pay_type
 * @property integer $pay_time
 * @property integer $pay_status
 * @property integer $status
 * @property integer $member_id
 * @property string $consume_code
 * @property double $discount
 * @property double $total_price
 * @property integer $consume_time
 * @property integer $create_time
 * @property integer $order_id
 */
class GoodsOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%kt_goods_order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_id', 'pay_type', 'pay_time', 'pay_status', 'status', 'member_id', 'consume_time', 'create_time', 'order_id'], 'integer'],
            [['order_number', 'goods_info', 'consume_code'], 'required'],
            [['goods_info'], 'string'],
            [['discount', 'total_price'], 'number'],
            [['order_number', 'consume_code'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'store_id' => '该订单所属哪家店',
            'order_number' => '订单编号',
            'goods_info' => '商品信息',
            'pay_type' => '付款方式:1到店支付2:在线支付',
            'pay_time' => '付款时间',
            'pay_status' => '付款状态1:待付款 2:已付款',
            'status' => '订单状态1:未消费2:已消费',
            'member_id' => '下单人的用户id',
            'consume_code' => '订单生成之后形成的消费码',
            'discount' => '优惠价格',
            'total_price' => 'Total Price',
            'consume_time' => '消费时间',
            'create_time' => 'Create Time',
            'order_id' => '排序ID',
        ];
    }
}
