<?php
include 'includefile/head.php';
$id = get_cookie('eklinik');
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo strtoupper($this->session->userdata('nama_perusahaan'.$id)); ?>
      <small>it all starts here</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Welcome Screen</a></li>

    </ol>
  </section>

  <!-- Main content -->
   HUBUNGI ADMIN
  <!-- /.content -->
</div>
<!--tambahkan custom js disini-->
<!-- jQuery UI 1.11.2 -->


<?php
include 'includefile/foot.php';
?>
