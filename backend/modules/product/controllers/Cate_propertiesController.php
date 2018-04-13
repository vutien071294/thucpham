<?php

namespace backend\modules\product\controllers;

use Yii;
use backend\modules\product\models\Cate_properties;
use backend\modules\product\models\Cate_propertiesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
use backend\models\Logfile;
use yii\web\ForbiddenHttpException;

/**
 * Cate_propertiesController implements the CRUD actions for Cate_properties model.
 */
class Cate_propertiesController extends Controller
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
     * Lists all Cate_properties models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (isset($_GET['error'])) {
            $error = $_GET['error'];
        } else {
            $error = false;
        }
        if (isset($_POST['record'])) {
            $records = $_POST['record'];
            $num = (int)$records;
            setcookie("pagenumber", $num, time() + 300);
        } else {
            $records = 20;
            $num = (int)$records;
            if (isset($_COOKIE['pagenumber'])) {
                $num = $_COOKIE['pagenumber'];
                $records = $_COOKIE['pagenumber'];
            }
        }
        $searchModel = new Cate_propertiesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = $num;
        //log
        $action = __FUNCTION__;
        $log = new Logfile();
        $arr = array();
        $messages = 'Truy cập màn hình quản lý';
        $resource = 'Danh mục thuộc tính loại sản phẩm';
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

    /**
     * Displays a single Cate_properties model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cate_properties model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cate_properties();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        $time_curent = time();
        $id_user = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post())) {
            $model->create_by = $id_user;
            $model->create_time = $time_curent;
            $model->type = 1;
            // $model->value = str_replace("\n","_",$model->value);
            // print_r (explode("\n",$model->value));
            // echo nl2br($model->value);
            //log
            $action = __FUNCTION__;
            $log = new Logfile();
            $arr = array();
            $messages = 'Thêm mới thuộc tính loại sản phẩm';
            $resource = 'Danh mục thuộc tính loại sản phẩm';
            $level = 3;
            array_push($arr, $messages);
            array_push($arr, $level);
            array_push($arr, $action);
            array_push($arr, $resource);
            $log->save_log_to_db(Yii::$app->user->id,$arr);
            //end log
            if( !(Cate_properties::find()->where(['name' => $model->name])->exists()) &&
                $model->save(false)){
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
               $id = Cate_properties::find()->select('id')->where(['name' => $model->name])->one();
               return $this->redirect(['view', 'id' => $id->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Cate_properties model.
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
        $time_curent = time();
        $id_user = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post())) {
            $model->update_by = $id_user;
            $model->update_time = $time_curent;

            //log
            $action = __FUNCTION__;
            $log = new Logfile();
            $arr = array();
            $messages = 'Chỉnh sửa thuộc tính loại sản phẩm';
            $resource = 'Danh mục thuộc tính loại sản phẩm';
            $level = 3;
            array_push($arr, $messages);
            array_push($arr, $level);
            array_push($arr, $action);
            array_push($arr, $resource);
            $log->save_log_to_db(Yii::$app->user->id,$arr);
            //end log 
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Cate_properties model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {
        $id = $_POST['value'];
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Cate_properties model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cate_properties the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cate_properties::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
