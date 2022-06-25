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

          <?php include 'includefile/Pesan.php'; ?>
          <div class="box-header">

               <a href="<?php echo site_url('msJurnal/baru'); ?>" class="btn btn-block btn-primary btn-flat"><i class="fa fa-plus-square-o"></i> Input Baru</a>
               <button type="button" class="btn btn-block btn-info btn-flat" data-toggle="modal" data-target="#modal-default"><i class="fa fa-search"></i>
                 Cari Data Jurnal
               </button>

           </div>

           <div class="modal fade" id="modal-default">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('MsJurnal/filter')?>">
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
                   <th>OPSI</th>
                   <th>TGL TRANS</th>
                   <th>NO BUKTI</th>
                   <th>KD AKUN</th>
                   <th>NAMA</th>
                   <th>KETERANGAN</th>
                   <th>DEBET</th>

                   <th>KREDIT</th>
                   <th>TGL ENTRY</th>

                 </tr>
               </thead>
               <tbody>
                <!--
               <a class="btn btn-mini" href="<?php //echo site_url('master/hapus_barang/'.$row->kd_barang);?>"
        onclick="return confirm('Anda yakin?')"> <i class="icon-remove"></i> Hapus</a> -->
   </td>
 <?php
 //ambil dari controler
 $no=1;
 if(isset($data_jurnal))
    {
      foreach ($data_jurnal as $row)
         { ?>

         <tr>
           <td>
           <?php
           //echo $hak_u;
            if($hak_u == 1)
           {
             ?>
             <a href="<?php echo site_url('Jurnal/ambiledit/'.$row->no_bukti);?>" class="btn btn-info btn-xs"
             onclick="return confirm('Anda yakin edit data ini....????')"> <i class="fa fa-pencil"></i> Edit</a>


           <?php
           }
           ?>
         </td>
          <td><?php echo $row->tgl_trans; ?></td>
           <td><?php echo $row->no_bukti; ?></td>
           <td><?php echo $row->kd_akun; ?></td>
           <td><?php echo strtoupper($row->nama); ?></td>
           <td><?php echo $row->keterangan; ?></td>
           <td align="right"><?php echo number_format($row->jml_D,2); ?></td>
           <td align="right"><?php echo number_format($row->jml_K,2); ?></td>

           <td><?php echo $row->entry_date; ?></td>
        </tr>

   <?php }
   }
   ?>




               </tbody>
               <tfoot>
               <tr>
                 <th>OPSI</th>
                 <th>TGL TRANS</th>
                 <th>NO BUKTI</th>
                 <th>KD AKUN</th>
                 <th>NAMA</th>
                 <th>KETERANGAN</th>
                 <th>DEBET</th>

                 <th>KREDIT</th>
                 <th>TGL ENTRY</th>


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

     <div class="row">
       <div class="col-md-3 col-sm-6 col-xs-12">
         <div class="info-box">
           <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

           <div class="info-box-content">
             <span class="info-box-text">Messages</span>
             <span class="info-box-number">1,410</span>
           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
       </div>
       <!-- /.col -->
       <div class="col-md-3 col-sm-6 col-xs-12">
         <div class="info-box">
           <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>

           <div class="info-box-content">
             <span class="info-box-text">Bookmarks</span>
             <span class="info-box-number">410</span>
           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
       </div>
       <!-- /.col -->
       <div class="col-md-3 col-sm-6 col-xs-12">
         <div class="info-box">
           <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

           <div class="info-box-content">
             <span class="info-box-text">Uploads</span>
             <span class="info-box-number">13,648</span>
           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
       </div>
       <!-- /.col -->
       <div class="col-md-3 col-sm-6 col-xs-12">
         <div class="info-box">
           <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>

           <div class="info-box-content">
             <span class="info-box-text">Likes</span>
             <span class="info-box-number">93,139</span>
           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
       </div>
       <!-- /.col -->
     </div>

   </section>
   <!-- /.content -->
 </div>


<?php
$this->load->view('includefile/foot');
?>
