<?php

namespace backend\modules\service\models;

use Yii;

/**
 * This is the model class for table "service".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $create_time
 * @property integer $create_by
 * @property integer $update_time
 * @property integer $update_by
 */
class Service extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_time', 'create_by', 'update_time', 'update_by'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['content'], 'string'],
            [['title'], 'required','message' => '{attribute} không được trống'],
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
            'create_time' => 'Ngày tạo',
            'create_by' => 'Người tạo',
            'update_time' => 'Ngày cập nhật',
            'update_by' => 'Người cập nhật',
        ];
    }
}
