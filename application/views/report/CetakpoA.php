

<?php $id = get_cookie('eKlinik'); ?>
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

<?php

 	            if(isset($data_po)){
 	            foreach($data_po as $row){
 	            ?>
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
        <table width="25%" border="0" cellspacing="0" cellpadding="0">
          <tbody>
            <tr>
              <td><img src="<?php echo base_url(); ?>build/images/logo.png" width="85" height="95" alt=""/></td>
            </tr>
          </tbody>
        </table>
        <table width="100%" border="0" cellspacing="1" cellpadding="1">
          <tbody>
            <tr>
              <td colspan="3" style="font-size:26px; font-weight:bold" valign="top">
                <?= $this->session->userdata('nama_perusahaan'.$id)?>
               </td>
              <td colspan="4" align="right" style="font-size:36px; font-weight:bold; color:#405BA3">PURCHASE ORDER</td>
            </tr>
            <tr>
              <td colspan="3" align="left" valign="top">
                <?= $this->session->userdata('alamat_perusahaan'.$id)?>
             </td>
              <td width="27%" align="right" style="font-size:12px; font-weight:bold">&nbsp;</td>
              <td width="4%" align="left" style="font-size:12px; font-weight:bold">Date</td>
              <td width="1%" align="left" style="font-size:12px; font-weight:bold">:</td>
              <td width="19%" align="left" style="font-size:12px; font-weight:bold"><?php echo date('d/m/Y',strtotime($row->tgl_trans)); ?></td>
            </tr>
            <tr>
              <td width="2%" align="left" style="font-size:10px; font-weight:bold">Phone</td>
              <td width="1%" align="left" style="font-size:10px; font-weight:bold">:</td>
              <td width="46%" align="left" style="font-size:10px; font-weight:bold">
                <?= $this->session->userdata('telepon_perusahaan'.$id)?>
                Fax : <?= $this->session->userdata('fax_perusahaan'.$id)?></td>
              <td align="right" style="font-size:12px; font-weight:bold">&nbsp;</td>
              <td align="left" style="font-size:12px; font-weight:bold">PO</td>
              <td align="left" style="font-size:12px; font-weight:bold">:</td>
              <td align="left" style="font-size:12px; font-weight:bold"><?php  echo $row->no_bukti; ?></td>
            </tr>
            <tr>
              <td colspan="3">&nbsp;</td>
              <td colspan="4" align="right" valign="top"> </td>
            </tr>
          </tbody>
      </table>
        <br>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tbody>
            <tr>
              <td width="41%" rowspan="5" align="left" valign="top">

              <table width="141%" border="0" cellspacing="0" cellpadding="0">
                <tbody>
                  <tr>
                    <td width="10%" height="25" style="background: #337ab7; color:white;">&nbsp;</td>
                    <td colspan="3" style="background: #337ab7; color:white; font-size:16px; font-weight:bold"> VENDOR </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                     <td colspan="3" style="font-size:16px; font-weight:bold">
                      <?php  echo $row->nama_supplier; ?>
                     </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="3" rowspan="2" align="left" valign="top" style="font-size:10px; font-weight:bold">
                      <?php  echo $row->alamat; ?>
                     </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td style="font-size:10px; font-weight:bold">Phone</td>
                    <td style="font-size:10px; font-weight:bold">:</td>
                    <td style="font-size:10px; font-weight:bold"><?php  echo $row->telepon; ?></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td width="12%" style="font-size:10px; font-weight:bold">Hp</td>
                    <td width="3%" style="font-size:10px; font-weight:bold">:</td>
                    <td width="75%" style="font-size:10px; font-weight:bold">
                      <?php  echo $row->hp; ?>
                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td style="font-size:10px; font-weight:bold">Fax</td>
                    <td style="font-size:10px; font-weight:bold">:</td>
                    <td style="font-size:10px; font-weight:bold">  <?php  echo $row->fax; ?>
                     </td>
                  </tr>
                  </tbody>
              </table>
              <?php }
												}
												?>              </td>
              <td width="2%" height="25">&nbsp;</td>
              <td width="35%" rowspan="5" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tbody>
                  <tr>
                    <td width="5%" height="25" style="background: #337ab7; color:white;">&nbsp;</td>
                    <td colspan="3" style="background: #337ab7; color:white; font-size:16px; font-weight:bold"> INVOICE SHIP TO </td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="3" style="font-size:16px; font-weight:bold">
                      <?= $this->session->userdata('nama_perusahaan'.$id)?> </td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="3" rowspan="2" align="left" valign="top" style="font-size:10px; font-weight:bold"><?= $this->session->userdata('alamat_perusahaan'.$id)?></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    </tr>
                  <tr >
                    <td>&nbsp;</td>
                    <td width="12%" style="font-size:10px; font-weight:bold">Phone  </td>
                    <td width="3%" style="font-size:10px; font-weight:bold">:</td>
                    <td width="80%" style="font-size:10px; font-weight:bold"><?= $this->session->userdata('telepon_perusahaan'.$id)?></td>
                    </tr>
                  <tr style="font-size:10px; font-weight:bold">
                    <td>&nbsp;</td>
                    <td style="font-size:10px; font-weight:bold">Npwp</td>
                    <td style="font-size:10px; font-weight:bold">:</td>
                    <td style="font-size:10px; font-weight:bold"><?= $this->session->userdata('npwp_perusahaan'.$id)?></td>
                    </tr>
                  </tbody>
              </table></td>
              </tr>
            <tr>
              <td>&nbsp;</td>
              </tr>
            <tr>
              <td>&nbsp;</td>
              </tr>
            <tr>
              <td>&nbsp;</td>
              </tr>
            <tr>
              <td>&nbsp;</td>
              </tr>
          </tbody>
      </table>
        <br>
<!--<table width="100%" border="2" cellspacing="2" cellpadding="2" >-->
         <table border="0"  width="100%" style="background:#FFFFFF; border-collapse:separate; border-spacing:1px;">
          <thead>
            <tr height="20px" style="background: #337ab7;" >
              <th width="4%" style="width:2%; text-align:center; color:#FFFFFF">No</th>
              <th colspan="2" style="width:10%; text-align:center; color:#FFFFFF">Catalog</th>
              <th width="45%" style="width:35%; text-align:center;color:#FFFFFF">Description</th>
              <th width="6%" style="width:3%; text-align:center;color:#FFFFFF">Quantity</th>
              <th colspan="2" style="width:9%; text-align:center;color:#FFFFFF">Unit Price</th>
              <th width="11%" style="width:9%; text-align:center;color:#FFFFFF">Total</th>
            </tr>
          </thead>
          <tbody style="height: 100px; overflow: auto;">
            <?php
                        $count = 0;
						$totalqty = 0;
						$totalamount=0;
                         if(isset($detail_po))
                            {
                              foreach ($detail_po as $row)
                                 {
								 $count++;
								 //$totalqty=$totalqty+$row->qty;
								 //$totalamount=$totalamount+$row->ammount;
								  ?>

            <tr class="records">
              <td align="center"><?php echo $count; ?></td>
              <td colspan="2" align="center"><?php echo $row->part_number; ?></td>
              <td>&nbsp;&nbsp;<?php echo $row->nama_barang; ?></td>
              <td align="center"><?php echo $row->qty; ?></td>
              <td colspan="2" align="right"><?php echo number_format($row->hb,0); ?>&nbsp;&nbsp;</td>
              <td align="right"><?php echo number_format($row->ammount,0); ?>&nbsp;&nbsp;</td>
            </tr>






            <?php }
                              }
                            ?>
          </tbody>
          <?php

 	            if(isset($data_po)){
 	            foreach($data_po as $row){
 	            ?>
          <tr style="font-weight:bold">
            <td colspan="8" align="center" style="background:#FFFFFF"><hr style="height:0px;border:0.5px solid black;"/></td>
          </tr>
          <tr style="font-weight:bold">
            <td colspan="4" align="left" style="background:#FFFFFF">Terbilang :
              <?php  echo number_to_words($totalamount); ?></td>
            <td align="right"><h3>&nbsp;</h3></td>
            <td width="12%" align="left">Sub Total</td>
            <td width="6%" align="left">:</td>
            <td align="right"><h3>
              <?php //echo number_format($totalamount); ?>
              <?php echo number_format($row->subtotal); ?>&nbsp;</h3></td>
          </tr>
          <tr style="font-weight:bold">
            <td colspan="4" align="left" style="background:#C1C1C1">Term and Conditions</td>

            <td align="right">&nbsp;</td>
            <td align="left">Diskon</td>
            <td align="left">:</td>
            <td align="right"><?php echo number_format($row->diskon); ?>&nbsp;</td>
          </tr>
          <tr style="font-weight:bold">
            <td colspan="4" rowspan="4" valign="top" align="left" style="background:#FFFFFF"><table width="100%" border="1" cellspacing="1" cellpadding="1">
              <tbody>
                <tr>
                  <td><?php  echo ($row->keterangan); ?></td>
                </tr>
              </tbody>
            </table></td>
            <td align="right">&nbsp;</td>
            <td align="left">Dpp</td>
            <td align="left">:</td>
            <td  align="right"><?php echo number_format($row->dpp); ?>&nbsp;</td>
          </tr>
          <tr style="font-weight:bold">
            <td align="right">&nbsp;</td>
            <td align="left">PPN (10%)</td>
            <td align="left">:</td>
            <td align="right"><?php echo number_format($row->ppn); ?>&nbsp;</td>
          </tr>
          <tr style="font-weight:bold">
            <td align="right" valign="top"><h3>&nbsp;</h3></td>
            <td align="left" valign="top"><h3>Total</h3></td>
            <td align="left" valign="top"><h3>:</h3></td>
            <td align="right" valign="top"><h3><?php echo number_format($row->total); ?>&nbsp;</h3></td>
          </tr>
          <tr style="font-weight:bold">
            <td align="right">&nbsp;</td>
            <td colspan="2" align="right">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr style="font-weight:bold">
            <td align="center" style="background:#FFFFFF">&nbsp;</td>
            <td width="13%" align="center" style="background:#FFFFFF">&nbsp;</td>
            <td width="3%" align="center" style="background:#FFFFFF">&nbsp;</td>
            <td align="right" style="background:#FFFFFF"></td>
            <td align="right">&nbsp; </td>
            <td colspan="2" align="right">&nbsp; </td>
            <td>&nbsp;</td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tbody>
            <tr>
              <td width="2%" align="center">&nbsp;</td>
              <td width="26%" align="center">&nbsp;</td>
              <td width="7%" align="center">&nbsp;</td>
              <td width="29%" align="center">&nbsp;</td>
              <td width="6%" align="center">&nbsp;</td>
              <td width="27%" align="center">&nbsp;</td>
              <td width="3%" align="center">&nbsp;</td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td rowspan="4" align="center"><img src="<?php echo base_url(); ?>build/images/wahyuH.png" width="85" height="95" alt=""/></td>
              <td align="center">&nbsp;</td>
              <td rowspan="4" align="center"><img src="<?php echo base_url(); ?>build/images/ArifLuqman.png" width="85" height="95" alt=""/></td>
              <td align="center">&nbsp;</td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td align="center"><strong>_________________</strong></td>
              <td align="center">&nbsp;</td>
              <td align="center"><strong><u>Wahyu Hidayat</u></strong></td>
              <td align="center">&nbsp;</td>
              <td align="center"><strong><u>Arif Luqman</u></strong></td>
              <td align="center">&nbsp;</td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td align="center"><strong>Vendor</strong></td>
              <td align="center">&nbsp;</td>
              <td align="center"><strong>Purchaser</strong></td>
              <td align="center">&nbsp;</td>
              <td align="center"><strong>Authorize By</strong></td>
              <td align="center">&nbsp;</td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td colspan="5" align="center">If you have any questions about this purchaser order, please contact</td>
              <td align="center">&nbsp;</td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td colspan="5" align="center">[Aris Rahman, 081216149080, aris.rahman@envilab-id.com]</td>
              <td align="center">&nbsp;</td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
            </tr>
          </tbody>
        </table>
        <br>
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
