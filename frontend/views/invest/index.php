<div id="content" class="container site-content">
    <div class="row">
        <div id="primary" class="content-area">
        	<main id="main" class="site-main" role="main">
                <article id="post-535" class="post-535 page type-page status-publish hentry">
                    <div id="pl-535" class="panel-layout">
                    	<div id="pg-535-1" class="panel-grid panel-no-style">
                    		<div id="pgc-535-1-0" class="panel-grid-cell">
					        	<div >
                                    <p class="title_service" style="text-align: center;">
                                        <?= $data['title'] ?>
                                    </p>
					        		<?php
					        		// nội dung 
									echo($data['description']);
									 ?>
					    		</div>
					    	</div>
					    	<div id="pgc-535-1-1" class="panel-grid-cell" style="max-width: 25%">
						 	 	<?= $this->render('../layouts/right_bar', [
	        					]) ?>
	        				</div>
						 </div>

					</div>
				</article>
			</main>
        </div>
    </div>
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
