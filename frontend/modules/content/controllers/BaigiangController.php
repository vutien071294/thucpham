<?php

namespace frontend\modules\content\controllers;

use Yii;
use frontend\modules\content\models\Baigiang;
use frontend\modules\content\models\BaigiangSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\modules\danhmuc\models\Danhmuc;
use frontend\components\ComponentBase;

/**
 * BaigiangController implements the CRUD actions for Baigiang model.
 */
class BaigiangController extends Controller
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
     * Lists all Baigiang models.
     * @return mixed
     */
    public function actionIndex()
    {
        $components = new ComponentBase();
        $base_url = $components->Base_url();
        $data_lession_by_cate = array();
        $title = '';
        $id_cate = 0;
        $pages = isset($_GET['pages']) ? $_GET['pages'] : 1;
        $total = Baigiang::countListLession();
        if($total < 12){
            $minResult = 0;
            $maxResult = $total;
        }
        else{
            $minResult = ($pages - 1) * 12;
            $maxResult = 12;
        }

        if(isset($_GET['prm'])){
            $id_cate = $_GET['prm'];
            $title = Danhmuc::findOne($id_cate)['title'];
            $data_lession_by_cate = Baigiang::getListLession($id_cate,$minResult,$maxResult);
             $code = $_GET['code'];
        }
        return $this->render('index', [
            'data_lession_by_cate' => $data_lession_by_cate,
            'title'=> $title,
            'pages' => $pages,
            'total'=>$total,
            'base_url' => $base_url,
            'id_cate'=> $id_cate,
            'code'=> $code
        ]);
    }

    /**
     * Displays a single Baigiang model.
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
     * Creates a new Baigiang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Baigiang();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Baigiang model.
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
     * Deletes an existing Baigiang model.
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
     * Finds the Baigiang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Baigiang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Baigiang::findOne($id)) !== null) {
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
            $sql = "SELECT * FROM contents  WHERE type = '1' AND title LIKE '%".$text."%' AND cate_id = '".$id_cate."'";
            $rows = Yii::$app->db->createCommand($sql)->queryAll();
            $components = new ComponentBase();
            $base_url = $components->Base_url();
            return $this->render('index', [
                'data_lession_by_cate' => $rows,
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
