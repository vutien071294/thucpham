<?php

namespace backend\modules\product\controllers;

use Yii;
use backend\modules\product\models\Product_type;
use backend\modules\product\models\Product_typeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;
use yii\base\ErrorException;
use yii\web\ForbiddenHttpException;
use backend\models\Logfile;

/**
 * Product_typeController implements the CRUD actions for Product_type model.
 */
class Product_typeController extends Controller
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
     * Lists all Product_type models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Product_type();
        $searchModel = new Product_typeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $list_cate = $model->get_list_cate();
        //log
        $action = __FUNCTION__;
        $log = new Logfile();
        $arr = array();
        $messages = 'Truy cập màn hình quản lý loại sản phẩm';
        $resource = 'Sản phẩm';
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
            'list_cate' => $list_cate,
        ]);
    }

    /**
     * Displays a single Product_type model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product_type model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product_type();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        $time_curent = time();
        $id_user = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post())) {

            $model->create_by = $id_user;
            $model->create_time = $time_curent;
            if ($model->parent_id) {
                $parent = Product_type::find()->select('level')->where(['id' => $model->parent_id])->one();
                $model->level = (int)$parent->level + 1;
            }else{
                $model->level = 1;
            }

            if( !(Product_type::find()->where(['title' => $model->title])->exists()) &&
                $model->save(false)){
                return $this->redirect(['index']);
                // return $this->redirect(['view', 'id' => $model->id]);
            }else{
               $id = Product_type::find()->select('id')->where(['title' => $model->title])->one();
               return $this->redirect(['index']);
               // return $this->redirect(['view', 'id' => $id->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Product_type model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
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
            if ($model->parent_id) {
                $parent = Product_type::find()->select('level')->where(['id' => $model->parent_id])->one();
                $model->level = (int)$parent->level + 1;
            }else{
                $model->level = 1;
            }
            $model->save(false);
            return $this->redirect(['index']);
            // return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Product_type model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete()
    {
        if (isset($_REQUEST['value'])) 
        {
            $id = $_REQUEST['value'];
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Product_type model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Product_type the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product_type::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
