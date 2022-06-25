 <?php
 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=$title.xls");
 header("Pragma: no-cache");
 header("Expires: 0");
 ?>
 <table border="1" width="100%">
       <thead>
          <tr>
            <th>Kode Barang</th>
            <th>Nama Produk</th>
            <th>Barcode</th>
            <th>Kategori</th>
            <th>Satuan</th>
            <th>Ppn</th>
            <th>Jenis</th>
            <th>Merk</th>
            <th>Tipe</th>


          </tr>
       </thead>
       <tbody>
            <?php foreach ($data_barang as $row)
                        {
                          ?>

                          <tr>
                            <td><?php echo $row->id_barang; ?></td>
                            <td><?php echo $row->nama_barang; ?></td>
                            <td><?php  echo $row->barcode; ?></td>
                            <td><?php echo $row->nama_kategori; ?></td>
                            <td><?php  echo $row->nama_satuan; ?></td>
                            <td><?php echo  $row->ppn; ?></td>
                            <td><?php echo $row->nama_jenis; ?></td>
                            <td><?php echo $row->merk; ?></td>
                            <td><?php echo $row->nama_tipe; ?></td>
                          </tr>
                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
      </tbody>
 </table>
