<?php
include 'includefile/head.php';

if ($perintah=="Baru"){
  $action_form = 'Mspekerjaan/tambah';
}
else {
  $action_form = 'Mspekerjaan/edit';
}

?>
<link href="<?=base_url('/')?>assets/css/style_auto.css" rel="stylesheet">
<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery-1.8.2.min.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.autocomplete.js'></script>

<script type='text/javascript'>
            var jq_auto = $.noConflict(true);
            var site = "<?php echo site_url();?>";
            jq_auto(function(){
              //alepekerjaan("saa");
              jq_auto('.ktpsearch').autocomplete({
                // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
                serviceUrl: site+'/autocomplete/cari_warga',
                //serviceUrl: site+'/autocomplete/item_po',
                // fungsi ini akan dijalankan ketika user memilih salah satu hasil request
                onSelect: function (suggestion) {
                  jq_auto('#ktp_pekerjaan').val(''+suggestion.ktp);
                  jq_auto('#nama_warga').val(''+suggestion.nama);

                }
              });
            });
</script>
<script type="text/javascript">

    function LPSktp() {
      document.getElementById('filterktp').value='';
      document.getElementById('ktp_pekerjaan').value='';
      document.getElementById('nama_warga').value='';
      document.getElementById('filterktp').focus();
    }
 </script>
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <h1>

       <?php echo $title ?>
       <small>Data Table</small>
     </h1>
     <ol class="breadcrumb">
       <li><a href="<?php echo site_url('Utama') ?>"><i class="fa fa-home"></i> Home</a></li>

     </ol>
   </section>
   <!-- Main content -->
   <section class="content">
     <div class="row">
       <form  method="post" action="<?=site_url($action_form)?>" >
         <?php if($perintah=="Baru")
         {
           ?>

       <div class="col-xs-12">
         <div class="box box-info">
           <div class="box-header with-border">
             <h3 class="box-title"><?php echo $title_tambah ?></h3>
           </div>
           <div class="box-body">


             <h5>ID Pekerjaan</h5>

             <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-key"></i></span>
               <input type="text" class="form-control" placeholder="Auto" readonly>
             </div>
             <h5>Nama</h5>

             <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
               <input type="text" class="form-control" name="pekerjaan" placeholder="Nama Pekerjaan" required>
             </div>




             <!-- /input-group -->
           </div>
           <div class="box-footer">

             <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Simpan Data</button>
           </div>
           <!-- /.box-body -->
         </div>


         <!-- /.box -->
       </div>
     <?php } else { ?>
       <div class="col-xs-12">
       <div class="box box-info">
         <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title_tambah ?></h3>
         </div>
         <div class="box-body">
         <?php
           $no=1;
           if(isset($data_pekerjaan_edit))
              {
                foreach ($data_pekerjaan_edit as $row_edit)
                   { ?>

           <h5>ID Pekerjaan</h5>

           <div class="input-group">

             <span class="input-group-addon"><i class="fa fa-key"></i></span>
             <input type="text" value="<?php echo $row_edit->id_pekerjaan; ?>" name="id_pekerjaan" class="form-control" placeholder="Auto" readonly>
           </div>
           <h5>Nama</h5>

           <div class="input-group">

             <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
             <input type="text" value="<?php echo $row_edit->nama; ?>" name="pekerjaan" class="form-control" placeholder="pekerjaan" required>
           </div>


           <?php
          }
        }
      ?>
           <!-- /input-group -->
         </div>
         <div class="box-footer">
           <a href="<?php echo site_url('Mspekerjaan'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Input Baru</a>
           <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Update Data</button>
         </div>
         <!-- /.box-body -->
       </div>
       </div>
     <?php } ?>

   </form>

       <div class="col-xs-12">


         <div class="box">

           <!-- /.box-header -->
           <div class="box-body">

             GRAFIK / INFO

           </div>
           <!-- /.box-body -->
         </div>
         <!-- /.box -->
       </div>

     </div>


     <div class="row">


       <div class="col-xs-12">


         <div class="box">

          <?php //include 'template/Pesan.php'; ?>
           <div class="box-header">


             <button type="button" class="btn btn-block btn-info btn-flat" data-toggle="modal" data-target="#modal-default"><i class="fa fa-search"></i>
               Cari Master Pekerjaan
             </button>

           </div>

           <div class="modal fade" id="modal-default">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Mspekerjaan/filter')?>">
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
                   <th>ID Pekerjaan</th>
                   <th>Pekerjaan</th>

                   <th>Dientri Oleh</th>
                   <th>Dientri Pada</th>
                   <th>Diedit Oleh</th>
                   <th>Diedit Pada</th>
                   <th>Opsi</th>
                 </tr>
               </thead>
               <tbody>
                <!--
               <a class="btn btn-mini" href="<?php //echo site_url('master/hapus_pekerjaan/'.$row->kd_pekerjaan);?>"
        onclick="return confirm('Anda yakin?')"> <i class="icon-remove"></i> Hapus</a> -->
   </td>
 <?php
 //ambil dari controler
 $no=1;
 if(isset($data_pekerjaan))
    {
      foreach ($data_pekerjaan as $row)
         { ?>

           <div class="modal fade" id="modal-<?php echo $row->id_pekerjaan; ?>">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Mspekerjaan/ambiledit')?>">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title">Edit Data Ini....????</h4>
                 </div>
                 <div class="modal-body">
                   <p>
                     <h5>ID Pekerjaan</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-keyv"></i></span>
                       <input type="text" name="id_pekerjaan" value="<?php echo $row->id_pekerjaan; ?>" class="form-control" placeholder="Auto" readonly>
                     </div>
                     <h5>Nama Pekerjaan</h5>

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
           <div class="modal fade" id="modal-hapus<?php echo $row->id_pekerjaan; ?>">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Mspekerjaan/hapus')?>">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title">Hapus Data Ini....????</h4>
                 </div>
                 <div class="modal-body">
                   <p>
                     <h5>ID Pekerjaan</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-key"></i></span>
                       <input type="text" name="id_pekerjaan" value="<?php echo $row->id_pekerjaan; ?>" class="form-control" placeholder="Auto" readonly>
                     </div>
                     <h5>Nama Pekerjaan</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                       <input type="text" value="<?php echo $row->nama; ?>" class="form-control" placeholder="pekerjaan" readonly>
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
           <td><?php echo $row->id_pekerjaan; ?></td>
           <td><?php echo $row->nama; ?></td>

           <td><?php echo $row->nama_pegawai; ?></td>
           <td><?php echo $row->entry_date; ?></td>
           <td><?php echo $row->nama_edit_pegawai; ?></td>
           <td><?php echo $row->edit_date; ?></td>

           <td>
             <?php
             if($hak_u == 1)
             {
               ?>
               <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-<?php echo $row->id_pekerjaan; ?>"><i class="fa fa-pencil"></i>
                 Edit
               </button>

             <?php
             }
             if($hak_d == 1)
             {
               ?>
               <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-hapus<?php echo $row->id_pekerjaan; ?>"><i class="fa fa-trash"></i>
                 Hapus
               </button>


             <?php
             }

             ?>
           </td>
           </tr>

   <?php }
   }
   ?>




               </tbody>
               <tfoot>
                 <tr>
                   <th>ID Pekerjaan</th>
                   <th>Pekerjaan</th>

                   <th>Dientri Oleh</th>
                   <th>Dientri Pada</th>
                   <th>Diedit Oleh</th>
                   <th>Diedit Pada</th>
                   <th>Opsi</th>
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
     <!-- /.row -->
   </section>
   <!-- /.content -->
 </div>


<?php
$this->load->view('includefile/foot');
?>
