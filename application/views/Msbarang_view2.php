<?php
include 'includefile/head.php';

if ($perintah=="Baru"){
  $action_form = 'Msbarang/tambah';
}
else {
  $action_form = 'Msbarang/edit';
}
?>

<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">

     <ol class="breadcrumb">
       <li><a href="<?php echo site_url('Utama') ?>"><i class="fa fa-home"></i> Home</a></li>

     </ol>
   </section>
   <!-- Main content -->
   <br>
   <section class="content">

     <form  method="post" action="<?=site_url($action_form)?>" >
       <?php if($perintah=="Baru")
       {
         ?>

     <div class="box box-default">
       <div class="box-header with-border">
         <h3 class="box-title"><?php echo $title_tambah ?></h3>

         <div class="box-tools pull-right">
           <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
         </div>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
         <div class="row">
           <div class="col-md-6">

            <label>Kode Barang</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input style="background:#D9DCE8;" type="text" class="form-control" name="id_barang" placeholder="Input Kode Barang">
            </div>

            <label>Barcode</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                <input type="text" class="form-control" name="barcode" placeholder="Barcode">
            </div>

        
            <label>Nama Barang</label>
                <div class="input-group">
                    <span class="input-group-addon"><i></i></span>
                <input type="text" class="form-control" name="nama" placeholder="Nama Produk">
            </div>

            <label>Nama Alias</label>
                <div class="input-group">
                    <span class="input-group-addon"><i></i></span>
                <input type="text" class="form-control" name="nama_alias" placeholder="Nama Alias">
            </div>

            <label>PPN</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                        <select class="select2 form-control" name="ppn" required>
                        <option>-- Pilih --</option>
                        <option value="PPN">PPN</option>
                    <option value="NON PPN">NON PPN</option>
                </select>
            </div>

            <label>Kategori</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                    <select class="select2 form-control" name="id_kategori" required>
                    <option value="">-- Pilih --</option>
                    <?php foreach ($data_kategori as $row)
                    {
                        echo '<option value="'.$row->id_kategori.'">'.$row->nama.'</option>';
                    }
                    ?>
                    </select>
            </div>


            <label>Merk</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                    <select class="select2 form-control" name="id_merk" required>
                    <option value="">-- Pilih --</option>
                        <?php foreach ($data_merk as $row)
                        {
                            echo '<option value="'.$row->id_merk.'">'.$row->nama.'</option>';
                        }
                        ?>
                    </select>
            </div>
            
            <label>Jenis</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                    <select class="select2 form-control" name="id_jenis" required>
                    <option value="">-- Pilih --</option>
                        <?php foreach ($data_jenis as $row)
                        {
                            echo '<option value="'.$row->id_jenis.'">'.$row->nama.'</option>';
                        }
                        ?>
                    </select>
            </div>
            
            <label>Tipe</label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                <select class="select2 form-control" name="id_tipe" required>
                    <option value="">-- Pilih --</option>
                    <?php foreach ($data_tipe as $row)
                    {
                        echo '<option value="'.$row->id_tipe.'">'.$row->nama.'</option>';
                    }
                    ?>
                </select>
            </div>

            <label>Harga Beli</label>
                <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-money"></i></span>
               <input class="form-control" type="number" name="harga_beli" placeholder="Harga Beli">
            </div>
        
             <!-- /.NAMAup -->
             <!-- /.form-group -->
           </div>
           <!-- /.col -->
           <div class="col-md-6">
            <label>Harga Jual</label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                <input class="form-control" type="number" name="harga_jual" placeholder="Harga Jual">
            </div>

            <label>Satuan</label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                    <select class="select2 form-control" name="id_satuan" required>
                    <option value="">-- Pilih --</option>
                    <?php foreach ($data_satuan as $row)
                    {
                    echo '<option value="'.$row->id_satuan.'">'.$row->nama.'</option>';
                    }
                    ?>
                    </select>
            </div>

            <label>Aktif</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                    <select class="select2 form-control" name="id_status_aktif" required>
                        <option value="">-- Pilih --</option>
                        <?php foreach ($data_status_aktif as $dt_status_aktif)
                        {
                        echo '<option value="'.$dt_status_aktif->id_status_aktif.'">'.$dt_status_aktif->nama_status_aktif.'</option>';
                        }
                        ?>
                        </select>
            </div>

            <label>Foto <i> (Max. 1 MB) </i> </label>
                <div class="input-group">
                    <span class="input-group-addon"><i></i></span>
                    <input type="file" class="form-control" name="my_picture" > 
            </div>

            <label>Keterangan</label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                <textarea id="editor1" name="ktp" rows="10" cols="80" placeholder="Keterangan">
                </textarea>
            </div>

        </div>
    </div>
  </div>

  <div class="box-footer">
  <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Simpan Data</button>
  </div>
</div>
<?php } else { ?>

  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo $title_tambah ?></h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <?php
        $no=1;
        if(isset($data_barang_edit))
           {
             foreach ($data_barang_edit as $row_edit)
                { ?>
      <div class="row">
        <div class="col-md-6">

          <label>No RM</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-key"></i></span>
            <input type="text" class="form-control"  value="<?php echo $row_edit->no_register; ?>"  name="no_register" placeholder="Input No Rekam Medik">
          </div>
          <label>Kapitasi / Keanggotaan BPJS</label>
          <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                 <select class="select2 form-control" name="id_status_aktif" required>
                   <option value="<?php echo $row_edit->id_status_aktif; ?>"><?php echo $row_edit->nama_status_aktif; ?></option>
                   <?php foreach ($data_status_aktif as $rowstatus)
                   {
                     echo '<option value="'.$rowstatus->id_status_aktif.'">'.$rowstatus->nama_status_aktif.'</option>';
                   }
                   ?>
                 </select>
           </div>
          <label>No BPJS Kesehatan</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
            <input type="text" class="form-control" name="bpjs_kes" value="<?php echo $row_edit->bpjs_kes; ?>" placeholder="BPJS Kesehatan">
          </div>
          <label>Nama</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="text" class="form-control" value="<?php echo $row_edit->nama; ?>" name="nama" placeholder="Nama Pasien">
          </div>

          <label>Kota Lahir</label>
          <div class="input-group">
                   <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                 <select class="select2 form-control" name="kotalahir" required>
                   <option value="<?php echo $row_edit->kotalahir; ?>"><?php echo $row_edit->kota_lahir; ?></option>
                   <?php foreach ($data_kota as $rowkota)
                   {
                     echo '<option value="'.$rowkota->id.'">'.$rowkota->name.'</option>';
                   }
                   ?>
                 </select>
             </div>
         <label>Tanggal Lahir</label>
         <div class="input-group">
           <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
           <input type="date" class="form-control" name="tgllahir"  value="<?php echo $row_edit->tgllahir; ?>"  placeholder="Tanggal Lahir">
         </div>
         <label>Alamat</label>
         <div class="input-group">
           <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
           <input type="text" class="form-control" value="<?php echo $row_edit->alamat; ?>" name="alamat" placeholder="Alamat Pasien">
         </div>
         <label>Jenis Kelamin</label>
         <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                <select class="select2 form-control" name="jk" required>
                  <<option value="<?php echo $row_edit->jk; ?>">
                   <?php
                   if ($row_edit->jk=="L"){
                     echo "Laki-laki";
                   }
                   elseif ($row_edit->jk=="P") {
                       echo "Perempuan";
                   }
                   ?>
                  </option>
                  <option value="L">Laki-laki</option>
                  <option value="P">Perempuan</option>
                </select>
          </div>




          <!-- /.NAMAup -->

          <!-- /.form-group -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <label>Email</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
            <input type="email" class="form-control" value="<?php echo $row_edit->email; ?>" name="email" placeholder="E-mail">
           </div>
           <label>Telepon</label>
           <div class="input-group">
             <span class="input-group-addon"><i class="fa fa-phone"></i></span>
             <input type="text" class="form-control" name="telepon" value="<?php echo $row_edit->telepon; ?>" placeholder="Telepon">
            </div>

            <label>Pekerjaan</label>
            <div class="input-group">
                   <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                   <select class="select2 form-control" name="id_pekerjaan" required>
                     <option value="">-- Pilih --</option>
                     <?php foreach ($data_pekerjaan as $rowpekerjaan)
                     {
                       echo '<option value="'.$rowpekerjaan->id_pekerjaan.'">'.$rowpekerjaan->nama.'</option>';
                     }
                     ?>
                   </select>
             </div>


              <label>Keterangan / Riwayat</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                <textarea id="editor1" name="keterangan" rows="10" cols="80" placeholder="Keterangan">
                  <?php echo $row_edit->keterangan; ?>
                </textarea>
              </div>
          <!-- /.form-group -->


        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <?php
     }
   }
  ?>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
       <a href="<?php echo site_url('Msbarang'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Input Baru</a>
     <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Update Data</button>
    </div>
  </div>

<?php
}
?>
</form>


     <div class="row">
       <div class="col-xs-12">
         <div class="box">
          <?php //include 'template/Pesan.php'; ?>
           <div class="box-header">
             <button type="button" class="btn btn-block btn-info btn-flat" data-toggle="modal" data-target="#modal-default"><i class="fa fa-search"></i>
               Cari Master Barang
             </button>
           </div>

           <div class="modal fade" id="modal-default">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Msbarang/filter')?>">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title">Filter Pencarian</h4>
                 </div>
                 <div class="modal-body">
                   <p>
                     <div class="input-group">
                     <span class="input-group-addon"><i class="fa fa-key"></i></span>
                     <input type="text" name="katakunci" class="form-control" placeholder="Kata Kunci" required>
                   </div>
                 </p>
                 </div>
                 <div class="modal-footer">
                   <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                   <button type="submit" class="btn btn-primary">Filter.....!!!</button>
                 </div>
               </form>
               </div>
               <!-- /.modal-content -->
             </div>
             <!-- /.modal-dialog -->
           </div>

           <!-- /.box-header -->
           <div class="box-body">
             <table id="example2" class="table table-bordered table-striped nowrap"  cellspacing="0" width="100%">
             <thead>
                <tr>
                     
                    <th>Kode Barang</th>
                    <th>Nama Produk</th>
                    <th>Barcode</th>
                    <th>Kategori</th>
 				    <th>Satuan</th>
                    <th>Ppn</th>
                    <th>Jenis</th>
                    <th>Merk</th>
                    <th>Tipe</th> 
                    <th>Opsi</th> 
                 </tr>
               </thead>
               <tbody>
                <!--
               <a class="btn btn-mini" href="<?php //echo site_url('master/hapus_rw/'.$row->kd_rw);?>"
        onclick="return confirm('Anda yakin?')"> <i class="icon-remove"></i> Hapus</a> -->
   </td>
 <?php
 //ambil dari controler
 $no=1;
 if(isset($data_barang))
    {
      foreach ($data_barang as $row)
         { ?>

           <div class="modal fade" id="modal-<?php echo $row->id_barang; ?>">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Msbarang/Dataedit')?>">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title">Edit Data Ini....????</h4>
                 </div>
                 <div class="modal-body">
                  <p>
                     <h5>Kode Barang</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-key"></i></span>
                       <input type="test" name="id_barang" value="<?php echo $row->id_barang; ?>" class="form-control" placeholder="Auto" readonly>

                     </div>
                     <h5>Nama Produk</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                       <input type="text" value="<?php echo $row->nama; ?>" class="form-control" placeholder="RW" readonly>
                     </div>
                  </p>
                 </div>
                 
                 <div class="modal-footer">
                   <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
                   <button type="submit" class="btn btn-primary">Ya....!!</button>
                 </div>
               </form>
               </div>
               <!-- /.modal-content -->
             </div>
             <!-- /.modal-dialog -->
           </div>
           <div class="modal fade" id="modal-hapus<?php echo $row->id_barang; ?>">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Msbarang/hapus')?>">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title">Hapus Data Ini....????</h4>
                 </div>
                 <div class="modal-body">
                   <p>
                     <h5>Kode Barang</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-key"></i></span>
                       <input type="text" name="id_barang" value="<?php echo $row->id_barang; ?>" class="form-control" placeholder="Auto" readonly>
                     </div>
                     <h5>Nama Produk</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                       <input type="text" value="<?php echo $row->nama; ?>" class="form-control" placeholder="rw" readonly>
                     </div>
                 </p>
                 </div>
                 <div class="modal-footer">
                   <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
                   <button type="submit" class="btn btn-primary">Ya....!!</button>
                 </div>
               </form>
               </div>
               <!-- /.modal-content -->
             </div>
             <!-- /.modal-dialog -->
           </div>

           <tr>

           <td> <?php echo $row->id_barang; ?>     </td>
           <td> <?php echo $row->nama_barang; ?>   </td>
           <td> <?php echo $row->barcode; ?>       </td>
           <td> <?php echo $row->nama_kategori; ?> </td>
           <td  ><?php echo $row->nama_satuan; ?>  </td>
           <td> <?php echo  $row->ppn; ?>          </td>
           <td> <?php echo $row->nama_jenis; ?>    </td>
           <td> <?php echo $row->merk; ?>          </td>
           <td> <?php echo $row->nama_tipe; ?>     </td>
           <td>
               <?php
               if($hak_u == 1)
               {
                 ?>
                 <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-<?php echo $row->id_barang; ?>"><i class="fa fa-pencil"></i>
                   Edit
                 </button>

               <?php
               }
               if($hak_d == 1)
               {
                 ?>
                 <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-hapus<?php echo $row->id_barang; ?>"><i class="fa fa-trash"></i>
                   Hapus
                 </button>

               <?php
               }
               if($hak_p == 1)
               {
                 ?>
                 <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-preview<?php echo $row->id_barang; ?>"><i class="fa fa-print"></i>
                   Riwayat Kunjungan
                 </button>

               <?php
               }
               ?>
             </td>
           </tr>

   <?php }
   }
   ?>




               </tbody>
               <tfoot>
                 <tr>
                  
                  <th>Kode Barang</th>
                  <th>Nama Produk</th>
                  <th>Barcode</th>
                  <th>Kategori</th>
                  <th>Satuan</th>
                  <th>Ppn</th>
                  <th>Jenis</th>
                  <th>Merk</th>
                  <th>Tipe</th>
                  <th>Opsi</th>
                 </tr>
               </tfoot>
             </table>


           </div>
           <!-- /.box-body -->
         </div>
         <!-- /.box -->
       </div>
       <!-- /.col -->
     </div>
     <!-- /.row -->
   </section>
   <!-- /.content -->
 </div>


<?php
$this->load->view('includefile/foot');
?>
