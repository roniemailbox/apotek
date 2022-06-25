<?php include 'includefile/head.php'; ?>

<?php
if ($perintah=="Baru"){
  $action_form = 'Mssupplier/tambah';
}
else {
  $action_form = 'Mssupplier/edit';
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
                    <span class="info-box-text">BARANG</span>
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
               <h3 class="box-title">Data Supplier <?php echo $perintah ?></h3>
             </div>
     <!-- /.box-header -->
     <!-- form start -->


                 <div class="box-body">
                   <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ID Supplier <span class="required">*</span>
                     </label>
                     <div class="col-md-4 col-sm-6 col-xs-12">

                     <input class="form-control col-md-4 col-xs-12"  name="id_supplier" type="text" value="<?php //echo $row->id_customer; ?>" id="id_supplier" placeholder="AUTO" readonly />
                     </div>
                   </div>

                              <div class="form-group">
                                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Supplier <span class="required">*</span>
                                       </label>
                                       <div class="col-md-8 col-sm-6 col-xs-12">

                                         <input class="form-control col-md-8 col-xs-12" value="<?php //echo $row->nama; ?>" id="nama" placeholder="Nama Supplier" required type="text" name="nama" required>
                                       </div>
                                     </div>

        				<div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Alamat Supplier
                                </label>
                                <div class="col-md-8 col-sm-6 col-xs-12">

                                  <textarea id="alamat" placeholder="Alamat" class="form-control" name="alamat" required ><?php //echo $row->alamat; ?></textarea>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Alamat Invoice
                                </label>
                                <div class="col-md-8 col-sm-6 col-xs-12">

                                  <textarea id="alamat_invoice" placeholder="Alamat 2" class="form-control" name="alamat_invoice" ><?php //echo $row->alamat_invoice; ?></textarea>
                                </div>
                              </div>



                               <div class="form-group">
                                 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kota
                                 </label>

                                   <div class="col-md-4 col-xs-12">
                                     <select class="form-control select2 col-md-12" name="id_kota">
                                        <option value="">-- Pilih --</option>
                                       <?php foreach ($data_kabupaten as $dt_kab)
                                       {
                                         echo '<option value="'.$dt_kab->id.'">'.$dt_kab->name.'</option>';
                                       }

                                       ?>
                                     </select>
                                   </div>

                               </div>

                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kode Pos
                                </label>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                  <input id="kode_pos" class="form-control col-md-3 col-xs-12" value="<?php //echo $row->kode_pos; ?>" name="kode_pos" placeholder="Kode Pos" type="text" required>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Telepon
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input id="name" class="form-control col-md-6 col-xs-12" value="<?php //echo $row->telpon; ?>" name="telepon" placeholder="Telepon" type="text" required>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">HP
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input id="name" class="form-control col-md-6 col-xs-12" value="<?php //echo $row->hp; ?>" name="hp" placeholder="Handphone" type="text" required>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Fax
                                </label>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                  <input id="name" class="form-control col-md-3 col-xs-12" value="<?php //echo $row->fax; ?>" name="fax" placeholder="Fax" type="text">
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input id="name" class="form-control col-md-3 col-xs-12" value="<?php //echo $row->email; ?>" name="email" placeholder="E-mail" type="email">
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Npwp
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input id="name" class="form-control col-md-3 col-xs-12" value="<?php //echo $row->npwp; ?>" name="npwp" placeholder="Npwp" type="text">
                                </div>
                              </div>
                 </div>
                 <!-- /.box-body -->
                 <div class="box-footer">
                   <h4 class="box-title">Selanjutnya.....</h4>
                 </div>
                 <!-- /.box-footer -->

             </div>

       </div>

       <div class="col-md-6">
         <div class="box box-info">
             <div class="box-header with-border">
               <h3 class="box-title">Informasi Lanjutan</h3>
             </div>
     <!-- /.box-header -->
     <!-- form start -->

                 <div class="box-body">


                   <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Bank
                     </label>

                       <div class="col-md-4 col-xs-12">
                         <select class="select2 form-control" name="id_bank">

                           <?php foreach ($data_bank as $dt_bank)
                           {
                             echo '<option value="'.$dt_bank->kd_bank.'">'.$dt_bank->nama_bank.'</option>';
                           }
                           ?>
                         </select>
                       </div>

                   </div>

                   <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Top
                     </label>
                     <div class="col-md-3 col-sm-6 col-xs-12">
                       <input id="name" class="form-control col-md-3 col-xs-12" name="top" value="<?php //echo $row->top; ?>" placeholder="Jatuh tempo pembayaran" type="number">
                     </div>
                   </div>



                   <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">No Rekening
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                       <input id="name" class="form-control col-md-7 col-xs-12" name="no_rekening" <?php //echo $row->no_rekening; ?> placeholder="No Rekening" type="text">
                     </div>
                   </div>


                   <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">An Rekening
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                       <input id="name" class="form-control col-md-7 col-xs-12" name="an_rekening" <?php //echo $row->an_rekening; ?> placeholder="Nama Pemimlik Rekening" type="text">
                     </div>
                   </div>

                   <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kontak Person
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                       <input id="name" class="form-control col-md-7 col-xs-12" name="kontak_person" value="<?php //echo $row->kontak_person; ?>" placeholder="Kontak Person" type="text">
                     </div>
                   </div>

                   <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Keterangan
                     </label>
                     <div class="col-md-8 col-sm-6 col-xs-12">

                       <textarea id="keterangan" placeholder="Informasi Tambahan" class="form-control" name="keterangan" ><?php //echo $row->keterangan; ?></textarea>
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


     if(isset($data_supplier))
        {
          foreach ($data_supplier as $row)
             {  ?>


     <div class="row">
       <!-- left column -->
       <div class="col-md-6">
         <div class="box box-info">
             <div class="box-header with-border">
               <h3 class="box-title">Data Supplier</h3>
             </div>
     <!-- /.box-header -->
     <!-- form start -->


                 <div class="box-body">
                   <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ID Supplier
                     </label>
                     <div class="col-md-4 col-sm-6 col-xs-12">

                     <input class="form-control col-md-4 col-xs-12"  name="id_supplier" type="text" value="<?php  echo $row->id_supplier; ?>" placeholder="AUTO" readonly />
                     </div>
                   </div>

                              <div class="form-group">
                                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Supplier
                                       </label>
                                       <div class="col-md-8 col-sm-6 col-xs-12">

                                         <input class="form-control col-md-8 col-xs-12" value="<?php  echo $row->nama; ?>" id="nama" placeholder="Nama Supplier" required type="text" name="nama" required>
                                       </div>
                                     </div>

        				<div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Alamat Supplier
                                </label>
                                <div class="col-md-8 col-sm-6 col-xs-12">

                                  <textarea id="alamat" placeholder="Alamat" class="form-control" name="alamat" required ><?php  echo $row->alamat; ?></textarea>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Alamat Invoice
                                </label>
                                <div class="col-md-8 col-sm-6 col-xs-12">

                                  <textarea id="alamat_invoice" placeholder="Alamat 2" class="form-control" name="alamat_invoice" ><?php  echo $row->alamat_invoice; ?></textarea>
                                </div>
                              </div>



                               <div class="form-group">
                                 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kota
                                 </label>

                                   <div class="col-md-4 col-xs-12">
                                     <select class="form-control select2 col-md-12" name="id_kota">
                                        <option value="<?php  echo $row->id_kota; ?>"><?php  echo $row->nama_kota; ?></option>
                                       <?php foreach ($data_kabupaten as $dt_kab)
                                       {
                                         echo '<option value="'.$dt_kab->id.'">'.$dt_kab->name.'</option>';
                                       }

                                       ?>
                                     </select>
                                   </div>

                               </div>

                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kode Pos
                                </label>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                  <input id="kode_pos" class="form-control col-md-3 col-xs-12" value="<?php  echo $row->kode_pos; ?>" name="kode_pos" placeholder="Kode Pos" type="text" required>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Telepon
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input id="name" class="form-control col-md-6 col-xs-12" value="<?php  echo $row->telepon; ?>" name="telepon" placeholder="Telepon" type="text" required>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">HP
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input id="name" class="form-control col-md-6 col-xs-12" value="<?php  echo $row->hp; ?>" name="hp" placeholder="Handphone" type="text" required>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Fax
                                </label>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                  <input id="name" class="form-control col-md-3 col-xs-12" value="<?php  echo $row->fax; ?>" name="fax" placeholder="Fax" type="text">
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input id="name" class="form-control col-md-3 col-xs-12" value="<?php  echo $row->email; ?>" name="email" placeholder="E-mail" type="email">
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Npwp
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input id="name" class="form-control col-md-3 col-xs-12" value="<?php  echo $row->npwp; ?>" name="npwp" placeholder="Npwp" type="text">
                                </div>
                              </div>
                 </div>
                 <!-- /.box-body -->
                 <div class="box-footer">
                   <h4 class="box-title">Selanjutnya.....</h4>
                 </div>
                 <!-- /.box-footer -->

             </div>

       </div>

       <div class="col-md-6">
         <div class="box box-info">
             <div class="box-header with-border">
               <h3 class="box-title">Informasi Lanjutan</h3>
             </div>
     <!-- /.box-header -->
     <!-- form start -->

                 <div class="box-body">


                   <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Bank
                     </label>

                       <div class="col-md-4 col-xs-12">
                         <select class="select2 form-control" name="id_bank">
                           <option value="<?php  echo $row->id_bank; ?>"><?php  echo $row->nama_bank; ?></option>
                           <?php foreach ($data_bank as $dt_bank)
                           {
                             echo '<option value="'.$dt_bank->kd_bank.'">'.$dt_bank->nama_bank.'</option>';
                           }
                           ?>
                         </select>
                       </div>

                   </div>

                   <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Top
                     </label>
                     <div class="col-md-3 col-sm-6 col-xs-12">
                       <input id="name" class="form-control col-md-3 col-xs-12" name="top" value="<?php echo $row->top; ?>" placeholder="Jatuh tempo pembayaran" type="number">
                     </div>
                   </div>



                   <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">No Rekening
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                       <input id="name" class="form-control col-md-7 col-xs-12" name="no_rekening" value="<?php echo $row->no_rekening; ?>" placeholder="No Rekening" type="text">
                     </div>
                   </div>


                   <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">An Rekening
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                       <input id="name" class="form-control col-md-7 col-xs-12" name="an_rekening" value="<?php echo $row->an_rekening; ?>" placeholder="Nama Pemimlik Rekening" type="text">
                     </div>
                   </div>

                   <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kontak Person
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                       <input id="name" class="form-control col-md-7 col-xs-12" name="kontak_person" value="<?php echo $row->kontak_person; ?>" placeholder="Kontak Person" type="text">
                     </div>
                   </div>

                   <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Keterangan
                     </label>
                     <div class="col-md-8 col-sm-6 col-xs-12">

                       <textarea id="keterangan" placeholder="Informasi Tambahan" class="form-control" name="keterangan" ><?php echo $row->keterangan; ?></textarea>
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
