<?php $id = get_cookie('tkkop'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en">
<head>
	<title><?= $this->session->userdata('nama_perusahaan'.$id)?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>build/images/logo2.png" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="<?php echo base_url('build/css/bootstraps.css')?>"/>
	<link href="<?php echo base_url('build/css/style_view.css') ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('build/css/paper.css') ?>" rel="stylesheet" type="text/css" />
	<style>@page {size: A4 portrait}</style>
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
<div id="printableArea">
<body>

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
					<td width="6%" rowspan="5"><img src="<?php echo base_url(); ?>build/images/logo.png" width="91" height="77" alt=""/></td>
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

	            <h3>REKAPITULASI HAULING SUBCOUNT PT. BARA JASA MULIA</h2>

	        </h3>

				Periode :
	         <?php echo format_tanggal($xtglawal); ?>
	        s/d <?php echo format_tanggal($xtglakhir); ?><br>
	        <?php //echo $xlokasal->nama ; ?> - <?php //echo $xloktujuan->nama; ?>
	        <table  border="1" width="100%" cellspacing="0" cellpadding="0"
						style="border-collapse:collapse;border:0.5px solid black; ">


	            <tr>
	              <th width="3%" rowspan="2"><strong>NO</strong></th>
	              <th width="8%" rowspan="2"><strong>TANGGAL</strong></th>
	              <th width="6%" rowspan="2"><strong>NO UNIT</strong></th>
	              <th width="4%" rowspan="2"><strong>SHIFT</strong></th>
	              <th width="6%" rowspan="2"><strong>NO. SJ</strong></th>
	              <th width="6%" rowspan="2"><strong>TYPE</strong></th>
	              <th width="13%" rowspan="2"><strong>DRIVER</strong></th>
	              <th colspan="3"><strong>TONASSE</strong></th>
	              <th colspan="2"><strong>PIT PORT</strong></th>
                </tr>
	            <tr>
	                <th width="5%"><strong>BRUTO</strong></th>
	                <th width="5%"><strong>TARRA</strong></th>
	                <th width="5%"><strong>NETTO</strong></th>
	                <th width="10%"><strong>PIT</strong></th>
	                <th width="6%"><strong>PORT</strong></th>
                </tr>
				<?php

				$grandtotal=0;
				$xrit=0;
	            $xton=0;
				//$total_hari=0;
	            foreach($dt_unit_x_l1 as $dt){
                $tgl_produksi = $dt['tgl_produksi'];
	            ?>
                <tr valign="middle" class="td_only" style="font-weight:bold; color:rgb(0,0,0); background:#D3D1D1">
															<td colspan="12" valign="middle" align="center" style="width:100%; font-weight:bold; height:25px">
																<?php echo format_tanggal($dt['tgl_produksi']); ?>
															</td>
				</tr>

														<?php
														//looping ke 2
														$no = 1;
														$total_hari=0;
														foreach ($dt['dt_unit_x_l0'] as $dt_l0){
															//declare 2-1
															$no_bukti = $dt_l0['no_bukti'];
															$no_bukti_x = $dt_l0['no_bukti'];
															$no_bukti_x = substr($no_bukti_x,0,3);
															//echo '<br> no_bukti : '.$no_bukti;

															$total_d = 0;
															$total_k = 0;
															?>

															<?php
															$get_query_l3 = $this->CI->foreach_level3($no_bukti);
															//print_r($get_query_l3);
															?>

															<?php
															//looping ke 3

															foreach ($get_query_l3 as $dt_l3){
																//declare 2-1
																//$total_d = $total_d + $dt_l3['total'];
																//$total_hari=$total_hari + $dt_l3['total'];
																//$xrit=$xrit+$row->rit;
																$xton=$xton+$dt_l3['tonase'];

																$no_bukti_x = $dt_l3['no_bukti'];
																$no_bukti_x = substr($no_bukti_x,0,3);

																?>

																<tr class="td_only">
																	<td align="center"><?php echo $no++; ?></td>
                                                                    <td align="center"><?php echo format_tanggal($dt_l3['tgl_produksi']);
                                                                    //$kodetgl = date('d',strtotime($row->tgl_produksi));
                                                                     $pos_tgl= $dt_l3['tgl_produksi'];

                                                                    //echo  ($kodetgl);
                                                                     ?></td>
                                                                    <td align="center"><?php echo  $dt_l3['id_unit']; ?></td>
                                                                    <td align="center"><?php echo  $dt_l3['nama_shif']; ?></td>
                                                                    <td align="center"><?php echo  $dt_l3['no_sj']; ?></td>
                                                                    <td align="center"><?php echo  $dt_l3['id_model_unit']; ?></td>
                                                                    <td align="left"> &nbsp; <?php echo  $dt_l3['nama_driver']; ?></td>
                                                                    <td align="center"><?php echo number_format($dt_l3['bruto']/1000) ?></td>
                                                                    <td align="center"><?php echo number_format($dt_l3['tarra']/1000) ?></td>
                                                                    <td align="center"><?php echo number_format($dt_l3['tonase']/1000);?></td>
                                                                    <td align="center"><?php echo $dt_l3['nama_pit']; ?></td>
                                                                    <td align="center"> <?php echo $dt_l3['nama_port']; ?> </td>

																</tr>

																<?php

																		}

																		?>



															<?php
$grandtotal=$grandtotal+$total_d;
														}

														?>
<tr class="td_only">
																<td colspan="12" align="left" style="font-weight:bold" height="30px"> &nbsp;&nbsp; &nbsp;&nbsp;</td>
				</tr>

	            <?php

				 }

	            ?>
<tr style="background:#C5FFA9">
	              <td colspan="7" align="right" valign="middle" style=" font-weight:bold" height="30px"> Total &nbsp; </td>
	              <td align="right" valign="middle" style=" font-weight:bold">&nbsp;</td>
	              <td align="center" valign="middle" style=" font-weight:bold"><?php //echo number_format($xton);?></td>
	              <td align="center" valign="middle" style=" font-weight:bold"><?php echo number_format($xton/1000);?></td>
	              <td align="center" valign="middle" style=" font-weight:bold">&nbsp;</td>
	              <td align="center" valign="middle" style=" font-weight:bold">&nbsp;</td>
                </tr>



	        </table>



	        <table width="100%" border="0" cellspacing="0" cellpadding="0">
	          <tbody>
	            <tr>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
                </tr>
	            <tr>
	              <td>Batulicin,<?php
				  $now = date('Y-m-d');
				  echo format_tanggal($now);?></td>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              </tr>
	            <tr>
	              <td align="center">&nbsp;</td>
	              <td align="center">&nbsp;</td>
	              <td align="center">&nbsp;</td>
	              <td align="center">&nbsp;</td>
	              <td align="center">&nbsp;</td>
                </tr>
	            <tr>
	              <td align="center">Dibuat / Diserahkan</td>
	              <td align="center">Disetujui Oleh</td>
	              <td align="center">Diperiksa Oleh</td>
	              <td align="center">Diperiksa Oleh</td>
	              <td align="center">Disetujui Oleh</td>
	              </tr>
	            <tr>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              </tr>
	            <tr>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              </tr>
	            <tr>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              </tr>
	            <tr>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              </tr>
	            <tr>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              </tr>
	            <tr>
	              <td align="center"><u>Hastuty Ma'ruf</u></td>
	              <td align="center"><u>Budiono</u></td>
	              <td align="center">___________________</td>
	              <td align="center">___________________</td>
	              <td align="center"><u>Antonius Saranga</u></td>
	              </tr>
	            <tr>
	              <td align="center">Admin Subcont</td>
	              <td align="center">&nbsp;</td>
	              <td align="center">Admin</td>
	              <td align="center">Officer CDR</td>
	              <td align="center">SPV/SPT CDR</td>
	              </tr>
	            </tbody>
	          </table>
	    </div>








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
                  			w.document.write('<title><?= $this->session->userdata('nama_perusahaan'.$id)?></title>');
							w.document.write('<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>build/images/logo.png" />');
							w.document.write('<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> ');
							w.document.write('<link href="<?=base_url('/')?>build/css/abootstraps.css" rel="stylesheet" />');
							w.document.write('<link href="<?=base_url('/')?>build/css/style_view_cetak.css" rel="stylesheet" type="text/css" />');
							w.document.write('<link href="<?=base_url('/')?>build/css/paper.css" rel="stylesheet" type="text/css" />');
							w.document.write('<style>@page { size: A4 portrait}</style>');
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
                  $nama_excel_as = 'Data Hauling';
                  ?>

                  <input type="text" value="<?php echo $nama_excel_as; ?>" id="nama_excel_as" hidden />

                  <!-- Export Excel -->
                  <!-- start tambahan untuk excel -->
				  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>  -->
                  <script data-require="jquery" data-semver="2.2.0" src="<?=site_url('/')?>build/source_ant/js/jquery.min.js"></script>
                  <script type="text/javascript" src="<?=site_url('/')?>build/source_ant/js/export-excel.jquery.min"></script>
                  <script type="text/javascript" src="<?=site_url('/')?>build/source_ant/js/jquery.table2excel.js"></script>
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
