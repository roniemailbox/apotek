<?php
include 'includefile/head.php';
$id = get_cookie('eklinik');
?>

<?php
if ($perintah=="Baru"){
  $action_form = 'Skck/tambah';
}
else {
  $action_form = 'Skck/edit';
}

?>
<link href="<?=base_url('/')?>assets/css/style_auto.css" rel="stylesheet">
<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery-1.8.2.min.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.autocomplete.js'></script>

<script type='text/javascript'>
            var jq_auto = $.noConflict(true);
            var site = "<?php echo site_url();?>";
            jq_auto(function(){
              //alert("saa");
              jq_auto('.ktpsearch').autocomplete({
                // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
                serviceUrl: site+'/autocomplete/cari_warga',
                //serviceUrl: site+'/autocomplete/item_po',
                // fungsi ini akan dijalankan ketika user memilih salah satu hasil request

                //'nama'	=>$row->nama,
    						//'ktp'		=>$row->ktp,
    						//'alamat'=>$row->alamat,
    						//'id_jabatan'=>$row->id_jabatan,
    						//'kotalahir'=>$row->kotalahir,
    						//'tgllahir'=>$row->tgllahir,
    						//'id_rt'=>$row->id_rt,
    						//'rt'=>$row->rt,
    						//'id_agama'=>$row->id_agama,
    						//'id_rw'=>$row->id_rw,
    						//'id_desa'=>$row->id_desa,
    						//'id_kecamatan'=>$row->id_kecamatan,
    						//'id_kabupaten'=>$row->id_kabupaten,
    						//'id_provinsi'=>$row->id_provinsi,
    						//'nama_kecamatan'=>$row->nama_kecamatan,
    						//'nama_kabupaten'=>$row->nama_kabupaten,
    						//'nama_provinsi'=>$row->nama_provinsi,
    						//'rw'=>$row->rw,
    						//'dusun'=>$row->dusun,
    						//'nama_jabatan'=>$row->nama_jabatan,
    						//'kota_lahir'=>$row->kota_lahir,
    						//'jk'=>$row->jk,
    						//'agama'=>$row->agama,
    						//'warganegara'=>$row->warganegara,
    						//'id_pekerjaan'=>$row->id_pekerjaan,
    						//'nama_pekerjaan'=>$row->nama_pekerjaan

                onSelect: function (suggestion) {
                  jq_auto('#ktp').val(''+suggestion.ktp);
                  jq_auto('#nama_warga').val(''+suggestion.nama);
                  jq_auto('#kotalahir').val(''+suggestion.kotalahir);
                  jq_auto('#kota_lahir').val(''+suggestion.kota_lahir);
                  jq_auto('#tgllahir').val(''+suggestion.tgllahir);
                  jq_auto('#jk').val(''+suggestion.jk);
                  jq_auto('#agama').val(''+suggestion.agama);
                  jq_auto('#warganegara').val(''+suggestion.warganegara);
                  jq_auto('#pekerjaan').val(''+suggestion.nama_pekerjaan);
                  jq_auto('#alamat').val(''+suggestion.alamat);
                  jq_auto('#id_agama').val(''+suggestion.id_agama);
                  jq_auto('#id_rt').val(''+suggestion.id_rt);
                 }
              });
            });
</script>
<script type="text/javascript">

    function LPSktp() {
      document.getElementById('filterktp').value='';
      document.getElementById('ktp').value='';
      document.getElementById('nama_warga').value='';
      document.getElementById('filterktp').focus();
    }
 </script>

<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <h1>
       <?php echo $title_tambah ?>
       <small></small>
     </h1>

   </section>

   <!-- Main content -->
   <section class="content">

      <!-- /.row -->
<form class="form-horizontal" method="post" action="<?=site_url($action_form)?>"  enctype="multipart/form-data" >
  <?php if($perintah=="Baru")
  {
    ?>
     <div class="row">
       <!-- left column -->
       <?php
       if ($id_jenis=1)
       {
       ?>
       <div class="col-md-4">
         <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $title_penduduk; ?></h3>
            </div>
            <div class="box-body">
              <h5>Pencarian</h5>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input onclick="LPSktp()" style="background:#AEC791;" class="ktpsearch form-control col-md-12 col-xs-12" name="nama_warga" type="text" id="filterktp" placeholder="Pencarian Data Warga"/>

              </div>
              <h5>Tanggal Pengajuan</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="date" value="<?php  echo date("Y-m-d") ?>" name="tgl_pengajuan" class="form-control" placeholder="KTP" >
              </div>
              <h5>KTP</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                <input type="text" id="ktp" value="<?php // $this->session->userdata('id_user'.$id)?>" name="ktp" class="form-control" placeholder="KTP" readonly>
              </div>
              <h5>Nama Pemohon</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" value="<?php //$this->session->userdata('nama'.$id)?>" id="nama_warga" name="nama" class="form-control" placeholder="Nama" readonly>
              </div>
              <h5>Kota Lahir</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map"></i></span>
                <input type="text" id="kota_lahir" value="<?php //$this->session->userdata('kota_lahir'.$id)?>" name="kota_lahir" class="form-control" placeholder="Nama" readonly>
                <input type="hidden" id="kotalahir" value="<?php //$this->session->userdata('kotalahir'.$id)?>" name="kotalahir" class="form-control" placeholder="Nama" readonly>
              </div>
              <h5>Tanggal Lahir</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" id="tgllahir" value="<?php //$this->session->userdata('tgllahir'.$id)?>" name="tgllahir" class="form-control" placeholder="Nama" readonly>
              </div>
              <h5>Kelamin</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
                <input type="text" id="jk" value="<?php //$this->session->userdata('jk'.$id)?>" name="jk" class="form-control" placeholder="Jenis Kelamin" readonly>
              </div>
              <h5>Agama</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                <input type="text" id="agama" value="<?php //$this->session->userdata('agama'.$id)?>" name="agama" class="form-control" placeholder="Agama" readonly>
                <input type="hidden" id="id_agama" value="<?php //$this->session->userdata('id_agama'.$id)?>" name="id_agama" class="form-control" placeholder="Nama" readonly>
                <input type="hidden" id="id_rt" value="<?php //$this->session->userdata('id_agama'.$id)?>" name="id_rt" class="form-control" placeholder="Nama" readonly>
              </div>
              <h5>Warga Negara</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-flag-o"></i></span>
                <input type="text" id="warganegara" value="<?php //$this->session->userdata('warganegara'.$id)?>" name="warganegara" class="form-control" placeholder="Warga Negara" readonly>

              </div>
              <h5>Pekerjaan</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-mortar-board"></i></span>
                <input type="text" id="pekerjaan" value="<?php //$this->session->userdata('pekerjaan'.$id)?>" name="pekerjaan" class="form-control" placeholder="Pekerjaan" readonly>
              </div>
              <h5>Alamat</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-signs"></i></span>
                <textarea id="alamat" class="form-control" rows="3" placeholder="Alamat" name="alamat" readonly><?php //$this->session->userdata('alamat'.$id)?></textarea>


              </div>
              <br>

              <!-- /input-group -->
            </div>
            <!-- /.box-body -->
          </div>

       </div>
       <?php
     }
     else {

       ?>
       <div class="col-md-4">
         <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $title_penduduk; ?></h3>
            </div>
            <div class="box-body">
              <h5>Tanggal Pengajuan</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="date" value="<?php  echo date("Y-m-d") ?>" name="tgl_pengajuan" class="form-control" placeholder="KTP" readonly >
              </div>
              <h5>KTP</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                <input type="text" value="<?= $this->session->userdata('id_user'.$id)?>" name="ktp" class="form-control" placeholder="KTP" readonly>
              </div>
              <h5>Nama Pemohon</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" value="<?= $this->session->userdata('nama'.$id)?>" name="nama" class="form-control" placeholder="Nama" readonly>
              </div>
              <h5>Kota Lahir</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map"></i></span>
                <input type="text" value="<?= $this->session->userdata('kota_lahir'.$id)?>" name="kota_lahir" class="form-control" placeholder="Nama" readonly>
                <input type="hidden" value="<?= $this->session->userdata('kotalahir'.$id)?>" name="kotalahir" class="form-control" placeholder="Nama" readonly>
              </div>
              <h5>Tanggal Lahir</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" value="<?= $this->session->userdata('tgllahir'.$id)?>" name="tgllahir" class="form-control" placeholder="Nama" readonly>
              </div>
              <h5>Kelamin</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
                <input type="text" value="<?= $this->session->userdata('jk'.$id)?>" name="jk" class="form-control" placeholder="Jenis Kelamin" readonly>
              </div>
              <h5>Agama</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                <input type="text" value="<?= $this->session->userdata('agama'.$id)?>" name="agama" class="form-control" placeholder="Agama" readonly>
                <input type="hidden" value="<?= $this->session->userdata('id_agama'.$id)?>" name="id_agama" class="form-control" placeholder="Nama" readonly>
              </div>
              <h5>Warga Negara</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-flag-o"></i></span>
                <input type="text" value="<?= $this->session->userdata('warganegara'.$id)?>" name="warganegara" class="form-control" placeholder="Warga Negara" readonly>
                <input type="hidden" value="<?= $this->session->userdata('id_rt'.$id)?>" name="id_rt" class="form-control" placeholder="Warga Negara">
              </div>
              <h5>Pekerjaan</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-mortar-board"></i></span>
                <input type="text" value="<?= $this->session->userdata('pekerjaan'.$id)?>" name="pekerjaan" class="form-control" placeholder="Pekerjaan" readonly>
              </div>
              <h5>Alamat</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-signs"></i></span>
                <textarea id="editorx" class="form-control" rows="3" placeholder="Alamat" name="alamat" readonly><?= $this->session->userdata('alamat'.$id)?></textarea>


              </div>
              <br>

              <!-- /input-group -->
            </div>
            <!-- /.box-body -->
          </div>

       </div>
       <?php
     }
        ?>

       <div class="col-md-8">

           <div class="box box-info">
             <div class="box-header">
               <h3 class="box-title">Keperluan Pengajuan Surat
                 <small></small>
               </h3>
               <h5>Jenis Surat</h5>
               <div class="input-group">


                      <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                      <select class="select2 form-control" name="id_surat" required>
                        <option value="">-- Pilih --</option>
                        <?php foreach ($data_surat as $rowsurat)
                        {
                          echo '<option value="'.$rowsurat->id_surat.'">'.$rowsurat->nama_surat.'</option>';
                        }
                        ?>
                      </select>


                </div>
             </div>
             <!-- /.box-header -->
             <div class="box-body pad">

                     <textarea id="editor1" name="editor1" rows="10" cols="80" placeholder="Keperluan Surat">

                     </textarea>

             </div>
             <div class="box" hidden>
               <div class="box-header">
                 <h3 class="box-title">Bootstrap WYSIHTML5
                   <small>Simple and fast</small>
                 </h3>
                 <!-- tools box -->
                 <div class="pull-right box-tools">
                   <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip"
                           title="Collapse">
                     <i class="fa fa-minus"></i></button>
                   <button type="button" class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip"
                           title="Remove">
                     <i class="fa fa-times"></i></button>
                 </div>
                 <!-- /. tools -->
               </div>
               <!-- /.box-header -->
               <div class="box-body pad">
                 <form>
                   <textarea class="textarea" placeholder="Place some text here"
                             style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                 </form>
               </div>
             </div>

           <!-- /.box -->

           <div class="box-footer">

             <button type="submit" class="btn btn-success pull-right">Simpan</button>
           </div>
           </div>
       </div>

       <div class="col-md-12">

           <div class="box box-info">

             <div class="box-header">
               <h3 class="box-title">Daftar Pengajuan Surat
                 <small></small>
               </h3>


             </div>

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
