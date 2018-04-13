<?php

namespace frontend\models;

use Yii;

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
class Contruction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
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
            [['description'], 'string'],
            [['type', 'create_time', 'create_by', 'update_time', 'update_by', 'cate_id', 'is_complete', 'is_hot', 'is_build'], 'integer'],
            [['title', 'address'], 'string', 'max' => 255],
            [['url'], 'string', 'max' => 2000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'address' => 'Address',
            'url' => 'Url',
            'description' => 'Description',
            'type' => 'Type',
            'create_time' => 'Create Time',
            'create_by' => 'Create By',
            'update_time' => 'Update Time',
            'update_by' => 'Update By',
            'cate_id' => 'Cate ID',
            'is_complete' => 'Is Complete',
            'is_hot' => 'Is Hot',
            'is_build' => 'Is Build',
        ];
    }
}
