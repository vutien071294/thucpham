<?php

/* @var $this \yii\web\View */
/* @var $content string */
use backend\assets\DashboardAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use backend\components\ComponentBase;
use backend\modules\users\models\Userinfo;
use backend\modules\systems\models\Authassignment;
// use backend\assets\CkeditorAsset;


DashboardAsset::register($this);
// CkeditorAsset::register($this);

$components = new ComponentBase();
$base_url = $components->Base_url();
$base_url_frontend = $components->Base_url_images();

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?= Html::csrfMetaTags() ?>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <style>
        .goto_home{
            font-size: 14px;
            color: white;
            cursor: pointer;
        }
    </style>

</head>
<?php $this->beginBody() ?>
<body class="hold-transition skin-purple-light sidebar-mini">


<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="<?= $base_url ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>H</b>T</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>HT-Admin</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="goto_home" > 
                <a target="blank" href="<?= $base_url_frontend ?>" >
                    Đến trang chủ
                </a>
            </li>
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php 
                            if(Yii::$app->user->identity->image){    //echo $base_url."dist/img/".Yii::$app->user->identity->image; 
                                echo $base_url."dist/img/".Yii::$app->user->identity->image; 
                              }else 
                                { 
                                echo $base_url."dist/img/nothing.png";
                               } ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php if (Yii::$app->user->identity->username ) {
                    echo Yii::$app->user->identity->username;
                  } ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php 
                            if(Yii::$app->user->identity->image){
                                echo $base_url."dist/img/".Yii::$app->user->identity->image; 
                              }else 
                                { 
                                echo $base_url."dist/img/nothing.png";
                               } ?>" class="img-circle" alt="User Image">

                    <p>
                    <?php 
                      $userrole = Authassignment::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
                        $user_info = new Userinfo();
                        if ($userrole['item_name']) {
                          $role_user = $userrole['item_name'];
                          $list_permission = $user_info->get_list_permission($role_user);
                        }else{
                          $role_user  = '';
                        }

                     ?>
                      <?php if (Yii::$app->user->identity->username ) {
                        echo Yii::$app->user->identity->username;
                      } ?> - <?= $role_user ?>
                      <small>Member since <?php echo date('d-m-Y', Yii::$app->user->identity->created_at); ?> </small>
                      <a href="<?php echo $base_url?>users/changepass" class="user_a_login"><small>Đổi mật khẩu</small></a>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?php echo $base_url?>users/user/update?id=<?= base64_encode(Yii::$app->user->identity->id) ?>" class="btn btn-default btn-flat">Hồ sơ cá nhân</a>
                  </div>
                  <div class="pull-right">
                      <form action="<?php echo $base_url?>site/logout" method="post">
                        <input type="hidden" name="_csrf" value="==">
                        <button type="submit" class="btn btn-default btn-flat">Đăng xuất</button></form>
                  </div>
                </li>

                </ul>
              </li>
            </ul>
          </div>
        </nav>
    </header>
     <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar" >
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-folder"></i> <span>Quản lý công trình</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li id="product_product_type"><a href="<?php echo  $base_url ?>product/product_type"><i class="fa fa-circle-o"></i>Danh mục công trình</a></li>
                        <li id=""><a href="<?php echo  $base_url ?>contents/construction"><i class="fa fa-circle-o"></i>Quản lý công trình</a></li>
                    </ul>
                </li> 
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-table"></i> <span>Quản lý Sản phẩm</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                          <li id="product_dmsanpham"><a href="<?php echo  $base_url ?>product/dmsanpham"><i class="fa fa-circle-o"></i>Danh mục sản phẩm</a></li>
                          <li id="product_quanlysanpham"><a href="<?php echo  $base_url ?>product/quanlysanpham"><i class="fa fa-circle-o"></i>Quản lý sản phẩm</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-rocket"></i> <span>Quản lý dịch vụ</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                          <li id="service_service"><a href="<?php echo  $base_url ?>service/service"><i class="fa fa-circle-o"></i>Danh sách dịch vụ</a></li>
                          <li id=""><a href="<?php echo  $base_url ?>service/service/create"><i class="fa fa-circle-o"></i>Thêm mới</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-industry"></i> <span>Thương Mại</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                          <li id="product_dmsanpham"><a href="<?php echo  $base_url ?>trade/trade"><i class="fa fa-circle-o"></i>Danh sách thương mại</a></li>
                          <li id="product_quanlysanpham"><a href="<?php echo  $base_url ?>trade/trade/create"><i class="fa fa-circle-o"></i>Thêm mới</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-group"></i> <span>Đầu tư</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                          <li id="product_dmsanpham"><a href="<?php echo  $base_url ?>invest/invest"><i class="fa fa-circle-o"></i>Danh sách đầu tư</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-book"></i> <span>Quản lý cẩm nang</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                          <li id="handbook_handbook"><a href="<?php echo  $base_url ?>handbook/handbook"><i class="fa fa-circle-o"></i>Danh sách cẩm nang</a></li>
                          <li id=""><a href="<?php echo  $base_url ?>handbook/handbook/create"><i class="fa fa-circle-o"></i>Thêm mới</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span>Hệ thống</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li id="users_user"><a href="<?php echo $base_url ?>users/user" ><i class="fa fa-circle-o"></i> Người dùng</a></li>
                        <li id="systems_banner"><a href="<?php echo $base_url ?>systems/banner"><i class="fa fa-circle-o"></i>Quản lý banner</a></li>
                        <li id="systems_info"><a href="<?php echo $base_url ?>systems/info"><i class="fa fa-circle-o"></i>Quản lý thông tin công ty</a></li>
                    </ul>
                </li>
               
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

     <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <?= $content ?>
    </section>
    </div>
</div>
<aside class="control-sidebar control-sidebar-dark" tabindex="-1">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" tabindex="-1"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" tabindex="-1"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Admin <?= date('Y') ?></p>

        <p class="pull-right">Powered by <a>Nbee</a></p>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
        $(document).ready(function(){ 
            var ul = document.getElementsByClassName("treeview-menu");
            var url = window.location.pathname.replace(/\//g,"_"); 
            for (var i = 0; i < ul.length; i++) {
                var x = ul[i].getElementsByTagName('li');
                for(var j =0; j < x.length; j++)
                {
                   var id = x[j].getAttribute('id');
                   if (url.indexOf(id) != -1) 
                    {
                        $("#"+id).addClass("active" );
                        $(".active").closest("ul.sidebar-menu > li > ul.treeview-menu").addClass("active" );
                        $(".active").closest("li.treeview").addClass("active" );
                    }
                }
            }
            
        });
      </script>
<style>
    .treeview-menu li a.active{
        color: black;
        font-weight: bold;
    }
</style>

<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">


<!--End of Tawk.to Script-->
</body>
<?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>
