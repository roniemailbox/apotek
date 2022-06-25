

<?php $id = get_cookie('tkkop'); ?>
<!doctype html>
<html lang="en">
<head>
	<title><?= $this->session->userdata('nama_perusahaan'.$id)?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>build/images/logo2.png" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="<?php echo base_url('build/css/bootstraps.css')?>"/>
	<link href="<?php echo base_url('build/css/style_view.css') ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('build/css/paper.css') ?>" rel="stylesheet" type="text/css" />
	<style>@page {size:A4 portrait}</style>
</head>

<body>
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
              <td width="6%" rowspan="5"><img src="<?php echo base_url(); ?>build/images/logo.png" alt="" width="180" height="100"/></td>
              <td align="right"><h1>
                <?= $this->session->userdata('nama_perusahaan'.$id)?></h1></td>
            </tr>
            <tr>
              <td align="right"><?= $this->session->userdata('alamat_perusahaan'.$id)?></td>
            </tr>
            <tr>
              <td align="right"><?= $this->session->userdata('telepon_perusahaan'.$id)?>
                - <?= $this->session->userdata('email_perusahaan'.$id)?></td>
            </tr>
            <tr>
              <td align="right"><hr style="height:0px;border:1px solid black;"/></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
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
              <td colspan="7" align="center"></td>
            </tr>
            <tr>
              <td colspan="7" align="center"><h3>FAKTUR PENJUALAN</h3></td>
            </tr>
            <tr>
              <td colspan="7" align="center"><h4>&nbsp;</h4></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td style="font-weight:bold">Customer</td>
              <td>:</td>
              <td rowspan="2" valign="top" style="font-weight:bold"><?php echo $row->id_customer.$row->nama ?></td>
              <td>No. Faktur</td>
              <td>:</td>
              <td><?php echo $row->no_bukti; ?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>Date</td>
              <td>:</td>
              <td><?php //echo date('d/m/Y',strtotime($row->tgl_trans));
			  echo format_tanggal($row->tgl_trans);
			   ?></td>
            </tr>
            <tr>
              <td width="0%">&nbsp;</td>
              <td width="11%">Address</td>
              <td width="1%">:</td>
              <td width="44%"><?php echo $row->alamat; ?></td>
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
              <th style="width:3%; text-align:center;">Service</th>
              <th style="width:35%; text-align:center;">Description</th>
              <th style="width:5%; text-align:center;">Quantity</th>
              <th style="width:5%; text-align:center;">Unit Price</th>
              <th style="width:5%; text-align:center;">Ammount</th>
            </tr>
          </thead>
          <tbody style="height: 100px; overflow: auto;">
            <?php
                        $count = 0;
						$totalqty = 0;
						$totalamount=0;
                         if(isset($detail_spb))
                            {
                              foreach ($detail_spb as $row)
                                 {
								 $count++;
								 $totalqty=$totalqty+$row->qty;
								 $totalamount=$totalamount+$row->ammount;
								  ?>
            <tr class="records">
              <td align="center">&nbsp;</td>
              <td>&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
            </tr>
            <tr class="records">
              <td align="center"><?php echo $count; ?></td>
              <td><?php echo $row->nama_barang; ?></td>
              <td align="center"><?php echo $row->qty; ?></td>
              <td align="right"><?php echo number_format($row->hj,0); ?></td>
              <td align="right"><?php echo number_format($row->ammount,0); ?></td>
            </tr>
            <?php if ($row->ket1==""){


										  }
										  else
										  {
											  ?>
                                             <tr class="records">
              <td align="center">&nbsp;</td>
              <td><?php echo $row->ket1; ?></td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
            </tr>
                                              <?php
											  }
											  if ($row->ket2==""){
											  }
											  else
											  {
												  ?>
                                                  <tr class="records">
              <td align="center">&nbsp;</td>
              <td><?php echo $row->ket2; ?></td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
            </tr>
                                                  <?php
												  }
											  ?>



            <tr class="records">
              <td colspan="5" align="center"></td>
            </tr>
            <?php }
                              }
                            ?>
          </tbody>
          <?php

 	            if(isset($data_spb)){
 	            foreach($data_spb as $row){
 	            ?>
          <tr style="font-weight:bold">
            <td colspan="5" align="center" style="background:#FFFFFF"><hr style="height:0px;border:0.5px solid black;"/></td>
          </tr>
          <tr style="font-weight:bold">
            <td colspan="2" align="left" style="background:#FFFFFF">Terbilang :
              <?php  echo number_to_words($totalamount); ?></td>
            <td align="center">&nbsp;</td>
            <td align="right"><h3>Sub Total :</h3></td>
            <td align="right"><h3>
              <?php //echo number_format($totalamount); ?>
              <?php echo number_format($row->subtotal); ?></h3></td>
          </tr>
          <tr style="font-weight:bold">
            <td align="center" style="background:#FFFFFF">&nbsp;</td>
            <td align="right" style="background:#FFFFFF"></td>
            <td rowspan="6" align="center" style="background:#FFFFFF">&nbsp;</td>
            <td align="right">Diskon : </td>
            <td align="right"><?php echo number_format($row->diskon); ?></td>
          </tr>
          <tr style="font-weight:bold">
            <td align="center" style="background:#FFFFFF">&nbsp;</td>
            <td align="right" style="background:#FFFFFF"></td>
            <td align="right">Dpp :</td>
            <td align="right"><?php echo number_format($row->dpp); ?></td>
          </tr>
          <tr style="font-weight:bold">
            <td align="center" style="background:#FFFFFF">&nbsp;</td>
            <td align="right" style="background:#FFFFFF"></td>
            <td align="right">PPn :</td>
            <td align="right"><?php echo number_format($row->ppn); ?></td>
          </tr>
          <tr style="font-weight:bold">
            <td align="center" style="background:#FFFFFF">&nbsp;</td>
            <td align="right" style="background:#FFFFFF"></td>
            <td align="right"><h3>Total :</h3></td>
            <td align="right"><h3><?php echo number_format($row->total); ?></h3></td>
          </tr>
          <tr style="font-weight:bold">
            <td align="center" style="background:#FFFFFF">&nbsp;</td>
            <td align="right" style="background:#FFFFFF"></td>
            <td align="right">&nbsp;</td>
            <td align="right">&nbsp;</td>
          </tr>
          <tr style="font-weight:bold">
            <td align="center" style="background:#FFFFFF">&nbsp;</td>
            <td align="right" style="background:#FFFFFF"></td>
            <td align="right">&nbsp; </td>
            <td align="right">&nbsp; </td>
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

</body>
</html>
