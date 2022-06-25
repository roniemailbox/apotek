 <?php
 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=$title.xls");
 header("Pragma: no-cache");
 header("Expires: 0");
 ?>
 <table border="1" width="100%">
       <thead>
          <tr>
            <th>RM</th>
            <th>NAMA PASIEN</th>
            <th>JK</th>
            <th>JENIS</th>

            <th>TGL LAHIR</th>
            <th>NO BPJS</th>
            <th>KOTA LAHIR</th>

          </tr>
       </thead>
       <tbody>
            <?php foreach ($data_pasien as $row)
                        {
                          ?>

                          <tr>
                            <td><?php echo $row->no_register; ?></td>
                            <td><?php echo $row->nama; ?></td>
                            <td><?php  echo $row->jk; ?></td>
                            <td><?php echo $row->nama_jenis_pasien; ?></td>
                            <td><?php  echo $row->tgllahir; ?></td>
                            <td><?php echo  $row->kotalahir; ?></td>
                          </tr>
                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
      </tbody>
 </table>
