<?php

namespace backend\modules\product\models;

use Yii;

/**
 * This is the model class for table "products_images".
 *
 * @property integer $id
 * @property integer $product_code
 * @property string $link_image
 * @property integer $status
 * @property integer $create_time
 * @property integer $create_by
 * @property integer $update_time
 * @property integer $update_by
 */
class Products_images extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_code', 'status', 'create_time', 'create_by', 'update_time', 'update_by'], 'integer'],
            [['link_image'], 'string', 'max' => 500],
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
            'link_image' => 'Link Image',
            'status' => 'Status',
            'create_time' => 'Create Time',
            'create_by' => 'Create By',
            'update_time' => 'Update Time',
            'update_by' => 'Update By',
        ];
    }
}
