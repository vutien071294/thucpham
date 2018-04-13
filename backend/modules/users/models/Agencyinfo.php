<?php

namespace backend\modules\users\models;

use Yii;

/**
 * This is the model class for table "account_info".
 *
 * @property integer $id
 * @property integer $fullname
 * @property string $msdn
 * @property string $director
 * @property integer $datefounded
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $bank_acc
 * @property string $bank_name
 * @property string $bank_address
 * @property string $description
 * @property integer $account_id
 */
class Agencyinfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fullname', 'account_id'], 'required'],
            [['fullname', 'datefounded', 'account_id'], 'integer'],
            [['msdn', 'bank_acc'], 'string', 'max' => 50],
            [['director', 'email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 20],
            [['address', 'bank_name', 'bank_address'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 1000],
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
            'msdn' => 'Msdn',
            'director' => 'Director',
            'datefounded' => 'Datefounded',
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Address',
            'bank_acc' => 'Bank Acc',
            'bank_name' => 'Bank Name',
            'bank_address' => 'Bank Address',
            'description' => 'Description',
            'account_id' => 'Account ID',
        ];
    }
}
