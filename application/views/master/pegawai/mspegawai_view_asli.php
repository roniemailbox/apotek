<?php include 'includefile/Header.php'; ?>


<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Daftar Pegawai </h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">

            <?php include 'includefile/Pesan.php'; ?>

            <?php if($hak_c == 1) { ?>

            <div class="form-group">

 			          <a href="<?php echo site_url('mspegawai/tambahbaru'); ?>" class="btn btn-primary"><i class="fa fa-plus-square-o"></i> Input Baru</a>
              <!-- <a href="<?php //echo site_url('mspegawai/exportexcel'); ?>" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export To Excel</a> -->
              <hr />
            </div>



              <!-- AWAL MODAL TAMBAH DATA -->
              <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">

                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                      </button>
                      <h2 class="modal-title" id="myModalLabel">Tambah Data Pegawai</h2>
                    </div>

                    <div class="modal-body">

                      <form class="form-horizontal form-label-left" method="post" action="<?=site_url('mspegawai/tambah')?>">
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Status Pegawai
                          </label>

                            <div class="col-md-4 col-xs-12">
                              <select class="form-control" name="id_status_pegawai" >
                                <option value="">--pilih--</option>
                                <?php foreach ($data_status_pegawai as $dt_status_pegawai)
                                {
                                  echo '<option value="'.$dt_status_pegawai->id_status_pegawai.'">'.$dt_status_pegawai->nama_status_pegawai.'</option>';
                                }
                                ?>
                              </select>
                            </div>

                        </div>

                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tipe
                          </label>

                            <div class="col-md-4 col-xs-12">
                              <select class="form-control" name="id_jenis" >
                                <option value="">--pilih--</option>
                                <?php foreach ($data_jenis as $dt_j)
                                {
                                  echo '<option value="'.$dt_j->id_jenis.'">'.$dt_j->nama.'</option>';
                                }
                                ?>
                              </select>
                            </div>

                        </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kode
                        </label>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-2 col-xs-12" value="AUTO" name="id_pegawai" placeholder="" required="required" type="text" readonly>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanggal Masuk
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-3 col-xs-12" name="tglmasuk" required="required" placeholder="Tanggal Diterima Kerja" type="date">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" name="nama" placeholder="Nama Lengkap" required="required" type="text">
                        </div>
                      </div>


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Jabatan
                        </label>

                          <div class="col-md-4 col-xs-12">
                            <select class="form-control" name="id_jabatan" required>
                              <?php foreach ($data_jabatan as $dt_jabatan)
                              {
                                echo '<option value="'.$dt_jabatan->id_jabatan.'">'.$dt_jabatan->nama.'</option>';
                              }
                              ?>
                            </select>
                          </div>

                      </div>
                      <script type="text/javascript">
                      $(function(){
                        $.ajaxSetup({
                          type:"POST",
                          url: "<?php echo base_url('index.php/Mspegawai/ambil_data') ?>",
                          cache: false,
                        });

                        $("#id_plant").change(function(){

                          var value=$(this).val();
                          if(value>0){

                            $.ajax({
                              data:{modul:'divisi',id:value},
                              success: function(respond){

                                $("#divisi").html(respond);
                              }
                            })
                          }
                        });

                        $("#divisi").change(function(){
                          var value=$(this).val();

                          if(value>0){

                            $.ajax({
                              data:{modul:'departement',id:value},
                              success: function(respond){
                                $("#departement").html(respond);
                              }
                            })
                          }
                        })

                      })
                      </script>


                      <div class='item form-group'>
                				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Plant</label>
                        <div class="col-md-4 col-xs-12">
                          <select id="id_plant" class="form-control" name="id_plant" required>
                            <option value="">--pilih--</option>
                            <?php foreach ($data_plant as $dt)
                            {
                              echo '<option value="'.$dt->id_plant.'">'.$dt->nama.'</option>';
                            }
                            ?>
                          </select>
                          </div>
                			</div>



                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Divisi</label>
                          <div class="col-md-4 col-xs-12">
                            <select class='form-control' id='divisi' name="id_divisi">
                              <option value='0'>--pilih--</option>
                            </select>
                            </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Departement</label>
                          <div class="col-md-4 col-xs-12">
                            <select class='form-control' id='departement' name="id_departement">
                              <option value='0'>--pilih--</option>
                            </select>
                          </div>
                      </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kota Lahir
                        </label>

                          <div class="col-md-4 col-xs-12">
                            <select class="form-control" name="id_kota_lahir" required>
                              <option value="">- Pilih Kota -</option>
                              <?php foreach ($data_kota as $dt_kota)
                              {
                                echo '<option value="'.$dt_kota->id.'">'.$dt_kota->name.'</option>';
                              }
                              ?>
                            </select>
                          </div>

                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanggal Lahir
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-3 col-xs-12" name="tgllahir" placeholder="Tanggal Lahir" type="date">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Alamat
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" name="alamat" placeholder="Alamat Sesuai KTP" type="text">
                        </div>
                      </div>




                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kota
                        </label>

                          <div class="col-md-4 col-xs-12">
                            <select class="form-control" name="id_kota">
                              <option value="">- Pilih Kota -</option>
                              <?php foreach ($data_kota as $dt_kota)
                              {
                                echo '<option value="'.$dt_kota->id.'">'.$dt_kota->name.'</option>';
                              }
                              ?>
                            </select>
                          </div>

                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">KTP
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" name="ktp" placeholder="KTP" type="text">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pendidikan
                        </label>

                          <div class="col-md-4 col-xs-12">
                            <select class="form-control" name="id_pendidikan">

                              <?php foreach ($data_pendidikan as $dt_pend)
                              {
                                echo '<option value="'.$dt_pend->id_pendidikan.'">'.$dt_pend->id_pendidikan.'</option>';
                              }
                              ?>
                            </select>
                          </div>

                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Telepon
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" name="telepon" placeholder="Telepon" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">E-mail
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" value="" name="email" placeholder="E-mail" type="email">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kelamin
                        </label>

                          <div class="col-md-4 col-xs-12">
                            <select class="form-control" name="jk">
                              <option value="">- Pilih -</option>
                              <option value="L">Laki-laki</option>
                              <option value="P">Perempuan</option>
                            </select>
                          </div>

                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Bank
                        </label>

                          <div class="col-md-4 col-xs-12">
                            <select class="form-control" name="id_bank" required>
                              <option value="">- Pilih Bank -</option>
                              <?php foreach ($data_bank as $dt_bank)
                              {
                                echo '<option value="'.$dt_bank->id_bank.'">'.$dt_bank->nama.'</option>';
                              }
                              ?>
                            </select>
                          </div>

                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">No Rekening
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" name="no_rekening" placeholder="No Rekening" type="text">
                        </div>
                      </div>



                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Aktif
                        </label>

                        <div class="col-md-4 col-xs-12">
                          <select class="form-control" name="id_status_aktif" required>
                            <option value="">--pilih--</option>
                            <?php foreach ($data_status_aktif as $dt_status_aktif)
                            {
                              echo '<option value="'.$dt_status_aktif->id_status_aktif.'">'.$dt_status_aktif->nama_status_aktif.'</option>';
                            }
                            ?>
                          </select>
                        </div>

                      </div>



                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanggal Keluar
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-3 col-xs-12" name="tglkeluar" placeholder="Tanggal Keluar Kerja" type="date">
                        </div>
                      </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal" aria-hidden="true"><i class="fa fa-arrow-circle-o-left"></i>Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i>  Simpan</button>
                    </div>

                    </form>

                  </div>
                </div>
              </div>


            <?php } ?>


            <?php if($hak_r == 1) { ?>
                  <table id="datatable-keytable" class="table table-striped table-bordered nowrap"  cellspacing="0" width="100%">
                    <thead>
                      <tr>
                         <th>OPSI</th>
                        <th>NIK</th>
                        <th>NAMA</th>
                        <th>SLOC</th>

                        <th>PLANT</th>
                        <th>DIVISI</th>
                        <th>DEPARTEMENT</th>
                        <th>KATEGORI</th>
                        <th>JABATAN</th>
                        <th>TANGGAL JOIN</th>
                        <th>MASA KERJA</th>
                        <th>BANK</th>
                        <th>NO REKENING</th>
                        <th>JENIS</th>
                        <th>KTP</th>
                        <th>TELEPON</th>
                        <th>STATUS</th>
                        <th>J/K</th>
                        <th>ALAMAT</th>
                        <th>AKTIF</th>


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
      if(isset($data_pegawai))
         {
           foreach ($data_pegawai as $row)
              { ?>

              <tr>
                <td>
                <?php
                if($hak_u == 1)
                {
                  ?>
                  <a href="<?php echo site_url('mspegawai/ambiledit/'.$row->id_pegawai);?>" class="btn btn-info btn-xs"
                  onclick="return confirm('Anda yakin edit data ini....????')"> <i class="fa fa-pencil"></i> Edit</a>

                <?php
                }
                if($hak_d == 1)
                {
                  ?>
                  <a href="<?php echo site_url('mspegawai/hapus/'.$row->id_pegawai);?>" class="btn btn-danger btn-xs"
                  onclick="return confirm('Anda yakin menghapus data ini....????')"> <i class="fa fa-trash"></i> Hapus</a>
                <?php
                }
                if($hak_p == 1)
                {
                  ?>
                  <a href="<?php echo site_url('mspegawai/showprofile/'.$row->id_pegawai); ?>" class="btn btn-success btn-xs"><i class="fa fa-user"></i> Profile</a>

                <?php
                }
                ?>
              </td>

                <td><?php echo $row->id_pegawai; ?></td>
                <td><?php echo $row->nama_pegawai; ?></td>
                <td><?php echo $row->nama_sloc; ?></td>
                <td><?php echo $row->nama_plant; ?></td>
                <td><?php echo $row->nama_divisi; ?></td>
                <td><?php echo $row->nama_departement; ?></td>
                <td><?php echo $row->nama_jenis; ?></td>
                <td><?php echo $row->nama_jabatan; ?></td>
                <td><?php echo $row->tgl_masuk; ?></td>
                <td><?php echo $row->lama_kerja; ?></td>
                <td><?php echo $row->nama_bank; ?></td>
                <td><?php echo $row->no_rekening; ?></td>
                <td><?php echo $row->nama_jenis; ?></td>
                  <td><?php echo $row->ktp; ?></td>
                    <td><?php echo $row->telepon; ?></td>
                    <td><?php echo $row->nama_status_pegawai; ?></td>
                        <td><?php echo $row->jk; ?></td>

                  <td><?php echo $row->alamat; ?></td>
                <td><?php echo $row->nama_status_aktif; ?></td>

              </tr>

        <?php }
        }
        ?>




                    </tbody>
                  </table>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'includefile/Footer.php'; ?>
