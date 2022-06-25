<?php $id = get_cookie('eklinik'); ?>
<?php include 'kopsurat.php'; ?>

<body>

<div id="book" class="book">
      <div class="page" id="testTable">

									<table width="100%" border="0" cellspacing="0" cellpadding="0" id="testTableq">
									  <tbody>
									    <tr>
									      <td width="3%">&nbsp;</td>
									      <td width="95%">&nbsp;</td>
									      <td width="2%">&nbsp;</td>
									    </tr>
									    <tr>
									      <td>&nbsp;</td>
									      <td>
									      <div class="container">
									        <table width="100%" border="0">
									          <tr>
									            <td width="19%" rowspan="4"><img src="<?php echo base_url(); ?>build/images/logo.png" width="154" height="51" alt=""/></td>
									            <td colspan="7" align="right"><h2>
									              <?= $this->session->userdata('nama_perusahaan'.$id)?>
									              </h2></td>
								              </tr>
									          <tr>
									            <td width="6%">&nbsp;</td>
									            <td width="6%">&nbsp;</td>
									            <td width="9%">&nbsp;</td>
									            <td width="8%">&nbsp;</td>
									            <td width="8%">&nbsp;</td>
									            <td width="11%">&nbsp;</td>
									            <td width="39%" align="right"><?= $this->session->userdata('alamat_perusahaan'.$id)?></td>
								              </tr>
									          <tr>
									            <td>&nbsp;</td>
									            <td>&nbsp;</td>
									            <td>&nbsp;</td>
									            <td>&nbsp;</td>
									            <td>&nbsp;</td>
									            <td>&nbsp;</td>
									            <td align="right">Telepon:
									              <?= $this->session->userdata('telepon_perusahaan'.$id)?></td>
								              </tr>
									          <tr>
									            <td>&nbsp;</td>
									            <td>&nbsp;</td>
									            <td>&nbsp;</td>
									            <td>&nbsp;</td>
									            <td>&nbsp;</td>
									            <td>&nbsp;</td>
									            <td align="right">Email:
									              <?= $this->session->userdata('email_perusahaan'.$id)?></td>
								              </tr>
								            </table>
									        <hr style="height:0px;border:0.5px solid black;"/>
										     <table class="scroll" border="0" id="testTable"
														style="background:#FFFFFF; border-collapse: collapse;" width="100%">
													<thead>
														<tr>
															<td colspan="7" style="font-weight:bold; background:#FFFFFF;">
																<div align="center">
	        <h3 style="border: 0px solid #333;"><?php echo $title ?><br>
	          Periode : <?php echo format_tanggal($xtglawal); ?> s/d <?php echo format_tanggal($xtglakhir); ?> </h3>
	    </div></td>
														</tr>
														<tr style="font-weight:bold; background:#CCC;
															height:25px; color:white;" class="td_only">
															<th style="width:5%; text-align:center;">No</th>
															<th style="width:10%; text-align:center;">Kode Akun</th>
															<th style="width:30%; text-align:center;">Nama Akun</th>
															<th style="width:15%; text-align:center;">Saldo Awal</th>
															<th style="width:12%; text-align:center;">Debet</th>
															<th style="width:12%; text-align:center;">Kredit</th>
															<th style="width:15%; text-align:center;">Saldo Akhir</th>
														</tr>
													</thead>
													<tbody class="zebra" style="color: black;">

													<?php
													//declare 0-1
													$noxz=1;
													$total_d_lkh=0;
													$total_k_lkh=0;
													$saldo_awal=0;
													$saldo_akhir=0;
													$saldo_a=0;
													//$petik = "<font color=black>'</font>";

													//looping ke 1
													foreach ($dt_unit_x_l1 as $dt_l1){
														//declare 1-1
														$saldo_a = $saldo_a + $dt_l1->debet - $dt_l1->kredit;
														?>

														<tr class="td_only">
															<td style="width:5%;">
																<?php
																echo $noxz;
																?>

																<input type="text" name="rowsP[]" id="hapus_input"
																	value="<?php echo $noxz; ?>" hidden />
															</td>
															<td style="width:10%;">
																<?php
																echo $dt_l1->kd_akun;
																?>

																<input type="text" name="kd_akun_<?php echo $noxz; ?>" id="hapus_input"
																	value="<?php echo $dt_l1->kd_akun; ?>" hidden />
															</td>
															<td align="left" style="width:30%;">
																<?php echo ucwords(strtolower($dt_l1->namaakun)); ?>
															</td>
															<td align="right" style="width:15%;">
																<?php echo number_format($dt_l1->saldoawal,2); ?>
															</td>
															<td align="right" style="width:12%;">
																<?php echo number_format($dt_l1->debet,2); ?>
															</td>
															<td align="right" style="width:12%;">
																<?php echo number_format($dt_l1->kredit,2); ?>
															</td>
															<td align="right" style="width:15%;">
																<?php
																echo number_format($dt_l1->saldoakhir,2);
																?>

																<input type="text" name="saldo_akhir_<?php echo $noxz; ?>" id="hapus_input"
																	value="<?php echo $dt_l1->saldoakhir; ?>" hidden />
															</td>
														</tr>

														<?php
														$total_d_lkh = $total_d_lkh + $dt_l1->debet;
														$total_k_lkh = $total_k_lkh + $dt_l1->kredit;
														//echo '<br> $saldo_awal = '.$saldo_awal.' + '.$dt_l1->saldoawal;
														$saldo_awal = $saldo_awal + $dt_l1->saldoawal;
														//echo '<br> $saldo_akhir = '.$saldo_akhir.' + '.$dt_l1->saldoakhir;
														$saldo_akhir = $saldo_akhir + $dt_l1->saldoakhir;
														$noxz = $noxz+1;
													}
													?>

													</tbody>
													<tfoot style="margin-right:5%; font-weight:bold; background:#E6E6E6;
														color:white;">

														<tr style="height:25px;" class="td_only">
															<td style="width:5%;">
																<input type="text" name="tahun_simpan" id="hapus_input"
																	value="<?php echo substr($tglakhir,0,4); ?>" hidden />

																<input type="text" name="kd_unit_simpan" id="hapus_input"
																	value="<?php //echo $kd_unit; ?>" hidden />
															</td>
															<td style="width:10%;"> </td>
															<td style="width:30%;" align="center">
																<?php echo "Total"; ?>
															</td>
															<td style="width:15%;" align="right">
																<?php //echo $saldo_awal.'&nbsp; &nbsp;'; ?>
															</td>
															<td style="width:12%;" align="right">
																<?php echo number_format($total_d_lkh,2).'&nbsp; &nbsp;'; ?>
															</td>
															<td style="width:12%;" align="right">
																<?php echo number_format($total_k_lkh,2).'&nbsp; &nbsp;'; ?>
															</td>
															<td style="width:15%;" align="right">
																<?php //echo $saldo_akhir.'&nbsp; &nbsp;'; ?>
															</td>
														</tr>
													</tfoot>
													</table>






										    <script type="text/javascript" src="<?php echo base_url('build/js/jquery.printPage.js')?>"></script>
										    <script type="text/javascript">
										        $(document).ready(function(){
										            $(".btnPrint").printPage();
										        })
										    </script>

										</div>
									      </td>
									      <td>&nbsp;</td>
									    </tr>
									    <tr>
									      <td>&nbsp;</td>
									      <td>&nbsp;</td>
									      <td>&nbsp;</td>
									    </tr>
									  </tbody>
									</table>

</div>
</div>


<script>
		function printDiv(divName) {
		var printContents = document.getElementById(divName).innerHTML;
		w = window.open();
		//css paper
						w.document.write('<title><?= $this->session->userdata('nama_perusahaan'.$id)?></title>');
						w.document.write('<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('build/images/logo2.png')?>" />');
						w.document.write('<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> ');
						w.document.write('<link href="<?=base_url('build/css/bootstraps.css')?>" rel="stylesheet" />');
						w.document.write('<link href="<?=base_url('build/css/style_view.css')?>" rel="stylesheet" type="text/css" />');
						w.document.write('<link href="<?=base_url('build/css/paper.css')?>" rel="stylesheet" type="text/css" />');
						w.document.write('<style>@page { size: A4 portrait }</style>');
						//w.document.write('<style>* {color: black;} .td_only td, .td_only th {border: 1px solid black; border-collapse: collapse;}</style>');
						w.document.write(printContents);
						w.document.write('<script type="text/javascript"> window.onload = function() { window.print(); window.close(); };' + '</sc' + 'ript>');
						w.document.close(); //necessary for IE >= 10
						w.focus(); //necessary for IE >= 10
		return true;
		}
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td align="center">
      <div style="float:inherit;">
                  <!-- Print -->
                  <button type="button" class="btn btn-danger" onclick="printDiv('testTable');"> Print </button>

                  <?php
                  $nama_excel_as = 'Trial Balance';
                  ?>

                  <input type="text" value="<?php echo $nama_excel_as; ?>" id="nama_excel_as" hidden />

                  <!-- Export Excel -->
                  <!-- start tambahan untuk excel -->
				  				<script data-require="jquery" data-semver="2.2.0" src="<?=base_url('build/source_ant/js/jquery.min.js')?>"></script>
                  <script type="text/javascript" src="<?=base_url('build/source_ant/js/export-excel.jquery.min')?>"></script>
				  				<script type="text/javascript">
										var jq_excel = $.noConflict(true);
										jq_excel(function() {
										  jq_excel('#btnExport').click(function() {
											var table = document.getElementById('testTable').innerHTML;
											var table1 = table;
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


                  <button type="button" id="btnExport"> Export to Excel </button>
                </div>
      </td>
    </tr>
  </tbody>
</table>


</body>
</html>
