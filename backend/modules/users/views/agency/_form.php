<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\components\ComponentBase;
use kartik\file\FileInput;
use kartik\date\DatePicker;
use backend\modules\systems\models\AuthItem;
use backend\modules\users\models\User;
use backend\modules\users\models\Agency;
use backend\modules\users\models\Assignacc;
use kartik\select2\Select2;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model backend\modules\users\models\Agency */
/* @var $form yii\widgets\ActiveForm */
$array_login = [
    ['id' => '1', 'name' => 'Đại lý'],
    ['id' => '2', 'name' => 'Cộng tác viên'],
    ['id'=> '3', 'name' => 'Kinh doanh'],
];
$time_begin = $model->time ? date('d-m-Y', $model->time) : null;
?>

<div class="agency-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true,'options'=>['enctype'=>'multipart/form-data']]); ?>
    
    <div class="col-xs-12 padding-right-0  padding-left-0">
         <?php if ($model->isNewRecord) { ?>

            <?= $form->field($model, 'account_type',['options' => ['class' => 'col-xs-4']])->dropDownList(ArrayHelper::map($array_login,'id','name'),['class'=>'form-control type_login','prompt'=>'Lựa chọn loại hình hợp tác','required'=>true])->label('Loại hình hợp tác<span class="required_data"> *</span>');
            ?>
            <?php }else{ ?>

            <?= $form->field($model, 'account_type',['options' => ['class' => 'col-xs-4']])->dropDownList(ArrayHelper::map($array_login,'id','name'),['class'=>'form-control type_login','prompt'=>'Lựa chọn loại hình hợp tác','disabled' => true])->label('Loại hình hợp tác<span class="required_data"> *</span>');
            ?>

        <?php } ?>

            <?= $form->field($model, 'account_code',['options' => ['class' => 'col-xs-4']])->textInput(['required'=>true])->label('Mã đại lý/ ctv<span class="required_data"> *</span>')
            ?>

            <?= $form->field($model, 'account_name',['options' => ['class' => 'col-xs-4']])->textInput(['required'=>true])->label('Tên đại lý/ ctv<span class="required_data"> *</span>')
            ?>

    </div>
    
    <div class="col-xs-12 padding-right-0  padding-left-0">
            <?= $form->field($model, 'contract',['options' => ['class' => 'col-xs-6']])->textInput(['maxlength' => true])->label('Số hợp đồng') ?>

            <?= $form->field($model, 'time',['options' => ['class' => 'date-begin col-xs-6']])->
               widget(DatePicker::classname(), [
                 'type' => DatePicker::TYPE_INPUT,
                 'options' => [
                 'id' => 'begintime',
                 'value' => $time_begin,
                 'placeholder' => 'Lựa chọn ngày',
                ],
                 'language' => 'vi',
                 'pluginOptions' => [
                 'autoclose'=>true,
                 'format' => 'dd-mm-yyyy',
                 'class' =>'form-control',
                 'todayHighlight' => true
                 ]])
            ?>
    </div>
    <div class="col-xs-12 padding-left-0 padding-right-0">
        <?= $form->field($model, 'prepaid',['options' => ['class' => 'col-xs-6']])->textInput()->label('Tài khoản trả trước') ?>

        <?= $form->field($model, 'postpaid',['options' => ['class' => 'col-xs-6']])->textInput()->label('Tài khoản trả sau') ?>
    </div>
   
    <div class="col-xs-12">
        <div class="form-group pull-right">
            <?= Html::submitButton($model->isNewRecord ? 'Lưu' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
            <?= Html::a('Trở lại', ['index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
$( document ).ready(function() {
    if ($('#agency-prepaid').val()) 
        {
            formatMoney_pre();
        }
    if ($('#agency-postpaid').val()) 
        {
            formatMoney_pos();
        }
    $('#agency-prepaid').on('change',function(){
        formatMoney_pre();
    });
    $('#agency-postpaid').on('change',function(){
        formatMoney_pos();
    });
    $("#agency-account_name").blur(function(){
        var value = this.value;
        var res = value.toUpperCase();
        $("#agency-account_name").val(res);
    });
});

    function formatMoney_pre()
    {
        var prepaid = $('#agency-prepaid').val();
        var string = numeral(prepaid).format('0,0');
        document.getElementById('agency-prepaid').value = string;
    }
    function formatMoney_pos()
    {
        var postpaid = $('#agency-postpaid').val();
        var string = numeral(postpaid).format('0,0');
        document.getElementById('agency-postpaid').value = string;
    }
</script>
