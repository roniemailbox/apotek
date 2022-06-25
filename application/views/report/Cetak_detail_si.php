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
		<table width="30%" border="0" cellspacing="1" cellpadding="1">
		<tbody>

					<tr>
					<td width="6%" rowspan="5"><img src="<?php echo base_url(); ?>build/images/logo.png" width="120" height="90" alt=""/></td>
					<td colspan="3"><h2><?= $this->session->userdata('nama_perusahaan'.$id)?></h2></td>
					</tr>
					<tr>
					<td colspan="3"> <?= $this->session->userdata('alamat_perusahaan'.$id)?> </td>
					</tr>

					<tr>
					<td>Telepon</td>
					<td width="1%">:</td>
					<td width="89%"><?= $this->session->userdata('telepon_perusahaan'.$id)?></td>
					</tr>
					<tr>
					<td>Email</td>
					<td>:</td>
					<td><?= $this->session->userdata('email_perusahaan'.$id)?></td>
					</tr>
		</tbody>
		</table>

<hr style="height:0px;border:0.5px solid black;"/>
	    <div align="center">
	        <h3 style="border: 0px solid #333;">REKAP DETAIL PENJUALAN<br>
	          Periode : <?php echo format_tanggal($xtglawal); ?> s/d <?php echo format_tanggal($xtglakhir); ?> </h3>

	        <table border="0" width="100%" cellspacing="0" cellpadding="0"
						style="border-collapse:collapse; ">

	            <tr>
	              <th colspan="7"><hr style="height:0px;border:0.5px solid black;"/></th>
                </tr>
	            <tr>
	                <th>NO BUKTI</th>
	                <th>ID REG</th>
	                <th>NAMA BARANG</th>
									<th>SATUAN</th>
									<th>HARGA</th>

	                <th>QTY</th>
	                <th>TOTAL</th>
					        
              </tr>

	             <tr>
	              <td colspan="7"><hr style="height:0px;border:0.5px solid black;"/></td>
                </tr>

	            <?php
	            $noxz = 1;
				$grandtotal=0;
				//$total_hari=0;
	            foreach($dt_unit_x_l1 as $dt){
              $tgl_trans = $dt['tgl_trans'];
	            ?>
                <tr valign="middle" class="td_only" style="font-weight:bold; color:rgb(0,0,0); background:#D3D1D1">
															<td colspan="7" valign="middle" align="left" style="width:100%; font-weight:bold; height:25px">
																<?php echo format_tanggal($dt['tgl_trans']); ?>
															</td>
														</tr>

														<?php
														//looping ke 2
														$total_hari=0;

														foreach ($dt['dt_unit_x_l0'] as $dt_l0){
															//declare 2-1
															$no_bukti = $dt_l0['no_bukti'];
															$no_bukti_x = $dt_l0['no_bukti'];
															$no_bukti_x = substr($no_bukti_x,0,3);
															//echo '<br> no_bukti : '.$no_bukti;

															$total_d = 0;
															$total_q = 0;
															$total_r = 0;
															$total_p = 0;
															$total_t = 0;
															?>

															<?php
															$get_query_l3 = $this->CI->foreach_level3($no_bukti);
															//print_r($get_query_l3);
															?>

															<?php
															//looping ke 3

															foreach ($get_query_l3 as $dt_l3){
																//declare 2-1
																$total_d = $total_d + $dt_l3['hj'];
																$total_q = $total_q + $dt_l3['qty'];
																$total_r = $total_r + $dt_l3['dpp'];
																$total_p = $total_p + $dt_l3['ppn'];
																$total_t = $total_t + $dt_l3['total'];

																$total_hari=$total_hari + $dt_l3['total'];
																//$total_k = $total_k + $dt_l3['jml_K'];

																$no_bukti_x = $dt_l3['no_bukti'];
																$no_bukti_x = substr($no_bukti_x,0,3);

																?>

																<tr class="td_only">
																	<td>&nbsp;&nbsp;<?php	echo  $dt_l3['no_bukti'];?></td>
																	<td>&nbsp;&nbsp;<?php	echo  $dt_l3['kd_barang'];?></td>
																	<td>&nbsp;&nbsp;<?php echo  $dt_l3['nama_barang']; ?> </td>
																	<td>&nbsp;&nbsp;<?php echo  $dt_l3['satuan']; ?> </td>
																	<td align="right"><?php echo  number_format($dt_l3['hj']); ?> &nbsp;&nbsp;</td>

																	<td align="center"><?php echo number_format($dt_l3['qty']); ?></td>
																	<td align="right"> <?php echo number_format($dt_l3['total']); ?>&nbsp;</td>

																</tr>

																<?php

																		}

																		?>

														    <tr class="td_only">
															      <td colspan="9" align="left" style="font-weight:bold"> </td>
		        										</tr>
														    <tr class="td_only">
																		<td colspan="5" align="left" style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

		                                <td align="center" style="font-weight:bold"><?php  echo  number_format($total_q); ?> </td>
		                                <td align="right" style="font-weight:bold"><?php echo  number_format($total_t); ?>&nbsp;</td>
 																</tr>

															<?php
																	$grandtotal=$grandtotal+$total_t;
														}

														?>
                <tr class="td_only">
                       <td colspan="7" align="right" style="font-weight:bold">&nbsp;</td>
                </tr>
                <tr class="td_only">
																<td colspan="6" align="right" style="font-weight:bold; height:25px">Total Per Hari&nbsp;&nbsp;</td>
																<td align="right" style="font-weight:bold"><?php echo  number_format($total_hari); ?>&nbsp;</td>

															</tr>

	            <?php

				 }

	            ?>
                <br>
                <tr>
                  <td colspan="7"><hr style="height:0px;border:0.5px solid black;"/></td>
                </tr>
                <tr>
	              <td colspan="6" align="right" style="font-weight:bold"><strong>Grand Total&nbsp;&nbsp;</strong></td>
                  <td align="right" style="font-weight:bold"><strong> <?php  echo number_format($grandtotal);?>&nbsp; </strong></td>
				  <td align="left">&nbsp;</td>

	              </tr>

	        </table>

	    </div>






	    <script type="text/javascript" src="<?php echo base_url('asset/js/jquery.printPage.js')?>"></script>
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
							w.document.write('<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>build/images/logo.png" />');
							w.document.write('<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> ');

							w.document.write('<link href="<?=site_url('/')?>build/css/bootstraps.css" rel="stylesheet" />');
							w.document.write('<link href="<?=site_url('/')?>build/css/style_view.css" rel="stylesheet" type="text/css" />');
							w.document.write('<link href="<?=site_url('/')?>build/css/paper.css" rel="stylesheet" type="text/css" />');
							w.document.write('<style>@page { size: A4 portrait }</style>');
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
                  $nama_excel_as = 'Rekap Penjualan';
                  ?>

                  <input type="text" value="<?php echo $nama_excel_as; ?>" id="nama_excel_as" hidden />

                  <!-- Export Excel -->
                  <!-- start tambahan untuk excel -->
                  <script data-require="jquery" data-semver="2.2.0" src="<?=site_url('/')?>build/source_ant/js/jquery.min.js"></script>
                  <script type="text/javascript" src="<?=site_url('/')?>build/source_ant/js/export-excel.jquery.min"></script>

                  <script type='text/javascript'>
                  var jq_excel = $.noConflict(true);
                  jq_excel(window).load(function(){
                    jq_excel(document).ready(function() {
                      jq_excel("#btnExport").click(function(e) {
                        var a = document.createElement('a');
                        //getting data from our div that contains the HTML table
                        var data_type = 'data:application/vnd.ms-excel';
                        var table_div = document.getElementById('testTable');
                        var table_html = table_div.outerHTML.replace(/ /g, '%20');
                        a.href = data_type + ', ' + table_html;
                        //setting the file name
                        var nama_excel_ex = document.getElementById('nama_excel_as').value;
                        //a.download = 'exported_table_' + postfix + '.xls';
                        a.download = nama_excel_ex + '.xls';
                        //triggering the function
                        a.click();
                        //just in case, prevent default behaviour
                        e.preventDefault();
                      });
                    });
                  });
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
