<div class="panel-heading text_head_content title-heading">Video</div>

<div class="sell-search">
    <form id="w0" class="form-horizontal" action="<?php echo $base_url ?>content/video/search" method="get">
    <input type="hidden" class="form-control" name="id_cate" value="<?= $id_cate ?>" hidden = 'hidden' aria-invalid="false">
        <input type="hidden" class="form-control" name="code" value="<?= $code ?>" hidden = 'hidden' aria-invalid="false">
        <div style="margin-top: 10px">
            <div class="col-xs-4 field-sellsearch-code">
            
            <input type="text" id="search-text" class="form-control" name="text" value='<?php 
                if(isset($text)){
                    echo $text;
                }
             ?>' placeholder="Nhập tên cần tìm kiếm" aria-invalid="false">
            <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button> 
        </div>
    </form>
</div>

 <?php 
if ($data_video_by_cate) { ?>
    <div class="collapse navbar-collapse" id="">
        <?php foreach ($data_video_by_cate as $key => $value) { ?>
            <div class="col-md-3 image-contentword-div ">
                <a href="<?php echo $base_url ?>content/video/detail?prm=<?= $value['id'] ?>">
                    <img class="image-content" src="<?php echo $base_url ?>image/video.jpg" alt="" width='150px' height = '150px'>
                    <p class="image-content-text"><?= $value['title'] ?></p>

                </a>
               
            </div>
        <?php } ?>
    </div>
   <div class="col-md-12">
        <a href="<?= $base_url ?>danhmuc/danhmuc?prm=<?= $code ?>">
            <button  type="button" class="btn btn-primary center pull-right">Trở lại danh sách</button>
        </a>
    </div>
<?php }else{ ?>
    <h3 style="text-align: center;">Video ở mục này chưa được cập nhật!</h3>
<?php } ?>


<style type="text/css">
    .title-heading{
        background-color: #1aaaea;
        margin-top: -15px;
        margin-left: -15px;
        margin-right: -15px;
        color: white;
    }
    .image-contentword-div{
        height: 250px;
    }
    
</style>
<script>
function goBack() {
    window.history.back();
}
</script>


<script src="<?=$base_url ?>js/jquery.min.js"></script>
<script>
    // $( document ).ready(function() {
    //     $('.tile_video').on('click', function(){
    //         $(".video_small").css("display", "none");
    //         $(".pagination_small").css("display", "none");
    //         var value = $(this).attr('value');
    //         var title = $(this).html();
    //         $('.video_big').empty().append(' <iframe id="frame_url" src="https://www.youtube.com/embed/'+value+'" width="100%" height="500px"  frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>  <p class="title-des_child-lession tile_video">'+title+'</p><div class="col-md-12"><button  onclick="reload()" type="button" class="btn btn-primary center">Trở lại danh sách</button></div> ');
    //         $(".show_back").css("display", "none");

    //     });
    // });
</script> 
<style type="text/css">
    .title-heading{
        background-color: #1aaaea;
        margin-top: -15px;
        margin-left: -15px;
        margin-right: -15px;
        color: white;

    }
    .title-des_child-lession{
            font-size: 15px;
        font-weight: bold;
        cursor: pointer
    }
    .tile_video {
        margin-top: 5px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
    }
    .video_big{
        margin-top: -14px;
        margin-left: -30px;
        margin-right: -30px;
    }

</style>

<script>
function reload() {
     location.reload()
}
</script>
<script>
function goBack() {
    window.history.back();
}
</script>