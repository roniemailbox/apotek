<?php

include 'validasi.php';
$timezone = "Asia/Colombo";
date_default_timezone_set($timezone);
$today = date("Y-m-d");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $this->session->userdata('nama_perusahaan'.$id)?> | SiM</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="<?php echo base_url('assets/font-awesome-4.3.0/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo base_url('assets/ionicons-2.0.1/css/ionicons.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/dist/css/AdminLTE.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/dist/css/skins/_all-skins.min.css') ?>" rel="stylesheet" type="text/css" />
        <!--tambahkan custom css disini-->
        <!-- iCheck -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/flat/blue.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/morris/morris.css') ?>" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jvectormap/jquery-jvectormap-1.2.2.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datepicker/datepicker3.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/daterangepicker/daterangepicker-bs3.css') ?>" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Select2 -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/select2/dist/css/select2.min.css') ?>" rel="stylesheet" >
        <!-- Datatables -->
        <link href="<?php echo base_url('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') ?>" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>

        <![endif]-->
      </head>
      <body class="skin-blue">
          <!-- Site wrapper -->
          <div class="wrapper">
      <?php $id = get_cookie('tkkop'); ?>
              <header class="main-header">
                  <a href="#" class="logo"><b>SiM </b><?php echo strtoupper($this->session->userdata('alias_perusahaan'.$id)); ?></a>
                  <!-- Header Navbar: style can be found in header.less -->
                  <nav class="navbar navbar-static-top" role="navigation">
                      <!-- Sidebar toggle button-->
                      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                      </a>
                      <div class="navbar-custom-menu">
                          <ul class="nav navbar-nav">
                              <!-- Messages: style can be found in dropdown.less-->
                              <li class="dropdown messages-menu">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                      <i class="fa fa-envelope-o"></i>
                                      <span class="label label-success">4</span>
                                  </a>
                                  <ul class="dropdown-menu">
                                      <li class="header">You have 4 messages</li>
                                      <li>
                                          <!-- inner menu: contains the actual data -->
                                          <ul class="menu">
                                              <li><!-- start message -->
                                                  <a href="#">
                                                      <div class="pull-left">
                                                          <img src="<?php echo base_url(); ?>assets/foto/<?php echo $this->session->userdata('foto_pic'.$id); ?>" class="img-circle" alt="User Image"/>
                                                      </div>
                                                      <h4>
                                                          Support Team
                                                          <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                      </h4>
                                                      <p>Why not buy a new awesome theme?</p>
                                                  </a>
                                              </li><!-- end message -->
                                          </ul>
                                      </li>
                                      <li class="footer"><a href="#">See All Messages</a></li>
                                  </ul>
                              </li>
                              <!-- Notifications: style can be found in dropdown.less -->
                              <li class="dropdown notifications-menu">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                      <i class="fa fa-bell-o"></i>
                                      <span class="label label-warning">10</span>
                                  </a>
                                  <ul class="dropdown-menu">
                                      <li class="header">You have 10 notifications</li>
                                      <li>
                                          <!-- inner menu: contains the actual data -->
                                          <ul class="menu">
                                              <li>
                                                  <a href="#">
                                                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                                  </a>
                                              </li>
                                          </ul>
                                      </li>
                                      <li class="footer"><a href="#">View all</a></li>
                                  </ul>
                              </li>
                              <!-- Tasks: style can be found in dropdown.less -->
                              <li class="dropdown tasks-menu">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                      <i class="fa fa-flag-o"></i>
                                      <span class="label label-danger">9</span>
                                  </a>
                                  <ul class="dropdown-menu">
                                      <li class="header">You have 9 tasks</li>
                                      <li>
                                          <!-- inner menu: contains the actual data -->
                                          <ul class="menu">
                                              <li><!-- Task item -->
                                                  <a href="#">
                                                      <h3>
                                                          Design some buttons
                                                          <small class="pull-right">20%</small>
                                                      </h3>
                                                      <div class="progress xs">
                                                          <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                              <span class="sr-only">20% Complete</span>
                                                          </div>
                                                      </div>
                                                  </a>
                                              </li><!-- end task item -->
                                          </ul>
                                      </li>
                                      <li class="footer">
                                          <a href="#">View all tasks</a>
                                      </li>
                                  </ul>
                              </li>
                              <!-- User Account: style can be found in dropdown.less -->
                              <li class="dropdown user user-menu">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                      <img src="<?php echo base_url(); ?>assets/foto/<?php echo $this->session->userdata('foto_pic'.$id); ?>" class="user-image" alt="User Image"/>
                                      <span class="hidden-xs"><?php echo strtoupper($this->session->userdata('nama'.$id)); ?></span>
                                  </a>
                                  <ul class="dropdown-menu">
                                      <!-- User image -->
                                      <li class="user-header">
                                          <img src="<?php echo base_url(); ?>assets/foto/<?php echo $this->session->userdata('foto_pic'.$id); ?>" class="img-circle" alt="User Image" />
                                          <p>
                                              <?php echo strtoupper($this->session->userdata('nama'.$id)); ?>
                                              <small>Member since Nov. 2012</small>
                                          </p>
                                      </li>
                                      <!-- Menu Body -->
                                      <li class="user-body">
                                          <div class="col-xs-4 text-center">
                                              <a href="#">Followers</a>
                                          </div>
                                          <div class="col-xs-4 text-center">
                                              <a href="#">Sales</a>
                                          </div>
                                          <div class="col-xs-4 text-center">
                                              <a href="#">Friends</a>
                                          </div>
                                      </li>
                                      <!-- Menu Footer-->
                                      <li class="user-footer">
                                          <div class="pull-left">
                                              <a href="#" class="btn btn-default btn-flat">Profile</a>
                                          </div>
                                          <div class="pull-right">
                                              <a href="<?php echo site_url('auth/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                                          </div>
                                      </li>
                                  </ul>
                              </li>
                          </ul>
                      </div>
                  </nav>
              </header>

              <!-- =============================================== -->
              <!-- Left side column. contains the sidebar -->
              <aside class="main-sidebar">
                  <!-- sidebar: style can be found in sidebar.less -->
                  <section class="sidebar">
                       <?php include 'menu.php'; ?>
                  </section>
                  <!-- /.sidebar -->
              </aside>

              <!-- =============================================== -->

              <!-- Content Wrapper. Contains page content -->
