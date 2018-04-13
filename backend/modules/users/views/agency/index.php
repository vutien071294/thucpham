<?php
namespace backend\modules\users\views\agency;
use yii\helpers\Html;
use yii\grid\GridView;
use backend\components\ComponentBase;
use kartik\export\ExportMenu;
use yii\widgets\ActiveForm;
use Yii;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\users\models\AgencySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Đại lý/ CTV';
$this->params['breadcrumbs'][] = $this->title;
$arr = array('0' => '10' , '1' => '15', '2'=> '20', '3' => '30','4' => '50');
$components = new ComponentBase();
$base_url = $components->Base_url();
?>
<div class="agency-index">

    <div class="authitem-index">
    <div>
        <section class="content-header">
            <h1 class="add-color-content-header">
            Quản lý đại lý và CTV
            </h1>
        </section>
    </div>
    <div class="search-in-category">
        <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <div class="pull-right">
        <?php if(Yii::$app->user->can('ADD_ACCOUNT')){?>
        <?= Html::a(' + Thêm', ['create'], ['class' => 'btn btn-primary']) ?>
        <?php } ?>
    </div>

    <?= GridView::widget([
        'pager' => [
            'firstPageLabel' => 'First',
            'lastPageLabel' => 'Last',
        ],
        'dataProvider' => $dataProvider,
        'summary' => "<div class='summary'>Hiển thị <b>{begin}</b> - <b>{end}</b> trên <b>{totalCount}</b> bản ghi<div>",
        'emptyText' => 'Không có bản ghi !',
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header'=>'STT',
                'headerOptions' => ['class' => 'text-center text-headerOptions'],
                'contentOptions' => ['class'=>'word-wrap-new', 'style'=>'width:3%;',],
            ],
            [
                'attribute' => 'account_code',
                'headerOptions' => ['class' => 'text-center text-headerOptions'],
                'contentOptions' => ['class'=>'word-wrap-new', 'style'=>'width:15%;',],
            ],
            [
                'attribute' => 'account_name',
                'headerOptions' => ['class' => 'text-center text-headerOptions'],
                'contentOptions' => ['class'=>'word-wrap-new', 'style'=>'width:15%;',],
            ],
            [
                'attribute' => 'account_type',
                'headerOptions' => ['class' => 'text-center text-headerOptions'],
                'contentOptions' => ['class'=>'word-wrap-new', 'style'=>'width:15%;',],
                'format'=>'raw',
                'value'=>function($row){
                    $values=[
                        '1'=>'label label-success status_category'.$row['id'],
                        '2'=>'label label-primary status_category'.$row['id'],
                        '3'=>'label label-warning status_category'.$row['id'],
                    ];
                    if ($row['account_type'] == '1 ') {
                        $account_type = 'Đại lý';
                    }elseif($row['account_type'] == '2 ')
                    {
                        $account_type = 'Cộng tác viên';
                    }
                    elseif($row['account_type'] == '3')
                    {
                        $account_type = 'Kinh doanh';
                    }else{
                        $account_type = '';  
                    }
                    return Html::tag('span', $account_type , ['class' => $values[$row['account_type']]]);
                },
            ],
            [
                'attribute' => 'contract',
                'headerOptions' => ['class' => 'text-center text-headerOptions'],
                'contentOptions' => ['class'=>'word-wrap-new', 'style'=>'width:10%;',],
            ],
            [
                'attribute' => 'prepaid',
                'headerOptions' => ['class' => 'text-center text-headerOptions'],
                'contentOptions' => ['class'=>'word-wrap-new text-center-right', 'style'=>'width:10%;',],
                'format' => ['decimal',0], 
            ],
            [
                'attribute' => 'postpaid',
                'headerOptions' => ['class' => 'text-center text-headerOptions'],
                'contentOptions' => ['class'=>'word-wrap-new text-center-right', 'style'=>'width:10%;',],
                'format' => ['decimal',0], 
            ],

            [   
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'header'=>'',
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class'=>'word-wrap-new text-center', 'style'=>'width:7%;',],
                'buttons' => [
                'view' => function ($url, $model) {
                    if( Yii::$app->user->can('VIEW_ACCOUNT_ALL')){
                        return Html::a(
                        '<span class="glyphicon glyphicon-eye-open"></span>',
                        $url,['title' => 'Xem']);
                    }
                    else
                    {
                        return '';
                    }
                },
                'update' => function ($url, $model) {
                    if( Yii::$app->user->can('EDIT_ACCOUNT')){
                        return Html::a(
                        '<span class="glyphicon glyphicon-pencil"></span>',
                        $url,['title' => 'Cập nhật']);
                    }
                    else
                    {
                        return '';
                    }
                },
                'delete' => function ($url, $model) {
                    if( Yii::$app->user->can('DELETE_ACCOUNT')){
                        return Html::a(
                            '',
                            $url = '#',
                            ['class' => 'glyphicon glyphicon-trash confirm_delete_agency add-color-content-header', 'id' => $model->id,'title' => 'Xóa']
                        );
                    }
                    else
                    {
                        return '';
                    }
                },
                ],
            ],
        ],
    ]); ?>
</div>
<?php
$total=$dataProvider->getTotalCount();
if ($total>$records) {
?>
<div style="margin-top: -75px;">
    <?php
}else{
    ?>
    <div>
<?php
    }
?>
    <div class="pull-right Mypagination">
        <table>
            <tr>
                <td>
                    <div>
                        <p style="float: right; padding-top: 10px;">Kích thước trang: </p>
                    </div>
                </td>
            <td>
                <div>
                    <select style="width: 80px;  " id="pagination-number-new" class="form-control pull-right " onchange="selectpickerpages()" name="">
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
 <!-- Modal show delete  -->
    <div class="modal fade" id="confirm_delete_agency_modal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="padding:30px 25px;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 style="text-align: center; font-size: 20;"><span class="glyphicon glyphicon-lock" ></span> Bạn có chắc chắn muốn xóa bản ghi ?</h4>
                </div>
                <div class="id_delete_agency_inmodal_div hide" ></div>
                <div class="modal-footer" style="margin-left: 30%; ">
                    <button id="" style='margin-left: 5%;' type='submit' class='btn btn-primary btn-default pull-left confirm_delete_agency_btn'><span class='glyphicon glyphicon-trash' data-dismiss='modal'></span> Xóa </button>
                    <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal" style="margin-left: 5%;"><span class="glyphicon glyphicon-remove"></span> Đóng</button>
                    <div id="agency"></div>

                </div>
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
                  <h3 class="text-success-modal"><span class="glyphicon glyphicon-ok"></span></h3>
              </div>
          </div>

      </div>
    </div>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
      $(document).ready(function(){
         $(".confirm_delete_agency").click(function(){
            var id_agency = $(this).attr('id');
            $('.confirm_delete_agency_btn').attr('id',id_agency);
            $("#confirm_delete_agency_modal").modal();
            });

       $(".confirm_delete_agency_btn").click(function(){
          $("#confirm_delete_agency_modal").modal("hide");
          var id_delete = $(this).attr('id');
          console.log(id_delete);
          if (id_delete) 
            {
              $.ajax({
                method: 'POST',
                url: '<?php echo $base_url ?>users/agency/delete',
                data: { 'value' : id_delete},
                async: true,
                success: function(result){
                  if (result == 'success') 
                    {
                        $("#modal-success_delete").modal("show");
                        $('.text-success-modal').html('Xóa thành công');
                          window.setTimeout(function () {
                          $("#modal-success_delete").modal("hide");
                          location.replace('<?php echo $base_url ?>users/agency');
                        }, 2000);
                        
                    }
                  else
                    {
                        $("#modal-success_delete").modal("show");
                        $('.text-success-modal').html('Xóa không thành công');
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
    //xoa
  });
</script>