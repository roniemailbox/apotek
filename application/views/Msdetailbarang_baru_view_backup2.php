<?php include 'includefile/head.php'; ?>

<?php
$action_form = 'Msdetailbarang/tambah';
?>

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

      <!-- /.row -->
<form class="form-horizontal form-label-left" method="post" action="<?=site_url($action_form)?>" >
     <div class="row">
       <!-- left column -->
       <div class="col-md-6">
         <div class="box box-info">
             <div class="box-header with-border">
               <h3 class="box-title">Data Barang</h3>
             </div>
     <!-- /.box-header -->
     <!-- form start -->

                 <div class="box-body">


                   <div class="form-group">
                     <script type="text/javascript">
                         $(document).ready(function() {

                             $("#id_barang").change(function(){
                                var id_barang = $("#id_barang").val();
                                 //alert(id_barang);
                                 var id_barang = $("#id_barang").val();
                                 $.ajax({
                                     type: "POST",
                                     url: "<?php echo base_url('index.php/Msdetailbarang/get_data'); ?>",
                                     data: "id_barang="+id_barang,
                                     cache:false,
                                     success: function(data){
                                       $('#tampil').html(data);
                                     }

                                 });

                               }

                            );

                         })
                     </script>
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Filter
                      </label>

                        <div class="col-md-8 col-xs-12">
                          <select class="select2 form-control" id="id_barang" name=" id_barang" required>
                            <option value="">-- Pilih --</option>
                            <?php foreach ($data_barang as $row)
                            {
                              echo '<option value="'.$row->id_barang.'">'.$row->ket.'</option>';
                            }
                            ?>
                          </select>
                        </div>

                    </div>

                    <div id="tampil"></div>




                 </div>
                 <!-- /.box-body -->
                 <div class="box-footer">
                   <h4 class="box-title">Selanjutnya.....</h4>
                 </div>
                 <!-- /.box-footer -->

             </div>

       </div>

       <div class="col-md-6">
         <div class="box box-info">
             <div class="box-header with-border">
               <h3 class="box-title">Informasi Lanjutan</h3>
             </div>
     <!-- /.box-header -->
     <!-- form start -->

                 <div class="box-body">

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Sub Unit
                      </label>

                        <div class="col-md-6 col-xs-12">
                          <select class="select2 form-control" name="kd_sub_unit" required disabled>
                            <?php foreach ($data_sub_unit as $row)
                            { ?>
                            <option value=<?php echo $row->kd_sub_unit ?>"><?php echo $row->nama_sub_unit ?></option>
                            <?php } ?>
                            <?php foreach ($data_sub_unit as $row)
                            {
                              echo '<option value="'.$row->kd_sub_unit.'">'.$row->nama_sub_unit.'</option>';
                            }
                            ?>
                          </select>
                        </div>

                    </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Supplier
                      </label>

                        <div class="col-md-6 col-xs-12">
                          <select class="select2 form-control" name="id_supplier" required>
                            <option value=""></option>
                            <?php foreach ($data_supplier as $row)
                            {
                              echo '<option value="'.$row->id_supplier.'">'.$row->nama.'</option>';
                            }
                            ?>
                          </select>
                        </div>

                    </div>



                   <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Harga Beli
                     </label>
                     <div class="col-md-4 col-sm-6 col-xs-12">
                       <div class="input-group date">
                       <div class="input-group-addon">
                         <i class="fa fa-money"></i>
                       </div>
                       <input class="form-control col-md-8 col-xs-12" id="hb" name="hb" placeholder="Harga Beli" type="number" step="Any">
                       </div>
                     </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Harga Jual
                      </label>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-money"></i>
                        </div>
                        <input class="form-control col-md-8 col-xs-12" id="hj" name="hj" placeholder="Harga Jual" type="number" step="Any">
                        </div>
                      </div>
                     </div>

                     <div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Margin
                       </label>
                       <div class="col-md-4 col-sm-6 col-xs-12">
                         <div class="input-group date">
                         <div class="input-group-addon">
                           <i class="fa fa-money"></i>
                         </div>
                         <input class="form-control col-md-8 col-xs-12" id="margin" name="margin" placeholder="Margin" type="number" step="Any">
                         </div>
                       </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">% Up
                        </label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-arrow-circle-o-up"></i>
                          </div>
                          <input class="form-control col-md-8 col-xs-12" id="perc_margin" name="perc_margin" placeholder="Margin" type="number" step="Any">
                          </div>
                        </div>
                       </div>


                       <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Min
                         </label>
                         <div class="col-md-3 col-sm-6 col-xs-12">
                           <input class="form-control col-md-4 col-xs-12" name="min" placeholder="Stok Minimal" type="number">
                         </div>
                       </div>
                       <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Max
                         </label>
                         <div class="col-md-3 col-sm-6 col-xs-12">
                           <input class="form-control col-md-4 col-xs-12" name="max" placeholder="Stok Maksimal" type="number">
                         </div>
                       </div>

                       <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Lokasi
                         </label>
                         <div class="col-md-4 col-sm-6 col-xs-12">
                           <input class="form-control col-md-7 col-xs-12" name="lokasi" placeholder="Lokasi" type="text">
                         </div>
                       </div>

                       <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Rak
                         </label>
                         <div class="col-md-4 col-sm-6 col-xs-12">
                           <input id="name" class="form-control col-md-7 col-xs-12" name="rak" placeholder="Rak" type="text">
                         </div>
                       </div>


                   <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Keterangan
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                       <input id="name" class="form-control col-md-7 col-xs-12" name="ktp" placeholder="Keterangan" type="text">
                     </div>
                   </div>


                 </div>
                 <!-- /.box-body -->
                 <div class="box-footer">

                   <button type="submit" class="btn btn-info pull-right">Simpan</button>
                 </div>
                 <!-- /.box-footer -->

             </div>

       </div>
       <!--/.col (left) -->
       <!-- right column -->

       <!--/.col (right) -->
     </div>

   </form>
     <!-- /.row -->
   </section>
   <!-- /.content -->
 </div>


<?php include 'includefile/foot.php'; ?>
