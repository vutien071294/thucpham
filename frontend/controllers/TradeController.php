<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Trade;
use frontend\models\TradeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\components\ComponentBase;
/**
 * TradeController implements the CRUD actions for Trade model.
 */
class TradeController extends Controller
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
     * Lists all Trade models.
     * @return mixed
     */
   public function actionIndex($prm = '')
    {
        $components = new ComponentBase();
        $base_url = $components->Base_url();
        $data =  Trade::find()->one();
        //end 
        return $this->render('index', [
                'data' => $data,
            ]);
    }

    public function actionDetail($prm=''){
        $this->layout = 'main';
        $components = new ComponentBase();
        $base_url = $components->Base_url();
        $prm = $_GET['prm'];
        // var_dump($prm);
        if ($prm) {
            $data =  Handbook::find()->where(['id'=>$prm])->one();
        }else{
            $data =  Handbook::find()->one();
        }
        // var_dump($data);
        //end 
        return $this->render('index', [
                'data' => $data,
            ]);
    }
}
