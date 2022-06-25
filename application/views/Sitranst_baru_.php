<?php include 'includefile/head.php'; ?>

<?php $action_form = 'Sitranst/tambah'; ?>


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
                serviceUrl: site+'/autocomplete/item_jual',
                // fungsi ini akan dijalankan ketika user memilih salah satu hasil request
                onSelect: function (suggestion) {
                  jq_auto('#id_barang').val(''+suggestion.id_barang);
                  jq_auto('#nama_barang').val(''+suggestion.nama_barang);
                  jq_auto('#dpp').val(''+suggestion.dpp);
                  jq_auto('#hj').val(''+suggestion.hj);
                  jq_auto('#nilaippn').val(''+suggestion.nilaippn);
                  jq_auto('#itemppn').val(''+suggestion.ppn);
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
      document.getElementById('qty').value='1';
      document.getElementById('hj').value='0';
      document.getElementById('dpp').value='0';
      document.getElementById('nilaippn').value='0';
      document.getElementById('diskon').value='0';
      document.getElementById('perc_diskon').value='0';
      document.getElementById('itemppn').value='';
      document.getElementById('satuan').value='';
      document.getElementById('total').value='0';
      document.getElementById('filterbarang').focus();
    }
    </script>



    <script type="text/javascript">

        function LPSnpa() {
          document.getElementById('filteranggota').value='';
          document.getElementById('nama').value='';
          document.getElementById('npa').value='';
          document.getElementById('nik').value='';
          document.getElementById('nama_sub_unit').value='';
          document.getElementById('nama_unit').value='';
          document.getElementById('filteranggota').focus();
        }
        </script>
    <script>
        function hitung_pilih_item() {
          var hj = parseFloat(document.getElementById("hj").value);
          var dpp = parseFloat(document.getElementById("dpp").value);
          var qty = parseFloat(document.getElementById("qty").value);
          var diskon = parseFloat(document.getElementById("diskon").value);
          var nilaippn = parseFloat(document.getElementById("nilaippn").value);

          perc_diskon=(diskon/dpp*100).toFixed(2);

          document.getElementById('perc_diskon').value = perc_diskon;

          var e = document.getElementById("itemppn").value;
          //alert(e);
          if (e == "NON PPN") {
              dpp=(hj-diskon).toFixed(2);
              nilaippn=(0).toFixed(2);
              total=((hj-diskon)*qty).toFixed(2);


          }
          else {
              dpp=((hj-diskon)/1.1).toFixed(2);
              nilaippn=(10/100*dpp).toFixed(2);
              total=((hj-diskon)*qty).toFixed(2);


          }

          document.getElementById('dpp').value = dpp;
          document.getElementById('nilaippn').value = nilaippn;
          document.getElementById('total').value = total;

        }

   </script>
   <script> language=javascript type=text/javascript>

   function stopRKey(evt) {
     var evt = (evt) ? evt : ((event) ? event : null);
     var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
     if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
   }

   document.onkeypress = stopRKey;

   </script>


<form class="form-horizontal" name="form1" method="post" action="<?=site_url($action_form)?>"  enctype="multipart/form-data" >
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

   <section class="content">

     <div class="box box-default">
       <div class="box-header with-border">
         <h3 class="box-title"><i class="fa fa-refresh"></i><?php  include 'includefile/Pesan.php'; ?></h3>

         <div class="box-tools pull-right">
           <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

         </div>
       </div>

       <!-- /.box-header -->
       <div class="box-body">
         <div class="row invoice-info">
           <div class="col-sm-3 invoice-col">
             <div class="form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12">No <span class="required">*</span>
               </label>
               <div class="input-group">
                 <div class="input-group-addon">
                   <i class="fa fa-key"></i>
                 </div>

                 <input class="form-control col-md-4 col-xs-12" value="" placeholder="AUTO" readonly type="text" name="no_bukti" >
               </div>
             </div>


             <div class="form-group">
               <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal</label>

               <div class="input-group">
                 <div class="input-group-addon">
                   <i class="fa fa-calendar"></i>
                 </div>
                 <input id="middle-name" class="date-picker form-control col-md-3 col-xs-12" value="<?php echo date('Y-m-d'); ?>" type="date" name="tgl_trans" required>
               </div>
             </div>

             <div class="form-group">
               <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Ppn</label>

                 <div class="input-group">
                 <div class="input-group-addon">
                   <i class="fa fa-ticket"></i>
                 </div>

                 <select class="select2 form-control" id="jenis_ppn" name="jenis_ppn" disabled>
                   <option value="INCLUDE">INCLUDE</option>
                   <option value="EXCLUDE">EXCLUDE</option>
                   <option value="NON">NON</option>

                 </select>
                </div>

             </div>




          </div>
            <div class="col-sm-3 invoice-col">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Bayar</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-cc-paypal"></i>
                  </div>
                  <select class="select2 form-control" id="jenis_bayar" name="jenis_bayar" >

                          <option value="TUNAI">TUNAI</option>
                          <option value="KREDIT">KREDIT</option>
                  </select>
              </div>

             </div>
             <div class="form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Jenis
               </label>
               <div class="input-group">
                 <div class="input-group-addon">
                   <i class="fa fa-spinner"></i>
                 </div>
                 <select class="select2 form-control" id="jenis_barang" name="jenis_barang" disabled >
                         <option value="">--pilih--</option>
                         <option value="TUNAI">POKOK</option>
                         <option value="KREDIT">SEKUNDER</option>
                 </select>
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Cicilan
               </label>
               <div class="input-group">
                 <div class="input-group-addon">
                   <i class="fa fa-calculator"></i>
                 </div>
                 <input id="jml_cicilan" class="form-control col-md-3 col-xs-12" value="1" type="number" name="jml_cicilan" disabled>
               </div>
             </div>


           </div>

            <div class="col-sm-3 invoice-col">
             <div class="form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Anggota<span class="required"></span>
               </label>
               <div class="input-group">
                 <div class="input-group-addon">
                   <i class="fa fa-user"></i>
                 </div>
                 <input onclick="LPSnpa()" style="background:#f6ff00;" class="anggotasearch form-control col-md-12 col-xs-12" name="filteranggota" type="text" id="filteranggota" placeholder="Pencarian Anggota"/>
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Nama
               </label>
               <div class="input-group">
                 <div class="input-group-addon">
                   <i class="fa fa-info"></i>
                 </div>
                 <input id="nama" class="form-control col-md-6 col-xs-12" value="" type="text" name="nama" readonly>

               </div>

             </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">NPA </label>
                 <div class="input-group">
                   <div class="input-group-addon">
                     <i class="fa fa-info"></i>
                   </div>
                   <input id="npa" class="form-control col-md-3 col-xs-12" value="" type="text" name="npa" readonly>

                 </div>

                            </div>





           </div>

            <div class="col-sm-2 invoice-col">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">NIK
                </label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-info"></i>
                  </div>
                  <input id="nik" class="form-control col-md-3 col-xs-12" value="" type="text" name="nik" readonly>

                </div>

              </div>
             <div class="form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Unit
               </label>
               <div class="input-group">
                 <div class="input-group-addon">
                   <i class="fa fa-info"></i>
                 </div>
                 <input id="nama_unit" class="form-control col-md-6 col-xs-12" value="" type="text" name="nama_unit" readonly>

               </div>

             </div>

             <div class="form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Sub
               </label>
               <div class="input-group">
                 <div class="input-group-addon">
                   <i class="fa fa-info"></i>
                 </div>
                 <input id="nama_sub_unit" class="form-control col-md-6 col-xs-12" value="" type="text" name="nama_sub_unit" readonly>
                 <input id="kd_sub_unit" class="form-control col-md-6 col-xs-12" value="" type="hidden" name="kd_sub_unit" readonly>
               </div>

             </div>

           </div>





           <!-- /.col -->

           <!-- /.col -->
         </div>
         <!-- /.row -->
       </div>
       <!-- /.box-body -->
       <div class="box-footer">
         Pilih Pembayaran, Jenis dan Anggota di bagian ini.....!!!
         <a href="<?php echo site_url('Sitranst/cetak/'.$this->session->flashdata('no_penjuaan')); ?>" target="_blank" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Cetak Transaksi Terakhir <?php echo $this->session->flashdata('no_penjuaan') ?></a>
       </div>
     </div>



     <div class="box box-default">
       <div class="box-header with-border">
         <h3 class="box-title"><i class="fa fa-cubes"></i> Item</h3>

         <div class="box-tools pull-right">
           <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

         </div>
       </div>
       <!-- /.box-header -->




       <div class="box-body">
          <div class="row invoice-info">

            <div class="col-sm-5 invoice-col">

             <div class="form-group">
               <label class="control-label col-md-2 col-sm-3 col-xs-12" for="last-name">Filter</label>
               <div class="input-group">
                 <div class="input-group-addon">
                   <i class="fa fa-search"></i>
                 </div>
               <input onclick="LPS()" style="background:#ffa3a3;" class="partsearch form-control col-md-12 col-xs-12" name="filterbarang" type="text" id="filterbarang" placeholder="Pencarian Barang"/>
             </div>
             </div>


             <div class="form-group">
               <label class="control-label col-md-2 col-sm-3 col-xs-12" for="last-name">Nama</label>
               <div class="input-group">
                 <div class="input-group-addon">
                   <i class="fa fa-info"></i>
                 </div>
               <input name="id_barang" type="hidden" id="id_barang" class="form-control col-md-7 col-xs-12 input-lg"  placeholder="Kode Barang">
               <input name="nama_barang" type="text" id="nama_barang" class="form-control col-md-7 col-xs-12"  placeholder="Nama Barang" readonly>
             </div>
             </div>

           </div>

          <div class="col-sm-1 invoice-col">
             <div class="form-group">


               <div class="input-group">
               <input name="itemppn" type="text" id="itemppn" class="form-control col-md-2 col-xs-12" style="text-align:center;"  placeholder="Ppn" readonly />
               </div>
             </div>

             <div class="form-group">

               <div class="input-group">
                    <input name="satuan" type="text" id="satuan" class="form-control col-md-2 col-xs-12" style="text-align:center;" placeholder="Satuan" readonly />
               </div>
             </div>

           </div>

          <div class="col-sm-1 invoice-col">
             <div class="form-group">

               <div class="input-group">
                 <span class="input-group-addon">Qty</span>
                    <input name="qty" type="number" id="qty" class="form-control col-md-4 col-xs-12" style="text-align:right;" value="1" placeholder="Qty" onchange="hitung_pilih_item();" onblur="hitung_pilih_item();" />
              </div>
             </div>



             <div class="form-group">

               <div class="input-group">
                 <span class="input-group-addon">Hrg</span>
                    <input name="hj" type="text" id="hj" class="form-control col-md-4 col-xs-12" style="text-align:right;" placeholder="Harga Jual" onchange="hitung_pilih_item();" onblur="hitung_pilih_item();" />
              </div>

             </div>

           </div>

           <div class="col-sm-1 invoice-col">
             <div class="form-group">

                <div class="input-group">
                  <span class="input-group-addon">Dpp</span>
                  <input name="dpp" type="number" id="dpp" class="form-control col-md-4 col-xs-12" value="0" style="text-align:right;" placeholder="Dpp" step="Any" readonly />

                </div>
             </div>


             <div class="form-group">

              <div class="input-group">
                <span class="input-group-addon">Ppn</span>
                <input name="nilaippn" value="0" type="number" id="nilaippn" class="form-control col-md-4 col-xs-12" style="text-align:right;" step="Any" placeholder="Nilai Ppn" readonly />

              </div>
             </div>


           </div>
           <div class="col-sm-1 invoice-col">
             <div class="form-group">

               <div class="input-group">
                 <span class="input-group-addon">Pcn</span>
               <input name="perc_diskon" type="number" id="perc_diskon" class="form-control col-md-7 col-xs-12" value="0" style="text-align:right;"  placeholder="% Diskon" step="Any" readonly />
             </div>
             </div>
             <div class="form-group">

               <div class="input-group">
                 <span class="input-group-addon">Dis</span>
                <input name="diskon" type="number" value="0" id="diskon" class="form-control col-md-7 col-xs-12" style="text-align:right;" placeholder="Diskon" onchange="hitung_pilih_item();" onblur="hitung_pilih_item();"  />
             </div>
             </div>
           </div>

          <div class="col-sm-2 invoice-col">

             <div class="form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Total</label>
               <div class="input-group">
                 <span class="input-group-addon">Rp</span>
                 <input name="total" type="number" id="total" class="form-control col-md-7 col-xs-12" value="0" style="text-align:right;" placeholder="Total" step="Any" readonly />

               </div>


             </div>

             <div class="form-group">
               <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Action</label>
               <input hidden="" id="site_url_x" value="<?php echo base_url();?>">
               <script type="text/javascript" src='<?php echo base_url();?>assets/js/jquery-1.3.2.js'></script>
               <script type="text/javascript" src='<?php echo base_url();?>assets/js/jquery-1.4.2.min.js'></script>
               <script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery-1.8.2.min.js'></script>
               <script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.calculation.js'></script>
               <script type="text/javascript" src='<?php echo base_url();?>assets/js/append_part_hj.js'></script>

               <script type="text/javascript">
               function recounter()
               {
                 var xx = document.getElementById("key_max").value;
                 var lblElement=0;
                 var lbldpp=0;
                 var lblppn=0;
                 var lbldiskon=0;
                 var xqty=0;
                 for (ix = 1; ix <= xx; ix++) {
                          lblElement =lblElement+parseFloat(document.getElementById("total_"+ix).value);
                          lbldpp =lbldpp+(parseFloat(document.getElementById("dpp_"+ix).value)*parseFloat(document.getElementById("qty_"+ix).value));
                          lblppn =lblppn+(parseFloat(document.getElementById("nilaippn_"+ix).value)*parseFloat(document.getElementById("qty_"+ix).value));
                          lbldiskon =lbldiskon+(parseFloat(document.getElementById("diskon_"+ix).value)*parseFloat(document.getElementById("qty_"+ix).value));
                          xqty =xqty+parseFloat(document.getElementById("qty_"+ix).value);
                          document.getElementById("total_"+ix).value = (document.getElementById("hj_"+ix).value-document.getElementById("diskon_"+ix).value) * document.getElementById("qty_"+ix).value;
                 }
                 document.getElementById("SUM3").value =lblElement.toFixed(2);
                 document.getElementById("grandtotal").value =lblElement.toFixed(2);
                 document.getElementById("totdpp").value =lbldpp.toFixed(2);
                 document.getElementById("totppn").value =lblppn.toFixed(2);
                 document.getElementById("totdiskon").value =lbldiskon.toFixed(2);
                 document.getElementById("xqty").value =xqty;

               }

               </script>


               <script type="text/javascript">

               var j_x_1 = $.noConflict(true);
               j_x_1(document).ready(
               function (){
               setTimeout(function(){
               j_x_1("#add_btn_item").click(
               function (){

               var sumQty = j_x_1(".nilaiQty").sum();
               var sumTotal = j_x_1(".nilaiTotal").sum();
               j_x_1("#totalQTY").text(sumQty.toString());
               j_x_1("#totalTot").text(sumTotal.toString());
               document.getElementById('SUM1').value = sumQty;
               document.getElementById('SUM3').value = sumTotal;
               document.getElementById('subtotal').value = sumTotal;
               document.getElementById('dpp').value = sumTotal;
               //jum_akhir();
               recounter();
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
               <div class="input-group">
                 <div class="input-group-addon">
                   <i class="fa fa-shopping-cart"></i>
                 </div>
               <input type="button" class="btn btn-block btn-success btn-flat" name="add_btn_item" value="Tambah ke Keranjang" id="add_btn_item" onblur="hitung_pilih_item();" onmouseover="hitung_pilih_item();"  />
               </div>
             </div>

           </div>
           <!-- /.col -->

           <!-- /.col -->
         </div>
         <!-- /.row -->
       </div>
       <!-- /.box-body -->
       <div class="box-footer">
         Pilih daftar barang yang akan dipesan di bagian ini.....!!!
       </div>
     </div>


      <!-- /.row -->

     <div class="row">
       <!-- left column -->
       <div class="col-md-12">
         <div class="box box-info">
             <div class="box-header with-border">
               <h3 class="box-title"><i class="fa fa-cubes"></i> Detail Barang</h3>
             </div>
     <!-- /.box-header -->
     <!-- form start -->


                 <div class="box-body">
                   <!-- /.isi table -->

                   <div class="col-xs-12 table-responsive">
                     <table class="table table-striped nowrap" >
     										<thead>

     										<tr height="30px" style="background: #337ab7; color:white;" class="td_only">
     											<th style="width:5%; text-align:center;">No</th>
                          <th style="width:10%; text-align:center;">Kd Barang</th>
                          <th style="width:20%; text-align:center;">Nama Barang</th>
      										<th style="width:5%; text-align:center;">Qty</th>
                          <th style="width:8%; text-align:center;">Harga</th>
                          <th style="width:7%; text-align:center;">Dpp</th>
                          <th style="width:8%; text-align:center;">Ppn</th>
                          <th style="width:8%; text-align:center;">Diskon</th>
                          <th style="width:7%; text-align:center;">%Diskon</th>
                          <th style="width:5%; text-align:center;">Satuan</th>
                          <th style="width:17%; text-align:center;">Total</th>
     											<th style="width:5%; text-align:center;">Action</th>
     										</tr>
     										</thead>

                         <tbody id="containeritem" style="height: 100px; overflow: auto;">


     										</tbody>
                        <tfoot>
                          <tr>
                            <th style="width:5%; text-align:center;"><input type="hidden" class="form-control" id="key_max" value="<?php //echo ($count) ?>" style="text-align:center; background-color:#eea236; color:black;" hidden/></th>
                            <th style="width:10%; text-align:center;"></th>
                            <th style="width:20%; text-align:center;"></th>
        										<th style="width:5%; text-align:center;"><input style="text-align:center" class="form-control" type="hidden" id="xqty" name="SUM1"  readonly/></th>
                            <th style="width:8%; text-align:center;"></th>
                            <th style="width:10%; text-align:center;"> </th>
                            <th style="width:7%; text-align:center;"> </th>
                            <th style="width:8%; text-align:center;"> </th>
                            <th style="width:7%; text-align:center;"></th>
                            <th style="width:5%; text-align:center;"></th>
                            <th style="width:17%; text-align:center;"><input style="text-align:right" class="form-control" type="hidden" id="xSUM3" value="<?php //echo $totalbeli; ?>" name="SUM3" readonly /> </td></th>
       											<th style="width:5%; text-align:center;"></th>
                          </tr>
                        </tfoot>
     										</table>

                 </div>
                 <!-- /.box-body -->

                 <!-- /.box-footer -->
                 </div>
             </div>

       </div>

       <div class="col-md-12">
         <div class="box box-danger">
             <div class="box-header with-border">
               <h3 class="box-title"><i class="fa fa-cubes"></i> Total</h3>
             </div>
     <!-- /.box-header -->
     <!-- form start -->

                 <div class="box-body">
                   <div class="row invoice-info">

                     <div class="col-sm-4 invoice-col">
                       <div class="form-group">
                         <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Sub Total</label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                           <input style="text-align:right" id="SUM3" class="form-control col-md-6 col-xs-12" value="0" type="number" name="subtotal" readonly>
                         </div>
                       </div>

                        <div class="form-group">
                         <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Dpp</label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                           <input style="text-align:right" id="totdpp" class="form-control col-md-6 col-xs-12" value="0" type="number" name="dpp" readonly>
                           <input style="text-align:right" value="PEMBELIAN" type="text" name="j_dpp" readonly hidden="">
                         </div>
                       </div>


                       <div class="form-group">
                         <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Ppn</label>
                         <div class="col-md-6 col-sm-4 col-xs-12">
                           <input style="text-align:right" id="totppn" class="form-control col-md-6 col-xs-12" value="0" type="number" name="ppn" readonly>
                           <input  value="PPN" type="text" name="j_ppn" readonly hidden="">
                         </div>
                       </div>


                       <script>
                           function hitung_grandtotal() {
                             //alert("AAAA");
                             var xvoucher = parseFloat(document.getElementById("totvoucher").value);
                             var alltotal = parseFloat(document.getElementById("SUM3").value);

                             g_total=alltotal-xvoucher;

                             document.getElementById('grandtotal').value =localeFormat(g_total);

                           };


                      </script>


                       <div class="form-group">
                         <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Voucher</label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                           <input style="text-align:right" id="totvoucher" class="form-control col-md-6 col-xs-12" value="0" type="number" name="voucher" onchange="hitung_grandtotal();" onblur="hitung_grandtotal();">
                           <input value="PPN" type="text" name="j_ppn" readonly hidden="">
                         </div>
                       </div>

                       <div class="form-group">
                         <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Total Bayar</label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                           <input id="grandtotal" class="form-control col-md-6 col-xs-12" style="text-align:right;" value="0" type="number" step="Any" name="grandtotal" readonly>
                           <input name="j_hutang" type="text" id="j_hutang" value="HUTANG" readonly hidden="">
                         </div>
                       </div>

                       <div class="form-group">
                         <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Diskon</label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                           <input style="text-align:right" id="totdiskon" class="form-control col-md-6 col-xs-12" value="0" type="number" name="diskon" placeholder="Diskon">
                         </div>
                       </div>

                       </div>

                       

                       </div>
                     </div>
                     <!-- /.col -->
                   </div>


                   <div class="box-footer">


                     <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</button>
                   </div>

                 </div>


             </div>

       </div>




     <!-- /.row -->
   </section>



   <!-- /.content -->
 </div>
</form>

 <?php include 'includefile/foot.php'; ?>
