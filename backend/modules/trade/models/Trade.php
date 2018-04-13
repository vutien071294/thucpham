<?php

namespace backend\modules\trade\models;

use Yii;

/**
 * This is the model class for table "trade".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $create_time
 * @property integer $create_by
 * @property integer $update_time
 * @property integer $update_by
 */
class Trade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'create_time', 'create_by', 'update_time', 'update_by'], 'integer'],
            [['content'], 'string'],
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
            'content' => 'Nội dung',
            'create_time' => 'Ngày tạo',
            'create_by' => 'Người tạo',
            'update_time' => 'Ngày cập nhật',
            'update_by' => 'Người cập nhật',
        ];
    }
}
