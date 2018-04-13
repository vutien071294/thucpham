<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\contents\models\Construction */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Constructions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="construction-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'address',
            'url:url',
            'description',
            'type',
            'create_time:datetime',
            'create_by',
            'update_time:datetime',
            'update_by',
            'cate_id',
            'is_complete',
            'is_hot',
            'is_build',
        ],
    ]) ?>

</div>
