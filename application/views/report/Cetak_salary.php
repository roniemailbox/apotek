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
				<?php
				if(isset($data_plant)){
							foreach($data_plant as $row){ ?>
	        <h3>DAFTAR GAJI HAULING <?php echo $row->nama; ?>

	        </h3>
				<?php
					}
				}
				?>
				<br>
				Periode :
	         <?php echo format_tanggal($xtglawal); ?>
	        s/d <?php echo format_tanggal($xtglakhir); ?><br>
	        <br>


	            <table  border="1" width="100%" cellspacing="0" cellpadding="0"
						style="border-collapse:collapse;border:0.5px solid black; ">


	            <tr>
	              <th width="3%" rowspan="3">NO</th>
	              <th width="5%" rowspan="3">ID</th>
	              <th width="30%" rowspan="3">NAMA</th>
	              <th colspan="6">BJM 40 BENGKIRAI </th>
	              <th width="10%" rowspan="3">KEKURANGAN <br>
                  BULAN LALU</th>
	              <th width="7%" rowspan="3">UANG<br>
                  MAKAN</th>
                  <th width="10%" colspan="3" rowspan="3">GAJI<br>
                    KOTOR</th>
	              </tr>
	            <tr>
	              <th colspan="2">SEI 2 (27000)</th>
	              <th colspan="2">NJP (22000)</th>
	              <th colspan="2">ANTARA (27000)</th>
	              </tr>
	            <tr>
	              <th width="5%">RIT</th>
	              <th width="5%">Rp</th>
	              <th width="5%">RIT</th>
	              <th width="5%">Rp</th>
                  <th width="5%">RIT</th>
                  <th width="5%">Rp</th>

                </tr>
	            <?php
	            $no=1;
				$xrit=0;
	            $xton=0;

				$xp4p5=0;
	            $xp4p6=0;
				$xp4p8=0;
	            $xtot=0;



				if(isset($data_gaji)){
	            foreach($data_gaji as $row){
					$xp4p5=$xp4p5+$row->p4p5;
					$xp4p6=$xp4p6+$row->p4p6;
					$xp4p8=$xp4p8+$row->p4p8;
	            	$xtot=$xtot+$row->tot;

	            ?>


	            <tr>
	              <td align="center"><?php echo $no++; ?></td>
                                    <td align="center"><?php echo  $row->id_driver; ?></td>
                  <td align="left">&nbsp;<?php echo  $row->nama_pegawai; ?></td>
                                    <td align="center"><?php echo number_format($row->rit1) ?></td>
                  <td align="right"><?php echo number_format($row->p4p5) ?>&nbsp;</td>
                                    <td align="center"><?php echo number_format($row->rit2) ?></td>
                  <td align="right"><?php echo number_format($row->p4p6) ?>&nbsp;</td>
                                    <td align="center"><?php echo number_format($row->rit3) ?></td>
                  <td align="right"><?php echo number_format($row->p4p8) ?>&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                  <td colspan="3" align="right"><?php echo number_format($row->tot) ?>&nbsp;</td>
                  </tr>


	            <?php }
	            }
	            ?>
                 <tr>
	              <td colspan="3" align="center">&nbsp;</td>
	              <td align="center">&nbsp;</td>
	              <td align="right"><?php echo number_format($xp4p5) ?>&nbsp;</td>
	              <td align="center">&nbsp;</td>
	              <td align="right"><?php echo number_format($xp4p6) ?>&nbsp;</td>
	              <td align="center">&nbsp;</td>
	              <td align="right"><?php echo number_format($xp4p8) ?>&nbsp;</td>
	              <td align="center">&nbsp;</td>
	              <td align="center">&nbsp;</td>
	              <td colspan="3" align="right"><?php echo number_format($xtot) ?>&nbsp;</td>
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
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>Batulicin,
              <?php
				  $now = date('Y-m-d');
				  echo format_tanggal($now);?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center">Dibuat / Diserahkan</td>
            <td align="center">Disetujui Oleh</td>
            <td align="center">Diperiksa Oleh</td>
            <td align="center">Disetujui Oleh</td>
          </tr>
          <tr>
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
          </tr>
          <tr>
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
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><u>Hastuty Ma'ruf</u></td>
            <td align="center"><u>Budiono</u></td>
            <td align="center"><u>Ardiyansyah</u></td>
            <td align="center"><u>Antonius Saranga</u></td>
          </tr>
          <tr>
            <td align="center">Admin Hauling</td>
            <td align="center">&nbsp;</td>
            <td align="center">Admin</td>
            <td align="center">SPV/SPT CDR</td>
          </tr>
        </tbody>
      </table></td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>

</div>
<p>&nbsp;</p>
<p>
  <script>
                function printDiv(divName) {
                  var printContents = document.getElementById(divName).innerHTML;
                  w = window.open();

                  //css paper
                  w.document.write('<title><?= $this->session->userdata('nama_perusahaan'.$id)?></title>');
							w.document.write('<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>build/images/logo.png" />');
							w.document.write('<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> ');

							w.document.write('<link href="<?=site_url('/')?>build/css/bootstraps.css" rel="stylesheet" />');
							w.document.write('<link href="<?=site_url('/')?>build/css/style_view_cetak.css" rel="stylesheet" type="text/css" />');
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
</p>
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
