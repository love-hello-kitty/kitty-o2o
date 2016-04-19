<?php
namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use backend\base\BaseBackController;
use common\helpers\Common;
use common\models\GoodsOrder;
use common\models\Members;
use common\models\Store;

//统计管理模块
class StatisticsController extends BaseBackController
{
    //统计页面
    public function actionIndex() {
        //获取订单总数
        $pay_type = intval(Yii::$app->request->post('pay_type',0));//付款方式
        $pay_status = intval(Yii::$app->request->post('pay_status',0));//付款付款状态
        $status = intval(Yii::$app->request->post('status',0));//订单状态
        $store_id = intval(Yii::$app->request->post('store_id',0));//商家ID
        $stime = strtotime(Yii::$app->request->post('stime',''));//开始时间
        $etime = strtotime(Yii::$app->request->post('etime',''));//结束时间
        
        $condition = [];
        if (!empty($pay_type)) {
            $condition['pay_type'] = $pay_type;
        }

        if (!empty($pay_status)) {
            $condition['pay_status'] = $pay_status;
        }

        if (!empty($status)) {
            $condition['status'] = $status;
        }
        
        if (!empty($store_id)) {
            $condition['store_id'] = $store_id;
        }

        //总订单数
        $order_query = GoodsOrder::find()->where($condition);
        if (!empty($stime) && !empty($etime) && ($stime < $etime)) {
            $order_query->andWhere('create_time > :stime AND create_time < :etime',['stime' => $stime,'etime' => $etime]);
        }
        $order_count = $order_query->count();
        //用户总数
        $member_count = Members::find()->count();
        //获取已经付款总额
        $pay_count = GoodsOrder::find()->where(['pay_status' => 2])->sum('total_price');
        //获取已经折扣总额
        $discount_count = GoodsOrder::find()->where(['pay_status' => 2])->sum('discount');
        //获取商家总数
        $store_count = Store::find()->where(['status' => 2])->count();
        
        
        //查询所有商家
        $store_info = Store::findAll(['status' => 2]);

        return $this->render('index',[
            'order_count' => $order_count,
            'member_count' => $member_count,
            'pay_count' => $pay_count,
            'discount_count' => $discount_count,
            'store_count' => $store_count,
            'store_info' => $store_info
        ]);
    }
}