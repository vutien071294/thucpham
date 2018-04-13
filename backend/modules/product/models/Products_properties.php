<?php

namespace backend\modules\product\models;

use Yii;

/**
 * This is the model class for table "product_properties".
 *
 * @property integer $id
 * @property string $product_code
 * @property string $name_cate_property
 * @property string $value
 * @property integer $create_time
 * @property integer $create_by
 * @property integer $update_time
 * @property integer $update_by
 */
class Products_properties extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products_properties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_time', 'create_by', 'update_time', 'update_by'], 'integer'],
            [['product_code', 'name_cate_property'], 'string', 'max' => 255],
            [['value'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_code' => 'Product Code',
            'name_cate_property' => 'Name Cate Property',
            'value' => 'Value',
            'create_time' => 'Create Time',
            'create_by' => 'Create By',
            'update_time' => 'Update Time',
            'update_by' => 'Update By',
        ];
    }
}
