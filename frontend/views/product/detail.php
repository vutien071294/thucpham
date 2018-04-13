<?php
use frontend\components\ComponentBase;



$compoment = new ComponentBase();
$base_url = $compoment->Base_url();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="vi" xmlns="http://www.w3.org/1999/xhtml">
    <!-- Edit By @DTM -->
    <head>
        <!-- Include Header Meta -->
        <base s_name="xhomever2" idw="7121" href="http://xhome.com.vn" extention=".html" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Bàn ăn BRILLIANT</title>
        <meta name="description" content="11.000.000">
        <meta name="keywords" content="CÔNG TY CỔ PHẦN ĐẦU TƯ XÂY DỰNG VÀ THƯƠNG MẠI ASACO">
        <meta name="robots" content="INDEX, FOLLOW"/>
        <link rel="shortcut icon" href="http://s2.webbnc.vn/uploadv2/web/71/7121/informationbasic/2017/08/07/06/49/1502088427_logo-xhome-01.png" />
        <link rel="icon" href="http://s2.webbnc.vn/uploadv2/web/71/7121/informationbasic/2017/08/07/06/49/1502088427_logo-xhome-01.png" />
        <meta property="og:title" content="Bàn ăn"/>
        <meta property="og:image" content="https://cdn-img-v2.webbnc.net/uploadv2/web/71/7121/product/2017/09/30/08/22/1506759489_ban-brilliant.jpg.jpg"/>
        <meta property="og:description" content="11.000.000"/>
        <meta property="og:site_name" content="Bàn ăn"/>
        <!-- Global Site Tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-61304090-2"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments)};
            gtag('js', new Date());
            
            gtag('config', 'UA-61304090-2');
        </script><!-- End Include Header Meta-->
        <!-- Include CSS -->
        <!-- Reset Css-->
        <link href="http://xhome.com.vn/themes/91530/statics/css/reset.css" rel="stylesheet" media="screen">
        <!-- End Reset Css-->
        <!-- Bootstrap Css -->
        <link rel="stylesheet" href="http://xhome.com.vn/themes/91530/statics/plugins/bootstrap/css/bootstrap.min.css">
        <!-- End Bootstrap Css -->
        <!-- Css -->
        <link href="http://xhome.com.vn/themes/91530/statics/plugins/owl-carousel/owl.carousel.css" rel="stylesheet" media="screen">
        <link href="http://xhome.com.vn/themes/91530/statics/plugins/owl-carousel/owl.theme.css" rel="stylesheet" media="screen">
        <link href="http://xhome.com.vn/themes/91530/statics/plugins/owl-carousel/owl.transitions.css" rel="stylesheet" media="screen">
        <link href="http://xhome.com.vn/themes/91530/statics/plugins/wow/animate.css" rel="stylesheet" media="screen">
        <link href="http://xhome.com.vn/themes/91530/statics/plugins/slider-range/jquery.nouislider.min.css" rel="stylesheet">
        <link href="http://xhome.com.vn/themes/91530/statics/css/owl-slideshow-main.css" rel="stylesheet" media="screen">
        <link href="http://xhome.com.vn/themes/91530/statics/css/style.css?v=11" rel="stylesheet" media="screen">
        <!-- <link href="http://xhome.com.vn/themes/91530/statics/css/mobile.css?v=1" rel="stylesheet" media="screen"> -->
        <!-- End Css -->
        <!-- FontIcon -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.3.2/css/simple-line-icons.css">
        <!-- End FontIcon -->
        <!-- JS -->
        <script type="text/javascript" src="http://xhome.com.vn/themes//91530/statics/scripts/jquery.min.js"></script> 
        <script type="text/javascript" src="http://xhome.com.vn/themes//91530/statics/scripts/search.js"></script>
        <script type="text/javascript" src="http://xhome.com.vn/themes//91530/statics/scripts/jwplayer.js"></script>
        <script src="http://xhome.com.vn/themes//91530/statics/plugins/slider-range/jquery.nouislider.all.min.js"></script>
        <script src="http://xhome.com.vn/themes//91530/statics/plugins/owl-carousel/owl.carousel.js"></script>
        <script type="text/javascript" src="http://xhome.com.vn/themes//91530/statics/scripts/js_customs.js"></script> 
        <!-- End JS --> <!-- End Include CSS -->
    </head>
    <body>
        <!-- <div id="fb-root"></div>
        <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
            fjs.parentNode.insertBefore(js, fjs);
            }(document, "script", "facebook-jssdk"));
        </script>
        <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&appId=1494068174211203&version=v2.0";
            fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script> -->
        <!-- Inside Page -->
        <div class="v2_bnc_products_view_details">
            <div class="v2_bnc_products_body">
                <!-- Products details -->
                <!-- Breadcrumbs -->
                <div class="v2_breadcrumb_main">
                    <div class="container">
                        <ul class="breadcrumb padding-top-30 padding-bottom-30" style="display:block;">
                            <li ><a href="<?php echo $base_url ?>">Trang chủ</a></li>
                            <li ><a href="<?php echo $base_url ?>">Sản Phẩm</a></li>
                            <li ><a><?php echo $dataProduct['title']?></a></li>
                        </ul>
                    </div>
                </div>
                <!-- End Breadcrumbs -->
                <div class="v2_bnc_product_details_page">
                    <div class="container">
                        <div class="row">
                            <!-- Zoom image -->
                            <div class="v2_bnc_products_details_zoom_img col-md-7 col-sm-12 col-xs-12">
                                <div class="f-pr-image-zoom">
                                    <div class="zoomWrapper">
                                        <img id="img_01" src="<?php echo $base_url.'public/images/image_manage/'.$dataProduct['image']?>"/>
                                    </div>
                                </div>
                            </div>
                            <!-- End Zoom image --> 
                            <!-- Details -->
                            <div class="v2_bnc_products_details_box col-md-5 col-sm-12 col-xs-12">
                                <div class="v2_bnc_products_details_box_name">
                                    <h2><?php echo $dataProduct['title']?></h2>
                                </div>
                                <br />    
                                <div class="v2_bnc_products_details_box_social">
                                    <ul class="no-margin no-padding">
                                        <li>Ngày đăng: <?php echo date('d/m/Y',$dataProduct['create_time']);?></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="v2_bnc_products_details_box_info">
                                    <div class="v2_bnc_products_details_box_price">
                                        <span class="key">Giá sản phẩm: </span><span class="price"><?php echo $dataProduct['price'] . ' đ'. "\n";?></span>
                                    </div>
                                    <div class="v2_bnc_products_details_box_description">
                                        <table border="0" cellpadding="0" cellspacing="0" style="width:416px">
                                            <tbody>
                                                <tr>
                                                    <td style="height:38px; width:118px">
                                                        <p>Giá bán</p>
                                                    </td>
                                                    <td style="width:123px">
                                                        <p><?php echo $dataProduct['price'] . ' đ'. "\n";?>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>
                                                    </td>
                                                    <td style="width:176px">
                                                        <p>&nbsp;</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="height:38px; width:118px">
                                                        <p>Kích thước</p>
                                                    </td>
                                                    <td style="width:123px">
                                                        <p><?php echo $dataProduct['size']?>&nbsp;</p>
                                                    </td>
                                                    <td style="width:176px">
                                                        <p>&nbsp;</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="height:42px; width:118px">
                                                        <p>Mô tả</p>
                                                    </td>
                                                    <td colspan="2" style="width:299px">
                                                        <p><?php echo $dataProduct['description']?></p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                               <!--  <a href="#" id="payment" class="btn-buynow" id="add-cart"> -->
                                <button class="add-cart btn-buy btn-buy-now quick-buy-custom" data-product="786945"><i class="fa fa-check"></i> Liên hệ</button>
                               <!--  </a> -->
                                <div class="clearfix"></div>
                            </div>
                            <!-- End Details -->
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(document).ready(function() {
                    $("#img_01").elevateZoom(
                    {
                    gallery:'slidezoompage',
                    cursor: 'pointer',
                    galleryActiveClass: 'active',
                    imageCrossfade: true,
                    scrollZoom : true,
                    easing : true
                    });
                    //
                    $("#img_01").bind("click", function(e) {
                    var ez = $('#img_01').data('elevateZoom');
                    $.fancybox(ez.getGalleryList());
                    var src=$(this).find('img').attr('src');
                    $('#img_01').attr('src',src);
                    
                    return false;
                    });
                    $("#slidezoompage a").bind("click", function(e) {
                    var src=$(this).find('img').attr('src');
                    $('#img_01').attr('src',src);
                    
                    return false;
                    });
                    
                    });
                </script>
                <!-- End Products details -->
                <!-- Form Register Design -->
                <!-- Modal -->
                <div class="v2_bnc_form_register">
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" title="Tắt">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <iframe src="https://docs.google.com/forms/d/1UOSdVxDtjPajSjXmvyNQuIyRU6-M_j6lcqpedO6PPtc/viewform?edit_requested=true" width="100%" height="1311" frameborder="0" marginheight="0" marginwidth="0"></iframe>
                                    <a href="" title="THIẾT KẾ WEBSITE BNC" class="adv_bnc_2 hidden">
                                    <img src="https://cdn-img-v2.webbnc.net/uploadv2/web/63/6329/adv/2017/05/05/03/31/1493954299_a2.png"alt="THIẾT KẾ WEBSITE BNC" class="img-responsive"/>
                                    </a>
                                    <a href="" title="" class="adv_bnc_2 hidden">
                                    <img src="https://cdn-img-v2.webbnc.net/uploadv2/web/71/7121/adv/2017/08/08/02/21/1502158778_neYYn.jpg"alt="" class="img-responsive"/>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Form Register Design --><!-- Products Details Tab -->
                <!-- <div class="f-product-view-tab">
                    <div class="container">
                        <div class="f-product-view-tab-header">
                            <ul id="f-pr-page-view-tabid" class="nav-tabs">
                                <li class="active"><a href="#f-pr-view-01" data-toggle="tab">Mô tả</a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="f-product-view-tab-body tab-content">
                            <div id="f-pr-view-01" class="tab-content tab-pane active">
                                <table border="0" cellpadding="0" cellspacing="0" style="width:416px">  
                                    <p><?php echo $dataProduct['description']?></p>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- End Products Details Tab --><!-- Comment Social -->
                <!-- Products Related -->
                <!-- End Products Related -->
            </div>
        </div>
        <!--Like Product-->
        <!-- <link rel="stylesheet" type="text/css" href="http://xhome.com.vn/modules/product/themes/resource/css/likeproduct.css"/>
            <script src="http://xhome.com.vn/modules/product/themes/resource/js/likeproduct.js"></script>
            
            <link rel="stylesheet" type="text/css" href="http://xhome.com.vn/modules/product/themes/resource/css/toastr.css"/>
            <script src="http://xhome.com.vn/modules/product/themes/resource/js/toastr.js"></script>
            
            <link rel="stylesheet" type="text/css" href="http://xhome.com.vn/modules/product/themes/resource/css/rater.css"/>
            <script src="http://xhome.com.vn/modules/product/themes/resource/js/productrater.js"></script>
            
            <script type="text/javascript">
             $(document).ready(function() {
                   Likeproduct.init();
                });
            </script></section> -->
        <!-- End Inside Page -->
        <!-- Adv Rich Meida -->
        <div class="hidden-xs">
        </div>
        <script> 
            jQuery(function ($) { 
                $('#show').hide();
                $('#close').click(function (e) {
                  $('#rich-media').hide('slow');
                  return false;
                });
                $('#hide').click(function (e) {
                  $('#show').show('slow');
                  $('#hide').hide('slow');
                  $('#rich-media-item').height(0);
                  return false;
                });
                $('#show').click(function (e) {
                  $('#hide').show('slow'); 
                  $('#show').hide('slow');
                  $('#rich-media-item').height(205);
                  return false;
               });
            });
        </script>
        <!-- End Adv Rich Meida -->
        <script type="text/javascript" src="http://xhome.com.vn/modules/product/themes/resource/js/product.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('body').data('home_url', 'http://xhome.com.vn');
                //$('body').data('page_url', '');
                $('body').data('extension', '.html');
                Product.init();
                WebCommon.init();
               // alert("-Golbal aler- "+$('body').data('home_url'));
            });
        </script><!-- End Full Code -->
        <!-- Include JS -->
        <script src="http://xhome.com.vn/themes//91530/statics/plugins/bootstrap/js/bootstrap.js"></script> 
        <script type="text/javascript" src="http://xhome.com.vn/themes//91530/statics/scripts/started_js.js"></script>
        <script type="text/javascript" src="http://xhome.com.vn/themes//91530/statics/scripts/webcommon.js"></script>
        <script type="text/javascript" src="http://xhome.com.vn/themes//91530/statics/scripts/jquery.validationEngine.js"></script>
        <script type="text/javascript" src="http://xhome.com.vn/themes//91530/statics/scripts/jquery.validationEngine-vi.js"></script>
        <script type="text/javascript" src="http://xhome.com.vn/themes//91530/statics/plugins/loading-overlay/loading-overlay.min.js"></script>
        <script type="text/javascript" src="http://xhome.com.vn/themes//91530/statics/plugins/loading-overlay/load.js"></script>
        <script type="text/javascript" src="http://xhome.com.vn/themes//91530/statics/scripts/fastCart/fastCart.js"></script>
        <link rel="stylesheet" href="http://xhome.com.vn/themes//91530/statics/plugins/fancybox/jquery.fancybox.css" />
        <script src="http://xhome.com.vn/themes//91530/statics/plugins/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>
        <script type="text/javascript" src="http://xhome.com.vn/themes//91530/statics/plugins/elevatezoom/jquery.elevatezoom.js"></script>
        <script type="text/javascript" src="http://xhome.com.vn/themes//91530/statics/plugins/pjax/jquery.cookie.js"></script><!-- End Include JS -->
        <script type="text/javascript">
            function BNCcallback(data){
                console.log(data);
            }
                var url = document.URL;
                var idW = '7121';
                var uid='';
                var title = document.title;
            
                var appsScript = document.createElement('script');
                appsScript.src = "http://apps.webbnc.vn/app3/themes/default/js/iframeResizer.js";
                document.body.appendChild(appsScript);
            
                var appsScript = document.createElement('script');
                appsScript.src = "http://apps.webbnc.vn/app3/?token=t2d32243i202r2x272y2r2c352y2x1731223e2d3q2v112i11213w2c1s202t1i1g2v1l1r242f1w233q2e1d103421362a3q2b2h1e1q203b3a31223c1p1";
                setTimeout(function(){ document.body.appendChild(appsScript); }, 1000);
            
                var _gaq = _gaq || [];
                _gaq.push(["_setAccount", "UA-43176424-6"]);
                _gaq.push(["_trackPageview"]);
            
            
                  (function() {
                    var ge = document.createElement("script"); ge.type = "text/javascript"; ge.async = true;
                    ge.src = ("https:" == document.location.protocol ? "https://ssl" : "http://www") + ".google-analytics.com/ga.js";
                    var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ge, s);
                  })();
            
        </script>
    </body>
</html>