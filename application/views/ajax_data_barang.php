
<div class="col-md-12 col-sm-6 col-xs-12">

  <div class="x_panel">

    <div class="x_content">

        <table class="table table-striped jambo_table bulk_action nowrap">
            <thead>
              <tr>

                <th>No Bukti</th>

                <th>Tanggal</th>

                <th>Kode Barang</th>
                <th>Nama</th>
                <th>Keterangan</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Total</th>

              </tr>
            </thead>
            <tbody>
             <!--
            <a class="btn btn-mini" href="<?php //echo site_url('master/hapus_barang/'.$row->kd_barang);?>"
     onclick="return confirm('Anda yakin?')"> <i class="icon-remove"></i> Hapus</a> -->
</td>
<?php
//ambil dari controler
$no=1;
if(isset($data_barang))
 {
   $qty=0;
   foreach ($data_barang as $row)
      {
        $qty=$qty+$row->qty;

        ?>

      <tr>

      <td><?php echo $row->no_bukti; ?></td>

      <td><?php echo date('d/m/Y',strtotime($row->tgl_trans)); //echo $row->tgl_trans; ?></td>
      <td><?php echo $row->kd_barang; ?></td>
      <td><?php echo $row->nama; ?></td>
      <td><?php echo $row->keterangan; ?></td>
      <?php
      $rqty=$row->qty;
      if($rqty<0){
      ?>
            <td align="right" class="red"><strong><?php echo number_format($row->qty); ?></strong></td>
      <?php
      }
      else {
      ?>
          <td align="right" class="green"><strong><?php echo number_format($row->qty); ?></strong></td>
      <?php
      }
      ?>

          <td align="right"><?php echo number_format($row->harga); ?></td>
      <td align="right"><?php echo number_format($row->total); ?></td>



      </tr>

<?php }
}
?>



<tr>

<td> </td>

<td> </td>
<td> </td>
<td>STOK AKHIR </td>
  <td align="right"><strong><?php echo number_format($qty); ?></strong></td>
    <td align="right"> </td>
<td align="right"> </td>



</tr>
            </tbody>
          </table>
</div>
</div>
</div>
