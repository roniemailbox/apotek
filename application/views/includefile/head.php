<?php
include 'validasi.php';
$id = get_cookie('eklinik');
$timezone = "Asia/Colombo";
date_default_timezone_set($timezone);
$today = date("Y-m-d");
$ses_kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
$ses_kd_unit=$this->session->userdata('kd_unit'.$id);

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/logo.png" />
  <title><?= $this->session->userdata('nama_perusahaan'.$id)?> | SiM</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<script> 
    window.intergramId = "-459614137";
    window.intergramCustomizations = {
        titleClosed: 'Tulis Pesan',
        titleOpen: 'Chat Klinik',
        introMessage: 'Selemat datang di layanag Q & A Telegram',
        autoResponse: 'Hai Selamat Bekerja',
        autoNoResponse: 'Pesan ini akan dibalas setelah  ' +
                        'secepatnya',
        mainColor: "#E91E63", // Can be any css supported color 'red', 'rgb(255,87,34)', etc
        alwaysUseFloatingButton: false // Use the mobile floating button also on large screens
    };
</script>
<script id="intergram" type="text/javascript" src="https://www.intergram.xyz/js/widget.js"></script>
			
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php  echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css') ?>">

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css') ?>">

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css') ?>">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') ?>">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') ?>">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/all.css') ?>">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') ?>">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/timepicker/bootstrap-timepicker.min.css') ?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/select2/dist/css/select2.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css') ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>">

  <!-- Google Font -->
  <!-- Datatables -->
  <link href="<?php echo base_url('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?php echo base_url('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?php echo base_url('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?php echo base_url('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?php echo base_url('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') ?>" rel="stylesheet">
  <style>
      .example-modal .modal {
        position: relative;
        top: auto;
        bottom: auto;
        right: auto;
        left: auto;
        display: block;
        z-index: 1;
      }

      .example-modal .modal {
        background: transparent !important;
      }
    </style>
  <style>
      .color-palette {
        height: 35px;
        line-height: 35px;
        text-align: center;
      }

      .color-palette-set {
        margin-bottom: 15px;
      }

      .color-palette span {
        display: none;
        font-size: 12px;
      }

      .color-palette:hover span {
        display: block;
      }

      .color-palette-box h4 {
        position: absolute;
        top: 100%;
        left: 25px;
        margin-top: -40px;
        color: rgba(255, 255, 255, 0.8);
        font-size: 12px;
        display: block;
        z-index: 7;
      }
    </style>
<script>
function localeFormat(x) {
       var num = Number(x).toLocaleString();
       if (num.indexOf("/.") > 0) {
         num += ".00";
       }else{
         var n = parseFloat(x).toFixed(2).toString();
         num = Number(n).toLocaleString();
       }
       return num;
     }

</script>

    <script>
    function startTime() {
        var today = new Date();
        //var d = today.getDay();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('txt').innerHTML =
        h + ":" + m + ":" + s;
        var t = setTimeout(startTime, 500);
    }
    function checkTime(i) {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
    }
    </script>

    <script type="text/javascript">
    idleMax = 30;// Logout after 10 minutes of IDLE
    idleTime = 0;
    $(document).ready(function () {
        var idleInterval = setInterval("timerIncrement()", 60000);
        $(this).mousemove(function (e) {idleTime = 0;});
        $(this).keypress(function (e) {idleTime = 0;});
    })
    function timerIncrement() {
        idleTime = idleTime + 1;
        if (idleTime > idleMax) {
             alert("AUTOMATIS LOGOUT, USER ANDA TIDAK DIGUNAKAN SELAMA 30 MENIT.....!!!");
             window.location="<?=site_url('Login/logout/'.$id)?>";
        }
    }
    </script>


    <script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery-1.8.2.min.js'></script>
    <script type="text/javascript" src='<?php echo base_url();?>assets/js/jquery.js'></script>
    <script type="text/javascript" src='<?php echo base_url();?>assets/js/chosen.jquery.js'></script>
    <script type="text/javascript" src='<?php echo base_url();?>assets/bootstrap/jquery.min.js'></script>

</head>

       <body class="hold-transition skin-blue sidebar-mini"  onload="startTime()">
        <!--<body class="hold-transition skin-blue sidebar-collapse sidebar-mini" onload="startTime()">--->

          <!-- Site wrapper -->
          <div class="wrapper">

              <header class="main-header">
                  <a href="utama" class="logo"><b>eKlinik</b><?php echo strtoupper($this->session->userdata('alias_perusahaan'.$id)); ?>

                  </a>

                  <!-- Header Navbar: style can be found in header.less -->
                  <nav class="navbar navbar-static-top">
                      <!-- Sidebar toggle button-->
                      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                          <span class="sr-only">NAV</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                      </a>
                      <div class="navbar-custom-menu">
                          <ul class="nav navbar-nav">
                              <!-- Messages: style can be found in dropdown.less-->

                              <!-- Notifications: style can be found in dropdown.less -->

                              <!-- Tasks: style can be found in dropdown.less -->

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
                                              <small>Tanggal Masuk :  <?php echo $this->session->userdata('tgl_masuk'.$id); ?></small>
                                              <small> <?php echo $this->session->userdata('nama_unit'.$id).' ('.$this->session->userdata('kd_unit'.$id).')'; ?>  <?php echo $this->session->userdata('nama_sub_unit'.$id).' ('.$this->session->userdata('kd_sub_unit'.$id).')'; ?></small>
                                          </p>
                                      </li>
                                      <!-- Menu Body -->
                                      <li class="user-body">
                                          <div class="col-xs-6 text-center">
                                              <a href="#"><?php echo $this->session->userdata('nama_jabatan'.$id); ?></a>
                                          </div>
                                          <div class="col-xs-6 text-center">
                                              <a href="#"><?php echo $this->session->userdata('nama_jenis'.$id); ?></a>
                                          </div>

                                      </li>
                                      <!-- Menu Footer-->
                                      <li class="user-footer">
                                          <div class="pull-left">
                                              <a href="#" class="btn btn-default btn-flat">Profile</a>
                                          </div>
                                          <div class="pull-right">
                                              <a href="<?php echo site_url('Auth/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                                          </div>
                                      </li>
                                  </ul>
                              </li>
                              <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
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
