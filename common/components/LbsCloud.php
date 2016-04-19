<?php

namespace common\components;
use Yii;
use yii\base\Component;
use common\helpers\Common;

//百度LBS相关接口
class LbsCloud extends Component
{
    const API_URL = "http://api.map.baidu.com/";
    const CREATE_POI_URI = "geodata/v3/poi/create";
    const DELETE_POI_URI = "geodata/v3/poi/delete";
    const UPDATE_POI_URI = "geodata/v3/poi/update";
    const NEARBY_POI_URI = "geosearch/v3/nearby";

	private $ak;              //密钥
	private $geotable_id;     //数据表ID
	private $coord_type = 3;  //coord_type坐标系

	public function setConfig($params = []) {
		$this->ak           = $params['ak'];
		$this->geotable_id  = $params['geotable_id'];
	}

	//保存位置数据
	public function savePoi($data = []) {
		$poi_data = [
			'ak'			=> $this->ak,
		    'store_id'		=> intval($data['store_id']),
			'title'			=> $data['name'],
			'brief'			=> $data['brief'],
			'longitude'		=> $data['longitude'],
			'latitude'		=> $data['latitude'],
			'coord_type'	=> $this->coord_type,
			'geotable_id'	=> $this->geotable_id,
			'address'		=> $data['address']
		];
		$return = $this->curl(self::API_URL . self::CREATE_POI_URI,$poi_data,'post');
		return $return;
	}

	//更新位置数据
	public function updatePoi($data = []) {
		$poi_data = [
			'ak'			=> $this->ak,
		    'store_id'		=> intval($data['store_id']),
			'title'			=> $data['name'],
			'brief'			=> $data['brief'],
			'longitude'		=> $data['longitude'],
			'latitude'		=> $data['latitude'],
			'coord_type'	=> $this->coord_type,
			'geotable_id'	=> $this->geotable_id,
			'id'			=> $data['poi_id'],
			'address'		=> $data['address']
		];
		$return = $this->curl(self::API_URL . self::UPDATE_POI_URI,$data,'post');
		return $return;
	}

	//删除位置数据
	public function deletePoi($poi_id = 0) {
		$data = [
			'ak'			=> $this->ak,
			'geotable_id'	=> $this->geotable_id,
			'id'			=> $poi_id
		];
		$return = $this->curl(self::API_URL . self::DELETE_POI_URI,$data,'post');
		return $return;
	}

	//请求接口
	public function curl($url = '' , $data = array() , $method_type = 'get') {
		$ch = curl_init ();
		if($method_type == 'get' && $data)
		{
			$url = $url . '?' . http_build_query($data);
		}
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		if ($method_type == 'post') {
			curl_setopt ( $ch, CURLOPT_POST, 1 );
			curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
		}
		$return = curl_exec ( $ch );
		curl_close ( $ch );
		return json_decode($return,1);
	}
}