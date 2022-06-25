<html lang="en">
<head>
    <meta charset="utf-8">
    <title>DETAIL MASTER UNIT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bara Jasa Mulia">
    <meta name="author" content="Djava-ui">

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url('asset/css/bootstrap.css')?>"/>
    <link rel="stylesheet" href="<?php echo base_url('asset/css/bootstrap-responsive.css')?>"/>
    <link rel="stylesheet" href="<?php echo base_url('asset/css/style.css')?>"/>
    <style type="text/css">
        .chzn-container-single .chzn-search input{
            width: 100%;
        }
    </style>

    <!-- Fav icon -->
    <link rel="shortcut icon" href="<?php echo base_url('asset/img/favicon.ico')?>">


</head>

<body>
<div class="container">

    <style type="text/css">
        body{
            background-color: #ffffff;
        }
        [class*="span"] {
            float: left;
            min-height: 1px;
            margin-left: 5px;
        }
        .span {
            width: 220px;
        }
        .sign{
            height: 100px;
            border-bottom: 1px solid #000000;
        }
        .text-center{
            text-align: center
        }

    </style>
    <div align="left">
        <?php if(isset($dt_contact)){foreach($dt_contact as $row){?>
            <strong style="font-size: x-large; float: left; color: #3a87ad;"><?php echo $row->nama?></strong> <br/><br/>
            <strong style="font-size: large; float: left; color: #3a87ad;"><?php echo $row->desc?></strong> <br/>
        <?php }} ?>
        <hr/>
        <table>
            <tr>
                <?php if(isset($dt_contact)){foreach($dt_contact as $row){?>
                    <td width="70%"><strong>Alamat : </strong> <?php echo $row->alamat?></td>
                <?php }} ?>
            </tr>
            <tr>
                <?php if(isset($dt_contact)){foreach($dt_contact as $row){?>
                    <td width="70%"><strong>Phone : </strong> <?php echo $row->telp?> </td>
                <?php }}?>
            </tr>
            <tr>
                <td align="left"><strong>Operator : </strong> <?php echo $this->session->userdata('USERNAME')?></td>
            </tr>
            <tr>
                <td align="left"><strong>Date : </strong>  <?php echo isset($date1) ? $date1 : date('d M Y')?></td>
            </tr>
        </table>
    </div>
    <br/>

    <div align="center">
        <h3 style="border: 0px solid #333;">DATA BUDGET TAHUNAN</h3>
				<hr />
        <br/>
        <div align="left">
            <table>
                <?php if(isset($data_budgetx))
								{
									foreach($data_budgetx as $row) { ?>
                    <tr>
                        <td width="65%"><strong>Kode Penjualan : </strong> <?php echo $row->id_beban; ?></td>
                        <td style="float: right"><strong>Pelanggan : </strong> <?php echo $row->nm_pelanggan; ?></td>
                    </tr>
                    <tr>
                        <td width="65%"><strong>Tanggal Penjualan : </strong> <?php echo date("d M Y",strtotime($row->tanggal_penjualan));?></td>
                        <td style="float: right"><strong>Alamat : </strong> <?php echo $row->alamat; ?></td>
                    </tr>
                    <tr>
                        <td width="65%"><strong>Pegawai : </strong> <?php echo $row->nama; ?></td>
                        <td style="float: right"><strong>Email : </strong> <?php echo $row->email; ?></td>
                    </tr>

                <?php } } ?>
            </table>

        </div>
        <br>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>NO</th>
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
                <td><?php echo $row->nama_divisi; ?></td>
                <td><?php echo $row->nama_departement ?></td>
								<td><?php echo $row->nama_beban; ?></td>
                <td><?php echo currency_format($row->nilai_budget_tahunan)?></td>
								<td><?php echo currency_format($row->nilai_budget_bulanan)?></td>
            </tr>
            <?php }
            }
            ?>
            </tbody>
        </table>
        <?php if(isset($dt_penjualan)){ foreach($dt_penjualan as $row) { ?>
            <h5 style="float:right;">
                Total : <?php echo currency_format($row->total_harga)?>
            </h5>
        <?php }}?>
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
