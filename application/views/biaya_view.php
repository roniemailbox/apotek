<?php
include 'includefile/head.php';

if ($perintah=="Baru"){
  $action_form = 'Bbiaya/tambah';
}
else {
  $action_form = 'Bbiaya/edit';
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
           <div class="col-md-12">

             <label>ID Beban</label>
             <div class="input-group">
               <div class="input-group-addon"><i class="fa fa-key"></i>
               </div>
               <input class="form-control col-md-4 col-xs-12" value="" placeholder="AUTO" readonly type="text" name="id_beban" >
             </div>

             <label>ID Akun</label>
             <div class="input-group">
               <div class="input-group-addon"><i class="fa fa-key"></i>
               </div>
               <input class="form-control col-md-4 col-xs-12" value="" placeholder="" type="text" name="id_akun" >
             </div>

             <label>Nama</label>
             <div class="input-group">
               <div class="input-group-addon"><i class="fa fa-home"></i>
               </div>
               <input class="form-control col-md-4 col-xs-12" value="" placeholder="nama" type="text" name="nama" >
             </div>
             <!--
             <label>Nama Unit</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-home"></i></span>
                <select class="select2 form-control" name="kd_unit" required>
                       <option value="">-- Pilih --</option>
                       <#?php foreach ($data_unit as $rowpxs)
                       {
                         echo '<option value="'.$rowpxs->kd_unit.'">'.strtoupper($rowpxs->nama_unit).'</option>';
                       }
                       ?>
                     </select>
             </div>

             <label>Beban</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                <select class="select2 form-control" name="id_beban" required>
                       <option value="">-- Pilih --</option>
                       <#?php foreach ($data_beban as $rowpxs)
                       {
                         echo '<option value="'.$rowpxs->id_beban.'">'.$rowpxs->id_beban." - ".strtoupper($rowpxs->nama).'</option>';
                       }
                       ?>
                     </select>
             </div>-->



            <!--<label>KD Akun</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
               <select class="select2 form-control" name="id_akun" required>
                      <option value="">-- Pilih --</option>
                      <#?php foreach ($data_beban as $rowpxs)
                      {
                        echo '<option value="'.$rowpxs->id_akun.'">'.$rowpxs->id_akun." - ".strtoupper($rowpxs->nama).'</option>';
                      }
                      ?>
                    </select>
            </div>

            <label>Atas Nama</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
               <input type="text" class="form-control" name="atas_nama" placeholder="Atas Nama">
            </div>

            <label>Keterangan</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-archive"></i></span>
               <textarea type="text" class="form-control" name="rekening" placeholder="Rekening">
               </textarea>
            </div>-->

             <!-- /.form-group -->


           </div>
           <!-- /.col -->
         </div>
         <!-- /.row -->
       </div>
       <!-- /.box-body -->
       <div class="box-footer">
        <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Simpan Data</button>
       </div>
     </div>
<?php } else { ?>

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
      <?php
        $no=1;
        if(isset($data_edit))
           {
             foreach ($data_edit as $row_edit)
                { ?>
      <div class="row">
        <div class="col-md-12">

          <label>ID Beban</label>
          <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-key"></i>
            </div>
            <input class="form-control col-md-4 col-xs-12" value="<?php echo $row_edit->id_beban; ?>" placeholder="AUTO" readonly type="text" name="id_beban" >
          </div>

          <label>ID Akun</label>
          <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-key"></i>
            </div>
            <input class="form-control col-md-4 col-xs-12" value="<?php echo $row_edit->id_akun; ?>" placeholder="" type="text" name="id_akun" >
          </div>

          <label>Nama</label>
          <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-home"></i>
            </div>
            <input class="form-control col-md-4 col-xs-12" value="<?php echo $row_edit->nama; ?>" placeholder="nama" type="text" name="nama" >
          </div>

        <!--  <label>Nama Unit</label>
               <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                 <select class="select2 form-control" name="kd_unit" required>
                        <option value="<#?php echo $row_edit->kd_unit ?>"><#?php  echo $row_edit->nama_unit ?></option>
                        <#?php foreach ($data_unit as $rowp)
                        {
                          echo '<option value="'.$rowp->kd_unit.'">'.$rowp->kd_unit." - ".strtoupper($rowpxs->nama_unit).'</option>';
                        }
                        ?>
                      </select>
              </div>

              <label>Beban</label>
                   <div class="input-group">
                     <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                     <select class="select2 form-control" name="kd_akun" required>
                            <option value="<#?php echo $row_edit->id_beban ?>"><#?php  echo $row_edit->nama ?></option>
                            <#?php foreach ($data_beban as $rowpxs)
                            {
                              echo '<option value="'.$rowpxs->id_beban.'">'.$rowpxs->id_beban." - ".strtoupper($rowpxs->nama).'</option>';
                            }
                            ?>
                          </select>
                  </div>

        <label>KD Akun</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
               <select class="select2 form-control" name="kd_akun" required>
                      <option value="<#?php echo $row_edit->kd_akun ?>"><#?php  echo $row_edit->nama ?></option>
                      <#?php foreach ($data_akun as $rowpxs)
                      {
                        echo '<option value="'.$rowpxs->kd_akun.'">'.$rowpxs->kd_akun." - ".strtoupper($rowpxs->nama).'</option>';
                      }
                      ?>
                    </select>
            </div>

        <label>Nama Bank</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
               <input type="text" class="form-control" name="nama" value="<#?php echo $row_edit->nama ?>" placeholder="Nama Bank">
            </div>

            <label>Atas Nama</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
               <input type="text" class="form-control" name="atas_nama" value="<#?php echo $row_edit->atas_nama ?>" placeholder="Atas Nama">
            </div>

            <label>Keterangan</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-archive"></i></span>
               <textarea type="text" class="form-control" name="rekening" placeholder="Rekening">
                 <#?php echo $row->keterangan; ?>
               </textarea>
            </div>-->

    </div>
      <!-- /.row -->
      <?php
     }
   }
  ?>

    </div>
    <!-- /.box-body -->
    <div class="box-footer">
       <a href="<?php echo site_url('Bbiaya'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Input Baru</a>
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
               Cari Master Beban
             </button>

           </div>

           <div class="modal fade" id="modal-default">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Bbiaya/filter')?>">
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
             <table id="example1" class="table table-bordered table-striped nowrap"  cellspacing="0" width="100%">
               <thead>

               <tr>
                   <th>Opsi</th>
                   <th>Beban</th>
                   <th>KD Akun</th>
                   <th>Nama</th>
                   <th>Dientri Tanggal</th>
                   <th>Dientri Oleh</th>
                   <th>Edit Date</th>
                   <th>Edit User</th>
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
 if(isset($data_beban))
    {
      foreach ($data_beban as $row)
         { ?>

           <div class="modal fade" id="modal-<?php echo $row->id_beban; ?>">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Bbiaya/Dataedit')?>">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title">Edit Data Ini....????</h4>
                 </div>
                 <div class="modal-body">
                   <p>
                     <h5>Kode Beban</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-key"></i></span>
                       <input type="test" name="id_beban" value="<?php echo $row->id_beban; ?>" class="form-control" placeholder="Auto" readonly>

                     </div>
                     <h5>Nama Beban</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                       <input type="text" value="<?php echo $row->nama; ?>" class="form-control" placeholder="Nama Beban" readonly>
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
           <div class="modal fade" id="modal-hapus<?php echo $row->id_beban; ?>">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Bbiaya/hapus')?>">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title">Hapus Data Ini....????</h4>
                 </div>
                 <div class="modal-body">
                   <p>
                     <h5>Kode Beban</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-key"></i></span>
                       <input type="text" name="id_beban" value="<?php echo $row->id_beban; ?>" class="form-control" placeholder="Auto" readonly>
                     </div>
                     <h5>Nama Beban</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                       <input type="text" value="<?php echo $row->nama; ?>" class="form-control" placeholder="Nama Beban" readonly>
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
                 <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-<?php echo $row->id_beban; ?>"><i class="fa fa-pencil"></i>
                   Edit
                 </button>

               <?php
               }
               if($hak_d == 1)
               {
                 ?>
                 <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-hapus<?php echo $row->id_beban; ?>"><i class="fa fa-trash"></i>
                   Hapus
                 </button>


               <?php
               }
               if($hak_p == 1)
               {
                 ?>
                 <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-preview<?php echo $row->id_beban; ?>"><i class="fa fa-print"></i>
                   Lainnya
                 </button>


               <?php
               }

               ?>
             </td>
            <td><?php echo $row->id_beban; ?></td>
            <td><?php  echo $row->id_akun; ?></td>
            <td><?php echo $row->nama; ?></td>
            <td><?php echo $row->entry_date; ?></td>
            <td><?php echo $row->entry_user; ?></td>
            <td><?php echo $row->edit_date; ?></td>
            <td><?php echo $row->edit_user; ?></td>
           </tr>

   <?php }
   }
   ?>




               </tbody>
               <tfoot>
               <tr>
                 <tr>
                     <th>Opsi</th>
                     <th>Beban</th>
                     <th>KD Akun</th>
                     <th>Nama</th>
                     <th>Dientri Tanggal</th>
                     <th>Dientri Oleh</th>
                     <th>Edit Date</th>
                     <th>Edit User</th>
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
