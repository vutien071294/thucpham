<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\components\ComponentBase;

$components = new ComponentBase();
$base_url = $components->Base_url();
$base_url_frontend = $components->Base_url_images();

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\danhmuc\models\DanhmucSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh mục';
$this->params['breadcrumbs'][] = $this->title;
?>
 <div class="panel-heading title-heading"><?= $cate['title']  ?></div>
<div class="collapse navbar-collapse" id="">
    <div class="col-md-6 image-content-div ">
        <a href="<?=$base_url ?>content/baigiang?prm=<?=$cate['id']?>&code=<?= $code?>"><img class="image-content" src="<?=$base_url ?>image/powerpoint-icon.png" alt=""></a>
        <p class="image-content-text">Bài giảng điện tử</p>
    </div>
    <div class="col-md-6 image-content-div">
        <a href="<?=$base_url ?>content/video?prm=<?=$cate['id']?>&code=<?= $code?>"><img class="image-content" src="<?=$base_url ?>image/video-icon.png" alt=""></a>
        <p class="image-content-text">Video</p>
    </div>

    <div class="col-md-6 image-content-div">
        <a href="<?=$base_url ?>content/music?prm=<?=$cate['id']?>&code=<?= $code?>"><img class="image-content" src="<?=$base_url ?>image/music-icon.png" alt=""></a>
        <p class="image-content-text">Âm nhạc</p>
    </div>

    <div class="col-md-6 image-content-div">
        <a href="<?=$base_url ?>content/images?prm=<?=$cate['id']?>&code=<?= $code?>"><img class="image-content" src="<?=$base_url ?>image/image-icon.png" alt=""></a>
        <p class="image-content-text">Hình ảnh</p>
    </div>

    <div class="col-md-6 image-content-div">
        <a href="<?=$base_url ?>content/word?prm=<?=$cate['id']?>&code=<?= $code?>"><img class="image-content" src="<?=$base_url ?>image/word-icon.png" alt=""></a>
        <p class="image-content-text">Giáo án</p>
    </div>

    <div class="col-md-6 image-content-div">
        <a href="<?=$base_url ?>content/game?prm=<?=$cate['id']?>&code=<?= $code?>"><img class="image-content" src="<?=$base_url ?>image/game-icon.png" alt=""></a>
        <p class="image-content-text">Trò chơi</p>
    </div>
</div>
<style type="text/css">
    .title-heading{
        background-color: #1aaaea;
        margin-top: -15px;
        margin-left: -15px;
        margin-right: -15px;
    }
    body{color: white;}
</style>