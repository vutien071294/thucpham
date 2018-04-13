<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\handbook\models\Handbook */

$this->title = 'Create Handbook';
$this->params['breadcrumbs'][] = ['label' => 'Handbooks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="handbook-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
