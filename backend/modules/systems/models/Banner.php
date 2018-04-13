<?php

namespace backend\modules\systems\models;

use Yii;
use backend\modules\users\models\UserSearch;

/**
 * This is the model class for table "banner".
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property string $image
 * @property integer $create_time
 * @property integer $create_by
 * @property integer $update_time
 * @property integer $update_by
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_time', 'create_by', 'update_time', 'update_by', 'sort', 'type'], 'integer'],
            [['title', 'url'], 'string', 'max' => 255],
            [['code'], 'required','message' => 'Mã banner không được trống'],
            ['code', 'unique', 'message' => 'Mã banner đã tồn tại.'],
            [['image'], 'string', 'max' => 1020, 'skipOnEmpty' => true],
            [['image'], 'file', 'extensions' => 'jpg, png, svg, jpeg, gif','skipOnEmpty' => true, 'maxSize' => 1243000,'tooBig' => 'Dung lượng ảnh không vượt quá 1Mb']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Tên banner',
            'code' => 'Mã banner',
            'url' => 'Url banner',
            'image' => 'Ảnh',
            'create_time' => 'Người tạo',
            'create_by' => 'Thời gian tạo',
            'update_time' => 'Update Time',
            'update_by' => 'Update By',
            'type' => 'Loại banner',
        ];
    }
    public function getUser()
    {
        return $this->hasOne(UserSearch::className(), ['id' => 'create_by']);
    }
}
