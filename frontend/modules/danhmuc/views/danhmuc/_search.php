<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\danhmuc\models\DanhmucSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="danhmuc-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'title_en') ?>

    <?= $form->field($model, 'title_fr') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'body') ?>

    <?php // echo $form->field($model, 'parent_id') ?>

    <?php // echo $form->field($model, 'slug') ?>

    <?php // echo $form->field($model, 'publish')->checkbox() ?>

    <?php // echo $form->field($model, 'is_top')->checkbox() ?>

    <?php // echo $form->field($model, 'image_preset') ?>

    <?php // echo $form->field($model, 'image_url') ?>

    <?php // echo $form->field($model, 'image_title') ?>

    <?php // echo $form->field($model, 'image_alt') ?>

    <?php // echo $form->field($model, 'orders') ?>

    <?php // echo $form->field($model, 'sorting_price') ?>

    <?php // echo $form->field($model, 'sorting_brand') ?>

    <?php // echo $form->field($model, 'sorting_res') ?>

    <?php // echo $form->field($model, 'sorting_channel') ?>

    <?php // echo $form->field($model, 'tags') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'create_by') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <?php // echo $form->field($model, 'update_by') ?>

    <?php // echo $form->field($model, 'seo_title') ?>

    <?php // echo $form->field($model, 'seo_keyword') ?>

    <?php // echo $form->field($model, 'seo_description') ?>

    <?php // echo $form->field($model, 'level') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
