 <?php
                 if(isset($detail_data))
                    {
                      foreach ($detail_data as $row)
                         {  ?>
                           <div class="form-group">
                                               <label class="control-label col-md-3 col-sm-3 col-xs-12">Barcode</label>

                              <div class="col-md-4 col-sm-6 col-xs-12">
                                                       <input class="form-control col-md-4 col-xs-12" value="<?php echo $row->barcode; ?>" id="barcode" placeholder="Barcode" type="text" name="barcode" readonly>
                                               </div>
                                   </div>

                                      <div class="form-group">
                                               <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Barang
                                               </label>
                                               <div class="col-md-8 col-sm-6 col-xs-12">
                                                       <input class="form-control col-md-8 col-xs-12" id="nama" value="<?php echo $row->nama_barang; ?>" placeholder="Nama Produk" type="text" name="nama" readonly>
                                               </div>
                                      </div>
                                      <div class="form-group">
                                               <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Alias
                                               </label>
                                               <div class="col-md-8 col-sm-6 col-xs-12">
                                                       <input class="form-control col-md-8 col-xs-12" id="nama_alias" value="<?php echo $row->nama_alias; ?>" placeholder="Nama Alias"ctype="text" name="nama_alias" readonly>
                                               </div>
                                      </div>



                                      <div class="form-group">
                                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Ppn
                                         </label>

                                           <div class="col-md-4 col-xs-12">
                                             <select class="form-control select2" name="ppn">
                                               <option value="<?php echo $row->ppn; ?>"><?php echo $row->ppn; ?></option>

                                             </select>
                                           </div>

                                      </div>

                                      <div class="form-group">
                                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kategori
                                         </label>

                                           <div class="col-md-4 col-xs-12">
                                             <select class="select2 form-control" name=" id_kategori" required>
                                               <option value="<?php echo $row->id_kategori; ?>"><?php echo $row->nama_kategori; ?></option>

                                             </select>
                                           </div>

                                       </div>
                                      <div class="form-group">
                                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Merk
                                         </label>

                                           <div class="col-md-4 col-xs-12">
                                             <select class="select2 form-control" name=" id_merk" required>
                                               <option value="<?php echo $row->merk; ?>"><?php echo $row->merk; ?></option>

                                             </select>
                                           </div>

                                       </div>

                                        <div class="form-group">
                                           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Jenis
                                           </label>

                                             <div class="col-md-4 col-xs-12">
                                               <select class="select2 form-control" name="id_jenis">
                                                 <option value="<?php echo $row->id_jenis; ?>"><?php echo $row->nama_jenis; ?></option>
                                                 <?php foreach ($data_jenis as $row)
                                                 {
                                                   echo '<option value="'.$row->id_jenis.'">'.$row->nama.'</option>';
                                                 }
                                                 ?>
                                               </select>
                                             </div>

                                         </div>

                                         <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tipe
                                            </label>

                                              <div class="col-md-4 col-xs-12">
                                                <select class="select2 form-control" name="id_tipe">
                                                  <option value="<?php echo $row->id_tipe; ?>"><?php echo $row->nama_tipe; ?></option>

                                                </select>
                                              </div>

                                          </div>



                                      <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Harga Beli</label>
                                        <div class="col-md-4 col-sm-6 col-xs-12">

                                           <input id="top" placeholder="Harga Beli" class="form-control col-md-4 col-xs-12" value="<?php //echo $row->keterangan; ?>" type="number" name="harga_beli" readonly>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Harga Jual</label>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                           <input id="top" placeholder="Harga Jual" class="form-control col-md4 col-xs-12" value="<?php //echo $row->keterangan; ?>" type="number" name="harga_jual" readonly>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Satuan</label>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                          <select class="select2 form-control" name="id_satuan">
                                            <option value="<?php echo $row->id_satuan; ?>"><?php echo $row->nama_satuan; ?></option>

                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Aktif
                                        </label>

                                        <div class="col-md-4 col-xs-12">
                                          <select class="form-control select2 col-md-12" name="id_status_aktif" required>
                                            <option value="<?php echo $row->id_status_aktif; ?>"><?php echo $row->nama_status_aktif; ?></option>

                                          </select>
                                        </div>

                                      </div>
                        <?php }
                      }
                    ?>
