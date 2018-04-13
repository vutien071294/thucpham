<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
// use frontend\modules\banner\models\Banner;
use backend\modules\invest\models\Invest;
use frontend\components\ComponentBase;

/**
 * Site controller
 */
class InvestController extends Controller
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
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex($prm = '')
    {
        $components = new ComponentBase();
        $base_url = $components->Base_url();
        $data =  Invest::find()->where(['id' => $prm])->one();
        //end 
        return $this->render('index', [
                'data' => $data,
            ]);
    }

}
