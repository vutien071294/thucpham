<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\systems\models\Sysconfig */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sysconfig-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>

    <?php if($model->isNewRecord){?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => 255])->label('Mã cấu hình<span class="required_data"> *</span>') ?>
    <?php } else { ?>

     <?= $form->field($model, 'code')->textInput(['maxlength' => 255, 'readonly' => true])->label('Mã cấu hình') ?>
     <?php } ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255])->label('Tên cấu hình<span class="required_data"> *</span>') ?>

    <?= $form->field($model, 'value')->textArea(['maxlength' => 255, 'row'=> 5])->label('Giá trị cấu hình') ?>

    <?= $form->field($model, 'decription')->textArea(['maxlength' => 255, 'row'=> 5])->label('Mô tả') ?>

   
    <div class="form-group pull-right">
        <?= Html::submitButton($model->isNewRecord ? 'Lưu' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
        <?= Html::a('Trở lại', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
