<!doctype html>
<html>
<head>
	<title>DATA BUDGET TAHUNAN</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="<?php echo base_url('asset/css/bootstrap.css')?>"/>
	<link href="<?php echo base_url('asset/css/style_view.css') ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('asset/css/paper.css') ?>" rel="stylesheet" type="text/css" />
	<style>@page {size: A4 landscape}</style>
</head>
<body>
	<div class="container">

	    <div align="center">
	        <h3 style="border: 0px solid #333;">DATA BUDGET TAHUNAN</h3>


	        <br>
	        <table border="0" width="100%" cellspacing="0" cellpadding="0"
						style="border-collapse:collapse; ">
	            <thead>
	            <tr style="border-top: 1px solid black; border-bottom: 1px solid black; border-color: #e3e3e3;">
	                <th>NO</th>
									<th>PLANT</th>
	                <th>DIVISI</th>
	                <th>DEPARTEMENT</th>
	                <th>BEBAN</th>
									<th>TAHUNAN</th>
	                <th>BULANAN</th>

	            </tr>

	            </thead>

	            <?php
	            $no=1;
	            if(isset($data_budget)){
	            foreach($data_budget as $row){
	            ?>
	            <tbody>
	            <tr>
	                <td><?php echo $no++; ?></td>
									<td><?php echo $row->nama_plant; ?></td>
	                <td><?php echo $row->nama_divisi; ?></td>
	                <td><?php echo $row->nama_departement ?></td>
									<td><?php echo $row->nama_beban; ?></td>
	                <td align="right"><?php echo currency_format($row->nilai_budget_tahunan)?></td>
									<td align="right"><?php echo currency_format($row->nilai_budget_bulanan)?></td>
	            </tr>
	            <?php }
	            }
	            ?>
	            </tbody>
	        </table>

	    </div>
	    <br/>
	    <hr/>

	    <div class="span center">
	        <?php
	        if(isset($dt_penjualan)){
	            foreach($dt_penjualan as $row) { ?>
	                <h5 class="text-center">Pelanggan</h5>
	                <div class="sign"></div>
	                <h6 class="text-center"><?php echo $row->nm_pelanggan?></h6>
	            <?php }
	        }
	        ?>
	    </div>
	    <div class="span center" style="float: right">
	        <?php
	        if(isset($dt_contact)){
	            foreach($dt_contact as $row) { ?>
	                <h5 class="text-center"><?php echo $row->nama?></h5>
	                <div class="sign"></div>
	                <h6 class="text-center">Direktur : <?php echo $row->owner?></h6>
	            <?php }
	        }
	        ?>
	    </div>

	    <script type="text/javascript" src="<?php echo base_url('asset/js/jquery.printPage.js')?>"></script>
	    <script type="text/javascript">
	        $(document).ready(function(){
	            $(".btnPrint").printPage();
	        })
	    </script>

	</div>

</body>
</html>
