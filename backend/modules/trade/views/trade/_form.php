<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\components\ComponentBase;
use backend\modules\users\models\User;
use backend\assets\CkeditorAsset;

CkeditorAsset::register($this);
$components = new ComponentBase();
$base_url = $components->Base_url();

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

<div class="trade-form">

    <?php $form = ActiveForm::begin(['id' => 'trade-form','enableAjaxValidation' => false]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Tiêu đề<span class="required_data"> *</span>') ?>

    <?= $form->field($model, 'content')->widget(CKEditor::className(), [
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
        ])->label('Nội dung') ?>
    <div class="col-xs-12 padding-right-0 mar_top_10">
        <div class="form-group pull-right ">
            <?= Html::submitButton($model->isNewRecord ? 'Tạo mới' : 'Cập nhật', ['id' => 'create-btn-new','class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
            <?= Html::a('Trở lại', ['index'],  ['class' => $model->isNewRecord ? 'btn btn-default' : 'btn btn-default']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
