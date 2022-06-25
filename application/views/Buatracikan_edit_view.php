<?php
include 'includefile/head.php';
$id = get_cookie('eklinik');
$kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
$nama_sub_unit=$this->session->userdata('nama_sub_unit'.$id);
?>

<?php $action_form = 'Buatresep/simpan_edit'; ?>


<script type="text/javascript">

    function LPS() {
      //alert("AAA");
      document.getElementById('searchbarcode').value='';
      document.getElementById('id_barang').value='';
      document.getElementById('nama_barang').value='';
      document.getElementById('qty').value='1';
      document.getElementById('hb').value='0';
      document.getElementById('dpp').value='0';
      document.getElementById('nilaippn').value='0';
      document.getElementById('diskon').value='0';
      document.getElementById('perc_diskon').value='0';
      document.getElementById('itemppn').value='';
      document.getElementById('satuan').value='';
      document.getElementById('total').value='0';
      //document.getElementById('searchbarcode').value='';
      document.getElementById('searchbarcode').focus();
    }
    </script>
    <script type="text/javascript" src='<?php echo base_url();?>assets/js/jquery-1.3.2.js'></script>
    <script type="text/javascript" src='<?php echo base_url();?>assets/js/jquery-1.4.2.min.js'></script>
    <script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery-1.8.2.min.js'></script>
    <script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.calculation.js'></script>
    <script type="text/javascript" src='<?php echo base_url();?>assets/js/append_part_pos.js'></script>
    <script type="text/javascript">

    function recounter()
    {
      var xx = document.getElementById("key_max").value;
      var j_ppn = document.getElementById("jenis_ppn").value;
      var lblElement=0;
      for (ix = 1; ix <= xx; ix++) {
               lblElement =lblElement+parseFloat(document.getElementById("total_"+ix).value);
               document.getElementById("total_"+ix).value = document.getElementById("hb_"+ix).value * document.getElementById("qty_"+ix).value;
      }
      if (j_ppn == "NON") {
          //document.getElementById('totalTot').value = parseFloat(subtotal).toFixed(2);
          document.getElementById("SUM3").value =parseFloat(lblElement).toFixed(2);
          document.getElementById("totalTot").value =parseFloat(lblElement).toFixed(2);

          document.getElementById('totppn').value = 0;
          document.getElementById('totdpp').value = parseFloat(lblElement).toFixed(2);
          document.getElementById('grandtotal').value = parseFloat(lblElement).toFixed(2);

          //alert(e);
      }
      else if (j_ppn == "EXCLUDE") {
        //document.getElementById('totalTot').value = parseFloat(subtotal).toFixed(2);
        document.getElementById("SUM3").value =parseFloat(lblElement).toFixed(2);
        document.getElementById("totalTot").value =parseFloat(lblElement).toFixed(2);
        document.getElementById('totppn').value = parseFloat(lblElement*10/100).toFixed(2);
        document.getElementById('totdpp').value = parseFloat(lblElement).toFixed(2);
        var p=parseFloat(lblElement*10/100);
        var d=parseFloat(lblElement);
        document.getElementById('grandtotal').value = parseFloat(p+d).toFixed(2);
        //alert(e);
      }
      else if (j_ppn == "INCLUDE") {
        document.getElementById("SUM3").value =parseFloat(lblElement).toFixed(2);
        document.getElementById("totalTot").value =parseFloat(lblElement).toFixed(2);
        //document.getElementById('totalTot').value = parseFloat(subtotal).toFixed(2);
        //document.getElementById('totppn').value = parseFloat(subtotal*10/100).toFixed(2);
        document.getElementById('totdpp').value = parseFloat(lblElement/1.1).toFixed(2);
        var p=parseFloat(lblElement/1.1);
        document.getElementById('totppn').value = parseFloat(lblElement-p).toFixed(2);
        document.getElementById('grandtotal').value = parseFloat(lblElement).toFixed(2);
       //alert(e);
      }


      //recounter();
    }
    </script>


    <script type="text/javascript">

     function jum_akhir(){
     var inputs = document.querySelectorAll('input[name="rowsBM[]"]');
     var max = 0;
     for (var i = 0; i < inputs.length; ++i) {
     max = Math.max(max , parseInt(inputs[i].value));
     }
     document.getElementById('key_max').value = parseInt(max);
      //alert(max);
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
          //var dd = document.getElementById("id_barang").value;
          //alert(dd);
          if (e == "NON PPN") {
              dpp=(hb-diskon).toFixed(2);
              nilaippn=(0).toFixed(2);
              total=((hb-diskon)*qty).toFixed(2);

          }
          else {
              dpp=((hb-diskon)/1.1).toFixed(2);
              nilaippn=(10/100*dpp).toFixed(2);
              total=((hb-diskon)*qty).toFixed(2);

          }

          document.getElementById('dpp').value = dpp;
          document.getElementById('nilaippn').value = nilaippn;
          document.getElementById('total').value = total;
          //document.getElementById('add_btn_item').click();
          recounter();
        }

   </script>
   <script>
       function cek_id_barang() {

         var dd = document.getElementById("id_barang").value;
         //var dd = document.getElementById("id_barang").value;
         //alert(dd);

       }

  </script>
   <script language=javascript type=text/javascript>

   function cek_qty()
   {
   document.getElementById('qty').onkeypress=function(e){
       if(e.keyCode==13){
           //alert("XXXXX");
           hitung_pilih_item();
           document.getElementById('add_btn_item').click();
       }
   }
  }
   </script>

   <script language=javascript type=text/javascript>

   function cek_item()
   {
   document.getElementById('searchbarcode').onkeypress=function(e){
       if(e.keyCode==13){
           //alert("XXXXX");
           hitung_pilih_item();
           document.getElementById('add_btn_item').click();
       }
   }
  }
   </script>
<script>
$(document).keydown( function(event) {
if (event.which === 117) {
// login code here
//alert("XXXXX");
document.getElementById('btnSubmit').click();
}
else if (event.which===32) {
  document.getElementById('jml_bayar').focus();
}
});
</script>

<form name="form1" id="form1" method="post" action="<?=site_url($action_form)?>"  enctype="multipart/form-data" onkeypress="return event.keyCode != 13;" >

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

     <?php

     if(isset($data_edit_cb)){
     foreach($data_edit_cb as $rowcb){
     $no_cb=$rowcb->no_bukti;
     ?>

     <div class="input-group" hidden>

       <input id="middle-name" class="form-control col-md-3 col-xs-12" value="<?php echo $no_cb; ?>" type="hidden" name="no_cb" required>
     </div>

       <?php }} ?>

     <div class="box box-default">

       <?php

       if(isset($data_edit)){
       foreach($data_edit as $row){
       //$no_po=$row->no_bukti;
                      ?>

       <div class="box-header with-border">
         <h3 class="box-title"><i class="fa fa-pencil-square-o"></i> Info Resep</h3>

         <div class="box-tools pull-right">
           <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         </div>
       </div>

       <!-- /.box-header -->
       <div class="box-body">
         <div class="col-md-4">
           <label>No Bukti</label>
           <div class="input-group">
             <div class="input-group-addon"><i class="fa fa-key"></i>
             </div>
             <input class="form-control col-md-4 col-xs-12" value="<?php echo $row->no_bukti; ?>" placeholder="AUTO" readonly type="text" name="no_bukti" >
           </div>

            <label>Tanggal</label>

            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input id="middle-name" class="date-picker form-control col-md-3 col-xs-12" value="<?php echo $row->tgl_trans; ?>" type="date" name="tgl_trans" required>
            </div>

            <label>Pembayaran</label>
              <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-ticket"></i>
              </div>
              <select class="select2 form-control" id="jenis_bayar" name="jenis_bayar" required>
                <option value="<?php echo $row->jenis_bayar; ?>"><?php echo $row->jenis_bayar; ?></option>

                <option value="TUNAI">TUNAI</option>
                <option value="KREDIT">KREDIT</option>
              </select>
             </div>


         </div>



         <div class="col-md-8">
           <label>Cari Customer<span class="required"></span> </label>
           <div class="input-group">
           <div class="input-group-addon">
             <i class="fa fa-ticket"></i>
           </div>

           <select class="select2 form-control" id="id_customer" name="id_customer" onchange="onklik(this.value)" required>
            <option value="<?php echo $row->id_customer; ?>"><?php echo $row->nama_customer; ?></option>
            <?php
            $jsArray2 = "var kdSertifikat2 = new Array();\n";
            foreach ($data_customer as $rowq) {
               $xxalamat=$rowq->alamat;
               echo '<option value="'.$rowq->id_customer.'">'.$rowq->nama.'</option>';
               $jsArray2 .= "kdSertifikat2['".$rowq->id_customer."'] = {
                 data11:'".$rowq->nama."',
                 data21:'".$rowq->telepon."',
                 data31:'".$xxalamat."'
                 };\n";
              // $jsArray2 .= "CustSertifikat['".$rowm->id_customer."'] = {data11:'".addslashes($rowm->nama_customer)."', data21:'".addslashes($rowm->alamat_customer)."', data31:'".addslashes($rowm->alamat_customer)."'};\n";
            }
            ?>
           </select>

           <script type="text/javascript">
           <?php echo $jsArray2; ?>
           function onklik(idx){
               var x = document.getElementById("id_customer").selectedIndex;
               var combo2 = document.getElementById("id_customer").value;
               //alert(combo2);
               if (combo2 === 'pilih'){
                 document.getElementById('nama_customer').value = '';
                 //document.getElementById('telepon_customer').value = '';
                 document.getElementById('alamat_customer').value = '';
                 //alert("NAY");
                 return false;
               } else {
                 document.getElementById('nama_customer').value = kdSertifikat2[idx].data11;
                 //document.getElementById('telepon_customer').value = kdSertifikat2[idx].data21;
                 document.getElementById('alamat_customer').value = kdSertifikat2[idx].data31;
                 //document.getElementById('telepon_customer').value = CustSertifikat[idx].data31;
                 //alert("YAI");
                 return false;
               }


             }
           </script>

          </div>
           <label>Customer </label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-info"></i>
                </div>
                <input id="nama_customer" class="form-control col-md-3 col-xs-12" value="<?php echo $row->nama_customer; ?>" type="text" name="nama_customer" readonly>
              </div>
           <label>Alamat </label>
           <div class="input-group">
             <div class="input-group-addon">
               <i class="fa fa-info"></i>
             </div>
             <input id="alamat_customer" class="form-control col-md-6 col-xs-12" value="<?php echo $row->alamat_customer; ?>" type="text" name="alamat_customer" readonly>
           </div>
         </div>
         <div class="col-md-4" hidden>
           <label>Total </label>
           <div class="small-box bg-green">
                   <div class="inner">
                     <p>Tekan (F6) untuk simpan transaksi</p>
                     <br>
                     <h3><label style="font-size:90px" id="lblTotal"></label></h3>
                     <p>Harga sudah termasuk Ppn </p>
                   </div>
                   <div class="icon">
                     <i class="ion ion-pie-graph"></i>
                   </div>
           </div>

         </div>

     </div>

      <?php } } ?>
       <!-- /.box-body -->
       <div class="box-footer">
         <div class="col-lg-6 col-xs-6">
         <h3 class="box-title"> <?php  include 'includefile/Pesan.php'; ?></h3>

       </div>
        <div class="col-lg-6 col-xs-6" hidden>
         <a href="<?php echo site_url('Buatresep/cetak/'.$this->session->flashdata('no_penjuaan')); ?>" target="_blank" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Cetak Transaksi Terakhir <?php echo $this->session->flashdata('no_penjuaan') ?></a>
       </div>
       </div>
     </div>


     <div class="box box-primary">
       <div class="box-header with-border">
         <h3 class="box-title"><i class="fa fa-cubes"></i> Item</h3>
         <div class="box-tools pull-right">
           <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         </div>
       </div>


         <div class="box-body">
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
                             jq_auto('#kode_barang').val(''+suggestion.id_barang);
                             //jq_auto('#part_number').val(''+suggestion.part_number);
                             jq_auto('#nama_barang').val(''+suggestion.nama_barang);
                             jq_auto('#hb').val(''+suggestion.hb);
                             jq_auto('#satuan').val(''+suggestion.satuan);
                             jq_auto('#dpp').val(''+suggestion.dpp);
                             jq_auto('#ppn').val(''+suggestion.ppn);
                             jq_auto('#nilaippn').val(''+suggestion.nilaippn);
                             document.getElementById("qty").focus();
                           }
                         });
                       });
           </script>

           <div class="form-group">
             <div class="row">
               <div class="col-lg-6">
                     <label for="exampleInputEmail1">Barcode </label>
                     <input onclick="LPS();" class="form-control col-md-6 col-xs-12" id="pbarcode" value="" placeholder="Filter / Barcode" type="text" name="barcode">
               </div>
                 <div class="col-lg-6">
                       <label for="exampleInputEmail1">Filter Item </label>
                       <input onclick="LPS();" class="partsearch form-control col-md-6 col-xs-12" id="searchbarcode" value="" placeholder="Filter" type="text" name="barcode">
                 </div>

           </div>
           </div>

           <div class="form-group">
             <div class="row">


                <div id="atampilitem"></div>



                <div class="col-lg-4">
                  <label for="exampleInputEmail1">Info</label>
                  <input name="kode_barang" type="hidden" id="kode_barang" value="<?php //echo $row->id_barang; ?>" >
                  <input name="nama_barang" type="text" id="nama_barang" value="<?php //echo $row->nama; ?>" class="form-control col-md-7 col-xs-12"  placeholder="Nama Item" readonly>
                  <!-- /input-group -->
                </div>
                <div class="col-lg-1">
                  <label>Qty</label>
                  <input name="qty" type="number" id="qty" class="form-control col-md-4 col-xs-12" style="text-align:right;" value="1" placeholder="Qty" onchange="hitung_pilih_item();" onblur="hitung_pilih_item();" onkeypress="cek_qty()" />
                  <!-- /input-group -->
                </div>
                <div class="col-lg-2">
                  <label for="exampleInputEmail1">Harga Jual</label>
                  <input name="hb" type="text" id="hb" class="form-control col-md-4 col-xs-12" style="text-align:right;" value="<?php //echo $row->hj; ?>" placeholder="Harga Jual" onchange="hitung_pilih_item();" onblur="hitung_pilih_item();" />
                  <!-- /input-group -->
                </div>
                <div class="col-lg-1">
                  <label for="exampleInputEmail1">Satuan</label>
                  <input name="satuan" type="text" id="satuan" value="<?php //echo $row->satuan; ?>" class="form-control col-md-2 col-xs-12" style="text-align:center;" placeholder="Satuan" readonly />
                  <!-- /input-group -->
                </div>
                <div class="col-lg-2">
                  <label for="exampleInputEmail1">Total</label>
                    <input name="total" type="number" id="total" class="form-control col-md-7 col-xs-12" value="0" style="text-align:right;" placeholder="Total" step="Any" readonly />

                </div>

                <div class="col-lg-1" hidden>
                  <label for="exampleInputEmail1">Tipe</label>
                  <input name="itemppn" type="text" id="itemppn" value="<?php //echo $row->ppn; ?>" class="form-control col-md-2 col-xs-12" style="text-align:center;"  placeholder="Ppn" readonly />
                  <!-- /input-group -->
                </div>
                <div class="col-lg-1" hidden>
                  <label for="exampleInputEmail1">Dpp</label>
                  <input name="dpp" type="number" id="dpp" class="form-control col-md-4 col-xs-12" value="0" style="text-align:right;" placeholder="Dpp" step="Any" readonly />
                  <!-- /input-group -->
                </div>
                <div class="col-lg-1" hidden>
                  <label for="exampleInputEmail1">Ppn</label>
                  <input name="nilaippn" value="0" type="number" id="nilaippn" class="form-control col-md-4 col-xs-12" style="text-align:right;" step="Any" placeholder="Nilai Ppn" readonly />
                  <!-- /input-group -->
                </div>
                <div class="col-lg-1" hidden>
                  <label for="exampleInputEmail1">%Diskon</label>
                  <input name="perc_diskon" type="number" id="perc_diskon" class="form-control col-md-7 col-xs-12" value="0" style="text-align:right;"  placeholder="% Diskon" step="Any" readonly />
                  <!-- /input-group -->
                </div>
                <div class="col-lg-1" hidden>
                  <label for="exampleInputEmail1">Diskon</label>
                  <input name="diskon" type="number" value="0" id="diskon" class="form-control col-md-7 col-xs-12" style="text-align:right;" placeholder="Diskon" onchange="hitung_pilih_item();" onblur="hitung_pilih_item();"  />
                  <!-- /input-group -->
                </div>

                <div class="col-lg-2">
                  <label> Action</label>

                    <input hidden="" id="site_url_x" value="<?php echo base_url();?>">

                    <input type="button" class="btn btn-block btn-success btn-flat" name="add_btn_item" value="Tambahkan" id="add_btn_item" onblur="hitung_pilih_item();" onmouseover="hitung_pilih_item();" />
                    <input type="hidden" class="btn btn-block btn-success btn-flat" name="cek_id" value="Cek ID" onclick="cek_id_barang();"/>

                </div>


             </div>

           </div>

           <!-- xxxxxx -->
         </div>

     </div>



      <!-- /.row -->

     <div class="row">
       <!-- left column -->
       <div class="col-md-12">
         <div class="box box-info">
             <div class="box-header with-border">
               <h3 class="box-title"><i class="fa fa-cubes"></i> Detail Obat</h3>
               <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
               </div>
             </div>
     <!-- /.box-header -->
     <!-- form start -->


                 <div class="box-body">
                   <!-- /.isi table -->

                   <div class="col-xs-12 table-responsive">

                      <table class="table table-hover">
                        <!--  <table id="example_detail" class="table table-bordered table-striped nowrap"  cellspacing="0" width="100%"> -->
     										<thead>

     										<tr height="30px" style="background: #337ab7; color:white;" class="td_only">
     											<th style="width:5%; text-align:center;">No</th>
                          <th style="width:5%; text-align:center;">Kode</th>
                          <th style="width:20%; text-align:center;">Nama Item</th>
      										<th style="width:5%; text-align:center;">Qty</th>
                          <th style="width:8%; text-align:center;">Harga</th>
                          <th style="width:7%; text-align:center;" hidden>Dpp</th>
                          <th style="width:8%; text-align:center;" hidden>Ppn</th>
                          <th style="width:8%; text-align:center;" hidden>Diskon</th>
                          <th style="width:7%; text-align:center;" hidden>%Diskon</th>
                          <th style="width:5%; text-align:center;">Satuan</th>
                          <th style="width:17%; text-align:center;">Total</th>
     											<th style="width:5%; text-align:center;">Action</th>
     										</tr>
     										</thead>
                        <tbody id="containeritem" style="height: 100px; overflow: auto;">
                          <?php
                            $count = 0;
                						$qty=0;
                						$totalbeli=0;
                             if(isset($data_detail))
                                {
                                  foreach ($data_detail as $row)
                                     { $count++;
                    								   $qty=$qty+$row->qty;
                    								   $totalbeli=$totalbeli+($row->qty*$row->hb);
    								                            ?>

                                                <tr class="records">

                                              			<td align="center">
                                                      <div hidden id="count"><?php echo ($count) ?></div>
                                                      <input class="form-control" style="width:100%; text-align:left" type="text" value="<?php echo $count; ?>" readonly />
                                              			</td>

                                              			<td>
                                              				<input class="form-control" style="width:100%" id="id_barang_<?php echo ($count) ?>" name="id_barang_<?php echo ($count) ?>" type="text" value="<?php echo $row->kd_barang; ?>" readonly />
                                              				<input class="form-control" style="width:100%" name="no_row_<?php echo ($count) ?>" type="hidden" value="'+ count +'" readonly />
                                              			</td>

                                              			<td>
                                              				<input class="form-control col-md-7 col-xs-12" style="width:100%" id="nama_barang_<?php echo ($count) ?>" name="nama_barang_<?php echo ($count) ?>" type="text" value="<?php echo $row->nama_barang; ?>" readonly />
                                              			</td>

                                              			<td>
                                              				<span class="nilaiQty" hidden>+ qty_barang[0].value +'</span>
                                              				<input class="form-control" style="width:100%; text-align:right" id="qty_<?php echo ($count) ?>" name="qty_<?php echo ($count) ?>" type="number" value="<?php echo $row->qty; ?>" onchange="recounter();" onblur="recounter();" areadonly />
                                              			</td>
                                              			<td>
                                              				<input class="form-control" style="width:100%; text-align:right" id="hb_<?php echo ($count) ?>" name="hb_<?php echo ($count) ?>" type="number" value="<?php echo $row->hb; ?>" onchange="recounter();" onblur="recounter();" areadonly />
                                              			</td>

                                              			<td  hidden>
                                              				<input class="form-control" style="width:100%; text-align:right" id="dpp_<?php echo ($count) ?>" name="dpp_<?php echo ($count) ?>" type="number" value="<?php echo $row->dpp; ?>" readonly />
                                              			</td>

                                              			<td  hidden>
                                              				<input class="form-control" style="width:100%; text-align:right" id="nilaippn_<?php echo ($count) ?>" name="nilaippn_<?php echo ($count) ?>" type="number" value="<?php echo $row->ppn; ?>" readonly />
                                              			</td>

                                              			<td  hidden>
                                              				<input class="form-control" style="width:100%; text-align:right" id="diskon_<?php echo ($count) ?>" name="diskon_<?php echo ($count) ?>" type="number" value="<?php echo $row->ppn; ?>" readonly />
                                              			</td>

                                              			<td  hidden>
                                              				<input class="form-control" style="width:100%; text-align:right" id="perc_diskon_<?php echo ($count) ?>" name="perc_diskon_<?php echo ($count) ?>" type="number" value="<?php echo $row->perc_diskon; ?>" readonly />
                                              			</td>

                                              			<td>
                                              				<input class="form-control" style="width:100%; text-align:right" id="satuan_<?php echo ($count) ?>" name="satuan_<?php echo ($count) ?>" type="text" value="<?php echo $row->satuan; ?>" readonly />
                                              			</td>

                                              			<td>
                                              				<span class="nilaiTotal" hidden>+ tot_harga +'</span>
                                              				<input class="form-control" style="width:100%; text-align:right" id="total_<?php echo ($count) ?>" name="total_<?php echo ($count) ?>" type="number" value="<?php echo $row->total; ?>" readonly />
                                              			</td>

                                                    <td align="center">

                                                      <input id="rows_<?php echo $count; ?>" name="rowsBM[]" value="<?php echo $count; ?>" type="hidden" />

                                                       <a class="remove_item" href="#" >
                                                        <img src="<?=base_url('/')?>build/source_ant/picture/table_delete.png" width="16" height="16" />
                                                      </a>
                                                    </td>
                                              		</tr>

                                    <?php }
                                  }
                                ?>
     										</tbody>
                        <tfoot>
                          <tr>
                            <th style="width:5%; text-align:center;"><input style="text-align:center" type="hidden" class="key_max" id="key_max" value="<?php echo ($count) ?>" style="background-color:#eea236; color:black;" /></th>
                            <th style="width:5%; text-align:center;"> </th>
                            <th style="width:20%; text-align:center;"></th>
        										<th style="width:5%; text-align:center;"><input style="text-align:center" class="form-control" type="hidden" id="xqty" name="SUM1"  readonly/></th>
                            <th style="width:8%; text-align:center;" hidden></th>
                            <th style="width:10%; text-align:center;" hidden> </th>
                            <th style="width:7%; text-align:center;" hidden> </th>
                            <th style="width:8%; text-align:center;" hidden> </th>
                            <th style="width:7%; text-align:center;"></th>
                            <th style="width:5%; text-align:center;"></th>
                            <th style="width:17%; text-align:center;"><input style="text-align:right" class="form-control" type="hidden" id="SUM3" value="<?php //echo $totalbeli; ?>" name="SUM3" readonly /> </td></th>
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
               <h3 class="box-title"><i class="fa fa-money"></i> Total</h3>
               <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse">Tekan F6 Untuk Simpan Transaksi *  <i class="fa fa-minus"></i></button>
               </div>


             </div>
     <!-- /.box-header -->
     <!-- form start -->
     <script type="text/javascript">
         $(document).ready(function() {

             $("#jenis_ppn").change(function(){

               var subtotal = document.getElementById("totalTot").value;
               var e = document.getElementById("jenis_ppn").value;



               if (e == "NON") {
                   //document.getElementById('totalTot').value = parseFloat(subtotal).toFixed(2);
                   document.getElementById('totppn').value = 0;
                   document.getElementById('totdpp').value = parseFloat(subtotal).toFixed(2);
                   document.getElementById('grandtotal').value = parseFloat(subtotal).toFixed(2);

                   //alert(e);
               }
               else if (e == "EXCLUDE") {
                 //document.getElementById('totalTot').value = parseFloat(subtotal).toFixed(2);
                 document.getElementById('totppn').value = parseFloat(subtotal*10/100).toFixed(2);
                 document.getElementById('totdpp').value = parseFloat(subtotal).toFixed(2);
                 var p=parseFloat(subtotal*10/100);
                 var d=parseFloat(subtotal);
                 document.getElementById('grandtotal').value = parseFloat(p+d).toFixed(2);
                 //alert(e);
               }
               else if (e == "INCLUDE") {
                 //document.getElementById('totalTot').value = parseFloat(subtotal).toFixed(2);
                 //document.getElementById('totppn').value = parseFloat(subtotal*10/100).toFixed(2);
                 document.getElementById('totdpp').value = parseFloat(subtotal/1.1).toFixed(2);
                 var p=parseFloat(subtotal/1.1);
                 document.getElementById('totppn').value = parseFloat(subtotal-p).toFixed(2);
                 document.getElementById('grandtotal').value = parseFloat(subtotal).toFixed(2);
                //alert(e);
               }
               //myFunctionZ();
               });

         })
     </script>
     <?php

 if(isset($data_edit)){
   foreach($data_edit as $row){

                    ?>
                 <div class="box-body">
                   <div class="col-md-6">
                     <label>Keterangan</label>

                         <textarea class="form-control" rows="3" name="keterangan" placeholder="Isikan Note Disini ..." onblur="recounter();" onmouseover="recounter();"><?php echo $row->keterangan; ?></textarea>

                         <label>Unit</label>
                         <div class="input-group">
                         <div class="input-group-addon">
                           <i class="fa fa-ticket"></i>
                         </div>
                         <select class="select2 form-control" id="kd_sub_unit" name="kd_sub_unit" required>
                          <option value="<?php echo $row->kd_sub_unit; ?>"><?php echo $row->nama_sub_unit; ?></option>
                          <?php
                          foreach ($data_sub_unit as $rowx) {
                             echo '<option value="'.$rowx->kd_sub_unit.'">'.$rowx->nama_sub_unit.'</option>';

                          }
                          ?>
                         </select>
                         </div>
                   </div>

                   <div class="col-md-6">

                     <label>Ppn</label>
                       <div class="input-group">
                       <div class="input-group-addon">
                         <i class="fa fa-ticket"></i>
                       </div>
                       <select class="select2 form-control" id="jenis_ppn" name="jenis_ppn" onchange="recounter();" onblur="recounter();" onmouseover="recounter();">
                          <option value="<?php echo $row->jenis_ppn; ?>"><?php echo $row->jenis_ppn; ?></option>

                         <option value="NON">NON</option>
                         <option value="INCLUDE">INCLUDE</option>
                         <option value="EXCLUDE">EXCLUDE</option>
                       </select>
                      </div>

                     <label> Sub Total </label>
                     <input style="text-align:right" id="totalTot" class="form-control" value="<?php echo $row->subtotal; ?>" type="number" name="subtotal" readonly>
                     <label> Dpp </label>
                     <input style="text-align:right" id="totdpp" class="form-control" value="<?php echo $row->dpp; ?>" type="number" name="dpp" readonly>

                     <label> Ppn </label>
                     <input style="text-align:right" id="totppn" class="form-control" value="<?php echo $row->ppn; ?>" type="number" name="ppn" readonly>
                     <label> Total </label>
                     <input style="text-align:right" id="grandtotal" class="form-control" type="number" value="<?php echo $row->grandtotal; ?>" step="Any" name="grandtotal" readonly required>
                     <script type="text/javascript">
                         $(document).ready(function() {
                                 $("#jml_bayar").change(function(){
                                   var xxgrandtotal = parseFloat(document.getElementById("grandtotal").value);
                                   var xxjml_bayar = parseFloat(document.getElementById("jml_bayar").value);
                                   var xxkembalian=xxjml_bayar-xxgrandtotal;

                                   document.getElementById('jml_kembali').value = xxkembalian;
                                 });

                         })
                     </script>

                     <!-- <label> Uang Bayar </label>
                     <input style="text-align:right" id="jml_bayar" class="form-control" type="number" value="<?php  echo $row->jml_bayar; ?>" name="jml_bayar"  required>
                     <label> Kembalian </label>
                     <input style="text-align:right" id="jml_kembali" class="form-control" type="number" value="<?php echo $row->jml_kembali; ?>" name="jml_kembali" readonly> -->

                   </div>


                     <!-- /.col -->
                   </div>

<?php }} ?>
                   <div class="box-footer">
                    <div class="col-lg-12 col-xs-6">

                     <button id="btnSubmit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Update</button>
                   </div>
                   </div>
                 </div>


             </div>

       </div>




     <!-- /.row -->
   </section>


     <!-- title row -->

     <!-- /.row -->

     <!-- Table row -->

     <!-- /.row -->


     <!-- /.row -->


   <!-- /.content -->
 </div>
</form>

 <?php include 'includefile/foot.php'; ?>
