<?php
include 'includefile/head.php';
$id = get_cookie('eklinik');
?>

<?php
if ($perintah=="Baru"){
  $action_form = 'Finishworkorder/simpanfinish';
}
else {
  $action_form = 'Finishworkorder/editfinish';
}

?>
<script>
$(document).keydown( function(event) {
if (event.which === 118) {
// login code here
//alert("XXXXX");
document.getElementById('btnSubmit').click();
}
});
</script>
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <h1>
       <?php echo $title ?>
       <small>Klinik</small>
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
<form class="form-horizontal" method="post" action="<?=site_url($action_form)?>"  enctype="multipart/form-data" onkeypress="return event.keyCode != 13;">
  <?php if($perintah=="Baru")
  {
    ?>

    <div class="row">
           <!-- /.col -->
           <?php
             $no=1;
             if(isset($data_wo))
                {
                  foreach ($data_wo as $row)
                     { ?>
                        <div class="col-md-12">
                          <!-- Box Comment -->
                          <div class="box box-default collapsed-box box-solid">
                            <div class="box-header with-border">
                              <div class="user-block">
                                <img class="img-circle" src="<?php echo base_url(); ?>assets/images/userpx.png" alt="User Image">
                                <span class="username"><a href="#"><?php echo $row->nama.' ( '.$row->tipe_wo.' )'; ?></a></span>
                                <span class="username"><a href="#"><?php echo $row->no_wo ?></a></span>
                                <span class="description"><?php echo "Jam Masuk : ".$row->jam_masuk ?></span>
                                <span class="description"><?php echo "Tanggal Lahir : ".$row->tgllahir ?></span>
                                <span class="description"><?php echo "Usia : ".$row->usia_pasien ?></span>


                              </div>
                              <!-- /.user-block -->
                              <div class="box-tools">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse">Riwayat Pasien <i class="fa fa-plus"></i>
                                </button>

                              </div>
                              <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                              <!-- post text -->
                              <strong><p>Catatan : </p></strong>



                              <!-- Attachment -->
                              <div class="attachment-block clearfix">
                                <img class="img-circle img-sm" src="<?php echo base_url(); ?>assets/images/dokter.png" alt="Attachment Image">

                                <div class="attachment-pushed">


                                  <div class="attachment-text">
                                    <?php echo $row->keterangan ?><a href="#"></a>
                                  </div>
                                  <!-- /.attachment-text -->
                                </div>
                                <!-- /.attachment-pushed -->
                              </div>
                              <!-- /.attachment-block -->


                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer box-comments">
                              <strong><p>Riwayat Kunjungan : </p></strong>
                              <?php
                                $no=1;
                                if(isset($data_histori))
                                   {
                                     foreach ($data_histori as $rowhis)
                                        { ?>
                                          <ul class="timeline">

                                            <li class="time-label">

                                                  <span class="bg-gray">
                                                    <img class="img-circle img-sm" src="<?php echo base_url(); ?>assets/images/dokter.png" alt="User Image">
                                                    <span class="username">
                                                    <?php echo "Dokter : ". $rowhis->nama_dokter ?>
                                                    <span class="text-muted pull-right"><?php echo $rowhis->no_wo ." / ". $rowhis->tgl_masuk. " : " .$rowhis->jam_masuk ?></span>
                                                    </span>


                                                    <?php //echo $rowhis->no_wo ." : ". $rowhis->tgl_masuk . " : " .$rowhis->jam_masuk; ?>
                                                  </span>
                                            </li>

                                            <li>
                                              <i class="fa fa-edit bg-blue"></i>

                                              <div class="timeline-item">
                                                <h3 class="timeline-header"><a href="#"><?php echo "Subjective : " ?></a>   </h3>
                                                <div class="timeline-body">
                                                <?php echo $rowhis->subjective ?>
                                                </div>

                                              </div>
                                            </li>

                                            <li>
                                              <i class="fa fa-eye bg-yellow"></i>
                                              <div class="timeline-item">
                                                <h3 class="timeline-header"><a href="#">Objective : </a>   </h3>
                                                <div class="timeline-body">
                                                <?php echo $rowhis->objective ?>
                                                </div>
                                              </div>
                                            </li>
                                            <li>
                                              <i class="fa fa-comments bg-purple"></i>

                                              <div class="timeline-item">
                                                <h3 class="timeline-header"><a href="#">Assesment : </a>   </h3>

                                                <div class="timeline-body">
                                                  <?php echo $rowhis->assesment ?>
                                                </div>
                                              </div>
                                            </li>
                                            <li>
                                              <i class="fa fa-flag-o bg-maroon"></i>
                                              <div class="timeline-item">
                                               <h3 class="timeline-header"><a href="#">Planing : </a>   </h3>
                                                <?php echo $rowhis->planing ?>
                                                <div class="timeline-body">

                                                </div>

                                              </div>
                                            </li>
                                            <li>
                                              <i class="fa fa-clock-o bg-gray"></i>
                                            </li>


                                          </ul>
                                          <br>


                              <!-- /.box-comment -->
                            <?php }} ?>
                              <!-- /.box-comment -->
                            </div>
                            <!-- /.box-footer -->
                            <div class="box-footer">

                            </div>
                            <!-- /.box-footer -->
                          </div>
                          <!-- /.box -->
                        </div>

      <div class="col-md-12">
        <!-- Widget: user widget style 1 -->
        <div class="box box-widget widget-user-2">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header bg-green">
            <div class="widget-user-image">
              <img class="img-circle" src="<?php echo base_url(); ?>assets/images/tindakan.png" alt="User Avatar">
            </div>
            <!-- /.widget-user-image -->
            <h3 class="widget-user-username">ANALISA MEDIS</h3>
            <h5 class="widget-user-desc">Catatan Terintegrasi</h5>
          </div>
          <div class="box-footer no-padding">
            <div class="row">
              <div class="col-md-3">
                <h5>Subjektif</h5>

               <div class="input-group">


                 <textarea id="editor1" name="subjective" rows="5" cols="80" placeholder="Subjective">
                   <?php echo $row->keluhan ?>
                 </textarea>
               </div>
              </div>
              <div class="col-md-3">
                <h5>Objective</h5>

               <div class="input-group">


                 <textarea id="editor2" name="objective" rows="5" cols="80" placeholder="Keterangan">
                    <?php echo "TD  : ".$row->tekanan_darah ?><br>
                    <?php echo "BB : ".$row->berat_badan ?><br>
                    <?php echo "TB : ".$row->tinggi_badan ?>
                 </textarea>
               </div>
              </div>

              <div class="col-md-3">
                <h5>Assesment</h5>

               <div class="input-group">


                 <textarea name="assesment" id="editor3" name="assesment" rows="5" cols="80" placeholder="Keterangan">

                 </textarea>
               </div>
              </div>

              <div class="col-md-3">
                <h5>Planing</h5>

               <div class="input-group">


                 <textarea name="planing" id="editor4" name="planing" rows="5" cols="80" placeholder="Keterangan">

                 </textarea>
               </div>
              </div>
              <!--


               /.col -->

              <!-- /.col -->
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="box-header">
                  <h3 class="box-title">Instruksi
                    <small>Medis</small>
                  </h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body pad">

                    <textarea name="instruksi" class="textarea" placeholder="Instruksi" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>

                </div>
              </div>




              <!--


               /.col -->

              <!-- /.col -->
            </div>




            <input type="hidden" id="no_wo" value="<?php echo $row->no_wo ?>" name="no_wo" class="form-control" placeholder="No Register" readonly>
            <input type="hidden" value="<?php echo $row->tgl_masuk ?>" name="tgl_trans" class="form-control" placeholder="No Register" readonly>

          </div>
        </div>
        <!-- /.widget-user -->
      </div>
      <?php }} ?>

      <link href="<?php echo base_url('/');?>assets/css/style_auto.css" rel="stylesheet">
      <script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery-1.8.2.min.js'></script>
      <script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.autocomplete.js'></script>


      <script type='text/javascript'>
                  var jq_auto = $.noConflict(true);
                  var site = "<?php echo site_url();?>";
                  jq_auto(function(){
                    //alert("saa");
                    jq_auto('.partsearch').autocomplete({
                      // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
                      serviceUrl: site+'/autocomplete/item_obat',
                      // fungsi ini akan dijalankan ketika user memilih salah satu hasil request
                      onSelect: function (suggestion) {
                        jq_auto('#id_barang').val(''+suggestion.id_barang);
                        jq_auto('#nama_barang').val(''+suggestion.nama_barang);
                        //jq_auto('#dpp').val(''+suggestion.dpp);
                        //jq_auto('#hj').val(''+suggestion.hj);
                        //jq_auto('#nilaippn').val(''+suggestion.nilaippn);
                        //jq_auto('#itemppn').val(''+suggestion.ppn);
                        jq_auto('#satuan').val(''+suggestion.satuan);

                        document.getElementById("qty").focus();
                      }
                    });
                  });

                  jq_auto(function(){
                  //alert("saa");
                    jq_auto('.anggotasearch').autocomplete({
                      // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
                      serviceUrl: site+'/autocomplete/anggota_aktif',
                      // fungsi ini akan dijalankan ketika user memilih salah satu hasil request
                      onSelect: function (suggestion) {
                        jq_auto('#npa').val(''+suggestion.npa);
                        jq_auto('#nama').val(''+suggestion.nama);
                        jq_auto('#nik').val(''+suggestion.nik);
                        jq_auto('#kd_sub_unit').val(''+suggestion.kd_sub_unit);
                        jq_auto('#nama_unit').val(''+suggestion.nama_unit);
                        jq_auto('#nama_sub_unit').val(''+suggestion.nama_sub_unit);

                        //document.getElementById("qty").focus();
                      }
                    });
                  });


      </script>
      <script type="text/javascript">

          function LPS() {
            document.getElementById('filterbarang').value='';
            document.getElementById('id_barang').value='';
            document.getElementById('nama_barang').value='';
            //document.getElementById('qty').value='1';
            //document.getElementById('hj').value='0';
            //document.getElementById('dpp').value='0';
            //document.getElementById('nilaippn').value='0';
            //document.getElementById('diskon').value='0';
            //document.getElementById('perc_diskon').value='0';
            //document.getElementById('itemppn').value='';
            //document.getElementById('satuan').value='';
            //document.getElementById('total').value='0';
            document.getElementById('filterbarang').focus();
          }
          </script>
          <script type="text/javascript">
               var j_x_1 = $.noConflict(true);
               j_x_1(document).ready(
               function ()
               {
                    setTimeout(function(){
                    j_x_1("#add_btn_item").click(
                    function (){
                    //recounter();
                    }
                    );

                    }, 200);
              }
              );
               function jum_akhir(){
                    var inputs = document.querySelectorAll('input[name="rowsBM[]"]');
                    var max = 0;
                    //var tmax = 0;
                    for (var i = 0; i < inputs.length; ++i) {
                         max = Math.max(max , parseFloat(inputs[i].value));
                    }
                    //alert(max+1);
                    //document.getElementById('key_max').value = parseFloat(max+1);
                    //document.getElementById('key_max').value = max+1;

                    }


          </script>

          <div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-blue">
                <div class="widget-user-image">
                  <img class="img-circle" src="<?php echo base_url(); ?>assets/images/resep2.png" alt="User Avatar">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username">JASA</h3>
                <h5 class="widget-user-desc">Jasa Tindakan Medis</h5>
              </div>
              <div class="box-footer no-padding">

                <div class="table-responsive">
             <table class="table table-striped jambo_table bulk_action">
               <thead>
                 <tr class="headings">
                   <th><input type="checkbox" id="check-all" class="flat"></th>
                  <th class="column-title">  </th>
                   <th class="column-title">Jasa / Pekerjaan </th>
                   <!-- <th class="column-title">Harga </th>
                   <th class="column-title">Diskon </th> -->

                   <th class="bulk-actions" colspan="7">
                     <a class="antoo" style="color:#fff; font-weight:500;">Jasa / Pekerjaan ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                   </th>
                 </tr>
               </thead>


               <tbody>
                 <?php $count = 0; foreach ($data_jasa_in as $rowjasa)
                 { $count++;?>
                   <tr>
                     <td align="center"><input type="checkbox" name="rowJasa[]" value="<?=$count?>" class="flat" <?php echo 'checked';?>></td>
                     <td class=" "><input class="form-control col-md-4 col-xs-12" type="hidden" value="<?php echo $rowjasa->id_jasa; ?>" name="id_jasa_<?php echo $count; ?>" readonly></td>
                     <td class=" "><?php echo $rowjasa->nama; ?></td>
                     <td><input style="text-align:right; width:100%" class="form-control col-md-4 col-xs-12" type="hidden" value="<?php echo $rowjasa->nilai; ?>" name="nilai_<?php echo $count; ?>"></td>
                     <td><input style="text-align:right; width:100%" class="form-control col-md-4 col-xs-12" type="hidden" value="<?php echo $rowjasa->diskon; ?>" name="diskon_<?php echo $count; ?>"></td>
                   </tr>
                 <?php } ?>
                 <?php foreach ($data_jasa_out as $rowjasa)
                 { $count++;?>
                   <tr>
                     <td align="center"><input type="checkbox" name="rowJasa[]" value="<?=$count?>" class="flat"></td>
                     <td class=" "><input class="form-control col-md-4 col-xs-12" type="hidden" value="<?php echo $rowjasa->id_jasa; ?>" name="id_jasa_<?php echo $count; ?>" readonly></td>
                     <td class=" "><?php echo $rowjasa->nama; ?></td>
                     <td><input style="text-align:right; width:100%" class="form-control col-md-4 col-xs-12" type="hidden" value="<?php echo $rowjasa->nilai; ?>" name="nilai_<?php echo $count; ?>"></td>
                     <td><input style="text-align:right; width:100%" class="form-control col-md-4 col-xs-12" type="hidden" value="<?php echo $rowjasa->diskon; ?>" name="diskon_<?php echo $count; ?>"></td>
                   </tr>
                 <?php } ?>
               </tbody>

             </table>
           </div>




              </div>


            </div>
            <!-- /.widget-user -->
          </div>
      <div class="col-md-8">
        <!-- Widget: user widget style 1 -->
        <div class="box box-widget widget-user-2">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header bg-yellow">
            <div class="widget-user-image">
              <img class="img-circle" src="<?php echo base_url(); ?>assets/images/resep2.png" alt="User Avatar">
            </div>
            <!-- /.widget-user-image -->
            <h3 class="widget-user-username">RESEP</h3>
            <h5 class="widget-user-desc">Obat-obat yang tersedia di Apotek Pradhana</h5>
          </div>
          <div class="box-footer no-padding">
            <div class="input-group">
              <div class="input-group-btn">
                <button type="button" class="btn btn-danger btn-flat"> <i class="fa fa-search"></i></button>
              </div>
               <input onclick="LPS()" style="background:#FFF;" class="partsearch form-control" name="filterbarang" type="text" id="filterbarang" placeholder="Pencarian Obat"/>


              <!-- /btn-group -->
            </div>


                <input name="id_barang" type="hidden" id="id_barang" class="form-control"  placeholder="Kode Barang">
                <input name="nama_barang" type="hidden" id="nama_barang" class="form-control"  placeholder="Nama Barang" readonly>
                <input name="satuan" type="hidden" id="satuan" class="form-control"  placeholder="Nama Barang" readonly>


              <div class="box-body">
                <div class="row" hidden>
                  <div class="col-xs-3">
                    <input type="text" class="form-control" placeholder=".col-xs-3">
                  </div>
                  <div class="col-xs-4">
                    <input type="text" class="form-control" placeholder=".col-xs-4">
                  </div>
                  <div class="col-xs-5">
                    <input type="text" class="form-control" placeholder=".col-xs-5">
                  </div>
                </div>
                <input hidden="" id="site_url_x" value="<?php echo base_url();?>">
                <script type="text/javascript" src='<?php echo base_url();?>assets/js/jquery-1.3.2.js'></script>
                <script type="text/javascript" src='<?php echo base_url();?>assets/js/jquery-1.4.2.min.js'></script>
                <script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery-1.8.2.min.js'></script>
                <script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.calculation.js'></script>
                <script type="text/javascript" src='<?php echo base_url();?>assets/js/append_resep.js'></script>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-shopping-cart"></i>
                  </div>
                <input type="button" class="btn btn-block btn-info btn-flat" name="add_btn_item" value="Tambahkan Ke Resep" id="add_btn_item" onblur="hitung_pilih_item();" onmouseover="hitung_pilih_item();"  />
                </div>
              </div>
              <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Obat</th>
                    <th>Qty</th>
                    <th>Satuan</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                  </tr>
                </thead>
                  <tbody id="containeritem" style="height: 100px; overflow: auto;">


                 </tbody>


                </table>
                <input style="text-align:center" type="text" class="form-control" id="key_max" value="<?php //echo ($count) ?>" style="background-color:#eea236; color:black;" />
              </div>





          </div>
          <h5>Keterangan Resep</h5>
          <div class="input-group">

            <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
            <textarea id="editor5" name="keterangan_resep" rows="5" cols="80" placeholder="Keterangan Resep">

            </textarea>
          </div>
          <div class="box-footer">
            <div class="input-group-btn">
              <button id="btnSubmit" type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Simpan</button>
            </div>
          </div>
        </div>

        <!-- /.widget-user -->
      </div>

      <!-- /.col -->
    </div>





     <?php
     }
     else
     {
       ?>
        <div class="row">
              <!-- /.col -->
              <?php
                $no=1;
                if(isset($data_wo_edit))
                   {
                     foreach ($data_wo_edit as $row)
                        { ?>
                          <div class="col-md-12">
                            <!-- Box Comment -->
                            <div class="box box-default collapsed-box box-solid">
                              <div class="box-header with-border">
                                <div class="user-block">
                                  <img class="img-circle" src="<?php echo base_url(); ?>assets/images/userpx.png" alt="User Image">
                                  <span class="username"><a href="#"><?php echo $row->nama.' ( '.$row->tipe_wo.' )'; ?></a></span>
                                  <span class="username"><a href="#"><?php echo $row->no_wo ?></a></span>
                                  <span class="description"><?php echo "Jam Masuk : ".$row->jam_masuk ?></span>
                                  <span class="description"><?php echo "Tanggal Lahir : ".$row->tgllahir ?></span>
                                  <span class="description"><?php echo "Usia : ".$row->usia_pasien ?></span>


                                </div>
                                <!-- /.user-block -->
                                <div class="box-tools">
                                  <button type="button" class="btn btn-box-tool" data-widget="collapse">Riwayat Pasien <i class="fa fa-plus"></i>
                                  </button>

                                </div>
                                <!-- /.box-tools -->
                              </div>
                              <!-- /.box-header -->
                              <div class="box-body">
                                <!-- post text -->
                                <strong><p>Catatan : </p></strong>



                                <!-- Attachment -->
                                <div class="attachment-block clearfix">
                                  <img class="img-circle img-sm" src="<?php echo base_url(); ?>assets/images/dokter.png" alt="Attachment Image">

                                  <div class="attachment-pushed">


                                    <div class="attachment-text">
                                      <?php echo $row->keterangan ?><a href="#"></a>
                                    </div>
                                    <!-- /.attachment-text -->
                                  </div>
                                  <!-- /.attachment-pushed -->
                                </div>
                                <!-- /.attachment-block -->


                              </div>
                              <!-- /.box-body -->
                              <div class="box-footer box-comments">
                                <strong><p>Riwayat Kunjungan : </p></strong>
                                <?php
                                  $no=1;
                                  if(isset($data_histori))
                                     {
                                       foreach ($data_histori as $rowhis)
                                          { ?>
                                            <ul class="timeline">

                                              <li class="time-label">

                                                    <span class="bg-gray">
                                                      <img class="img-circle img-sm" src="<?php echo base_url(); ?>assets/images/dokter.png" alt="User Image">
                                                      <span class="username">
                                                      <?php echo "Dokter : ". $rowhis->nama_dokter ?>
                                                      <span class="text-muted pull-right"><?php echo $rowhis->no_wo ." / ". $rowhis->tgl_masuk. " : " .$rowhis->jam_masuk ?></span>
                                                      </span>


                                                      <?php //echo $rowhis->no_wo ." : ". $rowhis->tgl_masuk . " : " .$rowhis->jam_masuk; ?>
                                                    </span>
                                              </li>

                                              <li>
                                                <i class="fa fa-edit bg-blue"></i>

                                                <div class="timeline-item">
                                                  <h3 class="timeline-header"><a href="#"><?php echo "Subjective : " ?></a>   </h3>
                                                  <div class="timeline-body">
                                                  <?php echo $rowhis->subjective ?>
                                                  </div>

                                                </div>
                                              </li>

                                              <li>
                                                <i class="fa fa-eye bg-yellow"></i>
                                                <div class="timeline-item">
                                                  <h3 class="timeline-header"><a href="#">Objective : </a>   </h3>
                                                  <div class="timeline-body">
                                                  <?php echo $rowhis->objective ?>
                                                  </div>
                                                </div>
                                              </li>
                                              <li>
                                                <i class="fa fa-comments bg-purple"></i>

                                                <div class="timeline-item">
                                                  <h3 class="timeline-header"><a href="#">Assesment : </a>   </h3>

                                                  <div class="timeline-body">
                                                    <?php echo $rowhis->assesment ?>
                                                  </div>
                                                </div>
                                              </li>
                                              <li>
                                                <i class="fa fa-flag-o bg-maroon"></i>
                                                <div class="timeline-item">
                                                 <h3 class="timeline-header"><a href="#">Planing : </a>   </h3>
                                                  <?php echo $rowhis->planing ?>
                                                  <div class="timeline-body">

                                                  </div>

                                                </div>
                                              </li>
                                              <li>
                                                <i class="fa fa-clock-o bg-gray"></i>
                                              </li>


                                            </ul>
                                            <br>


                                <!-- /.box-comment -->
                              <?php }} ?>
                                <!-- /.box-comment -->
                              </div>
                              <!-- /.box-footer -->
                              <div class="box-footer">

                              </div>
                              <!-- /.box-footer -->
                            </div>
                            <!-- /.box -->
                          </div>

         <div class="col-md-12">
           <!-- Widget: user widget style 1 -->
           <div class="box box-widget widget-user-2">
             <!-- Add the bg color to the header using any of the bg-* classes -->
             <div class="widget-user-header bg-green">
               <div class="widget-user-image">
                 <img class="img-circle" src="<?php echo base_url(); ?>assets/images/tindakan.png" alt="User Avatar">
               </div>
               <!-- /.widget-user-image -->
               <h3 class="widget-user-username">ANALISA MEDIS</h3>
               <h5 class="widget-user-desc">Catatan Terintegrasi</h5>
             </div>
             <div class="box-footer no-padding">
               <div class="row">
                 <div class="col-md-3">
                   <h5>Subjektif</h5>

                  <div class="input-group">


                    <textarea id="editor1" name="subjective" rows="5" cols="80" placeholder="Subjective">
                      <?php echo $row->subjective ?>
                    </textarea>
                  </div>
                 </div>
                 <div class="col-md-3">
                   <h5>Objective</h5>

                  <div class="input-group">


                    <textarea id="editor2" name="objective" rows="5" cols="80" placeholder="Keterangan">
                      <?php echo $row->objective ?>
                    </textarea>
                  </div>
                 </div>

                 <div class="col-md-3">
                   <h5>Assesment</h5>

                  <div class="input-group">


                    <textarea name="assesment" id="editor3" name="assesment" rows="5" cols="80" placeholder="Keterangan">
                      <?php echo $row->assesment ?>
                    </textarea>
                  </div>
                 </div>

                 <div class="col-md-3">
                   <h5>Planing</h5>

                  <div class="input-group">


                    <textarea name="planing" id="editor4" name="planing" rows="5" cols="80" placeholder="Keterangan">
                      <?php echo $row->planing ?>
                    </textarea>
                  </div>
                 </div>

               </div>
               <div class="row">
                 <div class="col-md-12">
                   <div class="box-header">
                     <h3 class="box-title">Instruksi
                       <small>Medis</small>
                     </h3>

                   </div>
                   <!-- /.box-header -->
                   <div class="box-body pad">

                       <textarea name="instruksi" class="textarea" placeholder="Instruksi" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                         <?php echo $row->instruksi ?>
                       </textarea>

                   </div>
                 </div>

               </div>




               <input type="hidden" id="no_wo" value="<?php echo $row->no_wo ?>" name="no_wo" class="form-control" placeholder="No Register" readonly>
               <input type="hidden" value="<?php echo $row->tgl_masuk ?>" name="tgl_trans" class="form-control" placeholder="No Register" readonly>

             </div>
           </div>
           <!-- /.widget-user -->
         </div>
         <?php }} ?>

         <link href="<?php echo base_url('/');?>assets/css/style_auto.css" rel="stylesheet">
         <script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery-1.8.2.min.js'></script>
         <script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.autocomplete.js'></script>


         <script type='text/javascript'>
                     var jq_auto = $.noConflict(true);
                     var site = "<?php echo site_url();?>";
                     jq_auto(function(){
                       //alert("saa");
                       jq_auto('.partsearch').autocomplete({
                         // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
                         serviceUrl: site+'/autocomplete/item_obat',
                         // fungsi ini akan dijalankan ketika user memilih salah satu hasil request
                         onSelect: function (suggestion) {
                           jq_auto('#id_barang').val(''+suggestion.id_barang);
                           jq_auto('#nama_barang').val(''+suggestion.nama_barang);
                           //jq_auto('#dpp').val(''+suggestion.dpp);
                           //jq_auto('#hj').val(''+suggestion.hj);
                           //jq_auto('#nilaippn').val(''+suggestion.nilaippn);
                           //jq_auto('#itemppn').val(''+suggestion.ppn);
                           jq_auto('#satuan').val(''+suggestion.satuan);

                           document.getElementById("qty").focus();
                         }
                       });
                     });

                     jq_auto(function(){
                     //alert("saa");
                       jq_auto('.anggotasearch').autocomplete({
                         // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
                         serviceUrl: site+'/autocomplete/anggota_aktif',
                         // fungsi ini akan dijalankan ketika user memilih salah satu hasil request
                         onSelect: function (suggestion) {
                           jq_auto('#npa').val(''+suggestion.npa);
                           jq_auto('#nama').val(''+suggestion.nama);
                           jq_auto('#nik').val(''+suggestion.nik);
                           jq_auto('#kd_sub_unit').val(''+suggestion.kd_sub_unit);
                           jq_auto('#nama_unit').val(''+suggestion.nama_unit);
                           jq_auto('#nama_sub_unit').val(''+suggestion.nama_sub_unit);

                           //document.getElementById("qty").focus();
                         }
                       });
                     });


         </script>
         <script type="text/javascript">

             function LPS() {
               document.getElementById('filterbarang').value='';
               document.getElementById('id_barang').value='';
               document.getElementById('nama_barang').value='';
               //document.getElementById('qty').value='1';
               //document.getElementById('hj').value='0';
               //document.getElementById('dpp').value='0';
               //document.getElementById('nilaippn').value='0';
               //document.getElementById('diskon').value='0';
               //document.getElementById('perc_diskon').value='0';
               //document.getElementById('itemppn').value='';
               document.getElementById('satuan').value='';
               //document.getElementById('total').value='0';
               document.getElementById('filterbarang').focus();
             }
             </script>
             <script type="text/javascript">
                  var j_x_1 = $.noConflict(true);
                  j_x_1(document).ready(
                  function ()
                  {
                       setTimeout(function(){
                       j_x_1("#add_btn_item").click(
                       function (){
                       //recounter();
                       }
                       );

                       }, 200);
                 }
                 );
                  function jum_akhir(){
                       var inputs = document.querySelectorAll('input[name="rowsBM[]"]');
                       var max = 0;
                       //var tmax = 0;
                       for (var i = 0; i < inputs.length; ++i) {
                            max = Math.max(max , parseFloat(inputs[i].value));
                       }
                       //alert(max+1);
                       //document.getElementById('key_max').value = parseFloat(max+1);
                       //document.getElementById('key_max').value = max+1;

                       }


             </script>

             <div class="col-md-4">
               <!-- Widget: user widget style 1 -->
               <div class="box box-widget widget-user-2">
                 <!-- Add the bg color to the header using any of the bg-* classes -->
                 <div class="widget-user-header bg-blue">
                   <div class="widget-user-image">
                     <img class="img-circle" src="<?php echo base_url(); ?>assets/images/resep2.png" alt="User Avatar">
                   </div>
                   <!-- /.widget-user-image -->
                   <h3 class="widget-user-username">JASA</h3>
                   <h5 class="widget-user-desc">Jasa Tindakan Medis</h5>
                 </div>
                 <div class="box-footer no-padding">

                   <div class="table-responsive">
                <table class="table table-striped jambo_table bulk_action">
                  <thead>
                    <tr class="headings">
                      <th><input type="checkbox" id="check-all" class="flat"></th>
                     <th class="column-title">  </th>
                      <th class="column-title">Jasa / Pekerjaan </th>

                      <th class="bulk-actions" colspan="7">
                        <a class="antoo" style="color:#fff; font-weight:500;">Jasa / Pekerjaan ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                      </th>
                    </tr>
                  </thead>


                  <tbody>
                    <?php $count = 0; foreach ($data_jasa_in as $rowjasa)
                    { $count++;?>
                      <tr>
                        <td align="center"><input type="checkbox" name="rowJasa[]" value="<?=$count?>" class="flat" <?php echo 'checked';?>></td>
                        <td class=" "><input class="form-control col-md-4 col-xs-12" type="hidden" value="<?php echo $rowjasa->id_jasa; ?>" name="id_jasa_<?php echo $count; ?>" readonly></td>
                        <td class=" "><?php echo $rowjasa->nama; ?></td>
                        <td><input style="text-align:right; width:100%" class="form-control col-md-4 col-xs-12" type="hidden" value="<?php echo $rowjasa->nilai; ?>" name="nilai_<?php echo $count; ?>"></td>
                        <td><input style="text-align:right; width:100%" class="form-control col-md-4 col-xs-12" type="hidden" value="<?php echo $rowjasa->diskon; ?>" name="diskon_<?php echo $count; ?>"></td>
                      </tr>
                    <?php } ?>
                    <?php foreach ($data_jasa_out as $rowjasa)
                    { $count++;?>
                      <tr>
                        <td align="center"><input type="checkbox" name="rowJasa[]" value="<?=$count?>" class="flat"></td>
                        <td class=" "><input class="form-control col-md-4 col-xs-12" type="hidden" value="<?php echo $rowjasa->id_jasa; ?>" name="id_jasa_<?php echo $count; ?>" readonly></td>
                        <td class=" "><?php echo $rowjasa->nama; ?></td>
                        <td><input style="text-align:right; width:100%" class="form-control col-md-4 col-xs-12" type="hidden" value="<?php echo $rowjasa->nilai; ?>" name="nilai_<?php echo $count; ?>"></td>
                        <td><input style="text-align:right; width:100%" class="form-control col-md-4 col-xs-12" type="hidden" value="<?php echo $rowjasa->diskon; ?>" name="diskon_<?php echo $count; ?>"></td>
                      </tr>
                    <?php } ?>
                  </tbody>

                </table>
              </div>




                 </div>


               </div>
               <!-- /.widget-user -->
             </div>
         <div class="col-md-8">
           <!-- Widget: user widget style 1 -->
           <div class="box box-widget widget-user-2">
             <!-- Add the bg color to the header using any of the bg-* classes -->
             <div class="widget-user-header bg-yellow">
               <div class="widget-user-image">
                 <img class="img-circle" src="<?php echo base_url(); ?>assets/images/resep2.png" alt="User Avatar">
               </div>
               <!-- /.widget-user-image -->
               <h3 class="widget-user-username">RESEP</h3>
               <h5 class="widget-user-desc">Obat-obat yang tersedia</h5>
             </div>
             <div class="box-footer no-padding">
               <div class="input-group">
                 <div class="input-group-btn">
                   <button type="button" class="btn btn-danger btn-flat"> <i class="fa fa-search"></i></button>
                 </div>
                  <input onclick="LPS()" style="background:#FFF;" class="partsearch form-control" name="filterbarang" type="text" id="filterbarang" placeholder="Pencarian Obat"/>


                 <!-- /btn-group -->
               </div>


                   <input name="id_barang" type="hidden" id="id_barang_edit" class="form-control"  placeholder="Kode Barang">
                   <input name="nama_barang" type="hidden" id="nama_barang_edit" class="form-control"  placeholder="Nama Barang" readonly>
                   <input name="satuan" type="hidden" id="satuan_edit" class="form-control"  placeholder="Satuan Barang" readonly>


                 <div class="box-body">
                   <div class="row" hidden>
                     <div class="col-xs-3">
                       <input type="text" class="form-control" placeholder=".col-xs-3">
                     </div>
                     <div class="col-xs-4">
                       <input type="text" class="form-control" placeholder=".col-xs-4">
                     </div>
                     <div class="col-xs-5">
                       <input type="text" class="form-control" placeholder=".col-xs-5">
                     </div>
                   </div>
                   <input hidden="" id="site_url_x" value="<?php echo base_url();?>">
                   <script type="text/javascript" src='<?php echo base_url();?>assets/js/jquery-1.3.2.js'></script>
                   <script type="text/javascript" src='<?php echo base_url();?>assets/js/jquery-1.4.2.min.js'></script>
                   <script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery-1.8.2.min.js'></script>
                   <script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.calculation.js'></script>
                   <script type="text/javascript" src='<?php echo base_url();?>assets/js/append_resep.js'></script>
                   <div class="input-group">
                     <div class="input-group-addon">
                       <i class="fa fa-shopping-cart"></i>
                     </div>
                   <input type="button" class="btn btn-block btn-info btn-flat" name="add_btn_item" value="Tambahkan Ke Resep" id="add_btn_item" onblur="hitung_pilih_item();" onmouseover="hitung_pilih_item();"  />
                   </div>
                 </div>
                 <div class="box-body table-responsive no-padding">
                   <table class="table table-hover">
                     <thead>
                     <tr>
                       <th width="5%">No</th>
                       <th width="40%">Nama Obat</th>
                       <th width="10%">Qty</th>
                       <th width="15%">Satuan</th>
                       <th width="25%">Keterangan</th>
                       <th width="5%">Action</th>
                     </tr>
                   </thead>
                     <tbody id="containeritem" style="height: 100px; overflow: auto;">


                    </tbody>


                   </table>
                   <input style="text-align:center" type="text" class="form-control" id="key_max" value="<?php //echo ($count) ?>" style="background-color:#eea236; color:black;" />
                 </div>





             </div>
             <h5>Keterangan Resep</h5>
             <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
               <textarea id="editor5" name="keterangan_resep" rows="5" cols="80" placeholder="Keterangan Resep">

               </textarea>
             </div>
             <div class="box-footer">

               <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Update Data</button>
             </div>
           </div>

           <!-- /.widget-user -->
         </div>

         <!-- /.col -->
       </div>
       <?php
     }
      ?>



   </form>




   </section>
   <!-- /.content -->
 </div>

<?php include 'includefile/foot.php'; ?>
