<?php

namespace backend\modules\invest\models;

use Yii;

/**
 * This is the model class for table "invest".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $create_at
 * @property integer $update_at
 * @property integer $create_by
 * @property integer $update_by
 */
class Invest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invest';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['create_at', 'update_at', 'create_by', 'update_by'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Tiêu đề',
            'description' => 'Mô tả',
            'create_at' => 'Thời gian tạo',
            'update_at' => 'Thời gian cập nhật',
            'create_by' => 'Người tạo',
            'update_by' => 'Người cập nhật',
        ];
    }
}
