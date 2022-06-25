<?php $id = get_cookie('eklinik'); ?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Cetak Tagihan Klinik</title>
		<script src="<?=base_url()?>assets/js/jquery-1.7.2.min.js"></script>

<style type="text/css" media="all">
	body {
		max-width: 300px;
		margin:0 auto;
		text-align:center;
		color:#000;
		font-family: Arial, Helvetica, sans-serif;
		font-size:12px;
	}
	#wrapper {
		min-width: 250px;
		margin: 0px auto;
	}
	#wrapper img {
		max-width: 300px;
		width: auto;
	}

	h2, h3, p {
		margin: 5px 0;
	}
	.left {
		width:100%;
		float:right;
		text-align:right;
		margin-bottom: 3px;
		margin-top: 3px;
	}
	.right {
		width:40%;
		float:right;
		text-align:right;
		margin-bottom: 3px;
	}
	.table, .totals {
		width: 100%;
		margin:10px 0;
	}
	.table th {
		border-top: 1px solid #000;
		border-bottom: 1px solid #000;
		padding-top: 4px;
		padding-bottom: 4px;
	}
	.table td {
		padding:0;
	}
	.totals td {
		width: 24%;
		padding:0;
	}
	.table td:nth-child(2) {
		overflow:hidden;
	}

	@media print {
		body { text-transform: uppercase; }
		#buttons { display: none; }
		#wrapper { width: 100%; margin: 0; font-size:12px; }
		#wrapper img { max-width:300px; width: 80%; }
		#bkpos_wrp{
			display: none;
		}
	}
</style>
</head>

<body>
<div id="wrapper">
	<table border="0" style="border-collapse: collapse; width: 100%; height: auto;">
    <tr>
		    <td width="100%" align="center">
			    <center>
		    	  <img src="<?php echo base_url(); ?>build/images/logo.png" style="width: 120px;" />
			    </center>
		    </td>
      </tr>
	    <tr>
		    <td width="100%" align="center">
			    <h4 style="padding-top: 0px; font-size: 24px;"><strong><?= $this->session->userdata('nama_perusahaan'.$id)?></strong></h4>
		    </td>
	    </tr>
		<tr>
			<?php

					 if(isset($data_wo)){
					 foreach($data_wo as $row){
					 ?>
			<td width="100%">


				<span class="left" style="text-align: left;">No Reg - Pasien  : <?php echo $row->no_register_px.' - '.$row->nama ?></span>
				<span class="left" style="text-align: left;">No Bukti : <?php echo $row->no_wo; ?></span>
				<span class="left" style="text-align: left;">Tanggal : <?php echo $row->tgl_masuk; ?></span>
				<span class="left" style="text-align: left;">Dokter&nbsp; : <?php echo $row->nama_dokter; ?></span>

			</td>
            <?php } } ?>
		</tr>
    </table>



	<div style="clear:both;"></div>

  <table class="table" cellspacing="0"  border="0">
		<thead>
			<tr>
				<th width="10%"><em>#</em></th>
				<th width="35%" align="left">Item</th>
				<th width="10%">Qty</th>
					<th width="10%">Harga</th>
				<th width="25%">Stn</th>
				<th width="20%" align="right"> Harga </th>
			</tr>
		</thead>
		<tbody>
		<?php
                        $count = 0;
												$totaltagihan=0;
												$totalqty = 0;
												if(isset($detail_resep))
													 {
														 foreach ($detail_resep as $row)
																{
																	 $count++;
																	 $totaltagihan=$totaltagihan+$row->total;
																	  ?>
				<tr>
	            	<td style="text-align:center; width:30px;" valign="top"><?php echo $count; ?></td>
	                <td style="text-align:left; width:130px; padding-bottom: 10px" valign="top"><?php echo $row->nama_obat; ?><br /></td>
	                <td style="text-align:center; width:50px;" valign="top"><?php echo $row->qty; ?></td>
									<td style="text-align:center; width:50px;" valign="top"><?php echo $row->hj; ?></td>
	                <td style="text-align:center; width:50px;" valign="top"><?php echo $row->satuan; ?></td>
	                <td style="text-align:right; width:70px;" valign="top"><?php echo number_format($row->total); ?></td>
				</tr>
		 <?php }
                              }
                            ?>

    	</tbody>
	</table>

	<table class="table" cellspacing="0"  border="0">
		<thead>
			<tr>
				<th width="10%"><em>#</em></th>
				<th width="35%" align="left">Tindakan</th>

				<th width="20%" align="right"> </th>
			</tr>
		</thead>
		<tbody>
		<?php
												$count = 0;

												$totalqty = 0;
												if(isset($data_jasa))
													 {
														 foreach ($data_jasa as $row)
																{
																	 $count++;
																	 $totaltagihan=$totaltagihan+$row->nilai;
																		?>
				<tr>
								<td style="text-align:center; width:30px;" valign="top"><?php echo $count; ?></td>
									<td style="text-align:left; width:130px; padding-bottom: 10px" valign="top"><?php echo $row->nama; ?><br /></td>

									<td style="text-align:right; width:70px;" valign="top"><?php echo number_format($row->nilai); ?></td>
				</tr>
		 <?php }
															}
														?>

			</tbody>
	</table>
	<table class="table" cellspacing="0"  border="0">
		<thead>
			<tr>
				<th width="10%" align="left"> Total  </th>
				<th width="10%" align="right"> <?php echo number_format($totaltagihan); ?>  </th>
			</tr>
		</thead>

	</table>
    <div style="border-top:1px solid #000; padding-top:10px;">
    	TERIMA KASIH ATAS KEPERCAYAAN KEPADA KAMI DAN SEMOGA SEHAT SELALU
    </div>
<!--
        <div id="buttons" style="padding-top:10px; text-transform:uppercase;">
    <span class="left"><a href="#" style="width:90%; display:block; font-size:12px; text-decoration: none; text-align:center; color:#000; background-color:#4FA950; border:2px solid #4FA950; padding: 10px 1px; font-weight:bold;" id="email">Email</a></span>
    <span class="right"><button type="button" onClick="window.print();return false;" style="width:100%; cursor:pointer; font-size:12px; background-color:#FFA93C; color:#000; text-align: center; border:1px solid #FFA93C; padding: 10px 1px; font-weight:bold;">Print</button></span>
    <div style="clear:both;"></div>
-->

    <div id="bkpos_wrp">
    	<a href="<?=site_url('/')?>Kasirklinik" style="width:100%; display:block; font-size:12px; text-decoration: none; text-align:center; color:#FFF; background-color:#005b8a; border:0px solid #007FFF; padding: 10px 1px; margin: 5px auto 10px auto; font-weight:bold;">Kembali ke Kasir Klinik</a>
    </div>

    <div id="bkpos_wrp">
    	<button type="button" onClick="window.print();return false;" style="width:101%; cursor:pointer; font-size:12px; background-color:#FFA93C; color:#000; text-align: center; border:1px solid #FFA93C; padding: 10px 0px; font-weight:bold;">Cetak Resep</button>
    </div>





    <input type="hidden" id="id" value="<?php echo $row->no_wo; ?>" />

</div>

<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
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

	$(window).load(function() { window.print(); });
</script>




</body>
</html>
