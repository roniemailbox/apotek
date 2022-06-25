<script type="text/javascript" src='<?php echo base_url();?>assets/js/jquery-1.3.2.js'></script>
<script type="text/javascript" src='<?php echo base_url();?>assets/js/jquery-1.4.2.min.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery-1.8.2.min.js'></script>
<?php

if(isset($detail_data_item))
 {
   //$qty=0;
   foreach ($detail_data_item as $row)
      {

        ?>
        <div class="col-lg-4">
          <label for="exampleInputEmail1">Info</label>
          <input name="id_barang" type="text" id="id_barang" value="<?php echo $row->id_barang; ?>" >
          <input name="nama_barang" type="text" id="nama_barang" value="<?php echo $row->nama; ?>" class="form-control col-md-7 col-xs-12"  placeholder="Nama Barang" readonly>
          <!-- /input-group -->
        </div>
        <div class="col-lg-1">
          <label>Qty</label>
          <input name="qty" type="number" id="qty" class="form-control col-md-4 col-xs-12" style="text-align:right;" value="1" placeholder="Qty" onchange="hitung_pilih_item();" onblur="hitung_pilih_item();" onkeypress="cek_qty()" />
          <!-- /input-group -->
        </div>
        <div class="col-lg-1">
          <label for="exampleInputEmail1">Harga</label>
          <input name="hj" type="text" id="hj" class="form-control col-md-4 col-xs-12" style="text-align:right;" value="<?php echo $row->hj; ?>" placeholder="Harga Jual" onchange="hitung_pilih_item();" onblur="hitung_pilih_item();" />
          <!-- /input-group -->
        </div>
        <div class="col-lg-1">
          <label for="exampleInputEmail1">Satuan</label>
          <input name="satuan" type="text" id="satuan" value="<?php echo $row->satuan; ?>" class="form-control col-md-2 col-xs-12" style="text-align:center;" placeholder="Satuan" readonly />
          <!-- /input-group -->
        </div>
        <div class="col-lg-1">
          <label for="exampleInputEmail1">Tipe</label>
          <input name="itemppn" type="text" id="itemppn" value="<?php echo $row->ppn; ?>" class="form-control col-md-2 col-xs-12" style="text-align:center;"  placeholder="Ppn" readonly />
          <!-- /input-group -->
        </div>
        <div class="col-lg-1">
          <label for="exampleInputEmail1">Dpp</label>
          <input name="dpp" type="number" id="dpp" class="form-control col-md-4 col-xs-12" value="0" style="text-align:right;" placeholder="Dpp" step="Any" readonly />
          <!-- /input-group -->
        </div>
        <div class="col-lg-1">
          <label for="exampleInputEmail1">Ppn</label>
          <input name="nilaippn" value="0" type="number" id="nilaippn" class="form-control col-md-4 col-xs-12" style="text-align:right;" step="Any" placeholder="Nilai Ppn" readonly />
          <!-- /input-group -->
        </div>
        <div class="col-lg-1">
          <label for="exampleInputEmail1">%Diskon</label>
          <input name="perc_diskon" type="number" id="perc_diskon" class="form-control col-md-7 col-xs-12" value="0" style="text-align:right;"  placeholder="% Diskon" step="Any" readonly />
          <!-- /input-group -->
        </div>
        <div class="col-lg-1">
          <label for="exampleInputEmail1">Diskon</label>
          <input name="diskon" type="number" value="0" id="diskon" class="form-control col-md-7 col-xs-12" style="text-align:right;" placeholder="Diskon" onchange="hitung_pilih_item();" onblur="hitung_pilih_item();"  />
          <!-- /input-group -->
        </div>

        <script type="text/javascript">
              hitung_pilih_item()
              document.getElementById('add_btn_item').focus();

            </script>



<?php
}

}
else {
  ?>
  <script type="text/javascript">
        Alert ("Barcode / Kode Barang tidak terdaftar");

      </script>
  <?php
}
 ?>
