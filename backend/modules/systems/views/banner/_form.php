<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\components\ComponentBase;
use backend\modules\users\models\User;

$components = new ComponentBase();
$base_url = $components->Base_url_images();
if ($model->image) {
    $image = $base_url.'public/images/image_banner/'.$model->image;
}else{
    $image = '';
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
/* @var $model backend\modules\systems\models\Banner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'code',['options' => ['class' => 'col-xs-12']])->textInput(['maxlength' => true])->label('Mã banner') ?>
    <?= $form->field($model, 'title',['options' => ['class' => 'col-xs-12']])->textInput(['maxlength' => true])->label('Tiêu đề banner') ?>
    
    <div class="col-md-12">
    <?= $form->field($model, 'url',['options' => ['class' => 'col-xs-6 padding-left-0']])->textInput(['maxlength' => true])->label('Url banner') ?>
    <?= $form->field($model, 'sort',['options' => ['class' => 'col-xs-6 padding-right-0']])->textInput(['maxlength' => true])->label('Số thứ tự') ?>
    </div>
    <div class="col-md-12">
    <?php '<label id = "image" class="control-label">Ảnh banner</label><i> (Kích thước đề nghị: Rộng: 870px - Cao: 373px) </i>'; ?>
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

   <?php if (!$model->isNewRecord) { ?>
    
    <div class="col-xs-12 padding-right-0 padding-left-0">
        <div class="col-xs-6 padding-left-0">
            <label class="control-label">Người tạo</label>
            <input type="text" class="form-control" name="" disabled value="<?= $name_creater?>">
        </div>
        <div class="col-xs-6 padding-left-0 padding-right-0">
            <label class="control-label">Thời gian tạo</label>
            <input type="text" class="form-control" name="" disabled value="<?= ($model->create_time != '') ? date('d/m/Y', $model->create_time) : ''; ?>">
        </div>
        <div class="col-xs-6 padding-left-0">
            <label class="control-label">Người cập nhật</label>
            <input type="text" class="form-control" name="" disabled value="<?= $name_editer ?>">
        </div>
        <div class="col-xs-6 padding-left-0 padding-right-0">
            <label class="control-label">Thời gian cập nhật</label>
            <input type="text" class="form-control" name="" disabled value="<?= ($model->update_time != '') ? date('d/m/Y', $model->update_time) : '';?> ">
        </div>
    </div>
    <?php } ?>

    <div class="col-xs-12 padding-right-0 mar_top_10">
        <div class="form-group pull-right ">
            <?= Html::submitButton($model->isNewRecord ? 'Lưu' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
            <?= Html::a('Trở lại', ['index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
