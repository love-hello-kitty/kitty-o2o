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
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'logout' => ['post','get'],
				],
			],
		];
	}
}