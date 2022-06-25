
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


        <table width="100%" border="0">
          <tr>
            <td width="19%" rowspan="4"><img src="<?php echo base_url(); ?>build/images/logo.png" width="154" height="51" alt=""/></td>
            <td colspan="7" align="right"><h2><?= $this->session->userdata('nama_perusahaan'.$id)?></h2></td>
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
	    </div>






	    <script type="text/javascript" src="<?php echo base_url('build/js/jquery.printPage.js')?>"></script>
	    <script type="text/javascript">
	        $(document).ready(function(){
	            $(".btnPrint").printPage();
	        })
	    </script>


      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse; ">
        <tr>
          <th colspan="8"><hr style="height:0px;border:0.5px solid black;"/></th>
        </tr>
        <tr style="font-weight:bold; background:#787878; height:30px; color:white;" class="td_only" valign="middle">
          <th width="11%" style="width:10%; text-align:center;">No Bukti</th>
          <th width="11%" style="width:10%; text-align:center;">Kode Akun</th>
          <th width="12%" style="width:25%; text-align:center;">Nama Akun</th>
          <th width="30%" style="width:25%; text-align:center;">Keterangan</th>
          <th width="21%" style="width:10%; text-align:center;">Debet</th>
          <th width="21%" style="width:10%; text-align:center;">Debet</th>
        </tr>
        <tr>
          <td colspan="8"><hr style="height:0px;border:0.5px solid black;"/></td>
        </tr>
        <?php
								//declare 0-1
								$noxz = 1;
								$petik = "";

								//looping ke 1
								foreach ($dt_unit_x_l1 as $dt){
									//declare 1-1
									$tgl_jurnal = $dt['tgl_trans'];
									?>
        <tr valign="middle" class="td_only" style="font-weight:bold; color:rgb(0,0,0); background:#D3D1D1"
										>
          <td colspan="8" height="25" valign="middle" align="left" style="width:10%; font-weight:bold;">&nbsp; <?php echo "Tanggal : ".$dt['tgl_trans']; ?></td>
        </tr>
        <?php
									//looping ke 2
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
											$total_d = $total_d + $dt_l3['jml_D'];
											$total_k = $total_k + $dt_l3['jml_K'];

											$no_bukti_x = $dt_l3['no_bukti'];
											$no_bukti_x = substr($no_bukti_x,0,3);
											?>
        <tr class="td_only">
          <td style="width:7%;" valign="top">&nbsp;
            <?php
												echo $petik.$dt_l3['no_bukti'];
												?></td>
          <td align="left" style="width:10%;" valign="top"><?php
													echo $petik.$dt_l3['kd_akun'];
													?></td>
          <td style="width:25%;" align="left" valign="top"><?php echo ucwords(strtolower($dt_l3['nama'])); ?></td>
          <td align="left" style="width:25%;" valign="top"><?php
													echo ucwords(strtolower($dt_l3['keterangan']));
													?></td>
          <td align="right" style="width:10%;" valign="top"><?php
													echo number_format($dt_l3['jml_D'],2);
													?></td>
          <td colspan="3" align="right" style="width:10%;" valign="top"><?php echo number_format($dt_l3['jml_K'],2); ?> &nbsp;</td>
        </tr>
        <?php
										}
										?>
        <tr class="td_only" bgcolor="#EAEAEA">
          <td height="25" colspan="2" style="width:7%;"></td>
          <?php
													$cekbalance = $total_d-$total_k;
													//echo $cekbalance;
													?>
          <td style="width:25%"; align="left"><strong><?php
		  if ($cekbalance == 0){
		  echo "Total";
		  }
		  else
		  {
			  echo "Total Unbalance";
			  }
		 ?>
		  </strong>
          </td>
          <td align="right" style="width:25%;"></td>
          <td width="21%" align="right" style="width:10%;"><strong> <?php echo number_format($total_d,2); ?>&nbsp; </strong></td>
          <td colspan="3" align="right" style="width:10%;"><strong> <?php echo number_format($total_k,2); ?>&nbsp; </strong> </td>
          </tr>
        <tr>
          <td colspan="8">&nbsp;</td>
        </tr>
        <?php

									}
									?>
        <?php
									$noxz = $noxz+1;
									?>
        <?php
								}
								?>
        <tfoot style="font-weight:bold; background:#6B6B6B; color:white;"
							 class="td_only">
          <tr style="height:25px;">
            <td width="5%" style="width:7%;"></td>
            <td width="11%" style="width:13%;"></td>
            <td style="width:10%;" align="center"></td>
            <td style="width:25%;" align="right"></td>
            <td style="width:25%;" align="right"></td>
            <td width="13%" align="right" style="width:10%;"></td>
            <td style="width:10%;" align="right"></td>
          </tr>
        </tfoot>
      </table></td>
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
                  <button type="button" class="btn btn-danger" onclick="printDiv('testTable');">
                    Print
                  </button>

                  <?php
                  $nama_excel_as = 'Jurnal';
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
											var table1=table;
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
