<?php
namespace backend\modules\product\views\product;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use backend\components\ComponentBase;
use kartik\export\ExportMenu;
use Yii;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\product\models\Product_typeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh mục menu';
$this->params['breadcrumbs'][] = $this->title;
$arr = array('0' => '10' , '1' => '15', '2'=> '20', '3' => '30',
    '4' => '50' );
$components = new ComponentBase();
$base_url = $components->Base_url();

?>
<div class="product-type-index">
    <div>
        <section class="content-header">
            <h1 class="add-color-content-header">
                Danh mục Menu
            </h1>
        </section>
    </div>
    <div class="pull-right">
        <p>
            <?= Html::a('Thêm', ['create'], ['class' => 'btn btn-primary']) ?>
        </p>
    </div>
    <div class="summary">Hiển thị <b><?php echo count($list_cate) ?></b> bản ghi </div>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class="text-center text-headerOptions">STT</th>
                <th class="text-center text-headerOptions"><a href="#">Tiêu đề</a></th>
                <th class="text-center">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($list_cate as $key => $value) { ?>
            <tr data-key="105">
                <td class="word-wrap-new" style="width:3%;"><?= $key + 1 ?></td>
                <td class="word-wrap-new" style="width:30%;"><?= $value[1] ?> </td>
                <td class="word-wrap-new text-center" style="width:7%;">
                    <a href="<?= $base_url ?>product/product_type/update?id=<?= base64_encode($value[0]) ?>" title="Cập nhật"><span class="glyphicon glyphicon-pencil"></span></a> 
                    <a id="<?= $value[0] ?>" class="glyphicon glyphicon-trash confirm_delete add-color-content-header" href="#" title="Xóa"></a>
                </td>
            </tr>
        <?php } ?>
            
        </tbody>
    </table>

    <!-- Modal show delete  -->
    <div class="modal fade" id="confirm_delete_modal" role="dialog" data-backdrop="false">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header modal_header-site">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="h4_fontsize-modal">
                    <span class="glyphicon glyphicon-warning"></span> <p  class="alert alert-warning alert-dismissible" role="alert">Xóa danh mục menu này sẽ xóa các danh mục menu con của nó và ảnh hưởng đến các dữ liệu đang sử dụng menu</p>
                    <hr>
                    <span class="glyphicon glyphicon-lock"></span> Bạn có
                        chắc chắn muốn xóa bản ghi ?</h4>
                </div>
                <div class="id_delete_district_inmodal_div hide"></div>
                <div class="modal-footer modal_footer-site">
                    <button type='submit' class='btn btn-primary btn-default pull-left confirm_delete_btn margin_modal-3'><span class='glyphicon glyphicon-trash'></span> Xóa </button>
                    <button type="submit" class="btn btn-danger btn-default pull-left margin_modal-5" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Đóng</button>
                    

                </div>
            </div>
        </div>
    </div>
    <!-- modal thong bao -->
    <div class="modal fade" id="modal-success_delete" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header-success" >
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h3 class="text-success-modal text-center"></h3>
              </div>
          </div>
      </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".confirm_delete").click(function(){
            var id_del = $(this).attr('id');
            $('.confirm_delete_btn').attr('id',id_del);
            $("#confirm_delete_modal").modal();
            });
        $(".confirm_delete_btn").click(function(){
            $("#confirm_delete_modal").modal("hide");
            var id_delete = $(this).attr('id');
            if (id_delete) 
            {
                $.ajax({
                    method: 'POST',
                    url: '<?php echo $base_url ?>product/product_type/delete',
                    data: { 'value' : id_delete},
                    async: true,
                    success: function(result){
                        if (result == 'success') 
                        {
                            $("#modal-success_delete").modal("show");
                            $('.text-success-modal').html('<span class="glyphicon glyphicon-ok-circle"></span> Xóa thành công');
                            window.setTimeout(function () {
                            $("#modal-success_delete").modal("hide");
                                location.replace('<?php echo $base_url ?>product/product_type');
                            }, 2000);
                    
                        }
                        else
                        {
                            $("#modal-success_delete").modal("show");
                            $('.text-success-modal').html('<span class="glyphicon glyphicon-remove-circle"></span> Xóa không thành công');
                            window.setTimeout(function () {
                            $("#modal-success_delete").modal("hide");
                            }, 2000);
                    

                        }
                    }

                });
            }
            else
            {
                return false;
            }
        });
    });    
</script>