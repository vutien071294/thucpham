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
use frontend\models\Info;
use frontend\components\ComponentBase;

/**
 * Site controller
 */
class InfoController extends Controller
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
        $data =  Info::find()->one();
        //end 
        return $this->render('index', [
                'data' => $data,
            ]);
    }

}
