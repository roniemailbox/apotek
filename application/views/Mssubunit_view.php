<?php
include 'includefile/head.php';

if ($perintah=="Baru"){
  $action_form = 'Mssubunit/tambah';
}
else {
  $action_form = 'Mssubunit/edit';
}
?>

<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">

     <ol class="breadcrumb">
       <li><a href="<?php echo site_url('Utama') ?>"><i class="fa fa-home"></i> Home</a></li>

     </ol>
   </section>
   <!-- Main content -->
   <br>
   <section class="content">

   <form method="post" action="<?=site_url($action_form)?>" >
  <?php if($perintah =="Baru")
  {
    ?>

     <div class="box box-default">
       <div class="box-header with-border">
         <h3 class="box-title"><?php echo $title_tambah ?></h3>

         <div class="box-tools pull-right">
           <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
         </div>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
         <div class="row">
           <div class="col-md-6">

             <label>Kode Sub Unit</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-key"></i></span>
               <input type="text" class="form-control" name="id_subunit" placeholder="AUTO" readonly>
             </div>

             <label>Nama Sub Unit</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
               <input type="text" class="form-control" name="nama_sub_unit" placeholder="Nama Sub Unit">
             </div>

             <label>Alamat</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
               <input type="text" class="form-control" name="alamat_sub_unit" placeholder="Alamat">
             </div>

              <label>Kota</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                    <select class="form-control select2 col-md-12" name="id_kota">
                       <option value="<?php //echo $row->id_kota ?>"><?php echo "-- Pilih --" ?></option>
                       <?php foreach ($data_kab as $dt_kab)
                       {
                         echo '<option value="'.$dt_kab->id.'">'.$dt_kab->name.'</option>';
                       }
                       ?>
                    </select>
              </div>
           </div>
           <!-- /.col -->
        <div class="col-md-6">
          
        <label>Telepon</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
               <input type="text" class="form-control" name="telepon" placeholder="Telepon">
            </div>
             <!-- /.form-group -->

             <label>Fax</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
               <input type="text" class="form-control" name="fax" placeholder="Fax">
            </div>

            <label>E-mail</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
               <input type="email" class="form-control" name="email" placeholder="E-mail">
            </div>

            <label>Nama Unit</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                    <select class="form-control select2 col-md-12" name="kd_unit">
                    <option value="<?php //echo $row->id_kota ?>"><?php echo "-- Pilih --" ?></option>
                    <?php foreach ($data_unit as $dt_unit)
                     {
                       echo '<option value="'.$dt_unit->kd_unit.'">'.$dt_unit->nama_unit.'</option>';
                     }
                     ?>
                    </select>
              </div>

        </div>
           
         </div>
         <!-- /.row -->
       </div>
       <!-- /.box-body -->
       <div class="box-footer">
        <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Simpan Data</button>
       </div>
     </div>
<?php
} else {
?>
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo $title_tambah; ?></h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div class="row">
      <?php
        $no=1;
        if(isset($data_subunit_edit)) {
            foreach ($data_subunit_edit as $row_edit) {
      ?>
<div class="col-md-6">

        <label>Kode Sub Unit</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-key"></i></span>
               <input value="<?php echo $row_edit->kd_sub_unit; ?>" type="text" class="form-control" name="id_sub_unit" placeholder="AUTO" readonly>
             </div>

             <label>Nama Sub Unit</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
               <input value="<?php echo $row_edit->nama_sub_unit; ?>" type="text" class="form-control" name="nama_sub_unit" placeholder="Nama Sub Unit">
             </div>

             <label>Alamat</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
               <input value="<?php echo $row_edit->alamat_sub_unit; ?>" type="text" class="form-control" name="alamat_sub_unit" placeholder="Alamat">
             </div>

              <label>Kota</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                    <select class="form-control select2 col-md-12" name="id_kota">
                       <option value="<?php echo $row_edit->id_kota; ?>"><?php echo $row_edit->nama_kota; ?></option>
                       <?php foreach ($data_kabupaten as $dt_kab)
                       {
                         echo '<option value="'.$dt_kab->id.'">'.$dt_kab->name.'</option>';
                       }
                       ?>
                    </select>
              </div>
</div>
<div class="col-md-6">
            <label>Telepon</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
               <input value="<?php echo $row_edit->telepon; ?>" type="text" class="form-control" name="telepon" placeholder="Telepon">
            </div>
             <!-- /.form-group -->

             <label>Fax</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
               <input value="<?php echo $row_edit->fax; ?>" type="text" class="form-control" name="fax" placeholder="Fax">
            </div>

            <label>E-mail</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
               <input value="<?php echo $row_edit->email; ?>" type="email" class="form-control" name="email" placeholder="E-mail">
            </div>

            <label>Nama Unit</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                    <select class="form-control select2 col-md-12" name="kd_unit">
                    <option value="<?php echo $row_edit->kd_unit; ?>"><?php echo $row_edit->nama_unit ?></option>
                    <?php foreach ($data_unit as $dt_unit)
                     {
                       echo '<option value="'.$dt_unit->kd_unit.'">'.$dt_unit->nama_unit.'</option>';
                     }
                     ?>
                    </select>
              </div>
                      </div>
      <!-- /.row -->
      <?php
            }
         }
?>
</div>
      </div>
    <!-- /.box-body -->
    <div class="box-footer">
       <a href="<?php echo site_url('Mssubunit'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Input Baru</a>
     <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Update Data</button>
    </div>
    </div>
<?php
 }
?>
</form>


     <div class="row">


       <div class="col-xs-12">


         <div class="box">

          <?php //include 'template/Pesan.php'; ?>
           <div class="box-header">


             <button type="button" class="btn btn-block btn-info btn-flat" data-toggle="modal" data-target="#modal-default"><i class="fa fa-search"></i>
               Cari Master Sub Unit
             </button>

           </div>

           <div class="modal fade" id="modal-default">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Mssubunit/filter')?>">
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
               <tr>
                   <th>Opsi</th>
                   <th>Kode Sub Unit</th>
                   <th>Nama Sub Unit</th>
                   <th>Alamat</th>
                   <th>Kota</th>
                   <th>Telepon</th>
                   <th>Fax</th>
                   <th>Email</th>
                   <th>Nama Unit</th>
                   <th>Dientri Oleh</th>
                   <th>Dientri Pada</th>
                 </tr>
               </thead>
               <tbody>
                <!--
               <a class="btn btn-mini" href="<?php //echo site_url('master/hapus_rw/'.$row->kd_rw);?>"
        onclick="return confirm('Anda yakin?')"> <i class="icon-remove"></i> Hapus</a> -->
   </td>
   <?php
 //ambil dari controler
 $no=1;
 if(isset($data_subunit))
    {
      foreach ($data_subunit as $row)
         { ?>

           <div class="modal fade" id="modal-<?php echo $row->kd_sub_unit; ?>">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Mssubunit/Dataedit')?>">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title">Edit Data Ini....????</h4>
                 </div>
                 <div class="modal-body">
                   <p>
                     <h5>Kode Sub Unit</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-key"></i></span>
                       <input type="test" name="id_subunit" value="<?php echo $row->kd_sub_unit; ?>" class="form-control" placeholder="Auto" readonly>

                     </div>
                     <h5>Nama Sub Unit</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                       <input type="text" value="<?php echo $row->nama_sub_unit; ?>" class="form-control" placeholder="RW" readonly>
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
           <div class="modal fade" id="modal-hapus<?php echo $row->kd_sub_unit; ?>">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Mssubunit/hapus')?>">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title">Hapus Data Ini....????</h4>
                 </div>
                 <div class="modal-body">
                   <p>
                     <h5>Kode Sub Unit</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-key"></i></span>
                       <input type="text" name="id_satuan" value="<?php echo $row->kd_sub_unit; ?>" class="form-control" placeholder="Auto" readonly>
                     </div>
                     <h5>Nama Sub Unit</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                       <input type="text" value="<?php echo $row->nama_sub_unit; ?>" class="form-control" placeholder="rw" readonly>
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
                 <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-<?php echo $row->kd_sub_unit; ?>"><i class="fa fa-pencil"></i>
                   Edit
                 </button>

               <?php
               }
               if($hak_d == 1)
               {
                 ?>
                 <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-hapus<?php echo $row->kd_sub_unit; ?>"><i class="fa fa-trash"></i>
                   Hapus
                 </button>


               <?php
               }
               if($hak_p == 1)
               {
                 ?>
                 <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-preview<?php echo $row->kd_sub_unit; ?>"><i class="fa fa-print"></i>
                   Lainnya
                 </button>


               <?php
               }

               ?>
             </td>
             <td><?php echo $row->kd_sub_unit; ?></td>
             <td><?php echo $row->nama_sub_unit; ?></td>
             <td><?php  echo $row->alamat_sub_unit; ?></td>
             <td><?php echo $row->nama_kota; ?></td>
             <td><?php echo $row->telepon; ?></td>
             <td><?php echo $row->fax; ?></td>
             <td><?php echo $row->email; ?></td>
             <td><?php echo $row->nama_unit; ?></td>
             <td><?php echo $row->nama_pegawai; ?></td>
             <td><?php echo $row->entry_date; ?></td>
           </tr>

   <?php }
   }
   ?>




               </tbody>
               <tfoot>
               <tr>
               <tr>
                   <th>Opsi</th>
                   <th>Kode Sub Unit</th>
                   <th>Nama Sub Unit</th>
                   <th>Alamat</th>
                   <th>Kota</th>
                   <th>Telepon</th>
                   <th>Fax</th>
                   <th>Email</th>
                   <th>Nama Unit</th>
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
