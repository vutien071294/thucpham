<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Product;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\CateProduct;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    // public function actionIndex()
    // {
    //     $dataProvider = new ActiveDataProvider([
    //         'query' => Product::find(),
    //     ]);

    //     return $this->render('index', [
    //         'dataProvider' => $dataProvider,
    //     ]);
    // }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    
    public function actionIndex($prm = '')
    {
        $dataCate = CateProduct::findOne($prm);
        if($dataCate){
            $title = $dataCate['title'];
        }else{
            $title = '';
        }
        $dataProduct = Product::find()->where(['cate_id' => $prm])->asArray()->all();
        return $this->render('index', [
            'dataProduct' => $dataProduct,
            'title' => $title,
        ]);
    }
    
     public function actionDetail($prm = '')
    {
        $this->layout = 'main';
        $dataProduct = Product::findOne($prm);  
        return $this->render('detail', [
            'dataProduct' => $dataProduct,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
