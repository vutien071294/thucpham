<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\modules\contents\models\ConstructionSearch */
/* @var $form yii\widgets\ActiveForm */
$list_type = [1 => 'Tiêu biểu', 2 => 'Xây dựng', 3 => 'Hoàn thành'];
?>

<div class="construction-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

   <div style="margin-top: 10px">

        <?= $form->field($model, 'title', ['options' => ['class' => 'col-xs-4']])->textInput(['placeholder' => 'Tiêu đề công trình'])->label(false) ?>
        
    </div>

    <div class="form-group">
        <?= Html::submitButton('Tìm kiếm', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
