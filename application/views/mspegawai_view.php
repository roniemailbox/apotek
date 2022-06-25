<?php
include 'includefile/head.php';
?>
<?php
if ($perintah=="Baru"){
  $action_form = 'Mspegawai/tambah';
}
else {
  $action_form = 'Mspegawai/edit';
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
             <label>NIK PEGAWAI</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-key"></i></span>
               <input type="text" class="form-control" name="id_pegawai" placeholder="AUTO" readonly >
             </div>
             <label>Status Pegawai</label>
             <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                    <select class="select2 form-control" name="id_status_pegawai" required>
                      <option value="">-- Pilih --</option>
                      <?php foreach ($data_status_pegawai as $rowstatus)
                      {
                        echo '<option value="'.$rowstatus->id_status_pegawai.'">'.$rowstatus->nama_status_pegawai.'</option>';
                      }
                      ?>
                    </select>
              </div>
             <label>Level</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
               <select type="text" class="form-control" name="id_jenis" required>
               <option value="">-- Pilih --</option>
                                <?php foreach ($data_jenis as $dt_j)
                                {
                                  echo '<option value="'.$dt_j->id_jenis.'">'.$dt_j->nama.'</option>';
                                }
                                ?>
                              </select>
              </div>
             <label>Tanggal Masuk</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-calender"></i></span>
               <input class="form-control" name="tgl_masuk" value="<?php echo date('Y-m-d'); ?>" placeholder="Tanggal Diterima Kerja" type="date">
             </div>

              <label>Nama</label>
              <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-user"></i></span>
                       <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required>
                 </div>
             <label>Sub Unit</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
               <select type="text" class="form-control" name="kd_sub_unit" required>
               <option value="">-- Pilih --</option>
                                <?php foreach ($data_subunit as $dt)
                                {
                                  echo '<option value="'.$dt->kd_sub_unit.'">'.$dt->nama_sub_unit.'</option>';
                                }
                                ?>
                              </select>
             </div>
             <label>Jabatan</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
               <select type="text" class="form-control" name="id_jabatan" required>
               <option value="">-- Pilih --</option>
                                <?php foreach ($data_jabatan as $dt_jabatan)
                                {
                                  echo '<option value="'.$dt_jabatan->id_jabatan.'">'.$dt_jabatan->nama.'</option>';
                                }
                                ?>
                              </select>
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
                  <label>Kota Lahir</label>
                  <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                     <select class="select2 form-control" name="id_kota_lahir" required>
                       <option value="">-- Pilih --</option>
                       <?php foreach ($data_kabupaten as $dt_kab)
                                {
                                  echo '<option value="'.$data_kab->id.'">'.$dt_kab->nama_kota.'</option>';
                                }
                       ?>

                     </select>
                 </div>
                 <label>Tanggal Lahir</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-calender"></i></span>
               <input  class="form-control" name="tgl_lahir" value="<?php echo date('Y-m-d'); ?>" placeholder="Tanggal Lahir" type="date">
             </div>



             <!-- /.NAMAup -->

             <!-- /.form-group -->
           </div>
           <!-- /.col -->

           <div class="col-md-6">
           <label>Alamat</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
               <textarea type="text" class="form-control" name="alamat" placeholder="Alamat Pegawai"></textarea>
             </div>
             <label>Kota</label>
                  <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                     <select class="select2 form-control" name="id_kota" required>
                       <option value="">-- Pilih --</option>
                       <?php foreach ($data_kabupaten as $dt_kab)
                                {
                                  echo '<option value="'.$data_kab->id.'">'.$dt_kab->nama_kota.'</option>';
                                }
                       ?>
                     </select>
                 </div>
               <label>Tanda Tangan</label>
               <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                 <input type="file" class="form-control" name="my_picture"><span>* Max 1MB</span>
                </div>
                <label>KTP</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                  <input type="text" class="form-control" name="ktp" placeholder="KTP">
                 </div>

                 <label>Pendidikan</label>
                 <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                        <select class="select2 form-control" name="id_pendidikan">
                          <option value="">-- Pilih --</option>
                          <?php foreach ($data_pendidikan as $dt_pend)
                          {
                            echo '<option value="'.$dt_pend->id_pendidikan.'">'.$dt_pend->id_pendidikan.'</option>';
                          }
                          ?>
                        </select>
                  </div>
                  <label>Telepon</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control" name="telepon" placeholder="Telepon">
                 </div>
                 <label>Email</label>
               <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                 <input type="email" class="form-control" name="email" placeholder="E-mail">
                </div>
                <label>Bank</label>
                 <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                        <select class="select2 form-control" name="id_bank">
                          <option value="">-- Pilih --</option>
                          <?php foreach ($data_bank as $dt_bank)
                          {
                            echo '<option value="'.$dt_bank->kd_bank.'">'.$dt_bank->nama_bank.'</option>';
                          }
                          ?>
                        </select>
                 </div>
                <label>No. Rekening</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                  <input type="text" class="form-control" name="no_rekening" placeholder="No. Rekening">
                 </div>
                 <label>Aktif</label>
                            <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                            <select class="form-control select2" name="id_status_aktif" required>
                            <option value="">-- pilih --</option>
                            <?php foreach ($data_status_aktif as $dt_status_aktif)
                            {
                             echo '<option value="'.$dt_status_aktif->id_status_aktif.'">'.$dt_status_aktif->nama_status_aktif.'</option>';
                            }
                                   ?>
                                 </select>
                               </div>
               <label>Tanggal Keluar</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-calender"></i></span>
               <input class="form-control" name="tgl_keluar" value="" placeholder="Tanggal Keluar Kerja" type="date">
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
        if(isset($data_pegawai_edit))
        {
          foreach ($data_pegawai_edit as $row)
             { ?>
       <div class="row">
           <div class="col-md-6">
             <label>NIK</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-key"></i></span>
               <input type="text" class="form-control" name="id_pegawai" placeholder="Input NIK" value="<?php echo $row->id_pegawai ?>" required>
             </div>
             <label>Status Pegawai</label>
             <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                    <select class="select2 form-control" name="id_status_pegawai" required>
                      <option value="<?php echo $row->id_status_pegawai ?>"><?php echo $row->nama_status_pegawai ?></option>
                      <?php foreach ($data_status_pegawai as $rowstatus)
                      {
                        echo '<option value="'.$rowstatus->id_status_pegawai.'">'.$rowstatus->nama_status_pegawai.'</option>';
                      }
                      ?>
                    </select>
              </div>
             <label>Level</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
               <select type="text" class="form-control" name="id_jenis" required>
               <option value="<?php echo $row->id_jenis ?>"><?php echo $row->nama_jenis ?></option>
                                <?php foreach ($data_jenis as $dt_j)
                                {
                                  echo '<option value="'.$dt_j->id_jenis.'">'.$dt_j->nama.'</option>';
                                }
                                ?>
                              </select>
              </div>
             <label>Tanggal Masuk</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-calender"></i></span>
               <input class="form-control" name="tgl_masuk" value="<?php echo $row->tgl_masuk ?>" placeholder="Tanggal Diterima Kerja" type="date">
             </div>

              <label>Nama</label>
              <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-user"></i></span>
                       <input type="text" class="form-control" value="<?php echo $row->nama ?>" name="nama" placeholder="Nama Lengkap" required>
                 </div>
             <label>Sub Unit</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
               <select type="text" class="form-control" name="kd_sub_unit" required>
               <option value="<?php echo $row->kd_sub_unit ?>"><?php echo $row->nama_sub_unit ?></option>
                                <?php foreach ($data_sununit as $dt)
                                {
                                  echo '<option value="'.$dt->kd_sub_unit.'">'.$dt->nama_sub_unit.'</option>';
                                }
                                ?>
                              </select>
             </div>
             <label>Jabatan</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
               <select type="text" class="form-control" name="id_jabatan" required>
               <option value="<?php echo $row->id_jabatan ?>"><?php echo $row->nama_jabatan ?></option>
                                <?php foreach ($data_jabatan as $dt_jabatan)
                                {
                                  echo '<option value="'.$dt_jabatan->id_jabatan.'">'.$dt_jabatan->nama.'</option>';
                                }
                                ?>
                              </select>
             </div>


                 <label>Jenis Kelamin</label>
                 <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                        <select class="select2 form-control" name="jk" required>
                          <option value="<?php echo $row->jk ?>">
                                          <?php if($row->jk=="P"){
                                            echo "Perempuan";
                                          }
                                          else {
                                            echo "Laki-laki";
                                          }


                                          ?>


                                        </option>
                          <option value="L">Laki-laki</option>
                          <option value="P">Perempuan</option>
                        </select>
                  </div>
                  <label>Kota Lahir</label>
                  <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                     <select class="select2 form-control" name="id_kota_lahir" required>
                       <option value="<?php echo $row->id_kota_lahir ?>"><?php echo $row->nama_kota ?></option>
                       <?php foreach ($data_kabupaten as $dt_kab)
                       {
                         echo '<option value="'.$dt_kab->id.'">'.$$dt_kab->nama_kota.'</option>';
                       }
                       ?>
                     </select>
                 </div>
                 <label>Tanggal Lahir</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-calender"></i></span>
               <input  class="form-control" name="tgl_lahir" value="<?php echo $row->tgl_lahir ?>" placeholder="Tanggal Lahir" type="date">
             </div>


             <!-- /.NAMAup -->

             <!-- /.form-group -->
           </div>
           <!-- /.col -->
           <div class="col-md-6">
           <label>Alamat</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
               <textarea type="text" class="form-control" name="alamat" placeholder="Alamat Pegawai"><?php echo $row->alamat; ?></textarea>
             </div>
             <label>Kota</label>
                  <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                     <select class="select2 form-control" name="id_kota" required>
                       <option value="<?php echo $row->id_kota ?>"><?php echo $row->nama_kota ?></option>
                       <?php foreach ($data_kabupaten as $dt_kab)
                       {
                         echo '<option value="'.$dt_kab->id.'">'.$$dt_kab->name.'</option>';
                       }
                       ?>
                     </select>
                 </div>
               <label>Tanda Tangan</label>
               <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                 <input type="file" class="form-control" name="my_picture"><span>* Max 1MB</span>
                </div>
                <label>KTP</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                  <input type="text" class="form-control" value="<?php echo $row->ktp ?>" name="ktp" placeholder="KTP">
                 </div>

                 <label>Pendidikan</label>
                 <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                        <select class="select2 form-control" name="id_pendidikan" >
                          <option value="<?php echo $row->pendidikan ?>"><?php echo $row->pendidikan ?></option>
                          <?php foreach ($data_pendidikan as $dt_pend)
                          {
                            echo '<option value="'.$dt_pend->id_pendidikan.'">'.$dt_pend->id_pendidikan.'</option>';
                          }
                          ?>
                        </select>
                  </div>
                  <label>Telepon</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control" value="<?php echo $row->telepon ?>" name="telepon" placeholder="Telepon">
                 </div>
                 <label>Email</label>
               <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                 <input type="email" class="form-control" value="<?php echo $row->email ?>" name="email" placeholder="E-mail">
                </div>
                <label>Bank</label>
                 <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                        <select class="select2 form-control" name="id_bank" >
                          <option value="<?php echo $row->id_bank ?>"><?php echo $row->nama_bank ?></option>
                          <?php foreach ($data_bank as $dt_bank)
                          {
                            echo '<option value="'.$dt_bank->kd_bank.'">'.$dt_bank->nama_bank.'</option>';
                          }
                          ?>
                        </select>
                      </div>
                <label>No. Rekening</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                  <input type="text" class="form-control" value="<?php echo $row->no_rekening ?>" name="no_rekening" placeholder="No. Rekening">
                 </div>
                 <label>Aktif</label>
                            <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                            <select class="form-control select2" name="id_status_aktif" required>
                            <option value="<?php echo $row->id_status_aktif ?>"><?php echo $row->nama_status_aktif ?></option>
                            <?php foreach ($data_status_aktif as $dt_status_aktif)
                            {
                             echo '<option value="'.$dt_status_aktif->id_status_aktif.'">'.$dt_status_aktif->nama_status_aktif.'</option>';
                            }
                                   ?>
                                 </select>
                               </div>
               <label>Tanggal Keluar</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-calender"></i></span>
               <input class="form-control" name="tgl_keluar" value="<?php echo $row->tgl_keluar ?>" placeholder="Tanggal Keluar Kerja" type="date">
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

      <?php
     }
   }
  }
  ?>


     </form>


   <!-- Main content -->

     <div class="row">
       <div class="col-xs-12">


         <div class="box">

          <?php //include 'includefile/Pesan.php'; ?>
          <div class="box-header">


               <button type="button" class="btn btn-block btn-info btn-flat" data-toggle="modal" data-target="#modal-default"><i class="fa fa-search"></i>
                 Cari Data Pegawai
               </button>

           </div>

           <div class="modal fade" id="modal-default">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Mspegawai/filter')?>">
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
                   <th>OPSI</th>
                   <th>NIK</th>
                   <th>NAMA</th>
                   <th>LEVEL</th>
                   <th>JABATAN</th>
                   <th>UNIT</th>
                   <th>SUBUNIT</th>
                   <th>TANGGAL JOIN</th>
                   <th>MASA KERJA</th>
                   <th>STATUS PEGAWAI</th>
                   <th>STATUS</th>

                 </tr>
               </thead>
               <tbody>
                <!--
               <a class="btn btn-mini" href="<?php //echo site_url('master/hapus_barang/'.$row->kd_barang);?>"
        onclick="return confirm('Anda yakin?')"> <i class="icon-remove"></i> Hapus</a> -->
   </td>
 <?php
 //ambil dari controler
 $no=1;
 if(isset($data_pegawai))
    {
      foreach ($data_pegawai as $row)
         { ?>

<div class="modal fade" id="modal-<?php echo $row->id_pegawai; ?>">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Mspegawai/Dataedit')?>">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title">Edit Data Ini....????</h4>
                 </div>
                 <div class="modal-body">
                   <p>
                     <h5>NIK</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-key"></i></span>
                       <input type="test" name="id_pegawai" value="<?php echo $row->id_pegawai; ?>" class="form-control" placeholder="Auto" readonly>

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
           <div class="modal fade" id="modal-hapus<?php echo $row->id_pegawai; ?>">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Mspegawai/hapus')?>">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title">Hapus Data Ini....????</h4>
                 </div>
                 <div class="modal-body">
                   <p>
                     <h5>NIK</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-key"></i></span>
                       <input type="text" name="id_pegawai" value="<?php echo $row->id_pegawai; ?>" class="form-control" placeholder="Auto" readonly>
                     </div>
                     <h5>Nama</h5>

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
           //echo $hak_u;
            if($hak_u == 1)
           {
             ?>
             <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-<?php echo $row->id_pegawai; ?>"><i class="fa fa-pencil"></i>
               Edit
             </button>
           <?php
           }
           if($hak_d == 1)
           {
             ?>
             <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-hapus<?php echo $row->id_pegawai; ?>"><i class="fa fa-trash"></i>
              Hapus
             </button>
           <?php
           }
            if($hak_p == 1)
           {
             ?>
             <!--<a href="<?php echo site_url('mspegawai/showprofile/'.$row->id_pegawai); ?>" class="btn btn-success btn-xs"><i class="fa fa-user"></i> Profile</a>-->

           <?php
           }
           ?>
         </td>

           <td><?php echo $row->id_pegawai; ?></td>
           <td><?php echo $row->nama; ?></td>
           <td><?php echo $row->nama_jenis; ?></td>
           <td><?php echo $row->nama_jabatan; ?></td>
           <td><?php echo $row->nama_unit; ?></td>
           <td><?php echo $row->nama_sub_unit; ?></td>
           <td><?php echo $row->tgl_masuk; ?></td>
           <td><?php echo $row->lama_kerja; ?></td>
           <td><?php echo $row->nama_status_pegawai; ?></td>
           <td><?php echo $row->nama_status_aktif; ?></td>

         </tr>

   <?php }
   }
   ?>




               </tbody>
               <tfoot>
               <tr>
                 <th>OPSI</th>
                 <th>NIK</th>
                 <th>NAMA</th>
                 <th>LEVEL</th>
                 <th>JABATAN</th>
                 <th>UNIT</th>
                 <th>SUBUNIT</th>

                 <th>TANGGAL JOIN</th>
                 <th>MASA KERJA</th>
                 <th>STATUS PEGAWAI</th>
                 <th>STATUS</th>

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
<
