<?php
namespace backend\modules\product\views\products;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use backend\components\ComponentBase;
use kartik\export\ExportMenu;
use Yii;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\product\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách sản phẩm';
$this->params['breadcrumbs'][] = $this->title;
$arr = array('0' => '10', '1' => '15', '2' => '20', '3' => '30',
    '4' => '50');
$components = new ComponentBase();
$base_url = $components->Base_url();

?>
<div class="products-index">

    <div>
        <section class="content-header">
            <h1 class="add-color-content-header">
                Danh sách sản phẩm
            </h1>
        </section>
    </div>
    <div class="search-in-category">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    
    <!-- Xuất excel -->
    <?php
    $gridColumns = [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => 'STT',
            ],
            [
                'attribute' => 'code',
            ],
            [
                'attribute' => 'title',
            ],
        ];
    ?>
    <div class="pull-right">
        <?= ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns,
            'target'=>'_self',
            'filename'=>'Danh sách sản phẩm',
            'dropdownOptions' => [
                'label' => 'Export',
                'class' => 'btn btn-primary',
                'title'=> 'Xuất dữ liệu',
                'encoding'=> 'utf8'
            ],
            'showColumnSelector'=>true,
            'columnSelectorOptions' =>[
                'class' => 'btn btn-primary',
                'title' => 'Cột muốn xuất',
            ],
            'columnBatchToggleSettings' => [
                'label' => 'Tất cả',
            ],
            'showConfirmAlert'=> false,
            'exportConfig' => [
                ExportMenu::FORMAT_TEXT => false,
                ExportMenu::FORMAT_PDF => false,
                ExportMenu::FORMAT_HTML  => false,
            ],
        ]);
        ?>
        <?php  if( Yii::$app->user->can('ADD_DISTRICT')){ ?>

        <?= Html::a(' + Thêm', ['create'], ['class' => 'btn btn-primary']) ?>
        <?php } ?>
        
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
                'attribute' => 'code',
                'headerOptions' => ['class' => 'text-center text-headerOptions'],
                'contentOptions' => ['class' => 'word-wrap-new', 'style' => 'width:10%;',],
            ],
            [
                'attribute' => 'title',
                'headerOptions' => ['class' => 'text-center text-headerOptions'],
                'contentOptions' => ['class' => 'word-wrap-new', 'style' => 'width:20%;',],
            ],
            [
                'attribute' => 'categories_id',
                'value' => 'category.title',
                'headerOptions' => ['class' => 'text-center text-headerOptions'],
                'contentOptions' => ['class' => 'word-wrap-new', 'style' => 'width:20%;',],
            ],

            [
                'attribute' => 'provider_id',
                'value' => 'maker.name',
                'headerOptions' => ['class' => 'text-center text-headerOptions'],
                'contentOptions' => ['class' => 'word-wrap-new', 'style' => 'width:20%;',],
            ],
            [
            'attribute' => 'publish',
            'headerOptions' => ['class' => 'text-center text-headerOptions'],
            'contentOptions' => ['class'=>'word-wrap-new text-center', 'style'=>'width:10%;',],
            'enableSorting' => false,
            'format'=>'raw',
            'value'=>function($row){
                 $values=[
                        '1'=>'label label-success status_category'.$row['id'],
                        '2'=>'label label-warning status_category'.$row['id'],
                        ''=>'label label-warning status_category'.$row['id'],
                        '0'=>'label label-warning status_category'.$row['id'],
                     ];
                    if ($row['publish'] == '1') {
                        $publish_name = 'Hiển thị';
                    }else{
                        $publish_name = 'Không hiển thị';
                    }
                    return Html::tag('span', $publish_name , ['class' => $values[$row['publish']]]);
                },
            ],
            [
            'attribute' => 'is_stock',
            'headerOptions' => ['class' => 'text-center text-headerOptions'],
            'contentOptions' => ['class'=>'word-wrap-new text-center', 'style'=>'width:10%;',],
            'enableSorting' => false,
            'format'=>'raw',
            'value'=>function($row){
                 $values=[
                        '1'=>'label label-success status_category'.$row['id'],
                        '2'=>'label label-warning status_category'.$row['id'],
                        ''=>'label label-warning status_category'.$row['id'],
                        '0'=>'label label-warning status_category'.$row['id'],
                     ];
                    if ($row['is_stock'] == '1') {
                        $is_stock_name = 'Còn hàng';
                    }else{
                        $is_stock_name = 'Hết hàng';
                    }
                    return Html::tag('span', $is_stock_name , ['class' => $values[$row['is_stock']]]);
                },
            ],

            [   
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'header'=>'',
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class'=>'word-wrap-new text-center', 'style'=>'width:7%;',],
                'buttons' => [
                    // 'view' => function ($url, $model) {
                    //   if( Yii::$app->user->can('VIEW_PROVINCE')){
                    //     return Html::a(
                    //         '<span class="glyphicon glyphicon-eye-open"></span>',
                    //         $url,['title' => 'Xem']);
                    //   }
                    //   else
                    //     {
                    //       return '';
                    //     }
                    // },
                    'update' => function ($url, $model) {
                      if( Yii::$app->user->can('EDIT_PROVINCE')){
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
                      if( Yii::$app->user->can('DELETE_PROVINCE')){
                        return Html::a(
                          '',
                          $url = '#',
                          ['class' => 'glyphicon glyphicon-trash confirm_delete_province add-color-content-header', 'id' => $model->id,'title' => 'Xóa']
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
