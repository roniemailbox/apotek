<?php include 'includefile/head.php'; ?>


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php
       //$ses_id_pegawai=$this->session->userdata('kd_unit');
       echo $title  ?>
      <small>Data Table</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url('Utama') ?>"><i class="fa fa-dashboard"></i> Home</a></li>

    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">


        <div class="box">

         <?php  include 'includefile/Pesan.php'; ?>
         <div class="box-header">
           <?php if($hak_c == 1) { ?>

           <div class="form-group">
           <!--<button type="buttons" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-plus-square-o"></i>
           Input Baru X</button> -->

           <a href="<?php echo site_url('mscustomer/baru'); ?>" class="btn btn-block btn-primary btn-flat"><i class="fa fa-plus-square-o"></i> Input Baru</a>
           <button type="button" class="btn btn-block btn-info btn-flat" data-toggle="modal" data-target="#modal-default"><i class="fa fa-search"></i>
             Cari Data Customer
           </button>

           </div>
             <!-- AWAL MODAL TAMBAH DATA -->



           <?php } ?>

          </div>
          <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
              <div class="modal-content">
                <form class="form-horizontal" method="post" action="<?php echo site_url('Mscustomer/filter')?>">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Filter Pencarian</h4>
                </div>
                <div class="modal-body">
                  <p>
                    <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="text" name="katakunci" class="form-control" placeholder="Kata Kunci" required>
                  </div>
                </p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Filter.....!!!</button>
                </div>
              </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example2" class="table table-bordered table-striped nowrap"  cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>OPSI</th>
                  <th>NO</th>
                  <th>ID</th>
                  <th>NAMA</th>
                  <th>ALAMAT</th>
                  <th>NAMA KOTA</th>
                  <th>TELEPON</th>
                    <th>HANDPHONE</th>
                  <th>FAX</th>
                  <th>EMAIL</th>
                  <th>PIC</th>


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
  if(isset($data_customer))
     {
       foreach ($data_customer as $row)
          { ?>

          <tr>
            <td>
            <?php
            if($hak_u == 1)
            {
              ?>
              <!--<a href="#modalEdit<? //=$row->id_customer ?>" data-toggle="modal" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a>-->

              <a href="<?php echo site_url('mscustomer/ambiledit/'.$row->id_customer);?>" class="btn btn-info btn-xs"
              onclick="return confirm('Anda yakin edit data ini....????')"> <i class="fa fa-pencil"></i> Edit</a>
            <?php
            }
            if($hak_d == 1)
            {
              ?>
              <a href="<?php echo site_url('mscustomer/hapus/'.$row->id_customer);?>" class="btn btn-danger btn-xs"
              onclick="return confirm('Anda yakin menghapus data ini....????')"> <i class="fa fa-trash"></i> Hapus</a>
            <?php
            }
            ?>
          </td>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row->id_customer; ?></td>
            <td><?php echo $row->nama; ?></td>
            <td><?php echo $row->alamat; ?></td>
            <td><?php echo $row->nama_kota; ?></td>
            <td><?php echo $row->telepon; ?></td>
            <td><?php echo $row->hp; ?></td>
            <td><?php echo $row->fax; ?></td>
            <td><?php echo $row->email; ?></td>
            <td><?php echo $row->kontak_person; ?></td>


          </tr>

    <?php }
    }
    ?>




              </tbody>
              <tfoot>
                <tr>
                  <th>OPSI</th>
                  <th>NO</th>
                  <th>ID</th>
                  <th>NAMA</th>
                  <th>ALAMAT</th>
                  <th>NAMA KOTA</th>
                  <th>TELEPON</th>
                    <th>HANDPHONE</th>
                  <th>FAX</th>
                  <th>EMAIL</th>
                  <th>PIC</th>


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




<?php include 'includefile/foot.php'; ?>
