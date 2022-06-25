<?php include 'includefile/Header.php'; ?>

<?php
$action_form = 'Mspegawai/tambah';
?>
<form class="form-horizontal form-label-left"
 method="post" action="<?=site_url($action_form)?>" >
   <!-- page content -->


     <link href="<?=site_url('/')?>build/source_ant/css/style_auto.css" rel="stylesheet">


     <!-- Memanggil file .js untuk proses autocomplete -->
     <script type='text/javascript' src='<?php echo base_url();?>build/source_ant/js/jquery-1.8.2.min.js'></script>
     <script type='text/javascript' src='<?php echo base_url();?>build/source_ant/js/jquery.autocomplete.js'></script>

     <script type='text/javascript'>
     var jq_auto = $.noConflict(true);
     var site = "<?php echo site_url();?>";
     jq_auto(function(){

       jq_auto('.kabupatensearch').autocomplete({
         // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
         serviceUrl: site+'/Autocomplete/search_kabupaten',
         // fungsi ini akan dijalankan ketika user memilih salah satu hasil request
         onSelect: function (suggestion) {

           jq_auto('#id_kabupaten').val(''+suggestion.id_kabupaten);
           jq_auto('#nama_kabupaten').val(''+suggestion.nama_kabupaten);

          // document.getElementById("qty").focus();
         }
       });


     });
     </script>
           <script type="text/javascript">
           function Clear_filter(){
              //document.getElementById("look_no_bukti_x").value= "";
              //document.getElementById("key_edit").value= "";
              //document.getElementById("input_edit").style.display = "none";
           }

             function LPSi() {
             document.getElementById('filterkabupaten').value='';
             document.getElementById('id_kabupaten').value='';
             document.getElementById('nama_kabupaten').value='';

           }
           </script>



  <div class="right_col" role="main">
     <div class="">
       <div class="page-title">
         <div class="title_left">
           <h3 style="float:left;">
             Tambah data Pegawai

           </h3>
         </div>
       </div>

      <div class="clearfix"></div>


<div class="">
  <div class="col-md-6 col-sm-6 col-xs-12">

               <div class="x_panel">
                 <div class="x_title">
                   <h2>Detail <small>info pegawai</small></h2>
                   <ul class="nav navbar-right panel_toolbox">
                     <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                     </li>


                   </ul>


                   <div class="clearfix"></div>
                 </div>
                 <div class="x_content">


 					             <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Status Pegawai *
                          </label>

                            <div class="col-md-4 col-xs-12">
                              <select class="form-control" name="id_status_pegawai" required>
                                <option value="">--pilih--</option>
                                <?php foreach ($data_status_pegawai as $dt_status_pegawai)
                                {
                                  echo '<option value="'.$dt_status_pegawai->id_status_pegawai.'">'.$dt_status_pegawai->nama_status_pegawai.'</option>';
                                }
                                ?>
                              </select>
                            </div>

                        </div>

                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tipe *
                          </label>

                            <div class="col-md-4 col-xs-12">
                              <select class="form-control" name="id_jenis" required>
                                <option value="">--pilih--</option>
                                <?php foreach ($data_jenis as $dt_j)
                                {
                                  echo '<option value="'.$dt_j->id_jenis.'">'.$dt_j->nama.'</option>';
                                }
                                ?>
                              </select>
                            </div>

                        </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">No Registrasi
                        </label>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-2 col-xs-12" value="" name="id_pegawai" placeholder="AUTO" type="text" readonly>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanggal Masuk *
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-3 col-xs-12" value="<?php echo date('Y-m-d'); ?>" name="tglmasuk" placeholder="Tanggal Diterima Kerja" type="date">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama *
                        </label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-8 col-xs-12" name="nama" placeholder="Nama Lengkap" required="required" type="text">
                        </div>
                      </div>

                      <div class="item form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Sloc *</label>
                           <div class="col-md-4 col-xs-12">
                             <select class='form-control' id='sloc' name="id_sloc" required>
                               <option value="">--pilih--</option>
                               <?php foreach ($data_sloc as $dt)
                               {
                                 echo '<option value="'.$dt->id_slock.'">'.$dt->nama.'</option>';
                               }
                               ?>
                             </select>
                             </div>
                       </div>


                       <script type="text/javascript">
                       $(function(){
                         $.ajaxSetup({
                           type:"POST",
                           url: "<?php echo base_url('index.php/Mspegawai/ambil_data') ?>",
                           cache: false,
                         });

                         $("#id_plant").change(function(){

                           var value=$(this).val();
                           if(value>0){

                             $.ajax({
                               data:{modul:'divisi',id:value},
                               success: function(respond){

                                 $("#divisi").html(respond);
                               }
                             })
                           }
                         });


                         $("#divisi").change(function(){
                           var value=$(this).val();
                           //alert(value);
                           if(value>0){

                             $.ajax({
                               data:{modul:'departement',id:value},
                               success: function(respond){
                                 $("#departement").html(respond);
                               }
                             })
                           }
                         })

                       })
                       </script>


                       <div class='item form-group'>
                 				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Plant *</label>
                         <div class="col-md-4 col-xs-12">
                           <select id="id_plant" class="form-control" name="id_plant" required>
                             <option value="">--pilih--</option>
                             <?php foreach ($data_plant as $dt)
                             {
                               echo '<option value="'.$dt->id_plant.'">'.$dt->nama.'</option>';
                             }
                             ?>
                           </select>
                           </div>
                 			</div>



                       <div class="item form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Divisi *</label>
                           <div class="col-md-4 col-xs-12">
                             <select class='form-control' id='divisi' name="id_divisi" required>
                               <option value='0'>--pilih--</option>
                             </select>
                             </div>
                       </div>

                       <div class="item form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Departement *</label>
                           <div class="col-md-4 col-xs-12">
                             <select class='form-control' id='departement' name="id_departement" required>
                               <option value='0'>--pilih--</option>
                             </select>
                           </div>
                       </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Jabatan *
                        </label>

                          <div class="col-md-4 col-xs-12">
                            <select class="form-control" name="id_jabatan" required>
                              <?php foreach ($data_jabatan as $dt_jabatan)
                              {
                                echo '<option value="'.$dt_jabatan->id_jabatan.'">'.$dt_jabatan->nama.'</option>';
                              }
                              ?>
                            </select>
                          </div>

                      </div>




                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kelamin *
                        </label>

                          <div class="col-md-4 col-xs-12">
                            <select class="form-control" name="jk">
                              <option value="">- Pilih -</option>
                              <option value="L">Laki-laki</option>
                              <option value="P">Perempuan</option>
                            </select>
                          </div>

                      </div>

 						<div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pencarian Kota
                         </label>
                               <div class="col-md-8 col-sm-8 col-xs-12">

                               <input onclick="LPSi()" style="background:#D9DCE8;"
                                             class="kabupatensearch form-control col-md-7 col-xs-12"
                                             name="filterkabupaten" type="text" id="filterkabupaten" placeholder="Kabupaten / Kota Kelahiran"/>
                               </div>
                       </div>

                        <div class="form-group">
                                 <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Kota / Kabupaten<span class="required">*</span>
                                 </label>
                                 <div class="col-md-8 col-sm-6 col-xs-12">
                                   <input id="id_kabupaten" placeholder="ID Client" readonly type="text" name="id_kota_lahir" hidden="hidden">
                                   <input class="form-control col-md-8 col-xs-12" id="nama_kabupaten" placeholder="Kota / Kabupaten" readonly type="text" name="nama_kabupaten">
                                 </div>
                               </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanggal Lahir
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-3 col-xs-12" name="tgllahir" placeholder="Tanggal Lahir" type="date">
                        </div>

                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Alamat
                        </label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                          <textarea id="alamat" placeholder="Alamat" class="form-control" name="alamat" ><?php //echo $row->alamat_invoice; ?></textarea>
                        </div>
                      </div>




                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kota
                        </label>

                          <div class="col-md-4 col-xs-12">
                            <select class="form-control" name="id_kota">
                              <option value="">- Pilih Kota -</option>
                              <?php foreach ($data_kota as $dt_kota)
                              {
                                echo '<option value="'.$dt_kota->id.'">'.$dt_kota->name.'</option>';
                              }
                              ?>
                            </select>
                          </div>

                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">KTP
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" name="ktp" placeholder="KTP" type="text">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pendidikan
                        </label>

                          <div class="col-md-4 col-xs-12">
                            <select class="form-control" name="id_pendidikan">

                              <?php foreach ($data_pendidikan as $dt_pend)
                              {
                                echo '<option value="'.$dt_pend->id_pendidikan.'">'.$dt_pend->id_pendidikan.'</option>';
                              }
                              ?>
                            </select>
                          </div>

                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Telepon
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" name="telepon" placeholder="Telepon" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">E-mail
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" value="" name="email" placeholder="E-mail" type="email">
                        </div>
                      </div>


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Bank
                        </label>

                          <div class="col-md-4 col-xs-12">
                            <select class="form-control" name="id_bank">
                              <option value="">- Pilih Bank -</option>
                              <?php foreach ($data_bank as $dt_bank)
                              {
                                echo '<option value="'.$dt_bank->id_bank.'">'.$dt_bank->nama.'</option>';
                              }
                              ?>
                            </select>
                          </div>

                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">No Rekening
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" name="no_rekening" placeholder="No Rekening" type="text">
                        </div>
                      </div>



                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Aktif
                        </label>

                        <div class="col-md-4 col-xs-12">
                          <select class="form-control" name="id_status_aktif" required>
                            <option value="">--pilih--</option>
                            <?php foreach ($data_status_aktif as $dt_status_aktif)
                            {
                              echo '<option value="'.$dt_status_aktif->id_status_aktif.'">'.$dt_status_aktif->nama_status_aktif.'</option>';
                            }
                            ?>
                          </select>
                        </div>

                      </div>



                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanggal Keluar
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-3 col-xs-12" name="tglkeluar" placeholder="Tanggal Keluar Kerja" type="date">
                        </div>
                      </div>



                 </div>
               </div>
             </div>
           </div>

 <div class="row">
  			<div class="col-md-6 col-sm-6 col-xs-12">

               <div class="x_panel">

                 <div class="x_content">

  				<div class="x_title">
                   <h2>Payroll <small>Variabel</small></h2>
                   <ul class="nav navbar-right panel_toolbox">
                     <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                     </li>
					</ul>


                   <div class="clearfix"></div>
                 </div>
                 <div class="x_content">

                 <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

              <div class="item form-group">
                <table border="0" width="100%"
											style="border-collapse: separate; border-spacing: 2px;">
											<tr height="30px" style="background-color:#B9B9B9; color:white; text-align:center; font-weight:bold;">
												<td width="25%">Filter</td>
												<td width="10%">ID</td>
												<td width="10%">+/-</td>
												<td width="35%">Coa</td>
												<td width="5%">Action</td>
											</tr>

                    <link href="<?=site_url('/')?>build/source_ant/css/style_auto.css" rel="stylesheet">


										<!-- Memanggil file .js untuk proses autocomplete -->
										<script type='text/javascript' src='<?php echo base_url();?>build/source_ant/js/jquery-1.8.2.min.js'></script>
										<script type='text/javascript' src='<?php echo base_url();?>build/source_ant/js/jquery.autocomplete.js'></script>

										<script type='text/javascript'>
										var jq_auto = $.noConflict(true);
										var site = "<?php echo site_url();?>";
										jq_auto(function(){
											//alert("saa");
											jq_auto('.partsearch').autocomplete({
												// serviceUrl berisi URL ke controller/fungsi yang menangani request kita
												serviceUrl: site+'/autocomplete/search_barang',
												// fungsi ini akan dijalankan ketika user memilih salah satu hasil request
												onSelect: function (suggestion) {
													jq_auto('#kode_barang').val(''+suggestion.kd_barang);
													jq_auto('#nama_barang').val(''+suggestion.nama_barang);
													document.getElementById("qty").focus();
												}
											});
										});
										</script>
                                        <script type="text/javascript">
													function Clear_filter(){
													   //document.getElementById("look_no_bukti_x").value= "";
													   //document.getElementById("key_edit").value= "";
													   //document.getElementById("input_edit").style.display = "none";
													}

													function LPS() {
														document.getElementById('filterbarang').value='';
														document.getElementById('kode_barang').value='';
														document.getElementById('nama_barang').value='';
														document.getElementById('qty').value='';
														//document.getElementById('nominal_x').value='';
														//document.getElementById('nilai').value='';
														document.getElementById('filterbarang').focus();
													}
													</script>
											<tr>
												<td><select class="form-control" name="id_var_payroll" id="id_var_payroll" onchange="changeValue2(this.value)">
												  <option value="">- Pilih Variable -</option>
                              <?php
														$jsArray2 = "var kdSertifikat2 = new Array();\n";
														foreach ($data_var_payroll as $row) {
															$nama = ucwords(strtolower($row->nama));
															$id_var_payroll = $row->id_var_payroll;
															$kd_akun = $row->kd_akun;
															$nama_akun = $row->nama_akun;
															$jenis= $row->jenis;


															echo "<option value='$row->id_var_payroll'>$nama</option>";

															//menampilkan array
															$jsArray2 .= "kdSertifikat2['" . $row->id_var_payroll. "'] = {data11:'".addslashes($nama)."',
																data21:'".addslashes($nama_akun)."', data22:'".addslashes($jenis)."', data23:'".addslashes($id_var_payroll)."'};\n";
														}
														?>


                          </select>
											  </td>
                                              <script type="text/javascript">
													<?php echo $jsArray2; ?>
													function changeValue2(idx){
														var combo2 = document.getElementById('id_var_payroll').value;
														if (combo2 === 'pilih'){
															document.getElementById('id_var_pay').value = ' ';
															document.getElementById('pm').value = ' ';
															document.getElementById('nama_akun').value = ' ';
															document.getElementById('nama').value = ' ';
															return false;
														} else {
															document.getElementById('id_var_pay').value = kdSertifikat2[idx].data23;
															document.getElementById('pm').value = kdSertifikat2[idx].data22;
															document.getElementById('nama_akun').value = kdSertifikat2[idx].data21;
															document.getElementById('nama_content').value = kdSertifikat2[idx].data11;
															return false;
														}
													}
													</script>

												<td><input type="number" name="id_var_pay" id="id_var_pay"
														class="form-control col-md-7 col-xs-12" readonly />
                                                        <input type="text" name="nama_content" id="nama_content"
														 readonly hidden="" /></td>
												<td>
													<input type="text" name="pm" id="pm"
														class="form-control col-md-7 col-xs-12" readonly />
												</td>
												<td>
													<input name="nama_akun" type="text" id="nama_akun"
														class="form-control col-md-7 col-xs-12" readonly />
												</td>
											  <td style="text-align:center;">
												<script type="text/javascript" src='<?php echo base_url();?>build/source_ant/js/jquery-1.4.2.min.js'></script>
												<script type="text/javascript" src='<?php echo base_url();?>build/source_ant/js/append_varpayroll.js'></script>

													<input hidden="" id="site_url_x" value="<?php echo base_url();?>">
												<script type="text/javascript" src='<?php echo base_url();?>build/source_ant/js/jquery-1.3.2.js'></script>
										<script type='text/javascript' src='<?php echo base_url();?>build/source_ant/js/jquery.calculation.js'></script>

										<script type="text/javascript">
										//var bIsFirebugReady = (!!window.console && !!window.console.log);
										var j_x_1 = $.noConflict(true);
										j_x_1(document).ready(
											function (){
												setTimeout(function(){
													j_x_1("#add_btn_item").click(
														function (){
															 //alert("yes");
															// get the sum of the elements
															var sumQty = j_x_1(".nilaiQty").sum();
															//var sumK = j_x_1(".nilaiK").sum();
															//var total = sumK - sumD;
															//alert(sumD);

															// update the total
															//$("#totalTextSumD").text("Rp" + sumD.toString());
															//$("#totalTextSumK").text("Rp" + sumK.toString());
															j_x_1("#totalTextSumD").text(sumQty.toString());
															//j_x_1("#totalTextSumK").text(sumK.toString());
															document.getElementById('SUM1').value = sumQty;
															//document.getElementById('SUM2').value = sumK;
															//document.getElementById('TOTAL').value = total;

															jum_akhir();
														}
													);


												}, 200);
											}
										);

										function sum_now(){
											//var sumD = j_x_1(".nilaiD").sum();
											//var sumK = j_x_1(".nilaiK").sum();
											//var total = sumK - sumD;

											//j_x_1("#totalTextSumD").text(sumD.toString());
											//j_x_1("#totalTextSumK").text(sumK.toString());
											//document.getElementById('SUM1').value = sumD;
											//document.getElementById('SUM2').value = sumK;
											//document.getElementById('TOTAL').value = total;
										}

										function jum_akhir(){
											var inputs = document.querySelectorAll('input[name="rowsBM[]"]');
											var max = 0;
											for (var i = 0; i < inputs.length; ++i) {
											   max = Math.max(max , parseInt(inputs[i].value));
											}
											document.getElementById('key_max').value = parseInt(max);
											//alert(max);

										}
										</script>
													<input type="button" class="btn btn-success btn-sm" name="add_btn_item"
														value="Input" id="add_btn_item"	onClick="sudm_now();" /></td>
											</tr>
										</table></div>


            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="item form-group">
                <table border="0"  width="100%"
											style="background:#FFFFFF; border-collapse:separate; border-spacing:1px;">
										<thead>
										<tr>
											<td height="30" style="background-color:#00A9FB; color:white; text-align:center; font-weight:bold;"
												colspan='5' align='center'>
												ITEM PAYROLL</td>
										</tr>
										<tr height="30px" style="background: #337ab7; color:white;" class="td_only">
											<th style="width:3%; text-align:center;">No</th>
											<th style="width:10%; text-align:center;">+/-</th>
											<th style="width:20%; text-align:center;">Content</th>
											<th style="width:60%; text-align:center;">Coa</th>
											<th style="width:5%; text-align:center;">Action</th>
										</tr>
										</thead>

                    					<tbody id="containeritem" style="height: 100px; overflow: auto;">



										</tbody>

										<tr style="background-color:#B0B0AD; color:white; font-weight:bold">
											<td align="center">
												<input type="number" class="key_max" id="key_max"
													style="background-color:#eea236; color:black;" hidden />
											</td>
											<td align="center"></td>
											<td align="center"></td>
											<td align="right">&nbsp;</td>
											<td style="font-weight:bold" align="center"></td>
										</tr>
										</table></div>





            </div>
          </div>
        </div>

                    </div>


<div class="ln_solid"></div>



                                       <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Simpan</button>



                 </div>
               </div>
             </div>
           </div>


  </div>
           </div>





       <!-- /page content -->

</form>

<?php include 'includefile/Footer.php'; ?>
