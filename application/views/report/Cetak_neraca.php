<?php $id = get_cookie('tkkop'); ?>
<!doctype html>
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

	        <h3>N E R A CA</h3>
	          PER <?php echo " ".format_tanggal($this->session->flashdata('tgl_akhir'))?> DAN <?php echo " ".format_tanggal($this->session->flashdata('tgl_banding'))?>
				  <table border="0" width="100%" cellspacing="0" cellpadding="0"
						style="border-collapse:collapse; ">

	            <tr>
	              <th colspan="4"><hr style="height:0px;border:0.5px solid black;"/></th>
              </tr>
	            <tr>
								<th width="22%">ASET</th>
								<th width="36%">AKUN</th>
								<th width="18%"><?php echo " ".format_tanggal($this->session->flashdata('tgl_akhir'))?></th>
								<th width="22%"><?php echo " ".format_tanggal($this->session->flashdata('tgl_banding'))?></th>

	            </tr>

	             <tr>
	              <td colspan="4"><hr style="height:0px;border:0.5px solid black;"/></td>
                </tr>
<tr>
	              <td><strong>ASET LANCAR</strong></td>
	              <td>&nbsp;</td>
	              <td align="right">&nbsp;</td>
	              <td align="right">&nbsp;</td>
	              <td width="2%" align="left">&nbsp;</td>
                </tr>
	            <?php
	            $no=1;
				$altotalak=0;
	            $altotalaw=0;
				if(isset($data_al)){
	       foreach($data_al as $row){
							 $altotalak=$altotalak+$row->saldoakhir;
							 $altotalaw=$altotalaw+$row->saldoawal;
							//$xdpp=$xdpp+$row->hmtotal;
	            ?>



	            <tr>
                                    <td>&nbsp;</td>
                                    <td><?php echo $row->namaakun;?></td>
                  <td align="right"><?php echo number_format($row->saldoakhir,2);?></td>
																		<td align="right"><?php echo number_format($row->saldoawal,2);?></td>


																		<td align="left">&nbsp;</td>





	            </tr>

	            <?php }
	            }
	            ?>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                  <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr>
                                    <td>&nbsp;</td>
                                    <td>JUMLAH ASET LANCAR</td>
                  <td align="right"><strong><?php echo number_format($altotalak,2);?></strong></td>
																		<td align="right"><strong><?php echo number_format($altotalaw,2);?></strong></td>


																		<td align="left">&nbsp;</td>





	            </tr>
                <br>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                  <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr>
	              <td><strong>ASET TETAP</strong></td>
	              <td>&nbsp;</td>
	              <td align="right">&nbsp;</td>
	              <td align="right">&nbsp;</td>
	              <td align="left">&nbsp;</td>
                </tr>
                <?php
				$attotalak=0;
				$attotalaw=0;
                if(isset($data_at)){
	       foreach($data_at as $row){
							$attotalak=$attotalak+$row->saldoakhir;
							 $attotalaw=$attotalaw+$row->saldoawal;
	            ?>



	            <tr>
                                    <td>&nbsp;</td>
                                    <td><?php echo $row->namaakun;?></td>
                  <td align="right"><?php echo number_format($row->saldoakhir,2);?></td>
																		<td align="right"><?php echo number_format($row->saldoawal,2);?></td>


																		<td align="left">&nbsp;</td>





	            </tr>

	            <?php }
	            }
	            ?>

                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                  <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>NILAI BUKU</td>
                  <td align="right"><strong><?php echo number_format($attotalak,2);?></strong></td>
                  <td align="right"><strong><?php echo number_format($attotalaw,2);?></strong></td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                  <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr>
	              <td><strong>ASET LAIN-LAIN</strong></td>
	              <td>&nbsp;</td>
	              <td align="right">&nbsp;</td>
	              <td align="right">&nbsp;</td>
	              <td align="left">&nbsp;</td>
                </tr>
	            <tr>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
	              <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
	              <td align="left">&nbsp;</td>
	              </tr>
	            <tr>
	              <td><strong>TOTAL ASET</strong></td>
	              <td>&nbsp;</td>
	              <td align="right"><strong><?php echo number_format($attotalak+$altotalak,2);?></strong></td>
	              <td align="right"><strong><?php echo number_format($attotalaw+$altotalaw,2);?></strong></td>
	              <td align="left">&nbsp;</td>
                </tr>
                <br>
                 <br>
                 <tr>
                   <td>&nbsp;</td>
                   <td>&nbsp;</td>
                   <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                   <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                   <td align="left">&nbsp;</td>
                 </tr>
                 <tr>
                   <td>&nbsp;</td>
                   <td>&nbsp;</td>
                   <td align="right">&nbsp;</td>
                   <td align="right">&nbsp;</td>
                   <td align="left">&nbsp;</td>
                </tr>
                <tr>
	              <td><strong>KEWAJIBAN DAN EKUITAS</strong></td>
	              <td>&nbsp;</td>
	              <td align="right">&nbsp;</td>
	              <td align="right">&nbsp;</td>
	              <td align="left">&nbsp;</td>
                </tr>
	            <tr>
	              <td><strong>KEWAJIBAN LANCAR</strong></td>
	              <td>&nbsp;</td>
	              <td align="right">&nbsp;</td>
	              <td align="right">&nbsp;</td>
	              <td align="left">&nbsp;</td>
                </tr>
                <?php
				$kltotalaw=0;
				$kltotalak=0;
                if(isset($data_kl)){
	       foreach($data_kl as $row){
							 $kltotalaw=$kltotalaw+$row->saldoawal;
							  $kltotalak=$kltotalak+$row->saldoakhir;


	            ?>





	            <tr>
                                    <td>&nbsp;</td>
                                    <td><?php echo $row->namaakun;?></td>
                  <td align="right"><?php echo number_format(-1*$row->saldoakhir,2);?></td>
																		<td align="right"><?php echo number_format(-1*$row->saldoawal,2);?></td>


																		<td align="left">&nbsp;</td>





	            </tr>

	            <?php }
	            }
	            ?>
                <br>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                  <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>JUMLAH KEWAJIBAN LANCAR</td>
                  <td align="right"><strong><?php echo number_format(-1*$kltotalak,2);?></strong></td>
                  <td align="right"><strong><?php echo number_format(-1*$kltotalaw,2);?></strong></td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                  <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr>
	              <td><strong>EKUITAS</strong></td>
	              <td>&nbsp;</td>
	              <td align="right">&nbsp;</td>
	              <td align="right">&nbsp;</td>
	              <td align="left">&nbsp;</td>
                </tr>
                <?php
				$eqtotalaw=0;
				$eqtotalak=0;
                if(isset($data_eq)){
	       foreach($data_eq as $row){
						$eqtotalaw=$eqtotalaw+$row->saldoawal;
							  $eqtotalak=$eqtotalak+$row->saldoakhir;
	            ?>




	            <tr>
                                    <td>&nbsp;</td>
                                    <td><?php echo $row->namaakun;?></td>
                  <td align="right"><?php echo number_format(-1*$row->saldoakhir,2);?></td>
																		<td align="right"><?php echo number_format(-1*$row->saldoawal,2);?></td>


																		<td align="left">&nbsp;</td>





	            </tr>

	            <?php }
	            }
	            ?>
                 <?php

                if(isset($data_sb)){
	       foreach($data_sb as $row){
				$lr_bulan_ini=$row->bulan_ini;
				$lr_bulan_lalu=$row->bulan_lalu;
	            ?>
	            <tr>
	              <td>&nbsp;</td>
	              <td>SALDO LABA TAHUN BERJALAN</td>
	              <td align="right"><?php echo number_format(-1*$lr_bulan_ini,2);?></td>
	              <td align="right"><?php echo number_format(-1*$lr_bulan_lalu,2);?></td>
	              <td align="left">&nbsp;</td>
	              </tr>
                   <?php }
	            }
	            ?>
	            <tr>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
	              <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
	              <td align="left">&nbsp;</td>
	              </tr>
	            <tr>
	              <td>&nbsp;</td>
	              <td>JUMLAH EKUITAS</td>
	              <td align="right"><strong><?php echo number_format(-1*($eqtotalak+$lr_bulan_lalu),2);?></strong></td>
	              <td align="right"><strong><?php echo number_format(-1*($eqtotalaw+$lr_bulan_ini),2);?></strong></td>
	              <td align="left">&nbsp;</td>
	              </tr>
	            <tr>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
	              <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
	              <td align="left">&nbsp;</td>
	              </tr>
	            <tr>
	              <td><strong>TOTAL KEWAJIBAN DAN EKUITAS</strong></td>
	              <td>&nbsp;</td>
	              <td align="right"><strong><?php echo number_format(-1*($eqtotalak+$kltotalak+$lr_bulan_ini),2);?></strong></td>
	              <td align="right"><strong><?php echo number_format(-1*($eqtotalaw+$kltotalaw+$lr_bulan_lalu),2);?></strong></td>
	              <td align="left">&nbsp;</td>
                </tr>

                <tr>
                  <td colspan="4"><hr style="height:0px;border:0.5px solid black;"/></td>
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
                  $nama_excel_as = 'Neraca';
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
