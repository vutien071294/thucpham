<?php

namespace backend\modules\users\models;
use yii\data\SqlDataProvider;
use Yii;
use backend\modules\users\models\Discount;
/**
 * This is the model class for table "account".
 *
 * @property integer $id
 * @property integer $account_type
 * @property string $account_name
 * @property string $account_code
 * @property string $contract
 * @property integer $time
 * @property integer $prepaid
 * @property integer $postpaid
 * @property integer $creation_time
 * @property integer $creation_user
 * @property integer $update_time
 * @property integer $update_user
 */
class Agency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_type', 'account_name', 'account_code'],'required','message'=>'{attribute} không được trống'],
            [['account_code','account_name'], 'unique', 'message' => '{attribute} đã tồn tại'],
            [['account_name'], 'string','max' => 255, 'tooLong'=> '{attribute} không quá 255 ký tự'],
            ['contract','number', 'message'=>'{attribute} phải là một số'],
            [['account_code'], 'match', 'pattern' => '/^[a-zA-Z0-9|]+$/', 'message' => 'Dữ liệu nhập vào không hợp lệ !'],
            ['prepaid','validateNumber_pre'],
            ['postpaid','validateNumber_pos'],
            [['account_code'], 'string','max' => 50, 'tooLong'=> '{attribute} không quá 50 ký tự'],
            [['time', 'creation_time','update_time','creation_user','update_user'], 'safe'],
            [['account_code','account_name','contract','prepaid','postpaid'], 'trim'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account_type' => 'Loại hình hợp tác',
            'account_name' => 'Tên đại lý/ CTV',
            'account_code' => 'Mã đại lý/ CTV',
            'contract' => 'Số hợp đồng',
            'time' => 'Ngày ký',
            'prepaid' => 'Trả trước',
            'postpaid' => 'Trả sau',
            'creation_time' => 'Thời gian tạo',
            'creation_user' => 'Người tạo',
            'update_time' => 'Thời gian cập nhật',
            'update_user' => 'Người cập nhật',
        ];
    }
    public function validateNumber_pre()
    {
        $check_int = "/^[0-9|\,]+$/";
        if ($this->prepaid) 
            {
                if (!preg_match($check_int, $this->prepaid)) 
                    {
                        $this->addError('prepaid','Tài khoản trả trước phải là một số !');
                    }
            }
    }
    public function validateNumber_pos()
    {
        $check_int = "/^[0-9|\,]+$/";
        if ($this->postpaid) 
            {
                if (!preg_match($check_int, $this->postpaid)) 
                    {
                        $this->addError('postpaid','Tài khoản trả sau phải là một số !');
                    }
            }
    }

    public function get_agency_info_by_id($account_id){
        $sql = "select af.*
            from account_info af
            where af.account_id = ".$account_id;
        $row = Yii::$app->db->createCommand($sql)->queryAll();  
        return $row;
    }


    public function delete_assign_user($username, $account_id)
    {
        $sql_delete ="DELETE FROM account_assign 
        WHERE account_id = ". $account_id.' AND user_id = (SELECT id FROM "user" WHERE username = '."'".$username."')";
        Yii::$app->db->createCommand($sql_delete)->execute();
        return true;
    }

    public function get_list_user_sale_supplier(){
        $sql = 'SELECT * 
            FROM "user" u
            WHERE u."type" = 1';
        $row = Yii::$app->db->createCommand($sql)->queryAll();
        return $row;
    }

    public function get_list_user_agency($account_id){
        $sql = 'SELECT * 
            FROM "user" u
            WHERE u.id NOT IN (SELECT acc.user_id FROM account_assign acc WHERE role = '."'".'1_CONTROLLER_SUPPLIER'."'".') AND u."type" = 3';
        $row = Yii::$app->db->createCommand($sql)->queryAll();
        return $row;
    }

    public function get_list_user_ctv($account_id){
        $sql = 'SELECT * 
            FROM "user" u
            WHERE u.id NOT IN (SELECT acc.user_id FROM account_assign acc WHERE role = '."'".'2_COLLABORATOR_SUPPLIER'."'".') AND u."type" = 4';
        $row = Yii::$app->db->createCommand($sql)->queryAll();
        return $row;
    }
    
    public function save_assign_user_agency($names,$account_id)
    {
        foreach ($names as $key => $value) {
            $sql = "INSERT INTO account_assign (account_id, user_id, role) VALUES (".$account_id.",".$value.", '1_CONTROLLER_SUPPLIER')";
            Yii::$app->db->createCommand($sql)->execute();
        }
        return true;
    }
    public function save_assign_user_ctv($names,$account_id)
    {
        $sql = "INSERT INTO account_assign (account_id, user_id, role) VALUES (".$account_id.",".$names.", '2_COLLABORATOR_SUPPLIER')";
        Yii::$app->db->createCommand($sql)->execute();
        return true;
    }

    public function save_assign_user_sale_supplier($id_user_ncc,$account_id)
    {
        $sql = "INSERT INTO account_assign (account_id, user_id, role) VALUES (".$account_id.",".$id_user_ncc.", '1_SALE_SUPPLIER')";
        Yii::$app->db->createCommand($sql)->execute();
        return true;
    }


    public function get_list_user_by_account_id($account_id)
    {
        $sql = 'SELECT u.username, u.userdisplay, au.description
                FROM "user" u
                JOIN account_assign acc ON u.id = acc.user_id
                JOIN auth_assignment auth ON u."id" = auth.user_id
                JOIN auth_item au ON au."name" = auth.item_name
                WHERE acc.account_id = '.$account_id;
        $row = Yii::$app->db->createCommand($sql)->queryAll();  
        return $row;
    }

    public function get_list_user_by_account_id_new($account_id, $list)
    {
        $string = '(';
        foreach ($list as $key => $value) {
            $string .=  $value.',';
        }
        $str = rtrim($string,',');
        $str = $str.')';
        $sql = 'SELECT u.username, u.userdisplay, u.type, auth.item_name
                FROM "user" u
                JOIN account_assign acc ON u.id = acc.user_id
                JOIN auth_assignment auth ON u."id" = auth.user_id
                WHERE acc.account_id = '.$account_id.' AND acc.user_id IN '.$str;
        $row = Yii::$app->db->createCommand($sql)->queryAll();  
        return $row;
    }

    public function get_list_data_user_new($id)
        {

            $provider = new SqlDataProvider([
                'sql' => 'SELECT u.id, u.username, u.userdisplay, ai.description
                            FROM "account_assign" acs
                            LEFT JOIN auth_assignment au ON acs.user_id = au.user_id
                            LEFT JOIN auth_item ai ON au.item_name = ai.name
                            LEFT JOIN "user" u ON acs.user_id = u."id"
                            WHERE acs.user_id NOT IN (SELECT user_id
                            FROM  account_assign
                            WHERE account_id = '.$id.')
                            GROUP BY u.id, u.username, u.userdisplay, ai.description',
                'pagination' => [
                    'pageSize' => 5,
                ],
            ]);

            return $provider;
        }

    public function get_data_user_by_userid($user_id)
        {
            $sql = 'SELECT u.username, u.userdisplay, au.description
                    FROM "user" u
                    LEFT JOIN auth_assignment ass ON ass.user_id = u."id"
                    LEFT JOIN auth_item au ON au."name" = ass.item_name
                    WHERE u."id" =' .$user_id;
            $row = Yii::$app->db->createCommand($sql)->queryAll();  
            return $row;
        }

    public function get_count_num_data_user($account_id)
        {
            $sql = 'SELECT  "count"(*) FROM account_assign WHERE account_id =' .$account_id;
            $row = Yii::$app->db->createCommand($sql)->queryAll();  
            return $row;
        }

    public function get_data_discount_account($id)
        {
            $data_discount = Discount::find()->where(['account_id' => $id])->one();
            return $data_discount;
        }

    public function get_agency_discount_by_id($account_id){
        $sql = "select af.*
            from account_discount af
            where af.account_id = ".$account_id;
        $row = Yii::$app->db->createCommand($sql)->queryAll();  
        return $row;
    }

    public function get_data()
        {
            $data = Discount::find()->where(['account_id' => $_GET['id']])->one();
            $data_discount = $data ? $data : new Discount();
            return $data_discount;
        }
}