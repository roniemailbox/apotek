<?php include 'includefile/Header.php'; ?>


   <!-- page content -->
 <div class="right_col" role="main">
     <div class="">


     <div class="clearfix">

     </div>

       <div class="row">
         <div class="col-md-12 col-sm-6 col-xs-12">
                 <div class="x_panel">
                 <div class="x_title">
                 <h2><i class="fa fa-align-left"></i> Daftar Pembelian <small>Pembelian</small></h2>
                 <ul class="nav navbar-right panel_toolbox"> <?php if($hak_c == 1) { ?>


        			          <a href="<?php echo site_url('Bpb/bpbpo'); ?>" class="btn btn-primary"><i class="fa fa-plus-square-o"></i> Pembelian dengan PO</a>
                         <a href="<?php echo site_url('Bpb/bpbnonpo'); ?>" class="btn btn-info"><i class="fa fa-plus-square-o"></i> Pembelian Non PO</a>



                 <?php } ?>
                 <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                 </li>


                 </ul>
                 <div class="clearfix"></div>
                 </div>
                 <div class="x_content">
   <?php include 'includefile/Pesan.php'; ?>

                         <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                 <div class="panel">
                                 <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                 <h4 class="panel-title">Daftar Pembelian</h4>

                                 </a>
                                         <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                         <div class="panel-body">
                                           <?php if($hak_r == 1) { ?>
                                           <table id="datatable-buttons" class="table table-striped table-bordered"  cellspacing="0" width="100%">
                                             <thead>
                                               <tr>

                                                 <th>No Bukti</th>
                                                 <th>Tipe</th>
                                                 <th>No Ref / PO</th>
                                                 <th>Tanggal</th>
                                                 <th>Supplier</th>
                                                 <th>Dpp</th>
                                                 <th>Ppn</th>
                                                 <th>Total</th>
                                                 <th>Keterangan</th>

                                                 <th>Opsi</th>
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
                                           if(isset($data_bpb))
                                           {
                                           foreach ($data_bpb as $row)
                                           { ?>

                                           <tr>

                                           <td><?php echo $row->no_bukti; ?></td>
                                           <td><?php echo $row->tipe; ?></td>
                                           <td><?php echo $row->no_ref; ?></td>
                                           <td><?php echo $row->tgl_trans; //echo $row->tgl_trans; ?></td>
                                           <td><?php echo $row->nama_supplier; ?></td>
                                           <td align="right"><?php echo currency_format($row->dpp); ?></td>
                                           <td align="right"><?php echo currency_format($row->ppn); ?></td>
                                           <td align="right"><?php echo currency_format($row->total); ?></td>
                                           <td><?php echo $row->keterangan; ?></td>

                                           <td>
                                           <?php
                                           $xno_bukti = str_replace('/', '_', $row->no_bukti);
                                           if($hak_u == 1)
                                           {
                                           ?>

                                           <a href="<?php echo site_url('Bpb/edit/'.$xno_bukti);?>" class="btn btn-info btn-xs"
                                           onclick="return confirm('Anda yakin edit data <?php echo $row->no_bukti; ?> ini....????')"> <i class="fa fa-pencil"></i> Edit</a>

                                           <?php
                                           }
                                           if($hak_d == 1)
                                           {
                                           ?>
                                           <a href="<?php echo site_url('Bpb/hapus/'.$xno_bukti);?>" class="btn btn-danger btn-xs"
                                           onclick="return confirm('Anda yakin menghapus data <?php echo $row->no_bukti; ?> ini....????')"> <i class="fa fa-trash"></i> Hapus</a>
                                           <?php
                                           }
                                           if($hak_p == 1)
                                           {
                                           ?>
                                           <a href="<?php echo site_url('Bpb/cetak/'.$xno_bukti);?>" class="btn btn-success btn-xs" target="_blank"> <i class="fa fa-print"></i> Cetak</a>
                                           <?php
                                           }

                                           ?>

                                           </td>
                                           </tr>

                                           <?php }
                                           }
                                           ?>




                                             </tbody>
                                           </table>
                                           <?php } ?>

                                         </div>
                                         </div>
                                 </div>


                         </div>

                 </div>
                 </div>
         </div>


       </div>
     </div>
     </div>

       <!-- /page content -->



<?php include 'includefile/Footer.php'; ?>
