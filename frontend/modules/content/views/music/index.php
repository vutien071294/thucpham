<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\components\ComponentBase;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\content\models\ImagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Music';
$this->params['breadcrumbs'][] = $this->title;
$components = new ComponentBase();
$base_url = $components->Base_url();
$url_images = $components->Base_url_images();
?>
<link rel="stylesheet" href="<?php echo $url_images ?>dist/slide/music.css">
<div class="panel-heading title-heading"><?php echo $cate[0]['title'] ?> (ÂM NHẠC)</div>
<?php if ($data) { ?>
    <div class="panel1 panel-default">
        <audio id="audio" autoplay preload="auto" tabindex="0" controls>
            <source src="<?php echo $url_images ?><?php echo $data[0]['url'] ?>">
        </audio>
    </div>
    <ul id="playlist" class="ul1">
        <li class="active list-group-item li1">
            <a href="<?php echo $url_images ?><?php echo $data[0]['url'] ?>">
               <?php echo $data[0]['title'] ?>
            </a>
        </li>
        <?php unset($data[0]); 
            foreach ($data as $key => $value) { ?>
            <li class="list-group-item li1">
                <a href="<?php echo $url_images ?><?php echo $value['url'] ?>">
                    <?php echo $value['title'] ?>
                </a>
            </li>
        <?php } ?>
    </ul>
   
     <div class="col-md-12 mar_top_20"><button  onclick="goBack()" type="button" class="btn btn-primary center pull-right">Trở lại danh sách</button></div>
<?php }else{ ?>
    <h4 style="text-align: center; margin-top: 20px;">ÂM NHẠC THUỘC DANH MỤC NÀY CHƯA ĐƯỢC CẬP NHẬT!</h4>
<?php } ?>
<script type="text/javascript">
    var audio;
    var playlist;
    var tracks;
    var current;
    init();
    function init(){
        current = 0;
        audio = $('#audio');
        playlist = $('#playlist');
        tracks = playlist.find('li a');
        len = tracks.length;
        audio[0].volume = 1;
        audio[0].play();
        playlist.find('a').click(function(e){
            e.preventDefault();
            link = $(this);
            current = link.parent().index();
            run(link, audio[0]);
        });
        audio[0].addEventListener('ended',function(e){
            current++;
            if(current == len){
                current = 0;
                link = playlist.find('a')[0];
            }else{
                link = playlist.find('a')[current];    
            }
            run($(link),audio[0]);
        });
    }
    function run(link, player){
            player.src = link.attr('href');
            par = link.parent();
            par.addClass('active').siblings().removeClass('active');
            audio[0].load();
            audio[0].play();
    }
</script>
<style type="text/css">
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