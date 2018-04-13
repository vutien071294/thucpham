<?php

use yii\helpers\Html;
use backend\components\ComponentBase;
use kartik\grid\GridView;
use backend\modules\product\models\Dmsanpham;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\product\models\DmsanphamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quản lý sản phẩm';
$this->params['breadcrumbs'][] = $this->title;
$arr = array('0' => '10' , '1' => '15', '2'=> '20', '3' => '30',
    '4' => '50' );
$components = new ComponentBase();
$base_url = $components->Base_url();

?>
<div class="quanlysanpham-index">

    <div>
        <section class="content-header">
            <h1 class="add-color-content-header">
                Quản lý sản phẩm
            </h1>
        </section>
    </div>

    <div class="pull-right">
        <p>
            <?= Html::a('Thêm', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>


    <?= GridView::widget([
       'id' => 'kv-grid-data',
        'dataProvider' => $dataProvider,
        'summary' => "<div class='summary'>Hiển thị <b>{begin}</b> - <b>{end}</b> trên <b>{totalCount}</b> bản ghi<div>",
        'emptyText' => 'Không có dữ liệu để hiển thị',
        'columns' => [
            [ 
                'class' => 'kartik\grid\SerialColumn',
                'header'=>'STT',
                'contentOptions' => ['class'=>'word-wrap-new', 'style'=>'width:3%;',],
            ],

            [
                'attribute' => 'cate_id',
                'header'=>'Sản phẩm',
                'value' => 'dmsanpham.title',
                'contentOptions' => ['class'=>'word-wrap-new', 'style'=>'width:20%;',],
            ],

            [
                'attribute' => 'title',
                'header'=>'Tiêu đề',
                'contentOptions' => ['class'=>'word-wrap-new', 'style'=>'width:20%;',],
            ],

            [
                'attribute' => 'size',
                'header'=>'Kích thước',
                'contentOptions' => ['class'=>'word-wrap-new', 'style'=>'width:15%;',],
            ],

            [
                'attribute' => 'image',
                'header'=>'Ảnh',
                'contentOptions' => ['class'=>'word-wrap-new', 'style'=>'width:20%;',],
                'format' => 'raw',
                'value'=> function($model){
                    $base_url = ComponentBase::Base_url_images();
                    return Html::img($base_url.'public/images/image_manage/' . $model['image'],
                        ['width' => '100%', 'height' => '100px']);
                },
            ],

            [
                'attribute' => 'price',
                'header'=>'Giá',
                'contentOptions' => ['class'=>'word-wrap-new', 'style'=>'width:15%;',],
            ],

            // [
            //     'attribute' => 'description',
            //     'header'=>'Mô tả',
            //     'contentOptions' => ['class'=>'word-wrap-new', 'style'=>'width:20%;',],
            //     'format' => 'raw',
            // ],

            [   
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
            'header'=>'',
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class'=>'word-wrap-new text-center', 'style'=>'width:7%;',],
            'buttons' => [
            'update' => function ($url, $model) {
              return Html::a(
                '<span class="glyphicon glyphicon-pencil"></span>',
                $url,['title' => 'Cập nhật']);
            },
             'delete' => function ($url, $model) {
                return Html::a(
                  '',
                  $url = '#',
                  ['class' => 'glyphicon glyphicon-trash confirm_delete_district confirm_delete add-color-content-header', 'id' => $model->id,'title' => 'Xóa']
                  );
              },

            ],
            ],
        ],
    ]); ?>
</div>
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
                    url: '<?php echo $base_url ?>product/quanlysanpham/delete',
                    data: { 'value' : id_delete},
                    async: true,
                    success: function(result){
                        if (result == 'success') 
                        {
                            $("#modal-success_delete").modal("show");
                            $('.text-success-modal').html('<span class="glyphicon glyphicon-ok-circle"></span> Xóa thành công');
                            window.setTimeout(function () {
                            $("#modal-success_delete").modal("hide");
                                location.replace('<?php echo $base_url ?>product/quanlysanpham');
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
