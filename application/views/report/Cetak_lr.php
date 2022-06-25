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

	        <h3>LABA RUGI</h3>
	          <p>UNTUK PERIODE <?php echo " ".format_tanggal($this->session->flashdata('tgl_awal'))?> S/D <?php echo " ".format_tanggal($this->session->flashdata('tgl_akhir'))?><br>
	            DAN <?php echo " ".format_tanggal($this->session->flashdata('tgl_awal_tahun'))?> S/D <?php echo " ".format_tanggal($this->session->flashdata('tgl_akhir'))?>
				  <strong> </strong>			  </p>
	          <table border="0" width="100%" cellspacing="0" cellpadding="0"
						style="border-collapse:collapse; ">

	            <tr>
	              <th colspan="6"><hr style="height:0px;border:0.5px solid black;"/></th>
              </tr>
	            <tr>
								<th width="13%">&nbsp;</th>
								<th width="18%">AKUN</th>
								<th width="15%"><?php echo " ".format_tanggal($this->session->flashdata('tgl_awal'))?> S/D <?php echo " ".format_tanggal($this->session->flashdata('tgl_akhir'))?></th>
								<th width="13%">BUDGET</th>
								<th width="18%"><?php echo " ".format_tanggal($this->session->flashdata('tgl_awal_tahun'))?> S/D <?php echo " ".format_tanggal($this->session->flashdata('tgl_akhir'))?> </th>
								<th width="19%">BUDGET</th>

	            </tr>

	             <tr>
	              <td colspan="6"><hr style="height:0px;border:0.5px solid black;"/></td>
                </tr>
<tr>
	              <td><strong>PENDAPATAN</strong></td>
	              <td>&nbsp;</td>
	              <td align="right">&nbsp;</td>
	              <td align="right">&nbsp;</td>
	              <td align="right">&nbsp;</td>
	              <td align="right">&nbsp;</td>
	              <td width="4%" align="left">&nbsp;</td>
                </tr>
	            <?php
	            $no=1;
				$altotalak=0;
	            $altotalaw=0;
				if(isset($data_al)){
	       foreach($data_al as $row){
							 $altotalak=$altotalak+$row->akhir;
							 $altotalaw=$altotalaw+$row->awal;
							//$xdpp=$xdpp+$row->hmtotal;
	            ?>



	            <tr>
                                    <td>&nbsp;</td>
                                    <td><?php echo $row->namaakun;?></td>
                  <td align="right"><?php echo number_format($row->awal,2);?></td>
																		<td align="right">&nbsp;</td>
																		<td align="right"><?php echo number_format($row->akhir,2);?></td>
																		<td align="right">&nbsp;</td>


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
                  <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                  <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr>
                                    <td>&nbsp;</td>
                                    <td>Jumlah Pendapatan</td>
                  <td align="right"><strong><?php echo number_format($altotalaw,2);?></strong></td>
																		<td align="right">&nbsp;</td>
																		<td align="right"><strong><?php echo number_format($altotalak,2);?></strong></td>
																		<td align="right">&nbsp;</td>


																		<td align="left">&nbsp;</td>





	            </tr>
                <br>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                  <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                  <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                  <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr>
	              <td><strong>BEBAN LANGSUNG JASA</strong></td>
	              <td>&nbsp;</td>
	              <td align="right">&nbsp;</td>
	              <td align="right">&nbsp;</td>
	              <td align="right">&nbsp;</td>
	              <td align="right">&nbsp;</td>
	              <td align="left">&nbsp;</td>
                </tr>
                <?php
				$attotalak=0;
				$attotalaw=0;
                if(isset($data_at)){
	       foreach($data_at as $row){
							$attotalaw=$attotalaw+$row->awal;
							 $attotalak=$attotalak+$row->akhir;
	            ?>



	            <tr>
                                    <td>&nbsp;</td>
                                    <td><?php echo $row->namaakun;?></td>
                  <td align="right"><?php echo number_format($row->awal,2);?></td>
																		<td align="right">&nbsp;</td>
																		<td align="right"><?php echo number_format($row->akhir,2);?></td>
																		<td align="right">&nbsp;</td>


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
                  <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                  <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>Jumlah Beban Langsung Jasa</td>
                  <td align="right"><strong><?php echo number_format($attotalaw,2);?></strong></td>
                  <td align="right">&nbsp;</td>
                  <td align="right"><strong><?php echo number_format($attotalak,2);?></strong></td>
                  <td align="right">&nbsp;</td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
	              <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
	              <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
	              <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
	              <td align="left">&nbsp;</td>
	              </tr>
	            <tr>
	              <td><strong>LABA KOTOR</strong></td>
	              <td>&nbsp;</td>
	              <td align="right"><strong><?php echo number_format($attotalaw+$altotalaw,2);?></strong></td>
	              <td align="right">&nbsp;</td>
	              <td align="right"><strong><?php echo number_format($attotalak+$altotalak,2);?></strong></td>
	              <td align="right">&nbsp;</td>
	              <td align="left">&nbsp;</td>
                </tr>
                <br>
                 <br>
                 <tr>
                   <td>&nbsp;</td>
                   <td>&nbsp;</td>
                   <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                   <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                   <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                   <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                   <td align="left">&nbsp;</td>
                 </tr>
                 <tr>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              <td align="right">&nbsp;</td>
	              <td align="right">&nbsp;</td>
	              <td align="right">&nbsp;</td>
	              <td align="right">&nbsp;</td>
	              <td align="left">&nbsp;</td>
                </tr>
	            <tr>
	              <td><strong>BIAYA UMUM &amp; ADMINISTRASI</strong></td>
	              <td>&nbsp;</td>
	              <td align="right">&nbsp;</td>
	              <td align="right">&nbsp;</td>
	              <td align="right">&nbsp;</td>
	              <td align="right">&nbsp;</td>
	              <td align="left">&nbsp;</td>
                </tr>
                <?php
				$kltotalaw=0;
				$kltotalak=0;
                if(isset($data_kl)){
	       foreach($data_kl as $row){
							  $kltotalaw=$kltotalaw+$row->awal;
							  $kltotalak=$kltotalak+$row->akhir;


	            ?>





	            <tr>
                                    <td>&nbsp;</td>
                                    <td><?php echo $row->namaakun;?></td>
                  <td align="right"><?php echo number_format($row->awal,2);?></td>
																		<td align="right">&nbsp;</td>
																		<td align="right"><?php echo number_format($row->akhir,2);?></td>
																		<td align="right">&nbsp;</td>


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
                  <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                  <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>Jumlah beban umum dan admin</td>
                  <td align="right"><strong><?php echo number_format($kltotalaw,2);?></strong></td>
                  <td align="right">&nbsp;</td>
                  <td align="right"><strong><?php echo number_format($kltotalak,2);?></strong></td>
                  <td align="right">&nbsp;</td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                  <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                  <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                  <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr>
	              <td><strong>LABA OPERASIOINAL</strong></td>
	              <td>&nbsp;</td>
	              <td align="right"><strong><?php echo number_format($attotalaw+$altotalaw+$kltotalaw,2);?></strong></td>
	              <td align="right">&nbsp;</td>
	              <td align="right"><strong><?php echo number_format($attotalak+$altotalak+$kltotalak,2);?></strong></td>
	              <td align="right">&nbsp;</td>
	              <td align="left">&nbsp;</td>
                </tr>
                <tr>
                                      <td><strong>PENDAPATAN (BIAYA) LAIN-LAIN</strong></td>
                                      <td>&nbsp;</td>
                                      <td align="right">&nbsp;</td>
                                      <td align="right">&nbsp;</td>
                                      <td align="right">&nbsp;</td>
                                      <td align="right">&nbsp;</td>
                                      <td align="left">&nbsp;</td>
                                    </tr>
                <?php
				$eqtotalaw=0;
				$eqtotalak=0;
                if(isset($data_eq)){
	       foreach($data_eq as $row){
						$eqtotalak=$eqtotalak+$row->akhir;
							  $eqtotalaw=$eqtotalaw+$row->awal;
	            ?>






                                    <tr>
                                      <td>&nbsp;</td>
                                    <td><?php echo $row->namaakun;?></td>
                  <td align="right"><?php echo number_format($row->awal,2);?></td>
																		<td align="right">&nbsp;</td>
																		<td align="right"><?php echo number_format($row->akhir,2);?></td>
																		<td align="right">&nbsp;</td>


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
	              <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
	              <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
	              <td align="left">&nbsp;</td>
	              </tr>
	            <tr>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              <td align="right"><strong><?php echo number_format($eqtotalaw,2);?></strong></td>
	              <td align="right">&nbsp;</td>
	              <td align="right"><strong><?php echo number_format($eqtotalak,2);?></strong></td>
	              <td align="right">&nbsp;</td>
	              <td align="left">&nbsp;</td>
	              </tr>
	            <tr>
	              <td>&nbsp;</td>
	              <td>&nbsp;</td>
	              <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
	              <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
	              <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
	              <td align="right"><hr style="height:0px;border:0.5px solid black;"/></td>
	              <td align="left">&nbsp;</td>
	              </tr>
	            <tr>
	              <td><strong>LABA BERSIH SEBELUM PAJAK</strong></td>
	              <td>&nbsp;</td>
	              <td align="right"><?php echo number_format($attotalaw+$altotalaw+$kltotalaw+$eqtotalaw,2);?></td>
	              <td align="right">&nbsp;</td>
	              <td align="right"><?php echo number_format($attotalak+$altotalak+$kltotalak+$eqtotalak,2);?></td>
	              <td align="right">&nbsp;</td>
	              <td align="left">&nbsp;</td>
                </tr>

                <tr>
                  <td colspan="6"><hr style="height:0px;border:0.5px solid black;"/></td>
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
                  $nama_excel_as = 'Laba Rugi';
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
