<?php
namespace storebackend\controllers;

use common\models\Membership;

use Yii;
use storebackend\base\BaseBackController;
use yii\web\NotFoundHttpException;
use storebackend\helpers\Error;
use common\helpers\Common;
use common\models\GoodsOrder;

//统计管理模块
class StatisticsController extends BaseBackController
{
    //统计页面
    public function actionIndex() {
        //获取订单总数
        $pay_type = intval(Yii::$app->request->post('pay_type',0));//付款方式
        $pay_status = intval(Yii::$app->request->post('pay_status',0));//付款付款状态
        $status = intval(Yii::$app->request->post('status',0));//订单状态
        
        $condition = ['store_id' => $this->store_id];
        if (!empty($pay_type)) {
            $condition['pay_type'] = $pay_type;
        }

        if (!empty($pay_status)) {
            $condition['pay_status'] = $pay_status;
        }

        if (!empty($status)) {
            $condition['status'] = $status;
        }
        //总订单数
        $order_count = GoodsOrder::find()->where($condition)->count();
        //总会员数
        $member_count = Membership::find()->where(['store_id' => intval($this->store_id)])->count();
        //获取已经付款总额
        $pay_count = GoodsOrder::find()->where(['store_id' => intval($this->store_id),'pay_status' => 2])->sum('total_price');
        //获取已经折扣总额
        $discount_count = GoodsOrder::find()->where(['store_id' => intval($this->store_id),'pay_status' => 2])->sum('discount');
        return $this->render('index',[
            'order_count' => $order_count,
            'member_count' => $member_count,
            'pay_count' => $pay_count,
            'discount_count' => $discount_count
        ]);
    }
}