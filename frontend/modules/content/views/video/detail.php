 <div class="panel-heading text_head_content title-heading"><?php echo $model->title ?></div>
	<div class="col-md-12 padding-none iframe_title">
		
		<iframe id="frame_url" src="https://www.youtube.com/embed/<?php echo $model->url ?>" width="100%" height="500px"  frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe> 
	</div>
	<div class="col-md-12"><button  onclick="goBack()" type="button" class="btn btn-primary center pull-right">Trở lại danh sách</button></div>
<style>
	iframe {
		width: 100%;
		height: 800px;
	}
	.iframe_title{
		margin-top: 20px;
	}
	.padding-none{
		padding-left: 0px !important;
		padding-right: 0px !important;
	}
</style>
<script>
function goBack() {
    window.history.back();
}
</script>