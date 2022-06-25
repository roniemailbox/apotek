<?php
include 'includefile/head.php';
$id = get_cookie('eklinik');
$kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
$nama_sub_unit=$this->session->userdata('nama_sub_unit'.$id);
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

                $("#xhb").change(function(){
                  var hb = parseFloat(document.getElementById("xhb").value);
                  var perc_margin = parseFloat(document.getElementById("xperc_margin").value);
                  var hj_proses=hb+(hb*perc_margin/100);
                  var hasil = Math.round(hj_proses / 100) * 100;
                  document.getElementById('xmargin').value = hasil-hb;
                  //perc_margin=(hj-hb)/hb*100;
                  document.getElementById('xhj').value = hasil;
                });
                $("#xhj_").change(function(){
                        var hb = parseFloat(document.getElementById("xhb").value);
                        var hj = parseFloat(document.getElementById("xhj").value);
                        margin=hj-hb;
                        document.getElementById('xmargin').value = margin;
                        perc_margin=(hj-hb)/hb*100;
                        document.getElementById('xperc_margin').value = perc_margin;
                });
                $("#xperc_margin").change(function(){
                var hb = parseFloat(document.getElementById("xhb").value);
                var perc_margin = parseFloat(document.getElementById("xperc_margin").value);
                var hj_proses=hb+(hb*perc_margin/100);
                var hasil = Math.round(hj_proses / 100) * 100;

                document.getElementById('xmargin').value = hasil-hb;
                //perc_margin=(hj-hb)/hb*100;
                document.getElementById('xhj').value = hasil;
                });

        })
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

                $("#exhb").change(function(){
                  var hb = parseFloat(document.getElementById("exhb").value);
                  var perc_margin = parseFloat(document.getElementById("experc_margin").value);
                  var hj_proses=hb+(hb*perc_margin/100);
                  var hasil = Math.round(hj_proses / 100) * 100;
                  document.getElementById('exmargin').value = hasil-hb;
                  //perc_margin=(hj-hb)/hb*100;
                  document.getElementById('exhj').value = hasil;
                });
                $("#xhj_").change(function(){
                        var hb = parseFloat(document.getElementById("xhb").value);
                        var hj = parseFloat(document.getElementById("xhj").value);
                        margin=hj-hb;
                        document.getElementById('xmargin').value = margin;
                        perc_margin=(hj-hb)/hb*100;
                        document.getElementById('xperc_margin').value = perc_margin;
                });
                $("#experc_margin").change(function(){
                var hb = parseFloat(document.getElementById("exhb").value);
                var perc_margin = parseFloat(document.getElementById("experc_margin").value);
                var hj_proses=hb+(hb*perc_margin/100);
                var hasil = Math.round(hj_proses / 100) * 100;

                document.getElementById('exmargin').value = hasil-hb;
                //perc_margin=(hj-hb)/hb*100;
                document.getElementById('exhj').value = hasil;
                });

        })
    </script>
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">

     <ol class="breadcrumb">
       <li><a href="<?php echo site_url('Utama') ?>"><i class="fa fa-home"></i> Home</a></li>

     </ol>
   </section>
   <!-- Main content -->
   <br>
   <section class="content">

     <form  method="post" action="<?=site_url($action_form)?>" >
       <?php if($perintah=="Baru")
       {
         ?>

     <div class="box box-default">
       <div class="box-header with-border">
         <h3 class="box-title"><?php echo $title_tambah ?></h3>

         <div class="box-tools pull-right">
           <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
         </div>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
         <div class="row">
           <div class="col-md-6">

             <label>Filter Barang</label>
               <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-key"></i></span>
                   <input onclick="LPS()" style="background:#AEC791;" type="text" class="partsearch form-control col-md-12 col-xs-12" name="filterbarang" id="filterbarang" placeholder="Filter Barang">
               </div>

          <label>ID Barang</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input style="background:#D9DCE8;" class="form-control" name="kd_barang" id="id_barang" placeholder="ID Barang" readonly>
            </div>

            <label>Barcode</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                  <input style="background:#D9DCE8;" class="form-control" id="barcode" placeholder="Barcode" type="text" name="barcode" readonly>
              </div>

              <label>Nama Barang</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input style="background:#D9DCE8;" class="form-control" id="nama_barang" placeholder="Nama Produk" type="text" name="nama_barang" readonly>
                </div>

                <label>Nama Alias</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                      <input style="background:#D9DCE8;" class="form-control" id="nama_alias" value="<?php //echo $row->nama_alias; ?>" placeholder="Nama Alias"ctype="text" name="nama_alias" readonly>
                  </div>

                  <label>PPN</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-key"></i></span>
                        <input style="background:#D9DCE8;" class="form-control" id="ppn" placeholder="Ppn" type="text" name="ppn" readonly>
                    </div>

                    <label>Kategori</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                          <input style="background:#D9DCE8;" class="form-control" id="nama_kategori" placeholder="Kategori" type="text" name="id_kategori" readonly>
                      </div>

                      <label>Merk</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input style="background:#D9DCE8;" class="form-control" id="merk" placeholder="Merk" type="text" name="id_merk" readonly>
                        </div>

                      <label>Jenis</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input style="background:#D9DCE8;" class="form-control" id="jenis" placeholder="Jenis" type="text" name="id_jenis" readonly>
                        </div>

                      <label>Tipe</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input style="background:#D9DCE8;" class="form-control" id="tipe" placeholder="Tipe" type="text" name="id_tipe" readonly>
                        </div>

                      <label for="middle-name">Harga Beli</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input style="background:#D9DCE8;" class="form-control" type="number" id="hb" name="hb" placeholder="Harga Beli" readonly>
                        </div>

                      <label for="middle-name">Harga Jual</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input style="background:#D9DCE8;" class="form-control" type="number" id="hj" name="hj" placeholder="Harga Jual" readonly>
                        </div>

                      <label>Satuan</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input style="background:#D9DCE8;" class="form-control" id="satuan" placeholder="Satuan" type="text" name="Satuan" readonly>
                        </div>

      </div>
      <!-- RIght Coloumn -->
    <div class="col-md-6">

      <label>Unit Usaha</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
          <select class="select2 form-control" name="kd_sub_unit" required>
              <option value="<?php echo $kd_sub_unit ?>"><?php echo $nama_sub_unit ?></option>
              <?php foreach ($data_sub as $rowa)
                  {
                    echo '<option value="'.$rowa->kd_sub_unit.'">'.$rowa->nama_sub_unit.'</option>';
                  }
                ?>
            </select>
      </div>


      <label>ID Supplier</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
          <select class="select2 form-control" name="id_supplier" required>
              <option value="">-- Pilih --</option>
              <?php foreach ($data_supplier as $rows)
                  {
                    echo '<option value="'.$rows->id_supplier.'">'.$rows->nama.'</option>';
                  }
                ?>
            </select>
      </div>

      <label>Harga Beli</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-money"></i></span>
            <input type="number" class="form-control" id="xhb" name="hb" placeholder="Harga Beli">
      </div>
      <label>% Margin</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-money"></i></span>
            <input type="number" class="form-control" id="xperc_margin" name="perc_margin" placeholder="Margin">
      </div>
      <label>Harga Jual</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-money"></i></span>
            <input type="number" class="form-control" id="xhj" name="hj" placeholder="Harga Jual" readonly>
      </div>

      <label>Margin</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-money"></i></span>
            <input type="number" class="form-control"  id="xmargin" name="margin" placeholder="Margin" readonly>
      </div>



      <label>Min</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
            <input type="number" class="form-control" name="min" placeholder="Min">
      </div>

      <label>Max</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
            <input type="number" class="form-control" name="max" placeholder="Max">
      </div>

      <label>Lokasi</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                <input type="text" class="form-control" name="lokasi" placeholder="lokasi">
      </div>

      <label>Rak</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                <input type="text" class="form-control" name="rak" placeholder="Rak">
      </div>

      <label>Keterangan</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
            <textarea id="editor1" name="keterangan" rows="10" cols="95" placeholder="Keterangan">
            </textarea>
      </div>
             <!-- /.form-group -->


           </div>
           <!-- /.col -->
         </div>
         <!-- /.row -->
       </div>
       <!-- /.box-body -->
       <div class="box-footer">
        <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Simpan Data</button>
       </div>
     </div>
<?php } else { ?>

  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo $title_tambah ?></h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
    <?php
        $no=1;
        if(isset($data_detail_edit))
           {
             foreach ($data_detail_edit as $row_edit)
                { ?>
    <div class="row">
      <div class="col-md-6">

        <label>Filter Barang</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-key"></i></span>
              <input onclick="LPS()" style="background:#AEC791;" type="text" class="partsearch form-control col-md-12 col-xs-12" name="filterbarang" id="filterbarang" placeholder="Filter Barang" disabled>
          </div>

      <label>Kode Barang</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-key"></i></span>
            <input style="background:#D9DCE8;" type="text" class="form-control" value="<?php echo $row_edit->kd_barang; ?>" readonly name="kd_barang" placeholder="Pencarian Barang" readonly>
        </div>

        <label>Barcode</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
              <input type="text" class="form-control" name="barcode" placeholder="Barcode" value="<?php echo $row_edit->barcode?>" readonly>
          </div>


        <label>Nama Barang</label>
        <div class="input-group">
          <span class="input-group-addon"><i></i></span>
            <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Produk" value="<?php echo $row_edit->nama_barang?>" readonly>
        </div>

        <label>Nama Alias</label>
          <div class="input-group">
            <span class="input-group-addon"><i></i></span>
              <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Alias" value="<?php echo $row_edit->nama_barang ?>" readonly>
          </div>

          <label>PPN</label>
            <div class="input-group">
              <span class="input-group-addon"><i></i></span>
                <input type="text" class="form-control" name="ppn" id="ppn" placeholder="PPN" value="<?php echo $row_edit->ppn ?>" readonly>
            </div>

          <label>Kategori</label>
            <div class="input-group">
              <span class="input-group-addon"><i></i></span>
                <input type="text" class="form-control" name="id_kategori" id="id_kategori" placeholder="Kategori" value="<?php echo $row_edit->id_kategori ?>" readonly>
            </div>

          <label>Merk</label>
            <div class="input-group">
              <span class="input-group-addon"><i></i></span>
                <input type="text" class="form-control" name="id_merk" id="id_merk" placeholder="Merk" value="<?php echo $row_edit->id_merk ?>" readonly>
            </div>

          <label>Jenis</label>
            <div class="input-group">
              <span class="input-group-addon"><i></i></span>
                <input type="text" class="form-control" name="id_jenis" id="id_jenis" placeholder="Jenis" value="<?php echo $row_edit->id_jenis ?>" readonly>
            </div>

          <label>Tipe</label>
            <div class="input-group">
              <span class="input-group-addon"><i></i></span>
                <input type="text" class="form-control" name="id_tipe" id="id_tipe" placeholder="Tipe" value="<?php echo $row_edit->id_tipe ?>" readonly>
            </div>


          <label>Harga Beli</label>
            <div class="input-group">
               <span class="input-group-addon"> <i class="fa fa-money"></i></span>
               <input id="hb" placeholder="Harga Beli" class="form-control col-md-4 col-xs-12" value="<?php echo $row_edit->hb; ?>" type="number" name="hb" id="hb" readonly>
            </div>

          <label>Harga Jual</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-money"></i></span>
                <input id="hj" placeholder="Harga Jual" class="form-control col-md4 col-xs-12" value="<?php echo $row_edit->hj; ?>" type="number" name="hj" id="hj" readonly>
            </div>

          <label>Satuan</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-money"></i></span>
                <input id="satuan" value="<?php  echo $row_edit->satuan; ?>" placeholder="Satuan" class="form-control col-md4 col-xs-12" value="<?php //echo $row->keterangan; ?>" type="number" name="satuan" readonly>
            </div>

      </div>
      <!-- RIght Coloumn -->
    <div class="col-md-6">

      <label>Sub Unit</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
          <select class="select2 form-control" name="kd_sub_unit" required>
              <option value="<?php  echo $row_edit->kd_sub_unit; ?>"><?php  echo $row_edit->nama_sub_unit; ?></option>
              <?php foreach ($data_sub as $rowk)
                  {
                    echo '<option value="'.$rowk->kd_sub_unit.'">'.$rowk->nama_sub_unit.'</option>';
                  }
                ?>
            </select>
      </div>


      <label>Supplier</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
          <select class="select2 form-control" name="id_supplier" required>
              <option value="<?php  echo $row_edit->id_supplier; ?>"><?php  echo $row_edit->nama_supplier; ?></option>
              <?php foreach ($data_sup as $rowt)
                  {
                    echo '<option value="'.$rowt->id_supplier.'">'.$rowt->nama.'</option>';
                  }
                ?>
            </select>
      </div>

      <label>Harga Beli</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-money"></i></span>
            <input type="number" class="form-control" id="exhb" name="hb" value="<?php  echo $row_edit->hb; ?>" placeholder="Harga Beli">
      </div>
      <label>% Margin</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-money"></i></span>
            <input class="form-control" id="experc_margin" name="perc_margin" value="<?php  echo number_format($row_edit->perc_margin,2); ?>" type="number" placeholder="Margin" >
      </div>
      <label>Harga Jual</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-money"></i></span>
            <input type="number" class="form-control" id="exhj" name="hj" value="<?php  echo $row_edit->hj; ?>" placeholder="Harga Jual" readonly>
      </div>

      <label>Margin</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-money"></i></span>
            <input type="number" class="form-control" id="exmargin" name="margin" value="<?php  echo $row_edit->margin; ?>" placeholder="Margin" readonly>
      </div>



      <label>Min</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
            <input type="number" class="form-control" value="<?php  echo $row_edit->min; ?>" name="min" placeholder="Min">
      </div>

      <label>Max</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
            <input type="number" class="form-control" name="max" value="<?php  echo $row_edit->max; ?>" placeholder="Max">
      </div>

      <label>Lokasi</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                <input type="text" class="form-control" name="lokasi" value="<?php  echo $row_edit->lokasi; ?>" placeholder="lokasi">
      </div>

      <label>Rak</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                <input type="text" class="form-control" name="rak" value="<?php  echo $row_edit->rak; ?>" placeholder="Rak">
      </div>

      <label>Keterangan</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
            <textarea id="editor1" name="keterangan" rows="10" cols="95" placeholder="Keterangan" value="<?php  echo $row_edit->keterangan; ?>">
            </textarea>
      </div>

    </div>

    </div>
    <?php
     }
   }
  ?>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
       <a href="<?php echo site_url('Msdetailbarang'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Input Baru</a>
     <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Update Data</button>
    </div>
  </div>





<?php
}
?>
</form>


     <div class="row">


       <div class="col-xs-12">


         <div class="box">

          <?php //include 'template/Pesan.php'; ?>
           <div class="box-header">


             <button type="button" class="btn btn-block btn-info btn-dropbox" data-toggle="modal" data-target="#modal-default"><i class="fa fa-search"></i>
               Cari Master Detail Barang (<?php foreach ($jml_item as $row_jml) { echo $row_jml->jumlah_item;  } ?> Item di Database)
             </button>

             <button type="button" class="btn btn-block btn-info btn-flat" ><i class="fa fa-file-excel-o"></i>
             <a href="<?php echo site_url('Msdetailbarang/exportexcel'); ?>" >Download Excel Master Detail Barang </a>
             </button>
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
                   <th>Kode Barang</th>
                   <th>Nama Barang</th>
                   <th>Unit Usaha</th>
                   <th>Supplier</th>
                   <th>Harga Beli</th>
 				           <th>Harga Jual</th>
                   <th>% Margin</th>
                   <th>Margin</th>
                   <th>Max</th>
                   <th>Min</th>
                   <th>HPP</th>
                   <th>Lokasi</th>
                   <th>Rak</th>
                   <th>Keterangan</th>
                   <th>Entry Date</th>
                   <th>Entry User</th>
                  <th>Edit Date</th>
                  <th>Edit User</th>
                 </tr>
               </thead>
               <tbody>
                <!--
               <a class="btn btn-mini" href="<?php //echo site_url('master/hapus_rw/'.$row->kd_rw);?>"
        onclick="return confirm('Anda yakin?')"> <i class="icon-remove"></i> Hapus</a> -->
   </td>
 <?php
 //ambil dari controler
 $no=1;
 if(isset($data_detail))
    {
      foreach ($data_detail as $rowz)
         { ?>

           <div class="modal fade" id="modal-<?php echo $rowz->kd_barang; ?>">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Msdetailbarang/Dataedit')?>">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title">Edit Data Ini....????</h4>
                 </div>
                 <div class="modal-body">
                   <p>
                     <h5>Kode Barang</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-key"></i></span>
                       <input type="test" name="kd_barang" value="<?php echo $rowz->kd_barang; ?>" class="form-control" placeholder="Auto" readonly>

                     </div>
                     <h5>Kode Sub Unit</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-key"></i></span>
                       <input type="text" value="<?php echo $rowz->nama_sub_unit; ?>" class="form-control" placeholder="RW" readonly>
                       <input type="hidden" value="<?php echo $rowz->kd_sub_unit; ?>" name="kd_sub_unit" class="form-control" placeholder="RW" readonly>
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
           <div class="modal fade" id="modal-hapus<?php echo $rowz->kd_barang; ?>">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Msdetailbarang/hapus')?>">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title">Hapus Data Ini....????</h4>
                 </div>
                 <div class="modal-body">
                   <p>
                     <h5>Kode Barang</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-key"></i></span>
                       <input type="text" name="kd_barang" value="<?php echo $rowz->kd_barang; ?>" class="form-control" placeholder="Auto" readonly>
                     </div>
                     <h5>Nama Sub Unit</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                       <input type="text" value="<?php echo $rowz->nama_sub_unit; ?>" class="form-control" placeholder="rw" readonly>
                       <input type="hidden" value="<?php echo $rowz->kd_sub_unit; ?>" name="kd_sub_unit" class="form-control" placeholder="RW" readonly>
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
             <td>
               <?php
               if($hak_u == 1)
               {
                 ?>
                 <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-<?php echo $rowz->kd_barang; ?>"><i class="fa fa-pencil"></i>
                   Edit
                 </button>

               <?php
               }
               if($hak_d == 1)
               {
                 ?>
                 <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-hapus<?php echo $rowz->kd_barang; ?>"><i class="fa fa-trash"></i>
                   Hapus
                 </button>


               <?php
               }


               ?>
             </td>
           <td><?php echo $rowz->kd_barang; ?></td>
           <td><?php echo $rowz->nama_barang; ?></td>
           <td><?php echo $rowz->nama_sub_unit; ?></td>
           <td><?php  echo $rowz->nama_supplier; ?></td>
            <td><?php echo $rowz->hb; ?></td>
           <td><?php echo $rowz->hj; ?></td>
           <td><?php echo $rowz->perc_margin; ?></td>
           <td><?php echo $rowz->margin; ?></td>
           <td><?php echo $rowz->max; ?></td>
           <td><?php echo $rowz->min; ?></td>
           <td><?php echo $rowz->hpp; ?></td>
           <td><?php echo $rowz->lokasi; ?></td>
           <td><?php echo $rowz->rak; ?></td>
           <td><?php echo $rowz->keterangan; ?></td>
           <td><?php echo $rowz->entry_date; ?></td>
           <td><?php echo $rowz->nama_pegawai?></td>
           <td><?php echo $rowz->edit_date; ?></td>
           <td><?php echo $rowz->nama_edit_pegawai; ?></td>

           </tr>

   <?php }
   }
   ?>




               </tbody>
               <tfoot>
                 <tr>
                   <th>Opsi</th>
                   <th>Kode Barang</th>
                   <th>Nama Barang</th>
                   <th>Unit Usaha</th>
                   <th>Supplier</th>
                   <th>Harga Beli</th>
 				           <th>Harga Jual</th>
                   <th>% Margin</th>
                   <th>Margin</th>
                   <th>Max</th>
                   <th>Min</th>
                   <th>HPP</th>
                   <th>Lokasi</th>
                   <th>Rak</th>
                   <th>Keterangan</th>
                    <th>Entry Date</th>
                    <th>Entry User</th>
                   <th>Edit Date</th>
                   <th>Edit User</th>


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
