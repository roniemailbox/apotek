<?php include 'includefile/head.php'; ?>

<?php //$action_form = 'Kartustok/cetakkartu'; ?>


<link href="<?php echo base_url('/');?>assets/css/style_auto.css" rel="stylesheet">
<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery-1.8.2.min.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.autocomplete.js'></script>

  <form name="theForm" class="form-horizontal" method="post">

  <script>
   function submitFunction(i) {
     //alert(i);
     if (i==1) {
           document.theForm.action="<?=site_url('Kartustok/cetakkartu')?>?get=1";
           document.theForm.target="_blank";

     }
     if (i==2) {
           document.theForm.action="<?=site_url('Kartustok/cetakkartu')?>?get=2";
           document.theForm.target="_blank";
     }
     if (i==3) {
           document.theForm.action="<?=site_url('Kartustok/cetakkartu')?>?get=3";
           document.theForm.target="_blank";
     }
     if (i==4) {
           document.theForm.action="<?=site_url('Kartustok/cetakkartu')?>?get=4";
           document.theForm.target="_blank";
     }
     if (i==5) {
           document.theForm.action="<?=site_url('Kartustok/cetakkartu')?>?get=5";
           document.theForm.target="_blank";
     }
     document.theForm.submit()
   }
   </script>
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
         <h3 class="box-title"><i class="fa fa-refresh"></i> Filter<?php  //include 'includefile/Pesan.php'; ?></h3>

         <div class="box-tools pull-right">
           <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

         </div>
       </div>
       <script type="text/javascript">
           $(document).ready(function() {

               $("#kd_barang").change(function(){

                   var kd_barang = $("#kd_barang").val();
                   var kd_unit = $("#kd_unit").val();
                   var kd_sub_unit = $("#kd_sub_unit").val();
                   //alert(kd_barang);
                   $.ajax({
                       type: "GET",
                       //url: "<?php //echo base_url('index.php/Kartustok/get_data_barang'); ?>",
                       url: '<?php echo site_url('/') ?>Kartustok/get_data_barang?kd_barang=' + kd_barang + '&kd_sub_unit=' + kd_sub_unit,
                       //data: "kd_barang="+kd_barang,
                       cache:false,
                       success: function(data){
                         $('#tampilbarang').html(data);
                       }

                   });

                 }

              );

           })
       </script>
       <!-- /.box-header -->
       <div class="box-body">
         <div class="col-md-12 col-sm-6 col-xs-12">
           <label>Unit Usaha</label>
           <select class="select2 col-sm-12 form-control" id="kd_sub_unit" name="kd_sub_unit" required>

             <?php
             if(isset($data_sub_unit))
             {
             foreach ($data_sub_unit as $row)
             {
             ?>
                  <option value="<?php echo $row->kd_sub_unit;?>"><?php echo $row->nama_sub_unit; ?></option>
                  <?php
                  }
                  }
                  ?>
           </select>

         </div>
         <div class="col-md-12 col-sm-6 col-xs-12">
           <label>Filter Item / Barang</label>
           <select class="select2 col-sm-12 form-control" id="kd_barang" name="kd_barang">
             <option value="">- pilih -</option>
             <?php
             if(isset($data_item))
             {
             foreach ($data_item as $row)
             {
             ?>
                  <option value="<?php echo $row->kd_barang;?>"><?php echo $row->nama; ?></option>
                  <?php
                  }
                  }
                  ?>
           </select>

         </div>



       </div>
       <!-- /.box-body -->
       <div class="box-footer">


           <button onClick="submitFunction(1)" name="sumbit" type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Cetak Semua</button>
           <button onClick="submitFunction(2)" name="sumbit" type="submit" class="btn btn-success"><i class="fa fa-print"></i> Cetak Rinci</button>
           <button onClick="submitFunction(3)" name="sumbit" type="submit" class="btn btn-danger"><i class="fa fa-print"></i> Cetak Harga Jual 0</button>
           <button onClick="submitFunction(4)" name="sumbit" type="submit" class="btn btn-info"><i class="fa fa-print"></i> Cetak Label</button>
            <button onClick="submitFunction(5)" name="sumbit" type="submit" class="btn btn-default"><i class="fa fa-print"></i> Cetak Master Barang</button>

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

                      <div id="tampilbarang"></div>
                 </div>
                 <!-- /.box-body -->

                 <!-- /.box-footer -->
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
