<?php include 'includefile/head.php'; ?>

<?php
$action_form = 'Msbarang/tambah';
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

      <!-- /.row -->
<form class="form-horizontal form-label-left" method="post" action="<?=site_url($action_form)?>" >
     <div class="row">
       <!-- left column -->
       <div class="col-md-6">
         <div class="box box-info">
             <div class="box-header with-border">
               <h3 class="box-title">Data Barang</h3>
             </div>
     <!-- /.box-header -->
     <!-- form start -->


                 <div class="box-body">

                   <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kode Barang <span class="required">*</span>
                     </label>
                     <div class="col-md-4 col-sm-6 col-xs-12">

                     <input style="background:#D9DCE8;"  class="form-control col-md-4 col-xs-12" name="id_barang" type="text" id="id_barang" placeholder="AUTO" readonly/>
                     </div>
                   </div>
                   <div class="form-group">
                                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Barcode</label>
        *
                      <div class="col-md-4 col-sm-6 col-xs-12">
                                               <input class="form-control col-md-4 col-xs-12" id="barcode" placeholder="Barcode" type="text" name="barcode">
                                       </div>
                           </div>

                              <div class="form-group">
                                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Barang
                                       </label>
                                       <div class="col-md-8 col-sm-6 col-xs-12">
                                               <input class="form-control col-md-8 col-xs-12" id="nama" placeholder="Nama Produk" required type="text" name="nama">
                                       </div>
                              </div>
                              <div class="form-group">
                                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Alias
                                       </label>
                                       <div class="col-md-8 col-sm-6 col-xs-12">
                                               <input class="form-control col-md-8 col-xs-12" id="nama_alias" placeholder="Nama Alias"ctype="text" name="nama_alias">
                                       </div>
                              </div>



                              <div class="form-group">
                                 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Ppn
                                 </label>

                                   <div class="col-md-4 col-xs-12">
                                     <select class="form-control select2" name="ppn">
                                       <option value="PPN">PPN</option>
                                       <option value="NON PPN">NON PPN</option>

                                     </select>
                                   </div>

                              </div>

                              <div class="form-group">
                                 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kategori
                                 </label>

                                   <div class="col-md-4 col-xs-12">
                                     <select class="select2 form-control" name=" id_kategori" required>
                                       <option value="">-- Pilih --</option>
                                       <?php foreach ($data_kategori as $row)
                                       {
                                         echo '<option value="'.$row->id_kategori.'">'.$row->nama.'</option>';
                                       }
                                       ?>
                                     </select>
                                   </div>

                               </div>
                              <div class="form-group">
                                 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Merk
                                 </label>

                                   <div class="col-md-4 col-xs-12">
                                     <select class="select2 form-control" name=" id_merk" required>
                                       <option value="">-- Pilih --</option>
                                       <?php foreach ($data_merk as $row)
                                       {
                                         echo '<option value="'.$row->id_merk.'">'.$row->nama.'</option>';
                                       }
                                       ?>
                                     </select>
                                   </div>

                               </div>

                                <div class="form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Jenis
                                   </label>

                                     <div class="col-md-4 col-xs-12">
                                       <select class="select2 form-control" name="id_jenis">
                                         <option value="">-- Pilih --</option>
                                         <?php foreach ($data_jenis as $row)
                                         {
                                           echo '<option value="'.$row->id_jenis.'">'.$row->nama.'</option>';
                                         }
                                         ?>
                                       </select>
                                     </div>

                                 </div>

                                 <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tipe
                                    </label>

                                      <div class="col-md-4 col-xs-12">
                                        <select class="select2 form-control" name="id_tipe">
                                          <option value="">-- Pilih --</option>
                                          <?php foreach ($data_tipe as $row)
                                          {
                                            echo '<option value="'.$row->id_tipe.'">'.$row->nama.'</option>';
                                          }
                                          ?>
                                        </select>
                                      </div>

                                  </div>



                              <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Harga Beli</label>
                                <div class="col-md-4 col-sm-6 col-xs-12">

                                   <input id="top" placeholder="Harga Beli" class="form-control col-md-4 col-xs-12" value="<?php //echo $row->keterangan; ?>" type="number" name="harga_beli" readonly>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Harga Jual</label>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                   <input id="top" placeholder="Harga Jual" class="form-control col-md4 col-xs-12" value="<?php //echo $row->keterangan; ?>" type="number" name="harga_jual" readonly>
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Satuan</label>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                  <select class="select2 form-control" name="id_satuan">
                                    <option value="">-- Pilih --</option>
                                    <?php foreach ($data_satuan as $row)
                                    {
                                      echo '<option value="'.$row->id_satuan.'">'.$row->nama.'</option>';
                                    }
                                    ?>
                                  </select>
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
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Foto
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">

                       <input type="file" class="form-control" name="my_picture" ><span>* Max 1MB</span>
                     </div>
                   </div>



                   <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Keterangan
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                       <input id="name" class="form-control col-md-7 col-xs-12" name="ktp" placeholder="Keterangan" type="text">
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

   </form>
     <!-- /.row -->
   </section>
   <!-- /.content -->
 </div>


<?php include 'includefile/foot.php'; ?>
