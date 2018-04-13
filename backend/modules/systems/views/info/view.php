<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\components\ComponentBase;

/* @var $this yii\web\View */
/* @var $model backend\modules\systems\models\Info */

$components = new ComponentBase();
$base_url = $components->Base_url(); 

if ($model[0]['logo']) {
    $image = $base_url.'public/images/logo/'.$model[0]['logo'];
}else{
    $image = '';
}

$this->title = 'Quản lý thông tin công ty';
$this->params['breadcrumbs'][] = ['label' => 'Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Cập nhật', ['update', 'id' => $model[0]['id']], ['class' => 'btn btn-primary']) ?>
    </p>

    <table id="w0" class="table table-striped table-bordered detail-view">
        <tbody>
            <tr>
                <th>Tên công ty</th>
                <td><?=  $model[0]['fullname'] ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?=  $model[0]['email'] ?></td>
            </tr>
            <tr>
                <th>Hotline</th>
                <td><?=  $model[0]['hotline'] ?></td>
            </tr>
            <tr>
                <th>Điện thoại</th>
                <td><?=  $model[0]['phone'] ?></td>
            </tr>
            <tr>
                <th>Địa chỉ</th>
                <td><?=  $model[0]['address'] ?></td>
            </tr>
            <tr>
                <th>Logo công ty</th>
                <td>
                    <img width="300px" src="<?=  $image ?>" class="user-image" alt="User Image">
                </td>
            </tr>
            <tr>
                <th>Mô tả công ty</th>
                <td><?=  $model[0]['summary'] ?></td>
            </tr>
            <tr>
                <th>Giới thiệu công ty</th>
                <td><?=  $model[0]['description'] ?></td>
            </tr>
            <tr>
                <th>Tuyển dụng</th>
                <td><?=  $model[0]['recruitment'] ?></td>
            </tr>
        </tbody>
    </table>

</div>
