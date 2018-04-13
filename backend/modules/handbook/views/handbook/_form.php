<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\modules\users\models\User;
use frontend\components\ComponentBase;
use backend\assets\CkeditorAsset;
/* @var $this yii\web\View */
/* @var $model backend\modules\contents\models\Construction */
/* @var $form yii\widgets\ActiveForm */

CkeditorAsset::register($this);
$components = new ComponentBase();
$base_url = $components->Base_url(); 

if ($model->image) {
    $image = $base_url.'public/images/image_handbook/'.$model->image;
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
/* @var $model backend\modules\handbook\models\Handbook */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="handbook-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true,'options' => ['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255])->label('Tiêu đề<span class="required_data"> *</span>') ?>

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

    <?= $form->field($model, 'content')->widget(CKEditor::className(), [
            'options' => ['rows' => 10],
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
        ])->label('Nội dung') ?>
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

    <div class="col-md-12 none_padding mar_top_10">
        <div class="form-group pull-right">
            <?= Html::submitButton($model->isNewRecord ? 'Tạo mới' : 'Cập nhật', ['id' => 'create-btn-new','class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
            <?= Html::a('Trở lại', ['index'],  ['class' => $model->isNewRecord ? 'btn btn-default' : 'btn btn-default']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
