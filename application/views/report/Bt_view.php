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

            <div class="">

            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><i class="fa fa-square-o"></i> LAPORAN BUDGET</h2>
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
                <div class="x_content">

                  <!-- modals -->
                  <!-- Large modal -->
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".ebs-example-modal-lg"><i class="fa fa-filter"></i> Filter</button>
  <hr />
                  <div class="modal fade ebs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Filter Laporan Budget Plant</h4>
                        </div>
                        <div class="modal-body">

                          <form class="form-horizontal form-label-left" novalidate method="post" action="<?=site_url('bt/cetakfilter')?>">

                          <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanggal Awal
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                              <input id="name" class="form-control col-md-3 col-xs-12" value="" name="tgl_awal" placeholder="" required="required" type="date">
                            </div>
                          </div>

                          <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanggal Akhir
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                              <input id="name" class="form-control col-md-3 col-xs-12" value="" name="tgl_akhir" placeholder="" required="required" type="date">
                            </div>
                          </div>

                          <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Divisi
                            </label>

                              <div class="col-md-4 col-xs-12">
                                <select class="form-control" name="id_plant" >
                                  <?php foreach ($data_divisi as $dt)
                                  {
                                    echo '<option value="'.$dt->id_divisi.'">'.$dt->nama.'</option>';
                                  }
                                  ?>
                                </select>
                              </div>

                          </div>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-arrow-circle-o-left"></i> Batal</button>
                          <button type="button" class="btn btn-primary"><i class="fa fa-print"></i> Preview</button>
                        </div>

                      </div>
                    </div>
                  </div>



                  <!-- /modals -->
                </div>
              </div>
            </div>




          </div>
          <div class="clearfix"></div>
        </div>
        <!-- /page content -->

<?php include 'footer.php'; ?>
