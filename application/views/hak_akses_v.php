 <?php include 'includefile/head.php'; ?>

        <!-- page content -->

        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              <?php echo $title ?>
              <small>Data Table</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="<?php echo site_url('Utama') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="#"><?php echo $xmenu ?></a></li>
              <li class="active"><?php echo $xsubmenu ?></li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content">
            <div class="row">
              <div class="col-xs-12">


                <div class="box">

                 <?php include 'includefile/Pesan.php'; ?>
                 <div class="box-header">

                      <a href="<?php echo site_url('mspegawai/tambahbaru'); ?>" class="btn btn-block btn-primary btn-flat"><i class="fa fa-plus-square-o"></i> Input Baru</a>
                    <!-- <a href="<?php //echo site_url('mspegawai/exportexcel'); ?>" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export To Excel</a> -->

                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped nowrap"  cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>OPSI</th>
                          <th>ID</th>
                          <th>NIK</th>
                          <th>NAMA</th>
                          <th>LEVEL</th>
                          <th>JABATAN</th>
                          <th>SUBUNIT</th>
                          <th>UNIT</th>

                        </tr>
                      </thead>
                      <tbody>
                       <!--
                      <a class="btn btn-mini" href="<?php //echo site_url('master/hapus_barang/'.$row->kd_barang);?>"
               onclick="return confirm('Anda yakin?')"> <i class="icon-remove"></i> Hapus</a> -->
          </td>
          <?php
          $no=0;
          if(isset($data_user))
             {
               foreach ($data_user as $dt)
                  {
                    echo '
                    <tr>
                    <td>';
                      if($hak_c == 1 AND $hak_r == 1 AND $hak_u == 1 AND $hak_d == 1 AND $hak_p == 1)
                      { echo '<a href="'.site_url('hakakses/edit/'.$dt->id_user).'" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i> Edit Hak Akses </a>'; }
                    echo '</td>
                      <td>'.$dt->id_user.'</td>
                      <td>'.$dt->id_pegawai.'</td>
                      <td>'.$dt->nama_pegawai.'</td>
                      <td>'.$dt->nama_jenis.'</td>
                      <td>'.$dt->nama_jabatan.'</td>
                      <td>'.$dt->nama_sub_unit.'</td>
                      <td>'.$dt->nama_unit.'</td>


                    </tr>
                          ';
                  }
            }
            ?>




                      </tbody>
                      <tfoot>
                      <tr>
                        <th>OPSI</th>
                        <th>ID</th>
                        <th>NIK</th>
                        <th>NAMA</th>
                        <th>LEVEL</th>
                        <th>JABATAN</th>
                        <th>SUBUNIT</th>
                        <th>UNIT</th>

                      </tr>
                      </tfoot>
                    </table>


                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

          </section>
          <!-- /.content -->
        </div>



        <!-- /page content -->

<?php include 'includefile/foot.php'; ?>
