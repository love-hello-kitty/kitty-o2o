<?php
namespace storebackend\controllers;

use Yii;
use storebackend\base\BaseBackController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use storebackend\helpers\Error;
use common\models\Store;

//门店管理控制器
class StoreController extends BaseBackController
{
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'update' => ['post'],
                ],
            ],
        ];
    }

    //开放出可以给商家自己设置的门店的属性
    public function actionIndex() {
        //首先查询出门店的信息
        $store_model = Store::findOne(['id' => intval($this->store_id),'status' => 2]);
        if (empty($store_model)) {
            throw new NotFoundHttpException(Yii::t('yii','商家不存在'));
        }
        $store_info = $store_model->attributes;
        if (!empty($store_info['store_service'])) {
            $store_info['store_service'] = explode('|', $store_info['store_service']);
        }else{
            $store_info['store_service'] = [];
        }
        return $this->render('index', [
              'store_info' => $store_info
        ]);
    }

    //更新门店信息
    public function actionUpdate() {
        $post = Yii::$app->request->post();
        if (empty($post['open_stime']) || !strtotime($post['open_stime'])) {
            throw new NotFoundHttpException(Yii::t('yii','请正确填写营业开始时间'));
        }

        if (empty($post['open_etime']) || !strtotime($post['open_etime'])) {
            throw new NotFoundHttpException(Yii::t('yii','请正确填写营业结束时间'));
        }

        if (empty($post['store_area'])) {
            throw new NotFoundHttpException(Yii::t('yii','门店面积不能为空'));
        }

        $store_service = '';
        if (!empty($post['store_service'])) {
            $store_service = implode('|', $post['store_service']);
        } 

        $store_model = Store::findOne(['id' => intval($this->store_id),'status' => 2]);
        if (empty($store_model)) {
            throw new NotFoundHttpException(Yii::t('yii','商家不存在'));
        }

        $store_model->open_stime = date('H:i:s',strtotime($post['open_stime']));
        $store_model->open_etime = date('H:i:s',strtotime($post['open_etime']));
        $store_model->store_area = $post['store_area'];
        $store_model->store_service = $store_service;
        $store_model->coffeemaker = !empty($post['coffeemaker']) ? $post['coffeemaker'] : '';
        $store_model->coffee_beans = !empty($post['coffee_beans']) ? $post['coffee_beans'] : '';
        if ($store_model->save()) {
            $this->redirect(['store/index']);
        }else{
            throw new NotFoundHttpException(Yii::t('yii','保存失败'));
        }
    }
}