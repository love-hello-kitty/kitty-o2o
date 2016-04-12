<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%kt_city}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $zipcode
 * @property integer $province_id
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%city}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['province_id'], 'integer'],
            [['name', 'zipcode'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'zipcode' => 'Zipcode',
            'province_id' => '所属省份ID',
        ];
    }
}
