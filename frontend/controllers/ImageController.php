<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
// use frontend\modules\banner\models\Banner;
use frontend\models\Service;
use frontend\components\ComponentBase;
use frontend\models\Contruction;

/**
 * Site controller
 */
class ImageController extends Controller
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
        $data =  Service::find()->one();
        $dataContruction = Contruction::find()->limit(20)->all();
        //end 
        return $this->render('index', [
                'data' => $data,
                'dataContruction' => $dataContruction,
                'base_url' => $base_url,
            ]);
    }

    public function actionDetail($prm=''){
        $this->layout = 'main';
        $components = new ComponentBase();
        $base_url = $components->Base_url();
        $prm = $_GET['prm'];
        if ($prm) {
            $data =  Service::find()->where(['id'=>$prm])->one();
        }else{
            $data =  Service::find()->one();
        }
        //end 
        return $this->render('index', [
                'data' => $data,
            ]);
    }
    
}
