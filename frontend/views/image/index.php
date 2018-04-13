<div id="content" class="container site-content">
    <div class="row">
        <div id="primary" class="content-area">
        	<main id="main" class="site-main" role="main">
                <article id="post-535" class="post-535 page type-page status-publish hentry">
                    <div id="pl-535" class="panel-layout">
                    	<div id="pg-535-1" class="panel-grid panel-no-style" style="t">
                    		<h1 class="title_h1_pg">Công trình thực tế</h1>
						</div>

						<?php foreach ($dataContruction as $key => $value) {
							?>
							<div style=" float: left; width: 25%">     
								<div style="padding: 10px; ">            
									<img src="<?=$base_url ?>public/images/image_contruction/<?php echo $value['url'] ?>" alt="Công trình Hacico" width="270;" height="180">
							 	</div>
							</div>
							<?php
						} ?>
						


                                                   
					</div>
				</article>
			</main>
        </div>
    </div>
</div>
<style>
	.title_h1_pg{
	    margin: 0 0 50px;
	    padding: 20px 0;
	    font-size: 2em;
	    text-transform: capitalize;
	    color: #252525;
	    font-weight: 700;
	    position: relative;
	}
</style>