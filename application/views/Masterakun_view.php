<?php
include 'includefile/head.php';

if ($perintah=="Baru"){
  $action_form = 'Masterakun/tambah';
}
else {
  $action_form = 'Masterakun/edit';
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

     <form  method="post" action="<?=site_url($action_form)?>" >
       <?php if($perintah=="Baru" && $hak_c == 1)
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
             <label>No Akun (COA)</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-key"></i></span>
               <input type="text" class="form-control" name="kd_akun" placeholder="Kode Akun (CoA)" required>
             </div>
             <label>Nama Aset</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-user"></i></span>
               <input type="text" class="form-control" name="nama" placeholder="Nama Aset" required>
             </div>
             <label>Induk</label>
             <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                    <select class="select2 form-control" name="induk" required>
                      <option value="">-- Pilih --</option>
                      <?php foreach ($data_akun as $rowpxs)
                      {
                        echo '<option value="'.$rowpxs->kd_akun.'">'.$rowpxs->kd_akun." - ".strtoupper($rowpxs->nama).'</option>';
                      }
                      ?>
                    </select>
              </div>
             <label>Detail</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
               <input type="text" class="form-control" name="detail" placeholder="Detail">
             </div>
            

              <label>Level</label>
              <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                     <input type="number" class="form-control" name="level" placeholder="Level" >
                       
                 </div>
             <label>Group</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
               <input type="text" class="form-control" name="group" placeholder="Group">
             </div>

            <!-- /.NAMAup -->

             <!-- /.form-group -->
           </div>
           <!-- /.col -->
           <div class="col-md-6">





               <label>Total</label>
               <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                 <select class="select2 form-control" name="total" required>
                      <option value="">-- Pilih --</option>
                      <?php foreach ($data_akun as $rowpxs)
                      {
                        echo '<option value="'.$rowpxs->kd_akun.'">'.$rowpxs->kd_akun." - ".strtoupper($rowpxs->nama).'</option>';
                      }
                      ?>
                    </select>
                </div>
                <label>Jenis Akun</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                  <input type="text" class="form-control" name="jenis_akun" placeholder="Jenis Akun">
                 </div>

                 <label>Saldo Normal</label>
                 <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                        <select class="select2 form-control" name="saldo_normal">
                          <option value="">-- Pilih --</option>
                          <option value="D">D</option>
                          <option value="K">K</option>
                        </select>
                  </div>

                  <label>Finance</label>
                 <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                        <select class="select2 form-control" name="finance">
                          <option value="">-- Pilih --</option>
                          <option value="NRC">NRC</option>
                          <option value="LR">LR</option>
                        </select>
                  </div>

                  <label>Status Akun</label>
                 <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                        <select class="select2 form-control" name="status_akun">
                          <option value="">-- Pilih --</option>
                          <option value="Akt">Aktif</option>
                          <option value="Non_Akt">Non Aktif</option>
                        </select>
                  </div>
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
        if(isset($data_akun_edit))
           {
             foreach ($data_akun_edit as $row_edit)
                { ?>
      <div class="row">
           <div class="col-md-6">
             <label>No Akun (COA)</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-key"></i></span>
               <input type="text" class="form-control" value="<?php echo $row_edit->kd_akun?>" name="kd_akun" placeholder="Kode Akun (CoA)" required>
             </div>
             <label>Nama Aset</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-user"></i></span>
               <input type="text" class="form-control" value="<?php echo $row_edit->nama?>" name="nama" placeholder="Nama Aset" required>
             </div>
             <label>Induk</label>
             <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                    <select class="select2 form-control" name="induk" required>
                      <option value="<?php echo $row_edit->kd_akun;?>"><?php echo $row_edit->kd_akun?> - <?php echo strtoupper($row_edit->nama)?> </option>
                      <?php foreach ($data_akun as $rowpxs)
                      {
                        echo '<option value="'.$rowpxs->kd_akun.'">'.$rowpxs->kd_akun." - ".strtoupper($rowpxs->nama).'</option>';
                      }
                      ?>
                    </select>
              </div>
             <label>Detail</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
               <input type="text" class="form-control" value="<?php echo $row_edit->detail?>" name="detail" placeholder="Detail">
             </div>
            

              <label>Level</label>
              <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                     <input type="number" class="form-control" value="<?php echo $row_edit->level?>" name="level" placeholder="Level" >
                       
                 </div>
             <label>Group</label>
             <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
               <input type="text" class="form-control" value="<?php echo $row_edit->group?>" name="group" placeholder="Group">
             </div>

            <!-- /.NAMAup -->

             <!-- /.form-group -->
           </div>
           <!-- /.col -->
           <div class="col-md-6">





               <label>Total</label>
               <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                 <select class="select2 form-control" name="total" required>
                      <option value="<?php echo $row_edit->kd_akun;?>"><?php echo $row_edit->kd_akun?> - <?php echo strtoupper($row_edit->nama)?> </option>
                      <?php foreach ($data_akun as $rowpxs)
                      {
                        echo '<option value="'.$rowpxs->kd_akun.'">'.$rowpxs->kd_akun." - ".strtoupper($rowpxs->nama).'</option>';
                      }
                      ?>
                    </select>
                </div>
                <label>Jenis Akun</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                  <input type="text" class="form-control" value="<?php echo $row_edit->jenis_akun ?>" name="jenis_akun" placeholder="Jenis Akun">
                 </div>

                 <label>Saldo Normal</label>
                 <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                        <select class="select2 form-control" name="saldo_normal">
                          <option value="<?php echo $row_edit->saldo_normal ?>"><?php echo $row_edit->saldo_normal ?></option>
                          <option value="D">D</option>
                          <option value="K">K</option>
                        </select>
                  </div>

                  <label>Finance</label>
                 <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                        <select class="select2 form-control" name="finance">
                          <option value="<?php echo $row_edit->finance?>"><?php echo $row_edit->finance?></option>
                          <option value="NRC">NRC</option>
                          <option value="LR">LR</option>
                        </select>
                  </div>

                  <label>Status Akun</label>
                 <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                        <select class="select2 form-control" name="status_akun">
                          <option value="<?php echo $row_edit->status_akun?>"><?php echo $row_edit->status_akun?></option>
                          <option value="Akt">Aktif</option>
                          <option value="Non_Akt">Non Aktif</option>
                        </select>
                  </div>
             <!-- /.form-group -->


           </div>
           <!-- /.col -->
         </div>
      <!-- /.row -->
      <?php
     }
   }
  ?>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <?php
        if($hak_c == 1)
        {
       ?>
       <a href="<?php echo site_url('Masterakun'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Input Baru</a>
       <?php
            }
        ?>

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
               Cari Master Akun (<?php echo number_format($jml_akun).' Data' ; ?>)
             </button>
             

           </div>

           

           <div class="modal fade" id="modal-default">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Masterakun/filter')?>">
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
                   <th>Kode Akun</th>
                   <th>Nama</th>
                   <th>Induk</th>
                   <th>Detail</th>
                   <th>Level</th>
                    <th>Group</th>
                   <th>Jenis</th>
                   <th>Finance</th>
                   <th>Status Transaksi</th>
                   <th>Dientri Oleh</th>
                   <th>Dientri Pada</th>
                   <th>Diedit Oleh</th>
                   <th>Diedit Pada</th>

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
 if(isset($data_akun))
    {
      foreach ($data_akun as $row)
         { ?>

           <div class="modal fade" id="modal-<?php echo $row->kd_akun; ?>">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Masterakun/Dataedit')?>">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title">Edit Data Ini....????</h4>
                 </div>
                 <div class="modal-body">
                   <p>
                     <h5>KD Akun</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-key"></i></span>
                       <input type="test" name="kd_akun" value="<?php echo $row->kd_akun; ?>" class="form-control" placeholder="Auto" readonly>

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
           <div class="modal fade" id="modal-hapus<?php echo $row->kd_akun; ?>">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Masterakun/hapus')?>">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title">Hapus Data Ini....????</h4>
                 </div>
                 <div class="modal-body">
                   <p>
                     <h5>KD Akun</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-key"></i></span>
                       <input type="text" name="kd_akun" value="<?php echo $row->kd_akun; ?>" class="form-control" placeholder="Auto" readonly>
                     </div>
                     <h5>Nama</h5>

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
                 <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-<?php echo $row->kd_akun; ?>"><i class="fa fa-pencil"></i>
                   Edit
                 </button>

               <?php
               }
               if($hak_d == 1)
               {
                 ?>
                 <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-hapus<?php echo $row->kd_akun; ?>"><i class="fa fa-trash"></i>
                   Hapus
                 </button>



               <?php
               }

               ?>
             </td>
           <td><?php echo $row->kd_akun; ?></td>

           <td><?php echo strtoupper($row->nama); ?></td>
           <td><?php echo $row->induk; ?></td>
           <td><?php  echo $row->detail; ?></td>
            <td><?php echo $row->level; ?></td>
           <td><?php echo $row->group; ?></td>
           <td><?php echo $row->jenis_akun; ?></td>
           <td><?php echo $row->finance; ?></td>
           <td><?php echo $row->status_akun; ?></td>
           <td><?php echo $row->user_entry; ?></td>
           <td><?php echo $row->date_entry; ?></td>
           <td><?php echo $row->user_edit; ?></td>
           <td><?php echo $row->date_edit; ?></td>


           </tr>

   <?php }
   }
   ?>




               </tbody>
               <tfoot>
                 <tr>
                 <th>Opsi</th>
                   <th>Kode Akun</th>
                   <th>Nama</th>
                   <th>Induk</th>
                   <th>Detail</th>
                   <th>Level</th>
                    <th>Group</th>
                   <th>Jenis</th>
                   <th>Finance</th>
                   <th>Status Transaksi</th>
                   <th>Dientri Oleh</th>
                   <th>Dientri Pada</th>
                   <th>Diedit Oleh</th>
                   <th>Diedit Pada</th>
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
