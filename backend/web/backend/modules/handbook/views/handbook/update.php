<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\handbook\models\Handbook */

$this->title = 'Update Handbook: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Handbooks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="handbook-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
