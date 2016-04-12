<?php

namespace storebackend\controllers;

use Yii;
use common\models\Members;
use common\models\Membership;
use yii\data\ActiveDataProvider;
use storebackend\base\BaseBackController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

//会员管理控制器
class MembersController extends BaseBackController
{
    //列表首页
    public function actionIndex() {
        $query = Membership::find()->where(['store_id' => $this->store_id]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize' => 20]);
        $models = $query->offset($pages->offset)
                        ->limit($pages->limit)
                        ->all();
        $data = [];
        foreach ($models AS $k => $v) {
            $data[$k] = $v->member->attributes;
            $data[$k]['status_text'] = Yii::$app->params['member_status'][$v->member->status];
            $data[$k]['create_time'] = date('Y-m-d H:i',$v->member->create_time);
            $data[$k]['sex_text'] = ($v->member->sex == 'M') ? '男' : '女';
            unset($data[$k]['password'],$data[$k]['salt']);
        }
        return $this->render('index', [
              'models' => $data,
              'pages' => $pages,
        ]);
    }

    //查看用户详情
    public function actionForm($id = 0) {
        if (empty($id)) {
            throw new NotFoundHttpException(Yii::t('yii','请选择要查看的用户'));
        }
        
        $model = $this->findModel(intval($id));
        $data = $model->attributes;
        $data['sex_text'] = ($model->sex == 'M') ? '男' : '女';
        return $this->render('form', [
              'model' => $data
        ]);
    }

    //加载模型
    protected function findModel($id) {
        if (($model = Members::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
