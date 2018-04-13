<div class="panel-heading text_head_content title-heading">Trò chơi</div>
<?php 

// echo "<pre>";
// print_r($game);die;
 ?>
<?php 
if ($game) { ?>
	<div class="collapse navbar-collapse" id="">
		<?php foreach ($game as $key => $value) { ?>
	 	 	<div class="col-md-3 image-contentword-div ">
		        <a href="<?= $value->url ?>" target= "blank">
		        	<img class="image-content" src="<?php echo $base_url ?>image/game_content.png" alt="">
		        	<p class="image-content-text"><?= $value->title ?></p>
		        </a>
		    </div>
		<?php } ?>
	</div>
<?php }else{ ?>
 	<h3 style="text-align: center;">Trò chơi ở mục này chưa được cập nhật!</h3>
<?php } ?>


<style type="text/css">
    .title-heading{
        background-color: #1aaaea;
        margin-top: -15px;
        margin-left: -15px;
        margin-right: -15px;
        color: white;
    }
  
</style>