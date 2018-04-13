<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\danhmuc\models\Danhmuc */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Danhmucs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="danhmuc-view">

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
            'code',
            'title',
            'title_en',
            'title_fr',
            'description:ntext',
            'body:ntext',
            'parent_id',
            'slug',
            'publish:boolean',
            'is_top:boolean',
            'image_preset',
            'image_url:url',
            'image_title:ntext',
            'image_alt:ntext',
            'orders',
            'sorting_price:ntext',
            'sorting_brand:ntext',
            'sorting_res:ntext',
            'sorting_channel:ntext',
            'tags:ntext',
            'create_time',
            'create_by',
            'update_time',
            'update_by',
            'seo_title',
            'seo_keyword',
            'seo_description:ntext',
            'level',
        ],
    ]) ?>

</div>
