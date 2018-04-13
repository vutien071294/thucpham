<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\users\models\AgencySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agency-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div  style="margin-top: 10px">
        <?= $form->field($model, 'account_name', ['options' => ['class' => 'col-xs-4']])->textInput(['placeholder'=>'Nhập tên đại lý/ ctv'])->label(false) ?>

    </div>

    <div class="form-group">
        <?= Html::submitButton('Tìm kiếm', ['class' => 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
