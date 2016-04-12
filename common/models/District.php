<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%kt_district}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $city_id
 */
class District extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%district}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
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
            'city_id' => '所属城市ID',
        ];
    }
}
