 <?php
                 if(isset($detail_data))
                    {
                      foreach ($detail_data as $row)
                         {  ?>
                           <div class="item form-group">
                             <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Jatuh Tempo
                             </label>
                             <div class="col-md-3 col-sm-6 col-xs-12">
                               <input class="form-control col-md-3 col-xs-12" name="top" value="<?php   echo $row->top; ?>" placeholder="Jatuh Tempo" type="number">
                             </div>
                           </div>

                                      <div class="form-group">
                                               <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat
                                               </label>
                                               <div class="col-md-8 col-sm-6 col-xs-12">
                                                       <input class="form-control col-md-8 col-xs-12" id="nama" value="<?php echo $row->alamat; ?>" placeholder="Alamat" type="text" name="nama" readonly>
                                               </div>
                                      </div>

<?php }
                      }
                    ?>
