<?php
include 'includefile/head.php';


if ($perintah=="Baru"){
  $action_form = 'Mskategori/tambah';
}
else {
  $action_form = 'Mskategori/edit';
}

?>

<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
     
     <ol class="breadcrumb">
       <li><a href="<?php echo site_url('Utama') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      
     </ol>
   </section>
   <!-- Main content -->
   <br>
   
   <section class="content">

   <form  method="post" action="<?=site_url($action_form)?>" >
   <?php if($perintah=="Baru")
  {
    ?>
    
      <!-- left column -->
      
        <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $title_tambah ?> </h3>

              <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>

       <!-- End Box Header -->

                  <div class="box-body">
                  <div class="row">
                  <div class="col-md-12">
                    <label for="first-name"> Kode Kategori </label>
                    <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input style="background:#D9DCE8;" value="" class="form-control" name="id_kategori" type="text" id="id_kategori" placeholder="AUTO" readonly/>
                  </div>
                  <label>Nama kategori</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input class="form-control" id="nama" placeholder="Nama kategori" type="text" name="nama">
                    </div>
                  
                      <label>Aktif</label>
                            <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                            <select class="form-control select2" name="id_status_aktif" required>
                            <option value="">-- pilih --</option>
                            <?php foreach ($data_status_aktif as $dt_status_aktif)
                            {
                             echo '<option value="'.$dt_status_aktif->id_status_aktif.'">'.$dt_status_aktif->nama_status_aktif.'</option>';
                            }
                                   ?>
                                 </select>
                               </div>

                             </div>


                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="submit" class="btn btn-info pull-right">Simpan</button>
                </div>
                <!-- /.box-footer -->

            </div>
                          

      


      <!--/.col (left) -->
      <!-- right column -->

      <!--/.col (right) -->
    
  <?php
  } else { ?>
  <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $title_tambah ?> </h3>

              <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
  <?php
  $no=1;
  if(isset($data_kategori_edit))
     {
       foreach ($data_kategori_edit as $row)
          {  ?>
 
    <!-- left column -->
    
          <!-- End Box-Header -->
          <div class="box-body">
                  <div class="row">
                  <div class="col-md-12">
                    <label for="first-name"> Kode Kategori </label>
                    <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input style="background:#D9DCE8;" value="<?php echo $row->id_kategori ?>" class="form-control" name="id_kategori" type="text" id="id_kategori" placeholder="AUTO" readonly/>
                  </div>
                  <label>Nama kategori</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input class="form-control" id="nama" value="<?php echo $row->nama; ?>" placeholder="Nama kategori" type="text" name="nama">
                    </div>
                  
                      <label>Aktif</label>
                            <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                            <select class="form-control select2" name="id_status_aktif" required>
                            <option value="<?php echo $row->id_status_aktif ?>"><?php echo $row->nama_status_aktif ?></option>
                            <?php foreach ($data_status_aktif as $dt_status_aktif)
                            {
                             echo '<option value="'.$dt_status_aktif->id_status_aktif.'">'.$dt_status_aktif->nama_status_aktif.'</option>';
                            }
                                   ?>
                                 </select>
                               </div>

                             </div>
                      </div>
                    <?php
                    }
                  }
                  ?>
                </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Update</button>
              </div>
              <!-- /.box-footer -->

          </div>


    <!--/.col (left) -->
    <!-- right column -->

    <!--/.col (right) -->
  
  <?php  // code...
   
}
?>
</form>

  
     <div class="row">
       <div class="col-xs-12">


         <div class="box">

          <?php //include 'template/Pesan.php'; ?>
           <div class="box-header">

               <!--<a href="<?php echo site_url('Mskategori/baru'); ?>" class="btn btn-block btn-primary btn-flat"><i class="fa fa-plus"></i> Input Baru</a>-->
             <!-- <a href="<?php //echo site_url('mspegawai/exportexcel'); ?>" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export To Excel</a> -->
             <button type="button" class="btn btn-block btn-info btn-flat" data-toggle="modal" data-target="#modal-default"><i class="fa fa-search"></i>
               Cari Master kategori
             </button>

           </div>

           <div class="modal fade" id="modal-default">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Mskategori/filter')?>">
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
                   <th>Opsi</th>
                   <th>Kode kategori</th>
                   <th>Nama kategori</th>
                   <th>Status</th>
                   <th>Dientri Oleh</th>
                   <th>Dientri Pada</th>
                  
                 </tr>
               </thead>
               <tbody>
                <!--
               <a class="btn btn-mini" href="<?php //echo site_url('master/hapus_kategori/'.$row->kd_kategori);?>"
        onclick="return confirm('Anda yakin?')"> <i class="icon-remove"></i> Hapus</a> -->
   </td>
 <?php
 //ambil dari controler
 $no=1;
 if(isset($data_kategori))
    {
      foreach ($data_kategori as $row)
         { ?>
            <div class="modal fade" id="modal-<?php echo $row->id_kategori; ?>">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Mskategori/Dataedit')?>">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title">Edit Data Ini....????</h4>
                 </div>
                 <div class="modal-body">
                   <p>
                     <h5>Kode Kategori</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-key"></i></span>
                       <input type="test" name="id_kategori" value="<?php echo $row->id_kategori; ?>" class="form-control" placeholder="Auto" readonly>

                     </div>
                     <h5>Nama</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                       <input type="text" value="<?php echo $row->nama; ?>" class="form-control" placeholder="RW" readonly>
                     </div>

                 </p>
                 </div>
                 <div class="modal-footer">
                   <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
                   <button type="submit" class="btn btn-primary">Ya....!!</button>
                 </div>
               </form>
               </div>
               <!-- /.modal-content -->
             </div>
             <!-- /.modal-dialog -->
           </div>
           <div class="modal fade" id="modal-hapus<?php echo $row->id_kategori; ?>">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Mskategori/hapus')?>">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title">Hapus Data Ini....????</h4>
                 </div>
                 <div class="modal-body">
                   <p>
                     <h5>Kode Kategori</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-key"></i></span>
                       <input type="text" name="id_kategori" value="<?php echo $row->id_kategori; ?>" class="form-control" placeholder="Auto" readonly>
                     </div>
                     <h5>Nama Kategori</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                       <input type="text" value="<?php echo $row->nama; ?>" class="form-control" placeholder="rw" readonly>
                     </div>




                 </p>
                 </div>
                 <div class="modal-footer">
                   <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
                   <button type="submit" class="btn btn-primary">Ya....!!</button>
                 </div>
               </form>
               </div>
               <!-- /.modal-content -->
             </div>
             <!-- /.modal-dialog -->
           </div>
           <tr>
           <td>
             <?php
             if($hak_u == 1)
             {
               ?>

                 <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-<?php echo $row->id_kategori; ?>"><i class="fa fa-pencil"></i>
                   Edit
                 </button>
             <?php
             }
             if($hak_d == 1)
             {
               ?>
                 <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-hapus<?php echo $row->id_kategori; ?>"><i class="fa fa-trash"></i>
                   Hapus
                 </button>
             <?php
             }

             ?>
           </td>
           <td><?php echo $row->id_kategori; ?></td>
           <td><?php echo $row->nama; ?></td>
           <td><?php  echo $row->nama_status_aktif; ?></td>
           <td><?php echo $row->nama_pegawai; ?></td>
           <td><?php echo $row->entry_date; ?></td>

           
           </tr>

   <?php }
   }
   ?>

  


               </tbody>
               <tfoot>
                 <tr>
                   <th>Opsi</th>
                   <th>Kode kategori</th>
                   <th>Nama kategori</th>
                   <th>Status</th>
                   <th>Dientri Oleh</th>
                   <th>Dientri Pada</th>
                   
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


<?php
$this->load->view('includefile/foot');
?>
