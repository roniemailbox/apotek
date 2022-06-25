<?php include 'includefile/head.php'; ?>

<?php $action_form = 'Sitranst/tambah'; ?>
<link href="<?php echo base_url('/');?>assets/css/style_auto.css" rel="stylesheet">
<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery-1.8.2.min.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.autocomplete.js'></script>

<script type='text/javascript'>
            var jq_auto = $.noConflict(true);
            var site = "<?php echo site_url();?>";
            jq_auto(function(){
              //alert("saa");
              jq_auto('.partsearch').autocomplete({
                // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
                serviceUrl: site+'/autocomplete/item_jual',
                // fungsi ini akan dijalankan ketika user memilih salah satu hasil request
                onSelect: function (suggestion) {
                  jq_auto('#id_barang').val(''+suggestion.id_barang);
                  jq_auto('#nama_barang').val(''+suggestion.nama_barang);
                  jq_auto('#dpp').val(''+suggestion.dpp);
                  jq_auto('#hj').val(''+suggestion.hj);
                  jq_auto('#nilaippn').val(''+suggestion.nilaippn);
                  jq_auto('#itemppn').val(''+suggestion.ppn);
                  jq_auto('#satuan').val(''+suggestion.satuan);

                  //document.getElementById("qty").focus();
                  //document.getElementById("qty").select();
                  cek_item();
                }
              });
            });

            jq_auto(function(){
            //alert("saa");
              jq_auto('.anggotasearch').autocomplete({
                // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
                serviceUrl: site+'/autocomplete/anggota_aktif',
                // fungsi ini akan dijalankan ketika user memilih salah satu hasil request
                onSelect: function (suggestion) {
                  jq_auto('#npa').val(''+suggestion.npa);
                  jq_auto('#nama').val(''+suggestion.nama);
                  jq_auto('#nik').val(''+suggestion.nik);
                  jq_auto('#kd_sub_unit').val(''+suggestion.kd_sub_unit);
                  jq_auto('#nama_unit').val(''+suggestion.nama_unit);
                  jq_auto('#nama_sub_unit').val(''+suggestion.nama_sub_unit);
                  document.getElementById("filterbarang").focus();
                }
              });
            });

</script>

<script type="text/javascript">

    function LPS() {
      document.getElementById('filterbarang').value='';
      document.getElementById('id_barang').value='';
      document.getElementById('nama_barang').value='';
      document.getElementById('qty').value='1';
      document.getElementById('hj').value='0';
      document.getElementById('dpp').value='0';
      document.getElementById('nilaippn').value='0';
      document.getElementById('diskon').value='0';
      document.getElementById('perc_diskon').value='0';
      document.getElementById('itemppn').value='';
      document.getElementById('satuan').value='';
      document.getElementById('total').value='0';
      document.getElementById('searchbarcode').value='';
      //document.getElementById('searchbarcode').focus();
    }
    </script>

    <script type="text/javascript">

        function LPSnpa() {
          document.getElementById('filteranggota').value='';
          document.getElementById('nama').value='';
          document.getElementById('npa').value='';
          document.getElementById('nik').value='';
          document.getElementById('nama_sub_unit').value='';
          document.getElementById('nama_unit').value='';
          document.getElementById('filteranggota').focus();
        }
        </script>
    <script>
        function hitung_pilih_item() {
          var hj = parseFloat(document.getElementById("hj").value);
          var dpp = parseFloat(document.getElementById("dpp").value);
          var qty = parseFloat(document.getElementById("qty").value);
          var diskon = parseFloat(document.getElementById("diskon").value);
          var nilaippn = parseFloat(document.getElementById("nilaippn").value);
          perc_diskon=(diskon/dpp*100).toFixed(2);
          document.getElementById('perc_diskon').value = perc_diskon;
          var e = document.getElementById("itemppn").value;
          //alert(e);
          if (e == "NON PPN") {
              dpp=(hj-diskon).toFixed(2);
              nilaippn=(0).toFixed(2);
              total=((hj-diskon)*qty).toFixed(2);

          }
          else {
              dpp=((hj-diskon)/1.1).toFixed(2);
              nilaippn=(10/100*dpp).toFixed(2);
              total=((hj-diskon)*qty).toFixed(2);

          }

          document.getElementById('dpp').value = dpp;
          document.getElementById('nilaippn').value = nilaippn;
          document.getElementById('total').value = total;

        }

   </script>
   <script language=javascript type=text/javascript>

   function cek_qty()
   {
   document.getElementById('qty').onkeypress=function(e){
       if(e.keyCode==13){
           //alert("XXXXX");
           hitung_pilih_item();
           document.getElementById('add_btn_item').click();
       }
   }
  }
   </script>

   <script language=javascript type=text/javascript>

   function cek_item()
   {
   document.getElementById('filterbarang').onkeypress=function(e){
       if(e.keyCode==13){
           //alert("XXXXX");
           hitung_pilih_item();
           document.getElementById('add_btn_item').click();
       }
   }
  }
   </script>
<script>
$(document).keydown( function(event) {
if (event.which === 117) {
// login code here
//alert("XXXXX");
document.getElementById('btnSubmit').click();
}
});
</script>

<form name="form1" method="post" action="<?=site_url($action_form)?>"  enctype="multipart/form-data" onkeypress="return event.keyCode != 13;" >

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
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <div class="form-group">
                 <div class="col-lg-12 col-xs-6">
                    <div class="small-box bg-green">
                            <div class="inner">
                              <p>Tekan (F6) untuk simpan transaksi</p>
                              <h3><label style="font-size:90px" id="lblTotal"></label></h3>
                              <p>Harga sudah termasuk Ppn - Terima Kasih Atas Kunjungan Anda</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-pie-graph"></i>
                            </div>
                    </div>
               </div>
             </div>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-lg-12 col-xs-6">
              <div class="row invoice-info">
                <div class="col-sm-3 invoice-col">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">No <span class="required">*</span>
                    </label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                      </div>
                      <input class="form-control col-md-4 col-xs-12" value="" placeholder="AUTO" readonly type="text" name="no_bukti" >
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal</label>

                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input id="middle-name" class="date-picker form-control col-md-3 col-xs-12" value="<?php echo date('Y-m-d'); ?>" type="date" name="tgl_trans" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Ppn</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-ticket"></i>
                      </div>
                      <select class="select2 form-control" id="jenis_ppn" name="jenis_ppn" disabled>
                        <option value="INCLUDE">INCLUDE</option>
                        <option value="EXCLUDE">EXCLUDE</option>
                        <option value="NON">NON</option>
                      </select>
                     </div>
                  </div>
               </div>
                 <div class="col-sm-3 invoice-col">
                   <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Bayar</label>
                     <div class="input-group">
                       <div class="input-group-addon">
                         <i class="fa fa-cc-paypal"></i>
                       </div>
                       <select class="select2 form-control" id="jenis_bayar" name="jenis_bayar" >
                           <option value="TUNAI">TUNAI</option>
                           <option value="KREDIT">KREDIT</option>
                       </select>
                   </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Jenis
                    </label>
                    <div class="input-group">
                      <div class="input-group-addon">
                         <i class="fa fa-spinner"></i>
                      </div>
                      <select class="select2 form-control" id="jenis_barang" name="jenis_barang" disabled >
                              <option value="">--pilih--</option>
                              <option value="TUNAI">POKOK</option>
                              <option value="KREDIT">SEKUNDER</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Cicilan
                    </label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calculator"></i>
                      </div>
                      <input id="jml_cicilan" class="form-control col-md-3 col-xs-12" value="1" type="number" name="jml_cicilan" disabled>
                    </div>
                  </div>
                </div>

                 <div class="col-sm-5 invoice-col">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Anggota<span class="required"></span>
                    </label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                      </div>
                      <input onclick="LPSnpa()" style="background:#f6ff00;" class="anggotasearch form-control col-md-12 col-xs-12" name="filteranggota" type="text" id="filteranggota" placeholder="Pencarian Anggota"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Customer
                    </label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                      </div>
                      <input id="nama" class="form-control col-md-6 col-xs-12" value="UMUM" type="text" name="nama" readonly>
                    </div>
                 </div>
                 <div class="form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">NPA </label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-info"></i>
                        </div>
                        <input id="npa" class="form-control col-md-3 col-xs-12" value="000000" type="text" name="npa" readonly>
                      </div>
                </div>
                </div>


                <!-- /.col -->
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="col-lg-6 col-xs-6">
              <h3 class="box-title"> <?php  include 'includefile/Pesan.php'; ?></h3>
              Pilih Pembayaran, Jenis dan Anggota di bagian ini.....!!!
            </div>
             <div class="col-lg-6 col-xs-6">
              <a href="<?php echo site_url('Sitranst/cetak/'.$this->session->flashdata('no_penjuaan')); ?>" target="_blank" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Cetak Transaksi Terakhir <?php echo $this->session->flashdata('no_penjuaan') ?></a>
            </div>
            </div>
          </div>
          <!-- /.box -->

          <!-- Form Element sizes -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Different Height</h3>
            </div>
            <div class="box-body">
              <input class="form-control input-lg" type="text" placeholder=".input-lg">
              <br>
              <input class="form-control" type="text" placeholder="Default input">
              <br>
              <input class="form-control input-sm" type="text" placeholder=".input-sm">
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Different Width</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-xs-3">
                  <label>Cicilan
                  </label>
                  <input type="text" class="form-control" placeholder=".col-xs-3">
                </div>
                <div class="col-xs-4">
                  <label>Cicilan
                  </label>
                  <input type="text" class="form-control" placeholder=".col-xs-4">
                </div>
                <div class="col-xs-5">
                  <label>Cicilan
                  </label>
                  <input type="text" class="form-control" placeholder=".col-xs-5">
                </div>
              </div>
              <div class="row">
                <div class="col-xs-3">
                  <label>Cicilan
                  </label>
                  <input type="text" class="form-control" placeholder=".col-xs-3">
                </div>
                <div class="col-xs-4">
                  <label>Cicilan
                  </label>
                  <input type="text" class="form-control" placeholder=".col-xs-4">
                </div>
                <div class="col-xs-5">
                  <label>Cicilan
                  </label>
                  <input type="text" class="form-control" placeholder=".col-xs-5">
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- Input addon -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Input Addon</h3>
            </div>
            <div class="box-body">
              <div class="input-group">
                <span class="input-group-addon">@</span>
                <input type="text" class="form-control" placeholder="Username">
              </div>
              <br>

              <div class="input-group">
                <input type="text" class="form-control">
                <span class="input-group-addon">.00</span>
              </div>
              <br>

              <div class="input-group">
                <span class="input-group-addon">$</span>
                <input type="text" class="form-control">
                <span class="input-group-addon">.00</span>
              </div>

              <h4>With icons</h4>

              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" class="form-control" placeholder="Email">
              </div>
              <br>

              <div class="input-group">
                <input type="text" class="form-control">
                <span class="input-group-addon"><i class="fa fa-check"></i></span>
              </div>
              <br>

              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                <input type="text" class="form-control">
                <span class="input-group-addon"><i class="fa fa-ambulance"></i></span>
              </div>

              <h4>With checkbox and radio inputs</h4>

              <div class="row">
                <div class="col-lg-6">
                  <div class="input-group">
                        <span class="input-group-addon">
                          <input type="checkbox">
                        </span>
                    <input type="text" class="form-control">
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                  <div class="input-group">
                        <span class="input-group-addon">
                          <input type="radio">
                        </span>
                    <input type="text" class="form-control">
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-lg-6 -->
              </div>
              <!-- /.row -->

              <h4>With buttons</h4>

              <p class="margin">Large: <code>.input-group.input-group-lg</code></p>

              <div class="input-group input-group-lg">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Action
                    <span class="fa fa-caret-down"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div>
                <!-- /btn-group -->
                <input type="text" class="form-control">
              </div>
              <!-- /input-group -->
              <p class="margin">Normal</p>

              <div class="input-group">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-danger">Action</button>
                </div>
                <!-- /btn-group -->
                <input type="text" class="form-control">
              </div>
              <!-- /input-group -->
              <p class="margin">Small <code>.input-group.input-group-sm</code></p>

              <div class="input-group input-group-sm">
                <input type="text" class="form-control">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat">Go!</button>
                    </span>
              </div>
              <!-- /input-group -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Horizontal Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox"> Remember me
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right">Sign in</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
          <!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">General Elements</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form">
                <!-- text input -->
                <div class="form-group">
                  <label>Text</label>
                  <input type="text" class="form-control" placeholder="Enter ...">
                </div>
                <div class="form-group">
                  <label>Text Disabled</label>
                  <input type="text" class="form-control" placeholder="Enter ..." disabled>
                </div>

                <!-- textarea -->
                <div class="form-group">
                  <label>Textarea</label>
                  <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                </div>
                <div class="form-group">
                  <label>Textarea Disabled</label>
                  <textarea class="form-control" rows="3" placeholder="Enter ..." disabled></textarea>
                </div>

                <!-- input states -->
                <div class="form-group has-success">
                  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Input with success</label>
                  <input type="text" class="form-control" id="inputSuccess" placeholder="Enter ...">
                  <span class="help-block">Help block with success</span>
                </div>
                <div class="form-group has-warning">
                  <label class="control-label" for="inputWarning"><i class="fa fa-bell-o"></i> Input with
                    warning</label>
                  <input type="text" class="form-control" id="inputWarning" placeholder="Enter ...">
                  <span class="help-block">Help block with warning</span>
                </div>
                <div class="form-group has-error">
                  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Input with
                    error</label>
                  <input type="text" class="form-control" id="inputError" placeholder="Enter ...">
                  <span class="help-block">Help block with error</span>
                </div>

                <!-- checkbox -->
                <div class="form-group">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox">
                      Checkbox 1
                    </label>
                  </div>

                  <div class="checkbox">
                    <label>
                      <input type="checkbox">
                      Checkbox 2
                    </label>
                  </div>

                  <div class="checkbox">
                    <label>
                      <input type="checkbox" disabled>
                      Checkbox disabled
                    </label>
                  </div>
                </div>

                <!-- radio -->
                <div class="form-group">
                  <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                      Option one is this and that&mdash;be sure to include why it's great
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                      Option two can be something else and selecting it will deselect option one
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" disabled>
                      Option three is disabled
                    </label>
                  </div>
                </div>

                <!-- select -->
                <div class="form-group">
                  <label>Select</label>
                  <select class="form-control">
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Select Disabled</label>
                  <select class="form-control" disabled>
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                  </select>
                </div>

                <!-- Select multiple-->
                <div class="form-group">
                  <label>Select Multiple</label>
                  <select multiple class="form-control">
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Select Multiple Disabled</label>
                  <select multiple class="form-control" disabled>
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                  </select>
                </div>

              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
</form>

 <?php include 'includefile/foot.php'; ?>
