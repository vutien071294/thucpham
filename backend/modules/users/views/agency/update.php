<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\users\models\Agency */

$this->title = 'Cập nhật thông tin đại lý/ ctv';
$this->params['breadcrumbs'][] = ['label' => 'Agencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="agency-update col-md-12 site_update-agecy" >

    <fieldset style="border: 1px solid #0093DD; border-radius: 10px; ">
		<legend style="text-align: center;  color: #0093DD; font-size: 15px;border-bottom: 0px; width: auto;"><h3 class="add-color-content-header"><?= Html::encode($this->title) ?></h3></legend>
		<div class="mapping-content-updateform">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		    <hr class="hr_inform hr_info-agency">
		    <?= $this->render('info', [
	        'account_id' => $model->id,
	        'type' => $model->account_type,
	    ]) ?>
    	</div>
	</fieldset>


</div>
