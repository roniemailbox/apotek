<?php include 'includefile/head.php'; ?>

<?php
if ($perintah=="Baru"){
  $action_form = 'Msjabatan/tambah';
}
else {
  $action_form = 'Msjabatan/edit';
}

?>

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
   <section class="content">
     <div class="row">
       <div class="col-md-12">
          <div class="box box-success collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Summary</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">jabatan</span>
                    <span class="info-box-number">1,410</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">TETAP</span>
                    <span class="info-box-number">410</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">KONTRAK</span>
                    <span class="info-box-number">13,648</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">AKTIF</span>
                    <span class="info-box-number">93,139</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>


        <!-- /.col -->
      </div>
      <!-- /.row -->
<form class="form-horizontal form-label-left" method="post" action="<?=site_url($action_form)?>" >
  <?php if($perintah=="Baru")
  {
    ?>
    <div class="row">
      <!-- left column -->
      <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Data jabatan <?php echo $perintah ?></h3>
            </div>
                  <div class="box-body">

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kode jabatan <span class="required">*</span>
                    </label>
                    <div class="col-md-4 col-sm-6 col-xs-12">

                    <input style="background:#D9DCE8;" value=""  class="form-control col-md-4 col-xs-12" name="id_jabatan" type="text" id="id_jabatan" placeholder="AUTO" readonly/>
                    </div>
                  </div>




                             <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama jabatan
                                      </label>
                                      <div class="col-md-8 col-sm-6 col-xs-12">
                                              <input class="form-control col-md-8 col-xs-12" id="nama" placeholder="Nama jabatan" required type="text" name="nama">
                                      </div>
                             </div>

                             <div class="form-group">
                               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Aktif
                               </label>

                               <div class="col-md-4 col-xs-12">
                                 <select class="form-control select2 col-md-12" name="id_status_aktif" required>
                                   <option value="">-- pilih --</option>
                                   <?php foreach ($data_status_aktif as $dt_status_aktif)
                                   {
                                     echo '<option value="'.$dt_status_aktif->id_status_aktif.'">'.$dt_status_aktif->nama_status_aktif.'</option>';
                                   }
                                   ?>
                                 </select>
                               </div>

                             </div>



                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="submit" class="btn btn-info pull-right">Simpan</button>
                </div>
                <!-- /.box-footer -->

            </div>

      </div>


      <!--/.col (left) -->
      <!-- right column -->

      <!--/.col (right) -->
    </div>
  <?php
  }
  else {


  if(isset($data_jabatan))
     {
       foreach ($data_jabatan as $row)
          {  ?>
  <!-- EDIT STATE -->


  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Data jabatan <?php echo $perintah ?></h3>
          </div>
                <div class="box-body">

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kode jabatan <span class="required">*</span>
                  </label>
                  <div class="col-md-4 col-sm-6 col-xs-12">

                  <input style="background:#D9DCE8;" value="<?php echo $row->id_jabatan ?>"  class="form-control col-md-4 col-xs-12" name="id_jabatan" type="text" id="id_jabatan" placeholder="AUTO" readonly/>
                  </div>
                </div>



                           <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama jabatan
                                    </label>
                                    <div class="col-md-8 col-sm-6 col-xs-12">
                                     <input class="form-control col-md-8 col-xs-12" id="nama" placeholder="Nama jabatan" required type="text" name="nama" value="<?php echo $row->nama ?>">
                                    </div>
                           </div>










                           <div class="form-group">
                             <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Aktif
                             </label>

                             <div class="col-md-4 col-xs-12">
                               <select class="form-control select2 col-md-12" name="id_status_aktif" required>
                                 <option value="<?php echo $row->id_status_aktif ?>"><?php echo $row->nama_status_aktif ?></option>
                                 <?php foreach ($data_status_aktif as $dt_status_aktif)
                                 {
                                   echo '<option value="'.$dt_status_aktif->id_status_aktif.'">'.$dt_status_aktif->nama_status_aktif.'</option>';
                                 }
                                 ?>
                               </select>
                             </div>

                           </div>



              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Update</button>
              </div>
              <!-- /.box-footer -->

          </div>

    </div>


    <!--/.col (left) -->
    <!-- right column -->

    <!--/.col (right) -->
  </div>
  <?php  // code...
    }
  }
}

   ?>


   </form>
     <!-- /.row -->
   </section>
   <!-- /.content -->
 </div>


<?php include 'includefile/foot.php'; ?>
