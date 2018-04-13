<?php

namespace frontend\modules\content\controllers;

use Yii;
use frontend\modules\content\models\Word;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\components\ComponentBase;

/**
 * WordController implements the CRUD actions for Word model.
 */
class WordController extends Controller
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
     * Lists all Word models.
     * @return mixed
     */
    public function actionIndex()
    {
        $components = new ComponentBase();
        $base_url = $components->Base_url();

       if (isset($_GET['prm'])) {
            $id_cate = $_GET['prm'];
            $code = $_GET['code'];

            $word =  Word::find()->where(['cate_id' => $id_cate])->andwhere(['type' => 5])->asArray()->all();
            // $word = Word::getListLession($code);
            return $this->render('index', [
                'word' => $word,
                'base_url' => $base_url,
                'id_cate'=> $id_cate,
                'code'=> $code
            ]);
        }
        return $this->redirect(['/']);
    }

    /**
     * Displays a single Word model.
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
     * Creates a new Word model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Word();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Word model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Word model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Word model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Word the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Word::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDetail($prm)
    {
        // $this->findModel($id)->delete();
        // var_dump($prm);die;
        if ($prm) {
            $model = $this->findModel($prm);
            return $this->render('detail', [
                'model' => $model,
            ]);
        }
       
    }

    public function actionSearch($text = '', $id_cate ='', $code)
    {
        if ($text) {
            $sql = "SELECT * FROM contents  WHERE type = '5' AND title LIKE '%".$text."%' AND cate_id = '".$id_cate."'";
            $rows = Yii::$app->db->createCommand($sql)->queryAll();
            $components = new ComponentBase();
            $base_url = $components->Base_url();
            return $this->render('index', [
                'word' => $rows,
                'base_url' => $base_url,
                'id_cate'=> $id_cate,
                'text'=> $text,
                'code'=> $code,
            ]);
        }else{
            return $this->redirect(['index?prm='.$id_cate.'&code='.$code]);
        }
       
    }
}
