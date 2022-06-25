<?php
include 'includefile/head.php';
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
       <li><a href="<?php echo site_url('Utama') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
       <li><a href="#"><?php echo $xmenu ?></a></li>
       <li class="active"><?php echo $xsubmenu ?></li>
     </ol>
   </section>
   <!-- Main content -->
   <section class="content">
     <div class="row">
       <div class="col-xs-12">


         <div class="box">

          <?php //include 'template/Pesan.php'; ?>
           <div class="box-header">

               <a href="<?php echo site_url('msunit/baru'); ?>" class="btn btn-block btn-primary btn-flat"><i class="fa fa-plus"></i> Input Baru</a>
             <!-- <a href="<?php //echo site_url('mspegawai/exportexcel'); ?>" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export To Excel</a> -->
             <button type="button" class="btn btn-block btn-info btn-flat" data-toggle="modal" data-target="#modal-default"><i class="fa fa-search"></i>
               Cari Master unit
             </button>

           </div>

           <div class="modal fade" id="modal-default">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Msunit/filter')?>">
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
                   <th>Kode Unit</th>
                   <th>Nama Unit</th>
                   <th>Alamat</th>
                   <th>Kota</th>
                   <th>Telepon</th>
                   <th>Fax</th>
                   <th>Email</th>
                   <th>Dientri Oleh</th>
                   <th>Dientri Pada</th>

                 </tr>
               </thead>
               <tbody>
                <!--
               <a class="btn btn-mini" href="<?php //echo site_url('master/hapus_unit/'.$row->kd_unit);?>"
        onclick="return confirm('Anda yakin?')"> <i class="icon-remove"></i> Hapus</a> -->
   </td>
 <?php
 //ambil dari controler
 $no=1;
 if(isset($data_unit))
    {
      foreach ($data_unit as $row)
         { ?>

           <tr>
             <td>
               <?php
               if($hak_u == 1)
               {
                 ?>

                 <a href="<?php echo site_url('Msunit/ambiledit/'.$row->kd_unit);?>" class="btn btn-info btn-xs"
                 onclick="return confirm('Anda yakin mengedit data ini....????')"> <i class="fa fa-pencil"></i> Edit</a>

               <?php
               }
               if($hak_d == 1)
               {
                 ?>
                 <a href="<?php echo site_url('Msunit/hapus/'.$row->kd_unit);?>" class="btn btn-danger btn-xs"
                 onclick="return confirm('Anda yakin menghapus data ini....????')"> <i class="fa fa-trash"></i> Hapus</a>
               <?php
               }

               ?>
             </td>
           <td><?php echo $row->kd_unit; ?></td>
           <td><?php echo $row->nama_unit; ?></td>
           <td><?php  echo $row->alamat_unit; ?></td>
           <td><?php echo $row->nama_kota; ?></td>
           <td><?php echo $row->telepon; ?></td>
           <td><?php echo $row->fax; ?></td>
           <td><?php echo $row->email; ?></td>
           <td><?php echo $row->nama_pegawai; ?></td>
           <td><?php echo $row->entry_date; ?></td>


           </tr>

   <?php }
   }
   ?>




               </tbody>
               <tfoot>
                 <tr>
                   <th>Opsi</th>
                   <th>Kode Unit</th>
                   <th>Nama Unit</th>
                   <th>Alamat</th>
                   <th>Kota</th>
                   <th>Telepon</th>
                   <th>Fax</th>
                   <th>Email</th>
                   <th>Dientri Oleh</th>
                   <th>Dientri Pada</th>
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
