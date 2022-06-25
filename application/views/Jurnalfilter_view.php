<?php
$this->load->view('includefile/head.php');
$id = get_cookie('eklinik');
$action_form = 'Jurnal/cetak';
?>

<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <h1>
       <?php echo $title ?>
       <small>Data Table</small>
     </h1>
     <ol class="breadcrumb">
       <li><a href="<?php echo site_url('Utama') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
       <li><a href="#"><?php echo $xmenu ?></a></li>
       <li class="active"><?php echo $xsubmenu ?></li>
     </ol>
   </section>
  <!-- Main content -->
  <section class="content" >
<br>
<script type="text/javascript" src="<?=site_url('/')?>build/source_ant/js/jquery-1.7.2.js"></script>

<script type="text/javascript">
        var c1 = $.noConflict(true);
        c1(document).ready(function(){
          c1('input[id="tgl_awal"]').change(function(){
            //Date in full format alert(new Date(this.value));
            var js_tgl_awal = this.value;
            var date = new Date(js_tgl_awal);
            var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
            var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
            var bulan = (lastDay.getMonth() + 1).toString();
            var karakter_bulan = bulan.length;
            if (karakter_bulan == 2 ) {
              var lastDayWithSlashes = lastDay.getFullYear() + '-' + bulan + '-' + (lastDay.getDate());
            } else {
              var lastDayWithSlashes = lastDay.getFullYear() + '-0' + bulan + '-' + (lastDay.getDate());
            }
            //alert(lastDayWithSlashes);
            document.getElementById('tgl_akhir').value = lastDayWithSlashes;
          });
        });
</script>

    <div class="row">
            <div class="col-md-12">
              <div class="box box-default">
                <div class="box-header with-border">
                  <i class="fa fa-filter"></i>

                  <h3 class="box-title">Filter</h3>
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
                      <input type="date" id="tgl_awal" name="tgl_awal" class="form-control" value="<?php echo date('Y-m-d'); ?>"  required>
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
                      <input type="date" id="tgl_akhir" name="tgl_akhir" class="form-control" value="<?php echo date('Y-m-d'); ?>"  required>
                    </div>
                    <!-- /.input group -->
                  </div>


                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Akun
                    </label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-sort-amount-desc"></i>
                      </div>
                        <select class="select2 form-control" name="kd_akun">
                          <option value="">-- Semua --</option>
                          <?php foreach ($data_akun as $row)
                          {
                            echo '<option value="'.$row->kd_akun.'">'.$row->kd_akun." - ".strtoupper($row->nama).'</option>';
                          }
                          ?>
                        </select>
                      </div>
                    <!-- /.input group -->
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Unit Usaha
                      </label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-sort-amount-desc"></i>
                        </div>
                          <select class="select2 form-control" name="id_unit">
                            <option value="">-- Pilih --</option>
                            <?php foreach ($data_unit as $rowq)
                            {
                              echo '<option value="'.$rowq->kd_unit.'">'.$rowq->nama_unit.'</option>';
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
