<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\modules\product\models\Product_type;
use backend\components\ComponentBase;

$components = new ComponentBase();
$base_url = $components->Base_url();

$product_type = new Product_type();

$list_category = $product_type->get_list_cate();
/* @var $this yii\web\View */
/* @var $model backend\modules\product\models\Cate_properties */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cate-properties-form">

    <?php $form = ActiveForm::begin(['id' => 'cate-properties-form','enableAjaxValidation' => true]); ?>
    
    <div class="col-xs-12 padding-right-0  padding-left-0">
        <?= $form->field($model,'cate_id',['options' => ['class' => 'col-xs-6 padding-left-0']])->widget(Select2::classname(), [
                // 'data' => ArrayHelper::map($list_category, '0', '1'),
                'data' => ArrayHelper::map(Product_type::find()->orderBy(['title'=>SORT_ASC])->where(['level'=> 1])->all(), 'id', 'title'),
                'language' => 'vi',
                'options' => ['placeholder' => '--- Loại sản phẩm ---'],
                'pluginOptions' => [
                'allowClear' => true
                ],
            ])->label('Loại sản phẩm<span class="required_data"> *</span>');
        ?>
    </div>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Tên thuộc tính<span class="required_data"> *</span>') ?>
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Tiêu đề<span class="required_data"> *</span>') ?>
    
    <?= $form->field($model, 'isfilter')->checkbox() ?>

    <?= $form->field($model, 'value')->textArea(['rows'=> 10])->label('Giá trị<span class="required_data"> *</span>') ?>

    <div class="form-group pull-right ">
        <div class="col-md-12">
        <?= Html::submitButton($model->isNewRecord ? 'Lưu' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
        <?= Html::a('Trở lại', ['index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
