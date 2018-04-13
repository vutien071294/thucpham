<?php
use frontend\components\ComponentBase;
use frontend\models\Categories;

$compoment = new ComponentBase();
$base_url = $compoment->Base_url();

if($data_category['parent_id']){
	$parent_id = $data_category['parent_id'];
	$data_parent = Categories::findOne($parent_id);

}
else{
    $parent_id = '';
    $data_parent = '';
}



?>

<div id="breadcrumbs">
	<div class="container">
		<div class="insider">
			<span xmlns:v="http://rdf.data-vocabulary.org/#">
				<span typeof="v:Breadcrumb">
					<a href="<?php echo $base_url?>" rel="v:url" property="v:title">Trang chủ</a> » 
					<span rel="v:child" typeof="v:Breadcrumb">
                        <span class="breadcrumb_last"><?php echo $data_parent ? $data_parent['title'] : '' ?></span> »
                        <a href="<?php echo $base_url?>contruction?prm=<?php echo $dataContruction['cate_id'] ? $dataContruction['cate_id'] : ''?>" rel="v:url" property="v:title"><?php echo $data_category ? $data_category['title'] : '' ?></a> » 
                        <span class="breadcrumb_last"><?php echo $dataContruction ? $dataContruction['title'] : '' ?></span>
                    </span>
				</span>
			</span>		    
			</div>
	</div>
</div>


<div id="content" class="container site-content">
	<div class="row">
    <aside id="secondary1" class="widget-area" role="complementary">
    <div id="primary" class="content-area widget-area entry-content" role="complementary" style="width:70%">
        <main id="main" class="site-main" role="main">

            <article id="post-662" class="main-single-post post-662 post type-post status-publish format-standard has-post-thumbnail hentry category-biet-thu-lien-ke category-can-ho-cao-cap category-chung-cu category-goc-tu-van category-nghi-duong category-su-kien category-thu-vien category-tin-tuc category-tuyen-dung">
                <header class="entry-header">
                    <h1 class="vietmoz-title entry-title"><?php echo $dataContruction['title']?></h1>
                    <div class="entry-meta">
                        <span class="posted-on">
                            <i class="glyphicon glyphicon-calendar"></i>
                            <span class="screen-reader-text">Đăng ngày</span> 
                            <a href="#" rel="bookmark"><time class="entry-date published updated"><?php echo date('d-m-Y',$dataContruction['create_time']) ?></time></a>	
                        </span>

                    </div>
                </header><!-- /.entry-header -->

	
	            <div class="entry-content">

                    <?php echo $dataContruction['description'] ?>
	
	            </div><!-- .entry-content -->

	

            </article><!-- #post-## -->

	    </main><!-- #main -->
    </div><!-- #primary -->
    </aside>


    <aside id="secondary" class="widget-area" role="complementary">

        <?= $this->render('../layouts/right_bar', [
                            ]) ?>
    </aside><!-- #secondary -->


	</div><!-- /.row -->
</div>

<style>
    .entry-content{
        font-size:13px !important;
    }
    .entry-content strong{
        font-size:13px !important;
    }
    .entry-header{
        margin-bottom: 0px !important;
    }
    .entry-content h2,h1,h3,h4 {
        margin-top: 0px;
    }
</style>