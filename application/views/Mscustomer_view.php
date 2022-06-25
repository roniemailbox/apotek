<?php
include 'includefile/head.php';

if ($perintah=="Baru"){
  $action_form = 'Mscustomer/tambah';
}
else {
  $action_form = 'Mscustomer/edit';
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
       <!-- /BOX header -->
  <div class="box-body">
    <div class="row">
      <div class="col-md-6">
      
      <label>ID Customer</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-key"></i></span>
            <input style="background:#D9DCE8;" type="text" class="form-control" name="id_customer" placeholder="Input ID Customer">
        </div>

        <label>Nama Customer</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
              <input type="text" class="form-control" name="nama" placeholder="Nama Customer">
          </div>

        
        <label>Alamat Customer</label>
        <div class="input-group">
          <span class="input-group-addon"><i></i></span>
            <input type="text" class="form-control" name="alamat" placeholder="Alamat">
        </div>

        <label>Alamat Invoice</label>
          <div class="input-group">
            <span class="input-group-addon"><i></i></span>
              <input type="text" class="form-control" name="alamat_invoice" placeholder="Alamat Invoice">
          </div>

        <label>Kota</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                <select class="select2 form-control" name="id_kota" required>
                  <option value="">-- Pilih --</option>
                    <?php foreach ($data_kabupaten as $dt_kab)
                        {
                            echo '<option value="'.$dt_kab->id.'">'.$dt_kab->name.'</option>';
                        }
                    ?>
                </select>
            </div>
            
        <label>Kode Pos</label>
            <div class="input-group">
                <span class="input-group-addon"><i></i></span>
                    <input type="text" class="form-control" name="kode_pos" placeholder="Kode Pos">
            </div>
            
        <label>Telepon</label>
        <div class="input-group">
            <span class="input-group-addon"><i></i></span>
                <input type="text" class="form-control" name="telepon" placeholder="Telepon">
        </div>     
        
        <label>HP</label>
            <div class="input-group">
                <span class="input-group-addon"><i></i></span>
                    <input type="text" class="form-control" name="hp" placeholder="Handphone">
        </div>

        <label>Fax</label>
            <div class="input-group">
                <span class="input-group-addon"><i></i></span>
                    <input type="text" class="form-control" name="fax" placeholder="Fax">
        </div>

        <label>Email</label>
            <div class="input-group">
                <span class="input-group-addon"><i></i></span>
                    <input type="text" class="form-control" name="email" placeholder="Email">
        </div>

        <label>NPWP</label>
            <div class="input-group">
                <span class="input-group-addon"><i></i></span>
                    <input type="text" class="form-control" name="npwp" placeholder="NPWP">
        </div>


    </div>
      <!-- RIght Coloumn -->
    <div class="col-md-6">

        <label>Bank</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
            <select class="select2 form-control" name="id_bank" required>
                <option value="">-- Pilih --</option>
                    <?php foreach ($data_bank as $dt_bank)
                {
                  echo '<option value="'.$dt_bank->id_bank.'">'.$dt_bank->nama_bank.'</option>';
                }
                    ?>
            </select>
        </div>

        <label>TOP</label>
            <div class="input-group">
                <span class="input-group-addon"><i></i></span>
                    <input type="number" class="form-control" name="top" placeholder="Jatuh tempo pembayaran">
        </div>

        <label>No Rekening</label>
            <div class="input-group">
                <span class="input-group-addon"><i></i></span>
                    <input type="text" class="form-control" name="no_rekening" placeholder="No Rekening">
        </div>

        <label>An Rekening</label>
            <div class="input-group">
                <span class="input-group-addon"><i></i></span>
                    <input class="form-control" name="an_rekening" placeholder="Nama Pemimlik Rekening" type="text">
        </div>

        <label>Kontak Person</label>
            <div class="input-group">
                <span class="input-group-addon"><i></i></span>
                    <input class="form-control" name="kontak_person" placeholder="Kontak Person" type="text">
        </div>

        <label>Keterangan</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                <textarea id="editor1" name="ktp" rows="10" cols="80" placeholder="Keterangan">
            </textarea>
        </div>

    </div>

    </div>
  </div>

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
       <!-- /BOX header -->
  <div class="box-body">
  <?php
        $no=1;
        if(isset($data_edit))
           {
             foreach ($data_edit as $row_edit)
                { ?>
    <div class="row">
      <div class="col-md-6">
      
      <label>ID Customer</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-key"></i></span>
            <input style="background:#D9DCE8;" type="text" class="form-control" name="id_customer" value="<?php echo $row_edit->id_customer; ?>" placeholder="Input ID Customer" readonly>
        </div>

        <label>Nama Customer</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
              <input type="text" class="form-control" name="nama" placeholder="Nama Cutomer" value="<?php echo $row_edit->nama; ?>">
          </div>

        <label>Alamat Customer</label>
          <div class="input-group">
            <span class="input-group-addon"><i></i></span>
              <input type="text" class="form-control" name="alamat" value="<?php echo $row_edit->alamat; ?>" placeholder="Alamat">
        </div>

        <label>Alamat Invoice</label>
          <div class="input-group">
            <span class="input-group-addon"><i></i></span>
              <input type="text" class="form-control" name="alamat_invoice" value="<?php  echo $row_edit->alamat_invoice; ?>" placeholder="Alamat Invoice">
          </div>

        <label>Kota</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                <select class="select2 form-control" name="id_kota" required>
                  <option value="<?php  echo $row_edit->nama_kota; ?>"><?php echo $row_edit->nama_kota; ?></option>
                    <?php foreach ($data_kab as $dt_kab)
                        {
                            echo '<option value="'.$dt_kab->id_kota.'">'.$dt_kab->nama_kota.'</option>';
                        }
                    ?>
                </select>
            </div>
            
        <label>Kode Pos</label>
            <div class="input-group">
                <span class="input-group-addon"><i></i></span>
                    <input type="text" class="form-control" name="kode_pos" value="<?php  echo $row_edit->kode_pos; ?>" placeholder="Kode Pos">
            </div>
            
        <label>Telepon</label>
        <div class="input-group">
            <span class="input-group-addon"><i></i></span>
                <input type="text" class="form-control" name="telepon" value="<?php  echo $row_edit->telepon; ?>" placeholder="Telepon">
        </div>     
        
        <label>HP</label>
            <div class="input-group">
                <span class="input-group-addon"><i></i></span>
                    <input type="text" class="form-control" name="hp" value="<?php  echo $row_edit->hp; ?>" placeholder="Handphone">
        </div>

        <label>Fax</label>
            <div class="input-group">
                <span class="input-group-addon"><i></i></span>
                    <input type="text" class="form-control" name="fax" value="<?php  echo $row_edit->fax; ?>" placeholder="Fax">
        </div>

        <label>Email</label>
            <div class="input-group">
                <span class="input-group-addon"><i></i></span>
                    <input type="text" class="form-control" name="email" value="<?php  echo $row_edit->email; ?>" placeholder="Email">
        </div>

        <label>NPWP</label>
            <div class="input-group">
                <span class="input-group-addon"><i></i></span>
                    <input type="text" class="form-control" name="npwp" value="<?php  echo $row_edit->npwp; ?>" placeholder="NPWP">
        </div>


    </div>
      <!-- RIght Coloumn -->
    <div class="col-md-6">

        <label>Bank</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
            <select class="select2 form-control" name="id_bank" required>
                <option value="<?php  echo $row_edit->nama_bank; ?>"><?php echo $row_edit->nama_bank; ?></option>
                    <?php foreach ($data_bank as $dt_bank)
                {
                  echo '<option value="'.$dt_bank->id_bank.'">'.$dt_bank->nama_bank.'</option>';
                }
                    ?>
            </select>
        </div>

        <label>TOP</label>
            <div class="input-group">
                <span class="input-group-addon"><i></i></span>
                    <input type="number" class="form-control" name="top" value="<?php echo $row_edit->top; ?>" placeholder="Jatuh tempo pembayaran">
        </div>

        <label>No Rekening</label>
            <div class="input-group">
                <span class="input-group-addon"><i></i></span>
                    <input type="text" class="form-control" name="no_rekening" value="<?php echo $row_edit->no_rekening; ?>" placeholder="No Rekening">
        </div>

        <label>An Rekening</label>
            <div class="input-group">
                <span class="input-group-addon"><i></i></span>
                    <input class="form-control" name="an_rekening" value="<?php echo $row_edit->an_rekening; ?>" placeholder="Nama Pemimlik Rekening" type="text">
        </div>

        <label>Kontak Person</label>
            <div class="input-group">
                <span class="input-group-addon"><i></i></span>
                    <input class="form-control" name="kontak_person" value="<?php echo $row_edit->kontak_person; ?>" placeholder="Kontak Person" type="text">
        </div>

        <label>Keterangan</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                <textarea id="editor1" name="ktp" rows="10" cols="80" placeholder="Keterangan">
                <?php echo $row_edit->keterangan; ?>
            </textarea>
        </div>

    </div>

    </div>
    <?php
     }
   }
  ?>
  </div>

  <div class="box-footer">
  <a href="<?php echo site_url('Mscustomer'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Input Baru</a>
  <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Update Data</button>
  </div>
</div>
<?php
}?>

<!-- /box header-->
</form>

    <!-- BAWAH -->
     <div class="row">
       <div class="col-xs-12">
          <div class="box">
          <?php //include 'template/Pesan.php'; ?>
           <div class="box-header">
             <button type="button" class="btn btn-block btn-info btn-dropbox" data-toggle="modal" data-target="#modal-default"><i class="fa fa-search"></i>
               Cari Master Customer
             </button>

             <!-- <button type="button" class="btn btn-block btn-info btn-flat" ><i class="fa fa-file-excel-o"></i>
             <a href="<?//php echo site_url('Mscustomer/exportexcel'); ?>" >Download Excel Master Barang </a>
             </button> -->
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
                    
                    <th>ID</th>
                    <th>NAMA</th>
                    <th>ALAMAT</th>
                    <th>NAMA KOTA</th>
                    <th>TELEPON</th>
                    <th>HANDPHONE</th>
                    <th>FAX</th>
                    <th>EMAIL</th>
                    <th>KONTAK PERSON</th>
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
            <div class="modal fade" id="modal-<?php echo $row->id_customer; ?>">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Mscustomer/Dataedit')?>">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title">Edit Data Ini....????</h4>
                 </div>
                 <div class="modal-body">
                  <p>
                     <h5>ID Customer</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-key"></i></span>
                       <input type="test" name="id_customer" value="<?php echo $row->id_customer; ?>" class="form-control" placeholder="Auto" readonly>

                     </div>
                     <h5>Nama Customer</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-ellipsis-v"></i></span>
                       <input type="text" value="<?php echo $row->nama; ?>" class="form-control" placeholder="RW" readonly>
                     </div>
                  </p>
                 </div
                 >
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

           <div class="modal fade" id="modal-hapus<?php echo $row->id_customer; ?>">
             <div class="modal-dialog">
               <div class="modal-content">
                 <form class="form-horizontal" method="post" action="<?php echo site_url('Mscustomer/hapus')?>">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title">Hapus Data Ini....????</h4>
                 </div>
                 <div class="modal-body">
                   <p>
                     <h5>ID Customer</h5>

                     <div class="input-group">

                       <span class="input-group-addon"><i class="fa fa-key"></i></span>
                       <input type="text" name="id_customer" value="<?php echo $row->id_customer; ?>" class="form-control" placeholder="Auto" readonly>
                     </div>
                     <h5>Nama Customer</h5>

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
                 <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-<?php echo $row->id_customer; ?>"><i class="fa fa-pencil"></i>
                   Edit
                 </button>

               <?php
               }
               if($hak_d == 1)
               {
                 ?>
                 <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-hapus<?php echo $row->id_customer; ?>"><i class="fa fa-trash"></i>
                   Hapus
                 </button>

               <?php
               }
               if($hak_p == 1)
               {
                 ?>
                 <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-preview<?php echo $row->id_customer; ?>"><i class="fa fa-print"></i>
                   Lainnya
                 </button>

               <?php
               }
               ?>
             </td>
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
                    
                    <th>ID</th>
                    <th>NAMA</th>
                    <th>ALAMAT</th>
                    <th>NAMA KOTA</th>
                    <th>TELEPON</th>
                    <th>HANDPHONE</th>
                    <th>FAX</th>
                    <th>EMAIL</th>
                    <th>KONTAK PERSON</th>
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
