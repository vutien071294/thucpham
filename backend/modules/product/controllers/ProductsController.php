<?php

namespace backend\modules\product\controllers;

use Yii;
use backend\modules\product\models\Products;
use backend\modules\product\models\ProductsSearch;
use backend\modules\product\models\Product_type;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;
use yii\base\ErrorException;
use yii\web\ForbiddenHttpException;
use backend\models\Logfile;
use backend\components\ComponentBase;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
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
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
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
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $components = new ComponentBase();
        $base_url = $components->Base_url();

        $model = new Products();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        $time_curent = time();
        $id_user = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post())) {
            $property_list = $model->properties;
            $model->create_by = $id_user;
            $model->create_time = $time_curent;
            $model->update_by = $id_user;
            $model->update_time = $time_curent;
            $model->title = ucwords($model->title);
            $image = UploadedFile::getInstance($model,'image_preset');
            if ($image) {
                $image->saveAs('../../public/images/image_products/image_products-'.$time_curent.'.'. $image->extension );
                $model->image_preset = 'image_products-'.$time_curent.'.'.$image->extension;
            }

            $list_image = UploadedFile::getInstances($model, 'image_roducts_list_involve');
            $arr_url = array();
            foreach ($list_image as $key => $file_model) {

                $file_model->saveAs('../../public/images/image_products/'.$model->code.'-'.$time_curent.'-'. $key .'-file.'.str_replace('/','-',$file_model->extension));
                $file = $model->code.'-'.$time_curent.'-'. $key .'-file.'.str_replace('/','-',$file_model->extension);
                array_push($arr_url, $file);
            }
            $model->input_price = (int)(str_replace(',', '', $model->input_price));
            // $model->list_price = (int)(str_replace(',', '', $model->list_price));
            $model->sell_price = (int)(str_replace(',', '', $model->sell_price));
            $model->save(false);
            // if ($model->products_list_involve) {
            //     $model->save_products_involve($model->products_list_involve, $model->code);
            // }
            if ($arr_url) {
                $model->save_products_images($arr_url, $model->code);
            }
            // if ($property_list) {
            //     $model->save_products_property($property_list, $model->code);
            // }
            //log
            $action = __FUNCTION__;
            $log = new Logfile();
            $arr = array();
            $messages = 'Thêm mới sản phẩm';
            $resource = 'Sản phẩm';
            $level = 3;
            array_push($arr, $messages);
            array_push($arr, $level);
            array_push($arr, $action);
            array_push($arr, $resource);
            $log->save_log_to_db(Yii::$app->user->id,$arr);
            //end log 
            return $this->redirect(['index']);
            // return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Products model.
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
        if($model->image_preset){
            $image_old = $model->image_preset;          
        }
        if ($model->load(Yii::$app->request->post())) {
            $model->update_by = $id_user;
            $model->update_time = $time_curent;
            $model->title = ucwords($model->title);
            
            $image = UploadedFile::getInstance($model,'image_preset');
            if ($image) {
                $image->saveAs('../../public/images/image_products/image_products-'.$time_curent.'.'. $image->extension );
                $model->image_preset = 'image_products-'.$time_curent.'.'.$image->extension;
            }else
            {
                if (isset($image_old)) {
                    $model->image_preset = $image_old;
                }
            }
            $list_image = UploadedFile::getInstances($model, 'image_roducts_list_involve');
            $arr_url = array();
            foreach ($list_image as $key => $file_model) {
                $file_model->saveAs('../../public/images/image_products/'.$model->code.'-'.$time_curent.'-'. $key .'-file.'.str_replace('/','-',$file_model->extension));
                $file = $model->code.'-'.$time_curent.'-'. $key .'-file.'.str_replace('/','-',$file_model->extension);
                array_push($arr_url, $file);
            }
            $model->input_price = (int)(str_replace(',', '', $model->input_price));
            // $model->list_price = (int)(str_replace(',', '', $model->list_price));
            $model->sell_price = (int)(str_replace(',', '', $model->sell_price));

            if ($arr_url) {
                $model_image = new Products();
                $model_image->save_products_images($arr_url, $model->code);
            }
            //log

            $action = __FUNCTION__;
            $log = new Logfile();
            $arr = array();
            $messages = 'Chỉnh sửa thông tin sản phẩm';
            $resource = 'Sản phẩm';
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
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionList_products_involve(){
    $empty = array();
    if (isset($_POST['value'])) {
        $id_cate = $_POST['value'];
        $list = Products::find()->where(['categories_id' => $id_cate])->orderBy(['title'=>SORT_ASC])->all();
        if ($list) {
            foreach ($list as $model) {
                    
                   $model_list_product[$model->code] = $model->title;
                    
                 }
                 echo json_encode($model_list_product);
            }
            else{
                echo json_encode($empty) ;
            }
        }
        else{
            echo json_encode($empty);
        }
    }
    public function actionList_products_property(){
        $empty = array();
        $model = new Products();
        if (isset($_POST['value'])) {
            $id_cate = $_POST['value'];
            $cate = Product_type::find()->where(['id' => $id_cate])->one();
            
            if ($cate->level != 1) {
                $level = $cate->level;
                $id_current = $cate->parent_id;
                for ($i=1; $i < $level; $i++) { 
                    $cate_new = Product_type::find()->where(['id' => $id_current])->one();
                    $id_current = $cate->parent_id;
                }
                $id_get_property = $cate_new->id;
            }else{
                $id_get_property = $cate->id;
            }

            $list_property = $model->get_list_property($id_get_property);
            // var_dump($cate->level);die;
            echo json_encode($list_property);
        }
    }
}
