<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\components\ComponentBase;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\content\models\ImagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Images';
$this->params['breadcrumbs'][] = $this->title;
$components = new ComponentBase();
$base_url = $components->Base_url();
$url_images = $components->Base_url_images();
?>
<script src="<?php echo $url_images ?>dist/slide/pgwslideshow.js"></script>
<script src="<?php echo $url_images ?>dist/slide/pgwslideshow.min.js"></script>
<link rel="stylesheet" href="<?php echo $url_images ?>dist/slide/pgwslideshow.css">
<link rel="stylesheet" href="<?php echo $url_images ?>dist/slide/pgwslideshow.min.css">
<link rel="stylesheet" href="<?php echo $url_images ?>dist/slide/pgwslideshow_light.css">
<link rel="stylesheet" href="<?php echo $url_images ?>dist/slide/pgwslideshow_light.min.css">
<div class="panel-heading title-heading"><?php echo $cate[0]['title']?> (HÌNH ẢNH)</div>
<?php if ($data) { ?>
    <ul class="pgwSlideshow">
    <?php foreach ($data as $key => $value) { ?>
        <li style="padding-left: 0px;"><img src="<?php echo $url_images ?><?php echo $value['url'] ?>" alt="<?php echo $value['title'] ?>" data-description="<?php echo $value['description'] ?>"></li>
    <?php } ?>
    </ul>
     <div class="col-md-12 mar_top_20"><button  onclick="goBack()" type="button" class="btn btn-primary center pull-right">Trở lại danh sách</button></div>
<?php }else{ ?>
    <h3 style="text-align: center;margin-top: 20px;">Hình ảnh ở danh mục này chưa được cập nhật!</h3>
<?php } ?>

<script type="text/javascript">
    $(document).ready(function() {
        var pgwSlideshow = $('.pgwSlideshow').pgwSlideshow();
    });
</script>

<style type="text/css">
    img {
        max-height: 670px;
    }
    .title-heading{
        background-color: #1aaaea;
        margin-top: -15px;
        margin-left: -15px;
        margin-right: -15px;
        color: white;
    }
    .mar_top_20{
        margin-top: 20px;
    }
</style>
<script>
function goBack() {
    window.history.back();
}
</script>