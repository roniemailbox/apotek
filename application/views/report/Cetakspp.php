<!doctype html>
<html lang="en">
<head>
	<title><?= $this->session->userdata('nama_perusahaan1')?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>production/images/iconic.png" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="<?php echo base_url('build/css/bootstrap.css')?>"/>
	<link href="<?php echo base_url('build/css/style_view.css') ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('build/css/paper.css') ?>" rel="stylesheet" type="text/css" />
	<style>@page {size: A4 auto}</style>
</head>
<body>
	<div class="container">


				  <table width="100%" border="0" cellspacing="1" cellpadding="1">
					<tbody>

								<tr>
								<td width="6%" rowspan="4"><img src="<?php echo base_url(); ?>build/images/logo.png" width="91" height="77" alt=""/></td>
								<td colspan="3"><h3><?= $this->session->userdata('nama_perusahaan1')?></h3></td>
								</tr>
								<tr>
								<td colspan="3"> <?= $this->session->userdata('alamat_perusahaan1')?> </td>
								</tr>
								<tr>
								<td colspan="3">
								  <?= $this->session->userdata('kota_perusahaan1')?></td>
								
								</tr>
								<tr>
								<td width="4%">Telepon</td>
								<td width="1%">:</td>
								<td width="89%"><?= $this->session->userdata('telepon_perusahaan1')?></td>
								</tr>
					</tbody>
					</table>
				  <table width="100%" border="0" cellspacing="1" cellpadding="1">

					  <?php
 	           
 	            if(isset($data_spb)){
 	            foreach($data_spb as $row){
 	            ?>

				    <tbody>

						    <tr>
						      <td colspan="7" align="center"><hr></td>
						    </tr>
						    <tr>
						      <td colspan="7" align="left"><h4>SURAT PERMINTAAN PEMBELIAN (SPP)</h4></td>
						    </tr>
						    <tr>
						      <td>&nbsp;</td>
						      <td>No Bukti</td>
						      <td>:</td>
						      <td><?php echo $row->no_bukti; ?></td>
						      <td>Unit</td>
						      <td>:</td>
						      <td><?php echo $row->id_unit; ?></td>
						    </tr>
						    <tr>
						      <td>&nbsp;</td>
						      <td>Tanggal</td>
						      <td>:</td>
						      <td><?php echo date('d/m/Y',strtotime($row->tgl_trans)); ?></td>
						      <td>Slock</td>
						      <td>:</td>
						      <td><?php echo $row->slock; ?></td>
						    </tr>
						    <tr>
						      <td width="0%">&nbsp;</td>
						      <td width="17%">Nama Pemohon</td>
						      <td width="1%">:</td>
						      <td width="38%"><?php echo $row->nama_pegawai; ?></td>
						      <td width="10%">Plant</td>
						      <td width="1%">:</td>
						      <td width="33%"><?php echo $row->nama_plant; ?></td>
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
						 <br>
                         
                         <table border="0"  width="100%"
											style="background:#FFFFFF; border-collapse:separate; border-spacing:1px;">
										<thead>
										<tr>
											<td height="20px" style="background-color:#00A9FB; color:white; text-align:center; font-weight:bold;"
												colspan='4' align='center'>
												DETAIL PART ITEM
											</td>
										</tr>
										<tr height="20px" style="background: #337ab7; color:white;" class="td_only">
											<th style="width:3%; text-align:center;">No</th>
											<th style="width:17%; text-align:center;">Part Numbar</th>
											<th style="width:35%; text-align:center;">Part Name</th>
											<th style="width:5%; text-align:center;">Qty Pesan</th>
										  </tr>
										</thead>

                    <tbody id="containeritem" style="height: 100px; overflow: auto;">
                      <?php
                        $count = 0;
						$totalqty = 0;
                         if(isset($detail_spb))
                            {
                              foreach ($detail_spb as $row)
                                 { 
								 $count++;
								 $totalqty=$totalqty+$row->qty;
								  ?>

                                      <tr class="records">
                                        <td align="center"><?php echo $count; ?></td>
                                        <td><?php echo $row->kd_barang; ?></td>

                                        <td><?php echo $row->nama_barang; ?></td>

                                        <td align="center"><?php echo $row->qty; ?></td>
                                      </tr>

                                <?php }
                              }
                            ?>
						   </tbody>

										<tr style="background-color:#B0B0AD; color:white; font-weight:bold">
											<td align="center">&nbsp;</td>
											<td align="center"></td>
											<td align="right">Total &nbsp;</td>
											<td align="center"><?php echo $totalqty; ?></td>
										</tr>
	  </table>
                                        
                                         <?php
 	           
 	            if(isset($data_spb)){
 	            foreach($data_spb as $row){
 	            ?>
                
      <table width="100%" border="0" cellspacing="1" cellpadding="1">
                           <tbody>
                             <tr>
                               <td width="23%" align="center">Mengetahui</td>
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
							} ?>
                         <br>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.printPage.js')?>"></script>
	    <script type="text/javascript">
	        $(document).ready(function(){
	            $(".btnPrint").printPage();
	        })
	    </script>

	</div>

</body>
</html>
