 <?php include 'includefile/Header.php'; ?>

		<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3> </h3>
              </div>
            </div>
			<div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                <div class="x_title">
					<h2>Buku Besar <small> general ledger</small></h2>
					<ul class="nav navbar-right panel_toolbox">
						<li>
							<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
					</ul>

					<div class="clearfix"></div>
				</div>
                  <div class="x_content">

					<?php
					if($hak_c == 1){
						?>

						<?php
						ini_set('display_errors', 0);
						$btn_proses = $_POST['btn_proses'];
						if($btn_proses != 'Proses'){
							/*echo '<br> btn_proses '.$btn_proses;*/
						} else {
							$idplant_sea = $_POST['id_plant'];
							$tglawal = $_POST['tglawal'];
							$tglakhir = $_POST['tglakhir'];
							$filter_akun = $_POST['filter_akun'];
							$kd_akun = $_POST['fil_kd_akun'];
							$nama_akun = $_POST['fil_nama_akun'];
							?>

							<script type="text/javascript"
								src="<?=site_url('/')?>build/source_ant/js/jquery.min.js"></script>
							<script type="text/javascript">
							$(window).load(function(){
								$('#bs-example-modal-lg').modal('show');
							});

							//alert("Tunggu loading selesai, silakan tekan (Lihat) untuk melihat hasil.");
							</script>

							<?php
						}
						?>

						<form class="form-horizontal form-label-left" action="<?php echo site_url('/').'Bb_2/tampil_datax'; ?>" method="POST"
							enctype="multipart/form-data" name="">

							<script type="text/javascript"
								src="<?=site_url('/')?>build/source_ant/js/jquery-1.7.2.js"></script>

							<script type="text/javascript">
							var c1 = $.noConflict(true);
							c1(document).ready(function(){
								c1('input[id="tgl_awal"]').change(function(){
									//Date in full format alert(new Date(this.value));
									var js_tgl_awal = this.value;
									var date = new Date(js_tgl_awal);
									var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
									var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
									var bulan = (lastDay.getMonth() + 1).toString();
									var karakter_bulan = bulan.length;
									if (karakter_bulan == 2 ) {
										var lastDayWithSlashes = lastDay.getFullYear() + '-' + bulan + '-' + (lastDay.getDate());
									} else {
										var lastDayWithSlashes = lastDay.getFullYear() + '-0' + bulan + '-' + (lastDay.getDate());
									}
									//alert(lastDayWithSlashes);
									document.getElementById('tgl_akhir').value = lastDayWithSlashes;
								});
							});
							</script>

							<!-- Memanggil file .css untuk proses autocomplete -->
							<link href="<?=site_url('/')?>build/source_ant/css/style_auto.css" rel="stylesheet">

							<!-- Memanggil file .js untuk proses autocomplete -->
							<script type='text/javascript' src='<?php echo site_url('/');?>build/source_ant/js/jquery-1.8.2.min.js'></script>
							<script type='text/javascript' src='<?php echo site_url('/');?>build/source_ant/js/jquery.autocomplete.js'></script>

							<script type='text/javascript'>
							var jq_auto = $.noConflict(true);
							var site = "<?php echo site_url();?>";
							jq_auto(function(){
								jq_auto('.autocomplete').autocomplete({
									// serviceUrl berisi URL ke controller/fungsi yang menangani request kita
									serviceUrl: site+'/autocomplete/search_akun',
									// fungsi ini akan dijalankan ketika user memilih salah satu hasil request
									onSelect: function (suggestion) {
										jq_auto('#fil_kd_akun').val(''+suggestion.kd_akun);
										jq_auto('#fil_nama_akun').val(''+suggestion.nama);
									}
								});
							});
							</script>

							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
									Plant
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="form-control" name="id_plant" required >
										<option value=''>Pilih Plant</option>

										<?php
										foreach ($combo_plant as $plant) {
											if ($idplant_sea != $plant[id_plant]){
												echo "<option value='$plant[id_plant]'>$plant[nama]</option>";
											} else {
												echo "<option selected='selected' value='$plant[id_plant]'>$plant[nama]</option>";
											}

											//echo "<option value='$plant[id_plant]'>$plant[nama]</option>";
										}
										?>

									</select>
								</div>
							</div>

							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
									Periode
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">

									<?php
									include('now.php');
									//echo 'Hari ini : '.$today;
									if($btn_proses != 'Proses'){
										$firstday = date('Y-m-01');
										$lastday = date('Y-m-d', mktime(0,0,0,date('m')+1,0,date('Y')));
									} else {
										$firstday = $tglawal;
										$lastday = $tglakhir;
									}
									?>

									<input class="form-control col-md-7 col-xs-12"
										type="date" name="tglawal" id="tgl_awal"
										value="<?php echo $firstday; ?>" maxlength="8"  />
								</div>
							</div>

							<div class="item form-group" >
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
									Sampai
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input class="form-control col-md-7 col-xs-12"
										type="date" name="tglakhir" id="tgl_akhir"
										value="<?php echo $lastday; ?>" maxlength="8" />
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
									Filter Akun
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="search" placeholder="Nama / Kode"
										name="filter_akun" id="filter_akun" style="background:rgb(204,255,102)"
										class='autocomplete form-control col-md-7 col-xs-12'
										value="<?php echo $filter_akun; ?>" onClick="Clear_filter();" />
								</div>
							</div>

							<script type="text/javascript">
							function Clear_filter(){
							   document.getElementById("filter_akun").value= "";
							}
							</script>

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
									Kode Akun
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input class="form-control col-md-7 col-xs-12"
										type="text" name="fil_kd_akun" id="fil_kd_akun"
										value="<?php echo $kd_akun; ?>" placeholder="Auto Kode Akun" readonly />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
									Nama Akun
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input class="form-control col-md-7 col-xs-12"
										type="text" name="fil_nama_akun" id="fil_nama_akun"
										value="<?php echo $nama_akun; ?>" placeholder="Auto Nama Akun" readonly />
								</div>
							</div>


<div class="ln_solid"></div>
							<div class="form-group">
								<input type="submit" class="btn btn-primary" name="btn_proses" value="Proses" />
								<button type="button" class="btn btn-warning"
									data-toggle="modal" data-target="#bs-example-modal-lg">
									Lihat
								</button>
							</div>
						</form>


						<style>
						.modal-dialog {
							width: 100%;
							height: 50%;
							padding-top: 2%;
							padding-bottom: 5%;
							padding-left: 5%;
							padding-right: 5%;
							margin: 0;
						}
						.modal-content {
							height: 50%;
							min-height: 50%;
							height: auto;
							border-radius: 0;
						}
						</style>

						<div class="modal fade bs-example-modal-lg" tabindex="-1"
							role="dialog" aria-hidden="false" id="bs-example-modal-lg" >
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">
											<span aria-hidden="true">×</span>
										</button>
										<h2 class="modal-title" id="myModalLabel">
											Laporan Buku Besar


											<?php
											$kd_unit = $_POST['id_plant'];

											include('get_month.php');

											$tgl_rep = substr($tglawal,8,2);
											$bln_rep = substr($tglawal,5,2);
											$bln_repx = substr($tglawal,5,2);
											$tahun_rep = substr($tglawal,0,4);
											$bln_rep = bulan($bln_rep);

											$tgl_rep2 = substr($tglakhir,8,2);
											$bln_rep2 = substr($tglakhir,5,2);
											$tahun_rep2 = substr($tglakhir,0,4);
											$bln_rep2 = bulan($bln_rep2);

											$awal_tahun = $tahun_rep."-01-01";
											$tahun_kemarin = $tahun_rep-1;

											$nama_excel_as = 'Laporan Buku Besar ('.$tglawal.'-'.$tglakhir.')';
											//$koma = "<font color=\"rgba(0,0,0,0);\">'</font>";
											?>

										</h2>
									</div>

									<!-- start css untuk scroll -->
									<style>
									/*untuk header and footer tabel*/
									.scroll {
										margin-left:1%;
										margin-right:1%;
										width:98%;
										text-align:center;
										border: 2px #337ab7;
									}
									.scroll thead tr:after {
										content: '';
										overflow-y: scroll;
										visibility: hidden;
										height: 0;
										width: 1;
									}
									.scroll tbody {
									  display: block;
									  width: 100%;
									  overflow-y: auto;
									  height: 360px;
									  border: 0px solid red;
									}
									.scroll tr {
										display:flex;
									}
									.scroll td {
										display: block;
										flex: 1 auto;
										/*border: 1px solid #aaa;*/
									}
									/*zebra table*/
									.zebra {
										border-collapse:collapse;
									}
									.zebra tr:nth-child(even) {
										background-color:#cae0f3;
									}
									.zebra tr:nth-child(odd) {
										background-color:white;
										/*border-color:#ddd;*/
									}
									.zebra tr:hover {
										background-color:#a0c7e8;
										/*color:#FFFFFF;*/
									}
									</style>
									<!-- end css untuk scroll -->

									<div id="printableArea">
										<div class="A4_ landscape">
										<section class="sheet padding-10mm">
											<div style="width:100%; padding-bottom:5px;padding-top:5px;">
												<input type="text" value="<?php echo $nama_excel_as; ?>" id="nama_excel_as" hidden />
												<!-- end tambahan untuk excel -->

												<div class="modal-body">
												  <table width="100%" border="0" cellspacing="1" cellpadding="1">
												    <tbody>
												      <tr>
												        <td width="6%" rowspan="5"><img src="<?php echo base_url('build/images/logo.png')?>" width="91" height="77" alt=""/></td>
												        <td align="right"><h2>
												          <?= $this->session->userdata('nama_perusahaan'.$id)?>
												          </h2></td>
											          </tr>
												      <tr>
												        <td align="right"><?= $this->session->userdata('alamat_perusahaan'.$id)?></td>
											          </tr>
												      <tr>
												        <td align="right">Telepon:
												          <?= $this->session->userdata('telepon_perusahaan'.$id)?></td>
											          </tr>
												      <tr>
												        <td align="right">Email:
												          <?= $this->session->userdata('email_perusahaan'.$id)?></td>
											          </tr>
											        </tbody>
											      </table>
												  <hr style="height:0px;border:0.5px solid black;"/>


													<table class="scroll" border="0" id="testTable" width="100%" style="background:#FFFFFF; border-collapse: collapse;">
													<thead>
														<tr>
															<td colspan="7" style="font-weight:bold; background:#FFFFFF;">
																<div style="text-align:center;">
																	<h3><b> BUKU BESAR / GENERAL LEDGER </b></h3>
																</div>
																<div style="text-align:left">
																	Periode &emsp;
																	<?php
																	echo ' : '.$tgl_rep.' '.$bln_rep.' '.$tahun_rep.
																		'&nbsp; - &nbsp;'.$tgl_rep2.' '.$bln_rep2.' '.$tahun_rep2;
																	?>
																	<br>
																	Plant &emsp; &emsp;
																	<?php
																	$kd_unit_pilih = $idplant_sea;
																	$nilai_plant_pilih = $this->CI->get_nama_plant($kd_unit_pilih);
																	echo ' : '.$idplant_sea.' ('.$nilai_plant_pilih.')';
																	?>
																	<br><br>
																</div>
															</td>
														</tr>
														<tr style="font-weight:bold; background:#787878; height:30px; color:white;" class="td_only">
															<th style="width:5%; text-align:center;"> Akun</th>
															<th style="width:15%; text-align:center;">No Bukti</th>
															<th style="width:5%; text-align:center;">Tgl Trans</th>
															<th style="width:30%; text-align:center;">Keterangan</th>
															<th style="width:10%; text-align:center;">Debet</th>
															<th style="width:10%; text-align:center;">Kredit</th>
															<th style="width:15%; text-align:center;">Total</th>
														</tr>

													</thead>
													<tbody class="zebra" style="color: black;">

													<?php
													//declare 0-1
													//$petik = "<font style=color:rgba(0, 0, 0, 0);>'</font>";

													//looping ke 1
													foreach ($dt_unit_x_l1 as $dt){
														//declare 1-1
														$kd_akun_x = $dt['kd_akun'];

														//declare 1-2
														$get_query_saldoAkun = $this->CI->get_saldoAkun($kd_unit, $awal_tahun, $tglawal, $bln_repx, $kd_akun_x, $tahun_kemarin);
														$saldo_a = $get_query_saldoAkun;
														?>

														<tr height="30px" class="td_only" style="font-weight:bold; color:rgb(0,0,0); background:#D3D1D1">
															<td colspan="4" align="left" style="width:15%; font-weight:bold;">
																<?php
																echo ucwords(strtolower($dt['nama']));
																?>
																<?php echo 'Kode Akun : '.$dt['kd_akun']; ?>
															</td>
															<td colspan="2" align="right" style="width:10%;">Saldo Awal </td>
															<td align="right" style="width:15%;">
																<?php echo number_format($saldo_a,2); ?>
															</td>
														</tr>

														<?php
														//declare 1-3
														$kd_akun_detail = $dt['kd_akun'];
														$total_d = 0;
														$total_k = 0;

														//looping ke 2
														foreach ($dt['dt_unit_x_l0'] as $dt_l0){
															//declare 2-1
															$saldo_a = $saldo_a + $dt_l0['jml_D'] - $dt_l0['jml_K'];
															$total_d = $total_d + $dt_l0['jml_D'];
															$total_k = $total_k + $dt_l0['jml_K'];
															?>

															<tr class="td_only">
																<td style="width:5%;"></td>
																<td style="width:15%;" align="left">
																	<?php
																	/*$no_bukti_ant = $dt_l0['no_bukti'];
																	$no_bukti_x = substr($no_bukti_ant,0,3);

																	if ($no_bukti_x == 'SBS') {
																		$query_cari_nokb = "select no_kb
																						from kbtrans
																						where no_bukti = '$no_bukti_ant'";
																		$result_cari_nokb = mysql_query($query_cari_nokb);
																		$no_kb_ant = mysql_result($result_cari_nokb,0,'no_kb');

																		echo $no_kb_ant;
																	} else {
																		echo $dt_l0['no_bukti'];
																	} */

																	echo $dt_l0['no_bukti'];
																	?>
																</td>
																<td align="center" style="width:5%;">
																	<?php
																	$tgl_transaksi = $dt_l0['tgl_trans'];
																	echo date("d-m-Y", strtotime($tgl_transaksi));
																	?>
																</td>
																<td style="width:30%;" align="left">
																	<?php echo ucwords(strtolower($dt_l0['keterangan'])); ?>
																</td>
																<td align="right" style="width:10%;">
																	<?php  echo number_format($dt_l0['jml_D'],2); ?>
																</td>
																<td align="right" style="width:10%;">
																	<?php  echo number_format($dt_l0['jml_K'],2); ?>
																</td>
																<td align="right" style="width:15%;">
																	<?php  echo number_format($saldo_a,2); ?>
																</td>
															</tr>

															<?php
														}
														?>

														<tr class="td_only">
															<td style="width:5%;"></td>
															<td style="width:15%;"></td>
															<td style="width:5%;"></td>
															<td style="width:30%; font-weight:bold;" align="left">
																Total
															</td>
															<td style="font-weight:bold; background:rgb(255,255,102); width:10%;" align="right">
																<?php  echo number_format($total_d,2); ?>
															</td>
															<td style="font-weight:bold; background:rgb(255,255,102); width:10%;" align="right">
																<?php  echo number_format($total_k,2); ?>
															</td>
															<td style="font-weight:bold; background:rgb(255,255,102); width:15%;" align="right">
																<?php  echo number_format($saldo_a,2); ?>
															</td>
														</tr>
														<?php
													}
													?>

													<?php
													if($btn_proses != 'Proses'){
														/*echo '<br> btn_proses '.$btn_proses;*/
													} else {
														?>

														<script type="text/javascript"
															src="<?=site_url('/')?>build/source_ant/js/jquery.min.js"></script>
														<script type="text/javascript">
														var jq_modal = $.noConflict(true);
														jq_modal(window).load(function(){
															jq_modal('#bs-example-modal-lg').modal('show');
														});
														//alert("Proses Selesai, Silakan Tekan (Lihat) untuk melihat hasil.");
														</script>

														<?php
													}
													?>

													<tfoot style="font-weight:bold; background: #337ab7; color:white;">
														<tr style="height:25px;">
															<td style="width:5%;"></td>
															<td style="width:15%;"> </td>
															<td style="width:15%;" align="center"></td>
															<td style="width:30%;" align="right"></td>
															<td style="width:10%;" align="right"></td>
															<td style="width:10%;" align="right"></td>
															<td style="width:15%;" align="right"></td>
														</tr>
													</tfoot>
													</table>
												</div>
											</div>
										</section>
										</div>
									</div>

									<!-- end tambahan untuk excel -->
									<div class="modal-footer">
										<!-- Print -->
										<script>
										function printDiv(divName) {
											var printContents = document.getElementById(divName).innerHTML;
											w = window.open();

											//css paper
											w.document.write('<title><?= $this->session->userdata('nama_perusahaan'.$id)?></title>');
							w.document.write('<link rel="shortcut icon" type="image/x-icon" href="<?php echo site_url('/'); ?>build/images/logo.png" />');
							w.document.write('<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> ');

							w.document.write('<link href="<?=site_url('/')?>build/css/bootstraps.css" rel="stylesheet" />');
							w.document.write('<link href="<?=site_url('/')?>build/css/style_view.css" rel="stylesheet" type="text/css" />');
							w.document.write('<link href="<?=site_url('/')?>build/css/paper.css" rel="stylesheet" type="text/css" />');
							w.document.write('<style>@page { size: A4 landscape }</style>');
							w.document.write('<style>* {color: black;} .td_only td, .td_only th {border: 1px solid black; border-collapse: collapse;}</style>');
							w.document.write(printContents);
							w.document.write('<script type="text/javascript"> window.onload = function() { window.print(); window.close(); };' + '</sc' + 'ript>');
							w.document.close(); //necessary for IE >= 10
							w.focus(); //necessary for IE >= 10

											return true;
										}
										</script>

										<!-- Print -->
										<button type="button" class="btn btn-danger"
											onclick="printDiv('printableArea');">
											Print
										</button>

										<!-- Export Excel -->
										<!-- start tambahan untuk excel -->
										<script data-require="jquery@*" data-semver="3.0.0" src="<?=site_url('/')?>build/source_ant/js/excel_ant_jquery.js"></script>
										<script src="<?=site_url('/')?>build/source_ant/js/script.js"></script>

										<script type="text/javascript">
										var jq_excel = $.noConflict(true);
										jq_excel(function() {
											jq_excel('#btnExport').click(function() {
												var table=document.getElementById('testTable').innerHTML;
												var table1="<html><head><style> table, td {border:thin solid black} table {border-collapse:collapse}</style></head><body><table>"+table+"</table></body></html>";
												var myBlob = new Blob([table1], {
													type: 'application/vnd.ms-excel'
												});
												var url = window.URL.createObjectURL(myBlob);
												var a = document.createElement("a");
												document.body.appendChild(a);
												a.href = url;
												var nama_excel_ex = document.getElementById('nama_excel_as').value;
												a.download = nama_excel_ex + ".xls";
												a.click();
												//adding some delay in removing the dynamically created link solved the problem in FireFox
												setTimeout(function() {
													window.URL.revokeObjectURL(url);
												}, 0);
											})
										})
										</script>

										<button type="button" class="btn btn-primary" id="btnExport">
											Export to Excel
										</button>
									</div>
								</div>
							</div>
						</div>

						<?php
						ini_set('display_errors', 1);
					}
					?>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

   <?php include 'includefile/Footer.php'; ?>
