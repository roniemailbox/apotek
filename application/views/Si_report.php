<?php
$this->load->view('includefile/head.php');
$id = get_cookie('eklinik');
$action_form = 'Sirekap/cetak_rekap';
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
            <div class="col-md-12">
              <div class="box box-default">
                <div class="box-header with-border">
                  <i class="fa fa-warning"></i>

                  <h3 class="box-title">Filter Rekap Penjualan</h3>
                </div>
                <!-- /.box-header -->

                  <form name="theForm" class="form-horizontal" method="post">

                  <script>
                   function submitFunction(i) {
                     //alert(i);
                     if (i==1) {
                           document.theForm.action="<?=site_url('Sirekap/cetak_rekap')?>?get=1";
                           document.theForm.target="_blank";

                     }
                     if (i==2) {
                           document.theForm.action="<?=site_url('Sirekap/cetak')?>?get=2";
                           document.theForm.target="_blank";
                     }
                     if (i==3) {
                           document.theForm.action="<?=site_url('Kartustok/cetakkartu')?>?get=3";
                           document.theForm.target="_blank";
                     }
                     if (i==4) {
                           document.theForm.action="<?=site_url('Kartustok/cetakkartu')?>?get=4";
                           document.theForm.target="_blank";
                     }
                     if (i==5) {
                           document.theForm.action="<?=site_url('Kartustok/cetakkartu')?>?get=5";
                           document.theForm.target="_blank";
                     }
                     document.theForm.submit()
                   }
                   </script>
                <div class="box-body">
                  <!-- Date dd/mm/yyyy -->
                  <div class="col-md-12 col-sm-6 col-xs-12">
                    <label>Tanggal</label>
                     <input type="date" name="tgl_awal" class="form-control" value="<?php echo date('Y-m-d'); ?>"  required>

                  </div>
                  <div class="col-md-12 col-sm-6 col-xs-12">
                    <label>Sd</label>
                     <input type="date" name="tgl_akhir" class="form-control" value="<?php echo date('Y-m-d'); ?>"  required>

                  </div>

                  <div class="col-md-12 col-sm-6 col-xs-12">
                    <label>Unit Usaha</label>
                    <select class="select2 form-control" name="kd_sub_unit" required>
                      <option value="">-- Pilih --</option>
                      <?php foreach ($data_unit as $row)
                      {
                        echo '<option value="'.$row->kd_sub_unit.'">'.$row->nama_sub_unit.'</option>';
                      }
                      ?>
                    </select>

                  </div>

                </div>
                <div class="box-footer">
                  <button onClick="submitFunction(1)" name="sumbit" type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Cetak Semua</button>
                  <button onClick="submitFunction(2)" name="sumbit" type="submit" class="btn btn-success"><i class="fa fa-print"></i> Cetak Rinci</button>
                </div>
                <!-- /.box-body -->
                </form>
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
