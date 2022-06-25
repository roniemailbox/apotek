<?php include 'includefile/Header.php'; ?>


   <!-- page content -->
 <div class="right_col" role="main">


       <div class="page-title">
         <div class="title_left">
           <h3>KARTU STOK</h3>
         </div>
       </div>
     <div class="clearfix"></div>


     <div class="row">
      <div class="col-md-12 col-sm-6 col-xs-12">

        <div class="x_panel">

          <div class="x_content">


            <div class="item form-group">
              <script type="text/javascript">
                  $(document).ready(function() {

                      $("#no_po").change(function(){

                          var no_po = $("#no_po").val();

                          $.ajax({
                              type: "POST",
                              url: "<?php echo base_url('index.php/Bpb/get_data_barang'); ?>",
                              data: "no_po="+no_po,
                              cache:false,
                              success: function(data){
                                $('#tampilspp').html(data);
                              }

                          });

                        }

                     );

                  })
              </script>

              <label class="control-label col-md-8 col-sm-3 col-xs-12" for="name">PILIH ITEM
              </label>
              <div class="col-md-12 col-sm-6 col-xs-12">
                <select class="js-example-basic-single col-sm-12 form-control" id="no_po" name="no_po" required>
                  <option value="">- pilih -</option>
                  <?php
                  if(isset($data_po))
                  {
                  foreach ($data_po as $row)
                  {
                  ?>
                       <option value="<?php echo $row->id_barang;?>"><?php echo $row->ket; ?></option>
                       <?php
                       }
                       }
                       ?>
                </select>

              </div>
            </div>






          </div>
        </div>
      </div>




     <div id="tampilspp"></div>

     </div>






     </div>

       <!-- /page content -->



<?php include 'includefile/Footer.php'; ?>
