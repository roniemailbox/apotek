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
          <div class="box box-default collapsed-box">
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
                    <span class="info-box-text">PEGAWAI</span>
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
<form class="form-horizontal" method="post" action="<?=site_url($action_form)?>"  enctype="multipart/form-data" >
  <?php if($perintah=="Baru")
  {
    ?>
     <div class="row">
       <!-- left column -->
       <div class="col-md-6">
         <div class="box box-info">
             <div class="box-header with-border">
               <h3 class="box-title">Data Karyawan</h3>
             </div>
     <!-- /.box-header -->
     <!-- form start -->


                 <div class="box-body">



                   <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">NIK
                     </label>
                     <div class="col-md-2 col-sm-6 col-xs-12">
                       <input id="name" class="form-control col-md-2 col-xs-12" value="" name="id_pegawai" placeholder="AUTO" type="text" readonly>
                     </div>
                   </div>

 					             <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Status Pegawai *
                          </label>

                            <div class="col-md-6 col-xs-12">
                              <select class="form-control select2 col-md-12" name="id_status_pegawai" required>
                                <option value="">-- Pilih --</option>
                                <?php foreach ($data_status_pegawai as $dt_status_pegawai)
                                {
                                  echo '<option value="'.$dt_status_pegawai->id_status_pegawai.'">'.$dt_status_pegawai->nama_status_pegawai.'</option>';
                                }
                                ?>
                              </select>
                            </div>

                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Level
                          </label>

                            <div class="col-md-4 col-xs-12">
                              <select class="form-control select2 col-md-12" name="id_jenis" required>
                                <option value="">-- Pilih --</option>
                                <?php foreach ($data_jenis as $dt_j)
                                {
                                  echo '<option value="'.$dt_j->id_jenis.'">'.$dt_j->nama.'</option>';
                                }
                                ?>
                              </select>
                            </div>

                        </div>



                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanggal Masuk
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-3 col-xs-12" value="<?php echo date('Y-m-d'); ?>" name="tglmasuk" placeholder="Tanggal Diterima Kerja" type="date">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama
                        </label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-8 col-xs-12" name="nama" placeholder="Nama Lengkap" required="required" type="text">
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Sub Unit
                        </label>

                          <div class="col-md-4 col-xs-12">
                            <select class="form-control select2 col-md-12" name="kd_sub_unit" required>
                               <option value="">-- Pilih --</option>
                              <?php foreach ($data_subunit as $dt)
                              {
                                echo '<option value="'.$dt->kd_sub_unit.'">'.$dt->nama_sub_unit.'</option>';
                              }
                              ?>
                            </select>
                          </div>

                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Jabatan
                        </label>

                          <div class="col-md-4 col-xs-12">
                            <select class="form-control select2 col-md-12" name="id_jabatan" required>
                               <option value="">-- Pilih --</option>
                              <?php foreach ($data_jabatan as $dt_jabatan)
                              {
                                echo '<option value="'.$dt_jabatan->id_jabatan.'">'.$dt_jabatan->nama.'</option>';
                              }

                              ?>
                            </select>
                          </div>

                      </div>




                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kelamin
                        </label>

                          <div class="col-md-4 col-xs-12">
                            <select class="form-control select2 col-md-12" name="jk">
                              <option value="">-- Pilih --</option>
                              <option value="L">Laki-laki</option>
                              <option value="P">Perempuan</option>
                            </select>
                          </div>

                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kota Lahir
                        </label>

                          <div class="col-md-4 col-xs-12">
                            <select class="form-control select2 col-md-12" name="id_kota_lahir" required>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanggal Lahir
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input class="form-control col-md-3 col-xs-12" name="tgllahir" placeholder="Tanggal Lahir" type="date">
                          </div>
                        </div>



                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Alamat
                        </label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                          <textarea id="alamat" placeholder="Alamat" class="form-control" name="alamat" ><?php //echo $row->alamat_invoice; ?></textarea>
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
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanda Tangan
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">

                       <input type="file" class="form-control" name="my_picture" ><span>* Max 1MB</span>
                     </div>
                   </div>



                   <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">KTP
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                       <input id="name" class="form-control col-md-7 col-xs-12" name="ktp" placeholder="KTP" type="text">
                     </div>
                   </div>

                   <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pendidikan
                     </label>

                       <div class="col-md-4 col-xs-12">
                         <select class="form-control select2 col-md-12" name="id_pendidikan">
                           <option value="">-- Pilih --</option>
                           <?php foreach ($data_pendidikan as $dt_pend)
                           {
                             echo '<option value="'.$dt_pend->id_pendidikan.'">'.$dt_pend->id_pendidikan.'</option>';
                           }
                           ?>
                         </select>
                       </div>

                   </div>

                   <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Telepon
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                       <input class="form-control col-md-7 col-xs-12" name="telepon" placeholder="Telepon" type="text">
                     </div>
                   </div>


                   <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">E-mail
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                       <input class="form-control col-md-7 col-xs-12" value="" name="email" placeholder="E-mail" type="email">
                     </div>
                   </div>


                   <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Bank
                     </label>

                       <div class="col-md-4 col-xs-12">
                         <select class="form-control select2 col-md-12" name="id_bank">
                           <option value="">-- Pilih --</option>
                           <?php foreach ($data_bank as $dt_bank)
                           {
                             echo '<option value="'.$dt_bank->kd_bank.'">'.$dt_bank->nama_bank.'</option>';
                           }
                           ?>
                         </select>
                       </div>

                   </div>
                   <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">No Rekening
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                       <input id="name" class="form-control col-md-7 col-xs-12" name="no_rekening" placeholder="No Rekening" type="text">
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



                   <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanggal Keluar
                     </label>
                     <div class="col-md-3 col-sm-6 col-xs-12">
                       <div class="input-group date">
                       <div class="input-group-addon">
                         <i class="fa fa-calendar"></i>
                       </div>
                       <input class="form-control col-md-3 col-xs-12" name="tglkeluar" placeholder="Tanggal Keluar" type="date">
                       </div>
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


     if(isset($data_pegawai))
        {
          foreach ($data_pegawai as $row)
             {  ?>

               <div class="row">
                 <!-- left column -->
                 <div class="col-md-6">
                   <div class="box box-info">
                       <div class="box-header with-border">
                         <h3 class="box-title">Data Karyawan <?php echo $perintah ?></h3>
                       </div>
               <!-- /.box-header -->
               <!-- form start -->


                           <div class="box-body">



                             <div class="form-group">
                               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">NIK
                               </label>
                               <div class="col-md-2 col-sm-6 col-xs-12">
                                 <input id="name" class="form-control col-md-2 col-xs-12" value="<?php echo $row->id_pegawai ?>" name="id_pegawai" placeholder="ENV-XXX" type="text" required readonly>
                               </div>
                             </div>

           					             <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Status Pegawai
                                    </label>

                                      <div class="col-md-6 col-xs-12">
                                        <select class="form-control select2 col-md-12" name="id_status_pegawai" required>
                                          <option value="<?php echo $row->id_status_pegawai ?>"><?php echo $row->nama_status_pegawai ?></option>
                                          <?php foreach ($data_status_pegawai as $dt_status_pegawai)
                                          {
                                            echo '<option value="'.$dt_status_pegawai->id_status_pegawai.'">'.$dt_status_pegawai->nama_status_pegawai.'</option>';
                                          }
                                          ?>
                                        </select>
                                      </div>

                                  </div>

                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Level
                                    </label>

                                      <div class="col-md-4 col-xs-12">
                                        <select class="form-control select2 col-md-12" name="id_jenis" required>
                                          <option value="<?php echo $row->id_jenis ?>"><?php echo $row->nama_jenis ?></option>
                                          <?php foreach ($data_jenis as $dt_j)
                                          {
                                            echo '<option value="'.$dt_j->id_jenis.'">'.$dt_j->nama.'</option>';
                                          }
                                          ?>
                                        </select>
                                      </div>

                                  </div>



                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanggal Masuk
                                  </label>
                                  <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-3 col-xs-12" value="<?php echo $row->tgl_masuk ?>" name="tglmasuk" placeholder="Tanggal Diterima Kerja" type="date">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama
                                  </label>
                                  <div class="col-md-8 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-8 col-xs-12" value="<?php echo $row->nama_pegawai ?>" name="nama" placeholder="Nama Lengkap" required="required" type="text">
                                  </div>
                                </div>


                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Sub Unit
                                  </label>

                                    <div class="col-md-4 col-xs-12">
                                      <select class="form-control select2 col-md-12" name="kd_sub_unit" required>
                                         <option value="<?php echo $row->kd_sub_unit ?>"><?php echo $row->nama_sub_unit ?></option>
                                        <?php foreach ($data_subunit as $dt)
                                        {
                                          echo '<option value="'.$dt->kd_sub_unit.'">'.$dt->nama_sub_unit.'</option>';
                                        }
                                        ?>
                                      </select>
                                    </div>

                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Jabatan
                                  </label>

                                    <div class="col-md-4 col-xs-12">
                                      <select class="form-control select2 col-md-12" name="id_jabatan" required>
                                         <option value="<?php echo $row->id_jabatan ?>"><?php echo $row->nama_jabatan ?></option>
                                        <?php foreach ($data_jabatan as $dt_jabatan)
                                        {
                                          echo '<option value="'.$dt_jabatan->id_jabatan.'">'.$dt_jabatan->nama.'</option>';
                                        }

                                        ?>
                                      </select>
                                    </div>

                                </div>




                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kelamin
                                  </label>

                                    <div class="col-md-4 col-xs-12">
                                      <select class="form-control select2 col-md-12" name="jk">
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

                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kota Lahir
                                  </label>

                                    <div class="col-md-4 col-xs-12">
                                      <select class="form-control select2 col-md-12" name="id_kota_lahir" required>
                                         <option value="<?php echo $row->id_kota_lahir ?>"><?php echo $row->nama_kota_lahir ?></option>
                                        <?php foreach ($data_kabupaten as $dt_kab)
                                        {
                                          echo '<option value="'.$dt_kab->id.'">'.$dt_kab->name.'</option>';
                                        }

                                        ?>
                                      </select>
                                    </div>

                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanggal Lahir
                                  </label>
                                  <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="input-group date">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <input class="form-control col-md-3 col-xs-12" value="<?php echo $row->tgl_lahir ?>" name="tgllahir" placeholder="Tanggal Lahir" type="date">
                                    </div>
                                  </div>



                                </div>
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Alamat
                                  </label>
                                  <div class="col-md-8 col-sm-6 col-xs-12">
                                    <textarea id="alamat" placeholder="Alamat" class="form-control" name="alamat" ><?php  echo $row->alamat; ?></textarea>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kota
                                  </label>

                                    <div class="col-md-4 col-xs-12">
                                      <select class="form-control select2 col-md-12" name="id_kota">
                                         <option value="<?php echo $row->id_kota ?>"><?php echo $row->nama_kota ?></option>
                                        <?php foreach ($data_kabupaten as $dt_kab)
                                        {
                                          echo '<option value="'.$dt_kab->id.'">'.$dt_kab->name.'</option>';
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
                               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanda Tangan
                               </label>
                               <div class="col-md-6 col-sm-6 col-xs-12">

                                 <input type="file" class="form-control" name="my_picture" ><span>* Max 1MB</span>
                               </div>
                             </div>



                             <div class="form-group">
                               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">KTP
                               </label>
                               <div class="col-md-6 col-sm-6 col-xs-12">
                                 <input id="name" class="form-control col-md-7 col-xs-12" value="<?php echo $row->ktp ?>" name="ktp" placeholder="KTP" type="text">
                               </div>
                             </div>

                             <div class="form-group">
                               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pendidikan
                               </label>

                                 <div class="col-md-4 col-xs-12">
                                   <select class="form-control select2 col-md-12" name="id_pendidikan">
                                     <option value="<?php echo $row->pendidikan ?>"><?php echo $row->pendidikan ?></option>
                                     <?php foreach ($data_pendidikan as $dt_pend)
                                     {
                                       echo '<option value="'.$dt_pend->id_pendidikan.'">'.$dt_pend->id_pendidikan.'</option>';
                                     }
                                     ?>
                                   </select>
                                 </div>

                             </div>

                             <div class="form-group">
                               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Telepon
                               </label>
                               <div class="col-md-6 col-sm-6 col-xs-12">
                                 <input class="form-control col-md-7 col-xs-12" value="<?php echo $row->telepon ?>" name="telepon" placeholder="Telepon" type="text">
                               </div>
                             </div>


                             <div class="form-group">
                               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">E-mail
                               </label>
                               <div class="col-md-6 col-sm-6 col-xs-12">
                                 <input class="form-control col-md-7 col-xs-12" value="<?php echo $row->email ?>" name="email" placeholder="E-mail" type="email">
                               </div>
                             </div>


                             <div class="form-group">
                               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Bank
                               </label>

                                 <div class="col-md-4 col-xs-12">
                                   <select class="form-control select2 col-md-12" name="id_bank">
                                     <option value="<?php echo $row->kd_bank ?>"><?php echo $row->nama_bank ?></option>
                                     <?php foreach ($data_bank as $dt_bank)
                                     {
                                       echo '<option value="'.$dt_bank->kd_bank.'">'.$dt_bank->nama_bank.'</option>';
                                     }
                                     ?>
                                   </select>
                                 </div>

                             </div>
                             <div class="form-group">
                               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">No Rekening
                               </label>
                               <div class="col-md-6 col-sm-6 col-xs-12">
                                 <input id="name" class="form-control col-md-7 col-xs-12" name="no_rekening" value="<?php echo $row->no_rekening ?>" placeholder="No Rekening" type="text">
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



                             <div class="form-group">
                               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanggal Keluar
                               </label>
                               <div class="col-md-3 col-sm-6 col-xs-12">
                                 <div class="input-group date">
                                 <div class="input-group-addon">
                                   <i class="fa fa-calendar"></i>
                                 </div>
                                 <input class="form-control col-md-3 col-xs-12" name="tglkeluar" value="<?php echo $row->tgl_keluar ?>" placeholder="Tanggal Keluar" type="date">
                                 </div>
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
