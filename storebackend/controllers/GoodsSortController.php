<?php

namespace storebackend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use storebackend\base\BaseBackController;
use storebackend\helpers\Error;
use common\models\GoodsSort;

//商品分类控制器
class GoodsSortController extends BaseBackController
{
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    //商品分类列表
    public function actionIndex() {
        $query = GoodsSort::find()->where(['store_id' => $this->store_id]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize' => 20]);
        $models = $query->offset($pages->offset)
                        ->limit($pages->limit)
                        ->all();
        $data = [];
        foreach ($models AS $k => $v) {
            $data[$k] = $v->attributes;
        }
        return $this->render('index', [
              'models' => $data,
              'pages' => $pages,
        ]);
    }

    //商品分类表单页
    public function actionForm($id = 0) {
        $data = [];
        if (!empty($id)) {
            $model = $this->findModel(intval($id));
            $data = $model->attributes;
        }
        return $this->render('form', [
              'model' => $data
        ]);
    }

    //删除分类
    public function actionDelete() {
        $id = Yii::$app->request->post('id');
        if (!intval($id))
           Error::output(Error::ERR_NOID);
        if ($this->findModel($id)->delete()) {
           Error::output(Error::SUCCESS);
        }else{
           Error::output(Error::ERR_FAIL);
        }
    }

    //创建分类
    public function actionCreate() {
        $name = Yii::$app->request->post('name',null);
        if (empty($name)) {
            throw new NotFoundHttpException(Yii::t('yii','分类名称不能为空'));
        }
        $model = new GoodsSort();
        $model->name = $name;
        $model->store_id = intval($this->store_id);
        if ($model->save()) {
            $this->redirect(['goods-sort/index']);
        }else{
            throw new NotFoundHttpException(Yii::t('yii','创建分类失败'));
        }
    }

    //更新分类
    public function actionUpdate() {
        $id = Yii::$app->request->post('id',0);
        $name = Yii::$app->request->post('name',null);
        //判断ID
        if (empty($id)) {
            throw new NotFoundHttpException(Yii::t('yii','ID不能为空'));
        }
        //判断分类名称
        if (empty($name)) {
            throw new NotFoundHttpException(Yii::t('yii','分类名称不能为空'));
        }
        
        $model = $this->findModel(intval($id));
        $model->name = $name;
        if ($model->save()) {
            $this->redirect(['goods-sort/index']);
        }else{
            throw new NotFoundHttpException(Yii::t('yii','更新分类失败'));
        }
    }

    //加载模型
    protected function findModel($id) {
        if (($model = GoodsSort::findOne(['id' => intval($id),'store_id' => $this->store_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
