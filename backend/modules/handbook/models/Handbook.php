<?php

namespace backend\modules\handbook\models;

use Yii;

/**
 * This is the model class for table "handbook".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $image
 * @property integer $create_time
 * @property integer $create_by
 * @property integer $update_time
 * @property integer $update_by
 */
class Handbook extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'handbook';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_time', 'create_by', 'update_time', 'update_by'], 'integer'],
            [['title', 'image'], 'string', 'max' => 500],
            [['content'], 'string'],
            [['title'], 'required','message' => '{attribute} không được trống'],
            [['image'], 'file', 'extensions' => 'jpg, png, svg, jpeg, gif','skipOnEmpty' => true, 'maxSize' => 1243000,'tooBig' => 'Dung lượng ảnh không vượt quá 1Mb'],
            [['image'], 'string', 'max' => 1020, 'skipOnEmpty' => true],
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
            'content' => 'Nội dung',
            'image' => 'Hình ảnh',
            'create_time' => 'Ngày tạo',
            'create_by' => 'Người tạo',
            'update_time' => 'Ngày cập nhật',
            'update_by' => 'Người cập nhật',
        ];
    }
}
