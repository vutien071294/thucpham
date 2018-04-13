<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\components\ComponentBase;
use backend\modules\users\models\User;
/* @var $this yii\web\View */
/* @var $model backend\modules\systems\models\Sysconfig */

$this->title = 'Xem chi tiết cấu hình';
$this->params['breadcrumbs'][] = ['label' => 'Sysconfigs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$name_create_user = $model->creation_user ? User::findOne($model->creation_user)['username'] : '';
$name_update_user = $model->update_user ? User::findOne($model->update_user)['username'] : '';
$name = $model->name? html_entity_decode($model->name) : '';
$value = $model->value? html_entity_decode($model->value) : '';
$decription = $model->decription? html_entity_decode($model->decription) : '';
?>
<div class="sysconfig-view col-md-9" style="margin-left: 10%; margin-top:20px;">

 <fieldset style="border: 1px solid #0093DD; border-radius: 10px; ">
        <legend style="text-align: center; color: #0093DD; font-size: 15px;border-bottom: 0px; width: auto;"><h3><?= Html::encode($this->title) ?></h3></legend>
    
        <div class="mapping-content-updateform">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => 
            [
                [
                    'attribute' => 'code',
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'name',
                    'value' => $name,
                ],
                [
                    'attribute' => 'value',
                    'value' => $value,
                ],
                [
                    'attribute' => 'creation_user',
                    'value' => $name_create_user,
                ],
                [
                    'attribute' => 'creation_time',
                    'format' => ['date', 'php:d-m-Y'],
                ],
                 [
                    'attribute' => 'update_user',
                    'value' => $name_update_user,
                ],
                [
                    'attribute' => 'update_time',
                    'format' => ['date', 'php:d-m-Y'],
                ],
                [
                    'attribute' => 'decription',
                    'value' => $decription,
                ],
            ],
    ]) ?>
      <div class="pull-right" style="margin-right: 10px;">
            <p>
                <?= Html::a('Cập nhật', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            
                <?= Html::a('Trở lại', ['index'], ['class' => 'btn btn-default']) ?>
            </p>
        </div>
     </div> 

    </fieldset>
</div>
</div>
