<?php
use frontend\components\ComponentBase;



$compoment = new ComponentBase();
$base_url = $compoment->Base_url();

?>

<div id="breadcrumbs">
    <div class="container">
        <div class="insider">
            <span xmlns:v="http://rdf.data-vocabulary.org/#">
                <span typeof="v:Breadcrumb">
                    <a href="#" rel="v:url" property="v:title">Trang chủ</a> » 
                    <span rel="v:child" typeof="v:Breadcrumb"><a href="#" rel="v:url" property="v:title">Sản phẩm</a><span class="breadcrumb_last"></span></span>
                </span>
            </span>     
            </div>
    </div>
</div>



<div id="content" class="container site-content">
    <div class="row">
        <aside id="secondary1" class="widget-area" role="complementary">
            <div id="primary" class="content-area widget-area entry-content" role="complementary" style="width:70%">
                <main id="main" class="site-main" role="main" style="width: 140%">

                    <header class="archive-header">
                        <h1 class="title_level1"><?php echo $title?></h1>   
                    </header>



                    <div class="loop-wrapper">
                    <?php foreach($dataProduct as $key => $value) {?>
                    
                        <article id="post-662" class="grid-item post-662 post type-post status-publish format-standard has-post-thumbnail hentry category-biet-thu-lien-ke category-can-ho-cao-cap category-chung-cu category-goc-tu-van category-nghi-duong category-su-kien category-thu-vien category-tin-tuc category-tuyen-dung">

                            <div class="insider">

                                <div class="post-thumbnail">
                                    <a href="<?php echo $base_url.'product/detail?prm='.$value['id']?>" title="<?php echo $value['title'] ?>">
                                        <img src="<?php echo $base_url.'public/images/image_manage/'.$value['image']?>" alt="<?php echo $value['title'] ?>">
                                    </a>
                                </div>
                                <div class="post-info">

                                <span class="post-title">
                                    <a href="<?php echo $base_url.'product/detail?prm='.$value['id']?>" rel="bookmark" class="color-heading color-main--hover"><?php echo $value['title'] ?></a>
                                </span>

                                <div class="entry-meta">
                                    <span class="posted-on">
                                        <a href="<?php echo $base_url.'Product/detail?prm='.$value['id']?>" rel="bookmark"><time class="entry-date published updated" datetime="2017-06-26T17:00:38+00:00"><?php echo date('m/d/Y', $value['create_time']) ?></time></a>    
                                    </span>
                                </div>
                                <p class="post-excerpt">
                                    <?php echo substr($value['description'], 0, 100).' ....' ?>
                                </p>

                                <div class="read-more">
                                    <a href="<?php echo $base_url.'product/detail?prm='.$value['id']?>" title="<?php echo $title ?>">
                                        Xem thêm    </a>
                                </div>
                            </div><!-- .post-info -->

                            </div>
                        <!-- /.insider -->

                        </article><!-- #post-## -->
                    <?php } ?>

                    </div><!-- .loop-wrapper -->

                </main><!-- #main -->
            </div><!-- #primary -->
            
        </aside>
        <aside id="secondary" class="widget-area" role="complementary">
            <?= $this->render('../layouts/right_bar', []) ?>
        </aside><!-- #secondary -->
    </div><!-- /.row -->
</div>

<style>
    .title_level1{
        border-bottom: 1px solid #ebebeb;
        font-weight: 400 ;
        text-transform: uppercase ;
        padding: 0 0 8px;
        margin-top: 0px;
        font-size: 18px;
    }
</style>