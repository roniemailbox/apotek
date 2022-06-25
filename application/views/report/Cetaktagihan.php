

<?php $id = get_cookie('tkkop'); ?>
<!doctype html>
<html lang="en">
<head>
	<title><?= $this->session->userdata('nama_perusahaan'.$id)?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>build/images/logo2.png" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="<?php echo base_url('build/css/bootstrapn.css')?>"/>
	<link href="<?php echo base_url('build/css/style_view.css') ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('build/css/paper.css') ?>" rel="stylesheet" type="text/css" />
	<style>@page {size: A4 landscape}</style>
</head>

<body>
  <div id="printableArea">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" id="testTable">
  <tbody>
    <tr>
      <td width="8%">&nbsp;</td>
      <td width="86%">&nbsp;</td>
      <td width="6%">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div class="container"><br>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tbody>
            <tr>
              <td width="7%"><img src="<?php echo base_url(); ?>build/images/logo.png" width="85" height="95" alt=""/></td>
              <td width="93%"><table width="100%" border="0" cellspacing="1" cellpadding="1">
                <tbody>
                  <tr>
                    <td colspan="4" style="font-size:26px; font-weight:bold" valign="top"><?= $this->session->userdata('nama_perusahaan'.$id)?></td>
                    <td colspan="4" align="right" style="font-size:36px; font-weight:bold; color:#405BA3">INVOICE</td>
                  </tr>
                  <tr>
                    <td colspan="4" align="left" valign="top"><?= $this->session->userdata('alamat_perusahaan'.$id)?></td>
                    <td width="24%" align="right" style="font-size:12px; font-weight:bold">&nbsp;</td>
                    <td width="2%" align="left" style="font-size:12px; font-weight:bold">&nbsp;</td>
                    <td width="5%" align="left" style="font-size:12px; font-weight:bold">&nbsp;</td>
                    <td width="25%" align="left" style="font-size:12px; font-weight:bold">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="0%" align="left" style="font-size:10px; font-weight:bold">&nbsp;</td>
                    <td width="3%" align="left" style="font-size:10px; font-weight:bold">Phone</td>
                    <td width="0%" align="left" style="font-size:10px; font-weight:bold">:</td>
                    <td width="41%" align="left" style="font-size:10px; font-weight:bold"><?= $this->session->userdata('telepon_perusahaan'.$id)?></td>
                    <td align="right" style="font-size:12px; font-weight:bold">&nbsp;</td>
                    <td align="left" style="font-size:12px; font-weight:bold">&nbsp;</td>
                    <td align="left" style="font-size:12px; font-weight:bold">&nbsp;</td>
                    <td align="left" style="font-size:12px; font-weight:bold">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="0%" align="left" style="font-size:10px; font-weight:bold">&nbsp;</td>
                    <td width="3%" align="left" style="font-size:10px; font-weight:bold">Fax</td>
                    <td width="0%" align="left" style="font-size:10px; font-weight:bold">:</td>
                    <td width="41%" align="left" style="font-size:10px; font-weight:bold"><?= $this->session->userdata('fax'.$id)?></td>
                    <td align="right" style="font-size:12px; font-weight:bold">&nbsp;</td>
                    <td align="left" style="font-size:12px; font-weight:bold">&nbsp;</td>
                    <td align="left" style="font-size:12px; font-weight:bold">&nbsp;</td>
                    <td align="left" style="font-size:12px; font-weight:bold">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="0%" align="left" style="font-size:10px; font-weight:bold">&nbsp;</td>
                    <td width="3%" align="left" style="font-size:10px; font-weight:bold">E-mail</td>
                    <td width="0%" align="left" style="font-size:10px; font-weight:bold">:</td>
                    <td width="41%" align="left" style="font-size:10px; font-weight:bold"><?= $this->session->userdata('email_perusahaan'.$id)?></td>
                    <td align="right" style="font-size:12px; font-weight:bold">&nbsp;</td>
                    <td align="left" style="font-size:12px; font-weight:bold">&nbsp;</td>
                    <td align="left" style="font-size:12px; font-weight:bold">&nbsp;</td>
                    <td align="left" style="font-size:12px; font-weight:bold">&nbsp;</td>
                  </tr>
                </tbody>
              </table></td>
              </tr>
          </tbody>
        </table>
        <table width="100%" border="0" cellspacing="1" cellpadding="1">

			    <?php

 	            if(isset($data_tagihan)){
 	            foreach($data_tagihan as $row){

                $no_tag=$row->no_bukti;
 	            ?>

		      <tbody>

						    <tr>
						      <td colspan="6" align="center"> </td>
						    </tr>
						    <tr>
						      <td colspan="6" align="left"><hr style="height:0px;border:0.5px solid black;"/></td>
						    </tr>
						    <tr>
						      <td rowspan="4" valign="top" style="font-weight:bold; font-size:18px">To</td>
						      <td rowspan="4" valign="top">:</td>
						      <td rowspan="4" valign="top" style="font-weight:bold; font-size:18px"><?php echo $row->nama; ?></td>
						      <td>Invoice No</td>
						      <td>:</td>
						      <td style="font-size:14px; font-weight:bold"><?php echo $row->no_bukti; ?></td>
		        </tr>
						    <tr>
						      <td>Invoice Date</td>
						      <td>:</td>
						      <td><?php echo date('d/m/Y',strtotime($row->tgl_trans)); ?></td>
		        </tr>
						    <tr>
						      <td>Star</td>
						      <td>:</td>
						      <td><?php echo $row->start; ?></td>
						    </tr>
						    <tr>
						      <td>Finish</td>
						      <td>:</td>
						      <td><?php echo $row->finish; ?></td>
						    </tr>
						    <tr>
						      <td width="11%">Invoice Address</td>
						      <td width="1%">:</td>
						      <td width="53%" rowspan="3" valign="top"><?php echo $row->alamat; ?></td>
						      <td width="10%">No PO</td>
						      <td width="0%">:</td>
						      <td width="25%"><?php echo $row->no_po; ?></td>
						    </tr>
						    <tr>
						      <td>&nbsp;</td>
						      <td>&nbsp;</td>
						      <td>Date Star</td>
						      <td>:</td>
						      <td><?php
							  	$t1=date('d/m/Y',strtotime($row->tgl_start));
								if ($t1='01/01/1970')
								{
									echo ' -';
									}
								else
								{
									echo date('d/m/Y',strtotime($row->tgl_start));
									}
							    ?></td>
				      </tr>
						    <tr>
						      <td>&nbsp;</td>
						      <td>&nbsp;</td>
						      <td>Date Finish</td>
						      <td>:</td>
						      <td><?php $t2=date('d/m/Y',strtotime($row->tgl_finish));
								if ($t2='01/01/1970')
								{
									echo '-';
									}
								else
								{
									echo date('d/m/Y',strtotime($row->tgl_finish));
									} ?></td>
				      </tr>
						    <tr>
						      <td>Attention</td>
						      <td>:</td>
						      <td><?php echo $row->attention; ?></td>
						      <td>Payment Term</td>
						      <td>:</td>
						      <td><?php echo $row->pay_term; ?> Day</td>
				      </tr>
						    <tr>
						      <td>Client Contact</td>
						      <td>:</td>
						      <td><?php echo $row->kontak_person; ?></td>
						      <td>Currency Code</td>
						      <td>:</td>
						      <td><?php echo $row->currency; ?></td>
						    </tr>
	          </tbody>

						<?php }
						}
						?>

	  </table> <br>
						 <table width="100%" border="1" cellspacing="1" cellpadding="1">
						   <tbody>
						     <tr>
						       <td style="font-weight:bold; font-size:14px;">Jenis : <?php echo $row->nama_akun; ?></td>
					         </tr>
					       </tbody>
		    </table>


                         <table width="100%" border="1" cellspacing="1" cellpadding="1" >
										<thead>
										<tr height="20px" style=" font-weight:bold; background:#3D5E92" class="td_only">
											<th width="4%" style="width:5%; text-align:center;color:#FFFFFF"">No</th>
											<th width="53%" style="width:50%; text-align:center;color:#FFFFFF"">Item / Description</th>
											<th width="14%" style="width:10%; text-align:center;color:#FFFFFF"">Quantity</th>
											<th width="9%" style="width:5%; text-align:center;color:#FFFFFF"">Jarak</th>
											<th width="9%" style="width:15%; text-align:center;color:#FFFFFF"">Unit Price (IDR) / Q</th>
											<th width="11%" style="width:15%; text-align:center;color:#FFFFFF"">Ammount (IDR)</th>
										  </tr>
										</thead>

                    <tbody id="containeritem" style="height: 100px; overflow: auto;">
                      <?php
                        $count = 0;
						$totalqty = 0;
						$totalamount=0;
                         if(isset($detail_tagihan))
                            {
                              foreach ($detail_tagihan as $row)
                                 {
								 $count++;
								 //$totalqty=$totalqty+$row->qty;
								 //$totalamount=$totalamount+$row->ammount;
								  ?>

                                      <tr class="records">

                      </tr>
                                      <tr class="records">
                                        <td align="center" valign="top"><?php echo $count; ?></td>
                                        <td><?php echo $row->item; ?> </td>
                                        <td align="center" valign="top"><?php echo number_format($row->qty,0); ?></td>
                                        <td align="center" valign="top"><?php echo $row->jarak; ?></td>
                                        <td align="center" valign="top"><?php echo number_format($row->unit_price,0); ?></td>
                                        <td align="right" valign="top"><?php echo number_format($row->total,0); ?></td>
                                      </tr>
                                <?php }
                              }
                            ?>
						   </tbody>

	  </table>

                                         <?php

 	            if(isset($data_tagihan)){
 	            foreach($data_tagihan as $row){
 	            ?>

<table width="100%" border="0" cellspacing="1" cellpadding="1">
                       <tbody>
                             <tr>
                               <td colspan="3" align="left"><h4><span>Terbilang
                                     <?php
							   		$float = floatval($row->jml_trans);
									 //echo  $float ;

									 //echo number_to_words($float);
									 echo terbilang($row->jml_trans);

							   ?>
                               </span>Rupiah</h4></td>
                               <td align="center">&nbsp;</td>
                               <td width="9%" align="left">Sub Total</td>
                               <td width="11%" align="right"><?php echo number_format($row->dpp); ?></td>
                             </tr>
                             <tr>
                               <td colspan="3" align="left" style="font-weight:bold">Remark  :                               </td>
                               <td align="center">&nbsp;</td>
                               <td align="left">Down Payment</td>
                               <td align="right"><?php echo number_format($row->dp); ?></td>
                             </tr>
                             <tr>
                               <td colspan="3" rowspan="3" align="left" valign="top"><span style="font-weight:bold">
                                 <?php

										echo $row->remark;

							    ?>
                               </span></td>
                               <td align="center">&nbsp;</td>
                               <td align="left">PPN 10%</td>
                               <td align="right"><?php echo number_format($row->ppn); ?></td>
                             </tr>

                             <?php
							 //$tot_tagihan=$row->jml_trans+$row->ppn_ar;
							 //$tot_jual=$row->total;
							 ?>
                             <tr>
							   <?php
                                 if($row->pph>0)
								 {
									 ?>
									 <td align="center">&nbsp;</td>
                                       <td align="left">PPH 2%</td>
                                       <td align="right"><?php echo number_format($row->pph); ?></td>
                               <?php
									 }
                               ?>

                             </tr>
                             <tr>
                               <td align="center">&nbsp;</td>
                               <td align="left">Total</td>
                               <td align="right"><?php echo number_format($row->jml_trans); ?></td>
                             </tr>
                             <?php //$xsisa=$row->total-$row->pph-$row->sudah_tagih-$row->sudah_ppn+$row->sudah_pph; ?>
                             <tr>
                               <td colspan="3" align="left" style="font-weight:bold">PEMBAYARAN DITRANSFER KE REKENING</td>
                               <td width="35%" align="center">&nbsp;</td>
                               <td align="right">&nbsp;</td>
                               <td align="right"><h3>&nbsp;</h3></td>
                             </tr>
                             <tr>
                               <td colspan="3" style="font-weight:bold">a/n : PT. BARA JASA MULIA</td>
                               <td align="center">Disetujui Oleh:</td>
                               <td colspan="2" align="center">Dibuat Oleh:</td>
                             </tr>
                             <tr>
                               <td width="14%">Nama Bank</td>
                               <td width="1%">:</td>
                               <td width="30%">Mandiri KCP Batulicin</td>
                               <td>&nbsp;</td>
                               <td colspan="2">&nbsp;</td>
                             </tr>
                             <tr>
                               <td>No Rekening </td>
                               <td>:</td>
                               <td>031-00-1200077-7</td>
                               <td>&nbsp;</td>
                               <td colspan="2">&nbsp;</td>
                             </tr>
                             <tr>
                               <td align="left">Jatuh Tempo</td>
                               <td align="left">:</td>
                               <td align="left"><?php echo date('d/m/Y',strtotime($row->tgl_j_tmp)); ?></td>
                               <td>&nbsp;</td>
                               <td colspan="2" align="center">&nbsp;</td>
                             </tr>
                             <tr>
                               <td align="left">&nbsp;</td>
                               <td align="left">&nbsp;</td>
                               <td align="left">&nbsp;</td>
                               <td>&nbsp;</td>
                               <td colspan="2" align="center">&nbsp;</td>
                             </tr>
                             <tr>
                               <td>&nbsp;</td>
                               <td>&nbsp;</td>
                               <td>&nbsp;</td>
                               <td align="center"><span style="font-weight:bold">(Budiyono)</span></td>
                               <td colspan="2" align="center" style="font-weight:bold">(Deni S)</td>
                             </tr>
                             <tr>
                               <td>&nbsp;</td>
                               <td>&nbsp;</td>
                               <td>&nbsp;</td>
                               <td align="center">Direktur Operasional</td>
                               <td colspan="2" align="center" >Finance</td>
                             </tr>
            </tbody>
          </table>

                         <?php }
							} ?>
                         <br>


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
							w.document.write('<style>@page { size: A4 landscape}</style>');
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
                  $nama_excel_as = 'Tagihan ';
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
