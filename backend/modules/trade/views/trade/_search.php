<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\trade\models\TradeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trade-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div style="margin-top: 10px">
        <?= $form->field($model, 'title', ['options' => ['class' => 'col-xs-4']])->textInput(['placeholder' => 'Tiêu đề thương mại'])->label(false) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Tìm kiếm', ['class' => 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
