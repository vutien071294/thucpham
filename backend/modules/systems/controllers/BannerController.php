<?php

namespace backend\modules\systems\controllers;

use Yii;
use backend\modules\systems\models\Banner;
use backend\modules\systems\models\BannerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;
use kartik\mpdf\Pdf;
use backend\components\ComponentBase;
use backend\models\Logfile;
use yii\base\ErrorException;
use yii\web\ForbiddenHttpException;

/**
 * BannerController implements the CRUD actions for Banner model.
 */
class BannerController extends Controller
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
     * Lists all Banner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BannerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Banner model.
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
     * Creates a new Banner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Banner();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        $time_curent = time();
        $id_user = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post())) {
            $model->create_by = $id_user;
            $model->create_time = $time_curent;
            $model->update_by = $id_user;
            $model->update_time = $time_curent;
            $image = UploadedFile::getInstance($model,'image');
            if ($image) {
                $image->saveAs( '../../public/images/image_banner/banner-'.$time_curent.'.'. $image->extension );
                $model->image = 'banner-'.$time_curent.'.'.$image->extension;
            }
            //log
            $action = __FUNCTION__;
            $log = new Logfile();
            $arr = array();
            $messages = 'Tạo mới banner';
            $resource = 'Hệ thống';
            $level = 3;
            array_push($arr, $messages);
            array_push($arr, $level);
            array_push($arr, $action);
            array_push($arr, $resource);
            $log->save_log_to_db(Yii::$app->user->id,$arr);
            //end log
            if( !(Banner::find()->where(['code' => $model->code])->exists()) &&
                $model->save(false)){
                return $this->redirect(['index']);
            }else{
               return $this->redirect(['index']);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Banner model.
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
        if($model->image){
            $image_old = $model->image;          
        }
        $time_curent = time();
        $id_user = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post())) {
            $model->update_by = $id_user;
            $model->update_time = $time_curent;

            $image = UploadedFile::getInstance($model,'image');
            if ($image) {
                $image->saveAs( '../../public/images/image_banner/banner-'.$time_curent.'.'. $image->extension );
                $model->image = 'banner-'.$time_curent.'.'.$image->extension;
            }else
            {
                if (isset($image_old)) {
                    $model->image = $image_old;
                }
            }
            //log
            $action = __FUNCTION__;
            $log = new Logfile();
            $arr = array();
            $messages = 'Chỉnh sửa thông tin banner';
            $resource = 'Hệ thống';
            $level = 3;
            array_push($arr, $messages);
            array_push($arr, $level);
            array_push($arr, $action);
            array_push($arr, $resource);
            $log->save_log_to_db(Yii::$app->user->id,$arr);
            //end log 
            $model->save(false);
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Banner model.
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
            return 'success';
        }
    }

    /**
     * Finds the Banner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Banner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Banner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
