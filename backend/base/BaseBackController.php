<?php
/**
 * 后台基类
 * 
 */
namespace backend\base;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class BaseBackController extends Controller
{
	public function behaviors() {
		return [
		    'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'logout' => ['post','get'],
				],
			],
		];
	}
}