<?php

namespace backend\modules\systems\models;

use Yii;
use backend\modules\users\models\UserSearch;
/**
 * This is the model class for table "sys_config".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $value
 * @property string $decription
 * @property integer $creation_time
 * @property integer $creation_user
 * @property integer $update_time
 * @property integer $update_user
 */
class Sysconfig extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $search_text, $file;
    public static function tableName()
    {
        return 'sys_config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code'], 'required','message' => 'Mã cấu hình không được trống'],
            [['name'], 'required','message' => 'Tên cấu hình không được trống'],
            [['value'], 'required','message' => 'Giá trị cấu hình không được trống'],
            [['code'], 'string', 'max' => 255,'tooLong'=> 'Mã cấu hình không quá 255 ký tự'],
            [['name'], 'string', 'max' => 255 , 'tooLong'=> 'Tên cấu hình không quá 255 ký tự'],
            [['value'], 'string', 'max' => 2000 , 'tooLong'=> 'Tên cấu hình không quá 2000 ký tự'],
            [['decription'], 'string', 'max' => 2000 , 'tooLong'=> 'Tên cấu hình không quá 2000 ký tự'],
            [['creation_time', 'creation_user', 'update_time', 'update_user'], 'integer'],
            [['file'],'file','extensions'=>'csv, xls, xlsx','wrongExtension'=>' File tải lên không đúng định dạng : {extensions}'],
            [['file'],'file','maxSize'=>1024 * 1024 * 5, 'tooBig' => 'Size tối đa của file là 5M'],
            [['code', 'name', 'value', 'decription'], 'trim'],
            ['code', 'unique', 'message' => 'Mã cấu hình đã tồn tại.'],
            [['code'], 'match', 'pattern' => '/^[a-zA-Z0-9|\.|\_|\-]+$/', 'message' => 'Dữ liệu nhập vào không hợp lệ !'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Mã cấu hình',
            'name' => 'Tên cấu hình',
            'value' => 'Giá trị cấu hình',
            'decription' => 'Mô tả',
            'creation_time' => 'Thời gian tạo',
            'creation_user' => 'Người tạo',
            'update_time' => 'Thời gian cập nhật',
            'update_user' => 'Người cập nhật',
        ];
    }

    public function getUsercreate()
    {
        return $this->hasOne(UserSearch::className(), ['id' => 'creation_user']);
    }

    public function getUserupdate()
    {
        return $this->hasOne(UserSearch::className(), ['id' => 'update_user']);
    }
}
