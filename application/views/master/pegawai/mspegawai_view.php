<?php
include 'includefile/head.php';

?>


<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <h1>
       Data Pegawai X
       <small>advanced tables</small>
     </h1>
     <ol class="breadcrumb">
       <li><a href="utama#"><i class="fa fa-dashboard"></i> Home</a></li>
       <li><a href="#">Master</a></li>
       <li class="active">Pegawai</li>
     </ol>
   </section>

   <!-- Main content -->
   <section class="content">
     <div class="row">
       <div class="col-xs-12">


         <div class="box">

          <?php //include 'template/Pesan.php'; ?>
          <div class="box-header">

               <a href="<?php echo site_url('mspegawai/tambahbaru'); ?>" class="btn btn-block btn-primary btn-flat"><i class="fa fa-plus-square-o"></i> Input Baru</a>
           

           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <table id="example2" class="table table-bordered table-striped nowrap"  cellspacing="0" width="100%">
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
               <tfoot>
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
