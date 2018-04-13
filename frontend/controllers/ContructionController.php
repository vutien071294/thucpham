<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Contruction;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Categories;

/**
 * ContructionController implements the CRUD actions for Contruction model.
 */
class ContructionController extends Controller
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
     * Lists all Contruction models.
     * @return mixed
     */
    public function actionIndex($prm = '')
    {
        $dataCate = Categories::findOne($prm);
        $dataContruction = Contruction::find()->where(['cate_id' => $prm])->asArray()->all();
        return $this->render('index', [
            'dataContruction' => $dataContruction,
            'dataCate' => $dataCate,
        ]);
    }

    /**
     * Displays a single Contruction model.
     * @param integer $id
     * @return mixed
     */
    public function actionDetail($prm = '')
    {
        $this->layout = 'main';
        $dataContruction = Contruction::findOne($prm);
        $cate_id = $dataContruction ? $dataContruction['cate_id'] : '';
        $data_category = Categories::findOne($cate_id);

        return $this->render('detail', [
            'dataContruction' => $dataContruction,
            'data_category' => $data_category,
        ]);
    }

    public function actionType($item = '')
    {
        $this->layout = 'main';
        if($item){
            $dataContruction = Contruction::find()->where([$item => 1])->asArray()->all();

            return $this->render('type', [
                'dataContruction' => $dataContruction,
            ]);
        }
        else{
            throw new NotFoundHttpException('Không tìm thấy trang hiện tại.');
        }
       
    }

    /**
     * Creates a new Contruction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    /**
     * Finds the Contruction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contruction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contruction::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
