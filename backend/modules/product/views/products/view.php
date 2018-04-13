<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\product\models\Products */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-view">

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
            'description_en:ntext',
            'description_fr:ntext',
            'desc:ntext',
            'desc_en:ntext',
            'desc_fr:ntext',
            'body:ntext',
            'body_en:ntext',
            'body_fr:ntext',
            'body2:ntext',
            'body2_en:ntext',
            'body2_fr:ntext',
            'body3:ntext',
            'body3_en:ntext',
            'body3_fr:ntext',
            'image_url:ntext',
            'image_title:ntext',
            'image_alt:ntext',
            'is_new',
            'is_promotion',
            'is_seller',
            'is_hot',
            'is_stock',
            'list_price',
            'input_price',
            'sell_price',
            'warranty:ntext',
            'orders',
            'publish:boolean',
            'show_price:boolean',
            'slug',
            'tags:ntext',
            'seo_title',
            'seo_keyword',
            'seo_description:ntext',
            'categories_id',
            'sub_categories_id:ntext',
            'create_time',
            'create_by',
            'update_time',
            'update_by',
            'hightlight:ntext',
        ],
    ]) ?>

</div>
