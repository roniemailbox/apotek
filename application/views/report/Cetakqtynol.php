<?php $id = get_cookie('eklinik'); ?>
<?php include 'kopsurat_portrait.php';

?>
<body>
	<table>
	<tr>
		<td align="center">
		<div style="float:inherit;">
	<a href="<?=site_url('/')?>Kartustok" style="width:100%; display:block; font-size:12px; text-decoration: none; text-align:center; color:#FFF; background-color:#005b8a; border:0px solid #007FFF; padding: 10px 1px; margin: 5px auto 10px auto; font-weight:bold;">Kembali</a>
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


				<table border="0"  width="100%"
			  											style="background:#FFFFFF; border-collapse:separate; border-spacing:1px;">
			  										<thead>
			  										<tr>
			  										  <td style="text-align:center; font-weight:bold;"
			  												colspan='8' align='center'>KARTU STOK</td>
			  										  </tr>
			  										<tr>
			  											<td colspan='8' align='center'><hr style="height:0px;border:0.5px solid black;"/></td>
			  										</tr>
			  										<tr>
			  											<th width="6%" style="width:3%; text-align:center;">No</th>
			  											<th width="20%" style="width:10%; text-align:center;">Kode</th>
			  										  <th width="18%" style="width:10%; text-align:center;">Barcode</th>
			  											<th width="27%" style="width:47%; text-align:center;">Item</th>
															<th width="27%" style="width:10%; text-align:center;">Harga Jual</th>
			  											<th width="18%" style="width:5%; text-align:center;">Satuan</th>
			  											<th width="18%" style="width:5%; text-align:center;">perc Margin</th>
															<th width="18%" style="width:10%; text-align:center;">Margin</th>

			  										  </tr>
			                                            <tr>
			  											<td colspan='8' align='center'><hr style="height:0px;border:0.5px solid black;"/></td>
			  										</tr>
			  										</thead>

			                      <tbody id="containeritem" style="height: 100px; overflow: auto;">
			                        <?php
			  												$count=0;
			                           if(isset($data_harga_nol))
			                              {
			                                foreach ($data_harga_nol as $row)

			                                   {
			  																	 $count=$count+1;
			  																	  ?>

			                                        <tr class="records">
			                                          <td align="center" valign="top"><?php echo $count; ?></td>
			                                          <td valign="top"> <?php echo $row->id_barang; ?></td>
			  																				<td align="left" valign="top"><?php echo $row->barcode; ?> </td>
			  																				<td style="padding-bottom: 10px" valign="top"> <?php echo $row->nama; ?></td>
																								<td align="center" valign="top"> <?php echo number_format($row->hj); ?></td>
			  																				<td align="center" valign="top"> <?php echo $row->satuan; ?></td>
			                                          <td align="right" valign="top"><?php echo ($row->perc_margin); ?> </td>
																								 <td align="right" valign="top"><?php echo number_format($row->margin); ?> </td>

			                                        </tr>


			                                  <?php }
			                                }
			                              ?>
			                              <tr class="records">
			                                          <td colspan="8" align="center"><hr style="height:0px;border:0.5px solid black;"/></td>
			                        </tr>
			  			    </tbody>

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

       </td>
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
					 //w.document.write('<link href="<?php //echo site_url('/')?>build/css/style_view.css" rel="stylesheet" type="text/css" />');
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
                c

                  <?php
                  $nama_excel_as = "Kartu Stok";
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
