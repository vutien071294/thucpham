<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\modules\users\models\User;

/* @var $this yii\web\View */
/* @var $model backend\modules\product\models\Cate_properties */

$this->title = 'Xem chi tiết thuộc tính sản phẩm';
$this->params['breadcrumbs'][] = ['label' => 'Cate Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$users = new User();
if($model->create_by){
    $name_creater = $users->get_user_name($model->create_by);
}
else
{
    $name_creater = '';
}
if($model->update_by){
    $name_editer = $users->get_user_name($model->update_by);
}
else
{
    $name_editer = '';
}

?>
<div class="cate-properties-view col-md-12" style="margin-left: 0%; margin-top:10px; padding: 20px;">
    
    <fieldset style="border: 1px solid #0093DD; border-radius: 10px; ">
        <legend style="text-align: center;  color: #0093DD; font-size: 15px;border-bottom: 0px; width: auto;"><h3 class="add-color-content-header"><?= Html::encode($this->title) ?></h3></legend>
        <div class="col-md-12">

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'name',
                'title',
                [
                    'attribute' => 'isfilter',
                    'format' => 'raw',
                    'value' => function($model){
                        return ($model->isfilter == 1) ?  '<span class="label label-success">Có</span>' :  '<span class="label label-danger">Không</span>';
                    }
                ],
                [
                    'attribute' => 'value',
                    'format' => 'raw',
                    'value' => function($model){
                        return nl2br($model->value);
                    }
                ],
                [
                    'attribute' => 'create_time',
                    'format' => ['date', 'php:d-m-Y']
                ],
                [
                    'attribute' => 'create_by',
                    'value' =>  $name_creater,
                ],
                [
                    'attribute' => 'update_time',
                    'format' => ['date', 'php:d-m-Y']
                ],
                [
                    'attribute' => 'update_by',
                    'value' =>  $name_editer,
                ],
            ],
        ]) ?>
        </div>
        <div class="pull-right" style="margin-right: 10px;">
            <p>
                <?= Html::a('Cập nhật', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

                <?= Html::a('Trở lại', ['index'], ['class' => 'btn btn-default']) ?>
            </p>
        </div>
    </fieldset>
</div>