<?php include 'includefile/head.php'; ?>

<?php $action_form = 'Putranspo/tambah'; ?>


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
    <script type="text/javascript" src='<?php echo base_url();?>assets/js/append_part_po.js'></script>
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



     <div class="box box-default">


       <div class="box-header with-border">

         <script type="text/javascript">
             $(document).ready(function() {

                 $("#no_po").change(function(){

                     var no_po = $("#no_po").val();
                     alert(no_po);
                     $.ajax({
                         type: "POST",
                         url: "<?php echo base_url('index.php/Putranspo/get_data_po'); ?>",
                         data: "no_po="+no_po,
                         cache:false,
                         success: function(data){
                           $('#tampilpo').html(data);
                         }

                     });

                   }

                );

             })
         </script>
         <select class="select2 form-control" id="no_po" name="no_po" required>
           <option value="">-- Cari PO --</option>
           <?php
           if(isset($data_po))
           {
           foreach ($data_po as $row)
           {
           ?>
                <option value="<?php echo $row->no_bukti;?>"><?php echo $row->ket; ?></option>
           <?php
                }
                }
           ?>
         </select>

         <div class="box-tools pull-right">
           <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         </div>
       </div>

        <div id="tampilpo"></div>





     <!-- /.row -->
   </section>

 </div>
</form>

 <?php include 'includefile/foot.php'; ?>
