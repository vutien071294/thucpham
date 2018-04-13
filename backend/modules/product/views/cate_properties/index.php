<?php
namespace backend\modules\product\views\product;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use backend\components\ComponentBase;
use kartik\export\ExportMenu;
use Yii;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\product\models\Cate_propertiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Thuộc tính của loại sản phẩm';
$this->params['breadcrumbs'][] = $this->title;
$arr = array('0' => '10' , '1' => '15', '2'=> '20', '3' => '30',
    '4' => '50' );
$components = new ComponentBase();
$base_url = $components->Base_url();

?>
<div class="cate-properties-index">
    <div>
        <section class="content-header">
            <h1 class="add-color-content-header">
                Thuộc tính của loại sản phẩm
            </h1>
        </section>
    </div>
    <div class="pull-right">
        <?php  //if( Yii::$app->user->can('ADD_DISTRICT')){ ?>
            <?= Html::a(' + Thêm', ['create'], ['class' => 'btn btn-primary']) ?>
        <?php //} ?>
    </div>
    <?= GridView::widget([
        'pager' => [
            'firstPageLabel' => 'Đầu',
            'lastPageLabel' => 'Cuối',
        ],
        'dataProvider' => $dataProvider,
        'summary' => "<div class='summary'>Hiển thị <b>{begin}</b> - <b>{end}</b> trên <b>{totalCount}</b> bản ghi<div>",
        'emptyText' => 'Không có bản ghi !',
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => '',
                'headerOptions' => ['class' => 'text-center text-headerOptions'],
                'contentOptions' => ['class' => 'word-wrap-new', 'style' => 'width:3%;',],
            ],
            [
                'attribute' => 'cate_id',
                'value' => 'categoryproduct.title',
                'headerOptions' => ['class' => 'text-center text-headerOptions'],
                'contentOptions' => ['class' => 'word-wrap-new', 'style' => 'width:20%;',],
            ],
            [
                'attribute' => 'name',
                'headerOptions' => ['class' => 'text-center text-headerOptions'],
                'contentOptions' => ['class' => 'word-wrap-new', 'style' => 'width:20%;',],
            ],
            [
                'attribute' => 'title',
                'headerOptions' => ['class' => 'text-center text-headerOptions'],
                'contentOptions' => ['class' => 'word-wrap-new', 'style' => 'width:20%;',],
            ],
            [
                'attribute' => 'value',
                'headerOptions' => ['class' => 'text-center text-headerOptions'],
                'contentOptions' => ['class' => 'word-wrap-new', 'style' => 'width:20%;',],
                'format' => 'raw',
                'value' => function($raw){
                    return nl2br($raw->value);
                }
            ],
            [
                'attribute' => 'isfilter',
                'headerOptions' => ['class' => 'text-center text-headerOptions'],
                'contentOptions' => ['class' => 'word-wrap-new', 'style' => 'width:10%;',],
                'format' => 'raw',
                'value' => function ($row) {
                    $values = [
                        '1' => 'label label-success status_category' . $row['id'],
                        '2' => 'label label-danger status_category' . $row['id'],
                        '' => 'label label-danger status_category' . $row['id'],
                    ];
                    if ($row['isfilter'] == '1') {
                        $status_name = 'Hiển thị';
                    } else {
                        $status_name = 'Không hiển thị';
                    }
                    return Html::tag('span', $status_name, ['class' => $values[$row['isfilter']]]
                    );
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'header' => '',
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'word-wrap-new text-center', 'style' => 'width:7%;',],
                'buttons' => [
                    'view' => function ($url, $model) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-eye-open"></span>',
                                $url, ['title' => 'Xem']);
                    },
                    'update' => function ($url, $model) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-pencil"></span>',
                                $url, ['title' => 'Cập nhật']);
                    },
                    'delete' => function ($url, $model) {
                            return Html::a(
                                '',
                                $url = '#',
                                ['class' => 'glyphicon glyphicon-trash confirm_delete add-color-content-header', 'id' => $model->id, 'title' => 'Xóa']
                            );
                    },

                ],
            ],
        ],
    ]); ?>
    <?php
    $total = $dataProvider->getTotalCount();
    if ($total > $records) {
    ?>
    <div style="margin-top: -75px;">
        <?php
        }else{
        ?>
        <div>
            <?php
            }
            ?>
            <div class="pull-right" style="margin-top: 14px">
                <table>
                    <tr>
                        <td>
                            <div>
                                <p style="float: right; padding-top: 10px;">Kích thước trang: </p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <select style="width: 80px;  " id="pagination-number-new"
                                        class="form-control pull-right " onchange="selectpickerpages()" name="">
                                    <?php
                                    foreach ($arr as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value ?>" <?php if ($records == $value) {
                                            ?>
                                            selected=""
                                            <?php
                                        }
                                        ?> ><?php echo $value ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script>
        function selectpickerpages() {
            var x = document.getElementById("pagination-number-new").value;
            $.ajax({
                method: "POST",
                url: '<?php echo $base_url ?>product/cate_properties/index',
                data: {record: x},
                async: true,
                success: function (result) {
                    document.open();
                    document.write(result);
                    document.close();
                },
            });
        }
    </script>

    <!-- Modal show delete  -->
    <div class="modal fade" id="confirm_delete_modal" role="dialog" data-backdrop="false">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header modal_header-site">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="h4_fontsize-modal"><span class="glyphicon glyphicon-lock"></span> Bạn có
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
                    url: '<?php echo $base_url ?>product/cate_properties/delete',
                    data: { 'value' : id_delete},
                    async: true,
                    success: function(result){
                        if (result == 'success') 
                        {
                            $("#modal-success_delete").modal("show");
                            $('.text-success-modal').html('<span class="glyphicon glyphicon-ok-circle"></span> Xóa thành công');
                            window.setTimeout(function () {
                            $("#modal-success_delete").modal("hide");
                                location.replace('<?php echo $base_url ?>product/cate_properties');
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