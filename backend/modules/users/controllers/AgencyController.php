<?php

namespace backend\modules\users\controllers;

use Yii;
use backend\modules\users\models\User;
use backend\modules\users\models\Agency;
use backend\modules\users\models\Assignacc;
use backend\modules\users\models\Agencyinfo;
use backend\modules\users\models\AgencySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\web\ForbiddenHttpException;
use backend\models\Logfile;
use yii\db\Query;
use backend\modules\users\models\Discount;
/**
 * AgencyController implements the CRUD actions for Agency model.
 */
class AgencyController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Agency models.
     * @return mixed
     */
    public function actionIndex()
    {
        if( Yii::$app->user->can('VIEW_ACCOUNT_ALL')){
            if (isset($_POST['record'])) {
                $records = $_POST['record'];
                $num = (int)$records;
                setcookie("pagenumber", $num,time() + 300);
            }
            else {
                $records = 20;
                $num = (int)$records;
                if(isset($_COOKIE['pagenumber'])){
                    $num = $_COOKIE['pagenumber'];
                    $records = $_COOKIE['pagenumber'];
                }
            }
            $searchModel = new AgencySearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->pagination->pageSize=$num;
            //log
            $action = __FUNCTION__;
            $log = new Logfile();
            $arr = array();
            $messages = 'Truy cập màn hình quản lý';
            $resource = 'Danh sách đại lý/ctv';
            $level = 3;
            array_push($arr, $messages);
            array_push($arr, $level);
            array_push($arr, $action);
            array_push($arr, $resource);
            $log->save_log_to_db(Yii::$app->user->id,$arr);
            //end log 
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'records'=>$records,
            ]);
        }
        else
            {
                throw new ForbiddenHttpException('Bạn không có quyền truy cập chức năng này !');
            }
    }

    /**
     * Displays a single Agency model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
         //log
            $action = __FUNCTION__;
            $log = new Logfile();
            $arr = array();
            $messages = 'Thực thi chức năng xem chi tiết';
            $resource = 'Danh sách đại lý/ctv';
            $level = 3;
            array_push($arr, $messages);
            array_push($arr, $level);
            array_push($arr, $action);
            array_push($arr, $resource);
            $log->save_log_to_db(Yii::$app->user->id,$arr);
            //end log 
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Agency model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Agency();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }
        if ($model->load(Yii::$app->request->post())) {

            $model->creation_user = Yii::$app->user->id;
            $model->creation_time = time();

            $model->time = strtotime($model->time);

            $model->prepaid = (int)(str_replace(',', '', $model->prepaid));
            $model->postpaid = (int)(str_replace(',', '', $model->postpaid));
            $model->account_name = pg_escape_string($model->account_name);
            //log
            $action = __FUNCTION__;
            $log = new Logfile();
            $arr = array();
            $messages = 'Thực thi chức năng thêm mới';
            $resource = 'Danh sách đại lý/ctv';
            $level = 3;
            array_push($arr, $messages);
            array_push($arr, $level);
            array_push($arr, $action);
            array_push($arr, $resource);
            $log->save_log_to_db(Yii::$app->user->id,$arr);
            //end log 

         if (!(Agency::find()->where(['account_code' => $model->account_code])->exists())  && $model->save(false)) {
                return $this->redirect(['agency/view', 'id' => $model->id]);
            }else{
                $id = Agency::find()->select('id')->where(['account_code' => $model->account_code])->one();
                return $this->redirect(['view', 'id' => $id->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }

    }

    /**
     * Updates an existing Agency model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
         if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }
        if ($model->load(Yii::$app->request->post())) {

            $model->update_user = Yii::$app->user->id;
            $model->update_time = time();

            $model->time = strtotime($model->time);

            $model->prepaid = (int)(str_replace(',', '', $model->prepaid));
            $model->postpaid = (int)(str_replace(',', '', $model->postpaid));

            $model->save(false);
            //log
            $action = __FUNCTION__;
            $log = new Logfile();
            $arr = array();
            $messages = 'Thực thi chức năng chỉnh sửa';
            $resource = 'Danh sách đại lý/ctv';
            $level = 3;
            array_push($arr, $messages);
            array_push($arr, $level);
            array_push($arr, $action);
            array_push($arr, $resource);
            $log->save_log_to_db(Yii::$app->user->id,$arr);
            //end log 
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Agency model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {
        if (isset($_POST['value'])) 
        {
            $id = $_POST['value'];
            $this->findModel($id)->delete();
            //log
            $action = __FUNCTION__;
            $log = new Logfile();
            $arr = array();
            $messages = 'Thực thi chức năng xóa';
            $resource = 'Danh sách đại lý/CTV';
            $level = 3;
            array_push($arr, $messages);
            array_push($arr, $level);
            array_push($arr, $action);
            array_push($arr, $resource);
            $log->save_log_to_db(Yii::$app->user->id,$arr);
            //end log 

            return 'success';
        }
        else
        {
            return 'error';
        }
    }

    /**
     * Finds the Agency model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Agency the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Agency::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUpdate_info_agency()
    {
        if (isset($_POST)) {
            if (isset($_POST['account_id'])) {
                $account_id = $_POST['account_id'];

                if (isset($_POST['account_fullname'])) {
                    $account_fullname = pg_escape_string($_POST['account_fullname']);
                }
                if (isset($_POST['account_msdn'])) {
                    $account_msdn = pg_escape_string($_POST['account_msdn']);
                }
                if (isset($_POST['account_director'])) {
                    $account_director = $_POST['account_director'];
                }
                if (isset($_POST['account_datefounded'])) {
                    $account_datefounded = $_POST['account_datefounded'];
                    if ($account_datefounded) {
                        $account_datefounded = substr($account_datefounded, 6,4).substr($account_datefounded, 3,2).substr($account_datefounded, 0,2);
                    }else{
                        $account_datefounded = 0;
                    }
                }
                if (isset($_POST['account_email'])) {
                    $account_email = pg_escape_string($_POST['account_email']);
                }
                if (isset($_POST['account_phone'])) {
                    $account_phone = $_POST['account_phone'];
                } 
                if (isset($_POST['account_address'])) {
                    $account_address = pg_escape_string($_POST['account_address']);
                } 
                if (isset($_POST['account_bank_acc'])) {
                    $account_bank_acc = pg_escape_string($_POST['account_bank_acc']);
                }
                if (isset($_POST['account_bank_address'])) {
                    $account_bank_address = pg_escape_string($_POST['account_bank_address']);
                }
                if (isset($_POST['account_bank_name'])) {
                    $account_bank_name = pg_escape_string($_POST['account_bank_name']);
                }
                if (isset($_POST['account_description'])) {
                    $account_description = pg_escape_string($_POST['account_description']);
                }

                $exists = Agencyinfo::find()
                    ->where([ 'account_id' => $account_id ])
                    ->exists();
                if (!$exists) {
                    $sql = "INSERT INTO account_info (fullname, msdn, director, datefounded, email, phone, address, bank_acc, bank_name, bank_address, description, account_id) VALUES ('".$account_fullname."','".$account_msdn."', '".$account_director."',".$account_datefounded.",'".$account_email."','".$account_phone."','".$account_address."','".$account_bank_acc."','".$account_bank_name."','".$account_bank_address."','".$account_description."', ".$account_id.")";
                    Yii::$app->db->createCommand($sql)->execute();
                }else{
                    $sql = "UPDATE account_info SET (fullname, msdn, director, datefounded, email, phone, address, bank_acc, bank_name, bank_address, description) = ('".$account_fullname."','".$account_msdn."','".$account_director."',".$account_datefounded.",'".$account_email."','".$account_phone."','".$account_address."','".$account_bank_acc."','".$account_bank_name."','".$account_bank_address."','".$account_description."') WHERE account_id = ".$account_id;
                    Yii::$app->db->createCommand($sql)->execute();
                }
                $model = new Agency;
                $agency_info = $model->get_agency_info_by_id($account_id);
                return json_encode($agency_info);
            }
        }
    }

    public function actionGet_info_agency_byid(){
        if (isset($_POST)) {
            if (isset($_POST['account_id'])) {
                $account_id = $_POST['account_id'];
                $model = new Agency;
                $agency_info = $model->get_agency_info_by_id($account_id);
                return json_encode($agency_info);
            }
        }
    }

    public function actionDelete_user_assign(){
        if (isset($_POST)) {
            if (isset($_POST['username'])) {
                $model = new Agency;
                $username = $_POST['username'];
                $account_id = $_POST['account_id'];
                $model->delete_assign_user($username, $account_id);
                 $action = __FUNCTION__;
                //log
                $log = new Logfile();
                $arr = array();
                $messages = 'Thực thi chức năng xóa người dùng theo đại lý';
                $resource = 'Quản lý đại lý/ctv';
                $level = 3;
                array_push($arr, $messages);
                array_push($arr, $level);
                array_push($arr, $action);
                array_push($arr, $resource);
                $log->save_log_to_db(Yii::$app->user->id,$arr);
                //end log
                $data_user_update = Agency::get_list_user_by_account_id($account_id);
                $output = array();
                foreach ($data_user_update as $key => $value) {
                    $temp = array();
                    $temp = array_filter($temp);
                    array_push($temp, $key+1);
                    array_push($temp, $value['username']);
                    array_push($temp, $value['userdisplay']);
                    array_push($temp, $value['description']);
                    array_push($output, $temp);
                }
                $list_user_json =  json_encode($output, 128);
                return $list_user_json;
            }
        }
    }

    public function actionGet_list_user_sale_supplier()
    {
        if (isset($_POST)) {
            if (isset($_POST['account_id'])) {
                $account_id = $_POST['account_id'];
                $model = new Agency;
                $user_assign = Assignacc::find()->where(['account_id' => $account_id, 'role' => '1_SALE_SUPPLIER'])->all();
                if (!$user_assign) {
                    $list_user_sale_supplier = $model->get_list_user_sale_supplier();
                    return json_encode($list_user_sale_supplier);
                }else{
                    return '';
                }
               
            }
        }
    }

    public function actionGet_list_user_agency()
    {
        if (isset($_POST)) {
            if (isset($_POST['account_id'])) {
                $account_id = $_POST['account_id'];

                $type = Agency::find()->select('account_type')->where(['id' => $account_id])->one();
                $model = new Agency;
                if ($type['account_type'] == '1') {
                    $list_user_agency_support = $model->get_list_user_agency($account_id);
                        return json_encode($list_user_agency_support);
                }else{
                    $user_assign = Assignacc::find()->where(['account_id' => $account_id, 'role' => '2_COLLABORATOR_SUPPLIER'])->all();
                    if (!$user_assign) {
                        $list_user_agency_support = $model->get_list_user_ctv($account_id);
                        return json_encode($list_user_agency_support);
                    }else{
                        return '';
                    }
                }
            }
        }
    }

    // thêm mới user cho đại lý 
    public function actionAssign_user_for_agency()
    {
        if (isset($_POST)) {
            if (isset($_POST['account_id'])) {
                $account_id = $_POST['account_id'];
                $model = new Agency();
                $array_user_new = array();
                if (isset($_POST['names'])) {
                    $names = $_POST['names'];
                    $model->save_assign_user_agency($names,$account_id);
                    foreach ($names as $key => $value) {
                        array_push($array_user_new, $value);
                    }
                }
                if (isset($_POST['id_user_ncc'])) {
                    $id_user_ncc = $_POST['id_user_ncc'];
                    $model->save_assign_user_sale_supplier($id_user_ncc,$account_id);
                    array_push($array_user_new, $id_user_ncc);
                }

                
                if ($account_id) {
                    $list_user_by_account_id = $model->get_list_user_by_account_id($account_id);
                    $num = count($list_user_by_account_id);
                    if ($list_user_by_account_id) {
                        $arr_user = array();
                        $list_user_by_account_id_new = $model->get_list_user_by_account_id_new($account_id, $array_user_new);
                        foreach ($list_user_by_account_id_new as $key => $value) {
                            $temp = array();
                            $temp = array_filter($temp);
                            array_push($temp, $num + $key+1);
                            array_push($temp, $value['username']);
                            array_push($temp, $value['userdisplay']);
                            if ($value['type'] == '1') {
                                array_push($temp, 'Kinh doanh - NCC');
                            }elseif ($value['type'] == '2') {
                                array_push($temp, 'Người dùng - NCC');
                            }elseif ($value['type'] == '3') {
                                array_push($temp, 'Đại lý');
                            }else{
                                array_push($temp, 'Cộng tác viên');
                            }
                            array_push($temp, $value['item_name']);
                            array_push($arr_user, $temp);
                        }
                        $list_user =  json_encode($arr_user, 128);
                    }else{
                        $list_user = null;
                    }
                }
                return json_encode($list_user);

            }
        }
    }// thêm mới user cho đại lý công tác viên
    public function actionAssign_user_for_ctv()
    {
        if (isset($_POST)) {
            if (isset($_POST['account_id'])) {
                $account_id = $_POST['account_id'];
                $model = new Agency();
                $array_user_new = array();
                if (isset($_POST['names'])) {
                    $names = $_POST['names'];
                    $model->save_assign_user_ctv($names,$account_id);
                    array_push($array_user_new, $names);
                }
                if (isset($_POST['id_user_ncc'])) {
                    $id_user_ncc = $_POST['id_user_ncc'];
                    $model->save_assign_user_sale_supplier($id_user_ncc,$account_id);
                    array_push($array_user_new, $id_user_ncc);
                }

                
                if ($account_id) {
                    $list_user_by_account_id = $model->get_list_user_by_account_id($account_id);
                    $num = count($list_user_by_account_id);
                    if ($list_user_by_account_id) {
                        $arr_user = array();
                        $list_user_by_account_id_new = $model->get_list_user_by_account_id_new($account_id, $array_user_new);
                        foreach ($list_user_by_account_id_new as $key => $value) {
                            $temp = array();
                            $temp = array_filter($temp);
                            array_push($temp, $num + $key+1);
                            array_push($temp, $value['username']);
                            array_push($temp, $value['userdisplay']);
                            if ($value['type'] == '1') {
                                array_push($temp, 'Kinh doanh - NCC');
                            }elseif ($value['type'] == '2') {
                                array_push($temp, 'Người dùng - NCC');
                            }elseif ($value['type'] == '3') {
                                array_push($temp, 'Đại lý');
                            }else{
                                array_push($temp, 'Cộng tác viên');
                            }
                            array_push($temp, $value['item_name']);
                            array_push($arr_user, $temp);
                        }
                        $list_user =  json_encode($arr_user, 128);
                    }else{
                        $list_user = null;
                    }
                }
                return json_encode($list_user);

            }
        }
    }


    public function actionAdd_new_user_by_account()
        {
            $connection = new Query;
            if (isset($_POST['data']) && isset($_POST['account'])) 
                {
                    $data_id = $_POST['data'];
                    $id_account = $_POST['account'];
                    foreach ($data_id as $key => $value) 
                        {
                            $connection->createCommand()->insert('account_assign', ['account_id' => (int)$id_account,'user_id' => (int)$value,])->execute();
                        }
                     //log
                        $action = __FUNCTION__;
                        $log = new Logfile();
                        $arr = array();
                        $messages = 'Thực thi chức năng thêm mới người dùng theo đại lý';
                        $resource = 'Quản lý đại lý/ctv';
                        $level = 3;
                        array_push($arr, $messages);
                        array_push($arr, $level);
                        array_push($arr, $action);
                        array_push($arr, $resource);
                        $log->save_log_to_db(Yii::$app->user->id,$arr);
                    //end log
                    $data_user_update = Agency::get_list_user_by_account_id($id_account);
                    $output = array();
                    foreach ($data_user_update as $key => $value) {
                        $temp = array();
                        $temp = array_filter($temp);
                        array_push($temp, $key+1);
                        array_push($temp, $value['username']);
                        array_push($temp, $value['userdisplay']);
                        array_push($temp, $value['description']);
                        array_push($output, $temp);
                    }
                    $list_user_json =  json_encode($output, 128);
                    return $list_user_json;
                }
        }
    public function actionCreate_new_discount_by_account()
        {
            
            if(isset($_POST['account_id']))
                {
                    $account_id = $_POST['account_id'];
                    if(isset($_POST['service_count'])){
                        $service_count = $_POST['service_count'];
                    }
                    if (isset($_POST['discount_new'])) {
                        $discount_new =  $_POST['discount_new'];
                    }
                    if (isset($_POST['discount_renew'])) {
                        $discount_renew = $_POST['discount_renew'];
                    }
                    if (isset($_POST['discount_tranf'])) {
                        $discount_tranf = $_POST['discount_tranf'];
                    }
                    if(isset($_POST['discount_file_customer'])){
                        $discount_file_customer = $_POST['discount_file_customer'];
                    }
                    if(isset($_POST['discount_service_count'])){
                        $discount_service_count = $_POST['discount_service_count'];
                    }

                    $exists = Discount::find()
                            ->where([ 'account_id' => $account_id ])
                            ->exists();
                    if (!$exists) 
                        {
                            $sql = "INSERT INTO account_discount (service_count, discount_new, discount_renew, discount_tranf, discount_file_customer, discount_service_count, account_id) VALUES (".$service_count.",".$discount_new.", ".$discount_renew.",".$discount_tranf.",".$discount_file_customer.",".$discount_service_count.",".$account_id.")";
                             Yii::$app->db->createCommand($sql)->execute();
                        }
                    else
                        {
                            $sql = "UPDATE account_discount SET (service_count, discount_new, discount_renew, discount_tranf, discount_file_customer, discount_service_count) = (".$service_count.",".$discount_new.", ".$discount_renew.",".$discount_tranf.",".$discount_file_customer.",".$discount_service_count.") WHERE account_id = ".$account_id;
                            Yii::$app->db->createCommand($sql)->execute();
                        }
                    $data_discount = Agency::get_agency_discount_by_id($account_id);


                    return json_encode($data_discount);
                }
           
        }
}
