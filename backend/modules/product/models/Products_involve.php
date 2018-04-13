<?php

namespace backend\modules\product\models;

use Yii;

/**
 * This is the model class for table "products_involve".
 *
 * @property integer $id
 * @property string $product_code
 * @property string $involve_product_code
 * @property integer $create_time
 * @property integer $create_by
 * @property integer $update_time
 * @property integer $update_by
 */
class Products_involve extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products_involve';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_code', 'involve_product_code'], 'string'],
            [['create_time', 'create_by', 'update_time', 'update_by'], 'integer'],
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
            'involve_product_code' => 'Involve Product Code',
            'create_time' => 'Create Time',
            'create_by' => 'Create By',
            'update_time' => 'Update Time',
            'update_by' => 'Update By',
        ];
    }
}
