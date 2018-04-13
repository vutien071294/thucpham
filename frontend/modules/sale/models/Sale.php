<?php

namespace frontend\modules\sale\models;

use Yii;

/**
 * This is the model class for table "sale_off".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $start_day
 * @property integer $end_day
 * @property integer $create_time
 * @property integer $create_by
 * @property integer $update_time
 * @property integer $update_by
 * @property integer $status
 * @property string $image
 * @property integer $sort
 * @property integer $value
 */
class Sale extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sale_off';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_day', 'end_day', 'create_time', 'create_by', 'update_time', 'update_by', 'status', 'sort', 'value'], 'integer'],
            [['code', 'name'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'start_day' => 'Start Day',
            'end_day' => 'End Day',
            'create_time' => 'Create Time',
            'create_by' => 'Create By',
            'update_time' => 'Update Time',
            'update_by' => 'Update By',
            'status' => 'Status',
            'image' => 'Image',
            'sort' => 'Sort',
            'value' => 'Value',
        ];
    }
}
