<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\categorys\models\ProvinceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sysconfig-search">

   <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-horizontal']
    ]); ?>

    <div  style="margin-top: 10px">
            <?= $form->field($model,'search_text', ['options' => ['class' => 'col-xs-6']])->textInput(['placeholder'=>'Nhập mã hoặc tên cấu hình...'])->label(false) ?>
        </div>

            <div class="form-group">               
                    <?= Html::submitButton('Tìm kiếm', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
