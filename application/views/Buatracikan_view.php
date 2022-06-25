<?php include 'includefile/head.php'; ?>

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
            <?php
            if($hak_c == 1)
            { ?>
               <a href="<?php echo site_url('Buatresep/baru'); ?>" class="btn btn-block btn-primary btn-flat"><i class="fa fa-plus-square-o"></i> Input Baru</a>

            <?php }
            if($hak_r == 1)
            { ?>
               <button type="button" class="btn btn-block btn-info btn-flat" data-toggle="modal" data-target="#modal-default"><i class="fa fa-search"></i>
                 Cari Data Penjualan
               </button>
             <?php } ?>
             <!-- <a href="<?php //echo site_url('mspegawai/exPurtexcel'); ?>" class="btn btn-success"><i class="fa fa-file-excel-o"></i> ExPurt To Excel</a> -->

           </div>

           <div class="modal fade" id="modal-default">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="Pust" action="<?php echo site_url('Buatresep/filter')?>">
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
           <?php
           if($hak_r == 1)
           {
            ?>
           <div class="box-body">
             <table id="example2" class="table table-bordered table-striped nowrap"  cellspacing="0" width="100%">
               <thead>
                 <tr>
                   <th>Opsi</th>
                   <th>No Bukti</th>
                   <th>Tanggal</th>
                   <th>Customer</th>
                   <th>Bayar</th>
                   <th>Ppn</th>
                   <th>Unit Transaksi</th>
                   <th>Sub Total</th>
                   <th>Dpp</th>
                   <th>Ppn</th>
                   <th>Total</th>
                   <th>Input Oleh</th>
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
   if(isset($data_pu))
      {
        foreach ($data_pu as $row)
           { ?>

           <tr>
             <td>
               <?php
               if($hak_u == 1)
               {
                 if(empty($row->no_bpb))
                 {
                    ?>
                    <a href="<?php echo site_url('Buatresep/ambil_edit/'.$row->no_bukti);?>" class="btn btn-info btn-xs"
                    onclick="return confirm('Anda yakin edit data <?php echo $row->no_bukti; ?> ini....????')"> <i class="fa fa-pencil"></i> Edit</a>

                    <?php
                   }

               }
               if($hak_d == 1)
               {
                 if(empty($row->no_bpb))
                 {
                    ?>
                    <a href="<?php echo site_url('Buatresep/hapus/'.$row->no_bukti);?>" class="btn btn-danger btn-xs"
                    onclick="return confirm('Anda yakin menghapus data <?php echo $row->no_bukti; ?> ini....????')"> <i class="fa fa-trash"></i> Hapus</a>

                    <?php
                   }

               }
               if($hak_p == 1)
               {
                 ?>
                 <a href="<?php echo site_url('Buatresep/cetak/'.$row->no_bukti);?>" class="btn btn-success btn-xs" target="_blank"> <i class="fa fa-print"></i> Cetak</a>
               <?php
               }

               ?>

             </td>
           <td><?php echo $row->no_bukti; ?></td>

           <td><?php echo $row->tgl_trans; ?></td>
           <td><?php echo $row->nama_customer; ?></td>
           <td><?php echo $row->jenis_bayar; ?></td>
           <td><?php echo $row->jenis_ppn; ?></td>
           <td><?php echo $row->nama_sub_unit; ?></td>
           <td align="right"><?php echo number_format($row->dpp+$row->ppn+$row->diskon); ?></td>
           <td align="right"><?php echo number_format($row->dpp); ?></td>
           <td align="right"><?php echo number_format($row->ppn); ?></td>

           <td align="right"><?php echo number_format($row->total); ?></td>

           <td><?php echo $row->nama_pegawai; ?></td>



           </tr>

     <?php }
     }
     ?>



               </tbody>
               <tfoot>
                 <tr>
                   <th>Opsi</th>
                   <th>No Bukti</th>

                   <th>Tanggal</th>
                   <th>Customer</th>
                   <th>Bayar</th>
                   <th>Ppn</th>
                   <th>Unit Transaksi</th>
                   <th>Sub Total</th>
                   <th>Dpp</th>
                   <th>Ppn</th>

                   <th>Total</th>
                   <th>Input Oleh</th>

                 </tr>
               </tfoot>
             </table>


           </div>
           <?php
              }
            ?>
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



<?php include 'includefile/foot.php'; ?>
