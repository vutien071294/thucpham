<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "info".
 *
 * @property integer $id
 * @property string $fullname
 * @property string $email
 * @property string $hotline
 * @property string $phone
 * @property string $description
 * @property string $summary
 * @property string $address
 * @property integer $create_time
 * @property integer $create_by
 * @property integer $update_time
 * @property integer $update_by
 * @property string $logo
 */
class Info extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'recruitment'], 'string'],
            [['create_time', 'create_by', 'update_time', 'update_by'], 'integer'],
            [['fullname'], 'string', 'max' => 500],
            [['email'], 'string', 'max' => 50],
            [['hotline', 'phone'], 'string', 'max' => 20],
            [['summary'], 'string', 'max' => 4000],
            [['address', 'logo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fullname' => 'Fullname',
            'email' => 'Email',
            'hotline' => 'Hotline',
            'phone' => 'Phone',
            'description' => 'Description',
            'summary' => 'Summary',
            'address' => 'Address',
            'create_time' => 'Create Time',
            'create_by' => 'Create By',
            'update_time' => 'Update Time',
            'update_by' => 'Update By',
            'logo' => 'Logo',
            'recruitment'=>'recruitment',
        ];
    }
}
