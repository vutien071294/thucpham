<?php

namespace backend\modules\contents\models;

use Yii;
use backend\modules\product\models\Product_type;
use backend\modules\product\models\Product_typeSearch;
/**
 * This is the model class for table "contents".
 *
 * @property integer $id
 * @property string $title
 * @property string $address
 * @property string $url
 * @property string $description
 * @property integer $type
 * @property integer $create_time
 * @property integer $create_by
 * @property integer $update_time
 * @property integer $update_by
 * @property integer $cate_id
 * @property integer $is_complete
 * @property integer $is_hot
 * @property integer $is_build
 */
class Construction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $contruction_type;
    public static function tableName()
    {
        return 'contents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','contruction_type'], 'required', 'message' => '{attribute} không được trống'],
            [['type', 'create_time', 'create_by', 'update_time', 'update_by', 'cate_id', 'is_complete', 'is_hot', 'is_build','contruction_type'], 'integer'],
            [['title', 'address'], 'string', 'max' => 255],
            [['url'], 'string', 'max' => 2000],
            [['description'], 'string'],
            ['title', 'unique', 'message' => '{attribute} đã tồn tại'],
            [['title','description'], 'trim'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'TIêu đề',
            'address' => 'Địa chỉ',
            'url' => 'Ảnh',
            'description' => 'Mô tả',
            'type' => 'Type',
            'create_time' => 'Thời gian tạo',
            'create_by' => 'Người tạo',
            'update_time' => 'Thời gian cập nhật',
            'update_by' => 'Người cập nhật',
            'cate_id' => 'Công trình',
            'is_complete' => 'Hoàn thành',
            'is_hot' => 'Tiêu biểu',
            'is_build' => 'Xây dựng',
            'contruction_type' => 'Loại công trình'
        ];
    }

    public function  get_list_cate_form(){
            return   $list_product_type = Product_type::find()->where(['publish' => '1'])->andwhere(['level' => '2'])->all();
        }
    
    public function getCategori(){
        return $this->hasOne(Product_typeSearch::className(), ['id' => 'cate_id']);
    }
}

