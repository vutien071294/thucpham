


<div id="content" class="container site-content">
	<div class="row">
    <div id="primary" class="content-area" style="width:70%">
        <main id="main" class="site-main" role="main">

            <article id="post-662" class="main-single-post post-662 post type-post status-publish format-standard has-post-thumbnail hentry category-biet-thu-lien-ke category-can-ho-cao-cap category-chung-cu category-goc-tu-van category-nghi-duong category-su-kien category-thu-vien category-tin-tuc category-tuyen-dung">
                <header class="entry-header">
                    <h1 class="vietmoz-title entry-title title_service"><?php echo $data['title']?></h1>
                    <div class="entry-meta">
                        <span class="posted-on">
                            <i class="glyphicon glyphicon-calendar"></i>
                            <span class="screen-reader-text">Đăng ngày</span> 
                            <a href="#" rel="bookmark"><time class="entry-date published updated"><?php echo date('d-m-Y',$data['create_time']) ?></time></a>	
                        </span>

                    </div>
                </header><!-- /.entry-header -->

	
	            <div class="entry-content">

                    <?php echo $data['content'] ?>
	
	            </div><!-- .entry-content -->

	

            </article><!-- #post-## -->

	    </main><!-- #main -->
    </div><!-- #primary -->


    <aside id="secondary" class="widget-area" role="complementary">

        <?= $this->render('../layouts/right_bar', [
                            ]) ?>
    </aside><!-- #secondary -->


	</div><!-- /.row -->
</div>
<style>
	.title_service{
	    margin: 0 0 50px;
	    padding: 20px 0;
	    font-size: 2em;
	    text-transform: capitalize;
	    color: #252525;
	    font-weight: 700;
	    position: relative;
	}
</style>
