<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\modules\users\models\User;

/* @var $this yii\web\View */
/* @var $model backend\modules\users\models\Agency */
$this->title = 'Xem chi tiết đại lý/ ctv';
$this->params['breadcrumbs'][] = ['label' => 'Agencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$Users = new User();
if($model->creation_user){
    $name_creater = $Users->get_user_name($model->creation_user);
}
else
{
    $name_creater = '';
}
if($model->update_user){
    $name_editer = $Users->get_user_name($model->update_user);
}
else
{
    $name_editer = '';
}

$list_type = ['1'=>'Đại lý', '2'=>'Cộng tác viên', '3' => 'Kinh doanh'];
if ($model->account_type) {
    $account_type = $list_type[$model->account_type];
}else
{
    $account_type = $list_type[0];
}
$values=[
    '2'=>'label label-primary',
    '1'=>'label label-success',
    '3'=>'label label-warning',
];
if ($model->account_type) {
    $class = $values[$model->account_type];
}else
{
    $class = $values[0];
} 

?>
<div class="agency-view col-md-12" style="margin-left: 0%; margin-top:10px; padding: 20px;">
    
    <fieldset style="border: 1px solid #0093DD; border-radius: 10px; ">
    <legend style="text-align: center;  color: #0093DD; font-size: 15px;border-bottom: 0px; width: auto;"><h3 class="add-color-content-header"><?= Html::encode($this->title) ?></h3></legend>
    <div class="col-md-12" >
    <div class="col-md-6 padding-right-0" >
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'account_type',
                'format'=>'raw',    
                'value'=>Html::tag('span', $account_type, [ 'class' => $class]),
            ],
            'account_code',
            'account_name',
            'contract',
            [
                'attribute' => 'time',
                'format' => ['date', 'php:d-m-Y']
            ],
            [
                'attribute' => 'prepaid',
                'label' => 'Tài khoản trả trước (VND)',
                'format' => ['decimal',0], 
            ],
            [
                'attribute' => 'postpaid',
                'label' => 'Tài khoản trả sau (VND)',
                'format' => ['decimal',0], 
            ],
        ],
    ]) ?>
    </div>
    <div class="col-md-6 padding-left-0" >
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [ 
            [
                'attribute' => 'creation_time',
                'format' => ['date', 'php:d-m-Y']
            ],
            [
                'attribute' => 'creation_user',
                'value' =>  $name_creater,
            ],
            [
                'attribute' => 'update_time',
                'format' => ['date', 'php:d-m-Y']
            ],
            [
                'attribute' => 'update_user',
                'value' =>  $name_editer,
            ],

        ],
    ]) ?>
    </div>
    </div>
    <hr class="hr_inform">
        <div class="pull-right" style="margin-right: 10px;">
            <p>
                <?= Html::a('Cập nhật', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            
                <?= Html::a('Trở lại', ['index'], ['class' => 'btn btn-default']) ?>
            </p>
        </div>
    <?= $this->render('info', [
        'account_id' => $model->id,
        'type' => $model->account_type,
    ]) ?>
    </fieldset> 
</div>
