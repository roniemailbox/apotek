<?php include 'includefile/head.php'; ?>

<?php
if ($perintah=="Baru"){
  $action_form = 'Msdetailbarang/tambah';
}
else {
  $action_form = 'Msdetailbarang/edit';
}

?>
<link href="<?=base_url('/')?>assets/css/style_auto.css" rel="stylesheet">
<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery-1.8.2.min.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.autocomplete.js'></script>

<script type='text/javascript'>
            var jq_auto = $.noConflict(true);
            var site = "<?php echo site_url();?>";
            jq_auto(function(){
              //alert("saa");
              jq_auto('.partsearch').autocomplete({
                // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
                serviceUrl: site+'/autocomplete/item_detail_barang',
                //serviceUrl: site+'/autocomplete/item_po',
                // fungsi ini akan dijalankan ketika user memilih salah satu hasil request
                onSelect: function (suggestion) {
                  jq_auto('#id_barang').val(''+suggestion.id_barang);
                  jq_auto('#nama_barang').val(''+suggestion.nama_barang);
                  jq_auto('#barcode').val(''+suggestion.barcode);
                  jq_auto('#nama_alias').val(''+suggestion.nama_alias);
                  jq_auto('#ppn').val(''+suggestion.ppn);
                  jq_auto('#nama_kategori').val(''+suggestion.nama_kategori);
                  jq_auto('#merk').val(''+suggestion.merk);
                  jq_auto('#jenis').val(''+suggestion.jenis);
                  jq_auto('#tipe').val(''+suggestion.tipe);
                  jq_auto('#hb').val(''+suggestion.hb);
                  jq_auto('#hj').val(''+suggestion.hj);
                  document.getElementById("qty").focus();
                }
              });
            });
</script>
<script type="text/javascript">

    function LPS() {
      document.getElementById('filterbarang').value='';
      document.getElementById('id_barang').value='';
      document.getElementById('nama_barang').value='';
      document.getElementById('barcode').value='';
      document.getElementById('nama_alias').value='';
      document.getElementById('ppn').value='';
      document.getElementById('nama_kategori').value='';
      document.getElementById('merk').value='';
      document.getElementById('jenis').value='';
      document.getElementById('tipe').value='';
      document.getElementById('hb').value='0';
      document.getElementById('hj').value='0';
      document.getElementById('satuan').value='';
      document.getElementById('filterbarang').focus();
    }
    </script>


    <script type="text/javascript">
        $(document).ready(function() {

                $("#hb").change(function(){
                var hb = parseFloat(document.getElementById("hb").value);
                var hj = parseFloat(document.getElementById("hj").value);
                //var qty = parseFloat(document.getElementById("qty").value);
                //var diskon = parseFloat(document.getElementById("diskon").value);
                //var nilaippn = parseFloat(document.getElementById("nilaippn").value);
                //perc_diskon=diskon/dpp*100;
                margin=hj-hb;
                document.getElementById('margin').value = margin;
                perc_margin=(hj-hb)/hb*100;
                document.getElementById('perc_margin').value = perc_margin;

                });
                $("#hj").change(function(){
                var hb = parseFloat(document.getElementById("hb").value);
                var hj = parseFloat(document.getElementById("hj").value);
                //var qty = parseFloat(document.getElementById("qty").value);
                //var diskon = parseFloat(document.getElementById("diskon").value);
                //var nilaippn = parseFloat(document.getElementById("nilaippn").value);
                //perc_diskon=diskon/dpp*100;
                margin=hj-hb;
                document.getElementById('margin').value = margin;
                perc_margin=(hj-hb)/hb*100;
                document.getElementById('perc_margin').value = perc_margin;

                });

        })
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

   <!-- Main content -->
   <section class="content">

      <!-- /.row -->
<form class="form-horizontal form-label-left" method="post" action="<?=site_url($action_form)?>" >
  <?php if($perintah=="Baru")
  {
    ?>


     <div class="row">
       <!-- left column -->
       <div class="col-md-6">
         <div class="box box-info">
             <div class="box-header with-border">
               <h3 class="box-title">Data Barang <?php echo $perintah; ?></h3>
             </div>
     <!-- /.box-header -->
     <!-- form start -->

                 <div class="box-body">


                   <div class="form-group">

                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Filter
                      </label>

                        <div class="col-md-8 col-xs-12">
                          <input onclick="LPS()" style="background:#AEC791;" class="partsearch form-control col-md-12 col-xs-12" name="filterbarang" type="text" id="filterbarang" placeholder="Pencarian Barang"/>
                        </div>

                    </div>
                    <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">ID Barang</label>

                                <div class="col-md-4 col-sm-6 col-xs-12">
                                        <input class="form-control col-md-4 col-xs-12" value="<?php //echo $row->barcode; ?>" id="id_barang" placeholder="Id Barang" type="text" name="id_barang" readonly>
                                </div>
                    </div>


                            <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Barcode</label>

                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-4 col-xs-12" value="<?php //echo $row->barcode; ?>" id="barcode" placeholder="Barcode" type="text" name="barcode" readonly>
                                        </div>
                            </div>

                               <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Barang
                                        </label>
                                        <div class="col-md-8 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-8 col-xs-12" id="nama_barang" value="<?php //echo $row->nama_barang; ?>" placeholder="Nama Produk" type="text" name="nama" readonly>
                                        </div>
                               </div>
                               <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Alias
                                        </label>
                                        <div class="col-md-8 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-8 col-xs-12" id="nama_alias" value="<?php //echo $row->nama_alias; ?>" placeholder="Nama Alias"ctype="text" name="nama_alias" readonly>
                                        </div>
                               </div>



                               <div class="form-group">
                                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Ppn</label>

                                           <div class="col-md-4 col-sm-6 col-xs-12">
                                                   <input class="form-control col-md-4 col-xs-12" value="<?php //echo $row->barcode; ?>" id="ppn" placeholder="Ppn" type="text" name="barcode" readonly>
                                           </div>
                               </div>

                               <div class="form-group">
                                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Kategori</label>

                                           <div class="col-md-4 col-sm-6 col-xs-12">
                                                   <input class="form-control col-md-4 col-xs-12" value="<?php //echo $row->barcode; ?>" id="nama_kategori" placeholder="Kategori" type="text" name="barcode" readonly>
                                           </div>
                               </div>
                               <div class="form-group">
                                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Merk</label>

                                           <div class="col-md-4 col-sm-6 col-xs-12">
                                                   <input class="form-control col-md-4 col-xs-12" value="<?php //echo $row->barcode; ?>" id="merk" placeholder="Merk" type="text" name="barcode" readonly>
                                           </div>
                               </div>

                               <div class="form-group">
                                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis</label>

                                           <div class="col-md-4 col-sm-6 col-xs-12">
                                                   <input class="form-control col-md-4 col-xs-12" value="<?php //echo $row->barcode; ?>" id="nama_jenis" placeholder="Jenis" type="text" name="barcode" readonly>
                                           </div>
                               </div>

                               <div class="form-group">
                                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipe</label>

                                           <div class="col-md-4 col-sm-6 col-xs-12">
                                                   <input class="form-control col-md-4 col-xs-12" value="<?php //echo $row->barcode; ?>" id="nama_tipe" placeholder="Tipe" type="text" name="barcode" readonly>
                                           </div>
                               </div>



                               <div class="form-group">
                                 <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Harga Beli</label>
                                 <div class="col-md-4 col-sm-6 col-xs-12">

                                    <input placeholder="Harga Beli" class="form-control col-md-4 col-xs-12" value="<?php //echo $row->keterangan; ?>" type="number" name="harga_beli" readonly>
                                 </div>
                               </div>
                               <div class="form-group">
                                 <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Harga Jual</label>
                                 <div class="col-md-4 col-sm-6 col-xs-12">
                                    <input placeholder="Harga Jual" class="form-control col-md4 col-xs-12" value="<?php //echo $row->keterangan; ?>" type="number" name="harga_jual" readonly>
                                 </div>
                               </div>

                               <div class="form-group">
                                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Satuan</label>

                                           <div class="col-md-4 col-sm-6 col-xs-12">
                                                   <input class="form-control col-md-4 col-xs-12" value="<?php //echo $row->barcode; ?>" id="satuan" placeholder="Satuan" type="text" name="barcode" readonly>
                                           </div>
                               </div>




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
                          <select class="select2 form-control" name="kd_sub_unit" required>

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
                            <option value="">-- Pilih --</option>
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

                       <textarea id="keterangan" placeholder="Keterangan" class="form-control" name="keterangan"><?php //echo $row->alamat; ?></textarea>
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

<!-- xx -->
<?php
}
else {


if(isset($data_barang))
   {
     foreach ($data_barang as $row)
        {  ?>

<div class="row">
  <!-- left column -->
  <div class="col-md-6">
    <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Data Barang <?php echo $perintah; ?></h3>
        </div>
<!-- /.box-header -->
<!-- form start -->

            <div class="box-body">


              <div class="form-group">

                 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Filter
                 </label>

                   <div class="col-md-8 col-xs-12">
                     <input onclick="LPS()" style="background:#AEC791;" class="partsearch form-control col-md-12 col-xs-12" name="filterbarang" type="text" id="filterbarang" placeholder="Pencarian Barang" disabled/>
                   </div>

               </div>
               <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">ID Barang</label>

                           <div class="col-md-4 col-sm-6 col-xs-12">
                                   <input class="form-control col-md-4 col-xs-12" value="<?php echo $row->id_barang; ?>" id="id_barang" placeholder="Id Barang" type="text" name="id_barang" readonly>
                           </div>
               </div>


                       <div class="form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Barcode</label>

                                   <div class="col-md-4 col-sm-6 col-xs-12">
                                           <input class="form-control col-md-4 col-xs-12" value="<?php echo $row->barcode; ?>" id="barcode" placeholder="Barcode" type="text" name="barcode" readonly>
                                   </div>
                       </div>

                          <div class="form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Barang
                                   </label>
                                   <div class="col-md-8 col-sm-6 col-xs-12">
                                           <input class="form-control col-md-8 col-xs-12" id="nama_barang" value="<?php echo $row->nama_barang; ?>" placeholder="Nama Produk" type="text" name="nama" readonly>
                                   </div>
                          </div>
                          <div class="form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Alias
                                   </label>
                                   <div class="col-md-8 col-sm-6 col-xs-12">
                                           <input class="form-control col-md-8 col-xs-12" id="nama_alias" value="<?php  echo $row->nama_alias; ?>" placeholder="Nama Alias"ctype="text" name="nama_alias" readonly>
                                   </div>
                          </div>



                          <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Ppn</label>

                                      <div class="col-md-4 col-sm-6 col-xs-12">
                                              <input class="form-control col-md-4 col-xs-12" value="<?php  echo $row->ppn; ?>" id="ppn" placeholder="Ppn" type="text" name="barcode" readonly>
                                      </div>
                          </div>

                          <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Kategori</label>

                                      <div class="col-md-4 col-sm-6 col-xs-12">
                                              <input class="form-control col-md-4 col-xs-12" value="<?php  echo $row->nama_kategori; ?>" id="nama_kategori" placeholder="Kategori" type="text" name="barcode" readonly>
                                      </div>
                          </div>
                          <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Merk</label>

                                      <div class="col-md-4 col-sm-6 col-xs-12">
                                              <input class="form-control col-md-4 col-xs-12" value="<?php  echo $row->merk; ?>" id="merk" placeholder="Merk" type="text" name="barcode" readonly>
                                      </div>
                          </div>

                          <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis</label>

                                      <div class="col-md-4 col-sm-6 col-xs-12">
                                              <input class="form-control col-md-4 col-xs-12" value="<?php  echo $row->nama_jenis; ?>" id="nama_jenis" placeholder="Jenis" type="text" name="barcode" readonly>
                                      </div>
                          </div>

                          <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipe</label>

                                      <div class="col-md-4 col-sm-6 col-xs-12">
                                              <input class="form-control col-md-4 col-xs-12" value="<?php  echo $row->nama_tipe; ?>" id="nama_tipe" placeholder="Tipe" type="text" name="barcode" readonly>
                                      </div>
                          </div>



                          <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Harga Beli</label>
                            <div class="col-md-4 col-sm-6 col-xs-12">

                               <input placeholder="Harga Beli" class="form-control col-md-4 col-xs-12" value="<?php //echo $row->keterangan; ?>" type="number" name="harga_beli" readonly>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Harga Jual</label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                               <input placeholder="Harga Jual" class="form-control col-md4 col-xs-12" value="<?php //echo $row->keterangan; ?>" type="number" name="harga_jual" readonly>
                            </div>
                          </div>

                          <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Satuan</label>

                                      <div class="col-md-4 col-sm-6 col-xs-12">
                                              <input class="form-control col-md-4 col-xs-12" value="<?php  echo $row->nama_satuan; ?>" id="satuan" placeholder="Satuan" type="text" name="barcode" readonly>
                                      </div>
                          </div>




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
                     <select class="select2 form-control" name="kd_sub_unit" required>
                       <option value="<?php  echo $row->kd_sub_unit; ?>"><?php  echo $row->nama_sub_unit; ?></option>
                       <?php foreach ($data_sub_unit as $rowr)
                       {
                         echo '<option value="'.$rowr->kd_sub_unit.'">'.$rowr->nama_sub_unit.'</option>';
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
                       <option value="<?php  echo $row->id_supplier; ?>"><?php  echo $row->nama_supplier; ?></option>
                       <?php foreach ($data_supplier as $rowf)
                       {
                         echo '<option value="'.$rowf->id_supplier.'">'.$rowf->nama.'</option>';
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
                  <input class="form-control col-md-8 col-xs-12" id="hb" value="<?php  echo $row->hb; ?>" name="hb" placeholder="Harga Beli" type="number" step="Any">
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
                   <input class="form-control col-md-8 col-xs-12" id="hj" value="<?php  echo $row->hj; ?>" name="hj" placeholder="Harga Jual" type="number" step="Any">
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
                    <input class="form-control col-md-8 col-xs-12" id="margin" value="<?php  echo $row->margin; ?>" name="margin" placeholder="Margin" type="number" step="Any">
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
                     <input class="form-control col-md-8 col-xs-12" value="<?php  echo $row->perc_margin; ?>" id="perc_margin" name="perc_margin" placeholder="Margin" type="number" step="Any">
                     </div>
                   </div>
                  </div>


                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Min
                    </label>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <input class="form-control col-md-4 col-xs-12" value="<?php  echo $row->min; ?>" name="min" placeholder="Stok Minimal" type="number">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Max
                    </label>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <input class="form-control col-md-4 col-xs-12" value="<?php  echo $row->max; ?>" name="max" placeholder="Stok Maksimal" type="number">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Lokasi
                    </label>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <input class="form-control col-md-7 col-xs-12" value="<?php  echo $row->lokasi; ?>" name="lokasi" placeholder="Lokasi" type="text">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Rak
                    </label>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <input id="name" class="form-control col-md-7 col-xs-12" value="<?php  echo $row->rak; ?>" name="rak" placeholder="Rak" type="text">
                    </div>
                  </div>


              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Keterangan
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <textarea id="keterangan" placeholder="Keterangan" class="form-control" name="keterangan"><?php echo $row->keterangan; ?></textarea>
                </div>
              </div>


            </div>
            <!-- /.box-body -->
            <div class="box-footer">

              <button type="submit" class="btn btn-info pull-right">Update</button>
            </div>
            <!-- /.box-footer -->

        </div>

  </div>
  <!--/.col (left) -->
  <!-- right column -->

  <!--/.col (right) -->
</div>

<?php  // code...
  }
}
}

 ?>

   </form>
     <!-- /.row -->
   </section>
   <!-- /.content -->
 </div>


<?php include 'includefile/foot.php'; ?>
