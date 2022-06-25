<?php include 'includefile/head.php'; ?>

<?php
if (isset($data_profil)){
  foreach ($data_profil as $dt) { ?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Ganti Username dan Password</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="">
              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                <div class="x_title">
                   <h2>Detail <small>Info User</small></h2>
                   <ul class="nav navbar-right panel_toolbox">
                     <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>


                   </ul>


                   <div class="clearfix"></div>
                 </div>
                  <div class="x_content">
                    <form id="submit" class="form-horizontal form-label-left" novalidate method="post" action="<?=site_url('Profil/ubah')?>">

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




                  <!--  </form> -->
                </div>
              </div>
            </div>
          </div>


          <div class="">
            <div class="col-md-6 col-sm-12 col-xs-12">
              <div class="x_panel">
              <div class="x_title">
                 <h2>Upload <small>Foto User</small></h2>
                 <ul class="nav navbar-right panel_toolbox">
                   <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>


                 </ul>


                 <div class="clearfix"></div>
               </div>
                <div class="x_content">
              <!--    <form class="form-horizontal" id="submit"> -->

                    <div class="form-group">
            					<input type="text" name="judul" class="form-control" value="<?=$dt->id_user?>" placeholder="Judul" readonly>
            				</div>
                    <div class="form-group">
            					<input type="file" name="file">
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

                  </form>
              </div>
            </div>
          </div>
        </div>
        </div>
<div class="clearfix"></div>
        </div>

        <?php
          }
       } ?>
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
