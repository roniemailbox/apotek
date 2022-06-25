<!doctype html>
<html lang="en">
<head>
	<title><?= $this->session->userdata('nama_perusahaan1')?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>production/images/iconic.png" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css')?>"/>
	<link href="<?php echo base_url('assets/css/style_view.css') ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('assets/css/paper.css') ?>" rel="stylesheet" type="text/css" />
	<style>@page {size: A5 lanscape}</style>
</head>
<body>
	<div class="container">


				  <table width="30%" border="0" cellspacing="1" cellpadding="1">
					<tbody>

								<tr>
								<td width="6%" rowspan="5"><img src="<?php echo base_url(); ?>production/images/logo.png" width="91" height="77" alt=""/></td>
								<td colspan="3"><h2><?= $this->session->userdata('nama_perusahaan1')?></h2></td>
								</tr>
								<tr>
								<td colspan="3"> <?= $this->session->userdata('alamat_perusahaan1')?> </td>
								</tr>
								<tr>
								<td width="4%">Kota</td>
								<td colspan="2">:</td>
								<td><?= $this->session->userdata('kota_perusahaan1')?></td>
								</tr>
								<tr>
								<td>Telepon</td>
								<td width="1%">:</td>
								<td width="89%"><?= $this->session->userdata('telepon_perusahaan1')?></td>
								</tr>
								<tr>
								<td>Email</td>
								<td>:</td>
								<td><?= $this->session->userdata('email_perusahaan1')?></td>
								</tr>
					</tbody>
					</table>


						 <table width="30%" border="0" cellspacing="1" cellpadding="1">

							 <?php
 	            $no=1;
 	            if(isset($data_budget)){
 	            foreach($data_budget as $row){
 	            ?>

						  <tbody>

						    <tr>
						      <td colspan="4" align="center"><hr></td>
						    </tr>
						    <tr>
						      <td colspan="4" align="center"><h3 style="border: 0px solid #333;">PERMOHONAN PENGAJUAN DANA (PPD)</h3></td>
						    </tr>
						    <tr>
						      <td>&nbsp;</td>
						      <td>No Bukti</td>
						      <td>:</td>
						      <td><h4><?php echo $row->no_ppd; ?></h4></td>
						    </tr>
						    <tr>
						      <td>&nbsp;</td>
						      <td>Tanggal</td>
						      <td>:</td>
						      <td><?php echo $row->tgl_ppd; ?></td>
						    </tr>
						    <tr>
						      <td width="1%">&nbsp;</td>
						      <td width="6%">Nama Pemohon</td>
						      <td width="1%">:</td>
						      <td width="92%"><?php echo $row->nama_pegawai; ?></td>
						    </tr>
						    <tr>
						      <td>&nbsp;</td>
						      <td>Divisi</td>
						      <td>:</td>
						      <td><?php echo $row->nama_divisi; ?></td>
						    </tr>
						    <tr>
						      <td>&nbsp;</td>
						      <td>Departement</td>
						      <td>:</td>
						      <td><?php echo $row->nama_departement; ?></td>
						    </tr>
						    <tr>
						      <td>&nbsp;</td>
						      <td>Beban</td>
						      <td>:</td>
						      <td><?php echo $row->nama_beban; ?></td>
						    </tr>
						    <tr>
						      <td>&nbsp;</td>
						      <td>Nominal</td>
						      <td>:</td>
						      <td><?php echo currency_format($row->nominal); ?></td>
						    </tr>
						    <tr>
						      <td>&nbsp;</td>
						      <td>Keterangan</td>
						      <td rowspan="2" valign="top">:</td>
						      <td rowspan="2" valign="top"><?php echo $row->keterangan; ?></td>
						    </tr>
						    <tr>
						      <td>&nbsp;</td>
						      <td>&nbsp;</td>
						    </tr>
						    <tr>
						      <td>&nbsp;</td>
						      <td>&nbsp;</td>
						      <td>&nbsp;</td>
						      <td>&nbsp;</td>
						    </tr>
						  </tbody>

						<?php }
						}
						?>

						</table>
						<table width="30%" border="0" cellspacing="1" cellpadding="1">
						  <tbody>

						    <tr>
									<td width="16%" align="center">Mengetahui</td>
						      <td width="34%" align="center">&nbsp;</td>
						      <td width="25%">&nbsp;</td>
						      <td width="25%" colspan="4">&nbsp;</td>
						    </tr>
						    <tr>
						      <td>&nbsp;</td>
						      <td>&nbsp;</td>
						      <td colspan="4">&nbsp;</td>
						    </tr>
								<tr>
						      <td>&nbsp;</td>
						      <td>&nbsp;</td>
						      <td>&nbsp;</td>
						      <td colspan="4">&nbsp;</td>
    						</tr>
						    <tr>
						      <td>&nbsp;</td>
						      <td>&nbsp;</td>
						      <td colspan="4">&nbsp;</td>
						    </tr>
						    <tr>
						      <td align="center">( <?php echo  $row->nama_pegawai ; ?> )</td>
						      <td>&nbsp;</td>
						      <td colspan="4">&nbsp;</td>
						    </tr>
						    <tr>
						      <td>&nbsp;</td>
						      <td>&nbsp;</td>
						      <td colspan="4">&nbsp;</td>
						    </tr>
						  </tbody>
						</table>


	    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.printPage.js')?>"></script>
	    <script type="text/javascript">
	        $(document).ready(function(){
	            $(".btnPrint").printPage();
	        })
	    </script>

	</div>

</body>
</html>
