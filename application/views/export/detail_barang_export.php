 <?php
 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=$title.xls");
 header("Pragma: no-cache");
 header("Expires: 0");
 ?>
 <table border="1" width="100%">
       <thead>
          <tr>
            <th>Unit</th>
            <th>Kode Barang</th>
            <th>Nama Produk</th>
            <th>Barcode</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>% Margin</th>
            <th>Margin</th>
            <th>Supplier</th>
            <th>Min</th>
            <th>Max</th>
            <th>Lokasi</th>
            <th>Rak</th>
            <th>Kategori</th>
            <th>Satuan</th>
            <th>Ppn</th>
            <th>Jenis</th>
            <th>Merk</th>
            <th>Tipe</th>
            <th>Sub Unit</th>
            <th>Keterangan</th>


          </tr>
       </thead>
       <tbody>
            <?php foreach ($data_barang as $row)
                        {
                          ?>

                          <tr>
                            <td><?php echo $row->nama_unit; ?></td>
                          <td><?php echo $row->id_barang; ?></td>

                          <td><?php echo $row->nama_barang; ?></td>

                          <td><?php  echo $row->barcode; ?></td>

                          <td align="right"><?php echo number_format($row->hb,2); ?></td>
                          <td align="right"><?php  echo number_format($row->hj,2); ?></td>
                          <td align="right"><?php echo  number_format($row->perc_margin,2); ?></td>
                          <td align="right"><?php echo number_format($row->margin); ?></td>
                           <td><?php echo $row->nama_supplier; ?></td>
                           <td><?php echo $row->min; ?></td>
                           <td><?php echo $row->max; ?></td>
                           <td><?php echo $row->lokasi; ?></td>
                           <td><?php echo $row->rak; ?></td>

                          <td><?php echo $row->nama_kategori; ?></td>
                          <td><?php  echo $row->nama_satuan; ?></td>
                          <td><?php echo  $row->ppn; ?></td>
                           <td><?php echo $row->nama_jenis; ?></td>
                           <td><?php echo $row->merk; ?></td>
                           <td><?php echo $row->nama_tipe; ?></td>
                           <td><?php echo $row->nama_sub_unit; ?></td>
                           <td><?php echo $row->keterangan; ?></td>

                          </tr>
                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
      </tbody>
 </table>
