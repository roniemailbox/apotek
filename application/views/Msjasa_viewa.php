<?php
include 'includefile/head.php';

if ($perintah=="Baru"){
  $action_form = 'Msjasa/tambah';
}
else {
  $action_form = 'Msjasa/edit';
}

?>

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


             <h5>ID Jasa</h5>

             <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-key"></i></span>
               <input type="text" class="form-control" placeholder="Auto" readonly>
             </div>
             <h5>Nama Jasa</h5>

             <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
               <input type="text" class="form-control" name="jasa" placeholder="Nama Jasa" required>
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
           if(isset($data_jasa_edit))
              {
                foreach ($data_jasa_edit as $row_edit)
                   { ?>

           <h5>ID Jasa</h5>

           <div class="input-group">

             <span class="input-group-addon"><i class="fa fa-key"></i></span>
             <input type="text" value="<?php echo $row_edit->id_jasa; ?>" name="id_jasa" class="form-control" placeholder="Auto" readonly>
           </div>
           <h5>Nama jasa</h5>

           <div class="input-group">

             <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
             <input type="text" value="<?php echo $row_edit->jasa; ?>" name="jasa" class="form-control" placeholder="jasa" required>
           </div>


           <?php
          }
        }
      ?>
           <!-- /input-group -->
         </div>
         <div class="box-footer">
           <a href="<?php echo site_url('Msjasa'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Input Baru</a>
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
               Cari Master Jasa
             </button>

           </div>

           <div class="modal fade" id="modal-default">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Msjasa/filter')?>">
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
                   <th>ID DUSUN</th>
                   <th>DUSUN</th>

                   <th>Dientri Oleh</th>
                   <th>Dientri Pada</th>
                   <th>Diedit Oleh</th>
                   <th>Diedit Pada</th>
                   <th>Opsi</th>
                 </tr>
               </thead>
               <tbody>
                <!--
               <a class="btn btn-mini" href="<?php //echo site_url('master/hapus_jasa/'.$row->kd_jasa);?>"
        onclick="return confirm('Anda yakin?')"> <i class="icon-remove"></i> Hapus</a> -->
   </td>
 <?php
 //ambil dari controler
 $no=1;
 if(isset($data_jasa))
    {
      foreach ($data_jasa as $row)
         { ?>

           <div class="modal fade" id="modal-<?php echo $row->id_jasa; ?>">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Msjasa/ambiledit')?>">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title">Edit Data Ini....????</h4>
                 </div>
                 <div class="modal-body">
                   <p>
                     <h5>ID Jasa</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-keyv"></i></span>
                       <input type="text" name="id_jasa" value="<?php echo $row->id_jasa; ?>" class="form-control" placeholder="Auto" readonly>
                     </div>
                     <h5>Nama Jasa</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                       <input type="text" value="<?php echo $row->jasa; ?>" class="form-control" placeholder="Jasa" readonly>
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
           <div class="modal fade" id="modal-hapus<?php echo $row->id_jasa; ?>">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Msjasa/hapus')?>">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title">Hapus Data Ini....????</h4>
                 </div>
                 <div class="modal-body">
                   <p>
                     <h5>ID Jasa</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-key"></i></span>
                       <input type="text" name="id_jasa" value="<?php echo $row->id_jasa; ?>" class="form-control" placeholder="Auto" readonly>
                     </div>
                     <h5>Nama Jasa</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                       <input type="text" value="<?php echo $row->jasa; ?>" class="form-control" placeholder="jasa" readonly>
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
           <td><?php echo $row->id_jasa; ?></td>
           <td><?php echo $row->jasa; ?></td>

           <td><?php echo $row->nama_pegawai; ?></td>
           <td><?php echo $row->entry_date; ?></td>
           <td><?php echo $row->nama_edit_pegawai; ?></td>
           <td><?php echo $row->edit_date; ?></td>

           <td>
             <?php
             if($hak_u == 1)
             {
               ?>
               <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-<?php echo $row->id_jasa; ?>"><i class="fa fa-pencil"></i>
                 Edit
               </button>

             <?php
             }
             if($hak_d == 1)
             {
               ?>
               <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-hapus<?php echo $row->id_jasa; ?>"><i class="fa fa-trash"></i>
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
                   <th>ID DUSUN</th>
                   <th>Jasa</th>

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
