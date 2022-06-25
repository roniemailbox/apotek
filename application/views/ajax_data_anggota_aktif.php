 <?php
                 if(isset($detail_anggota))
                    {
                      foreach ($detail_anggota as $row)
                         {  ?>
                           <div class="item form-group">
                             <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama
                             </label>
                             <div class="col-md-3 col-sm-6 col-xs-12">
                               <input class="form-control col-md-3 col-xs-12" name="top" value="<?php   echo $row->nama; ?>" placeholder="Jatuh Tempo" type="number">
                             </div>
                           </div>

                                      <div class="form-group">
                                               <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat
                                               </label>
                                               <div class="col-md-8 col-sm-6 col-xs-12">
                                                       <input class="form-control col-md-8 col-xs-12" id="nama" value="<?php echo $row->nik; ?>" placeholder="Alamat" type="text" name="nama" readonly>
                                               </div>
                                      </div>

<?php }
                      }
                    ?>
