<?php include 'includefile/head.php'; ?>

<?php //$action_form = 'Kartustok/cetakkartu'; ?>


<link href="<?php echo base_url('/');?>assets/css/style_auto.css" rel="stylesheet">
<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery-1.8.2.min.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.autocomplete.js'></script>


<?php
ini_set('display_errors', 0);

$g_thn = date('y');
$g_tgl = date('m');
$kd_tambah = '';
//$kd_tambah = $_SESSION['userid'];
$cari2 = 'BM'.$kd_tambah.''.$g_thn.$g_tgl;

$kode_proses = $_GET['no_bukti_fil'];
if($kode_proses == ''){
	$idx = $this->CI->get_kode($cari2, $kd_tambah, $g_thn, $g_tgl);
	$tgl_trans_x = date('Y-m-d');
	$keterangan_x = '';
	$vl_buton = 'Simpan';
	$action_form = 'Jp_2/tambah';
	?>

	<style>
	#btn_action {
		display:none;
	}
	</style>

	<?php
} else {
	?>

	<style>
	#btn_action {
		display:block;
	}
	</style>

	<script type="text/javascript"
		src="<?=site_url('/')?>build/source_ant/js/jquery.min.js"></script>
	<script type="text/javascript">
	var js_load = $.noConflict(true);
	js_load(window).load(function(){
		sum_now();
		jum_akhir();

	});
	</script>

	<?php
	$vl_buton = 'Ubah';
	$action_form = 'Jp_2/edit';
	foreach ($jpen_edit as $dt_jpen_edit){
		$idx = $dt_jpen_edit->no_bukti_x;
		$tgl_trans_x = $dt_jpen_edit->tgl_trans_x;
		$keterangan_x = $dt_jpen_edit->keterangan_x;
		$idplantx = $dt_jpen_edit->id_plant;
		$idslocx = $dt_jpen_edit->id_sloc;
		$namaslocx = $dt_jpen_edit->nama_sloc;

	}
}
?>

<form class="form-horizontal form-label-left" action="<?=site_url($action_form)?>"	method="POST" enctype="multipart/form-data" name="" onSubmit="return checkform()">


<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <h1>
       <?php echo $title ?>
       <small>Jurnal Penyesuaian</small>
     </h1>
     <ol class="breadcrumb">
       <li><a href="<?php echo site_url('Utama') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
       <li><a href="#"><?php echo $xmenu ?></a></li>
       <li class="active"><?php echo $xsubmenu ?></li>
     </ol>
   </section>

   <section class="content">

     <div class="box box-default">
       <div class="box-header with-border">
         <h3 class="box-title"><i class="fa fa-refresh"></i> Filter<?php  //include 'includefile/Pesan.php'; ?></h3>

         <div class="box-tools pull-right">
           <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

         </div>
       </div>
			 <h3>Lookup / Pencarian <small> Bukti Memoial</small></h3>

			 <?php
			 if($hak_u == 1){
				 ?>

						 <input class="autocomplete form-control col-md-12 col-xs-12"  name="look_no_bukti_x" style="background:#939393; color:black;" onClick="Clear_filter();" type="text" id="look_no_bukti_x" placeholder="Lookup No Bukti" />
						 <input type="text" class="key_edit" id="key_edit" hidden />

				 <?php
			 }
			 ?>

     </div>





      <!-- /.row -->

     <div class="row">
       <!-- left column -->
       <div class="col-md-12">
         <div class="box box-info">
             <div class="box-header with-border">
							 <a href="<?php echo site_url('Jp_2'); ?>" class="btn btn-primary">
								 <i class="fa fa-plus-square-o"></i> Buat Baru
							 </a>
             </div>
     <!-- /.box-header -->
     <!-- form start -->


                 <div class="box-body">
                   <!-- /.isi table -->

                   <div class="col-xs-12 table-responsive">
										 <div class="x_content">

										 	<?php
										 	include 'includefile/Pesan.php';
										 	?>
										 	<script type="text/javascript">
										 									window.onload = setTimeout(function() {
										 										coba_x();
										 									}, 1000);

										 									function coba_x() {
										 										var coba_pesan = document.getElementById("pesan_ku_temp").value;
										 										var coba_pesan = coba_pesan.substring(0, 6);;
										 										//alert(coba_pesan);
										 										window.onload = setTimeout(function() {
										 											if(coba_pesan == "Sukses"){
										 												printDiv('printableArea');
										 											} else {

										 											}

										 										}, 1000);
										 									};
										 									</script>
										 	<?php
										 	if($hak_c == 1){
										 		?>




										 		<?php
										 	}
										 	?>

										 	<script type="text/javascript">
										 	function checkform(){
										 		var form_SUM1 = document.getElementById('SUM1').value;
										 		var form_SUM2 = document.getElementById('SUM2').value;
										 		if(form_SUM1 === ""){
										 			alert('Perkiraan jurnal harus di isi');
										 			return false;
										 		} else {
										 			if (form_SUM1 === form_SUM2){
										 				// something is wrong
										 				//alert('Perkiraan jurnal sama');
										 				return true;
										 			} else {
										 				// something else is wrong
										 				alert('Perkiraan jurnal harus seimbang');
										 				return false;
										 			}
										 		}
										 	}
										 	</script>

										 	<!-- Memanggil file .css untuk proses autocomplete -->
										 	<link href="<?=site_url('/')?>build/source_ant/css/style_auto.css" rel="stylesheet">

										 	<!-- Memanggil file .js untuk proses autocomplete -->
										 	<script type='text/javascript' src='<?php echo base_url();?>build/source_ant/js/jquery-1.8.2.min.js'></script>
										 	<script type='text/javascript' src='<?php echo base_url();?>build/source_ant/js/jquery.autocomplete.js'></script>

										 	<script type='text/javascript'>
										 	var jq_auto = $.noConflict(true);
										 	var site = "<?php echo site_url();?>";
										 	jq_auto(function(){
										 		jq_auto('.autocomplete').autocomplete({
										 			// serviceUrl berisi URL ke controller/fungsi yang menangani request kita
										 			serviceUrl: site+'/Autocomplete/search_jpen',
										 			// fungsi ini akan dijalankan ketika user memilih salah satu hasil request
										 			onSelect: function (suggestion) {
										 				jq_auto('#key_edit').val(''+suggestion.pembanding_x);
										 				document.getElementById("look_no_bukti_x").focus();
										 				var look_no_bukti_x_z = document.getElementById("look_no_bukti_x").value;
										 				window.location.href = "<?php echo site_url('Jp_2/v_edit'); ?>?no_bukti_fil=" + look_no_bukti_x_z;
										 			}
										 		});

										 		jq_auto('.akunsearch').autocomplete({
										 			// serviceUrl berisi URL ke controller/fungsi yang menangani request kita
										 			serviceUrl: site+'/autocomplete/search_akun',
										 			// fungsi ini akan dijalankan ketika user memilih salah satu hasil request
										 			onSelect: function (suggestion) {
										 				jq_auto('#kode_akun').val(''+suggestion.kd_akun);
										 				jq_auto('#nama_akun').val(''+suggestion.nama_akun);
										 				document.getElementById("nominal").focus();
										 			}
										 		});
										 	});
										 	</script>

										 	<script type="text/javascript" src='<?php echo base_url();?>build/source_ant/js/jquery-1.3.2.js'></script>
										 	<script type='text/javascript' src='<?php echo base_url();?>build/source_ant/js/jquery.calculation.js'></script>

										 	<script type="text/javascript">
										 	//var bIsFirebugReady = (!!window.console && !!window.console.log);
										 	var j_x_1 = $.noConflict(true);
										 	j_x_1(document).ready(
										 		function (){
										 			setTimeout(function(){
										 				j_x_1("#add_btn_bm").click(
										 					function (){
										 						//alert("yes");
										 						// get the sum of the elements
										 						var sumD = j_x_1(".nilaiD").sum();
										 						var sumK = j_x_1(".nilaiK").sum();
										 						var total = sumK - sumD;
										 						//alert(sumD);

										 						// update the total
										 						//$("#totalTextSumD").text("Rp" + sumD.toString());
										 						//$("#totalTextSumK").text("Rp" + sumK.toString());
										 						j_x_1("#totalTextSumD").text(sumD.toString());
										 						j_x_1("#totalTextSumK").text(sumK.toString());
										 						document.getElementById('SUM1').value = sumD;
										 						document.getElementById('SUM2').value = sumK;
										 						document.getElementById('TOTAL').value = total;

										 						jum_akhir();
										 					}
										 				);
										 			}, 200);
										 		}
										 	);

										 	function sum_now(){
										 		var sumD = j_x_1(".nilaiD").sum();
										 		var sumK = j_x_1(".nilaiK").sum();
										 		var total = sumK - sumD;

										 		j_x_1("#totalTextSumD").text(sumD.toString());
										 		j_x_1("#totalTextSumK").text(sumK.toString());
										 		document.getElementById('SUM1').value = sumD;
										 		document.getElementById('SUM2').value = sumK;
										 		document.getElementById('TOTAL').value = total;
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

										 	<script src='<?php echo base_url();?>build/source_ant/js/jquery.min.js'></script>
										 	<script type="text/javascript">
										 	var ja = $.noConflict(true);
										 	ja(document).ready( function(){
										 		ja('#look_no_bukti_x').on("keypress focus blur", function () {
										 			var key_edit_z = document.getElementById("key_edit").value;
										 			if (key_edit_z === 'ada'){
										 				document.getElementById("input_edit").style.display = "block";
										 			} else {
										 				document.getElementById("input_edit").style.display = "none";
										 			}
										 		});
										 	});
										 	</script>

										 	<script type="text/javascript">
										 	function Clear_filter(){
										 		document.getElementById("look_no_bukti_x").value= "";
										 		document.getElementById("key_edit").value= "";
										 		document.getElementById("input_edit").style.display = "none";
										 	}

										 	function LPS() {
										 		document.getElementById('filterakun').value='';
										 		document.getElementById('kode_akun').value='';
										 		document.getElementById('nama_akun').value='';
										 		document.getElementById('nominal').value='';
										 		document.getElementById('nominal_x').value='';
										 		document.getElementById('nilai').value='';
										 		document.getElementById('filterakun').focus();
										 	}
										 	</script>

										 	<script>
										 	function link_edit() {
										 		var look_no_bukti_x_z = document.getElementById("look_no_bukti_x").value;
										 		window.location.href = "<?php echo base_url('Jp_2/v_edit'); ?>?no_bukti_fil=" + look_no_bukti_x_z;
										 	}
										 	</script>


										 	<div class="item form-group">
										 								 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Sub Unit *</label>
										 									 <div class="col-md-4 col-xs-12">
										 										 <select class='form-control' id='kd_sub_unit' name="kd_sub_unit" onchange="changeValue2(this.value)">
										 											 <option value="<?php echo $idslocx; ?>"><?php echo $namaslocx; ?></option>
										 											 <?php
										 											 $jsArray2 = "var kdSertifikat2 = new Array();\n";
										 											 foreach ($data_sub_unit as $dt)

										 											 {
										 												 echo '<option value="'.$dt->kd_sub_unit.'">'.$dt->nama_sub_unit.'</option>';
										 											   $jsArray2 .= "kdSertifikat2['" .$dt->kd_sub_unit. "'] = {data11:'".addslashes($dt->nama_unit)."'};\n";
										 											 }
										 											 ?>
										 										 </select>

										 										 <script type="text/javascript">
																	 									<?php echo $jsArray2; ?>
																	 									function changeValue2(idx){
																	 										var combo2 = document.getElementById('kd_sub_unit').value;
																	 										if (combo2 === 'pilih'){
																	 											document.getElementById('kd_unit').value = ' ';

																	 											return false;
																	 										} else {
																	 											document.getElementById('kd_unit').value = kdSertifikat2[idx].data11;

																	 											return false;
																	 										}
																	 									}
										 									</script>

										 										 </div>
										 							 </div>

										 							<span hidden>
										 			<input name="kd_unit" type="text" id="kd_unit" placeholder="Auto" value="<?php echo $idplantx; ?>" readonly />

										 	 </span>
										 	<div class="item form-group">
										 		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
										 			No Bukti
										 		</label>
										 		<div class="col-md-3 col-sm-6 col-xs-12">
										 			<input class="form-control col-md-7 col-xs-12" name="no_bm" type="text" id="no_bm" placeholder="No Bukti" value="<?php echo $idx; ?>" readonly />

										 			<input name="no_bm_copy" type="text" id="no_bm_copy" value="<?php echo $idx; ?>" hidden />
										 		</div>
										 	</div>

										 	<div class="item form-group">
										 		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
										 			Tanggal
										 		</label>
										 		<div class="col-md-3 col-sm-6 col-xs-12">

										 			<script type="text/javascript" src='<?php echo base_url();?>build/source_ant/js/jquery-1.3.2.js'></script>

										 			<script type="text/javascript">
										 			var site = "<?php echo site_url();?>";
										 			var jx = $.noConflict(true);
										 			jx(document).ready(function() {
										 				jx("#tgl_trans").change(function (e) {
										 					var var_1 = jx("#tgl_trans").val();
										 					var var_2 = jx("#keterangan").val();
										 					//alert(var_1);

										 				//jx("#user-result_x").html('<img src="../../Tools/css/ajax-loader.gif" />');
										 					jx.post(site+'/Jp_2/create_bm', {'var1':var_1, 'var2':var_2}, function(data) {
										 						jx("#user-result_x").html(data);
										 						document.getElementById('tgl_trans').value = var_1;
										 						var tot_simpanan = document.getElementById("x_bm").value;
										 						document.getElementById('no_bm').value = tot_simpanan;
										 					});
										 				});
										 			});
										 			</script>

										 			<span id="user-result_x"></span>

										 			<input type="date" name="tgl_trans" id="tgl_trans" class="form-control col-md-7 col-xs-12"
										 				value="<?php echo $tgl_trans_x; ?>" />
										 		</div>
										 	</div>

										 	<div class="item form-group">
										 		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
										 			Keterangan
										 		</label>
										 		<div class="col-md-8 col-sm-6 col-xs-12">
										 										<textarea id="keterangan" class="form-control" name="keterangan" ><?php echo $keterangan_x; ?></textarea>

										 			<!--<input type="text" class="form-control col-md-7 col-xs-12" required
										 			name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php //echo $keterangan_x; ?>"/>-->
										 		</div>
										 	</div>

										 	<div class="ln_solid"></div>

										 	<div id="btn_action">

										 	<a href="<?php echo site_url('Gltransjalan/cetak/'.$idx); ?>"


										 					 <button  type="submit" class="btn btn-warning" id="button_cetak" name="button_cetak"  ><i class="fa fa-print"></i> Cetak</button>

										 		</a>

										 		<?php
										 		if($hak_d == 1){
										 			?>

										 	 <button  type="button" class="btn btn-danger" id="button_delete" value="Hapus" name="button_delete" onclick="redirect_2();"><i class="fa fa-trash"></i> Hapus</button>

										 			<script>
										 			function redirect_2(){
										 				if(confirm("Hapus <?php echo $idx; ?>")){
										 					//alert('Yes');
										 					var no_bukti = document.getElementById('no_bm').value;
										 					if(no_bukti === ""){
										 						alert('BUKTI HARUS DIISI');
										 					} else {
										 						var url_2 = "<?php echo base_url('Jp_2/delete_key'); ?>?no_bukti_fil=" + no_bukti;
										 						window.location.href = url_2;
										 						//alert(url_2);
										 					}
										 				} else {
										 					return false;
										 				}
										 			}
										 			</script>

										 			<?php
										 		}
										 		?>

										 	</div>

										 	<div class="form-group">
										 		<!--<input type="submit" class="btn-primary" name="btn_proses" value="<?php echo $vl_buton; ?>" />-->
										 	</div>
										 </div>
                 </div>
                 <!-- /.box-body -->

                 <!-- /.box-footer -->
                 </div>
             </div>

       </div>



       </div>

			 <div class="row">
			 	<!-- left column -->
			 	<div class="col-md-12">
			 		<div class="box box-info">
			 				<div class="box-header with-border">
			 					<h3 class="box-title"><i class="fa fa-cubes"></i> Pilih Akun</h3>
			 				</div>


			 						<div class="box-body">
			 							<!-- /.isi table -->

			 							<div class="col-xs-12 table-responsive">
											<div class="x_panel">

												<div class="x_content">
												<div class="item form-group">
													<table border="0" width="100%"
																style="border-collapse: separate; border-spacing: 2px;">
																<tr height="30px" style="background-color:#B9B9B9; color:white; text-align:center; font-weight:bold;">
															<td width="30%">Filter</td>
															<td width="10%">Posisi</td>
															<td width="10%">Akun</td>
															<td width="30%">Nama Akun</td>
															<td width="15%">Nominal</td>
															<td width="5%">Action</td>
														</tr>
														<tr>
															<td>
																<input onclick="LPS()" style="background:rgb(204,255,102);"
																	class="akunsearch form-control col-md-7 col-xs-12"
																	name="filterakun" type="text" id="filterakun" placeholder="Kode COA" />
															</td>
															<td>
																<select class="form-control" name="dk" id="dk">
																	<option value="DEBET">Debet</option>
																	<option value="KREDIT">Kredit</option>
																</select>
															</td>
															<td>
																<input type="text" name="kode_akun" id="kode_akun" readonly
																	class="form-control col-md-7 col-xs-12" />
															</td>
															<td>
																<input name="nama_akun" type="text" id="nama_akun" readonly
																	class="form-control col-md-7 col-xs-12" />
															</td>
															<td>
																<input name="nominal" type="number" id="nominal"
																	class="form-control col-md-7 col-xs-12" style="text-align:right;" />

																<input type="number" name="nominal_x" id="nominal_x"
																	value="0" hidden />
															</td>
															<td style="text-align:center;">
																<script type="text/javascript" src='<?php echo base_url();?>build/source_ant/js/jquery-1.4.2.min.js'></script>
																<script type="text/javascript" src='<?php echo base_url();?>build/source_ant/js/append_akun_jp.js'></script>

																<input type="hidden" id="site_url_x" value="<?php echo base_url();?>">

																<input type="button" class="btn btn-info" name="add_btn_bm"
																	value="Input" id="add_btn_bm"
																	onClick="aTotal_();" />
															</td>
														</tr>
													</table>
												</div>
												</div>
								            </div>
			 						 </div>
			 						<!-- /.box-body -->

			 						<!-- /.box-footer -->
			 						</div>
			 				</div>

			 	</div>



			 	</div>


				<div class="row">
 			 	<!-- left column -->
 			 	<div class="col-md-12">
 			 		<div class="box box-info">
 			 				<div class="box-header with-border">
 			 					<h3 class="box-title"><i class="fa fa-cubes"></i> Posting Buku Besar</h3>
 			 				</div>


 			 						<div class="box-body">
 			 							<!-- /.isi table -->

 			 							<div class="col-xs-12 table-responsive">
											<div class="col-md-12 col-sm-6 col-xs-12">
												<div class="x_panel">

													<div class="x_content">
													<div class="item form-group">
													<table border="0"  width="100%" style="background:#FFFFFF; border-collapse:separate; border-spacing:1px;">
														<thead>
														<tr>
															<td height="30px" style="background-color:#00A9FB; color:white; text-align:center; font-weight:bold;"
																colspan='7' align='center'>
																Perkiraan Jurnal
															</td>
														<tr height="30px" style="background: #337ab7; color:white;" class="td_only">
															<th style="width:3%; text-align:center;">No</th>
															<th style="width:22%; text-align:center;">Nama Akun</th>
															<th style="width:10%; text-align:center;">Kode Akun</th>
															<th style="width:35%; text-align:center;">Keterangan</th>
															<th style="width:12%; text-align:center;">Debet</th>
															<th style="width:12%; text-align:center;">Kredit</th>
															<th style="width:5%; text-align:center;">Action</th>
														</tr>
														</thead>
														<tbody id="containerBM" style="height: 100px; overflow: auto;">

														<?php
														if($kode_proses == ''){
															// isi dengan data ppd
														} else {
															$count = 0;

															foreach ($jpen_edit as $dt_jpen_jur){
																$count = $count + 1;
																if($dt_jpen_jur->jml_D_x != 0){
																	?>

																	<tr class="records" style="color:white;">
																		<td align="center">
																			<div hidden id = "<?php echo $count; ?>"> <?php echo $count; ?> </div>
																			<input class="form-control col-md-2 col-xs-12"  style="width:100%; text-align:left" type="text"
																				value="<?php echo $count; ?>" readonly />
																		</td>
																		<td>
																			<input class="form-control col-md-2 col-xs-12" style="width:100%;" id="nama_akun_<?php echo $count; ?>"
																				name="nama_akun_<?php echo $count; ?>" type="text"
																				value="<?php echo $dt_jpen_jur->nama_x; ?>" readonly />
																		</td>
																		<td>
																			<input class="form-control col-md-2 col-xs-12" style="width:100%;" id="x_kode_akun_<?php echo $count; ?>"
																				name="x_kode_akun_<?php echo $count; ?>" type="text"
																				value="<?php echo $dt_jpen_jur->kd_akun_x; ?>" readonly />
																		</td>
																		<td>
																			<input class="form-control col-md-2 col-xs-12" style="width:100%;" id="keterangan_<?php echo $count; ?>"
																				name="keterangan_<?php echo $count; ?>" type="text"
																				value="<?php echo $dt_jpen_jur->keterangan_x; ?>"  />
																		</td>
																		<td>
																			<span class="nilaiD" hidden><?php echo $dt_jpen_jur->jml_D_x; ?></span>
																			<input class="form-control col-md-2 col-xs-12" style="width:100%; text-align:right;"
																				id="nilai_debet_<?php echo $count; ?>"
																				name="nilai_debet_<?php echo $count; ?>" type="text"
																				value="<?php echo ($dt_jpen_jur->jml_D_x); ?>" />
																		</td>
																		<td>
																			<span class="nilaiK" hidden><?php echo $dt_jpen_jur->jml_K_x; ?></span>
																			<input class="form-control col-md-2 col-xs-12" style="width:100%; text-align:right; "
																				id="nilai_kredit_<?php echo $count; ?>"
																				name="nilai_kredit_<?php echo $count; ?>" type="text"
																				value="<?php echo ($dt_jpen_jur->jml_K_x); ?>" />
																		</td>
																		<td align="center">
																			<input id="rows_<?php echo $count; ?>" name="rowsBM[]"
																				value="<?php echo $count; ?>" type="hidden" />
																			<a class="remove_item" href="#" >
																				<img src="<?=base_url('/')?>build/source_ant/picture/table_delete.png" width="16" height="16" />
																			</a>
																		</td>
																	</tr>
																	<tr>
																		<td colspan="7">
																			<div hidden>
																				<input
																					name="kdsubunit_<?php echo $count; ?>" type="text"
																					value="<?php echo $dt_jpen_jur->kd_sub_unit_x; ?>" />
																				<input
																					name="ma_<?php echo $count; ?>" type="text"
																					value="<?php echo $dt_jpen_jur->modul_asal_x; ?>" />
																				<input
																					name="tt_<?php echo $count; ?>" type="text"
																					value="<?php echo $dt_jpen_jur->tipe_trans_x; ?>" />
																				<input
																					name="di_<?php echo $count; ?>" type="text"
																					value="<?php echo $dt_jpen_jur->del_indek_x; ?>" />
																				<input
																					name="kdp_<?php echo $count; ?>" type="text"
																					value="<?php echo $dt_jpen_jur->kd_person_x; ?>" />
																				<input
																					name="tb_<?php echo $count; ?>" type="text"
																					value="<?php echo $dt_jpen_jur->tipe_bayar_x; ?>" />
																				<input
																					name="kdjp_<?php echo $count; ?>" type="text"
																					value="<?php echo $dt_jpen_jur->kd_jp_x; ?>" />
																				<input
																					name="entry_datexx_<?php echo $count; ?>" type="text"
																					value="<?php echo $dt_jpen_jur->entry_date_x; ?>" />
																				<input
																					name="user_entryxx_<?php echo $count; ?>" type="text"
																					value="<?php echo $dt_jpen_jur->user_entry_x; ?>" />
																				<input
																					name="jml_transxx_<?php echo $count; ?>" type="text"
																					value="<?php echo $dt_jpen_jur->jml_trans_x; ?>" />
																				<input
																					name="nama_akunxx_<?php echo $count; ?>" type="text"
																					value="<?php echo $dt_jpen_jur->nama_akun_x; ?>" />
																				<input
																					name="kd_reklasxx_<?php echo $count; ?>" type="text"
																					value="<?php echo $dt_jpen_jur->kd_reklas_x; ?>" />
																			</div>
																		</td>
																		</tr>

																		<?php
																} else {
																	?>

																	<tr class="records">
																		<td align="center">
																			<div hidden id = "<?php echo $count; ?>"> <?php echo $count; ?> </div>
																			<input  class="form-control col-md-2 col-xs-12"  style="width:100%; text-align:left" type="text" value="<?php echo $count; ?>" readonly />
																		</td>
																		<td>
																			<input class="form-control col-md-2 col-xs-12"  style="width:100%;" id="nama_akun_<?php echo $count; ?>"
																				name="nama_akun_<?php echo $count; ?>" type="text"
																				value="<?php echo $dt_jpen_jur->nama_x; ?>" readonly />
																		</td>
																		<td>
																			<input class="form-control col-md-2 col-xs-12"  style="width:100%;" id="x_kode_akun_<?php echo $count; ?>"
																				name="x_kode_akun_<?php echo $count; ?>" type="text"
																				value="<?php echo $dt_jpen_jur->kd_akun_x; ?>" readonly />
																		</td>
																		<td>
																			<input class="form-control col-md-2 col-xs-12"  style="width:100%;" id="keterangan_<?php echo $count; ?>"
																				name="keterangan_<?php echo $count; ?>" type="text"
																				value="<?php echo $dt_jpen_jur->keterangan_x; ?>"   />
																		</td>
																		<td>
																			<span class="nilaiD" hidden><?php echo $dt_jpen_jur->jml_D_x; ?></span>
																			<input class="form-control col-md-2 col-xs-12"  style="width:100%; text-align:right;"
																				id="nilai_debet_<?php echo $count; ?>"
																				name="nilai_debet_<?php echo $count; ?>" type="text"
																				value="<?php echo number_format($dt_jpen_jur->jml_D_x); ?>" />
																		</td>
																		<td>
																			<span class="nilaiK" hidden><?php echo $dt_jpen_jur->jml_K_x; ?></span>
																			<input class="form-control col-md-2 col-xs-12"  style="width:100%; text-align:right;"
																				id="nilai_kredit_<?php echo $count; ?>"
																				name="nilai_kredit_<?php echo $count; ?>" type="text"
																				value="<?php echo ($dt_jpen_jur->jml_K_x); ?>" />
																		</td>
																		<td align="center">
																			<input id="rows_<?php echo $count; ?>" name="rowsBM[]"
																				value="<?php echo $count; ?>" type="hidden" />

																			<a class="remove_item" href="#" >
																				<img src="<?=base_url('/')?>build/source_ant/picture/table_delete.png" width="16" height="16" />
																			</a>
																		</td>
																	</tr>

																	<tr>
																		<td colspan="7">
																			<div hidden>
																			<input
																				name="kdsubunit_<?php echo $count; ?>" type="text"
																				value="<?php echo $dt_jpen_jur->kd_sub_unit_x; ?>" />
																			<input
																				name="ma_<?php echo $count; ?>" type="text"
																				value="<?php echo $dt_jpen_jur->modul_asal_x; ?>" />
																			<input
																				name="tt_<?php echo $count; ?>" type="text"
																				value="<?php echo $dt_jpen_jur->tipe_trans_x; ?>" />
																			<input
																				name="di_<?php echo $count; ?>" type="text"
																				value="<?php echo $dt_jpen_jur->del_indek_x; ?>" />
																			<input
																				name="kdp_<?php echo $count; ?>" type="text"
																				value="<?php echo $dt_jpen_jur->kd_person_x; ?>" />
																			<input
																				name="tb_<?php echo $count; ?>" type="text"
																				value="<?php echo $dt_jpen_jur->tipe_bayar_x; ?>" />
																			<input
																				name="kdjp_<?php echo $count; ?>" type="text"
																				value="<?php echo $dt_jpen_jur->kd_jp_x; ?>" />
																			<input
																				name="entry_datexx_<?php echo $count; ?>" type="text"
																				value="<?php echo $dt_jpen_jur->entry_date_x; ?>" />
																			<input
																				name="user_entryxx_<?php echo $count; ?>" type="text"
																				value="<?php echo $dt_jpen_jur->user_entry_x; ?>" />
																			<input
																				name="jml_transxx_<?php echo $count; ?>" type="text"
																				value="<?php echo $dt_jpen_jur->jml_trans_x; ?>" />
																			<input
																				name="nama_akunxx_<?php echo $count; ?>" type="text"
																				value="<?php echo $dt_jpen_jur->nama_akun_x; ?>" />
																			<input
																				name="kd_reklasxx_<?php echo $count; ?>" type="text"
																				value="<?php echo $dt_jpen_jur->kd_reklas_x; ?>" />
																			</div>
																		</td>
																	</tr>

																	<?php
																}
															}
														}
														?>

														</tbody>
														<tr style="background-color:#B0B0AD; color:white;">
															<td align="center">
																<input type="number" class="key_max" id="key_max" style="background-color:#eea236; color:black;" hidden />
															</td>
															<td align="center">&nbsp;</td>
															<td align="center"></td>
															<td align="right">Total &nbsp;</td>
															<td align="right">
																<span id="totalTextSumD">0</span>
																<input  type="text" id="SUM1" name="SUM1" style="color:#000000" hidden />
															</td>
															<td align="right">
																<span id="totalTextSumK">0</span>
																<input type="text" id="SUM2" name="SUM2" style="color:#000000" hidden />
																<input type="text" id="TOTAL" name="TOTAL" style="color:#000000" hidden />
															</td>
															<td style="font-weight:bold" align="center"></td>
														</tr>
													</table>
												</div>

												<?php
												if($hak_c == 1){
													?>
													<div class="ln_solid"></div>
													<div class="item form-group">

																					<button  type="submit" class="btn btn-success" name="btn_proses" value="<?php echo $vl_buton; ?>" ><i class="fa fa-floppy-o"></i> <?php echo $vl_buton; ?></button>

													</div>

													<?php
												}
												?>
													</div>
												</div>
									        </div>
 			 						 </div>
 			 						<!-- /.box-body -->

 			 						<!-- /.box-footer -->
 			 						</div>
 			 				</div>

 			 	</div>



 			 	</div>



     <!-- /.row -->
   </section>


     <!-- title row -->

     <!-- /.row -->

     <!-- Table row -->

     <!-- /.row -->


     <!-- /.row -->


   <!-- /.content -->
 </div>
</form>

 <?php include 'includefile/foot.php'; ?>
