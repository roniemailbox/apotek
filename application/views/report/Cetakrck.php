<?php $id = get_cookie('eklinik'); ?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title> Point Of Sales</title>
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
			    <h3><?= $this->session->userdata('nama_perusahaan'.$id)?></h3>
		    </td>
      </tr>
			<tr>
			    <td width="100%" align="center">
				    <?= $this->session->userdata('alamat_perusahaan'.$id)?>
			    </td>
	      </tr>
	    <tr>
		    <td width="100%" align="center">
			    <h2 style="padding-top: 0px; font-size: 24px;"><strong><?php //echo ""; ?></strong></h2>
		    </td>
	    </tr>
		<tr>
        <?php

 	            if(isset($data_pos)){
 	            foreach($data_pos as $row){

 	            ?>
			<td width="100%">

 <span class="left" style="text-align: center;"><b> <?php echo "Nota Penjualan"; ?> </b></span>

				<span class="left" style="text-align: left;">No : <?php echo $row->no_bukti; ?></span>
				<span class="left" style="text-align: left;">Tanggal : <?php echo $row->tgl_trans; ?></span>
				<span class="left" style="text-align: left;">Pel: <?php echo $row->nama_customer; ?></span>

			</td>
            <?php } } ?>
		</tr>
    </table>



	<div style="clear:both;"></div>

  <table class="table" cellspacing="0"  border="0">
		<thead>
			<tr>
				<th width="10%"><em>#</em></th>
				<th width="35%" align="left">Produk</th>
				<th width="10%">Qty</th>
				<th width="25%">Harga</th>
				<th width="20%" align="right"> Total </th>
			</tr>
		</thead>
		<tbody>
		<?php
                        $count = 0;
												$totalbeli=0;
												$totalqty = 0;
                         if(isset($detail_pos))
                            {
                              foreach ($detail_pos as $row)

                                 {
																	 $count++;
																	 $totalqty=$totalqty+$row->qty;
																	 $totalbeli=$totalbeli+($row->qty*$row->hj);
																	  ?>
				<tr>
	            	<td style="text-align:center; width:30px;" valign="top"><?php echo $count; ?></td>
	                <td style="text-align:left; width:130px; padding-bottom: 10px" valign="top"><?php echo $row->nama_barang; ?><br /></td>
	                <td style="text-align:center; width:50px;" valign="top"><?php echo $row->qty; ?></td>
	                <td style="text-align:center; width:50px;" valign="top"><?php echo number_format($row->hj, 0, '.', '.'); ?></td>
	                <td style="text-align:right; width:70px;" valign="top"><?php echo number_format($row->total, 0, '.', '.'); ?>&nbsp</td>
				</tr>
		 <?php }
                              }
                            ?>

    	</tbody>
	</table>

    <?php

 	            if(isset($data_pos)){
 	            foreach($data_pos as $row){
 	            ?>
    <table class="totals" cellspacing="0" border="0" style="margin-bottom:5px; border-top: 1px solid #000; border-collapse: collapse;">
    	<tbody>
            <tr>
				<td width="52" style="text-align:left; font-weight:bold; border-top:1px solid #000; padding-top:5px;">Jumlah Item</td>
				<td width="35%" style="border-top:1px solid #000; padding-top:5px; text-align:right; font-weight:bold;"><?php echo $totalqty; ?>&nbsp</td>
    		</tr>


			<tr>
				<td style="text-align:left; font-weight:bold; border-top:1px solid #000; padding-top:5px;">Jumlah Total</td>
				<td width="35%" style="border-top:1px solid #000; padding-top:5px; text-align:right; font-weight:bold;"><?php echo number_format($row->grandtotal,0, '.', '.'); ?>&nbsp</td>
    		</tr>

			<tr>
				<td style="text-align:left; font-weight:bold; padding-top:5px;">Jumlah Pembayaran</td>
				<td style="padding-top:5px; text-align:right; font-weight:bold;"><?php echo number_format($row->jml_bayar, 0, '.', '.'); ?>&nbsp</td>
    		</tr>
				<tr>
					<td style="text-align:left; font-weight:bold; padding-top:5px;">Jumlah Kembalian</td>
					<td style="padding-top:5px; text-align:right; font-weight:bold;"><?php echo number_format($row->jml_kembali, 0, '.', '.'); ?>&nbsp</td>
	    		</tr>



    </tbody>
    </table>
    <?php } } ?>
    <div style="border-top:1px solid #000; padding-top:10px;">
    	TERIMA KASIH ATAS KUNJUNGAN ANDA
    </div>
<!--
        <div id="buttons" style="padding-top:10px; text-transform:uppercase;">
    <span class="left"><a href="#" style="width:90%; display:block; font-size:12px; text-decoration: none; text-align:center; color:#000; background-color:#4FA950; border:2px solid #4FA950; padding: 10px 1px; font-weight:bold;" id="email">Email</a></span>
    <span class="right"><button type="button" onClick="window.print();return false;" style="width:100%; cursor:pointer; font-size:12px; background-color:#FFA93C; color:#000; text-align: center; border:1px solid #FFA93C; padding: 10px 1px; font-weight:bold;">Print</button></span>
    <div style="clear:both;"></div>
-->

    <div id="bkpos_wrp">
    	<a href="<?=site_url('/')?>Buatresep" style="width:100%; display:block; font-size:12px; text-decoration: none; text-align:center; color:#FFF; background-color:#005b8a; border:0px solid #007FFF; padding: 10px 1px; margin: 5px auto 10px auto; font-weight:bold;">Kembali ke Resep</a>
    </div>

    <div id="bkpos_wrp">
    	<button type="button" onClick="window.print();return false;" style="width:101%; cursor:pointer; font-size:12px; background-color:#FFA93C; color:#000; text-align: center; border:1px solid #FFA93C; padding: 10px 0px; font-weight:bold;">Cetak Kitir</button>
    </div>





    <input type="hidden" id="id" value="<?php echo $row->no_bukti; ?>" />

</div>
<script src="<?php echo base_url('build/js/jquery-1.10.2.js') ?>"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#email').click( function(){
			var email 	= prompt("Please enter email address","test@mail.com");
			var id 		= document.getElementById("id").value;

			$.ajax({
				type: "POST",
				url: "<?=base_url()?>pos/send_invoice",
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
