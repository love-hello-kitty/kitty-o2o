<?php

namespace storebackend\controllers;

use common\models\OrderProduct;

use Yii;
use common\models\GoodsOrder;
use storebackend\base\BaseBackController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use storebackend\helpers\Error;

//订单管理控制器
class GoodsOrderController extends BaseBackController
{
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'create' => ['post'],
                    'update' => ['post'],
                    'audit'  => ['post']
                ],
            ],
        ];
    }

    //订单列表
    public function actionIndex() {
        //获取搜索条件
        $pay_type = intval(Yii::$app->request->get('pay_type',0));//付款方式
        $pay_status = intval(Yii::$app->request->get('pay_status',0));//付款付款状态
        $status = intval(Yii::$app->request->get('status',0));//订单状态
        $order_number = Yii::$app->request->get('order_number','');//订单号

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

        if (!empty($order_number)) {
            $condition['order_number'] = $order_number;
        }

        $query = GoodsOrder::find()->where($condition);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize' => 20]);
        $models = $query->offset($pages->offset)
                        ->limit($pages->limit)
                        ->orderBy(['order_id' => SORT_DESC]) //倒序排列
                        ->all();
        $data = [];
        foreach ($models AS $k => $v) {
            $data[$k] = $v->attributes;
            $data[$k]['status_text'] = Yii::$app->params['order_status'][$v->status];
            $data[$k]['pay_status_text'] = Yii::$app->params['order_pay_status'][$v->pay_status];
            $data[$k]['pay_type_text'] = Yii::$app->params['pay_type'][$v->pay_type];
            $data[$k]['create_time'] = date('Y-m-d H:i',$v->create_time);
            //获取每一个订单的下单人
            if (!empty($v->member)) {
                $member_info = $v->member->attributes;
                unset($member_info['password'],$member_info['salt']);
                $data[$k]['member_info'] = $member_info;
            }else{
                $data[$k]['member_info'] = [];
            }            
        }
        return $this->render('index', [
              'models' => $data,
              'pages' => $pages,
        ]);
    }

    //订单详情
    public function actionForm($id = 0) {
        if (empty($id)) {
            throw new NotFoundHttpException('没有订单ID');
        }
        //查询出订单信息
        $model = $this->findModel($id);
        $goods_order = $model->attributes;
        if (!empty($goods_order['goods_info'])) {
            $goods_order['goods_info'] = json_decode($goods_order['goods_info'],1);
        }
        $goods_order['status_text'] = Yii::$app->params['order_status'][$goods_order['status']];
        $goods_order['pay_status_text'] = Yii::$app->params['order_pay_status'][$goods_order['pay_status']];
        $goods_order['pay_type_text'] = Yii::$app->params['pay_type'][$goods_order['pay_type']];
        $goods_order['create_time'] = date('Y-m-d H:i',$goods_order['create_time']);
        //获取每一个订单的下单人
        if (!empty($model->member)) {
            $member_info = $model->member->attributes;
            unset($member_info['password'],$member_info['salt']);
            $goods_order['member_info'] = $member_info;
        }else{
            $goods_order['member_info'] = [];
        }
        return $this->render('form', [
              'goods_order' => $goods_order,
              'member_info' => $member_info
        ]);
    }
    
    //根据消费吗确认消费
    public function actionConfirmConsume() {
        $post = Yii::$app->request->post();
        if (empty($post['consume_code'])) {
            Error::output(Error::ERR_NO_CONSUME_CODE);
        }

        //根据消费码查询出订单
        $goods_order = GoodsOrder::findOne(['store_id' => intval($this->store_id),'consume_code' => $post['consume_code']]);
        if (empty($goods_order)) {
            Error::output(Error::ERR_CONSUME_CODE_ERROR);
        }
        //判断是否已经消费
        if ($goods_order->status == 2) {
            Error::output(Error::ERR_ALREADY_CONSUME);
        }
        $goods_order->pay_time = time();//更新付款时间
        $goods_order->pay_status = 2;//已付款
        $goods_order->status = 2;//已经消费
        $goods_order->consume_time = time();//消费时间
        if ($goods_order->save()) {
            //更新记录的订单商品
            OrderProduct::updateAll(['is_pay' => 1],'goods_order_id = :goods_order_id',[':goods_order_id' => intval($goods_order->id)]);
            Error::output(Error::SUCCESS,[
                    'order_number' => $goods_order->order_number,
                    'consume_time' => date('Y-m-d H:i:s',$goods_order->consume_time),
                    'member' => $goods_order->member->username,
                    'phone' => $goods_order->member->phone,
                    'total_price' => $goods_order->total_price
            ]);
        }else{
            Error::output(Error::ERR_FAIL);
        }
    }

    //加载模型
    protected function findModel($id) {
        if (($model = GoodsOrder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
