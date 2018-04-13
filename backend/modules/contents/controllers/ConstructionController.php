<?php

namespace backend\modules\contents\controllers;

use Yii;
use backend\modules\contents\models\Construction;
use backend\modules\contents\models\ConstructionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;
use yii\web\Response;
/**
 * ConstructionController implements the CRUD actions for Construction model.
 */
class ConstructionController extends Controller
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
     * Lists all Construction models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ConstructionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Construction model.
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
     * Creates a new Construction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Construction();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {
            $model->title = strip_tags($model->title);
            $model->create_by = Yii::$app->user->id;
            $model->create_time = time();
            $model->update_time = time();
            $model->update_by = Yii::$app->user->id;
            $time_curent = time();
            if($model->contruction_type == 1){
                $model->is_hot = 1;
            }else if($model->contruction_type == 2){
                $model->is_build = 1;
            }
            else if($model->contruction_type == 3){
                $model->is_complete = 1;
            }
            else if($model->contruction_type == 4){
                $model->is_noithat = 1;
            }
            //upload file
            $image= UploadedFile::getInstance($model, 'url');
            if ($image) {
                $image->saveAs( '../../public/images/image_contruction/contruction-'.$time_curent.'.'. $image->extension );
                $model->url = 'contruction-'.$time_curent.'.'.$image->extension;
            }


            if( !(Construction::find()->where(['title' => $model->title])->exists()) && $model->save(false)){
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Construction model.
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
        if($model->url){
            $image_old = $model->url;          
        }
        $model->update_time = time();
        $model->update_by = Yii::$app->user->id;
        $time_curent = time();
        if ($model->load(Yii::$app->request->post())) {
            $image= UploadedFile::getInstance($model, 'url');
            if ($image) {
                $image->saveAs( '../../public/images/image_contruction/contruction-'.$time_curent.'.'. $image->extension );
                $model->url = 'contruction-'.$time_curent.'.'.$image->extension;
            }else{
                if (isset($image_old)) {
                    $model->url = $image_old;
                }
            }

            if($model->contruction_type == 1){
                $model->is_hot = 1;
            }else if($model->contruction_type == 2){
                $model->is_build = 1;
            }
            else if($model->contruction_type == 3){
                $model->is_complete = 1;
            }

            $model->save(false);
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Construction model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {
        $message = 'error';
        if(isset($_POST['id_record'])){
            $id = $_POST['id_record'];
            $this->findModel($id)->delete();
            $message = 'success';  
        }
        return $message;
    }

    /**
     * Finds the Construction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Construction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Construction::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



}
