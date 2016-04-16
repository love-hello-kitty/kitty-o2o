<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%kt_store}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $linkman
 * @property string $phone
 * @property string $address
 * @property string $open_stime
 * @property string $open_etime
 * @property integer $province_id
 * @property integer $city_id
 * @property integer $district_id
 * @property string $longitude
 * @property string $latitude
 * @property string $brief
 * @property integer $logo_id
 * @property integer $status
 * @property integer $poi_id
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $order_id
 */
class Store extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%store}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'linkman', 'phone', 'address'], 'required'],
            [['open_stime', 'open_etime'], 'safe'],
            [['province_id', 'city_id', 'district_id', 'logo_id', 'status', 'poi_id', 'create_time', 'update_time', 'order_id'], 'integer'],
            [['longitude', 'latitude'], 'number'],
            [['name'], 'string', 'max' => 50],
            [['linkman', 'phone'], 'string', 'max' => 20],
            [['address'], 'string', 'max' => 200],
            [['brief'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '商家ID',
            'name' => '店铺名称',
            'linkman' => '联系人',
            'phone' => '手机号',
            'address' => '店铺详细地址',
            'open_stime' => '营业开始时间',
            'open_etime' => '营业结束时间',
            'province_id' => '所属省份ID',
            'city_id' => '所属城市ID',
            'district_id' => '所属区县的ID',
            'longitude' => '经度',
            'latitude' => '纬度',
            'brief' => '店铺简介',
            'logo_id' => '门店Logo图片ID',
            'status' => '商家状态1:待审核2:已审核3:被打回',
            'poi_id' => '在lbs云上的id',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
            'order_id' => '排序ID',
        ];
    }

    //获取省份 
    public function getProvince() {
        return $this->hasOne(Province::className(), ['id' => 'province_id']);
    }
 
    //获取所属城市 
    public function getCity() {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    } 
 
    //获取区县 
    public function getDistrict() {
        return $this->hasOne(District::className(), ['id' => 'district_id']);
    }

    //获取商家LOGO图片
    public function getStoreLogo() {
        return $this->hasOne(Material::className(), ['id' => 'logo_id']);
    }

    //获取商家账号
    public function getStoreAccount() {
        return $this->hasOne(StoreAccount::className(), ['store_id' => 'id']);
    }
}
