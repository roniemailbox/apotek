<?php
$this->load->view('includefile/head.php');
$id = get_cookie('tkkop');
?>

<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <h1>
       <?php //echo $title ?>

     </h1>
     <ol class="breadcrumb">
       <li><a href="<?php echo site_url('Utama') ?>"><i class="fa fa-dashboard"></i> Home</a></li>

     </ol>
   </section>
  <!-- Main content -->
  <section class="content" >
<br>
    <div class="row">


            <!-- /.col -->
            <div class="col-md-12">
              <!-- Widget: user widget style 1 -->
              <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-black" style="background: url('<?php echo base_url(); ?>assets/images/kopkar.png') center center;">
                  <h3 class="widget-user-username"><?php echo strtoupper($this->session->userdata('nama'.$id)); ?></h3>
                  <h5 class="widget-user-desc"><?php echo strtoupper($this->session->userdata('nama_jabatan'.$id)); ?></h5>
                </div>
                <div class="widget-user-image">
                  <img class="img-circle" src="<?php echo base_url(); ?>assets/foto/<?php echo $this->session->userdata('foto_pic'.$id); ?>" alt="User Avatar">
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-sm-6 border-right">
                      <div class="description-block">
                        <h5 class="description-header">3,200</h5>
                        <span class="description-text">SALES</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6 border-right">
                      <div class="description-block">
                        <h5 class="description-header">13,000</h5>
                        <span class="description-text">FOLLOWERS</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->

                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
              </div>
              <!-- /.widget-user -->
            </div>
            <!-- /.col -->
          </div>

    <div class="row">
            <div class="col-md-12">
              <div class="box box-default">
                <div class="box-header with-border">
                  <i class="fa fa-warning"></i>

                  <h3 class="box-title">Pemberitahuan</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                    SEMANGAT
                  </div>
                  <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-info"></i> Alert!</h4>
                    SEMANGAT
                  </div>
                  <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                    SEMANGAT
                  </div>
                  <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Alert!</h4>
                    SEMANGAT
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->


            <!-- /.col -->
          </div>

  </section>
  <!-- /.content -->
</div>
<!--tambahkan custom js disini-->
<!-- jQuery UI 1.11.2 -->


<?php
$this->load->view('includefile/foot.php');
?>
