<?php $id = get_cookie('eklinik'); ?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>CETAK LABEL</title>
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
 
 
	<?php
       
												if(isset($data_label))
													 {
														 foreach ($data_label as $row)
																{
																	 

																	  ?>
  <table class="table" cellspacing="0"  border="1">
		<thead>
			<tr>
				<th width="35%" height="106" align="center" style="font-size:42px"><?php echo "Rp". number_format($row->hj); ?> </th>
		  </tr>
		</thead>
		<tbody>
	
				<tr>
	            	<td height="32" valign="middle" style="text-align:center; width:130px; padding-bottom: 12px; font-weight:bold"> <?php echo $row->nama; ?><?php echo $row->satuan; ?></td>
                </tr>
		 <?php }
                              }
                            ?>

    	</tbody>
	</table>

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
