<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\assets\CkeditorAsset;
use backend\modules\product\models\Product_type;
use backend\modules\product\models\Dmsanpham;
use backend\components\ComponentBase;
use backend\modules\users\models\User;


CkeditorAsset::register($this);
$components = new ComponentBase();
$base_url = $components->Base_url();
$base_url_image = $components->Base_url_images();
if ($model->image) {
    $image = $base_url_image.'public/images/image_manage/'.$model->image;
}else{
    $image = '';
}

$product_type = new Product_type();


$list_category = $product_type->get_list_cate_form();

if ($model->id) {
    $level_cate = $product_type->get_level_cate($model->id);
}
$users = new User();
if($model->create_by){
    $name_creater = $users->get_user_name($model->create_by);
}
else
{
    $name_creater = '';
}
if($model->update_by){
    $name_editer = $users->get_user_name($model->update_by);
}
else
{
    $name_editer = '';
}
/* @var $this yii\web\View */
/* @var $model backend\modules\product\models\Product_type */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quanlysanpham-form">

    <?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'],
    'id' => 'product-type-form',
    'enableAjaxValidation' => false
    ]); ?>

    <?= $form->field($model,'cate_id')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(Dmsanpham::find()->orderBy(['title'=>SORT_ASC])->all(), 'id', 'title'),
                            'language' => 'vi',
                            'options' => ['placeholder' => '--- Lựa chọn sản phẩm ---'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])->label('Sản phẩm <span class="required_data"> *</span>')
                            ?> 

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Tiêu đề<span class="required_data"> *</span>') ?>

    <?= $form->field($model, 'size')->textInput(['maxlength' => true])->label('Kích thước<span class="required_data"> *</span>') ?>

      <div class="col-md-12 none_padding">
    <?php echo '<label id = "image" class="control-label">Ảnh đại diện</label><i> (Kích thước đề nghị: Rộng: 280px - Cao: 170px) </i>'; ?>
    <?php 
    if ($model->isNewRecord) { 
        echo $form->field($model, 'image')->widget(FileInput::classname(),[
            'options' => ['accept' => 'image/*'],
            'language'=>'vi',
            'pluginOptions' => [
                'overwriteInitial'=>true,
                'showUpload' => false,
                'fileActionSettings'=>[
                    'showZoom'=>false,
                    'showDrag'=> false,
                ],
                'browseLabel' => 'Chọn ảnh',
                'removeLabel' => 'Xóa',
                'removeClass' => 'btn btn-default',
                'browseClass' => 'btn btn-default',
                'showCaption' => false,
                'layoutTemplates' => [
                    'size' => '',
                ],
            ],
        ])->label(false);
    }else {
        echo $form->field($model, 'image')->widget(FileInput::classname(),[
            'options' => ['accept' => 'image/*'],
            'language'=>'vi',
            'pluginOptions' => [
                'initialPreview' => [
                    $image ? Html::img($image,['class'=>'file-preview-image','style'=>['width'=>'230px;', 'height'=>'auto']]) : null ],
                'overwriteInitial'=>true,
                'showUpload' => false,
                'fileActionSettings'=>[
                    'showZoom'=>false,
                    'showDrag'=> false,
                ],
                'browseLabel' => 'Chọn ảnh',
                'removeLabel' => 'Xóa',
                'removeClass' => 'btn btn-default',
                'browseClass' => 'btn btn-default',
                'showCaption' => false,
                'layoutTemplates' => [
                    'size' => '',
                ],
            ],
        ])->label(false);
    } 
    ?>
    </div>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true])->label('Giá<span class="required_data"> *</span>') ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
            'options' => ['rows' => 4],
             'clientOptions' => [
                'toolbarGroups' => [
                     ['filebrowserUploadUrl' => 'site/url'],
                    ['name' => 'clipboard', 'groups' => ['clipboard', 'undo' ]],
                    ['name' => 'editing', 'groups' => ['find', 'selection', 'spellchecker' ]],
                    ['name' => 'basicstyles', 'groups' => ['basicstyles', 'cleanup' ]],
                    ['name' => 'paragraph', 'groups' => ['list', 'indent', 'blocks', 'align', 'bidi' ]],
                    ['name' => 'links'],
                    ['name' => 'insert'],
                    '/',
                    ['name' => 'styles'],
                    ['name' => 'colors'],
                    ['name' => 'tools'],
                    ['name' => 'others']
                ],
            ],
        ])->label('Mô tả') ?>
    <div class="col-xs-12 padding-right-0 mar_top_10">
        <div class="form-group pull-right ">
            <?= Html::submitButton($model->isNewRecord ? 'Tạo mới' : 'Cập nhật', ['id' => 'create-btn-new','class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
            <?= Html::a('Trở lại', ['index'],  ['class' => $model->isNewRecord ? 'btn btn-default' : 'btn btn-default']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    $( document ).ready(function() {
        var change_one = 'quanlysanpham-price';

        
        if ($('#quanlysanpham-price').val()) 
        {
            formatMoney_pre(change_one);
        }
        $('#quanlysanpham-price').on('change',function(){
            formatMoney_pre(change_one);
        });
    });

    function formatMoney_pre(change_value)
    {
        var prepaid = $('#'+change_value).val();
        var string = numeral(prepaid).format('0,0');
        document.getElementById(change_value).value = string;
    }
</script>
