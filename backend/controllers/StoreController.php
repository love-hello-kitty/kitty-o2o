<?php
namespace backend\controllers;

use Yii;
use common\models\Store;
use common\helpers\Out;
use common\helpers\Common;
use backend\base\BaseBackController;
use backend\helpers\Error;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use common\components\LbsCloud;
use common\components\Uploader;
use common\models\Province;
use common\models\City;
use common\models\District;
use common\models\Material;
use common\models\StoreAccount;

//商家管理控制器
class StoreController extends BaseBackController
{
	//动作之前设置一些参数
	public function beforeAction($action) {
		if (parent::beforeAction($action)) {
			Yii::$app->uploader->savePath = '@upload/' . 'system';
			return true;
		}else{
			return false;
		}
	}
	
    //操作类型控制
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'create' => ['post'],
                    'update' => ['post'],
                ],
            ],
        ];
    }

    //显示列表
    public function actionIndex() {
        $query = Store::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize' => 20]);
        $models = $query->offset($pages->offset)
                        ->limit($pages->limit)
                        ->orderBy(['order_id' => SORT_DESC]) //倒序排列
                        ->all();
        $data = [];
        foreach ($models AS $k => $v) {
            $data[$k] = $v->attributes;
            $data[$k]['province_name'] = $v->province->name;
            $data[$k]['city_name'] = $v->city->name;
            $data[$k]['district_name'] = $v->district->name;
            $data[$k]['status_text'] = Yii::$app->params['store_status'][$v->status];
            $data[$k]['has_account'] = !empty($v->storeAccount->id) ? 1 : 0;
        }

        return $this->render('index', [
              'models' => $data,
              'pages' => $pages,
        ]);
    }

    //表单页
    public function actionForm() {
    	$id = Yii::$app->request->get('id');
    	$data = [];
    	if (!empty($id)) {
    		$model = null;
    		if (empty($id)) {
    			throw new NotFoundHttpException(Yii::t('yii','商家不存在'));
    		}
    		$model = $this->findModel($id);
    		$data = $model->attributes;
    		$data['province_name'] = $model->province->name;
    		$data['city_name'] = $model->city->name;
    		$data['district_name'] = $model->district->name;
    		$data['logo_pic_url'] = '';
    		if (!empty($data['logo_id'])) {
    			$img_info = $model->storeLogo->attributes;
    			if (!empty($img_info)) {
    				$data['logo_pic_url'] = Yii::$app->params['upload_url'] . $img_info['filepath'] . $img_info['filename'];
    			}
    		}
    	}
    	//获取所有省
    	$provinces = Province::find()->all();
    	$citys = City::find()->where(['province_id'=>$model->province->id])->all();
    	$districts = District::find()->where(['city_id'=>$model->city->id])->all();
    	$area = ['provinces'=>$provinces,'citys'=>$citys,'districts'=>$districts];
    	return $this->render('form', [
    		'model' 	=> $data,
    		'area'		=> $area
    	]);
    }
    
    /**
     * 创建一个商家
     */
    public function actionCreate() {
    	$post = Yii::$app->request->post();
    	//判断商家名称
    	if (empty($post['store_name'])) {
    		throw new NotFoundHttpException(Yii::t('yii','商家名称不能为空'));
    	}
    	//所属省份
    	if (!intval($post['province_id'])) {
    		throw new NotFoundHttpException(Yii::t('yii','省份不能为空'));
    	}
    	//所属城市
    	if (!intval($post['city_id'])) {
    		throw new NotFoundHttpException(Yii::t('yii','城市不能为空'));
    	}
    	//所属区域
    	if (!intval($post['district_id'])) {
    		throw new NotFoundHttpException(Yii::t('yii','区域不能为空'));
    	}
    	//地址
    	if (empty($post['address'])) {
    		throw new NotFoundHttpException(Yii::t('yii','地址不能为空'));
    	}
    	//经度
    	if (empty($post['longitude'])) {
    		throw new NotFoundHttpException(Yii::t('yii','经度不能为空'));
    	}
    	//维度
    	if (empty($post['latitude'])) {
    		throw new NotFoundHttpException(Yii::t('yii','纬度不能为空'));
    	}
    	$model = new Store();
    	$model->store_name = $post['store_name'];
    	$model->province_id = intval($post['province_id']);
    	$model->city_id = $post['city_id'];
    	$model->district_id = $post['district_id'];
    	$model->address = trim($post['address']);
    	$model->longitude = trim($post['longitude']);
    	$model->latitude = trim($post['latitude']);
    	$model->linkman = trim($post['linkman']);
    	$model->phone = trim($post['phone']);
    	$model->create_time = time();
    	$model->update_time = time();
    	$model->status = 1;
    	//商家LOGO图片
    	if (!empty($_FILES['logo_pic']) && $_FILES['logo_pic']['error'] === 0) {
    		$ret = Yii::$app->uploader->upload($_FILES['logo_pic']);
    		if ($ret === false) {
    			throw new NotFoundHttpException(Yii::t('yii',Yii::$app->uploader->errorMsg));
    		}
    		//上传成功之后获取上传的信息
    		$img_info = Yii::$app->uploader->uploadFileInfo;
    		if (!empty($img_info)) {
    			$material_model = new Material;
    			$material_model->name = $img_info['name'];//原始文件名
    			$material_model->filepath = 'system' . '/' . $img_info['secondfilePath'];
    			$material_model->filename = $img_info['savename'];
    			$material_model->type = 'image';
    			$pic_size = getimagesize($img_info['savepath'] . $img_info['savename']);
    			$material_model->imgwidth = $pic_size[0];
    			$material_model->imgheight = $pic_size[1];
    			$material_model->filesize = $img_info['size'];
    			$material_model->create_time = time();
    			if ($material_model->save()) {
    				$model->logo_id = intval($material_model->id);
    			}
    		}
    	}
    	if($model->save()) { 
    		$model->order_id = $model->id;
//      		//将数据上传值lbs云
//      		$ret = Yii::$app->lbscloud->savePoi([
//  					'store_name' 	=> $post['store_name'],
//      				'brief' 		=> $post['brief'],
//      				'address' 		=> $post['address'],
//      				'longitude' 	=> $post['longitude'],
//      				'latitude' 		=> $post['latitude'],
//      				'status'		=> 1
//      			]
//  			);
//      		if(!empty($ret) && $ret['status'] == 0) {
//      			$model->poi_id = $ret['id'];
//      		}
     		$model->save();
    		$this->redirect(['store/index']);
    	} else {
    		throw new NotFoundHttpException(Yii::t('yii','创建失败'));
    	}
    }
    
    /**
     * 更新一个商家
     */
    public function actionUpdate() {
    	$post = Yii::$app->request->post();
        //判断ID为不为空
        if (empty($post['id'])) {
            throw new NotFoundHttpException(Yii::t('yii','商家ID不能为空'));
        }
        //所属省份
        if (!intval($post['province_id'])) {
        	throw new NotFoundHttpException(Yii::t('yii','省份不能为空'));
        }
        //所属城市
        if (!intval($post['city_id'])) {
        	throw new NotFoundHttpException(Yii::t('yii','城市不能为空'));
        }
        //所属区域
        if (!intval($post['district_id'])) {
        	throw new NotFoundHttpException(Yii::t('yii','区域不能为空'));
        }
        //地址
        if (empty($post['address'])) {
        	throw new NotFoundHttpException(Yii::t('yii','地址不能为空'));
        }
        //经度
        if (empty($post['longitude'])) {
        	throw new NotFoundHttpException(Yii::t('yii','经度不能为空'));
        }
        //维度
        if (empty($post['latitude'])) {
        	throw new NotFoundHttpException(Yii::t('yii','纬度不能为空'));
        }
        $model = $this->findModel(intval($post['id']));
        $model->store_name = $post['store_name'];
        $model->province_id = intval($post['province_id']);
        $model->city_id = $post['city_id'];
        $model->district_id = $post['district_id'];
        $model->address = trim($post['address']);
        $model->longitude = trim($post['longitude']);
        $model->latitude = trim($post['latitude']);
        $model->linkman = trim($post['linkman']);
        $model->phone = trim($post['phone']);
        $model->update_time = time();
        //商品图片
        if (!empty($_FILES['logo_pic']) && $_FILES['logo_pic']['error'] === 0) {
        	$ret = Yii::$app->uploader->upload($_FILES['logo_pic']);
        	if ($ret === false) {
        		throw new NotFoundHttpException(Yii::t('yii',Yii::$app->uploader->errorMsg));
        	}
        	//上传成功之后获取上传的信息
        	$img_info = Yii::$app->uploader->uploadFileInfo;
        	if (!empty($img_info)) {
        		$material_model = new Material;
        		$material_model->name = $img_info['name'];//原始文件名
        		$material_model->filepath = 'system' . '/' . $img_info['secondfilePath'];
        		$material_model->filename = $img_info['savename'];
        		$material_model->type = 'image';
        		$pic_size = getimagesize($img_info['savepath'] . $img_info['savename']);
        		$material_model->imgwidth = $pic_size[0];
        		$material_model->imgheight = $pic_size[1];
        		$material_model->filesize = $img_info['size'];
        		$material_model->create_time = time();
        		if ($material_model->save()) {
        			$model->logo_id = intval($material_model->id);
        		}
        	}
        }
        if($model->save()) {
//     		//将数据上传值lbs云
//     		$ret = Yii::$app->lbscloud->updatePoi([
//     				'store_name' 	=> $post['store_name'],
//     				'brief' 		=> $post['brief'],
//     				'address' 		=> $post['address'],
//     				'longitude' 	=> $post['longitude'],
//     				'latitude' 		=> $post['latitude'],
//     				'poi_id' 		=> $post['poi_id'],
//     				]
//     		);
//     		if(empty($ret) || $ret['status'] != 0) {
//     		    throw new NotFoundHttpException(Yii::t('yii','LBS云同步失败'));
//     		}
        	$this->redirect(['store/index']);
        } else {
        	throw new NotFoundHttpException(Yii::t('yii','创建失败'));
        }
    }

    //删除一个商家
    public function actionDelete() {
        $id = Yii::$app->request->post('id');
        if (!intval($id))
           Error::output(Error::ERR_NOID);
        //获取poi_id
        $store = $this->findModel($id);
        $poi_id = $store->poi_id;
        if ($this->findModel($id)->delete()) {
        	//同时删除lbs上数据
           Yii::$app->lbscloud->deletePoi($poi_id);
           Error::output(Error::SUCCESS);
        }else{
           Error::output(Error::ERR_FAIL);
        }
    }

    /**
     * 审核商家
     */
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
			Error::output(Error::SUCCESS,['status' => $status,'status_text' => Yii::$app->params['store_status'][$status]]);
		}else{
			Error::output(Error::ERR_FAIL);
		}
    }

    /**
     * 根据province_id得到citys
     */
    public function actionGetcitys() {
		$province_id = Yii::$app->request->post('province_id');
		if (!intval($province_id))
			Error::output(Error::ERR_NOID);
		    $citys = City::find()
					->where(['province_id'=>$province_id])
					->asArray()
					->all();
		Error::output(Error::SUCCESS,$citys);
    }
    
    /**
     * 根据city_id得到districts
     */
    public function actionGetdistricts() {
    	$city_id = Yii::$app->request->post('city_id');
    	if (!intval($city_id))
    		Error::output(Error::ERR_NOID);
    	$districts = District::find()
				    	->where(['city_id'=>$city_id])
				    	->asArray()
				    	->all();
    	Error::output(Error::SUCCESS,$districts);
    }
    
    //为商家分配账号
    public function actionAllocate() {
        $store_id = intval(Yii::$app->request->post('store_id'));
        if (empty($store_id)) {
            Error::output(Error::ERR_NOID);
        }
        
        //首先查看该商家是否已经存在管理账号
        $model = StoreAccount::findOne(['store_id' => $store_id]);
        if (!empty($model)) {
            Error::output(Error::ERR_ACCOUNT_EXISTS);
        }
        $store_account = new StoreAccount();
        $store_account->store_id = $store_id;
        $store_account->account_name = 'coffee' . $store_id;
        $salt = Common::getGenerateSalt();
		$store_account->password = md5($salt.'123456');
		$store_account->salt = $salt;
        $store_account->status = 1;
        $store_account->create_time = time();
        $store_account->update_time = time();
        if ($store_account->save()) {
            $store_account->order_id = $store_account->id;
            $store_account->save();
            Error::output(Error::SUCCESS,['account_name' => $store_account->account_name,'password' => '123456']);
        }else{
            Error::output(Error::ERR_FAIL);
        }
    }

    //获取账号信息
    public function actionGetAccountInfo() {
        $store_id = intval(Yii::$app->request->post('store_id'));
        if (empty($store_id)) {
            Error::output(Error::ERR_NOID);
        }
        //首先查看该商家是否已经存在管理账号
        $model = StoreAccount::findOne(['store_id' => $store_id]);
        if (empty($model)) {
            Error::output(Error::ERR_ACCOUNT_NOT_EXISTS);
        }
        Error::output(Error::SUCCESS,['account_name' => $model->account_name,'create_time' => date('Y-m-d H:i',$model->create_time)]);
    }

    //加载模型
    protected function findModel($id) {
        if (($model = Store::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('yii','Page not found.'));
        }
    }
}
