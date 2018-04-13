<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\handbook\models\Handbook */

$this->title = 'Cập nhật thông tin cẩm nang';
$this->params['breadcrumbs'][] = ['label' => 'Handbooks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="handbook-update">

    <div class="province-create col-md-12" style="margin-top:20px;">
    <fieldset style="border: 1px solid #0093DD; border-radius: 10px; ">
        <legend style="text-align: center;  color: #0093DD; font-size: 15px;border-bottom: 0px; width: auto;"><h3 class="add-color-content-header"><?= Html::encode($this->title) ?></h3></legend>
        <div class="mapping-content-updateform">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </fieldset>
    </div>

</div>
