<?php
use frontend\components\ComponentBase;
use frontend\models\Categories;

$compoment = new ComponentBase();
$base_url = $compoment->Base_url();

if(isset($_GET['item'])){
	switch ($_GET['item']) {
		case 'is_hot':
			$title = 'Công trình tiêu biểu';
			break;
		case 'is_build':
			$title = 'Công trình xây dựng';
			break;
		case 'is_complete':
			$title = 'Công trình hoàn thành';
			break;
		default:
			$title = '';
	}
	
}
else{
	$title = '';
}

?>

<div id="breadcrumbs">
	<div class="container">
		<div class="insider">
			<span xmlns:v="http://rdf.data-vocabulary.org/#">
				<span typeof="v:Breadcrumb">
					<a href="<?php echo $base_url?>" rel="v:url" property="v:title">Trang chủ</a> » 
					<span rel="v:child" typeof="v:Breadcrumb">
						<span class="breadcrumb_last"><?php echo $title?></span>
					</span>
				</span>
			</span>		
			</div>
	</div>
</div>



<div id="content" class="container site-content">
	<div class="row">
		<div id="primary" class="content-area" style="width:70%">
			<main id="main" class="site-main" role="main">

				<header class="archive-header">
					<h1 class="title_level1"><?php echo mb_strtoupper($title, 'UTF-8')?></h1>	
				</header>

				<div class="loop-wrapper">
				<?php foreach($dataContruction as $key => $value) {?>
				
					<article id="post-<?php echo $value['id']?>" class="grid-item post-<?php echo $value['id']?> post type-post status-publish format-standard has-post-thumbnail hentry category-biet-thu-lien-ke category-can-ho-cao-cap category-chung-cu category-goc-tu-van category-nghi-duong category-su-kien category-thu-vien category-tin-tuc category-tuyen-dung">

						<div class="insider">

							<div class="post-thumbnail">
								<a href="<?php echo $base_url.'contruction/detail?prm='.$value['id']?>" title="<?php echo $value['title'] ?>">
									<img src="<?php echo $base_url.'public/images/image_contruction/'.$value['url']?>" alt="<?php echo $value['title'] ?>">
								</a>
							</div>
							<div class="post-info">

							<span class="post-title">
								<a href="<?php echo $base_url.'contruction/detail?prm='.$value['id']?>" rel="bookmark" class="color-heading color-main--hover"><?php echo $value['title'] ?></a>
							</span>

							<div class="entry-meta">
								<span class="posted-on">
									<i class="glyphicon glyphicon-calendar"></i>
									<span class="screen-reader-text">Đăng ngày</span> 
									<a href="<?php echo $base_url.'contruction/detail?prm='.$value['id']?>" rel="bookmark"><time class="entry-date published updated"><?php echo date('d-m-Y',$value['create_time']) ?></time></a>	
								</span>

							</div>
							<p class="post-excerpt">
								<?php echo $value['title']?>
							</p>

							<div class="read-more">
								<a href="<?php echo $base_url.'contruction/detail?prm='.$value['id']?>" title="<?php echo $value['title']?>">
									Xem thêm	</a>
							</div>
						</div><!-- .post-info -->

						</div>
					<!-- /.insider -->

					</article><!-- #post-## -->
				<?php } ?>

				</div><!-- .loop-wrapper -->

			</main><!-- #main -->
		</div><!-- #primary -->

		<aside id="secondary" class="widget-area" role="complementary">

			<?= $this->render('../layouts/right_bar', [
									]) ?>
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
    body{
        font-size:13px !important;
    }
</style>