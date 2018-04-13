<?php

namespace backend\modules\systems\controllers;

use Yii;
use backend\modules\systems\models\Sysconfig;
use backend\modules\systems\models\SysconfigSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\components\ComponentBase;
use backend\models\Logfile;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;
use yii\web\ForbiddenHttpException;
/**
 * SysconfigController implements the CRUD actions for Sysconfig model.
 */
class SysconfigController extends Controller
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
     * Lists all Sysconfig models.
     * @return mixed
     */
    public function actionIndex()
    {
        if( Yii::$app->user->can('VIEW_CONFIG'))
        {
            if (isset($_GET['error'])) {
                $error = $_GET['error'];
            }else{
                $error = false;
            }
            if (isset($_POST['record'])) {
                    $records = $_POST['record'];
                    $num = (int)$records;
                    setcookie("pagenumber", $num,time() + 300);
                }
                else {
                    // $config = new Configsystem();
                    $records = 20;
                    $num = (int)$records;
                    if(isset($_COOKIE['pagenumber'])){
                        $num = $_COOKIE['pagenumber'];
                        $records = $_COOKIE['pagenumber'];
                    }
                }
            $searchModel = new SysconfigSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->pagination->pageSize=$num;
            $action = __FUNCTION__;
            $log = new Logfile();
            $arr = array();
            $messages = 'Truy cập màn hình quản lý';
            $resource = 'Cấu hình hệ thống';
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
                'records' => $records,
                'error' => $error,
            ]);
        }
        else
            {
                throw new ForbiddenHttpException('Bạn không có quyền truy cập chức năng này !');
            }
    }

    /**
     * Displays a single Sysconfig model.
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
        $resource = 'Cấu hình hệ thống';
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
     * Creates a new Sysconfig model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
            $model = new Sysconfig();
             if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }
            $model->creation_time = time();
            $model->creation_user = Yii::$app->user->id;
            if ($model->load(Yii::$app->request->post())) {
                $model->name = pg_escape_string($model->name);
                $model->value = pg_escape_string($model->value);
                $model->decription = pg_escape_string($model->decription);
                //log
                    $action = __FUNCTION__;
                    $log = new Logfile();
                    $arr = array();
                    $messages = 'Thực thi chức năng thêm mới';
                    $resource = 'Cấu hình hệ thống';
                    $level = 3;
                    array_push($arr, $messages);
                    array_push($arr, $level);
                    array_push($arr, $action);
                    array_push($arr, $resource);
                    $log->save_log_to_db(Yii::$app->user->id,$arr);
            //end log 
                if( !(Sysconfig::find()->where(['code' => $model->code])->exists()) && $model->save(false)){
                    return $this->redirect(['view', 'id' => $model->id]);
                }else{
                   $id = Sysconfig::find()->select('id')->where(['code' => $model->code])->one();
                   return $this->redirect(['view', 'id' => $id->id]);
               }
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
    }

    /**
     * Updates an existing Sysconfig model.
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
            $model->update_time = time();
            $model->update_user = Yii::$app->user->id;
            if ($model->load(Yii::$app->request->post())) {
                $model->name = pg_escape_string($model->name);
                $model->value = pg_escape_string($model->value);
                $model->decription = pg_escape_string($model->decription);
                $model->save(false);
                 //log
                    $action = __FUNCTION__;
                    $log = new Logfile();
                    $arr = array();
                    $messages = 'Thực thi chức năng chỉnh sửa';
                    $resource = 'Cấu hình hệ thống';
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
     * Deletes an existing Sysconfig model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
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
                $resource = 'Cấu hình hệ thống';
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

     public function actionImport()
    {
        $model = new Sysconfig;

        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model,'file');
            $filename = 'cauhinh.'.$file->extension;
            $upload = $file->saveAs('uploads/'.$filename);
            $objPHPExcel = \PHPExcel_IOFactory::load('uploads/cauhinh.'.$file->extension);
            $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
            $data_first = current($sheetData);
            $flag = true;
            $key_error ='';  
            if (trim($data_first['A']) != 'STT' || trim($data_first['B']) != 'Mã cấu hình(*)' || trim($data_first['C']) != 'Tên cấu hình(*)' || trim($data_first['D']) != 'Giá trị' || trim($data_first['E']) != 'Mô tả') 
                {
                    $flag = false;
                    $key_error = ' title sai cấu trúc';
                }

            if ($flag == true) {
                $cut = array_shift($sheetData);
                $model_data = Sysconfig::find()->all();        
                foreach ($sheetData as $key_import => $value_import) {
                    if ($model_data) 
                    {
                     foreach ($model_data as $key => $value) 
                         {
                            if (trim($value_import['B']) == $value['code']) 
                                {
                                    $key_error = $key_import+1 . ' trùng mã cấu hình';
                                    $flag = false;
                                    break;
                                }
                        }
                    }

                foreach ($value_import as $key_x => $value_x) 
                    {
                        $pos = strrpos($value_x, "<");
                        if ($pos !== false) 
                            { 
                                $key_error = $key_import+1 . ' có chứa ký tự đặc biệt';
                                $flag = false;
                                break;
                            }
                    }
                $posSpace =  preg_match('/\s/',trim($value_import['B']));
                if ($posSpace == 1) 
                    {
                        $key_error = $key_import+1 . ' mã cấu hình có chứa dẫu cách';
                        $flag = false;
                        break;
                    }
                if (strlen(trim($value_import['B'])) > 255 ) 
                    {
                        $key_error = $key_import+1 . ' mã cấu hình lớn hơn 255 ký tự';
                        $flag = false;
                        break;
                    }

                if (strlen(trim($value_import['C'])) > 255 ) 
                    {
                        $key_error = $key_import+1 . ' tên cấu hình lớn hơn 255 ký tự';
                        $flag = false;
                        break;
                    }
                if (strlen(trim($value_import['D'])) > 2000 ) 
                    {
                        $key_error = $key_import+1 . ' giá trị cấu hình lớn hơn 2000 ký tự';
                        $flag = false;
                        break;
                    }

                if (strlen(trim($value_import['E'])) > 2000 ) 
                    {
                        $key_error = $key_import+1 . ' mô tả lớn hơn 2000 ký tự';
                        $flag = false;
                        break;
                    }
                if ($value_import['C'] == '') 
                    {
                        $key_error = $key_import+1 . ' tên cấu hình không được trống';
                        $flag = false;
                        break;
                    }
                if ($value_import['B'] == '') 
                    {
                        $key_error = $key_import+1 . ' mã cấu hình không được trống';
                        $flag = false;
                        break;
                    }

                 if ($value_import['D'] == '') 
                    {
                        $key_error = $key_import+1 . ' giá trị cấu hình không được trống';
                        $flag = false;
                        break;
                    }

            }

        }
       
        if ($flag == true) {
            foreach ($sheetData as $key => $value_sh) {
                $id_user = Yii::$app->user->id;
                $time = time();
                $value_sh['B'] = pg_escape_string(trim($value_sh['B']));
                $value_sh['C'] = pg_escape_string(trim($value_sh['C']));
                $value_sh['D'] = pg_escape_string(trim($value_sh['D']));
                $value_sh['E'] = pg_escape_string(trim($value_sh['E']));
                $sql = "INSERT INTO sys_config (code, name,value,decription,creation_user,creation_time) VALUES ('".$value_sh['B']."','".$value_sh['C']."','".$value_sh['D']."','".$value_sh['E']."','".$id_user."','".$time."')";
                Yii::$app->db->createCommand($sql)->execute();
            }
             //log
            $action = __FUNCTION__;
            $log = new Logfile();
            $arr = array();
            $messages = 'Import dữ liệu thành công';
            $resource = 'Cấu hình hệ thống';
            $level = 3;
            array_push($arr, $messages);
            array_push($arr, $level);
            array_push($arr, $action);
            array_push($arr, $resource);
            $log->save_log_to_db(Yii::$app->user->id,$arr);
            //end log 
            return Yii::$app->response->redirect(['/systems/sysconfig']);
        }
        else{
             //log
            $action = __FUNCTION__;
            $log = new Logfile();
            $arr = array();
            $messages = 'Import dữ liệu không thành công';
            $resource = 'Cấu hình hệ thống';
            $level = 3;
            array_push($arr, $messages);
            array_push($arr, $level);
            array_push($arr, $action);
            array_push($arr, $resource);
            $log->save_log_to_db(Yii::$app->user->id,$arr);
            //end log 
         return  Yii::$app->response->redirect(['/systems/sysconfig','error' => $key_error]);
            }
        }
    }   

    /**
     * Finds the Sysconfig model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sysconfig the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sysconfig::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
