<?php
include 'includefile/head.php';
$id = get_cookie('dahanr');
?>

<?php
if ($perintah=="Baru"){
  $action_form = 'Workorder/tambah';
}
else {
  $action_form = 'Workorder/edit';
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
                serviceUrl: site+'/autocomplete/cari_pasien',
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
                  jq_auto('#no_register').val(''+suggestion.no_register);
                  jq_auto('#nama_warga').val(''+suggestion.nama);
                  jq_auto('#kotalahir').val(''+suggestion.kotalahir);
                  jq_auto('#kota_lahir').val(''+suggestion.kota_lahir);
                  jq_auto('#tgllahir').val(''+suggestion.tgllahir);
                  jq_auto('#jk').val(''+suggestion.jk);
                  jq_auto('#keterangan').val(''+suggestion.keterangan);
                  jq_auto('#alamat').val(''+suggestion.alamat);
                  jq_auto('#telepon').val(''+suggestion.telepon);
                  jq_auto('#bpjs_kes').val(''+suggestion.bpjs_kes);
                 }
              });
            });
</script>
<script type="text/javascript">

    function LPSktp() {
      document.getElementById('filterktp').value='';
      //document.getElementById('ktp').value='';
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
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title_penduduk ?></h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <h5>Pencarian</h5>

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-search"></i></span>
              <input onclick="LPSktp()" style="background:#AEC791;" class="ktpsearch form-control col-md-12 col-xs-12" name="nama_warga" type="text" id="filterktp" placeholder="Pencarian Data Warga"/>

            </div>

            <h5>No Register</h5>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
              <input type="text" id="no_register" value="<?php // $this->session->userdata('id_user'.$id)?>" name="no_register" class="form-control" placeholder="No Register" readonly required>
            </div>


            <h5>No BPJS</h5>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
              <input type="text" id="bpjs_kes" value="<?php // $this->session->userdata('id_user'.$id)?>" name="bpjs_kes" class="form-control" placeholder="No BPJS" readonly>
            </div>
            <h5>Nama Pasien</h5>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" value="<?php //$this->session->userdata('nama'.$id)?>" id="nama_warga" name="nama" class="form-control" placeholder="Nama Pasien" readonly>
            </div>
            <h5>Kota Lahir</h5>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-map"></i></span>
              <input type="text" id="kota_lahir" value="<?php //$this->session->userdata('kota_lahir'.$id)?>" name="kota_lahir" class="form-control" placeholder="Kota Kelahiran" readonly>
              <input type="hidden" id="kotalahir" value="<?php //$this->session->userdata('kotalahir'.$id)?>" name="kotalahir" class="form-control" placeholder="Nama" readonly>
            </div>
            <h5>Tanggal Lahir</h5>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              <input type="text" id="tgllahir" value="<?php //$this->session->userdata('tgllahir'.$id)?>" name="tgllahir" class="form-control" placeholder="Tanggal Lahir" readonly>
            </div>
            <h5>Kelamin</h5>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
              <input type="text" id="jk" value="<?php //$this->session->userdata('jk'.$id)?>" name="jk" class="form-control" placeholder="Jenis Kelamin" readonly>
            </div>

            <h5>Alamat</h5>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-map-signs"></i></span>
              <textarea id="alamat" class="form-control" rows="3" placeholder="Alamat" name="alamat" readonly><?php //$this->session->userdata('alamat'.$id)?></textarea>


            </div>
            <h5>Telepon</h5>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-phone-square"></i></span>

              <input type="text" id="telepon" value="<?php //$this->session->userdata('jk'.$id)?>" name="telepon" class="form-control" placeholder="Telepon" readonly>


            </div>




            <!-- /.NAMAup -->

            <!-- /.form-group -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">


            <h5>Jenis Pasien</h5>
            <div class="input-group">


                   <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                   <select class="select2 form-control" name="tipe_wo" required>
                     <option value="">-- Pilih --</option>
                     <?php foreach ($data_jenis_px as $rowg)
                     {
                       echo '<option value="'.$rowg->id_jenis_pasien.'">'.$rowg->nama.'</option>';
                     }
                     ?>

                   </select>


             </div>

            <h5>Tanggal Kunjungan</h5>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              <input type="date" value="<?php  echo date("Y-m-d") ?>" name="tgl_wo" class="form-control" placeholder="KTP" >
            </div>

            <h5>Berat Badan</h5>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-child"></i></span>
              <input type="number" value="" name="berat_badan" class="form-control" placeholder="Berat Badan" >

            </div>
            <h5>Tinggi Badan</h5>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-child"></i></span>
              <input type="number" value="" name="tinggi_badan" class="form-control" placeholder="Tinggi Badan" >
            </div>
            <h5>Tekanan Darah</h5>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-heartbeat"></i></span>
              <input type="text" value="" name="tekanan_darah" class="form-control" placeholder="Tekanan Darah" >
            </div>
            <h5>Jam Kunjungan Pasien</h5>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
              <input type="time" value="" name="jam_masuk" class="form-control" placeholder="Jam" >
            </div>
            <h5>Poli</h5>
            <div class="input-group">


                   <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                   <select class="select2 form-control" name="id_poli" required>
                     <option value="">-- Pilih --</option>
                     <?php foreach ($data_poli as $rowpoli)
                     {
                       echo '<option value="'.$rowpoli->id_poli.'">'.$rowpoli->nama_poli.'</option>';
                     }
                     ?>
                   </select>


             </div>
            <h5>Nama Dokter</h5>
            <div class="input-group">


                   <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                   <select class="select2 form-control" name="id_dokter" required>
                     <option value="">-- Pilih --</option>
                     <?php foreach ($data_dokter as $rowdokter)
                     {
                       echo '<option value="'.$rowdokter->id_pegawai.'">'.$rowdokter->nama.'</option>';
                     }
                     ?>
                   </select>


             </div>
             <h5>Keluhan Pasien</h5>

             <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
               <textarea id="editor1" name="keluhan" rows="10" cols="80" placeholder="Keterangan">

               </textarea>
             </div>
           </div>



            <!-- /.form-group -->


          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      <!-- /.box-body -->
      <div class="box-footer">
       <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Simpan Data</button>
      </div>
    </div>





     <?php
     }
     else
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

           <?php
             $no=1;
             if(isset($data_wo_edit))
                {
                  foreach ($data_wo_edit as $row_edit)
                     { ?>

           <div class="row">
             <div class="col-md-6">
               <h5>Pencarian</h5>

               <div class="input-group">

                 <span class="input-group-addon"><i class="fa fa-search"></i></span>
                 <input onclick="LPSktp()" style="background:#AEC791;" class="ktpsearch form-control col-md-12 col-xs-12" name="nama_warga" type="text" id="filterktp" placeholder="Pencarian Data Warga"/>

               </div>





               <h5>No Register</h5>
               <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                 <input type="text" id="no_register" value="<?php echo $row_edit->no_register_px; ?>" name="no_register" class="form-control" placeholder="No Register" readonly>
                 <input type="hidden" id="no_wo" value="<?php echo $row_edit->no_wo ?>" name="no_wo" class="form-control" placeholder="No Register" readonly>
               </div>


               <h5>No BPJS</h5>
               <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                 <input type="text" id="bpjs_kes" value="<?php echo $row_edit->bpjs_kes; ?>" name="bpjs_kes" class="form-control" placeholder="No BPJS" readonly>
               </div>
               <h5>Nama Pasien</h5>
               <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-user"></i></span>
                 <input type="text" value="<?php echo $row_edit->nama; ?>" id="nama_warga" name="nama" class="form-control" placeholder="Nama Pasien" readonly>
               </div>
               <h5>Kota Lahir</h5>
               <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-map"></i></span>
                 <input type="text" id="kota_lahir" value="<?php echo $row_edit->kota_lahir; ?>" name="kota_lahir" class="form-control" placeholder="Kota Kelahiran" readonly>
                 <input type="hidden" id="kotalahir" value="<?php echo $row_edit->kotalahir; ?>" name="kotalahir" class="form-control" placeholder="Nama" readonly>
               </div>
               <h5>Tanggal Lahir</h5>
               <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                 <input type="text" id="tgllahir" value="<?php echo $row_edit->tgllahir; ?>" name="tgllahir" class="form-control" placeholder="Tanggal Lahir" readonly>
               </div>
               <h5>Kelamin</h5>
               <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
                 <input type="text" id="jk" value="<?php echo $row_edit->jk; ?>" name="jk" class="form-control" placeholder="Jenis Kelamin" readonly>
               </div>

               <h5>Alamat</h5>
               <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-map-signs"></i></span>
                 <textarea id="alamat" class="form-control" rows="3" placeholder="Alamat" name="alamat" readonly><?php echo $row_edit->alamat; ?></textarea>


               </div>
               <h5>Telepon</h5>
               <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-phone-square"></i></span>

                 <input type="text" id="telepon" value="<?php echo $row_edit->telepon; ?>" name="telepon" class="form-control" placeholder="Telepon" readonly>


               </div>




               <!-- /.NAMAup -->

               <!-- /.form-group -->
             </div>
             <!-- /.col -->
             <div class="col-md-6">


               <h5>Jenis Pasien</h5>
               <div class="input-group">


                      <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                      <select class="select2 form-control" name="tipe_wo" required>
                        <option value="<?php echo $row_edit->tipe_wo; ?>"><?php echo $row_edit->tipe_wo; ?></option>
                        <?php foreach ($data_jenis_px as $rowg)
                        {
                          echo '<option value="'.$rowg->id_jenis_pasien.'">'.$rowg->nama.'</option>';
                        }
                        ?>
                      </select>


                </div>

               <h5>Tanggal Kunjungan</h5>
               <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                 <input type="date" value="<?php echo $row_edit->tgl_masuk; ?>" name="tgl_wo" class="form-control" placeholder="KTP" >
               </div>

               <h5>Berat Badan</h5>
               <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-child"></i></span>
                 <input type="number" value="<?php echo $row_edit->berat_badan; ?>" name="berat_badan" class="form-control" placeholder="Berat Badan" >

               </div>
               <h5>Tinggi Badan</h5>
               <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-child"></i></span>
                 <input type="number" value="<?php echo $row_edit->tinggi_badan; ?>" name="tinggi_badan" class="form-control" placeholder="Tinggi Badan" >
               </div>
               <h5>Tekanan Darah</h5>
               <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-heartbeat"></i></span>
                 <input type="text" value="<?php echo $row_edit->tekanan_darah; ?>" name="tekanan_darah" class="form-control" placeholder="Tekanan Darah" >
               </div>
               <h5>Jam Kunjungan Pasien</h5>
               <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                 <input type="time" value="<?php echo $row_edit->jam_masuk; ?>" name="jam_masuk" class="form-control" placeholder="Jam" >
               </div>
               <h5>Poli</h5>
               <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                      <select class="select2 form-control" name="id_poli" required>
                        <option value="<?php echo $row_edit->id_poli; ?>"><?php echo $row_edit->nama_poli; ?></option>
                        <?php foreach ($data_poli as $rowpoli)
                        {
                          echo '<option value="'.$rowpoli->id_poli.'">'.$rowpoli->nama_poli.'</option>';
                        }
                        ?>
                      </select>
                </div>
               <h5>Nama Dokter</h5>
               <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                      <select class="select2 form-control" name="id_dokter" required>
                        <option value="<?php echo $row_edit->id_dokter; ?>"><?php echo $row_edit->nama_dokter; ?></option>
                        <?php foreach ($data_dokter as $rowdokter)
                        {
                          echo '<option value="'.$rowdokter->id_pegawai.'">'.$rowdokter->nama.'</option>';
                        }
                        ?>
                      </select>
                </div>
                <h5>Keluhan Pasien</h5>

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                  <textarea id="editor1" name="keluhan" rows="10" cols="80" placeholder="Keterangan">
                    <?php echo $row_edit->keluhan; ?>
                  </textarea>
                </div>
              </div>
               <!-- /.form-group -->
             </div>
             <!-- /.col -->
           <?php }}?>
           </div>
           <!-- /.row -->
         <!-- /.box-body -->
         <div class="box-footer">
           <a href="<?php echo site_url('Workorder'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Input Baru</a>
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
             Cari Data Kunjungan (<?php echo number_format($jml_wo).' Data' ; ?>)
           </button>

         </div>

         <div class="modal fade" id="modal-default">
           <div class="modal-dialog">
             <div class="modal-content">
               <form class="form-horizontal" method="post" action="<?php echo site_url('Workorder/filter')?>">
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
                 <th>No Kunjungan</th>
                 <th>Tgl Kunjungan</th>
                 <th>No RM</th>
                 <th>Nama</th>
                 <th>Poli</th>
                 <th>Petugas</th>
                 <th>Alamat</th>
                 <th>Telepon</th>
                 <th>Jenis Kelamin</th>
                 <th>Email</th>
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
 if(isset($data_wo))
  {
    foreach ($data_wo as $row)
       { ?>

         <div class="modal fade" id="modal-<?php echo $row->no_wo; ?>">
           <div class="modal-dialog">
             <div class="modal-content">
               <form class="form-horizontal" method="post" action="<?php echo site_url('Workorder/Dataedit')?>">
               <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title">Edit Data Ini....????</h4>
               </div>
               <div class="modal-body">
                 <p>
                   <h5>No Kunjungan</h5>

                   <div class="input-group">

                     <span class="input-group-addon"><i class="fa fa-key"></i></span>
                     <input type="test" name="no_wo" value="<?php echo $row->no_wo; ?>" class="form-control" placeholder="Auto" readonly>

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
         <div class="modal fade" id="modal-hapus<?php echo $row->no_wo; ?>">
           <div class="modal-dialog">
             <div class="modal-content">
               <form class="form-horizontal" method="post" action="<?php echo site_url('Workorder/hapus')?>">
               <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title">Hapus Data Ini....????</h4>
               </div>
               <div class="modal-body">
                 <p>
                   <h5>No Kunjungan</h5>

                   <div class="input-group">

                     <span class="input-group-addon"><i class="fa fa-key"></i></span>
                     <input type="text" name="no_wo" value="<?php echo $row->no_wo; ?>" class="form-control" placeholder="Auto" readonly>
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
         <div class="modal fade" id="modal-preview<?php echo $row->no_wo; ?>">
           <div class="modal-dialog">
             <div class="modal-content">
               <form class="form-horizontal" method="post" target="_blank" action="<?php echo site_url('Workorder/cetak')?>">
               <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title">Cetak Data Ini....????</h4>
               </div>
               <div class="modal-body">
                 <p>
                   <h5>No Kunjungan</h5>

                   <div class="input-group">

                     <span class="input-group-addon"><i class="fa fa-key"></i></span>
                     <input type="text" name="no_wo" value="<?php echo $row->no_wo; ?>" class="form-control" placeholder="Auto" readonly>
                   </div>
                   <h5>Nama Pasien</h5>

                   <div class="input-group">

                     <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                     <input type="text" value="<?php echo $row->nama; ?>" class="form-control" placeholder="rw" readonly>
                     <input type="text" name="no_register_px" value="<?php echo $row->no_register_px; ?>" class="form-control" placeholder="rw" readonly>
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

         <div class="modal fade" id="modal-finish<?php echo $row->no_wo; ?>">
           <div class="modal-dialog">
             <div class="modal-content">
               <form class="form-horizontal" method="post" action="<?php echo site_url('Workorder/Finishjob')?>">
               <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title">Finish Kunjungan Pasien Ini....????</h4>
               </div>
               <div class="modal-body">
                 <p>
                   <h5>No Kunjungan</h5>

                   <div class="input-group">

                     <span class="input-group-addon"><i class="fa fa-key"></i></span>
                     <input type="text" name="no_wo" value="<?php echo $row->no_wo; ?>" class="form-control" placeholder="Auto" readonly>
                   </div>
                   <h5>Nama Pasien</h5>

                   <div class="input-group">

                     <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                     <input type="text" value="<?php echo $row->nama; ?>" class="form-control" placeholder="rw" readonly>
                     <input type="hidden" name="no_register" value="<?php echo $row->no_register_px; ?>" class="form-control" placeholder="rw" readonly>
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
               <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-<?php echo $row->no_wo; ?>"><i class="fa fa-pencil"></i>
                 Edit
               </button>

             <?php
             }
             if($hak_d == 1)
             {
               ?>
               <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-hapus<?php echo $row->no_wo; ?>"><i class="fa fa-trash"></i>
                 Hapus
               </button>


             <?php
             }
             if($hak_p == 1)
             {
               ?>
               <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-preview<?php echo $row->no_wo; ?>"><i class="fa fa-print"></i>
                 Print
               </button>


             <?php
             }

             ?>
           </td>
         <td><?php echo $row->no_wo; ?></td>
         <td><?php echo $row->tgl_masuk; ?></td>
         <td><?php echo $row->no_register_px; ?></td>
         <td><?php echo $row->nama; ?></td>
         <td><?php echo $row->nama_poli; ?></td>
         <td><?php echo $row->nama_dokter; ?></td>
         <td><?php echo $row->alamat; ?></td>
         <td><?php echo $row->telepon; ?></td>
         <td><?php echo $row->jk; ?></td>
         <td><?php echo $row->email; ?></td>
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
                 <th>No Kunjungan</th>
                 <th>Tgl Kunjungan</th>
                 <th>No RM</th>
                 <th>Nama</th>
                 <th>Poli</th>
                 <th>Petugas</th>
                 <th>Alamat</th>
                 <th>Telepon</th>
                 <th>Jenis Kelamin</th>
                 <th>Email</th>
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
   </section>
   <!-- /.content -->
 </div>

<?php include 'includefile/foot.php'; ?>
