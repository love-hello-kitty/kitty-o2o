<?php

namespace storebackend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\helpers\Json;
use storebackend\base\BaseBackController;
use storebackend\helpers\Error;
use common\models\Material;
use common\models\GoodsPrice;
use common\models\GoodsSort;
use common\models\Goods;

//商品管理控制器
class GoodsController extends BaseBackController
{
    //动作之前设置一些参数
    public function beforeAction($action) {
        if (parent::beforeAction($action)) {
            Yii::$app->uploader->savePath = '@upload/' . $this->store_id;
            return true;
        }else{
            return false;
        }
    }

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

    //商品列表
    public function actionIndex() {
        $query = Goods::find()->where(['store_id' => $this->store_id]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize' => 20]);
        $models = $query->offset($pages->offset)
                        ->limit($pages->limit)
                        ->orderBy(['order_id' => SORT_DESC]) //倒序排列
                        ->all();
        $data = [];
        foreach ($models AS $k => $v) {
            $data[$k] = $v->attributes;
            $data[$k]['sort_name'] = $v->goodsSort->name;
            $data[$k]['status_text'] = Yii::$app->params['goods_status'][$v->status];
            $data[$k]['create_time'] = date('Y-m-d H:i',$v->create_time);
        }
        return $this->render('index', [
              'models' => $data,
              'pages' => $pages,
        ]);
    }

    //商品表单页
    public function actionForm($id = 0) {
        $data = [];
        if (!empty($id)) {
            $model = $this->findModel(intval($id));
            $data = $model->attributes;
            $data['sort_name'] = $model->goodsSort->name;
            $goods_price = Json::decode(Json::encode($model->goodsPrice));
            if (!empty($goods_price)) {
                foreach ($goods_price AS $k => $v) {
                    $data['goods_price'][$v['goods_size_id']] = $v['price'];
                }
            }
            $data['pic_url'] = '';
            if (!empty($data['goods_picid'])) {
                $img_info = $model->material->attributes;
                if (!empty($img_info)) {
                    $data['pic_url'] = Yii::$app->params['upload_url'] . $img_info['filepath'] . $img_info['filename'];
                }
            }
        }
        //查询出分类
        $goods_sort = GoodsSort::find()
                           ->where(['store_id' => $this->store_id])
                           ->asArray()
                           ->all();
        return $this->render('form', [
              'model' => $data,
              'goods_sort' => $goods_sort
        ]);
    }

    //删除商品
    public function actionDelete() {
        $id = Yii::$app->request->post('id');
        if (!intval($id))
           Error::output(Error::ERR_NOID);
        if ($this->findModel($id)->delete()) {
           //删除之后还要删除关联表
           $query = "DELETE FROM {{%goods_price}} WHERE goods_id = " . intval($id);
           $command = Yii::$app->db->createCommand($query);
           $command->execute();
           Error::output(Error::SUCCESS);
        }else{
           Error::output(Error::ERR_FAIL);
        }
    }

    //创建商品
    public function actionCreate() {
        $post = Yii::$app->request->post();
        //判断商品名称
        if (empty($post['goods_name'])) {
            throw new NotFoundHttpException(Yii::t('yii','商品名称不能为空'));
        }
        //判断分类ID
        if (!intval($post['sort_id'])) {
            throw new NotFoundHttpException(Yii::t('yii','商品分类ID不能为空'));
        }
        //根据型号设置的价格
        if (empty($post['goods_price']) || !is_array($post['goods_price']) || count($post['goods_price']) != 3) {
            throw new NotFoundHttpException(Yii::t('yii','商品价格有误，请设置好每种杯型的价格'));
        }
        $model = new Goods();
        //商品图片
        if (!empty($_FILES['goods_pic']) && $_FILES['goods_pic']['error'] === 0) {
            $ret = Yii::$app->uploader->upload($_FILES['goods_pic']);
            if ($ret === false) {
                throw new NotFoundHttpException(Yii::t('yii',Yii::$app->uploader->errorMsg));
            }
            //上传成功之后获取上传的信息
            $img_info = Yii::$app->uploader->uploadFileInfo;
            if (!empty($img_info)) {
                $material_model = new Material;
                $material_model->name = $img_info['name'];//原始文件名
                $material_model->filepath = $this->store_id . '/' . $img_info['secondfilePath'];
                $material_model->filename = $img_info['savename'];
                $material_model->type = 'image';
                $pic_size = getimagesize($img_info['savepath'] . $img_info['savename']);
                $material_model->imgwidth = $pic_size[0];
                $material_model->imgheight = $pic_size[1];
                $material_model->filesize = $img_info['size'];
                $material_model->create_time = time();
                if ($material_model->save()) {
                    $model->goods_picid = intval($material_model->id);
                }
            }
        }
        $model->goods_name = $post['goods_name'];
        $model->sort_id = intval($post['sort_id']);
        $model->store_id = intval($this->store_id);
        $model->brief = $post['brief'];
        $model->create_time = time();
        $model->update_time = time();
        if ($model->save()) {
            $model->order_id = $model->id;
            $model->save();
            //建立杯型与价格的对应关系
            $query = "INSERT INTO {{%goods_price}} (goods_id,goods_size_id,price) VALUES ";
            $values = [];
            foreach ($post['goods_price'] AS $size_id => $price) {
                $price = !empty($price) ? $price : 0;
                $values[] = "(" . intval($model->id) . "," . intval($size_id) . "," . $price . ")";
            }
            $query .= implode(",", $values);
            $query .= " ON DUPLICATE KEY UPDATE price=values(price) ";
            $command = Yii::$app->db->createCommand($query);
            $command->execute();
            $this->redirect(['goods/index']);
        }else{
            throw new NotFoundHttpException(Yii::t('yii','创建商品失败'));
        }
    }

    //更新商品
    public function actionUpdate() {
        $post = Yii::$app->request->post();
        //判断ID为不为空
        if (empty($post['id'])) {
            throw new NotFoundHttpException(Yii::t('yii','商品ID不能为空'));
        }
        //判断商品名称
        if (empty($post['goods_name'])) {
            throw new NotFoundHttpException(Yii::t('yii','商品名称不能为空'));
        }
        //判断分类ID
        if (!intval($post['sort_id'])) {
            throw new NotFoundHttpException(Yii::t('yii','商品分类ID不能为空'));
        }
        //根据型号设置的价格
        if (empty($post['goods_price']) || !is_array($post['goods_price']) || count($post['goods_price']) != 3) {
            throw new NotFoundHttpException(Yii::t('yii','商品价格有误，请设置好每种杯型的价格'));
        }
        $model = $this->findModel(intval($post['id']));
        //商品图片
        if (!empty($_FILES['goods_pic']) && $_FILES['goods_pic']['error'] === 0) {
            $ret = Yii::$app->uploader->upload($_FILES['goods_pic']);
            if ($ret === false) {
                throw new NotFoundHttpException(Yii::t('yii',Yii::$app->uploader->errorMsg));
            }
            //上传成功之后获取上传的信息
            $img_info = Yii::$app->uploader->uploadFileInfo;
            if (!empty($img_info)) {
                $material_model = new Material;
                $material_model->name = $img_info['name'];//原始文件名
                $material_model->filepath = $this->store_id . '/' . $img_info['secondfilePath'];
                $material_model->filename = $img_info['savename'];
                $material_model->type = 'image';
                $pic_size = getimagesize($img_info['savepath'] . $img_info['savename']);
                $material_model->imgwidth = $pic_size[0];
                $material_model->imgheight = $pic_size[1];
                $material_model->filesize = $img_info['size'];
                $material_model->create_time = time();
                if ($material_model->save()) {
                    $model->goods_picid = intval($material_model->id);
                }
            }
        }
        $model->goods_name = $post['goods_name'];
        $model->sort_id = intval($post['sort_id']);
        $model->store_id = intval($this->store_id);
        $model->brief = $post['brief'];
        $model->update_time = time();
        if ($model->save()) {
            //建立杯型与价格的对应关系
            $query = "INSERT INTO {{%goods_price}} (goods_id,goods_size_id,price) VALUES ";
            $values = [];
            foreach ($post['goods_price'] AS $size_id => $price) {
                $price = !empty($price) ? $price : 0;
                $values[] = "(" . intval($model->id) . "," . intval($size_id) . "," . $price . ")";
            }
            $query .= implode(",", $values);
            $query .= " ON DUPLICATE KEY UPDATE price=values(price) ";
            $command = Yii::$app->db->createCommand($query);
            $command->execute();
            $this->redirect(['goods/index']);
        }else{
            throw new NotFoundHttpException(Yii::t('yii','更新分类失败'));
        }
    }

    //审核(上架下架)
    public function actionAudit() {
        $id = intval(Yii::$app->request->post('id',0));
        if (empty($id)) {
            Error::output(Error::ERR_NOID);
        }
        $model = $this->findModel($id);
        //查询出原来的状态
		switch (intval($model->status)) {
			case 1:$status = 2;break;
			case 2:$status = 3;break;
			case 3:$status = 2;break;
			default:$status = 1;
		}
		$model->status = $status;
		if($model->save()) {
			Error::output(Error::SUCCESS,['status' => $status,'status_text' => Yii::$app->params['goods_status'][$status]]);
		}else{
			Error::output(Error::ERR_FAIL);
		}
    }

    //加载模型
    protected function findModel($id) {
        if (($model = Goods::findOne(['id' => intval($id),'store_id' => $this->store_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
