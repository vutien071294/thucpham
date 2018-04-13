<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\danhmuc\models\Danhmuc */

$this->title = 'Create Danhmuc';
$this->params['breadcrumbs'][] = ['label' => 'Danhmucs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="danhmuc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
