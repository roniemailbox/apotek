<?php $id = get_cookie('eklinik'); ?>
<!doctype html>
<html lang="en">
<head>
	<title><?= $this->session->userdata('nama_perusahaan'.$id)?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>build/images/logo.png" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstraps.css')?>"/>
	<link href="<?php echo base_url('build/css/style_view.css') ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('build/css/paper.css') ?>" rel="stylesheet" type="text/css" />
	<style>@page {size: A5 lanscape}</style>

</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td width="4%">&nbsp;</td>
      <td width="94%">&nbsp;</td>
      <td width="2%">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div class="container">
        <?php $id = get_cookie('eklinik'); ?>
        <table width="100%" border="0" cellspacing="1" cellpadding="1">
          <tbody>
            <tr>
              <td width="12%" rowspan="5"><img src="<?php echo base_url(); ?>build/images/logo.png" width="190" height="60" alt=""/></td>
              <td width="63%" style="font-size:20px; font-weight:bold">
                <?= $this->session->userdata('nama_perusahaan'.$id)?>
               </td>
              <td width="25%">&nbsp;</td>
            </tr>
            <tr>
              <td><?= $this->session->userdata('alamat_perusahaan'.$id)?></td>
              <td rowspan="3" align="left" valign="bottom"><table width="80%" border="1" cellpadding="1" cellspacing="1">
                <tr>
                  <td align="center"><h2><span style="border: 0px solid #333;"><strong> <?php echo $title ?></strong></span></h2></td>
                </tr>
                <tr align="center">
                  <td style="font-size:16px"><?php foreach($data_wo as $rowx){ echo $rowx->no_wo.' / '.$rowx->tgl_masuk; } ?></td>
                </tr>
              </table></td>
            </tr>

            <tr>
              <td>Telepon:
                <?= $this->session->userdata('telepon_perusahaan'.$id)?></td>
              </tr>
            <tr>
              <td>&nbsp;</td>
              </tr>
          </tbody>
        </table>
        <br>
        <?php
 	            $no=1;
 	            if(isset($data_wo)){
 	            foreach($data_wo as $rowxx){
 	            ?>
        <table width="100%" height="470" border="1">
          <tr>
            <td width="6%" valign="top">  &nbsp;<strong>NO. RM</strong><br>
             &nbsp;
                <?php foreach($data_wo as $rowxx){ echo $rowxx->no_register_px; } ?>

             </td>
            <td width="6%" valign="top">&nbsp;<strong>TEKANAN DARAH</strong><br>
              <span style="font-size:12px"> &nbsp;
                <?php foreach($data_wo as $rowxx){
									echo $rowxx->tekanan_darah;
								} ?>
                </span>
           </td>
            <td width="6%" valign="top">&nbsp;<strong>TINGGI BADAN</strong><br>
              <span style="font-size:12px">
                &nbsp;<?php foreach($data_wo as $rowxx){
									echo $rowxx->tinggi_badan." Cm";
								} ?>
              </span></td>
            <td width="6%" valign="top">&nbsp;<strong>BERAT BADAN</strong><br>
              <span style="font-size:12px">
              &nbsp;<?php foreach($data_wo as $rowxx){
							 echo $rowxx->berat_badan." Kg";
							} ?>
              </span></td>
            <td width="15%" valign="top">&nbsp;<strong>DOKTER</strong><br>
              &nbsp;<span style="font-size:12px">
              <?php foreach($data_wo as $rowxx){
								echo $rowxx->nama_dokter;
							} ?>
              </span></td>
          </tr>
          <tr>
            <td colspan="3" rowspan="2" valign="top"><table height="100%" width="100%" border="0">
              <tr>
                <td>&nbsp;</td>
                <td><strong>NAMA PASIEN</strong></td>
                <td>:</td>
                <td><span style="font-size:12px">
                  <?php foreach($data_wo as $rowxx){ echo $rowxx->nama; } ?>
                  </span></td>
              </tr>
							<tr>
                <td width="2%">&nbsp;</td>
                <td width="22%"><strong>JENIS PASIEN</strong></td>
                <td width="1%">:</td>
                <td width="75%"><span style="font-size:12px">
                  <?php foreach($data_wo as $rowxx){ echo $rowxx->tipe_wo; } ?>
                </span></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><strong>ALAMAT</strong></td>
                <td>:</td>
                <td><span style="font-size:12px">
                  <?php foreach($data_wo as $rowxx){ echo $rowxx->alamat; } ?>
                </span></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><strong>NO. TELP/FAX</strong></td>
                <td>:</td>
                <td><span style="font-size:12px">
                  <?php foreach($data_wo as $rowxx){ echo $rowxx->telepon; } ?>
                </span></td>
              </tr>
            </table></td>
            <td height="45" colspan="3"><table style="border-style:solid; border-bottom:none; border-top:none; border-left:none; border-right:none;" width="100%" height="100%" border="1" cellpadding="0" cellspacing="0">
              <tr>
                <td align="center"><strong>TGL / JAM MASUK</strong><br>
                  <span style="font-size:12px">
                  <?php foreach($data_wo as $rowxx){ echo $rowxx->tgl_masuk; } ?> /
                  <?php foreach($data_wo as $rowxx){ echo $rowxx->jam_masuk; } ?>
                  </span></td>
                <td align="center"><strong>TGL SELESAI</strong><br>
                  <span style="font-size:12px">
                  <?php foreach($data_wo as $rowxx)
									{
									 //echo $rowxx->tgl_keluar;
									 echo "____/____/_________";
									} ?>
                  </span></td>
                </tr>
            </table></td>
            </tr>
          <tr>
            <td height="57" colspan="3" valign="top">&nbsp;<strong>CATATAN</strong><br>              <span style="font-size:12px">&nbsp;
              <?php foreach($data_wo as $rowxx){
										 echo $rowxx->riwayat;
										} ?>
              </span></td>
          </tr>
          <tr>
            <td colspan="2" valign="top"><table width="100%" border="0">
              <tr>
                <td>&nbsp;<strong>Keluhan Pasien :</strong></td>
                </tr>
              <tr>
                <td valign="top"><span style="font-size:12px">
                  &nbsp;&nbsp;<?php foreach($data_wo as $rowxx){ echo $rowxx->keluhan; } ?>
                  <br>
                  &nbsp;
                  </span></td>
                </tr>
              </table></td>
            <td colspan="4" valign="top"><table width="100%" border="0">
              <tr>
                <td>&nbsp;<strong>Tindakan :</strong></td>
                </tr>
              <tr>
                <td><span style="font-size:12px">
                  &nbsp;<?php foreach($data_wo as $rowxx){
										echo $rowxx->tindakan; } ?>
                  <br>
                  &nbsp;<?php foreach($data_wo as $rowxx){
									 //echo 'Estimasi : '.$rowxx->estimasi.' Hari';
								 }
									 ?>
                  </span></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td colspan="2" valign="top"><table width="100%" height="100%" border="0">
              <tr>
                <td>&nbsp;<strong>Riwayat Pasien :</strong></td>
                </tr>
              <tr>
                <td height="100%"><span style="font-size:12px">&nbsp;<br>
                  &nbsp;<br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  </span></td>
                </tr>
            </table></td>
            <td colspan="4" valign="top" ><table width="90%" border="0" align="left">
              <tr>
                <td>&nbsp;<strong>Resep :</strong></td>
                </tr>
              <tr>
                <td><br>
                  <br>
                  <br></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td height="20px" colspan="6" valign="middle">NB : </td>
            </tr>

        </table>
        <?php }} ?>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.printPage.js')?>"></script>
        <script type="text/javascript">
	        $(document).ready(function(){
	            $(".btnPrint").printPage();
	        })
	    </script>
      </div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
</body>
</html>
