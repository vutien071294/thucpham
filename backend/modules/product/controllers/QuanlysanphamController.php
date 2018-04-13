<?php

namespace backend\modules\product\controllers;

use Yii;
use backend\modules\product\models\Quanlysanpham;
use backend\modules\product\models\QuanlysanphamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * QuanlysanphamController implements the CRUD actions for Quanlysanpham model.
 */
class QuanlysanphamController extends Controller
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
     * Lists all Quanlysanpham models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuanlysanphamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Quanlysanpham model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Quanlysanpham model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Quanlysanpham();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        $model->create_time = time();
        $model->create_by = Yii::$app->user->id;
        $model->update_time = time();
        $model->update_by = Yii::$app->user->id;
        $time_curent = time();
        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($model, 'image');
            if ($image) {
                $image->saveAs( '../../public/images/image_manage/quanlysanpham-'.$time_curent.'.'. $image->extension );
                $model->image = 'quanlysanpham-'.$time_curent.'.'.$image->extension;
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
     * Updates an existing Quanlysanpham model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
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
            $image= UploadedFile::getInstance($model, 'image');
            if ($image) {
                $image->saveAs( '../../public/images/image_manage/quanlysanpham-'.$time_curent.'.'. $image->extension );
                $model->image = 'quanlysanpham-'.$time_curent.'.'.$image->extension;
            }else{
                if (isset($image_old)) {
                    $model->image = $image_old;
                }
            }

            // if($model->contruction_type == 1){
            //     $model->is_hot = 1;
            // }else if($model->contruction_type == 2){
            //     $model->is_build = 1;
            // }
            // else if($model->contruction_type == 3){
            //     $model->is_complete = 1;
            // }

            $model->save(false);
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Quanlysanpham model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {
        if (isset($_REQUEST['value'])) 
        {
            $id = $_REQUEST['value'];
            $this->findModel($id)->delete();
            return 'success';
        }
    }

    /**
     * Finds the Quanlysanpham model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Quanlysanpham the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Quanlysanpham::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
