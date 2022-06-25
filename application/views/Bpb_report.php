<?php
$this->load->view('includefile/head.php');
$id = get_cookie('tkkop');
$action_form = 'Bpbrekap/cetak_rekap';
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
            <div class="col-md-6">
              <div class="box box-default">
                <div class="box-header with-border">
                  <i class="fa fa-warning"></i>

                  <h3 class="box-title">Filter Rekap Pembelian</h3>
                </div>
                <!-- /.box-header -->
                <form method="post" action="<?=site_url($action_form)?>" target="_blank" >
                <div class="box-body">
                  <!-- Date dd/mm/yyyy -->
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanggal
                    </label>

                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="date" name="tgl_awal" class="form-control" value="<?php echo date('Y-m-d'); ?>"  required>
                    </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->

                  <!-- Date mm/dd/yyyy -->
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">s/d
                    </label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="date" name="tgl_akhir" class="form-control" value="<?php echo date('Y-m-d'); ?>"  required>
                    </div>
                    <!-- /.input group -->
                  </div>

                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Unit
                     </label>
                     <div class="input-group">
                       <div class="input-group-addon">
                         <i class="fa fa-sort-amount-desc"></i>
                       </div>
                         <select class="select2 form-control" name="kd_unit" required>
                           <option value="">-- Pilih --</option>
                           <?php foreach ($data_unit as $row)
                           {
                             echo '<option value="'.$row->kd_unit.'">'.$row->nama_unit.'</option>';
                           }
                           ?>
                         </select>
                       </div>

                   </div>

                </div>
                <div class="box-footer">

                  <button type="submit" class="btn btn-success pull-right"><i class="fa fa-print"></i> Detail</button>
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
