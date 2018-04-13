<?php 
use frontend\components\ComponentBase;
use frontend\models\Info;
use frontend\models\Contents;
use frontend\models\Handbook;

$components = new ComponentBase();
$base_url = $components->Base_url();

$info =  Info::find()->one();
$data = Contents::find()->where(['is_hot' => 1])->limit(5)->all();
$camnang = Handbook::find()->limit(5)->all();
?>
<div id="panel-535-1-1-1" class="so-panel widget widget_vietmoz_post_category widget_post_list" data-index="4">
    <div class="textwidget">
        <div class="consult-description">
            <a class="consult-phone" href="#"><i class="glyphicon glyphicon-earphone"></i> <?= ($info['hotline'])? $info['hotline'] : '' ?></a>
            
            <a class="consult-email" href="#"><i class="glyphicon glyphicon-envelope"></i> <?= ($info['email'])? $info['email'] : '' ?></a>
        </div>
    </div>
    <h2 class="widget-title">CÔNG TRÌNH TIÊU BIỂU</h2>
    <ul class="list-post-item">
        <?php
            if ($data) {
                foreach ($data as $key => $value) {
                    ?>
                    <li class="post-title-widget">
                        <div class="post-thumbnail"><a href="<?= $base_url ?>contruction/detail?prm=<?= $value['id'] ?>" title="  <?= $value['title'] ?>"><img src="<?=$base_url.'public/images/image_contruction/'.$value['url']?>" alt=""> </a> </div>
                        <div class="post-info">
                            <span class="post-title"><a href="<?= $base_url ?>contruction/detail?prm=<?= $value['id'] ?>" rel="bookmark" class="color-heading color-main--hover">
                                 <?= $value['title'] ?>
                            </a></span>                         
                            <div class="entry-meta">
                                <span class="posted-on">
                                <i class="glyphicon glyphicon-calendar"></i>
                                <span class="screen-reader-text">Đăng ngày</span> <a href="#" rel="bookmark"><time class="entry-date published updated" datetime=""><?php echo date('d/m/Y', $value['create_time']); ?></time></a>  </span>
                                
                            </div>
                        </div>
                    </li>

                    <?php
                }
            }
        ?>
    </ul>
</div>
<div id="panel-535-1-1-2" class="so-panel widget widget_vietmoz_post_category widget_post_list" data-index="5">
    <h2 class="widget-title">CẨM NANG NHÀ ĐẸP</h2>
    <ul class="list-post-item">
        <?php
            if ($camnang) {
                foreach ($camnang as $key => $value) {
                    ?>
                    <li class="post-title-widget">
                        <div class="post-thumbnail"><a href="<?= $base_url ?>contruction/detail?prm=<?= $value['id'] ?>" title="  <?= $value['title'] ?>"><img src="<?=$base_url.'public/images/image_handbook/'.$value['image']?>" alt=""> </a> </div>
                        <div class="post-info">
                            <span class="post-title"><a href="<?= $base_url ?>handbook/detail?prm=<?= $value['id'] ?>" rel="bookmark" class="color-heading color-main--hover">
                                 <?= $value['title'] ?>
                            </a></span>                         
                            <div class="entry-meta">
                                <span class="posted-on">
                                <i class="glyphicon glyphicon-calendar"></i>
                                <span class="screen-reader-text">Đăng ngày</span> <a href="#" rel="bookmark"><time class="entry-date published updated" datetime=""><?php echo date('d/m/Y', $value['create_time']); ?></time></a>  </span>
                                
                            </div>
                        </div>
                    </li>

                    <?php
                }
            }
        ?>
    </ul>
</div>

<style>
    
    .consult-description .consult-phone {
    background: #EA4335;
}
.consult-description a, .section-utility .utility {
    cursor: pointer;
    display: block;
    background: #575757;
    margin-bottom: 10px;
    color: #fff;
    padding: 5px;
    font-size: 16px;
}
.consult-phone .fa, .consult-email .fa, .sidebar .utility i {
    width: 32px;
    height: 32px;
    line-height: 28px;
    text-align: center;
    border: 2px solid #fff;
    border-radius: 50%;
    margin-right: 0.5rem;
}
.fa {
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    transform: translate(0, 0);
}
.consult-description a, .section-utility .utility {
    cursor: pointer;
    display: block;
    background: #575757;
    margin-bottom: 10px;
    color: #fff;
    padding: 5px;
    font-size: 16px;
}
.consult-description {
    margin: 0;
    padding: 0;
    line-height: 1.7;
}
</style>