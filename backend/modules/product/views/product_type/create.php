<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\product\models\Product_type */

$this->title = 'Thêm mới menu';
$this->params['breadcrumbs'][] = ['label' => 'Product Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-type-create col-md-12 mar_top_20">

    <fieldset style="border: 1px solid #0093DD; border-radius: 10px; ">
		<legend style="text-align: center;  color: #0093DD; font-size: 15px;border-bottom: 0px; width: auto;"><h3 class="add-color-content-header"><?= Html::encode($this->title) ?></h3></legend>
		<div class="mapping-content-updateform">
			<?= $this->render('_form', [
				'model' => $model,
				]) ?>
		</div>
	</fieldset>
</div>
