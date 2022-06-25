<?php include 'Validasi.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?=$this->session->userdata('jabatan'.$id)?></title>

    <!-- Bootstrap -->
   <link href="<?=site_url('/')?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Font Awesome -->
   <link href="<?=site_url('/')?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
   <!-- NProgress -->
   <link href="<?=site_url('/')?>vendors/nprogress/nprogress.css" rel="stylesheet">
   <!-- iCheck -->
   <link href="<?=site_url('/')?>vendors/iCheck/skins/flat/green.css" rel="stylesheet">
   <!-- Datatables -->
   <link href="<?=site_url('/')?>vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
   <link href="<?=site_url('/')?>vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
   <link href="<?=site_url('/')?>vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
   <link href="<?=site_url('/')?>vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
   <link href="<?=site_url('/')?>vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

   <!-- Custom Theme Style -->
   <link href="<?=site_url('/')?>build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-sm">
    <div class="container body">
      <div class="main_container">

        <?php include 'menu.php'; ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Ubah User</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <form class="form-horizontal form-label-left" novalidate method="post" action="<?=site_url('User/ubah')?>">
                      <?php foreach ($users as $dt) { ?>
                        <input type="hidden" name="id_user" value="<?=$dt->id_user?>">

                       
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" name="name" value="<?=$dt->nama?>" placeholder="" required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" name="email" value="<?=$dt->email?>" placeholder="" required="required" type="email" readonly>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Password
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" name="password" value="<?=$dt->password?>" placeholder="" required="required" type="password">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jabatan</label>
                        <div class="col-md-4 col-xs-12">
                          <select class="form-control" name="id_jabatan">
                            <option value="<?=$dt->id_jabatan?>"><?=$dt->nama_jabatan?></option>
                            <?php foreach ($jabatan as $dt1)
                            {
                              echo '<option value="'.$dt1->id_jabatan.'">'.$dt1->nama.'</option>';
                            }?>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Foto
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" name="foto" value="<?=$dt->foto?>" placeholder="" type="text" readonly> *hanya dapat diubah oleh user yang bersangkutan
                        </div>
                      </div>
                      </div>
                      <div class="modal-footer">
                        <a href=<?=site_url('User')?> class="btn btn-default">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                      <?php } ?>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Copyright @ 2018
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?=site_url('/')?>vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?=site_url('/')?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?=site_url('/')?>vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?=site_url('/')?>vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="<?=site_url('/')?>vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="<?=site_url('/')?>vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?=site_url('/')?>vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?=site_url('/')?>vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?=site_url('/')?>vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?=site_url('/')?>vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?=site_url('/')?>vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?=site_url('/')?>vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?=site_url('/')?>vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?=site_url('/')?>vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?=site_url('/')?>vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?=site_url('/')?>vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?=site_url('/')?>vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?=site_url('/')?>vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?=site_url('/')?>vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?=site_url('/')?>vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- validator -->
    <script src="<?=site_url('/')?>vendors/validator/validator.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?=site_url('/')?>build/js/custom.min.js"></script>
  </body>
</html>
