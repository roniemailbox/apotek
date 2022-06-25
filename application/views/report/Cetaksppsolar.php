<?php $id = get_cookie('tkkop'); ?>
<!doctype html>
<html lang="en">
<head>
	<title><?= $this->session->userdata('nama_perusahaan'.$id)?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>build/images/logo2.png" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstraps.css')?>"/>
	<link href="<?php echo base_url('build/css/style_view.css') ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('build/css/paper.css') ?>" rel="stylesheet" type="text/css" />
	<style>@page {size: A4 potrait}</style>
</head>


<body>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td width="5%">&nbsp;</td>
      <td width="93%">&nbsp;</td>
      <td width="2%">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>
      <div class="container">




	    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.printPage.js')?>"></script>
	    <script type="text/javascript">
	        $(document).ready(function(){
	            $(".btnPrint").printPage();
	        })
	    </script>

	    <table width="100%" border="1" cellspacing="0" cellpadding="0">
	      <tbody>
	        <tr>
	          <td><table width="50%" border="0" cellspacing="1" cellpadding="1">
	            <tbody>
	              <tr>
                  <td width="3%" rowspan="2" align="center" style="font-size:xx-large">&nbsp;</td>
	                <td width="6%" rowspan="3"><img src="<?php echo base_url(); ?>build/images/logo.png" width="49" height="56" alt=""/></td>
	                <td height="32" align="left" style="font-size:x-large"><?= $this->session->userdata('nama_perusahaan'.$id)?></td>
	                <td width="59%" rowspan="2" align="center" style="font-size:xx-large">SURAT PERMINTAAN SOLAR</td>

	                </tr>
	              <tr>
	                <td width="32%" align="center">&nbsp;</td>
	                </tr>
	              </tbody>
	            </table></td>
	          </tr>
              <?php
 	            $no=1;
 	            if(isset($data_po)){
 	            foreach($data_po as $row){
 	            ?>
	        <tr>
	          <td></td>
	          </tr>
	        <tr>
	          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
	            <tbody>
	              <tr>
	                <td>&nbsp;</td>
	                <td>&nbsp;</td>
	                <td>&nbsp;</td>
	                <td>&nbsp;</td>
	                <td>&nbsp;</td>
	                </tr>
	              <tr>
	                <td width="1%"><br>
	                  <br></td>
	                <td width="32%"><table width="100%" border="1" cellspacing="0" cellpadding="0">
	                  <tbody>
	                    <tr>
	                      <td width="30%">&nbsp;TANGGAL ORDER</td>
	                      <td width="70%">:
	                        <?php
									echo date('d/m/Y',strtotime($row->tgl_po));
									 //echo $row->tgl_trans; ?></td>
	                      </tr>
	                    <tr>
	                      <td>&nbsp;NO PERMINTAAN</td>
	                      <td>: <?php echo $row->no_spp; ?></td>
	                      </tr>
	                    </tbody>
	                  </table></td>
	                <td width="39%">&nbsp;</td>
	                <td width="27%"><table width="100%" border="1" cellspacing="0" cellpadding="0">
	                  <tbody>
	                    <tr>
	                      <td width="25%">&nbsp;NO PO</td>
	                      <td width="75%">&nbsp;: <?php echo $row->no_po; ?></td>
	                      </tr>
	                    </tbody>
	                  </table></td>
	                <td width="1%">&nbsp;</td>
	                </tr>
	              <tr>
	                <td>&nbsp;</td>
	                <td>&nbsp;</td>
	                <td>&nbsp;</td>
	                <td>&nbsp;</td>
	                <td>&nbsp;</td>
	                </tr>
	              <tr>
	                <td>&nbsp;</td>
	                <td><table width="100%" border="1" cellspacing="0" cellpadding="0">
	                  <tbody>
	                    <tr>
	                      <td width="30%">&nbsp;KEPADA YTH</td>
	                      <td width="70%">&nbsp;:
	                        <?php echo $row->nama_supplier; ?></td>
	                      </tr>
	                    <tr>
	                      <td>&nbsp;ATT</td>
	                      <td>&nbsp;: <?php echo $row->kontak_person
						  ; ?></td>
	                      </tr>
	                    <tr>
	                      <td>&nbsp;CC</td>
	                      <td>&nbsp;:</td>
	                      </tr>
	                    <tr>
	                      <td>&nbsp;</td>
	                      <td>&nbsp;</td>
	                      </tr>
	                    </tbody>
	                  </table></td>
	                <td>&nbsp;</td>
	                <td>&nbsp;</td>
	                <td>&nbsp;</td>
	                </tr>
	              </tbody>
	            </table>
	            <p>&nbsp;</p>
	            <table width="100%" border="0" cellspacing="0" cellpadding="0">
	              <tbody>
	                <tr>
	                  <td>&nbsp;</td>
	                  <td><table width="100%" border="1" cellspacing="0" cellpadding="0">
	                    <thead>
	                      <tr class="headings">
	                        <th width="6%" class="column-title">ITEM</th>
	                        <th width="26%" class="column-title">PART NO</th>
	                        <th width="14%" class="column-title">URAIAN</th>
	                        <th width="9%" class="column-title">QTY</th>
	                        <th width="7%" class="column-title">SATUAN</th>
	                        <th width="12%" class="column-title">UNIT TYPE</th>
	                        <th width="10%" class="column-title">HARGA SATUAN</th>
	                        <th width="16%" class="column-title">TOTAL</th>
	                        </tr>
	                      </thead>
	                    <tbody>

	                      <tr class="even pointer">
	                        <td align="center" valign="middle" height="110">
	                          <?php echo $no;?>
                               </td>
	                        <td align="center" valign="middle" class=" "><?php echo $row->serial_number;?><br><?php echo $row->nama_driver;?>
                            </td>
	                        <td align="center" valign="middle" class=" "><?php echo $row->nama;?></td>
	                        <td align="center" valign="middle" class=" "><?php echo number_format($row->qty);?></td>
	                        <td align="center" valign="middle" class=" ">Liter</td>
	                        <td align="center" valign="middle" class=" ">&nbsp;</td>
	                        <td align="center" valign="middle" class=" "><?php echo number_format($row->harga);?></td>
	                        <td align="right" valign="middle" class=" "><?php echo number_format($row->qty*$row->harga);?>&nbsp;</td>
	                        </tr>
                            <tr class="even pointer">
                              <td colspan="5" align="left" valign="top">&nbsp;Keterangan :</td>
                              <td colspan="2" valign="top" class=" ">&nbsp;SUB TOTAL</td>
                              <td align="right" valign="top" class=" "><?php echo number_format($row->qty*$row->harga);?>&nbsp;</td>
                              </tr>
                            <tr class="even pointer">
                              <td colspan="5" rowspan="5" align="left" valign="top">&nbsp;<span class=" "><?php echo $row->keterangan;?></span></td>
                              <td colspan="2" valign="top" class=" ">&nbsp;DISKON</td>
                              <td align="right" valign="top" class=" "><?php echo number_format($row->qty*$row->harga);?>&nbsp;</td>
                              </tr>
                            <tr class="even pointer">
                              <td colspan="2" valign="top" class=" ">&nbsp;TAX</td>
                              <td align="right" valign="top" class=" "><?php echo number_format($row->qty*$row->harga);?>&nbsp;</td>
                              </tr>
                            <tr class="even pointer">
                              <td colspan="2" valign="top" class=" ">&nbsp;TOTAL PRICE</td>
                              <td align="right" valign="top" class=" "><?php echo number_format($row->qty*$row->harga);?>&nbsp;</td>
                              </tr>
                            <tr class="even pointer">
                              <td colspan="2" valign="top" class=" ">&nbsp;TOTAL PEMBAYARAN (Rp)</td>
                              <td align="right" valign="top" class=" "><?php echo number_format($row->qty*$row->harga);?>&nbsp;</td>
                              </tr>
                            <tr class="even pointer">
	                        <td colspan="3" valign="top" class=" ">&nbsp;</td>
	                        </tr>
	                      </tbody>
	                    </table></td>
	                  <td>&nbsp;</td>
	                  </tr>
	                <tr>
	                  <td>&nbsp;</td>
	                  <td>&nbsp;</td>
	                  <td>&nbsp;</td>
	                  </tr>
	                </tbody>
                </table></td>
	          </tr>
	        <tr>
	          <td>&nbsp;Jankga waktu pembayaran : 30 Hari</td>
	          </tr>
	        <tr>
	          <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
	            <tbody>
	              <tr>
	                <td>&nbsp;</td>
	                <td><table width="100%" border="0" cellspacing="1" cellpadding="1">
	                  <tbody>
	                    <tr>
	                      <td align="center">Dibuat dan diperiksa oleh:</td>
	                      <td align="center">Diapprove oleh:</td>
	                      <td align="center">Disetujui oleh:</td>
	                      </tr>
	                    <tr>
	                      <td width="24%" align="center"><img src="<?php echo base_url(); ?>build/images/<?php echo $row->foto; ?>" width="100" height="100" alt=""/></td>
	                      <td width="20%" align="center"><img src="<?php echo base_url(); ?>build/images/<?php echo $row->fotop1; ?>" width="100" height="100" alt=""/></td>
	                      <td width="20%" align="center"><img src="<?php echo base_url(); ?>build/images/<?php echo $row->fotop2; ?>" width="100" height="100" alt=""/></td>
	                      </tr>
	                    <tr>
	                      <td align="center">(<?php echo $row->nama_pegawai; ?>)</td>
	                      <td align="center">(<?php echo $row->nama_ap1; ?>)</td>
	                      <td align="center">(<?php echo $row->nama_ap2; ?>)</td>
	                      </tr>
	                    </tbody>
	                  </table></td>
	                <td>&nbsp;</td>
	                </tr>
	              </tbody>
	            </table></td>
	          </tr>
	        <tr>
	          <td><?php }
						}
						?></td>
	          </tr>
	        </tbody>
	      </table>
      </div>
      </td>
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
