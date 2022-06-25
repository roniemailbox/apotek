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

     </ol>
   </section>
   <!-- Main content -->
   <section class="content">




     <div class="row">
       <div class="col-xs-12">


         <div class="box">

          <?php //include 'template/Pesan.php'; ?>
          <div class="box-header">

            <div class="form-group">
              <?php
              if($hak_c == 1)
              {
                ?>
            <div class="col-md-3">
              <a href="<?php echo site_url('Msdetailbarang/baru'); ?>" class="btn btn-block btn-social btn-github"> <i class="fa fa-plus"></i> Input Baru </a>

            </div>
            <?php
              }
              ?>
            <div class="col-md-3">

              <button type="button" class="btn btn-block btn-social btn-vk" data-toggle="modal" data-target="#modal-default"><i class="fa fa-search"></i> Cari Master Barang </button>

            </div>
            <?php
            if($hak_r == 1)
            {
              ?>

            <div class="col-md-3">

               <a href="<?php echo site_url('Msdetailbarang/exportexcel'); ?>" class="btn btn-block btn-social btn-dropbox"><i class="fa fa-file-excel-o"></i> Download Master Barang Unit</a>

            </div>
            <div class="col-md-3">
               <a href="<?php echo site_url('Msbarang/exportexcel'); ?>" class="btn btn-block btn-social btn-dropbox"> <i class="fa fa-file-excel-o"></i> Download Semua Master Barang </a>
            </div>

            <?php
              }
              ?>

            </div>
           </div>

           <div class="modal fade" id="modal-default">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Msdetailbarang/filter')?>">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title">Filter Pencarian</h4>
                 </div>
                 <div class="modal-body">
                   <p>
                     <div class="input-group">
                     <span class="input-group-addon"><i class="fa fa-key"></i></span>
                     <input type="hidden" name="kd_sub_unit" value="
                     <?php
                     $id = get_cookie('tkkop');
                     $ses_kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
                     echo $ses_kd_sub_unit;
                      ?>
                      " class="form-control" placeholder="Kata Kunci" required>
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

             <?php
             if($hak_r == 1)
             {
               ?>

             <table id="example2" class="table table-bordered table-striped nowrap"  cellspacing="0" width="100%">
               <thead>
                 <tr>
                   <th>Opsi</th>
                   <th>Unit</th>
                   <th>Kode Barang</th>
                   <th>Nama Produk</th>
                   <th>Barcode</th>
                   <th>Harga Beli</th>
 				           <th>Harga Jual</th>
                   <th>% Margin</th>
                   <th>Margin</th>
                   <th>Supplier</th>
                   <th>Min</th>
                   <th>Max</th>
                   <th>Lokasi</th>
                   <th>Rak</th>
                   <th>Kategori</th>
 				           <th>Satuan</th>
                   <th>Ppn</th>
                   <th>Jenis</th>
                   <th>Merk</th>
                   <th>Tipe</th>
                   <th>Sub Unit</th>
                   <th>Keterangan</th>


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
 if(isset($data_barang))
    {
      foreach ($data_barang as $row)
         { ?>

           <tr>
             <td>
               <?php
               if($hak_u == 1)
               {
                 ?>

                 <a href="<?php echo site_url('Msdetailbarang/ambiledit/'.$row->id_barang.'/'.$row->kd_sub_unit);?>" class="btn btn-info btn-xs"
                 onclick="return confirm('Anda yakin mengedit data ini....????')"> <i class="fa fa-pencil"></i> Edit</a>

               <?php
               }
               if($hak_d == 1)
               {
                 ?>
                 <a href="<?php echo site_url('Msdetailbarang/hapus/'.$row->id_barang.'/'.$row->kd_sub_unit);?>" class="btn btn-danger btn-xs"
                 onclick="return confirm('Anda yakin menghapus data ini....????')"> <i class="fa fa-trash"></i> Hapus</a>
               <?php
               }
               if($hak_p == 1)
               {
                 ?>
                 <a href="<?php echo site_url('Msdetailbarang/histori/'.$row->id_barang.'/'.$row->kd_sub_unit);?>" class="btn btn-success btn-xs"
                 onclick="return confirm('Melihat Histori data ini....????')"> <i class="fa fa-print"></i> Histori</a>
               <?php
               }
               ?>
             </td>
             <td><?php echo $row->nama_unit; ?></td>
           <td><?php echo $row->id_barang; ?></td>

           <td><?php echo $row->nama_barang; ?></td>

           <td><?php  echo $row->barcode; ?></td>

           <td align="right"><?php echo number_format($row->hb,2); ?></td>
           <td align="right"><?php  echo number_format($row->hj,2); ?></td>
           <td align="right"><?php echo  number_format($row->perc_margin,2); ?></td>
           <td align="right"><?php echo number_format($row->margin); ?></td>
            <td><?php echo $row->nama_supplier; ?></td>
            <td><?php echo $row->min; ?></td>
            <td><?php echo $row->max; ?></td>
            <td><?php echo $row->lokasi; ?></td>
            <td><?php echo $row->rak; ?></td>

           <td><?php echo $row->nama_kategori; ?></td>
           <td><?php  echo $row->nama_satuan; ?></td>
           <td><?php echo  $row->ppn; ?></td>
            <td><?php echo $row->nama_jenis; ?></td>
            <td><?php echo $row->merk; ?></td>
            <td><?php echo $row->nama_tipe; ?></td>
            <td><?php echo $row->nama_sub_unit; ?></td>
            <td><?php echo $row->keterangan; ?></td>

           </tr>

   <?php }
   }
   ?>




               </tbody>
               <tfoot>
                 <tr>
                   <th>Opsi</th>
                   <th>Unit</th>
                   <th>Kode Barang</th>
                   <th>Nama Produk</th>
                   <th>Barcode</th>
                   <th>Harga Beli</th>
 				           <th>Harga Jual</th>
                   <th>% Margin</th>
                   <th>Margin</th>
                   <th>Supplier</th>
                   <th>Min</th>
                   <th>Max</th>
                   <th>Lokasi</th>
                   <th>Rak</th>
                   <th>Kategori</th>
 				           <th>Satuan</th>
                   <th>Ppn</th>
                   <th>Jenis</th>
                   <th>Merk</th>
                   <th>Tipe</th>
                   <th>Sub Unit</th>
                   <th>Keterangan</th>


                 </tr>
               </tfoot>
             </table>
             <?php
                }
               ?>

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
