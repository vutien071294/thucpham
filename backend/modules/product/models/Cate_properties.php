<?php

namespace backend\modules\product\models;

use Yii;
use backend\modules\product\models\Product_typeSearch;
use backend\modules\product\models\Cate_properties;

/**
 * This is the model class for table "cate_properties".
 *
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property integer $type
 * @property integer $isfilter
 * @property string $value
 * @property integer $create_time
 * @property integer $create_by
 * @property integer $udpate_time
 * @property integer $update_by
 */
class Cate_properties extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cate_properties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'title'], 'trim'],
            [['name', 'cate_id', 'title', 'value'], 'required','message' => '{attribute} không được trống'],
            [['type', 'isfilter', 'create_time', 'create_by', 'update_time', 'update_by', 'cate_id'], 'integer'],
            [['name', 'title'], 'string', 'max' => 255],
            [['value'], 'string', 'max' => 2000],
            [['value'], 'validateValue'],
            // ['name', 'unique', 'message' => 'Tên thuộc tính đã tồn tại.'],
            [['name' ,'cate_id'], 'validateUnique'],
            ['title', 'unique', 'message' => 'Tiêu đề đã tồn tại.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên thuộc tính',
            'cate_id' => 'Loại sản phẩm',
            'title' => 'Tiêu đề',
            'type' => 'Type',
            'isfilter' => 'Hiển thị tìm kiếm',
            'value' => 'Giá trị',
            'create_time' => 'Thời gian tạo',
            'create_by' => 'Người tạo',
            'update_time' => 'Thời gian cập nhật',
            'update_by' => 'Người cập nhật',
        ];
    }

    public function validateValue() {
        if ($this->value) {
            if (strpos($this->value, '_') !== false) {
                  $this->addError('value','Kí tự không hợp lệ');
            }
            if (strpos($this->value, '<') !== false) {
                  $this->addError('value','Kí tự không hợp lệ');
            }
        }
    }

    public function getCategoryproduct()
    {
        return $this->hasOne(Product_typeSearch::className(), ['id' => 'cate_id']);
    }

    public function validateUnique()
    {
        $data = Cate_properties::find()->where(['cate_id'=> $this->cate_id])->all();
        if ($data) 
        {
            foreach ($data as $key => $value) 
            {
                if ((string)$value['name'] == (string)$this->name) 
                {     
                    $this->addError('name','Tên thuộc tính đã tồn tại');
                }
            }     
        }
    }  
}
