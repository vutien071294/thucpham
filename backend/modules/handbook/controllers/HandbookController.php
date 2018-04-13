<?php

namespace backend\modules\handbook\controllers;

use Yii;
use backend\modules\handbook\models\Handbook;
use backend\modules\handbook\models\HandbookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\components\ComponentBase;
use yii\widgets\ActiveForm;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * HandbookController implements the CRUD actions for Handbook model.
 */
class HandbookController extends Controller
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
     * Lists all Handbook models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HandbookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Handbook model.
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
     * Creates a new Handbook model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Handbook();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        $model->create_time = time();
        $model->create_by = Yii::$app->user->id;
        $model->update_time = time();
        $model->update_by = Yii::$app->user->id;
        $time_curent = time();
        $image= UploadedFile::getInstance($model, 'image');
        if ($model->load(Yii::$app->request->post())) {
            if ($image) {
                $image->saveAs( '../../public/images/image_handbook/handbook-'.$time_curent.'.'. $image->extension );
                $model->image = 'handbook-'.$time_curent.'.'.$image->extension;
            }
            $model->save(false);
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Handbook model.
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
        $model->update_time = time();
        $model->update_by = Yii::$app->user->id;
         $time_curent = time();
        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($model,'image');
            if ($image) {
                $image->saveAs( '../../public/images/image_handbook/handbook-'.$time_curent.'.'. $image->extension );
                $model->image = 'handbook-'.$time_curent.'.'.$image->extension;
            }else
            {
                if (isset($image_old)) {
                    $model->image = $image_old;
                }
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
     * Deletes an existing Handbook model.
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
     * Finds the Handbook model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Handbook the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Handbook::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
