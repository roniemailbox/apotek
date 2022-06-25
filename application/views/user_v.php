<?php include 'includefile/head.php'; ?>
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


              <?php if($hak_c == 1) { ?>

                <button type="buttons" class="btn btn-block btn-primary btn-flat" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-plus-square-o"></i> Tambah User System</button>


    <!-- MODAL TAMBAH -->
              <div class="modal fade bs-example-modal-lg" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">

                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                      </button>
                      <h4 class="modal-title" id="myModalLabel">User Login System</h4>
                    </div>
                    <div class="modal-body">

                    <form class="form-horizontal form-label-left" novalidate method="post" action="<?=site_url('User/daftar')?>">

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">ID
                        </label>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-2 col-xs-12" value="<?php //echo $row->id_user; ?>" name="id_user" placeholder="" type="text" readonly>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" name="email" placeholder="" required="required" type="email">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Password
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" name="password" placeholder="" required="required" type="password">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pegawai</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="selecta form-control" name="id_pegawai" required>
                            <option value="">-- Pilih --</option>
                            <?php foreach ($data_pegawai as $dt_pegawai)
                            {
                              echo '<option value="'.$dt_pegawai->id_pegawai.'">'.$dt_pegawai->nama.'</option>';
                            }?>
                          </select>
                          </div>
                      </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-arrow-circle-o-left"></i> Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i>
    Simpan</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

    <!-- EDIT -->
              <?php
              if (isset($data_user)){
                   foreach($data_user as $row){
                      ?>
                      <div id="modalEdit<?php echo $row->id_user; ?>" class="modal fade edit-example-modal-lg" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">

                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                              <h4 class="modal-title" id="myModalLabel">Edit Data User</h4>
                          </div>

                          <form class="form-horizontal" method="post" action="<?php echo site_url('user/edit')?>">

                              <div class="modal-body">
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">ID
                                  </label>
                                  <div class="col-md-2 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-2 col-xs-12" value="<?php echo $row->id_user; ?>" name="id_user" placeholder="" required="required" type="text" readonly>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" value="<?php echo $row->email; ?>" name="email" placeholder="" required="required" type="email">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Password
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" value="<?php echo $row->password; ?>" name="password" placeholder="" required="required" type="password">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Detail Pegawai</label>
                                  <div class="col-md-4 col-xs-12">
                                    <select class="select2 col-sm-12 form-control" name="id_pegawai">
                                      <option value="<?php echo $row->id_pegawai ?>"><?php echo $row->nama_pegawai ?></option>
                                      <?php foreach ($data_pegawai as $dt_pegawai)
                                      {
                                        echo '<option value="'.$dt_pegawai->id_pegawai.'">'.$dt_pegawai->nama.'</option>';
                                      }?>
                                    </select>
                                  </div>
                                </div>



                               </div>

                               <div class="modal-footer">
                                    <button type="button" class="btn" data-dismiss="modal" aria-hidden="true"><i class="fa fa-arrow-circle-o-left"></i> Batal</button>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update</button>
                               </div>

                          </form>
                          </div>
                        </div>
                      </div>


                  <?php }
              }
              ?>

              <?php } ?>

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
                  <th>DIVISI</th>
                  <th>DEPARTEMENT</th>

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
if(isset($data_user))
   {
     foreach ($data_user as $row)
        { ?>

          <tr>
            <td>
              <?php
              if($hak_u == 1)
              {
                ?>
                <a href="#modalEdit<?=$row->id_user; ?>" data-toggle="modal" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a>

              <?php
              }
              if($hak_d == 1)
              {
                ?>
                <a href="<?php echo site_url('user/hapus/'.$row->id_user);?>" class="btn btn-danger btn-xs"
                onclick="return confirm('Anda yakin menghapus data ini....????')"> <i class="fa fa-trash"></i> Hapus</a>
              <?php
              }
              ?>
            </td>
          <td><?php echo $row->id_user; ?></td>
          <td><?php echo $row->id_pegawai; ?></td>
          <td><?php echo $row->nama_pegawai; ?></td>
          <td><?php echo $row->nama_jenis; ?></td>
          <td><?php echo $row->nama_jabatan; ?></td>
          <td><?php echo $row->nama_sub_unit; ?></td>
          <td><?php echo $row->nama_unit; ?></td>



          </tr>

  <?php }
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
                <th>DIVISI</th>
                <th>DEPARTEMENT</th>

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






      <!-- /.col -->
    </div>

  </section>
  <!-- /.content -->
</div>

<?php include 'includefile/foot.php'; ?>
