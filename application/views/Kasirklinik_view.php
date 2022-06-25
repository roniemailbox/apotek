<?php
include 'includefile/head.php';
$id = get_cookie('dahanr');
?>

<?php
if ($perintah=="Baru"){
  $action_form = 'Finishworkorder/simpanfinish';
}
else {
  $action_form = 'Finishworkorder/edit';
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


   <div class="row">


     <div class="col-xs-12">


       <div class="box">

        <?php //include 'template/Pesan.php'; ?>
         <div class="box-header">


           <button type="button" class="btn btn-block btn-info btn-flat" data-toggle="modal" data-target="#modal-default"><i class="fa fa-search"></i>
             Cari RM
           </button>

         </div>

         <div class="modal fade" id="modal-default">
           <div class="modal-dialog">
             <div class="modal-content">
               <form class="form-horizontal" method="post" action="<?php echo site_url('Obatresep/filter')?>">
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
                 <th>No Resep</th>
                 <th>No Tindakan</th>
                 <th>No Register Px</th>
                 <th>Nama Pasien</th>
                 <th>Dokter</th>
                 <th>No Telp Px</th>


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
               <form class="form-horizontal" method="post" action="<?php echo site_url('Finishworkorder/Dataedit')?>">
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
               <form class="form-horizontal" method="post" action="<?php echo site_url('Finishworkorder/hapus')?>">
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
         <div class="modal fade" id="modal-preview<?php echo $row->no_bukti; ?>">
           <div class="modal-dialog">
             <div class="modal-content">
               <form class="form-horizontal" method="post" target="_blank" action="<?php echo site_url('Kasirklinik/Cetaktagihan')?>">
               <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title">Cetak Tagihan Ini....????</h4>
               </div>
               <div class="modal-body">
                 <p>
                   <h5>No RM</h5>

                   <div class="input-group">

                     <span class="input-group-addon"><i class="fa fa-key"></i></span>
                     <input type="text" name="no_wo" value="<?php echo $row->no_bukti; ?>" class="form-control" placeholder="Auto" readonly>
                     <input type="hidden" name="no_resep" value="<?php echo $row->no_resep; ?>" class="form-control" placeholder="Auto" readonly>
                     <input type="hidden" name="no_penjuaan" value="<?php echo $row->no_penjualan; ?>" class="form-control" placeholder="Auto" readonly>
                   </div>
                   <h5>Nama Pasien</h5>

                   <div class="input-group">

                     <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                     <input type="text" value="<?php echo $row->nama_pasien; ?>" class="form-control" placeholder="rw" readonly>
                   </div>
                   <h5>Nama Dokter</h5>

                   <div class="input-group">

                     <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                     <input type="text" value="<?php echo $row->nama_dokter; ?>" class="form-control" placeholder="rw" readonly>
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

         <div class="modal fade" id="modal-obat<?php echo $row->no_bukti; ?>">
           <div class="modal-dialog">
             <div class="modal-content">
               <form class="form-horizontal" method="post" action="<?php echo site_url('Kasirklinik/tagihan')?>">
               <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title">Proses Tagihan Tidakan Medis dan Resep</h4>
               </div>
               <div class="modal-body">
                 <p>
                   <h5>No RM</h5>

                   <div class="input-group">

                     <span class="input-group-addon"><i class="fa fa-key"></i></span>
                     <input type="text" name="no_rm" value="<?php echo $row->no_bukti; ?>" class="form-control" placeholder="Auto" readonly>
                     <input type="hidden" name="no_resep" value="<?php echo $row->no_resep; ?>" class="form-control" placeholder="Auto" readonly>
                     <input type="hidden" name="no_penjuaan" value="<?php echo $row->no_penjualan; ?>" class="form-control" placeholder="Auto" readonly>
                   </div>
                   <h5>Tanggal</h5>

                   <div class="input-group">

                     <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                     <input type="text" value="<?php echo $row->tgl_masuk; ?>" class="form-control" placeholder="rw" readonly>

                   </div>
                   <h5>Nama Pasien</h5>

                   <div class="input-group">

                     <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                     <input type="text" value="<?php echo $row->nama_pasien; ?>" class="form-control" placeholder="rw" readonly>
                     <input type="hidden" name="no_wo" value="<?php echo $row->no_wo; ?>" class="form-control" placeholder="rw" readonly>
                   </div>
                   <h5>Dokter</h5>

                   <div class="input-group">

                     <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                     <input type="text" value="<?php echo $row->nama_dokter; ?>" class="form-control" placeholder="rw" readonly>

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
             if($hak_c == 1)
             {
               ?>
               <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-obat<?php echo $row->no_bukti; ?>"><i class="fa fa-hourglass-end"></i>
                 Proses Tagihan
               </button>

               <!--<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target=".bs-example-modal-lg<?php //echo $row->no_wo ?>">Input Jasa & Status WO</button>-->
             <?php
             }

             if($hak_p == 1 and $row->status_ar <> '')
             {
               ?>
               <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-preview<?php echo $row->no_bukti; ?>"><i class="fa fa-print"></i>
                 Print Tagihan
               </button>

             <?php
             }
             else {
               ?>
               <button disabled type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-preview<?php echo $row->no_bukti; ?>" ><i class="fa fa-print"></i>
                 Print Tagihan
               </button>
               <?php
             }

             ?>
           </td>
         <td><?php echo $row->no_bukti; ?></td>
         <td><?php echo $row->no_wo; ?></td>
         <td><?php echo $row->no_register_px; ?></td>
         <td><?php echo $row->nama_pasien; ?></td>
         <td><?php echo $row->nama_dokter; ?></td>
         <td><?php echo $row->telepon; ?></td>



         </tr>

 <?php }
 }
 ?>




             </tbody>
             <tfoot>
               <tr>
                 <th>Opsi</th>
                 <th>No Resep</th>
                 <th>No Tindakan</th>
                 <th>No Register Px</th>
                 <th>Nama Pasien</th>
                 <th>Dokter</th>
                 <th>No Telp Px</th>

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
