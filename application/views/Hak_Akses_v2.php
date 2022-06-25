<?php include 'includefile/head.php'; ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php $id_user = 0; foreach ($users as $dt)
      {
        echo '<h3>Hak Akses '.strtoupper($dt->nama).' ('.$dt->nama_jabatan.')</h3>';
        $id_user = $dt->id_user;
      }
      ?>

    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url('Utama') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Akses</a></li>
      <li class="active">Atur Hak Akses</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="box">

     <?php include 'includefile/Pesan.php'; ?>

    <form action="<?=site_url('hakakses/update_hak')?>" method="post">
      <div class="box-header">

           <button type="submit" class="btn btn-block btn-success btn-minimal"><i class="fa fa-floppy-o"></i> Update</button>
           <a href=<?=site_url('hakakses')?> class="btn btn-block btn-danger btn-minimal"><i class="fa fa-arrow-circle-o-left"></i> Kembali</a>

       </div>

      <div class="box-body">
        <table id="example" class="table table-bordered table-striped nowrap"  cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>Sub Menu</th>
            <th>Create</th>
            <th>Read</th>
            <th>Update</th>
            <th>Delete</th>
            <th>Print</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0; foreach ($menu_user_in as $dt)
          { $i++;?>
            <tr>
              <td><?=$dt->menu.' ---> '.$dt->submenu?></td>
              <td align="center"><input type="checkbox" name="hak<?=$i?>[]" value="<?=$dt->id_daftar_menu?>,c" class="minimal" <?php if($dt->id_user == $id_user AND $dt->c == 1) echo 'checked';?>></td>
              <td align="center"><input type="checkbox" name="hak<?=$i?>[]" value="<?=$dt->id_daftar_menu?>,r" class="minimal" <?php if($dt->id_user == $id_user AND $dt->r == 1) echo 'checked';?>></td>
              <td align="center"><input type="checkbox" name="hak<?=$i?>[]" value="<?=$dt->id_daftar_menu?>,u" class="minimal" <?php if($dt->id_user == $id_user AND $dt->u == 1) echo 'checked';?>></td>
              <td align="center"><input type="checkbox" name="hak<?=$i?>[]" value="<?=$dt->id_daftar_menu?>,d" class="minimal" <?php if($dt->id_user == $id_user AND $dt->d == 1) echo 'checked';?>></td>
              <td align="center"><input type="checkbox" name="hak<?=$i?>[]" value="<?=$dt->id_daftar_menu?>,p" class="minimal" <?php if($dt->id_user == $id_user AND $dt->p == 1) echo 'checked';?>></td>
            </tr>
          <?php } ?>
          <?php foreach ($menu_user_out as $dt)
          { $i++;?>
            <tr>
              <td><?=$dt->menu.' ---> '.$dt->submenu?></td>
              <td align="center"><input type="checkbox" name="hak<?=$i?>[]" value="<?=$dt->id_daftar_menu?>,c" class="minimal"></td>
              <td align="center"><input type="checkbox" name="hak<?=$i?>[]" value="<?=$dt->id_daftar_menu?>,r" class="minimal"></td>
              <td align="center"><input type="checkbox" name="hak<?=$i?>[]" value="<?=$dt->id_daftar_menu?>,u" class="minimal"></td>
              <td align="center"><input type="checkbox" name="hak<?=$i?>[]" value="<?=$dt->id_daftar_menu?>,d" class="minimal"></td>
              <td align="center"><input type="checkbox" name="hak<?=$i?>[]" value="<?=$dt->id_daftar_menu?>,p" class="minimal"></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
      <input type="hidden" value="<?=$id_user?>,<?=$i?>" name="info">
    </form>
    <!-- /.row -->
</div>
  </section>
  <!-- /.content -->
</div>

        <!-- page content -->

        <!-- /page content -->

        <!-- footer content -->
<?php include 'includefile/foot.php'; ?>
