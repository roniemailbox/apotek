<?php
include 'includefile/head.php';

if ($perintah=="Baru"){
  $action_form = 'Regpx/tambah';
}
else {
  $action_form = 'Regpx/edit';
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
       <?php if($perintah=="Baru" && $hak_c == 1)
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
             <label>No RM</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-key"></i></span>
               <input type="text" class="form-control" name="no_register" placeholder="Input No Rekam Medik">
             </div>
             <label>Jenis Pasien</label>
             <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                    <select class="select2 form-control" name="id_jenis_pasien" required>
                      <option value="">-- Pilih --</option>
                      <?php foreach ($data_jenis_pasien as $rowpxs)
                      {
                        echo '<option value="'.$rowpxs->id_jenis_pasien.'">'.$rowpxs->nama.'</option>';
                      }
                      ?>
                    </select>
              </div>
             <label>No BPJS Kesehatan</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
               <input type="text" class="form-control" name="bpjs_kes" placeholder="BPJS Kesehatan">
             </div>
             <label>Nama</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-user"></i></span>
               <input type="text" class="form-control" name="nama" placeholder="Nama Pasien">
             </div>

              <label>Kota Lahir</label>
              <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                     <select class="select2 form-control" name="kotalahir">
                       <option value="">-- Pilih --</option>
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
               <input type="date" class="form-control" name="tgllahir" placeholder="Nama Pasien">
             </div>
             <label>Alamat</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
               <input type="text" class="form-control" name="alamat" placeholder="Alamat Pasien">
             </div>


                 <label>Jenis Kelamin</label>
                 <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                        <select class="select2 form-control" name="jk" required>
                          <option value="">--Pilih--</option>
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
                 <input type="email" class="form-control" name="email" placeholder="E-mail">
                </div>
                <label>Telepon</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control" name="telepon" placeholder="Telepon">
                 </div>

                 <label>Pekerjaan</label>
                 <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                        <select class="select2 form-control" name="" required>
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

                   </textarea>
                 </div>
             <!-- /.form-group -->


           </div>
           <!-- /.col -->
         </div>
         <!-- /.row -->
       </div>
       <!-- /.box-body -->
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
        if(isset($data_pasien_edit))
           {
             foreach ($data_pasien_edit as $row_edit)
                { ?>
      <div class="row">
        <div class="col-md-6">

          <label>No RM</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-key"></i></span>
            <input type="text" class="form-control"  value="<?php echo $row_edit->no_register; ?>"  name="no_register" placeholder="Input No Rekam Medik">
          </div>
          <label>Jenis Pasien</label>
          <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                 <select class="select2 form-control" name="id_jenis_pasien" required>
                   <option value="<?php echo $row_edit->id_jenis_pasien; ?>"><?php echo $row_edit->nama_jenis_pasien; ?></option>
                   <?php foreach ($data_jenis_pasien as $rowpxz)
                   {
                     echo '<option value="'.$rowpxz->id_jenis_pasien.'">'.$rowpxz->nama.'</option>';
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
                 <select class="select2 form-control" name="kotalahir">
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
                   <select class="select2 form-control" name="id_pekerjaan">
                     <option value="<?php echo $row_edit->id_pekerjaan; ?>"><?php echo $row_edit->nama_pekerjaan; ?></option>
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
      <?php
        if($hak_c == 1)
        {
       ?>
       <a href="<?php echo site_url('Regpx'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Input Baru</a>
       <?php
            }
        ?>
        
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
               Cari Master Pasien (<?php echo number_format($jml_px).' Data' ; ?>)
             </button>
             <button type="button" class="btn btn-block btn-success btn-flat" data-toggle="modal" data-target="#modal-excel"><i class="fa fa-file-excel-o"></i>
               Excel Data Pasien
             </button>

           </div>

           <div class="modal fade" id="modal-excel">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Regpx/exportexcel')?>">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title">EXPORT KE EXCEL</h4>
                 </div>

                 <div class="modal-footer">
                   <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                   <button type="submit" class="btn btn-primary">Proses.....!!!</button>
                 </div>
               </form>
               </div>
               <!-- /.modal-content -->
             </div>
             <!-- /.modal-dialog -->
           </div>

           <div class="modal fade" id="modal-default">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Regpx/filter')?>">
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
                   <th>Opsi</th>
                   <th>No RM</th>
                   <th>Nama</th>
                   <th>Usia</th>
                   <th>Alamat</th>
                   <th>Telepon</th>
                   <th>Jenis Kelamin</th>
                   <th>Email</th>
                   <th>Kapitasi</th>
                   <th>No BPJS</th>
                   <th>Dientri Oleh</th>
                   <th>Dientri Pada</th>
                   <th>Diedit Oleh</th>
                   <th>Diedit Pada</th>

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
 if(isset($data_pasien))
    {
      foreach ($data_pasien as $row)
         { ?>

           <div class="modal fade" id="modal-<?php echo $row->no_register; ?>">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Regpx/Dataedit')?>">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title">Edit Data Ini....????</h4>
                 </div>
                 <div class="modal-body">
                   <p>
                     <h5>No Register</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-key"></i></span>
                       <input type="test" name="no_register" value="<?php echo $row->no_register; ?>" class="form-control" placeholder="Auto" readonly>

                     </div>
                     <h5>Nama</h5>

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
           <div class="modal fade" id="modal-hapus<?php echo $row->no_register; ?>">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Regpx/hapus')?>">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title">Hapus Data Ini....????</h4>
                 </div>
                 <div class="modal-body">
                   <p>
                     <h5>No Register</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-key"></i></span>
                       <input type="text" name="no_register" value="<?php echo $row->no_register; ?>" class="form-control" placeholder="Auto" readonly>
                     </div>
                     <h5>Nama Pasien</h5>

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
             <td>
               <?php
               if($hak_u == 1)
               {
                 ?>
                 <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-<?php echo $row->no_register; ?>"><i class="fa fa-pencil"></i>
                   Edit
                 </button>

               <?php
               }
               if($hak_d == 1)
               {
                 ?>
                 <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-hapus<?php echo $row->no_register; ?>"><i class="fa fa-trash"></i>
                   Hapus
                 </button>


               <?php
               }
               if($hak_p == 1)
               {
                 ?>
                 <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-preview<?php echo $row->no_register; ?>"><i class="fa fa-print"></i>
                   Riwayat Kunjungan
                 </button>


               <?php
               }

               ?>
             </td>
           <td><?php echo $row->no_register; ?></td>

           <td><?php echo $row->nama; ?></td>
           <td><?php echo $row->usia_pasien; ?></td>
           <td><?php  echo $row->alamat; ?></td>
            <td><?php echo $row->telepon; ?></td>
           <td><?php echo $row->jk; ?></td>
           <td><?php echo $row->email; ?></td>
           <td><?php echo $row->nama_jenis_pasien; ?></td>
           <td><?php echo $row->bpjs_kes; ?></td>
           <td><?php echo $row->nama_pegawai; ?></td>
           <td><?php echo $row->entry_date; ?></td>
           <td><?php echo $row->nama_pegawai_edit; ?></td>
           <td><?php echo $row->edit_date; ?></td>


           </tr>

   <?php }
   }
   ?>




               </tbody>
               <tfoot>
                 <tr>
                   <th>Opsi</th>
                   <th>No RM</th>
                   <th>Nama</th>
                   <th>Usia</th>
                   <th>Alamat</th>
                   <th>Telepon</th>
                   <th>Jenis Kelamin</th>
                   <th>Email</th>
                   <th>Kapitasi</th>
                   <th>No BPJS</th>
                   <th>Dientri Oleh</th>
                   <th>Dientri Pada</th>
                   <th>Diedit Oleh</th>
                   <th>Diedit Pada</th>
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
