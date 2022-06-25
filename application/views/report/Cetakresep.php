<?php $id = get_cookie('eklinik'); ?>
<!doctype html>
<html lang="en">
<head>
	<title><?= $this->session->userdata('nama_perusahaan'.$id)?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>build/images/logo.png" />
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
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tbody>
     <tr>
       <td width="4%">&nbsp;</td>
       <td width="92%">&nbsp;</td>
       <td width="4%">&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td><div class="container">
         <table width="100%" border="0" cellspacing="1" cellpadding="1">
           <tbody>
						 <tr>
	 					<td width="6%" rowspan="5"><img src="<?php echo base_url(); ?>build/images/logo.png" width="150" height="60" alt=""/></td>
	 					<td colspan="3"><h2><?= $this->session->userdata('nama_perusahaan'.$id)?></h2></td>
	 					</tr>
	 					<tr>

	 					<td>Alamat</td>
	 					<td width="1%">:</td>
	 					<td width="89%"><?= $this->session->userdata('alamat_perusahaan'.$id)?></td>
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
         <table width="100%" border="0" cellspacing="1" cellpadding="1">
           <?php

  	            if(isset($data_resep)){
  	            foreach($data_resep as $row){
  	            ?>
           <tbody>
             <tr>
               <td colspan="7" align="center"></td>
             </tr>
             <tr>
               <td colspan="7" align="center"><h3><?php echo $title; ?></h3></td>
             </tr>
             <tr>
               <td colspan="7" align="center"><h4>&nbsp;</h4></td>
             </tr>
             <tr>
               <td>&nbsp;</td>
               <td style="font-weight:bold">Pasien</td>
               <td>:</td>
               <td rowspan="2" valign="top" style="font-weight:bold"><?php echo $row->no_register_px.' - '.$row->nama_pasien ?></td>
               <td>No. Resep</td>
               <td>:</td>
               <td><?php $no_bukti=$row->no_bukti; echo $row->no_bukti; ?></td>
             </tr>
             <tr>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
               <td>Tanggal</td>
               <td>:</td>
               <td><?php //echo date('d/m/Y',strtotime($row->tgl_trans));
 			  echo $row->tgl_trans;
 			   ?></td>
             </tr>
             <tr>
               <td width="0%">&nbsp;</td>
               <td width="11%">Dokter</td>
               <td width="1%">:</td>
               <td width="44%"><?php echo $row->id_dokter ." - ".$row->nama_dokter; ?></td>
               <td width="10%">&nbsp;</td>
               <td width="1%">&nbsp;</td>
               <td width="33%">&nbsp;</td>
             </tr>
           </tbody>
           <?php }
 						}
 						?>
         </table>
         <br>
         <table border="0"  width="100%"
 											style="background:#FFFFFF; border-collapse:separate; border-spacing:1px;">
           <thead>
             <tr height="20px" style="background: #337ab7; color:white;" class="td_only">
               <th style="width:2%; text-align:center;">No</th>
               <th style="width:35%; text-align:center;">Item Obat</th>
               <th style="width:5%; text-align:center;">Qty</th>
               <th style="width:10%; text-align:center;">Satuan</th>
							 <th style="width:35%; text-align:center;;">Keterangan</th>
             </tr>
           </thead>
           <tbody style="height: 100px; overflow: auto;">
             <?php
                         $count = 0;
 						$totalqty = 0;
 						$totalamount=0;
                          if(isset($detail_resep))
                             {
                               foreach ($detail_resep as $row)
                                  {
 								 $count++;
 								 //$totalqty=$totalqty+$row->qty;
 								 //$totalamount=$totalamount+$row->ammount;
 								  ?>

             <tr class="records">
               <td align="center"><?php echo $count; ?></td>
               <td><?php echo $row->nama_obat; ?></td>
               <td align="center"><?php echo $row->qty; ?></td>
							 <td align="center"><?php echo $row->satuan; ?></td>
               <td align="left"><?php echo $row->keterangan; ?></td>
             </tr>




             <tr class="records">
               <td colspan="5" align="center"></td>
             </tr>
             <?php }
                               }
                             ?>
           </tbody>
           <?php

  	            if(isset($data_resep)){
  	            foreach($data_resep as $row){
  	            ?>
           <tr style="font-weight:bold">
             <td colspan="5" align="center" style="background:#FFFFFF"><hr style="height:0px;border:0.5px solid black;"/></td>
           </tr>
           <tr style="font-weight:bold">
             <td colspan="5" align="left" style="background:#FFFFFF"><h3>&nbsp;</h3></td>
           </tr>
           </table>
         <?php }
 												}
 												?>
         <br>
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

</div>
<script>
                function printDiv(divName) {
                  var printContents = document.getElementById(divName).innerHTML;
                  w = window.open();

                  //css paper
                  w.document.write('<title><?= $this->session->userdata('nama_perusahaan'.$id)?></title>');
									w.document.write('<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>build/images/logo.png" />');
									w.document.write('<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> ');

									w.document.write('<link href="<?=base_url('/')?>build/css/bootstraps.css" rel="stylesheet" />');
									w.document.write('<link href="<?=base_url('/')?>build/css/style_view.css" rel="stylesheet" type="text/css" />');
									w.document.write('<link href="<?=base_url('/')?>build/css/paper.css" rel="stylesheet" type="text/css" />');
									w.document.write('<style>@page { size: A4 }</style>');
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
                  $nama_excel_as = $no_bukti;
                  ?>

                  <input type="text" value="<?php echo $nama_excel_as; ?>" id="nama_excel_as" hidden />

                  <!-- Export Excel -->
                  <!-- start tambahan untuk excel -->
				  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>  -->
                  <script data-require="jquery" data-semver="2.2.0" src="<?=base_url('/')?>build/source_ant/js/jquery.min.js"></script>
                  <script type="text/javascript" src="<?=base_url('/')?>build/source_ant/js/export-excel.jquery.min"></script>
                  <script type="text/javascript" src="<?=base_url('/')?>build/source_ant/js/jquery.table2excel.js"></script>
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
