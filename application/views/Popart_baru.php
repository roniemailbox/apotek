<?php include 'includefile/head.php'; ?>

<?php $action_form = 'Popart/tambah'; ?>


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
                serviceUrl: site+'/autocomplete/item_po',
                // fungsi ini akan dijalankan ketika user memilih salah satu hasil request
                onSelect: function (suggestion) {
                  jq_auto('#id_barang').val(''+suggestion.id_barang);
                  jq_auto('#nama_barang').val(''+suggestion.nama_barang);
                  jq_auto('#dpp').val(''+suggestion.dpp);
                  jq_auto('#hb').val(''+suggestion.hb);
                  jq_auto('#nilaippn').val(''+suggestion.nilaippn);
                  jq_auto('#itemppn').val(''+suggestion.ppn);
                  jq_auto('#satuan').val(''+suggestion.satuan);

                  document.getElementById("qty").focus();
                }
              });
            });
</script>
<script type="text/javascript">

    function LPS() {
      document.getElementById('filterbarang').value='';
      document.getElementById('id_barang').value='';
      document.getElementById('nama_barang').value='';
      document.getElementById('qty').value='';
      document.getElementById('hb').value='0';
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




    <script>
        function hitung_pilih_item() {
          var hb = parseFloat(document.getElementById("hb").value);
          var dpp = parseFloat(document.getElementById("dpp").value);
          var qty = parseFloat(document.getElementById("qty").value);
          var diskon = parseFloat(document.getElementById("diskon").value);
          var nilaippn = parseFloat(document.getElementById("nilaippn").value);

          perc_diskon=(diskon/dpp*100).toFixed(2);

          document.getElementById('perc_diskon').value = perc_diskon;

          var e = document.getElementById("itemppn").value;
          //alert(e);
          if (e == "NON PPN") {
              dpp=(hb-diskon).toFixed(2);
              nilaippn=(0).toFixed(2);
              total=((hb-diskon)*qty).toFixed(2);


          }
          else {
              dpp=((hb-diskon)/1.1).toFixed(2);
              nilaippn=(hb-dpp).toFixed(2);
              total=((hb-diskon)*qty).toFixed(2);


          }

          document.getElementById('dpp').value = dpp;
          document.getElementById('nilaippn').value = nilaippn;
          document.getElementById('total').value = total;

        }

   </script>

   <!--
      <script type="text/javascript">
          $(document).ready(function() {

                  $("#diskon").change(function(){
                  var hb = parseFloat(document.getElementById("hb").value);
                  var dpp = parseFloat(document.getElementById("dpp").value);
                  var qty = parseFloat(document.getElementById("qty").value);
                  var diskon = parseFloat(document.getElementById("diskon").value);
                  var nilaippn = parseFloat(document.getElementById("nilaippn").value);
                  perc_diskon=diskon/dpp*100;
                  document.getElementById('perc_diskon').value = perc_diskon;
                  var e = document.getElementById("itemppn").value;
                  //alert(e);
                  if (e == "NON PPN") {
                      total=(hb-diskon)*qty;
                      document.getElementById('total').value = total;
                  }
                  else {
                    total=(hb-diskon)*qty;
                    document.getElementById('total').value = total;
                  }
                  //myFunctionZ();
                  });

                  $("#qty").change(function(){
                  var hb = parseFloat(document.getElementById("hb").value);
                  var dpp = parseFloat(document.getElementById("dpp").value);
                  var qty = parseFloat(document.getElementById("qty").value);
                  var diskon = parseFloat(document.getElementById("diskon").value);
                  var nilaippn = parseFloat(document.getElementById("nilaippn").value);
                  perc_diskon=diskon/dpp*100;
                  document.getElementById('perc_diskon').value = perc_diskon;
                  var e = document.getElementById("itemppn").value;
                  //alert(e);
                  if (e == "NON PPN") {
                      total=(hb-diskon)*qty;
                      document.getElementById('total').value = total;
                  }
                  else {
                    total=(hb-diskon)*qty;
                    document.getElementById('total').value = total;
                  }
                  //myFunctionZ();
                  });
          })
      </script>
-->
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
         <h3 class="box-title">Filter Barang</h3>

         <div class="box-tools pull-right">
           <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

         </div>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
         <div class="row">



           <div class="col-md-5">
             <div class="form-group">
               <label>Filter Barang</label>
               <input onclick="LPS()" style="background:#AEC791;" class="partsearch form-control col-md-12 col-xs-12" name="filterbarang" type="text" id="filterbarang" placeholder="Pencarian Barang"/>
             </div>



             <div class="form-group">
               <label>Nama Barang</label>
               <input name="id_barang" type="hidden" id="id_barang" class="form-control col-md-7 col-xs-12 input-lg"  placeholder="Kode Barang">
               <input name="nama_barang" type="text" id="nama_barang" class="form-control col-md-7 col-xs-12"  placeholder="Nama Barang" readonly>
             </div>


           </div>

           <div class="col-md-1">
             <div class="form-group">
               <label>Type Ppn</label>
               <input name="itemppn" type="text" id="itemppn" class="form-control col-md-7 col-xs-12" style="text-align:center;"  placeholder="Ppn" readonly />
             </div>

             <div class="form-group">
               <label>Satuan</label>
                    <input name="satuan" type="text" id="satuan" class="form-control col-md-7 col-xs-12" style="text-align:center;" placeholder="Satuan" readonly />
             </div>

           </div>

           <div class="col-md-1">
             <div class="form-group">
               <label>Jumlah Pesan</label>
                    <input name="qty" type="number" id="qty" class="form-control col-md-7 col-xs-12" style="text-align:right;" placeholder="Qty" onchange="hitung_pilih_item();" onblur="hitung_pilih_item();" />

             </div>



             <div class="form-group">
               <label>Harga Beli</label>
                    <input name="hb" type="text" id="hb" class="form-control col-md-7 col-xs-12" style="text-align:right;" placeholder="Harga Beli" onchange="hitung_pilih_item();" onblur="hitung_pilih_item();" />


             </div>

           </div>

           <div class="col-md-2">
            <label>Dpp</label>
             <div class="input-group">
               <span class="input-group-addon">Rp</span>
               <input name="hb" type="number" id="dpp" class="form-control col-md-7 col-xs-12" value="0" style="text-align:right;" placeholder="Harga Beli" step="Any" readonly />

             </div>

             <label>Ppn</label>
              <div class="input-group">
                <span class="input-group-addon">Rp</span>
                <input name="nilaippn" value="0" type="number" id="nilaippn" class="form-control col-md-7 col-xs-12" style="text-align:right;" step="Any" placeholder="Nilai Ppn" readonly />

              </div>



           </div>
           <div class="col-md-1">
             <div class="form-group">
               <label>%Diskon</label>
               <input name="perc_diskon" type="number" id="perc_diskon" class="form-control col-md-7 col-xs-12" value="0" style="text-align:right;"  placeholder="% Diskon" step="Any" readonly />
             </div>

             <div class="form-group">
               <label>Diskon</label>
                <input name="diskon" type="number" value="0" id="diskon" class="form-control col-md-7 col-xs-12" style="text-align:right;" placeholder="Diskon" onchange="hitung_pilih_item();" onblur="hitung_pilih_item();"  />
             </div>

           </div>

           <div class="col-md-2">

             <div class="form-group">
               <label>Total</label>
               <div class="input-group">
                 <span class="input-group-addon">Rp</span>
                 <input name="total" type="number" id="total" class="form-control col-md-7 col-xs-12" value="0" style="text-align:right;" placeholder="Total" step="Any" readonly />

               </div>


             </div>

             <div class="form-group">
               <label>Action</label>
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
                 var xqty=0;
                 for (ix = 1; ix <= xx; ix++) {
                          lblElement =lblElement+parseFloat(document.getElementById("total_"+ix).value);
                          xqty =xqty+parseFloat(document.getElementById("qty_"+ix).value);
                          document.getElementById("total_"+ix).value = (document.getElementById("hb_"+ix).value-document.getElementById("diskon_"+ix).value) * document.getElementById("qty_"+ix).value;
                 }
                 document.getElementById("SUM3").value =lblElement.toFixed(2);
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
               <input type="button" class="btn btn-block btn-success btn-flat" name="add_btn_item" value="Tambah ke Keranjang" id="add_btn_item" onblur="hitung_pilih_item" onmouseover="hitung_pilih_item"  />

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
<form class="form-horizontal" method="post" action="<?=site_url($action_form)?>"  enctype="multipart/form-data" >
     <div class="row">
       <!-- left column -->
       <div class="col-md-12">
         <div class="box box-info">
             <div class="box-header with-border">
               <h3 class="box-title">Detail Barang</h3>
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
                            <th style="width:5%; text-align:center;"><input type="hiddenz" class="form-control" id="key_max" value="<?php //echo ($count) ?>" style="background-color:#eea236; color:black;" hidden/></th>
                            <th style="width:10%; text-align:center;"></th>
                            <th style="width:20%; text-align:center;"></th>
        										<th style="width:5%; text-align:center;"><input class="form-control" type="hiddena" id="xqty" name="SUM1"  readonly/></th>
                            <th style="width:8%; text-align:center;"></th>
                            <th style="width:10%; text-align:center;"> </th>
                            <th style="width:7%; text-align:center;"> </th>
                            <th style="width:8%; text-align:center;"> </th>
                            <th style="width:7%; text-align:center;"></th>
                            <th style="width:5%; text-align:center;"></th>
                            <th style="width:17%; text-align:center;"><input class="form-control" type="hiddenz" id="SUM3" value="<?php //echo $totalbeli; ?>" name="SUM3" readonly /> </td></th>
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
         <div class="box box-info">
             <div class="box-header with-border">
               <h3 class="box-title">Informasi Lanjutan</h3>
             </div>
     <!-- /.box-header -->
     <!-- form start -->

                 <div class="box-body">
                   <div class="row invoice-info">
                     <div class="col-sm-4 invoice-col">
                       <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">No PO <span class="required">*</span>
                         </label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                           <input class="form-control col-md-4 col-xs-12" value="" placeholder="AUTO" readonly type="text" name="no_bukti" >
                         </div>
                       </div>


                       <div class="form-group">
                         <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal PO</label>

                          <div class="col-md-6 col-sm-6 col-xs-12">
                           <input id="middle-name" class="date-picker form-control col-md-3 col-xs-12" value="<?php //echo $row->tgl_trans; ?>" type="date" name="tgl_trans" required>
                         </div>
                       </div>

                <div class="form-group">
                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan</label>
                  <div class="col-md-8 col-sm-6 col-xs-12">

                    <textarea id="message" class="form-control" name="keterangan" ><?php //echo $row->keterangan; ?></textarea>
                  </div>
                </div>
                     </div>
                     <!-- /.col -->
                     <div class="col-sm-4 invoice-col">
                       <script type="text/javascript">
                           $(document).ready(function() {

                               $("#npa").change(function(){
                                  var npa = $("#npa").val();
                                  alert(npa);

                                   $.ajax({
                                       type: "POST",
                                       url: "<?php echo base_url('index.php/Popart/get_data'); ?>",
                                       data: "npa="+npa,
                                       cache:false,
                                       success: function(data){
                                         $('#tampil').html(data);
                                       }

                                   });

                                 }

                              );

                           })
                       </script>
                       <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Anggota<span class="required"></span>
                         </label>
                         <div class="col-md-8 col-sm-6 col-xs-12">
                           <select class="select2 form-control" id="npa" name="npa" required>
                             <option value="">- pilih -</option>
                             <?php
                             if(isset($data_anggota))
                             {
                             foreach ($data_anggota as $row)
                             {
                             ?>
                                  <option value="<?php echo $row->npa;?>"><?php echo $row->nama; ?></option>
                                  <?php
                                  }
                                  }
                                  ?>
                           </select>

                         </div>
                       </div>

                         <div id="tampil"></div>


                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Pembayaran
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                          <select class="select2 form-control" id="jenis_bayar" name="jenis_bayar" >
                                                  <option value="">--pilih--</option>
                                                  <option value="TUNAI">TUNAI</option>
                                                  <option value="KREDIT">KREDIT</option>
                                          </select>
                                        </div>
                                      </div>




                     <script type="text/javascript">
                         $(document).ready(function() {

                             $("#jenis_ppn").change(function(){

                              jumlahx();

                               });
                         })
                     </script>
                     <div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Ppn<span class="required"></span>
                       </label>
                       <div class="col-md-3 col-sm-6 col-xs-12">
                         <select class="select2 form-control" id="jenis_ppn" name="jenis_ppn">
                           <option value="">--pilih--</option>
                           <option value="NON">NON</option>
                           <option value="EXCLUDE">EXCLUDE</option>
                         </select>
                       </div>
                     </div>
                     </div>
                     <!-- /.col -->
                     <div class="col-sm-4 invoice-col">
                       <div class="form-group">
                         <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Sub Total</label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                           <input id="subtotal" class="form-control col-md-6 col-xs-12" value="0" type="number" name="subtotal" readonly>
                         </div>
                       </div>
                       <script>
                       </script>
                       <div class="form-group">
                         <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Diskon</label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                           <input id="diskon" class="form-control col-md-6 col-xs-12" value="0" type="number" name="diskon" placeholder="Rp Diskon">
                         </div>
                       </div>

                        <div class="form-group">
                         <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Dpp</label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                           <input id="dpp" class="form-control col-md-6 col-xs-12" value="0" type="number" name="dpp" readonly>
                           <input value="PEMBELIAN" type="text" name="j_dpp" readonly hidden="">
                         </div>
                       </div>
                       <div class="form-group">
                         <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Ppn</label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                           <input id="ppn" class="form-control col-md-6 col-xs-12" value="0" type="number" name="ppn" readonly>
                           <input value="PPN" type="text" name="j_ppn" readonly hidden="">
                         </div>
                       </div>

                       <div class="form-group">
                         <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Totals</label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                           <input id="xtotal" class="form-control col-md-6 col-xs-12" style="text-align:right" value="0" type="number" step="Any" name="xtotal" readonly>
                           <input name="j_hutang" type="text" id="j_hutang" value="HUTANG" readonly hidden="">
                         </div>
                       </div>
                       </div>
                     </div>
                     <!-- /.col -->
                   </div>


                   <div class="box-footer">

                     <button type="submit" class="btn btn-info pull-right">Simpan</button>
                   </div>

                 </div>


             </div>

       </div>



   </form>
     <!-- /.row -->
   </section>


     <!-- title row -->

     <!-- /.row -->

     <!-- Table row -->

     <!-- /.row -->


     <!-- /.row -->


   <!-- /.content -->
 </div>


 <?php include 'includefile/foot.php'; ?>
