<?php $id = get_cookie('eklinik'); ?>
<!doctype html>
<html lang="en">
<head>
	<title><?= $this->session->userdata('nama_perusahaan'.$id)?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>build/images/logo.png" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="<?php echo base_url('build/css/bootstraps.css')?>"/>
	<link href="<?php echo base_url('build/css/style_view.css') ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('build/css/paper.css') ?>" rel="stylesheet" type="text/css" />
	<style>@page {size: A4 landscape}</style>
	<style type="text/css">

				hr.thin {
				height: 1px;
				border: 0;
				color: #333;
				background-color: #333;
				width: 100%;
				}

	</style>
</head>

<body>

	<div id="printableArea">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" id="testTable">
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
		<table width="100%" border="0" cellspacing="1" cellpadding="1">
		<tbody>

					<tr>
					<td width="20%" rowspan="5"><img src="<?php echo base_url(); ?>build/images/logo.png" width="221" height="77" alt=""/></td>
					<td align="right"><h2><?= $this->session->userdata('nama_perusahaan'.$id)?></h2></td>
					</tr>
					<tr>
					<td align="right"> <?= $this->session->userdata('alamat_perusahaan'.$id)?> </td>
					</tr>

					<tr align="right">
					<td>Telepon:
					  <?= $this->session->userdata('telepon_perusahaan'.$id)?></td>
					</tr>
					<tr align="right">
					<td>Email:
					  <?= $this->session->userdata('email_perusahaan'.$id)?></td>
					</tr>
		</tbody>
		</table>

<hr style="height:0px;border:0.5px solid black;"/>
	    <div align="center">
	        <h3 style="border: 0px solid #333;"><?php echo $title ?><br>
	          Periode : <?php echo format_tanggal($xtglawal); ?> s/d <?php echo format_tanggal($xtglakhir); ?> </h3>

	        <table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse; ">
	            <tr>
	              <th colspan="7"><hr style="height:0px;border:0.5px solid black;"/></th>
	              <th>&nbsp;</th>
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

	             <tr>
	              <td colspan="7"><hr style="height:0px;border:0.5px solid black;"/></td>
	              <td align="left">&nbsp;</td>
                </tr>

								<?php
 							 //declare 0-1
 							 //$petik = "<font style=color:rgba(0, 0, 0, 0);>'</font>";

 							 //looping ke 1
 							 foreach ($dt_unit_x_l1 as $dt){
 								 //declare 1-1
 								 $kd_akun_x = $dt['kd_akun'];

 								 //declare 1-2
 								 $get_query_saldoAkun = $this->CI->get_saldoAkun($awal_tahun,$tglawal, $bln_repx, $kd_akun_x, $tahun_kemarin);
 								 $saldo_a = $get_query_saldoAkun;
 								 ?>

 								 <tr height="30px" class="td_only" style="font-weight:bold; color:rgb(0,0,0); background:#D3D1D1">
 									 <td align="left" style="width:15%; font-weight:bold;">&nbsp;
									 <?php
 										 echo $dt['kd_akun'].' - '.ucwords(strtolower($dt['nama']));
 										 ?></td>
									 <th style="width:15%; text-align:center;">&nbsp;</th>
	 								<th style="width:5%; text-align:center;"> </th>
	 								<th style="width:30%; text-align:center;"> </th>
	 								<th style="width:10%; text-align:center;"> </th>
 									 <td align="right" style="width:10%;">Saldo Awal </td>
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

 								 <tr class="td_only" bgcolor="#EAEAEA">
 									 <td height="25" style="width:5%;"></td>
 									 <td style="width:15%;"></td>
 									 <td style="width:5%;"></td>
 									 <td style="width:30%; font-weight:bold;" align="left">
 										 Total
 									 </td>
 									 <td style="font-weight:bold; ; width:10%;" align="right">
 										 <?php  echo number_format($total_d,2); ?>
 									 </td>
 									 <td style="font-weight:bold;  width:10%;" align="right">
 										 <?php  echo number_format($total_k,2); ?>
 									 </td>
 									 <td style="font-weight:bold; width:15%;" align="right">
 										 <?php  echo number_format($saldo_a,2); ?>
 									 </td>
 								 </tr>
                                 <tr><td colspan="7">&nbsp;</td></tr>
 								 <?php
 							 }
 							 ?>


                <br>
                <tr>
                  <td colspan="8"><hr style="height:0px;border:0.5px solid black;"/></td>
                </tr>
                <tr>
	              <td colspan="6" align="right" style="font-weight:bold">Grand Total&nbsp;&nbsp;</td>
                  <td align="right" style="font-weight:bold"> <?php  //echo number_format($grandtotal);?> &nbsp;&nbsp;</td>
				  <td align="left">&nbsp;</td>

	              </tr>

	        </table>

	    </div>






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
w.document.write('<style>@page { size: A4 landscape }</style>');
w.document.write('<style>* {color: black;} .td_only td, .td_only th {border: 1px solid black; border-collapse: collapse;}</style>');
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
                  <button type="button" class="btn btn-danger"
                    onclick="printDiv('printableArea');">
                    Print
                  </button>

                  <?php
                  $nama_excel_as = 'Buku Besar';
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


                  <button type="button" id="btnExport">
                    Export to Excel
                  </button>
                </div>
      </td>
    </tr>
  </tbody>
</table>
</body>
</html>
