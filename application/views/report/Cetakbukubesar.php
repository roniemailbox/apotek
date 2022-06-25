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
										    <div align="center">
										        <h3 style="border: 0px solid #333;"><?php echo $title ?><br>
										          Periode : <?php echo format_tanggal($xtglawal); ?> s/d <?php echo format_tanggal($xtglakhir); ?> </h3>
										        <table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse; ">
										            <tr>
										              <th colspan="8"><hr style="height:0px;border:0.5px solid black;"/></th>
										            </tr>
																<tr style="font-weight:bold; background:#787878; height:30px; color:white;" class="td_only">
																	<th width="8%" style="width:5%; text-align:center;"> Bukti</th>
																	<th width="12%" style="width:10%; text-align:center;">Tgl Trans</th>
																	<th colspan="2" style="width:5%; text-align:center;">Keterangan</th>
																	<th width="11%" style="width:10%; text-align:center;">Debet</th>
																	<th width="11%" style="width:10%; text-align:center;">Kredit</th>
																	<th width="16%" colspan="2" style="width:15%; text-align:center;">Total</th>
									               </tr>
										             <tr>
										              <td colspan="8"><hr style="height:0px;border:0.5px solid black;"/></td>
									              </tr>
																	<?php

									 							 foreach ($dt_unit_x_l1 as $dt){

									 								 $kd_akun_x = $dt['kd_akun'];

									 								 $get_query_saldoAkun = $this->CI->get_saldoAkun($awal_tahun,$tglawal, $bln_repx, $kd_akun_x, $tahun_kemarin);
									 								 $saldo_a = $get_query_saldoAkun;
									 								 ?>

									 								 <tr height="30px" class="td_only" style="font-weight:bold; color:rgb(0,0,0); background:#D3D1D1">
									 									 <td colspan="5" align="left" style="width:15%; font-weight:bold;">&nbsp;
																		 <?php
									 										 echo $dt['kd_akun'].' - '.ucwords(strtolower($dt['nama']));
									 										 ?>   </td>
																	    <td colspan="3" align="right" style="width:10%;">Saldo Awal :
																		    <?php echo number_format($saldo_a,2); ?>	&nbsp;							    </td>
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
									 										 <td style="width:5%;" valign="top"><span style="width:15%;">&nbsp;
									 										   <?php

									 											 echo $dt_l0['no_bukti'];
									 											 ?>
									 										 </span></td>
									 										 <td style="width:10%;" align="left" valign="top"><span style="width:5%;">
									 										   <?php
									 											 $tgl_transaksi = $dt_l0['tgl_trans'];
									 											 echo date("d-m-Y", strtotime($tgl_transaksi));
									 											 ?>
									 										 </span></td>
									 										 <td colspan="2" align="left" style="width:5%;">
									 										   <?php echo ucwords(strtolower($dt_l0['keterangan'])); ?>
																			 </td>
									 										 <td align="right" style="width:10%;" valign="top">
									 											 <?php  echo number_format($dt_l0['jml_D'],2); ?>
									 										 </td>
									 										 <td align="right" style="width:10%;" valign="top">
									 											 <?php  echo number_format($dt_l0['jml_K'],2); ?>
									 										 </td>
									 										 <td colspan="2" align="right" style="width:15%;" valign="top">
									 											 <?php  echo number_format($saldo_a,2); ?>&nbsp;
									 										 </td>
									 									 </tr>

									 									 <?php
									 								 }
									 								 ?>

									 								 <tr class="td_only" bgcolor="#EAEAEA">
									 									 <td height="25" style="width:5%;"></td>
									 									 <td style="width:10%;"></td>
									 									 <td width="11%" style="width:5%;"></td>
									 									 <td width="31%" align="left" style="width:30%; font-weight:bold;">
									 										 Total
									 									 </td>
									 									 <td style="font-weight:bold; ; width:10%;" align="right">
									 										 <?php  echo number_format($total_d,2); ?>
									 									 </td>
									 									 <td style="font-weight:bold;  width:10%;" align="right">
									 										 <?php  echo number_format($total_k,2); ?>
									 									 </td>
									 									 <td colspan="2" style="font-weight:bold; width:15%;" align="right">
									 										 <?php  echo number_format($saldo_a,2); ?>&nbsp;
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
									                  <td colspan="2" align="right" style="font-weight:bold"> <?php  //echo number_format($grandtotal);?> &nbsp;</td>
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
