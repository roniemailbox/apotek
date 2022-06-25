<?php include 'includefile/head.php'; ?>
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <h1>
      Profil
       <small>Data Table</small>
     </h1>
     <ol class="breadcrumb">
       <li><a href="<?php echo site_url('Utama') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
       <li><a href="#"><?php //echo $xmenu ?></a></li>
       <li class="active"><?php //echo $xsubmenu ?></li>
     </ol>
   </section>

   <!-- Main content -->
   <section class="content">

<form id="submit" class="form-horizontal form-label-left" novalidate method="post" action="<?=site_url('Profil/ubah')?>">
  <?php
  if (isset($data_profil)){
    foreach ($data_profil as $dt) { ?>
    <div class="row">
      <!-- left column -->
      <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Ganti Pasword dan Foto Profil</h3>
            </div>
                  <div class="box-body">


                    <input type="hidden" name="id_user" value="<?=$dt->id_user?>">

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




                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <h4 class="box-title">Selanjutnya.....</h4>
                </div>
                <!-- /.box-footer -->

            </div>

      </div>

      <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Informasi Lanjutan</h3>
            </div>
    <!-- /.box-header -->
    <!-- form start -->

                <div class="box-body">
                  <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">ID
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="judul" class="form-control" value="<?=$dt->id_user?>" placeholder="Judul" readonly>
                  </div>
                  </div>

                  <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">File Foto
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" name="file">
                  </div>
                  </div>





<!--
                  <div class="modal-footer">
                    <button class="btn btn-success" id="btn_upload" type="submit">Upload</button>
                  </div>
-->
                <div class="modal-footer">
                 <a href=<?=site_url('User')?> class="btn btn-default"><i class="fa fa-arrow-circle-o-left"></i> Batal</a>
                 <button id="btn_upload" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update</button>
                </div>


                </div>



            </div>

      </div>

    </div>

<?php }}?>

   </form>
     <!-- /.row -->
   </section>
   <!-- /.content -->
 </div>


        <!-- /page content -->
        <script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.2.1.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
        <script type="text/javascript">
        	$(document).ready(function(){

        		$('#submit').submit(function(e){
        		    e.preventDefault();
        		         $.ajax({
        		             url:'<?php echo base_url();?>Profil/ubah',
        		             type:"post",
        		             data:new FormData(this),
        		             processData:false,
        		             contentType:false,
        		             cache:false,
        		             async:false,
        		             success: function(data)
                         {
        		                  alert("Upload Image Berhasil....");
        		             }
        		         });
        		    });


        	});

        </script>
<?php include 'includefile/foot.php'; ?>
