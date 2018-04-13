<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cate_product".
 *
 * @property int $id
 * @property string $title
 * @property string $descripton
 * @property int $create_time
 * @property int $update_time
 * @property int $create_by
 * @property int $update_by
 */
class CateProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cate_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_time', 'update_time', 'create_by', 'update_by'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['descripton'], 'string', 'max' => 2000],
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
            'descripton' => 'Descripton',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'create_by' => 'Create By',
            'update_by' => 'Update By',
        ];
    }
}
