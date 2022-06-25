<?php include 'header.php'; ?>


        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3> </h3>
              </div>


            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-square-o"></i> DATA BUDGET AWAL</h2>


                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>

                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-filter"></i> Filter</button>
                  <a href="<?php echo site_url('reportbudget/exportexcel'); ?>" class="btn btn-success"><i class="fa fa-file-excel-o"></i>  Export To Excel</a>
                  <a href="<?php echo site_url('reportbudget/cetak'); ?>" target="_blank" class="btn btn-success"><i class="fa fa-print"></i> Print</a>

                  <hr />
                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>

                          <th>NO</th>
                          <th>DIVISI</th>
                          <th>DEPARTEMEN</th>
                          <th>BEBAN</th>
                          <th>TAHUN</th>
                          <th>BUDGET 1 TAHUN</th>
                          <th>BUDGET PER BULAN</th>
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
        if(isset($data_budget))
           {
             foreach ($data_budget as $row)
                { ?>

                <tr>

                <td><?php echo $no++; ?></td>
                <td><?php echo $row->nama_divisi; ?></td>
                <td><?php echo $row->nama_departement; ?></td>
                  <td><?php echo $row->nama_beban; ?></td>
                <td><?php echo $row->tahun; ?></td>
                <td><?php echo currency_format($row->nilai_budget_tahunan); ?></td>
                <td><?php echo currency_format($row->nilai_budget_bulanan); ?></td>
                 <!--
                 <a class="btn btn-mini" href="#modalEditBarang<?php // echo $row->kd_barang?>" data-toggle="modal"><i class="icon-pencil"></i> Edit</a>
                 <a class="btn btn-mini" href="<?php // echo site_url('master/hapus_barang/'.$row->kd_barang);?>"
                    onclick="return confirm('Anda yakin?')"> <i class="icon-remove"></i> Hapus</a>
                 -->

                </tr>

          <?php }
          }
          ?>

          <!-- MODAL EDIT DATA -->


                      </tbody>
                    </table>
                    <!-- modals -->
                    <!-- Large modal -->
    <hr />

                    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h2 class="modal-title" id="myModalLabel">Filter Laporan Budget Tahunan</h2>
                          </div>

                          <div class="modal-body">

                            <form class="form-horizontal form-label-left" target="_blank" novalidate method="post" action="<?=site_url('reportbudget/filter')?>">

                            <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Divisi
                              </label>
                                <div class="col-md-4 col-xs-12">
                                  <select class="form-control" name="id_divisi" >
                                    <option value="">- pilih -</option>
                                    <?php foreach ($data_divisi as $dt)
                                    {
                                      echo '<option value="'.$dt->id_divisi.'">'.$dt->nama.'</option>';
                                    }
                                    ?>
                                  </select>
                                </div>
                            </div>
                            <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Departement
                              </label>
                                <div class="col-md-4 col-xs-12">
                                  <select class="form-control" name="id_departement">
                                    <option value="">- pilih -</option>
                                    <?php foreach ($data_departement as $dt)
                                    {
                                      echo '<option value="'.$dt->id_departement.'">'.$dt->nama.'</option>';
                                    }
                                    ?>
                                  </select>
                                </div>
                            </div>
                            <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Beban
                              </label>
                                <div class="col-md-4 col-xs-12">
                                  <select class="form-control" name="id_plant" >
                                    <option value="">- pilih -</option>
                                    <?php foreach ($data_beban as $dt)
                                    {
                                      echo '<option value="'.$dt->id_beban.'">'.$dt->nama.'</option>';
                                    }
                                    ?>
                                  </select>
                                </div>
                            </div>
                            <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tahun</label>
                              <div class="col-md-2 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-2 col-xs-12" value="" name="tahun" placeholder="" required="required" type="number">
                                </div>
                            </div>

                          </div>

                          <div class="modal-footer">
                              <button type="button" class="btn" data-dismiss="modal" aria-hidden="true"><i class="fa fa-arrow-circle-o-left"></i> Batal</button>
                              <button type="submit" class="btn btn-primary">Preview</button>
                          </div>

                          </form>

                        </div>
                      </div>
                    </div>

                    <!-- Small modal
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Small modal</button>

                    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">

                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel2">Modal title</h4>
                          </div>
                          <div class="modal-body">
                            <h4>Text in a modal</h4>
                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                          </div>

                        </div>
                      </div>
                    </div>
                     -->
                    <!-- /modals -->
                  </div>
                </div>
              </div>
            </div>




          </div>
          <div class="clearfix"></div>
        </div>
        <!-- /page content -->

<?php include 'footer.php'; ?>
