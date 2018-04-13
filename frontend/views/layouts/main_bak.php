<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\components\ComponentBase;
use frontend\modules\danhmuc\models\Danhmuc;
use backend\modules\users\models\User;
use backend\modules\users\models\Userinfo;
use frontend\modules\banner\models\Banner;
use backend\modules\systems\models\Info;
use backend\modules\product\models\Product_type;
use backend\modules\product\models\Dmsanpham;
use backend\modules\service\models\Service;
AppAsset::register($this);
$components = new ComponentBase();
$base_url = $components->Base_url();
$base_url_frontend = $components->Base_url_images();
$danhmuc = new Danhmuc();
$cate_list = $danhmuc->get_cate_all();
$company_info = Info::find()->all();
$parent_product = Product_type::find()->where(['level'=>1])->all();
$sanpham = Dmsanpham::find()->all();
$service = Service::find()->all();
?>


<!DOCTYPE html>
<!-- saved from url=(0034)# -->
<html lang="vi" prefix="og: http://ogp.me/ns#" class="js no-svg">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <script id="facebook-jssdk" src="<?php echo $base_url ?>/css/jscss/sdk.js.download"></script><script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>
        <link rel="icon" type="image/png" href="<?php echo $base_url ?>public/images/logo/logo-1521196677.jpg">
        <title>Công ty cổ phần đầu tư XD và thương mại Asaco</title>
        <script src="./css/jscss/wp-emoji-release.min.js.download" type="text/javascript" defer=""></script>
        <link rel="stylesheet" id="siteorigin-panels-front-css" href="<?php echo $base_url ?>/css/jscss/front-flex.css" type="text/css" media="all">
        <link rel="stylesheet" id="vietmoz-style-css" href="<?php echo $base_url ?>/css/jscss/main.css" type="text/css" media="all">
        <link rel="stylesheet" id="vmz-style-css" href="<?php echo $base_url ?>/css/jscss/vmz.css" type="text/css" media="all">
        <link rel="stylesheet" id="vietmoz-icon-css" href="<?php echo $base_url ?>/css/jscss/ionicons.min.css" type="text/css" media="all">
        <!--[if lt IE 9]>
        <link rel='stylesheet' id='vietmoz-ie8-css'  href='#wp-content/themes/vietmoz/assets/css/ie8.css?ver=1.0' type='text/css' media='all' />
        <![endif]-->
        <script type="text/javascript" src="<?php echo $base_url ?>/css/jscss/jquery.js.download"></script>
        <script type="text/javascript" src="<?php echo $base_url ?>/css/jscss/jquery-migrate.min.js.download"></script>
        <script type="text/javascript" src="<?php echo $base_url ?>/css/jscss/headroom.min.js.download"></script>
        <script type="text/javascript" src="<?php echo $base_url ?>/css/jscss/isotope.min.js.download"></script>
        <!--[if lt IE 9]>
        <script type='text/javascript' src='#wp-content/themes/vietmoz/assets/js/lib/html5.js?ver=3.7.3'></script>
        <![endif]-->
        <link rel="https://api.w.org/" href="#wp-json/">
        <link rel="EditURI" type="application/rsd+xml" title="RSD" href="#xmlrpc.php?rsd">
        <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="#wp-includes/wlwmanifest.xml">
        <meta name="generator" content="WordPress 4.8">
        <link rel="shortlink" href="#">
        <link rel="icon" href="#wp-content/themes/vietmoz/assets/images/favicon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body class="home page-template page-template-templates page-template-page-full-width page-template-templatespage-full-width-php page page-id-535 siteorigin-panels  siteorigin-panels-home website-style-custom widget-style-2 sidebar-right footer-layout-10" cz-shortcut-listen="true">
        <style>.fb-livechat, .fb-widget{display: none}.ctrlq.fb-button, .ctrlq.fb-close{position: fixed; right: 24px; cursor: pointer}.ctrlq.fb-button{z-index: 999; background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjwhRE9DVFlQRSBzdmcgIFBVQkxJQyAnLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4nICAnaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkJz48c3ZnIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDEyOCAxMjgiIGhlaWdodD0iMTI4cHgiIGlkPSJMYXllcl8xIiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCAxMjggMTI4IiB3aWR0aD0iMTI4cHgiIHhtbDpzcGFjZT0icHJlc2VydmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxnPjxyZWN0IGZpbGw9IiMwMDg0RkYiIGhlaWdodD0iMTI4IiB3aWR0aD0iMTI4Ii8+PC9nPjxwYXRoIGQ9Ik02NCwxNy41MzFjLTI1LjQwNSwwLTQ2LDE5LjI1OS00Niw0My4wMTVjMCwxMy41MTUsNi42NjUsMjUuNTc0LDE3LjA4OSwzMy40NnYxNi40NjIgIGwxNS42OTgtOC43MDdjNC4xODYsMS4xNzEsOC42MjEsMS44LDEzLjIxMywxLjhjMjUuNDA1LDAsNDYtMTkuMjU4LDQ2LTQzLjAxNUMxMTAsMzYuNzksODkuNDA1LDE3LjUzMSw2NCwxNy41MzF6IE02OC44NDUsNzUuMjE0ICBMNTYuOTQ3LDYyLjg1NUwzNC4wMzUsNzUuNTI0bDI1LjEyLTI2LjY1N2wxMS44OTgsMTIuMzU5bDIyLjkxLTEyLjY3TDY4Ljg0NSw3NS4yMTR6IiBmaWxsPSIjRkZGRkZGIiBpZD0iQnViYmxlX1NoYXBlIi8+PC9zdmc+) center no-repeat #0084ff; width: 60px; height: 60px; text-align: center; bottom: 50px; border: 0; outline: 0; border-radius: 60px; -webkit-border-radius: 60px; -moz-border-radius: 60px; -ms-border-radius: 60px; -o-border-radius: 60px; box-shadow: 0 1px 6px rgba(0, 0, 0, .06), 0 2px 32px rgba(0, 0, 0, .16); -webkit-transition: box-shadow .2s ease; background-size: 80%; transition: all .2s ease-in-out}.ctrlq.fb-button:focus, .ctrlq.fb-button:hover{transform: scale(1.1); box-shadow: 0 2px 8px rgba(0, 0, 0, .09), 0 4px 40px rgba(0, 0, 0, .24)}.fb-widget{background: #fff; z-index: 1000; position: fixed; width: 360px; height: 435px; overflow: hidden; opacity: 0; bottom: 0; right: 24px; border-radius: 6px; -o-border-radius: 6px; -webkit-border-radius: 6px; box-shadow: 0 5px 40px rgba(0, 0, 0, .16); -webkit-box-shadow: 0 5px 40px rgba(0, 0, 0, .16); -moz-box-shadow: 0 5px 40px rgba(0, 0, 0, .16); -o-box-shadow: 0 5px 40px rgba(0, 0, 0, .16)}.fb-credit{text-align: center; margin-top: 8px}.fb-credit a{transition: none; color: #bec2c9; font-family: Helvetica, Arial, sans-serif; font-size: 12px; text-decoration: none; border: 0; font-weight: 400}.ctrlq.fb-overlay{z-index: 0; position: fixed; height: 100vh; width: 100vw; -webkit-transition: opacity .4s, visibility .4s; transition: opacity .4s, visibility .4s; top: 0; left: 0; background: rgba(0, 0, 0, .05); display: none}.ctrlq.fb-close{z-index: 4; padding: 0 6px; background: #365899; font-weight: 700; font-size: 11px; color: #fff; margin: 8px; border-radius: 3px}.ctrlq.fb-close::after{content: "X"; font-family: sans-serif}.bubble{width: 20px; height: 20px; background: #c00; color: #fff; position: absolute; z-index: 999999999; text-align: center; vertical-align: middle; top: -2px; left: -5px; border-radius: 50%;}.bubble-msg{width: 120px; left: -140px; top: 5px; position: relative; background: rgba(59, 89, 152, .8); color: #fff; padding: 5px 8px; border-radius: 8px; text-align: center; font-size: 13px;}</style><div class="fb-livechat"> <div class="ctrlq fb-overlay"></div><div class="fb-widget"> <div class="ctrlq fb-close"></div><div class="fb-page" data-href="https://www.facebook.com/noithatasacovn" data-tabs="messages" data-width="360" data-height="400" data-small-header="true" data-hide-cover="true" data-show-facepile="false"> </div><div class="fb-credit"> <a href="https://chanhtuoi.com" target="_blank"></a> </div><div id="fb-root"></div></div><a href="https://m.me/noithatasacovn" title="Gửi tin nhắn cho chúng tôi qua Facebook" class="ctrlq fb-button"> <div class="bubble">1</div><div class="bubble-msg">Bạn cần hỗ trợ?</div></a></div><script src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9"></script><script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script><script>$(document).ready(function(){function detectmob(){if( navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i) ){return true;}else{return false;}}var t={delay: 125, overlay: $(".fb-overlay"), widget: $(".fb-widget"), button: $(".fb-button")}; setTimeout(function(){$("div.fb-livechat").fadeIn()}, 8 * t.delay); if(!detectmob()){$(".ctrlq").on("click", function(e){e.preventDefault(), t.overlay.is(":visible") ? (t.overlay.fadeOut(t.delay), t.widget.stop().animate({bottom: 0, opacity: 0}, 2 * t.delay, function(){$(this).hide("slow"), t.button.show()})) : t.button.fadeOut("medium", function(){t.widget.stop().show().animate({bottom: "30px", opacity: 1}, 2 * t.delay), t.overlay.fadeIn(t.delay)})})}});</script>
        <div id="page" class="site">
            <header id="masthead" class="site-header header-v1d bg-color-main" role="banner">
                <div style="width: 100%; background-color: #ff4c4c">
                    <div class="container heading-top">
                        <div class="insider">
                            <div class="col-md-3" style="height: 125%; background-color: white; margin-bottom: -30px;">
                                <div class="col-md-12 top-logo">
                                    <a href="<?php echo $base_url ?>" rel="home">
                                        <img src="<?php echo $base_url ?>public/images/logo/<?php echo $company_info[0]['logo'] ?>" width="100%">
                                    </a>
                                </div>
                            </div>
                            <div class="right-content col-md-9 top-content" style="color: white">
                                <h4><b><?php echo $company_info[0]['fullname'] ?></b></h4>
                                <p><?php echo $company_info[0]['address'] ?></p>
                                <p>ĐT : <?php echo $company_info[0]['phone'] ?> || Hotline : <?php echo $company_info[0]['hotline'] ?></p>
                            </div>
                        </div>
                        <!-- /.insider -->
                    </div>
                </div>
                <div style="width: 100%; height: 5px; background-color: white"></div>
                
                <!-- /.container -->
                <nav id="primary-menu" class="main-menu" role="navigation" aria-label="Menu chính">
                    <div class="container">
                        <ul id="menu-menu-chinh" class="vietmoz-menu">
                            <?php foreach ($parent_product as $key => $value) { ?>
                                <?php 
                                var_dump($key);
                                    $parent_id = $value['id'];
                                    $child_product = Product_type::find()->where(['level'=>2, 'parent_id'=>$parent_id])->all();
                                ?>
                                <li id="menu-item-590" class="menu-item menu-item-type-post_type menu-item-has-children menu-item-object-page menu-item-590">
                                    <a href="#"><?php echo $value['title'] ?></a>
                                    <ul class="sub-menu">
                                        <?php foreach ($child_product as $key_child => $value_child) { ?>
                                            <li id="menu-item-627" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-627"><a href="<?php echo $base_url ?>contruction?prm=<?php echo $value_child['id'] ?>"><?php echo $value_child['title'] ?></a></li>
                                        <?php } ?>
                                        <?php 
                                        if ($key == 0) { ?>
                                            <li id="menu-item-590" class="menu-item menu-item-type-post_type menu-item-has-children menu-item-object-page menu-item-590">
                                                <a href="#">Sản phẩm nội thất</a>
                                                <ul class="sub-menu">
                                                   <?php foreach ($sanpham as $key => $value) {?>
                                                        <li id="menu-item-627" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-627"><a href="<?php echo $base_url ?>product?prm=<?php echo $value['id'] ?>"><?php echo $value['title'] ?></a></li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                            <li id="menu-item-590" class="menu-item menu-item-type-post_type menu-item-has-children menu-item-object-page menu-item-590">
                                                <a href="#">Đăng kí thiết kế</a>
                                                <ul class="sub-menu">
                                                   <?php foreach ($service as $key => $value) { ?>
                                                        <li id="menu-item-627" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-627"><a href="<?php echo $base_url ?>service/detail?prm=<?php echo $value['id'] ?>"><?php echo $value['title'] ?></a></li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        <?php 
                                        }else { ?>
                                            <li id="menu-item-590" class="menu-item menu-item-type-post_type menu-item-has-children menu-item-object-page menu-item-590">
                                                <a href="#">Thiết bị xây dựng</a>
                                                <ul class="sub-menu">
                                                   <?php foreach ($sanpham as $key => $value) {?>
                                                        <li id="menu-item-627" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-627"><a href="<?php echo $base_url ?>product?prm=<?php echo $value['id'] ?>"><?php echo $value['title'] ?></a></li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        <?php  }
                                        ?>
                                    </ul>
                                </li>
                            <?php } ?>
                            <li id="menu-item-631" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-631 menu-item-has-children">
                                <a href="#">Sản phẩm</a>
                                <ul class="sub-menu">
                                    <?php foreach ($sanpham as $key => $value) {?>
                                        <li id="menu-item-627" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-627"><a href="<?php echo $base_url ?>product?prm=<?php echo $value['id'] ?>"><?php echo $value['title'] ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <li id="menu-item-631" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-631 menu-item-has-children">
                                <a href="#">Dịch vụ</a>
                                <ul class="sub-menu">
                                    <?php foreach ($service as $key => $value) { ?>
                                        <li id="menu-item-627" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-627"><a href="<?php echo $base_url ?>service/detail?prm=<?php echo $value['id'] ?>"><?php echo $value['title'] ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <li id="menu-item-633" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-633"><a href="<?php echo $base_url ?>image">Thư viện ảnh</a></li>
                            <li id="menu-item-634" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-634"><a href="<?php echo $base_url ?>info">Giới thiệu</a></li>
                        </ul>
                    </div>
                    <!-- /.container -->
                </nav>
                <!-- /#primary-menu.main-menu -->
            </header>
            <!-- .site-header -->
            <div id="mhead" class="site-header default-mobile-header" role="banner">
                <div class="container">
                    <div class="insider">
                        <div class="menu-toggler simple glyphicon glyphicon-menu-hamburger">
                            Menu                
                        </div>
                        <!-- /.menu-toggler -->
                        <div class="site-title">
                            <a href="#" rel="home">
                                <img src="<?php echo $base_url ?>public/images/logo/<?php echo $company_info[0]['logo'] ?>" width="40">
                            </a>
                        </div>
                        <div class="header-buttons">
                            <!-- /.search-toogler -->
                        </div>
                    </div>
                    <!-- /.insider -->
                </div>
                <!-- /.container -->
                <div id="nav-holder">
                    <nav id="m-menu" class="mobile-menu" role="navigation" aria-label="Menu mobile" style="display: none;">
                        <div class="container">
                            <ul id="menu-menu-chinh-1" class="vietmoz-m-menu">
                                <li class="home menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-7"><a href="#">Trang chủ</a></li>
                                <?php foreach ($parent_product as $key => $value) { ?>
                                <?php 
                                    $parent_id = $value['id'];
                                    $child_product = Product_type::find()->where(['level'=>2, 'parent_id'=>$parent_id])->all();
                                ?>
                                <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-626">
                                    <a href="#"><?php echo $value['title'] ?></a><span class="dropdown-toggler glyphicon glyphicon-chevron-down"></span>
                                    <ul class="sub-menu">
                                        <?php foreach ($child_product as $key_child => $value_child) { ?>
                                            <li id="menu-item-627" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-627"><a href="<?php echo $base_url ?>contruction?prm=<?php echo $value_child['id'] ?>"><?php echo $value_child['title'] ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <?php } ?>
                                <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-626">
                                    <a href="#">Sản phẩm</a><span class="dropdown-toggler glyphicon glyphicon-chevron-down"></span>
                                    <ul class="sub-menu">
                                        <?php foreach ($sanpham as $key => $value) { ?>
                                            <li id="menu-item-627" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-627"><a href="#"><?php echo $value['title'] ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-626">
                                    <a href="#">Dịch vụ</a><span class="dropdown-toggler glyphicon glyphicon-chevron-down"></span>
                                    <ul class="sub-menu">
                                        <?php foreach ($service as $key => $value) { ?>
                                            <li id="menu-item-627" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-627"><a href="<?php echo $base_url ?>service?prm=<?php echo $value['id'] ?>"><?php echo $value['title'] ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-631"><a href="<?php echo $base_url ?>image">thư viện ảnh</a></li>
                                <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-632"><a href="<?php echo $base_url ?>info">giới thiệu</a></li>
                            </ul>
                        </div>
                        <!-- /.container -->
                    </nav>
                    <!-- /#m-menu.mobile-menu -->
                </div>
                <!-- /#nav-holder -->
            </div>
         
            <!-- #mhead -->
            <?= $content ?>
            <!-- /#content -->
            <footer id="colophon" class="site-footer" role="contentinfo">
                <div class="container">
                    <div class="row col-md-12" style="padding-bottom: 20px;">
                        <div class="footer1" style="width: 40%; margin-top: 35px; height: 150px;">
                            <P><b><?php echo $company_info[0]['fullname'] ?></b></P>
                            <p>Văn phòng thiết kế : <?php echo $company_info[0]['address'] ?></p>
                            <p>ĐT : <?php echo $company_info[0]['phone'] ?> || <?php echo $company_info[0]['hotline'] ?></p>
                            <p>Email : <?php echo $company_info[0]['email'] ?> </p>
                        </div>
                        <div class="footer2" style="width: 30%; height: 150px;">
                            <h5><b style="color: white">BẢN ĐỒ</b></h5>
                            <div id="map" style="width:100%;">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.632938467271!2d105.83112901430705!3d20.967250895252565!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac543fb36301%3A0xae62b295cf02c0e6!2zQ2h1bmcgY8awIFZQNiBCw6FuIMSQ4bqjbyBMaW5oIMSQw6Bt!5e0!3m2!1svi!2s!4v1521431222586"  frameborder="0" style="border:0" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="footer3" style="width: 30%; height: 150px;">
                            <div id="fb-root"></div>
                            <h5><b style="color: white">FACEBOOK</b></h5>
                            <script>
                                (function(d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0];
                                    if (d.getElementById(id)) return;
                                    js = d.createElement(s); js.id = id;
                                    js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.12';
                                    fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));
                            </script>
                            <div class="fb-page" data-href="https://www.facebook.com/noithatasacovn/" data-tabs="timeline" data-width="300" data-height="250" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                                <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fnoithatasacovn%2F&tabs=timeline&width=300&height=250&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="300" height="150" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container -->
            </footer>
        </div>
        <!-- #page -->
        <script type="text/javascript" src="./css/jscss/imagesloaded.min.js.download"></script>
        <script type="text/javascript">
            /* <![CDATA[ */
            var VIETMOZ = {"headroom":"","m_headroom":"","ajaxurl":"http:\/\/gioithieu.web.vietmoz.info\/wp-admin\/admin-ajax.php"};
            /* ]]> */
        </script>
        <script type="text/javascript" src="./css/jscss/main.js.download"></script>
        <script type="text/javascript" src="./css/jscss/vmz.js.download"></script>
        <script type="text/javascript" src="./css/jscss/wp-embed.min.js.download"></script>
        <script type="text/javascript">document.body.className = document.body.className.replace("siteorigin-panels-before-js","");</script>
    </body>
</html>