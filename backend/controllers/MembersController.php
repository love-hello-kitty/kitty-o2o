<?php

namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use backend\base\BaseBackController;
use common\models\Members;

//用户管理控制器
class MembersController extends BaseBackController
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

    //列表首页
    public function actionIndex() {
        $query = Members::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize' => 20]);
        $models = $query->offset($pages->offset)
                        ->limit($pages->limit)
                        ->orderBy(['order_id' => SORT_DESC]) //倒序排列
                        ->all();
        $data = [];
        foreach ($models AS $k => $v) {
            $data[$k] = $v->attributes;
            $data[$k]['status_text'] = Yii::$app->params['member_status'][$v->status];
            $data[$k]['create_time'] = date('Y-m-d H:i',$v->create_time);
            $data[$k]['sex_text'] = ($v->sex == 'M') ? '男' : '女';           
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

    //删除用户
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

    //加载模型
    protected function findModel($id) {
        if (($model = Members::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
