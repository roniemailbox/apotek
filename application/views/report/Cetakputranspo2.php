<?php $id = get_cookie('eklinik'); ?>
<?php include 'kopsurat_portrait.php'; ?>
<body>
	<table>
	<tr>
		<td align="center">
		<div style="float:inherit;">
<a href="<?=site_url('/')?>Putranspo/baru" style="width:100%; display:block; font-size:12px; text-decoration: none; text-align:center; color:#FFF; background-color:#005b8a; border:0px solid #007FFF; padding: 10px 1px; margin: 5px auto 10px auto; font-weight:bold;">Kembali</a>

	<button type="button" class="btn btn-danger" onClick="printDiv('testTable');">
		Print
	</button>
	<button type="button" id="btnExport">
		Export to Excel
	</button>
</div>
</td>
</tr>
</table>
	<div id="book" class="book">
	      <div class="page" id="testTable">

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
					  <td width="6%" rowspan="5"> </td>
					  <td width="2%" rowspan="5">&nbsp;</td>
					<td align="right"><h2><?= $this->session->userdata('nama_perusahaan'.$id)?></h2></td>
					</tr>
					<tr>
					<td align="right"> <?= $this->session->userdata('alamat_perusahaan'.$id)?> </td>
					</tr>

					<tr>
					<td align="right">Telepon:
					  <?= $this->session->userdata('telepon_perusahaan'.$id)?></td>
					</tr>
					<tr>
					<td align="right">Email:
					  <?= $this->session->userdata('email_perusahaan'.$id)?></td>
					</tr>
		</tbody>
		</table>

<hr style="height:0px;border:0.5px solid black;"/>
	    <div align="center">
			  <table width="100%" border="0" cellspacing="1" cellpadding="1">

					  <?php

 	            if(isset($data_pu)){
 	            foreach($data_pu as $row){
					$no_pu=$row->no_bukti;
 	            ?>

				    <tbody>

						    <tr>
						      <td colspan="7" align="center"><h4>PEMBELIAN (BPB)</h4></td>
						    </tr>
						    <tr>
						      <td>&nbsp;</td>
						      <td>No Bukti</td>
						      <td>:</td>
						      <td>&nbsp;<?php echo $row->no_bukti; ?></td>
						      <td valign="top">Supplier</td>
						      <td valign="top">:</td>
						      <td valign="top">&nbsp;<?php echo $row->nama_supplier.' / '.$row->id_supplier; ?></td>
						    </tr>
						    <tr>
						      <td>&nbsp;</td>
						      <td>Tanggal</td>
						      <td>:</td>
						      <td>&nbsp;<?php //echo date('d/m/Y',strtotime($row->tgl_trans));
							  echo tgl_indo($row->tgl_trans); ?></td>
						      <td>Unit</td>
						      <td>:</td>
						      <td>&nbsp;<?php  echo $row->nama_unit_transaksi; ?></td>
						    </tr>
						    <tr>
						      <td width="0%">&nbsp;</td>
						      <td width="17%">Pembayaran</td>
						      <td width="1%">:</td>
						      <td width="38%">&nbsp;<?php echo $row->jenis_bayar; ?></td>
						      <td width="10%">No PO</td>
						      <td width="1%">:</td>
						      <td width="33%">&nbsp;<?php echo $row->no_po; ?></td>
						    </tr>
						    <tr>
						      <td>&nbsp;</td>
						      <td>Dibuat Tanggal</td>
						      <td>:</td>
						      <td>&nbsp;<?php echo $row->entry_date; ?></td>
						      <td>No Ref</td>
						      <td>:</td>
						      <td>&nbsp;<?php echo $row->no_ref; ?></td>
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
												colspan='6' align='center'>DETAIL ITEM</td>
										  </tr>
										<tr>
											<td colspan='6' align='center'><hr style="height:0px;border:0.5px solid black;"/></td>
										</tr>
										<tr>
											<th width="6%" style="width:3%; text-align:center;">No</th>
<th width="20%" style="width:17%; text-align:center;">Kode</th>
											<th width="27%" style="width:24%; text-align:center;">Item</th>
											<th width="18%" style="width:19%; text-align:center;">Harga</th>
											<th width="15%" style=" text-align:center;">Qty</th>
											<th width="14%" style="width:11%; text-align:center;">Subtotal</th>
										  </tr>
                                          <tr>
											<td colspan='6' align='center'><hr style="height:0px;border:0.5px solid black;"/></td>
										</tr>
										</thead>

                    <tbody id="containeritem" style="height: 100px; overflow: auto;">
                      <?php
                        $count = 0;
												$totalbeli=0;
												$totalqty = 0;
                         if(isset($detail_pu))
                            {
                              foreach ($detail_pu as $row)

                                 {
																	 $count++;
																	 $totalqty=$totalqty+$row->qty;
																	 $totalbeli=$totalbeli+($row->qty*$row->hb);
																	  ?>


                                      <tr class="records">
                                        <td align="center"><?php echo $count; ?></td>
                                        <td>&nbsp; <?php echo $row->kd_barang; ?></td>
										<td>&nbsp;<?php echo $row->nama_barang; ?></td>
																				<td align="right"><?php echo number_format($row->hb); ?>&nbsp;</td>
                                        <td align="right"><?php echo $row->qty; ?>&nbsp;</td>
																				<td align="right"><?php echo number_format($row->total); ?>&nbsp;</td>
                                      </tr>


                                <?php }
                              }
                            ?>
                            <tr class="records">
                                        <td colspan="6" align="center"><hr style="height:0px;border:0.5px solid black;"/></td>
                      </tr>
			    </tbody>
                           <?php

 	            if(isset($data_pu)){
 	            foreach($data_pu as $row){
 	            ?>

                <tr style=" font-weight:bold">
                  <td colspan="4" rowspan="6" align="left" valign="top" bgcolor="#FFFFFF" ><p>Keterangan :<br><?php echo $row->keterangan; ?></p>
                    <table width="80%" border="0" cellspacing="1" cellpadding="1">
        <tbody>
          <tr>
            <td width="59%" align="center">&nbsp;</td>
            <td width="41%" align="center">&nbsp;</td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td align="center">Dibuat Oleh:</td>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td align="center">&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td align="center">( <?php echo  $row->nama_pegawai ; ?> )</td>
            <td>&nbsp;</td>
            </tr>
          </tbody>
        </table></td>
                             <td align="left" >TOTAL</td>
                             <td align="right" ><?php echo number_format($row->subtotal); ?>&nbsp;</td>
                </tr>
                <tr style=" font-weight:bold">
                  <td align="left" >JENIS PPN</td>
                  <td align="right" ><?php echo ($row->jenis_ppn); ?>&nbsp;</td>
                </tr>
                <tr style=" font-weight:bold">
				  <td align="left" >DPP</td>
				  <td align="right" ><?php echo number_format($row->dpp); ?>&nbsp;</td>
			    </tr>
										<tr style=" font-weight:bold">
										  <td align="left" >PPN</td>
										  <td align="right" ><?php echo number_format($row->ppn); ?>&nbsp;</td>
			    </tr>
										<tr style=" font-weight:bold">
										  <td align="left" >GRAND TOTAL</td>
										  <td align="right" ><?php echo number_format($row->grandtotal); ?>&nbsp;</td>
			    </tr>
										<tr style=" font-weight:bold">
											<td align="left" > ITEM</td>
											<td align="right" ><?php echo $totalqty; ?>&nbsp;</td>
				</tr>
										<tr style=" font-weight:bold">
										  <td colspan="4" align="center" bgcolor="#FFFFFF">&nbsp;</td>
										  <td colspan="2" align="left" ><hr style="height:0px;border:0.5px solid black;"/></td>
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
        <?php //echo date('d/m/Y',strtotime($row->tgl_ed)); ?> </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>

        <?php }
							} ?></td>
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
					 w.document.write('<title><?= $this->session->userdata('nama_perusahaan'.$id)?></title>');
					 w.document.write('<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>build/images/logo.png" />');
					 w.document.write('<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> ');
					 w.document.write('<link href="<?=site_url('/')?>build/css/bootstrap.css" rel="stylesheet" />');
					 w.document.write('<link href="<?=site_url('/')?>build/css/style_view.css" rel="stylesheet" type="text/css" />');
					 w.document.write('<link href="<?=site_url('/')?>build/css/paper.css" rel="stylesheet" type="text/css" />');
					 w.document.write('<style>@page { size: A4 Portrait}</style>');
					 w.document.write('<style>* {color: black;} .td_only td, .td_only th {border: 1px solid black; border-collapse: collapse;}</style>');
					 w.document.write(printContents);
					 w.document.write('<script type="text/javascript"> window.onload = function() { window.print(); window.close(); };' + '</sc' + 'ript>');
					 w.document.close(); //necessary for IE >= 10
					 w.focus();


                  return true;
                }
                </script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td align="center">
      <div style="float:inherit;">
                  <!-- Print -->
                  <button type="button" class="btn btn-danger" onClick="printDiv('testTable');">
                    Print
                  </button>

                  <?php
                  $nama_excel_as = $no_pu;
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

<script src="<?php echo base_url('build/js/jquery-1.10.2.js') ?>"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#email').click( function(){
			var email 	= prompt("Please enter email address","test@mail.com");
			var id 		= document.getElementById("id").value;

			$.ajax({
				type: "POST",
				url: "<?=base_url()?>apos/send_invoice",
				data: { email: email, id: id}
			}).done(function( msg ) {
			      alert( "Successfully Sent Receipt to "+email);
			});

		});
	});

	$(window).load(function() { printDiv('testTable'); });
</script>


</body>
</html>
