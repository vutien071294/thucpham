<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use backend\modules\contents\models\Construction;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\components\ComponentBase;
use backend\assets\CkeditorAsset;
use backend\modules\users\models\User;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model backend\modules\contents\models\Construction */
/* @var $form yii\widgets\ActiveForm */

CkeditorAsset::register($this);
$components = new ComponentBase();
$base_url_img = $components->Base_url_images();
$base_url = $components->Base_url(); 

$contruction= new Construction();
$list_category = $contruction->get_list_cate_form();

$list_type = [1 => 'Tiêu biểu', 2 => 'Xây dựng', 3 => 'Hoàn thành'];

if($model->is_hot){
    $type = 1;
}else if($model->is_complete){
    $type = 3;
}else if($model->is_build){
    $type = 2;
}
else{
    $type = '';
}

if ($model->url) {
    $image = $base_url_img.'public/images/image_contruction/'.$model->url;
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
?>

<div class="construction-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true,'options' => ['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="col-md-12 none_padding">
        <?= $form->field($model,'cate_id',['options' => ['class' => 'col-md-3 none_padding']])->widget(Select2::classname(), [
                'data' => ArrayHelper::map($list_category, 'id', 'title'),
                'language' => 'vi',
                'options' => ['placeholder' => '--- Công trình ---'],
                'pluginOptions' => [
                'allowClear' => true
                ],
            ])->label('Danh mục công trình');
        ?>
        
        <?= $form->field($model, 'address',['options' => ['class' => 'col-md-6 padding-right-0']])->textInput(['maxlength' => true]) ?>

        <?= $form->field($model,'contruction_type',['options' => ['class' => 'col-md-3 padding-right-0']])->widget(Select2::classname(), [
                'data' => $list_type,
                'language' => 'vi',
                'options' => ['placeholder' => '--- Loại công trình ---', 'value' => $type],
                'pluginOptions' => [
                'allowClear' => true
                ],
            ])->label('Loại công trình');
        ?>

    </div>
    
    <div class="col-md-12 none_padding">
    <?php echo '<label id = "image" class="control-label">Ảnh đại diện</label>'; ?>
    <?php 
        if ($model->isNewRecord) { 
            echo $form->field($model, 'url')->widget(FileInput::classname(),[
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
            echo $form->field($model, 'url')->widget(FileInput::classname(),[
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


    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
            'options' => ['rows' => 4, 'id' => 'test1'],
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
            <?= Html::submitButton($model->isNewRecord ? 'Tạo mới' : 'Cập nhật', ['id' => 'create-btn-new','class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
            <?= Html::a('Trở lại', ['index'],  ['class' => $model->isNewRecord ? 'btn btn-default' : 'btn btn-default']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

