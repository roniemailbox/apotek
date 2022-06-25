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
		<table width="100%" border="0" cellspacing="1" cellpadding="1">
		<tbody>

					<tr>
					  <td width="6%" rowspan="5"><img src="<?php echo base_url(); ?>build/images/logo.png" width="91" height="77" alt=""/></td>
					  <td width="2%" rowspan="5">&nbsp;</td>
					<td colspan="3"><h2><?= $this->session->userdata('nama_perusahaan'.$id)?></h2></td>
					</tr>
					<tr>
					<td colspan="3"> <?= $this->session->userdata('alamat_perusahaan'.$id)?> </td>
					</tr>

					<tr>
					<td width="5%">Telepon</td>
					<td width="0%">:</td>
					<td width="87%"><?= $this->session->userdata('telepon_perusahaan'.$id)?></td>
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
			  <table width="100%" border="0" cellspacing="1" cellpadding="1">

					  <?php

 	            if(isset($data_po)){
 	            foreach($data_po as $row){
					$no_po=$row->no_bukti;
 	            ?>

				    <tbody>

						    <tr>
						      <td colspan="7" align="center"><h4>PURCHASE ORDER (PO)</h4></td>
						    </tr>
						    <tr>
						      <td>&nbsp;</td>
						      <td>No Bukti</td>
						      <td>:</td>
						      <td><?php echo $row->no_bukti; ?></td>
						      <td>Supplier</td>
						      <td>:</td>
						      <td><?php echo $row->nama_supplier; ?></td>
						    </tr>
						    <tr>
						      <td>&nbsp;</td>
						      <td>Tanggal</td>
						      <td>:</td>
						      <td><?php echo date('d/m/Y',strtotime($row->tgl_trans)); ?></td>
						      <td>Alamat</td>
						      <td>:</td>
						      <td><?php echo $row->alamat; ?></td>
						    </tr>
						    <tr>
						      <td width="0%">&nbsp;</td>
						      <td width="17%">Nama Pembuat</td>
						      <td width="1%">:</td>
						      <td width="38%"><?php echo $row->user_entry; ?></td>
						      <td width="10%">Jatuh Tempo</td>
						      <td width="1%">:</td>
						      <td width="33%"><?php echo $row->top; ?></td>
						    </tr>
						    <tr>
						      <td>&nbsp;</td>
						      <td>Dibuat Tanggal</td>
						      <td>:</td>
						      <td><?php echo $row->entry_date; ?></td>
						      <td>&nbsp;</td>
						      <td>&nbsp;</td>
						      <td>&nbsp;</td>
				      </tr>
						    <tr>
						      <td>&nbsp;</td>
						      <td>Keterangan</td>
						      <td>:</td>
						      <td><?php echo $row->keterangan; ?></td>
						      <td>&nbsp;</td>
						      <td>&nbsp;</td>
						      <td>&nbsp;</td>
						    </tr>
			        </tbody>

						<?php }
						}
						?>

	  </table>

<table border="0"  width="100%"
											style="background:#FFFFFF; border-collapse:separate; border-spacing:1px;">
										<thead>
										<tr>
										  <td style="text-align:center; font-weight:bold;"
												colspan='7' align='center'>DETAIL PART ITEM</td>
										  </tr>
										<tr>
											<td colspan='7' align='center'><hr style="height:0px;border:0.5px solid black;"/></td>
										</tr>
										<tr>
											<th width="5%" style="width:3%; text-align:center;">No</th>
<th width="8%" style="width:17%; text-align:center;">Kd Barang</th>
											<th width="18%" style="width:17%; text-align:center;">Part Numbar</th>
											<th width="37%" style="width:35%; text-align:center;">Part Name</th>
											<th width="10%" style="width:5%; text-align:center;">Harga Beli</th>
											<th width="7%" style="width:5%; text-align:center;">Qty Pesan</th>
											<th width="12%" style="width:5%; text-align:center;">Subtotal</th>
										  </tr>
                                          <tr>
											<td colspan='7' align='center'><hr style="height:0px;border:0.5px solid black;"/></td>
										</tr>
										</thead>

                    <tbody id="containeritem" style="height: 100px; overflow: auto;">
                      <?php
                        $count = 0;
												$totalbeli=0;
												$totalqty = 0;
                         if(isset($detail_po))
                            {
                              foreach ($detail_po as $row)

                                 {
								 $count++;
								 $totalqty=$totalqty+$row->qty;
								 $totalbeli=$totalbeli+($row->qty*$row->harga_beli);
								  ?>


                                      <tr class="records">
                                        <td align="center"><?php echo $count; ?></td>
                                        <td><?php echo $row->kd_barang; ?></td>
																				<td><?php echo $row->part_number; ?></td>
                                        <td><?php echo $row->nama_barang; ?></td>
																				<td align="right"><?php echo number_format($row->harga_beli); ?></td>
                                        <td align="right"><?php echo $row->qty; ?></td>
																				<td align="right"><?php echo number_format($row->qty*$row->harga_beli); ?></td>
                                      </tr>


                                <?php }
                              }
                            ?>
                            <tr class="records">
                                        <td colspan="7" align="center"><hr style="height:0px;border:0.5px solid black;"/></td>
                      </tr>
			    </tbody>
                           <?php

 	            if(isset($data_po)){
 	            foreach($data_po as $row){
 	            ?>

<tr style="background-color:#B0B0AD; color:white; font-weight:bold">
				  <td colspan="5" rowspan="4" align="center" bgcolor="#FFFFFF">&nbsp;</td>
				  <td align="left" bgcolor="#CCCCCC">DPP</td>
				  <td align="right" bgcolor="#CCCCCC"><?php echo number_format($row->dpp); ?></td>
			    </tr>
										<tr style="background-color:#B0B0AD; color:white; font-weight:bold">
										  <td align="left" bgcolor="#CCCCCC">PPN</td>
										  <td align="right" bgcolor="#CCCCCC"><?php echo number_format($row->ppn); ?></td>
			    </tr>
										<tr style="background-color:#B0B0AD; color:white; font-weight:bold">
										  <td align="left" bgcolor="#CCCCCC">TOTAL</td>
										  <td align="right" bgcolor="#CCCCCC"><?php echo number_format($row->total); ?></td>
			    </tr>
										<tr style="background-color:#B0B0AD; color:white; font-weight:bold">
											<td align="left" bgcolor="#CCCCCC"> ITEM</td>
											<td align="right" bgcolor="#CCCCCC"><?php echo $totalqty; ?></td>
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
      <td>
        E.D :  <?php echo date('d/m/Y',strtotime($row->tgl_ed)); ?> </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><table width="100%" border="0" cellspacing="1" cellpadding="1">
                           <tbody>
                             <tr>
                               <td width="23%" align="center">Dibuat Oleh:</td>
                               <td width="27%" align="center">&nbsp;</td>
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
                               <td align="center">( <?php echo  $row->user_entry ; ?> )</td>
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

                         <?php }
							} ?></td>
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
                  $nama_excel_as = $no_po;
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
