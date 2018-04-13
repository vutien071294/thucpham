<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\modules\product\models\Product_type;
use backend\components\ComponentBase;
use yii\helpers\Url;
use backend\modules\categorys\models\Maker;
use backend\modules\users\models\User;

$components = new ComponentBase();
$base_url = $components->Base_url();
$base_url_image = $components->Base_url_images();
if ($model->image_preset) {

    $image = $base_url_image.'public/images/image_products/'.$model->image_preset;
}else{
    $image = '';
}

$product_type = new Product_type();

$list_category = $product_type->get_list_cate($model->id ? $model->id : '');

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

<div class="products-form">

    <?php $form = ActiveForm::begin(['id' => 'product-type-form','enableAjaxValidation' => true, 'options'=>['enctype'=>'multipart/form-data','autocomplete' => "off"]]); ?>

    <div class="col-xs-12 padding-right-0 padding-left-0">
    <?php  if ($model->isNewRecord){ ?>

    <?= $form->field($model, 'code',['options' => ['class' => 'col-xs-6 padding-left-0']])->textInput(['maxlength' => true])->label('Mã sản phẩm<span class="required_data"> *</span>') ?>

    <?php }else{ ?>


    <?= $form->field($model, 'code',['options' => ['class' => 'col-xs-6 padding-left-0']])->textInput(['maxlength' => true, 'disabled' => true])->label('Mã sản phẩm<span class="required_data"> *</span>') ?>

    <?php } ?>
    

    <?= $form->field($model, 'title',['options' => ['class' => 'col-xs-6 padding-right-0']])->textInput(['maxlength' => true])->label('Tiêu đề<span class="required_data"> *</span>') ?>
    
    </div>

    <div class="col-xs-12 padding-right-0 padding-left-0">
        <?= $form->field($model,'categories_id',['options' => ['class' => 'col-xs-6 padding-left-0']])->widget(Select2::classname(), [
                'data' => ArrayHelper::map($list_category, '0', '1'),
                'language' => 'vi',
                'options' => ['id'=>'products_categories_id', 'placeholder' => '--- Danh mục sản phẩm ---'],
                'pluginOptions' => [
                'allowClear' => true
                ],
            ])->label('Loại sản phẩm<span class="required_data"> *</span> ');
        ?>
        <?= $form->field($model,'provider_id',['options' => ['class' => 'col-xs-6 padding-right-0']])->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Maker::find()->orderBy(['name'=>SORT_ASC])->where(['status'=> 1])->all(), 'id', 'name'),
                'language' => 'vi',
                'options' => ['id'=>'products_provider_id', 'placeholder' => '--- Nhà cung cấp ---'],
                'pluginOptions' => [
                'allowClear' => true
                ],
            ])->label('Nhà cung cấp');
        ?>
    </div>
    <div class="col-md-12 mar_top_10 none_padding">

        <?= $form->field($model, 'orders',['options' => ['class' => 'col-xs-3 padding-left-0']])->textInput()->label('Thứ tự sản phẩm'); ?>
    

        <?php 
        if ($model->isNewRecord) {
            $model->publish = "1";
        }
        ?>
        <?= $form->field($model, 'publish',['options' => ['class' => 'col-xs-3 padding-left-0 mar_top_20']])->checkbox(['value' => "1"])->label('Hiển thị sản phẩm: '); ?>
        
         <?= $form->field($model, 'is_stock',['options' => ['class' => 'col-xs-3 padding-left-0 mar_top_20']])->checkbox()->label('Trạng thái sản phẩm: '); ?>
    </div>
    <?php
     // $form->field($model, 'products_list_involve')->widget(Select2::classname(), [
     //        'language' => 'vi',
     //        'options' => ['id'=>'products_list_involve', 'class' => 'col-xs-6','placeholder' => '--- Lựa chọn sản phẩm liên quan ---', 'multiple' => true],
     //        'pluginOptions' => [
     //            'allowClear' => true,
     //            'closeOnSelect'=> false
     //            ],
     //        ])->label('Danh sách sản phẩm liên quan');
        ?>
    <div class="col-xs-12 padding-right-0 padding-left-0" id="property_list">
        
        <div class="col-xs-12 padding-right-0 padding-left-0" id="property_list">
            <hr class="col-xs-12 hr_inform"> 
            <div class="mar_top_10">
                <h5><b>Thuộc tính sản phẩm<b></b></b></h5>
            </div>
            <div class="col-md-12 none_padding">
                <?= $form->field($model, 'xuat_xu', ['options' => ['class' => 'col-xs-6 padding-left-0']])->textInput()->label('Xuất xứ') ?>
                <?= $form->field($model, 'bao_hanh', ['options' => ['class' => 'col-xs-6 padding-right-0']])->textInput()->label('Bảo hành') ?>
            </div>
            <div class="col-md-12 none_padding">
                <?= $form->field($model, 'mau_sac', ['options' => ['class' => 'col-xs-6 padding-left-0']])->textInput()->label('Màu sắc') ?>
                <?= $form->field($model, 'chat_lieu', ['options' => ['class' => 'col-xs-6 padding-right-0']])->textInput()->label('Chất liệu') ?>
            </div>

            <div class="col-md-12 none_padding">
                <?= $form->field($model, 'kich_thuoc', ['options' => ['class' => 'col-xs-6 padding-left-0']])->textInput()->label('Kích thước') ?>
                 <?= $form->field($model, 'so_luong', ['options' => ['class' => 'col-xs-6 padding-right-0']])->textInput()->label('Số lượng') ?> 
            </div>
            <hr class="col-xs-12 hr_inform">
        </div>

    </div>
   
    <div class="col-md-12 none_padding">
    <?= $form->field($model, 'input_price', ['options' => ['class' => 'col-xs-6 padding-left-0']])->textInput()->label('Giá nhập (VNĐ)') ?>
    <?= $form->field($model, 'sell_price', ['options' => ['class' => 'col-xs-6 padding-right-0']])->textInput()->label('Giá bán<span class="required_data"> *</span> (VNĐ)') ?>
    </div>

    <?= '<label id = "image" class="control-label">Ảnh đại diện</label><i> (Kích thước đề nghị: Rộng: 270px - Cao: 230px) </i>'; ?>
    
    <?php  if ($model->isNewRecord) { ?> 
        <?= $form->field($model, 'image_preset')->widget(FileInput::classname(),[
            'options' => ['accept' => 'image/*'],
            'language'=>'vi',
            'pluginOptions' => [
                'previewSettings'=>  ['image'=> ['width' =>"270px", 'height'=> "230px"]],
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
        ])->label(false)?>
    <?php }else { ?>
        <?= $form->field($model, 'image_preset')->widget(FileInput::classname(),[
            'options' => ['accept' => 'image/*'],
            'language'=>'vi',
            'pluginOptions' => [
                'previewSettings'=>  ['image'=> ['width' =>"270px", 'height'=> "230px"]],
                'initialPreview' => [
                    $image ? Html::img($image,['class'=>'file-preview-image','style'=>['width'=>'270px', 'height'=>'230px']]) : null ],
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
        ])->label(false) ?>
    <?php } ?>

    <?= $form->field($model, 'image_title',['options' => ['class' => 'col-xs-6 padding-left-0']])->textInput(['maxlength' => true])->label('Tiêu đề ảnh'); ?>
    <div class="col-md-12 none_padding">
    
    <label id = "image" class="control-label">Danh sách ảnh liên quan của sản phẩm</label><i> </i>
    <?php 
     echo FileInput::widget([
        'name' => 'Products[image_roducts_list_involve][]',
        'options'=>[
            'multiple'=>true,
            'accept' => 'image/*',
             'showUpload' => false,
        ],
        'pluginOptions' => [
            'showUpload' => false,
            'overwriteInitial' => false,
            // 'uploadExtraData' => [
            //     'album_id' => 20,
            //     'cat_id' => 'Nature'
            // ],
            'fileActionSettings' => [
                'showUpload' => false,
            ],
            'maxFileCount' => 10
        ]
    ]);
    ?>
    </div>
    <div class="col-md-12 mar_top_10 none_padding">
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
        ])->label('Chi tiết sản phẩm') ?>
    </div>

    
    <!-- <div class="col-md-12 none_padding">
        <label id = "image" class="control-label">Thông tin khác</label>
    </div> -->

    <div class="col-md-12 none_padding">
    
    
    <!--  mới -->
    <!-- <?= $form->field($model, 'is_new',['options' => ['class' => 'col-xs-3 padding-left-0']])->checkbox() ?> -->

    <!--  nổi bật -->
    <!-- <?= $form->field($model, 'is_promotion',['options' => ['class' => 'col-xs-3 padding-left-0']])->checkbox() ?> -->
                                                  
    <!--  bán chạy -->
    <!-- <?= $form->field($model, 'is_seller',['options' => ['class' => 'col-xs-3 padding-left-0']])->checkbox() ?> -->
    
   <!--  còn hàng -->
   
    
    </div>
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
    <div class="col-md-12 none_padding mar_top_10">
        <div class="form-group pull-right">
            <?= Html::submitButton($model->isNewRecord ? 'Tạo mới' : 'Cập nhật', ['id' => 'create-btn-new','class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
            <?= Html::a('Trở lại', ['index'],  ['class' => $model->isNewRecord ? 'btn btn-default' : 'btn btn-default']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript" charset="utf-8" async defer>
    // function change_categories_id()
    // {
    //    var id = $('#products_categories_id').val();
    //     if (id) {
    //         $.ajax({
    //             method: "POST",
    //             url: '<?php echo $base_url?>product/products/list_products_involve',
    //             data: {'value': id },
    //             async: true,
    //             success: function(result){
    //                 var getData = $.parseJSON(result);
    //                 $("#products_list_involve").empty();
    //                 $.each(getData, function(key, item){
    //                     $("#products_list_involve").append("<option value="+key+">"+item+"</option");
    //                 });                            
    //             }       
    //         });

    //         $.ajax({
    //             method: "POST",
    //             url: '<?php echo $base_url?>product/products/list_products_property',
    //             data: {'value': id },
    //             async: true,
    //             success: function(result){
    //                 $("#property_list").empty();
    //                 var getData = $.parseJSON(result);
    //                 if (getData.length != 0) {
    //                     var html = '<hr class="col-xs-12 hr_inform"> <div class = "mar_top_10"><h5><b>Thuộc tính loại sản phẩm<b></h5></div>';
    //                     $.each(getData, function(key, item){
    //                         var value_list = item.value.split("\n");
    //                         html += '<div class="col-xs-6 padding-left-0 form-group field-user-type_login required"> <label class="control-label" for="user-type_login">' + item.title + '</label> <select id="user-type_login" class="form-control type_login" name="Products[properties][' + item.name + ']" aria-required="true">  <option value="">Lựa chọn giá trị</option>';
    //                         $.each(value_list, function(key, item){
    //                             html += '<option value="' + item + '">' + item + '</option>';
    //                         });
                           
    //                         html += '</select> </div>';
    //                     });
    //                     html += '<hr class="col-xs-12 hr_inform">';
    //                     $("#property_list").append(html);
    //                 }
    //             }       
    //         });
    //     }
    //     else{
    //         $("#products_list_involve").empty();
    //     }
    // }
    $( document ).ready(function() {
        var change_one = 'products-input_price';
        var change_two = 'products-list_price';
        var change_three = 'products-sell_price';
        if ($('#products-input_price').val()) 
        {
            formatMoney_pre(change_one);
        }
        $('#products-input_price').on('change',function(){
            formatMoney_pre(change_one);
        });
        if ($('#products-list_price').val()) 
        {
            formatMoney_pre(change_two);
        }
        $('#products-list_price').on('change',function(){
            formatMoney_pre(change_two);
        });
        if ($('#products-sell_price').val()) 
        {
            formatMoney_pre(change_three);
        }
        $('#products-sell_price').on('change',function(){
            formatMoney_pre(change_three);
        });
    });

    function formatMoney_pre(change_value)
    {
        var prepaid = $('#'+change_value).val();
        var string = numeral(prepaid).format('0,0');
        document.getElementById(change_value).value = string;
    }
</script>
