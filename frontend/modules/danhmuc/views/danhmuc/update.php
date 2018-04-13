<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\danhmuc\models\Danhmuc */

$this->title = 'Update Danhmuc: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Danhmucs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="danhmuc-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
