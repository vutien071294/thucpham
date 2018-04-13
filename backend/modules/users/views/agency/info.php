<?php
use backend\modules\users\models\Agencyinfo;
use backend\modules\users\models\User;
use backend\modules\users\models\Agency;
use backend\components\ComponentBase;
use kartik\date\DatePicker;
use backend\modules\systems\models\Authassignment;
use backend\modules\systems\models\AuthItem;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use backend\modules\users\models\Discount;
use yii\web\Response;
$components = new ComponentBase();
$base_url = $components->Base_url();

$account_info = Agencyinfo::find()->where(['account_id' => $account_id])->one();

// tab info
if ($account_info['datefounded'] != 0) {
	$datefounded = substr($account_info['datefounded'], 6,2).'-'.substr($account_info['datefounded'], 4,2).'-'.substr($account_info['datefounded'], 0,4);
}else{
	$datefounded = '';
}

// tab người dùng
$agency = new Agency();
if ($account_id) {
	$list_user_by_account_id = $agency->get_list_user_by_account_id($account_id);
	if ($list_user_by_account_id) {
		$arr_user = array();
		foreach ($list_user_by_account_id as $key => $value) {
			$temp = array();
			$temp = array_filter($temp);
			array_push($temp, $key+1);
			array_push($temp, $value['username']);
			array_push($temp, $value['userdisplay']);
			array_push($temp, $value['description']);
			array_push($arr_user, $temp);
		}
		$list_user =  json_encode($arr_user, 128);
	}else{
		$list_user = null;
	}
}

$dataProvider = Agency::get_list_data_user_new($account_id);
$data_dis = new Discount();
$data_account_discount = Agency::get_data_discount_account($account_id) ? Agency::get_data_discount_account($account_id) : $data_dis;

?>

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<div class="col-md-12">
  	<div class="nav-tabs-custom">
    	<ul class="nav nav-tabs">
		    <li><a href="#info_account" data-toggle="tab"><b>Thông tin</b></a></li>
		    <li><a href="#raccount_user" data-toggle="tab"><b>Người dùng</b></a></li>
		    <li><a href="#discount" data-toggle="tab"><b>Chiết khấu</b></a></li>
  		</ul>
	  	<div class="tab-content">
	      	<div id="info_account" class="tab-pane">
		      	<span class="pull-right btn-create">
		            <a href="#" title="Chỉnh sửa thông tin đại lý/ ctv" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-success edit_modal_info_account"><i class="glyphicon glyphicon-edit"></i></a>
		        </span>  
				<table class="table table-bordered table-edit-tab">
			        <tbody>
			            <tr>
			                <th class="th_table_account">Tên đầy đủ</th><td class="table_account_fullname"><?php echo $account_info['fullname'] ?> </td>
			                <th class="th_table_account">MSDN</th><td class="table_account_msdn"> <?php echo $account_info['msdn'] ?></td>
			            </tr>
			           
			            <tr>
			                <th class="th_table_account">Người đại diện</th><td class="table_account_director"> <?php echo $account_info['director'] ?></td>
			                <th class="th_table_account">Ngày thành lập</th><td class="table_account_datefounded"> <?= $datefounded ?></td>
			            </tr>
			            <tr>
			                <th class="th_table_account">Email</th><td class="table_account_email"><?php echo $account_info['email'] ?></td>
			                <th class="th_table_account">Điện thoại</th><td class="table_account_phone"><?php echo $account_info['phone'] ?></td>
			            </tr>
			            <tr> 
			            	<th class="th_table_account" >Địa chỉ</th><td class="table_account_address" colspan="3"> <?php echo $account_info['address'] ?></td>
			            </tr>

			            <tr>
			                <th class="th_table_account">Tài khoản ngân hàng</th><td class="table_account_bank_acc"><?php echo $account_info['bank_acc'] ?> </td>
			                <th class="th_table_account">Chi nhánh</th><td class="table_account_bank_address"> <?php echo $account_info['bank_address'] ?> </td>
			            </tr>
			           <tr>
			                <th class="th_table_account">Tên ngân hàng</th><td class="table_account_bank_name" colspan="3"> <?php echo $account_info['bank_name'] ?></td>
			            </tr>
			           <tr>
			                <th class="th_table_account">Mô tả thêm</th><td class="table_account_description" colspan="3"> <?php echo $account_info['description'] ?></td>
			            </tr>
			        </tbody>
			    </table>
		    </div>
		    <!-- end tab info -->
	      	<div id="raccount_user" class="tab-pane">
				<p class="title_info_role"> <b>Danh sách người dùng</b>
				<div class="margin-top-bot pull-right"> <button class="btn btn-primary" data-toggle="modal" data-target="#modal_add_new_user">Thêm mới</button> </div>
			    <table id="list_user" class="list_info_user table table-bordered table-edit-tab list_user_class"></table>
			  
		    </div>
		    <!-- end tab account user -->
		    
	      	<div id="discount" class="tab-pane">
				<span class="pull-right btn-create">
		            <a href="#" title="Chỉnh sửa thông tin chiết khấu" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-success add_new_cooperator_info"><i class="glyphicon glyphicon-edit"></i></a>
		        </span>
				<!-- <div class="add_discount_margin pull-right"> <button class="btn btn-primary add_new_cooperator_info">Thêm mới</button> </div> -->
<!-- 				<?php //if($data_account_discount) {?> -->
				       <table class="table table-bordered table-edit-tab">
						    <tbody>
						    	<?php if($data_account_discount){?>
							       <tr>
						                <th class="th_table_account">Số lượng cam kết</th><td class="table_service_count"><?php echo $data_account_discount['service_count'] ?> </td>
						                <th class="th_table_account">Chiết khấu cấp mới</th><td class="table_discount_new"> <?php echo $data_account_discount['discount_new'] ?></td>
						            </tr>
						           
						            <tr>
						                <th class="th_table_account">Chiết khấu gia hạn</th><td class="table_discount_renew"> <?php echo $data_account_discount['discount_renew'] ?></td>
						                <th class="th_table_account">Chiết khẩu chuyển đổi</th><td class="table_discount_tranf"> <?= $data_account_discount['discount_tranf'] ?></td>
						            </tr>
						            <tr>
						                <th class="th_table_account">Phạt không hoàn thành</th><td class="table_discount_file_customer"><?php echo $data_account_discount['discount_file_customer'] ?></td>
						                <th class="th_table_account">Phạt hồ sơ</th><td class="table_discount_service_count"><?php echo $data_account_discount['discount_service_count'] ?></td>
						            </tr>
					        </tbody>
						      	<?php } ?>
						    </tbody>
						  </table>
		    </div>
					    <!-- start modal add discount -->
			<div class="modal fade" id="modal_add_new_discount" role="dialog" data-backdrop="static" data-keyboard="false">
					<div class="modal-dialog modal-lg">
						    <div class="modal-content">
						        <div class="modal-header">
						          <button type="button" class="close" data-dismiss="modal">&times;</button>
						          <h3 class="modal-title text-center">Thông tin chiết khấu</h3>
						        </div>
						        <div class="modal-body1" style="height: 350px;">
						            <?php $form = ActiveForm::begin(['id' => 'frm_add_discount', 'options' => ['data-pjax' => true ]]); ?>
			   
									    <div class="col-xs-12 padding-left-0 padding-right-0">
									        <?= $form->field($data_account_discount, 'service_count',['options' => ['class' => 'col-xs-6 check_error']])->textInput()->label('Số lượng cam kết<span class="required_data"> *</span>') ?>

									        <?= $form->field($data_account_discount, 'discount_new',['options' => ['class' => 'col-xs-6 check_error']])->textInput()->label('Chiết khấu cấp mới<span class="required_data"> *</span>')?>
									    </div>

									     <div class="col-xs-12 padding-left-0 padding-right-0">
									        <?= $form->field($data_account_discount, 'discount_renew',['options' => ['class' => 'col-xs-6 check_error']])->textInput()->label('Chiết khấu gia hạn<span class="required_data"> *</span>') ?>

									        <?= $form->field($data_account_discount, 'discount_tranf',['options' => ['class' => 'col-xs-6 check_error']])->textInput()->label('Chiết khấu chuyển đổi<span class="required_data"> *</span>')?>
									    </div>

									     <div class="col-xs-12 padding-left-0 padding-right-0">
									        <?= $form->field($data_account_discount, 'discount_file_customer',['options' => ['class' => 'col-xs-6 check_error']])->textInput()->label('Phạt số lượng cam kết<span class="required_data"> *</span>') ?>

									        <?= $form->field($data_account_discount, 'discount_service_count',['options' => ['class' => 'col-xs-6 check_error']])->textInput()->label('Phạt hồ sơ<span class="required_data"> *</span>')?>
									    </div>
									<?php ActiveForm::end(); ?>
									   <div class="col-xs-12">
									        <div class="form-group pull-right">
									            <button type="button" class="btn btn-default hide_close" data-dismiss="modal">Đóng</button>
						          				<button type="button" class="btn btn-primary add_new_discount_by_account">Lưu</button>
									        </div>
									    </div>
										
									
						        </div>		        
						      </div>
						</div>
				</div>
			<!-- end modal add discount -->
		    <!-- end tab discount-->
		</div>
	</div>
</div>

<div class="modal fade show_user_info_modal" id="show_modal_edit_info_account" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="padding:20px 20px;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 style="text-align: center; font-size: 20;"><span class="glyphicon glyphicon-edit" ></span> Chỉnh sửa thông tin đại lý / cộng tác viên</h4>
            </div>
            
            <div class="modal-body col-md-12">
            	<div class="user-form">
					<form id="user_form" action="#" method="post" enctype="multipart/form-data" >
						<input type="hidden" name="_csrf" value="dHpaczc2Y3YFNyI6AgIhDgYUE0JlXBYZGSkuHUBROQ8BNwojRAcAKQ==">  

						<div class="padding-left-0  field-user-fullname required col-xs-8">
							<label class="control-label" for="">Tên đầy đủ<span class="required_data"> *</span></label>
							<span class="pop_show_hide_fullname">
							<input type="text" id="account_fullname" class="form-control my_fullname btn-open-popover" name="" value="" required="" aria-required="true" >
							</span><div id="has-error-fullname" class="help-block has-error has-error-fullname hide ">Tên đầy đủ không được trống</div>
						</div>
						<div class=" field-user-email required col-xs-4 padding-right-0">
							<label class="control-label" for="email">MSDN<span class="required_data"> *</span></label>
							<span class="pop_show_hide_email">
							<input type="text" id="account_msdn" class="form-control my_email" name="" value="" required="" aria-required="true">
							</span>
							<div id="has-error-msdn" class="help-block has-error has-error-msdn hide">Mã số doanh nghiệp không được trống</div>
						</div>
						
						<div class="padding-left-0  required col-xs-8">
							<label class="control-label" for="">Người đại diện</label>
							<span class="pop_show_hide_director">
							<input type="text" id="account_director" class="form-control my_director btn-open-popover" name="" value="" required ="" aria-required="true" >
							</span><div class="help-block"></div>
						</div>

						<div class="col-xs-4 padding-right-0">
							<?php  echo '<label class="control-label">Ngày thành lập</label>';
								echo DatePicker::widget([
								    'name' => '',
								    'type' => DatePicker::TYPE_COMPONENT_APPEND,
								    'options' => [
										'value' => '',
										'placeholder' => '--- Lựa chọn ngày ---',
										'id' => 'account_datefounded',
										],
								    'language' => 'en',
								    'pluginOptions' => [
								        'autoclose'=>true,
								        'format' => 'dd-mm-yyyy'
								    ]
								]);
							   ?>
						</div>
						<div class="padding-left-0 padding-right-0 col-md-12">
							<div class="col-xs-8 padding-left-0  required">
								<label class="control-label" for="">Email</label>
								<input type="text" id="account_email" class="form-control" name="" value="" aria-required="true">
								<div id="has-error-email" class="help-block has-error has-error-email hide">Email không đúng định dạng</div>
							</div>
							<div class="col-xs-4 padding-right-0">
								<label class="control-label" for="">Số điện thoại</label>
								<input type="text" id="account_phone" class="form-control" name="" value="" aria-required="true">
								<div id="has-error-phone" class="help-block has-error has-error-phone hide">Số điện thoại không đúng định dạng</div>
							</div>
						</div>
						<div class="col-xs-12 padding-right-0 padding-left-0  field-user-address required">
							<label class="control-label" for="">Địa chỉ</label>
							<input type="text" id="account_address" class="form-control" value="">
							<div class="help-block"></div>
						</div>
						
						<div class="padding-left-0 padding-right-0 col-md-12">
							<div class="col-xs-6 padding-left-0  required">
								<label class="control-label" for="">Tài khoản ngân hàng</label>
								<input type="text" id="account_bank_acc" class="form-control" name="" value="" aria-required="true">

								<div class="help-block"></div>
							</div>
							<div class="col-xs-6 padding-right-0  required">
								<label class="control-label" for="">Chi nhánh</label>
								<input type="text" id="account_bank_address" class="form-control" name="" value="" aria-required="true">

								<div class="help-block"></div>
							</div>
						</div>
						<div class="col-xs-12 padding-right-0 padding-left-0  field-user-address required">
							<label class="control-label" for="">Tên ngân hàng</label>
							<input type="text" id="account_bank_name" class="form-control " value="">
							<div class="help-block"></div>
						</div>
						<div class="col-xs-12 padding-right-0 padding-left-0  field-user-address required">
							<label class="control-label" for="">Mô tả thêm</label>
							<textarea type="text" rows="4" id="account_description" class="form-control " value=""></textarea>
							<div class="help-block"></div>
						</div>
					
						<div class=" pull-right">
					        <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Đóng</button> 
							<span>&nbsp;</span>
					        <button type="button" class="btn btn-primary confirm_save_btn">Cập nhật</button>  
					    </div>

					</form>
				</div>
        	</div>
        	<div class="modal-footer"></div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
	$(".edit_modal_info_account").click(function(){
		$("#datepicker").datepicker();
        $("#show_modal_edit_info_account").modal();
        var id = '<?php echo $account_id ?>';
        load_info_agency_update(id);
    })
    // validate email
    function validateEmail(email) {
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(email);
		}
    // lưu info user
   	$(".confirm_save_btn").click(function(){
   		var account_id = '<?php echo $account_id ?>';
   		var account_fullname = $.trim($('#account_fullname').val());
   		var account_msdn = $.trim($('#account_msdn').val());
   		var account_director = $.trim($('#account_director').val());
   		var account_datefounded = $.trim($('#account_datefounded').val());
   		var account_email = $.trim($('#account_email').val());
   		var account_phone = $.trim($('#account_phone').val());
   		var account_address = $.trim($('#account_address').val());
   		var account_bank_acc = $.trim($('#account_bank_acc').val());
   		var account_bank_address = $.trim($('#account_bank_address').val());
   		var account_bank_name = $.trim($('#account_bank_name').val());
   		var account_description = $.trim($('#account_description').val());

   		// validate data
	    if (account_fullname  === '') { 
	    	$(".has-error-fullname").removeClass('hide');
	        return false;
	    }else{
	    	$(".has-error-fullname").addClass('hide');
	    }

	    if (account_msdn  === '') { 
	    	$(".has-error-msdn").removeClass('hide');
	        return false;
	    }else{
	    	$(".has-error-msdn").addClass('hide');
	    }
	    if (account_email  !== '' && !validateEmail(account_email)) {
		    $(".has-error-email").removeClass('hide');
	        return false;
		}else{
			$(".has-error-email").addClass('hide');
		}
		var isnum = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im.test(account_phone);
	    if (account_phone  !== '' && !isnum)
	    {
	    	$(".has-error-phone").removeClass('hide');
	        return false;
	    }else{
	    	$(".has-error-phone").addClass('hide');
	    }

	    //save
	    $.ajax({
            method: "POST",
            url: '<?php echo $base_url ?>users/agency/update_info_agency',
            data: { 'account_id' : account_id, 'account_fullname' : account_fullname, 'account_msdn' : account_msdn, 'account_director' : account_director, 'account_datefounded' : account_datefounded, 'account_email' :  account_email, 'account_phone' : account_phone, 'account_address' : account_address, 'account_bank_acc': account_bank_acc, 'account_bank_address' : account_bank_address, 'account_bank_name' : account_bank_name, 'account_description' : account_description },
            async: true,
            success: function(result) {
                load_info_agency(result);
                $('#show_modal_edit_info_account').modal('hide');
                $("#modal-success_update").modal("show");
	                window.setTimeout(function () {
	                  	$("#modal-success_update").modal("hide");
	            }, 2000);
            },
        });

    });
    function load_info_agency(data){
        var data = jQuery.parseJSON(data);
        $('.table_account_fullname').html(data[0]['fullname']);
        $('.table_account_msdn').html(data[0]['msdn']);
        $('.table_account_director').html(data[0]['director']);
        $('.table_account_email').html(data[0]['email']);
        $('.table_account_phone').html(data[0]['phone']);
        $('.table_account_address').html(data[0]['address']);
        $('.table_account_bank_acc').html(data[0]['bank_acc']);
        $('.table_account_bank_name').html(data[0]['bank_name']);
        $('.table_account_bank_address').html(data[0]['bank_address']);
        $('.table_account_description').html(data[0]['description']);
        if (data[0]['datefounded'] == '0') {
        	var datefounded = '';
        }else{
        	var str = data[0]['datefounded'].toString();
        	var datefounded = str.substr(6, 2) + '-' + str.substr(4, 2) + '-' + str.substr(0, 4);
        }
        $('.table_account_datefounded').html(datefounded);
	}
	function load_info_agency_update(id){

			$.ajax({
	            method: "POST",
	            url: '<?php echo $base_url ?>users/agency/get_info_agency_byid',
	            data: { 'account_id' : id },
	            async: true,
	            success: function(result) {
		            if (result != '') {
		            	var data = jQuery.parseJSON(result);
		                $("#account_fullname").val(data[0]['fullname']);
		                $("#account_msdn").val(data[0]['msdn']);
		                $("#account_director").val(data[0]['director']);
		                $("#account_email").val(data[0]['email']);
		                $("#account_phone").val(data[0]['phone']);
		                $("#account_address").val(data[0]['address']);
		                $("#account_bank_acc").val(data[0]['bank_acc']);
		                $("#account_bank_address").val(data[0]['bank_address']);
		                $("#account_bank_name").val(data[0]['bank_name']);
		                $("#account_description").val(data[0]['description']);

		                if (data[0]['datefounded'] == '0') {
		                	var datefounded = '';
		                }else{
		                	var str = data[0]['datefounded'].toString();
		                	var datefounded = str.substr(6, 2) + '-' + str.substr(4, 2) + '-' + str.substr(0, 4);
		                }
		                $('#account_datefounded').val(datefounded);
	                }
	            },
	        });
		}

});
</script>
<div class="modal fade" id="modal-success_update" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header-success" >
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="text-success-modal"><span class="glyphicon glyphicon-ok"></span> Cập nhật thành công</h3>
            </div>
        </div>

    </div>
</div>


<script>
// hiển thị danh sách người dùng thuộc đại lý
<?php if($list_user){ ?>
	var obj_list_user = <?php echo $list_user ?>;
<?php }else{ ?> 
	var obj_list_user = '';
<?php } ?>
$(document).ready(function() {
	var table;
	$.fn.dataTable.ext.errMode = 'none';
	var rowNode;
    var table = $('#list_user').DataTable( {
        data: obj_list_user,
        columns: [
            { 
            	title: "STT",
            	className: "stt_view_list_per",
        	},
            { 
            	title: "Tên đăng nhập",
            },
            { title: "Tên hiển thị" },
            { title: "Vai trò" },
            {
            	title: "",
            	data: null,
            	defaultContent: "<button class='btn btn-danger btn-default pull-left'>Xóa</button>"
            }
        ],
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Vietnamese.json",
        }
    });

    $('#list_user tbody').on( 'click', 'button', function () {
        var data = table.row( $(this).parents('tr') ).data();
        rowNode = $(this).parents('tr');
        var id_acc_asign = data[1];
        $("#modal-delete_user").modal();
        $('.id_delete_user_inmodal_div').empty().append(id_acc_asign);
    });
   
	//


	//submit delete
	$('#confirm_delete_user').click(function(){
        var id_delete = $('.id_delete_user_inmodal_div').text();
        var account_id = '<?php echo $account_id ?>';
        $.ajax({
            method: "POST",
            url: '<?php echo $base_url ?>users/agency/delete_user_assign',
            data: { 'username' : id_delete,
            		'account_id' : account_id
        		},
        	dataType: "json",
            async: true,
            success: function(result) {
            	var t = $('#list_user').DataTable();
				t.destroy();
            	$('#list_user').DataTable({
				    data: result,
				    columns: [
				        { 
				            title: "STT",
				           	className: "stt_view_list_per",
				       	},
				        { title: "Tên đăng nhập",},
				        { title: "Tên hiển thị" },
				        { title: "Vai trò" },
				        {
				           title: "",
				            data: null,
				            defaultContent: "<button class='btn btn-danger btn-default pull-left'>Xóa</button>"
				         }
				        ],
				        "language": {
				        	"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Vietnamese.json",
				        }
				    });
            	$('#grid_user_new').yiiGridView('applyFilter');	
            },
        });
    });

	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		  var target = $(e.target).attr("href");
		  if (target == '#raccount_user') 
		  	{
		  		$('.dataTables_length').addClass("hide");
				$('#list_user_filter').addClass("pull-left");	
		  	}
	});

	$('.submit_add_new_user_agency').on('click', function(){
		var checkbox = document.getElementsByClassName('check_id_user');
		var id = '<?php echo $account_id ?>';
		var arr_checked = new Array();
            for(var i=0; checkbox[i]; ++i)
                {
                      if(checkbox[i].checked)
                      {
                           arr_checked.push(checkbox[i].value);
                      }
                }
        if (typeof(arr_checked) != 'undefined') 
        	{
        		$.ajax({
        			method: 'POST',
        			url: '<?php echo $base_url ?>users/agency/add_new_user_by_account',
        			data: {'data' : arr_checked, 'account' : id},
        			async: true,
        			dataType: "json",
        			success: function(result){
	        			var table = $('#list_user').DataTable();
				    	table.destroy();
				        $('#list_user').DataTable( {
				        data: result,
				        columns: [
				            { 
				            	title: "STT",
				            	className: "stt_view_list_per",
				        	},
				            { 
				            	title: "Tên đăng nhập",
				            },
				            { title: "Tên hiển thị" },
				            { title: "Vai trò" },
				            {
				            	title: "",
				            	data: null,
				            	defaultContent: "<button class='btn btn-danger btn-default pull-left'>Xóa</button>"
				            }
				        ],
				        "language": {
				        	"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Vietnamese.json",
				        }
				    } );

				      	$('#grid_user_new').yiiGridView('applyFilter');	
			    }
        		});
        	}
	});

	// Thêm/ sửa chiết khấu theo đại lý
	$('.add_new_cooperator_info').on('click', function(){
		$('#modal_add_new_discount').modal('show',{refresh: true});
		
	});

	$('.add_new_discount_by_account').on('click', function(){
			var account_id = '<?php echo $account_id ;?>' ;
			var service_count = $.trim($('#discount-service_count').val());
			var discount_new = $.trim($('#discount-discount_new').val());
			var discount_renew = $.trim($('#discount-discount_renew').val());
			var discount_tranf = $.trim($('#discount-discount_tranf').val());
			var discount_file_customer = $.trim($('#discount-discount_file_customer').val());
			var discount_service_count = $.trim($('#discount-discount_service_count').val());
		if(service_count == ''){
			$('.field-discount-service_count').addClass('has-error');
			$('.field-discount-service_count .help-block').html('Số lượng cam kết không được trống');

		}
		if(discount_new == ''){
			$('.field-discount-discount_new').addClass('has-error');
			$('.field-discount-discount_new .help-block').html('Chiết khấu cấp mới không được trống');
		}
		if(discount_renew == ''){
			$('.field-discount-discount_renew').addClass('has-error');
			$('.field-discount-discount_renew .help-block').html('Chiết khấu gia hạn không được trống');

		}
		if(discount_tranf == ''){
			$('.field-discount-discount_tranf').addClass('has-error');
			$('.field-discount-discount_tranf .help-block').html('Chiết khấu chuyển đổi không được trống');
		}
		if(discount_file_customer == ''){
			$('.field-discount-discount_file_customer').addClass('has-error');
			$('.field-discount-discount_file_customer .help-block').html('Phạt số lượng cam kết không được trống');
		}
		if(discount_service_count == ''){
			$('.field-discount-discount_service_count').addClass('has-error');
			$('.field-discount-discount_service_count .help-block').html('Phạt hồ sơ không được trống');
		}

		var check = $('.check_error ').attr('class');
		if (check.indexOf('has-error') == -1) 
			{
				$.ajax({
					method: "POST",
					url: '<?php echo $base_url ?>users/agency/create_new_discount_by_account',
					data: {'account_id': account_id, 'service_count': service_count, 'discount_new': discount_new, 'discount_renew': discount_renew, 'discount_tranf': discount_tranf, 'discount_file_customer' : discount_file_customer, 'discount_service_count': discount_service_count},
					async: true,
					success: function(result){
						var obj = JSON.parse(result);
						$('.table_service_count').html(obj[0]['service_count']);
				        $('.table_discount_new').html(obj[0]['discount_new']);
				        $('.table_discount_renew').html(obj[0]['discount_renew']);
				        $('.table_discount_tranf').html(obj[0]['discount_tranf']);
				        $('.table_discount_file_customer').html(obj[0]['discount_file_customer']);
				        $('.table_discount_service_count').html(obj[0]['discount_service_count']);
				        $('#modal_add_new_discount').modal('hide');
				        $('.check_error ').removeClass('has-success');
				        $("#modal-success_update").modal("show");
			                window.setTimeout(function () {
			                  	$("#modal-success_update").modal("hide");
			            }, 2000);
			            $('#modal_add_new_discount').on('hidden', function() {
			                $(this).removeData('modal');
			            });

					}
				});
			}
		else
		{
			return false;
		}
		
	});

	$('.hide_close').on('click', function (){
		 location.reload();
		});

});
	
</script>
<!-- Modal show delete  user-->
    <div class="modal fade" id="modal-delete_user" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="padding:30px 25px;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 style="text-align: center; font-size: 20;"><span class="glyphicon glyphicon-lock" ></span> Bạn có chắc chắn muốn xóa bản ghi ?</h4>
                </div>
                <div class="id_delete_user_inmodal_div hide" ></div>
                <div class="modal-footer" style="margin-left: 30%; ">
                    <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Đóng</button> 
                    <button type="button" id="confirm_delete_user" class="btn btn-primary btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-trash"></span> Xóa</button>
                </div>
            </div>
        </div>
    </div>

<!-- modal add new agency for user -->
	<div class="modal fade" id="modal_add_new_user" role="dialog">
		<div class="modal-dialog modal-lg">
			    <div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h3 class="modal-title text-center">Thêm mới người dùng</h3>
			        </div>
			        <div class="modal-body">
			        <?php \yii\widgets\Pjax::begin(); ?>
			            <?= GridView::widget([
			                'dataProvider' => $dataProvider,
			                'id'=> 'grid_user_new',
			                'options' => ['class' => 'grid_view_options'],
			                'summary' => "<div class='summary'>Hiển thị <b>{begin}</b> - <b>{end}</b> trên <b>{totalCount}</b> bản ghi<div>",
			                'emptyText' => 'Không có bản ghi !',
			                'columns' => [
				                [
					                'attribute' => 'username',
					                'format' => 'raw',
					                'label'=> 'Tên đăng nhập',
					                'headerOptions' => ['class' => 'text-center text-headerOptions'],
					                'contentOptions' => ['class'=>'word-wrap-new', 'style'=>'width:30%;',],
				                ],

				                [
					                'attribute' => 'userdisplay',
					                'format' => 'raw',
					                'label'=> 'Tên hiển thị',
					                'headerOptions' => ['class' => 'text-center text-headerOptions'],
					                'contentOptions' => ['class'=>'word-wrap-new', 'style'=>'width:30%;',],
				                ], 

				                [
					                'attribute' => 'description',
					                'format' => 'raw',
					                'label'=> 'Vai trò',
					                'headerOptions' => ['class' => 'text-center text-headerOptions'],
					                'contentOptions' => ['class'=>'word-wrap-new', 'style'=>'width:30%;',],
				                ], 

				                [   
					                'class' => 'yii\grid\ActionColumn',
					                'template' => '{check}',
					                'header'=>'Chọn',
					                'headerOptions' => ['class' => 'text-center'],
					                'contentOptions' => ['class'=>'word-wrap-new text-center', 'style'=>'width:10%;',],
					                'buttons' => [
					                'check' => function ($url, $model) {
					                    return Html::checkbox(
					                      'span',
					                      '',
					                      ['class' => 'check_id_user', 'value' => $model['id'],'title' => 'Chọn người dùng']
					                      );
					                },
					                ],
				                ],

			                ],

			            ]);?>
			       
			        </div>		        
			      </div>
			     <div class="modal-footer">
			          	<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
			          	<button type="button" class="btn btn-primary submit_add_new_user_agency" data-dismiss="modal">Thêm mới</button>
			     </div>
			     <?php \yii\widgets\Pjax::end(); ?>
			</div>
	</div>
	<!-- end modal add user -->
