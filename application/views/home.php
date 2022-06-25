<?php
$this->load->view('includefile/head.php');
$id = get_cookie('eklinik');
?>

<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <h1>
       <?php //echo $title ?>

     </h1>
     <ol class="breadcrumb">
       <li><a href="<?php echo site_url('Utama') ?>"><i class="fa fa-dashboard"></i> Home</a></li>

     </ol>
   </section>
  <!-- Main content -->
  <section class="content" >
    <br>
    <div class="row">
      <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php foreach($data_obat as $rowxx){
              echo number_format($rowxx->jml)."";
            } ?></h3>

            <p>Jumlah Item Obat</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php foreach($data_px as $rowxx){
              echo $rowxx->jml." Px";
            } ?></h3>

            <p>Database Pasien</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->

      <!-- ./col -->
      <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?php foreach($data_wo as $rowxx){
              echo $rowxx->jml." Px";
            } ?></h3>

            <p>Kunjungan Pasien</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
<br>
    <div class="row">


            <!-- /.col -->
            <div class="col-md-12">
              <!-- Widget: user widget style 1 -->
              <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-black">
                  <h3 class="widget-user-username"><?php echo strtoupper($this->session->userdata('nama'.$id)); ?></h3>
                  <h5 class="widget-user-desc"><?php echo strtoupper($this->session->userdata('nama_jabatan'.$id)); ?></h5>
                </div>
                <div class="widget-user-image">
                  <img class="img-circle" src="<?php echo base_url(); ?>assets/foto/<?php echo $this->session->userdata('foto_pic'.$id); ?>" alt="User Avatar">
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-sm-6 border-right">
                      <div class="description-block">
                        <h5 class="description-header"></h5>
                        <span class="description-text"></span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6 border-right">
                      <div class="description-block">
                        <h5 class="description-header"></h5>
                        <span class="description-text"></span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->

                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
              </div>
              <!-- /.widget-user -->
            </div>
            <!-- /.col -->
          </div>

          <script type="text/javascript" src="<?=base_url('/')?>build/source_ant/js/r_loader.js"></script>
          <script type="text/javascript">
          google.charts.load('current', {'packages':['line']});
          google.charts.setOnLoadCallback(drawChart);

          function drawChart() {

            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Bulan');
            data.addColumn('number', 'Poli Umum');
            data.addColumn('number', 'Poli Gigi');
            //data.addColumn('number', 'Transformers: Age of Extinction');

            data.addRows([
              <?php
                   foreach ($data_kun as $rowss)
              { ?>
                      [<?php echo $rowss->bulan; ?>,<?php echo $rowss->poli_umum; ?>,<?php echo $rowss->poli_gigi; ?>],
              <?php } ?>

              [,  0, 0]
            ]);

            var options = {
              chart: {
                title: 'Data kunjungan pasien / bulan',
                subtitle: 'Px'
              },
              colors: ['silver', 'gold'],
              width:'80%',
              height: '100%'
            };



            var chart = new google.charts.Line(document.getElementById('chartkunjungan'));

            chart.draw(data, google.charts.Line.convertOptions(options));
          }
          </script>
          <div class="row">

                  <div class="col-md-12">
                    <div class="box box-default">
                      <div class="box-header with-border">
                        <i class="fa fa-adjust"></i>

                        <h3 class="box-title">Grafik Kunjungan Pasien</h3>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <div id="chartkunjungan" style="height: 300px;"></div>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                  </div>
                  <script type="text/javascript" src="<?=base_url('/')?>build/source_ant/js/r_loader.js"></script>
                  <script type="text/javascript">
                  google.charts.load('current', {'packages':['line']});
                  google.charts.setOnLoadCallback(drawChart);

                  function drawChart() {

                    var data = new google.visualization.DataTable();
                    data.addColumn('number', 'Bulan');
                    data.addColumn('number', 'Laki-laki');
                    data.addColumn('number', 'Perempuan');
                    //data.addColumn('number', 'Transformers: Age of Extinction');

                    data.addRows([
                      <?php
                           foreach ($data_jk_bulanan as $rowc)
                      { ?>
                              [<?php echo $rowc->bulan; ?>,<?php echo $rowc->lk; ?>,<?php echo $rowc->pr; ?>],
                      <?php } ?>

                      [,  0, 0]
                    ]);

                    var options = {
                      chart: {
                        title: 'Data kunjungan pasien (JK) / bulan',
                        subtitle: 'Px'
                      },
                      width:'80%',
                      height: '100%'
                    };



                    var chart = new google.charts.Line(document.getElementById('chartkunjunganjk'));

                    chart.draw(data, google.charts.Line.convertOptions(options));
                  }
                  </script>
                  <div class="col-md-12">
                    <div class="box box-default">
                      <div class="box-header with-border">
                        <i class="fa fa-adjust"></i>

                        <h3 class="box-title">Grafik Kunjungan Pasien (JK)</h3>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <div id="chartkunjunganjk" style="height: 300px;"></div>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                  </div>
                  <!-- /.col -->


                  <!-- /.col -->
         </div>
    <div class="row">
            <div class="col-md-4">
              <div class="box box-default">
                <div class="box-header with-border">
                  <i class="fa fa-adjust"></i>

                  <h3 class="box-title">Grafik Jenis Kelamin</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div id="donutcharty" style="height: 330px;"></div>

                  <!-- load api   -->
                  <script type="text/javascript" src="<?=base_url('/')?>build/source_ant/js/r_loader.js"></script>
                  <script type="text/javascript">
                  google.charts.load("current", {packages:["corechart"]});
                  google.charts.setOnLoadCallback(drawChart);
                  function drawChart() {
                  var data = google.visualization.arrayToDataTable([
                  ['Task', 'Hours per Day'],
                  <?php
                       foreach ($data_jk as $row)
                  { ?>
                          ['<?php echo $row->jk; ?>',<?php echo $row->jumlah; ?>],
                  <?php } ?>
                  ['',0]
                  ]);

                  var options = {
                      title: 'Data Prosentase Jenis Kelamin',
                      is3D: true,
                    };

                  var chart = new google.visualization.PieChart(document.getElementById('donutcharty'));
                  chart.draw(data, options);
                  }
                  </script>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>

            <div class="col-md-4">
              <div class="box box-default">
                <div class="box-header with-border">
                  <i class="fa fa-adjust"></i>

                  <h3 class="box-title">Grafik Jenis Pasien</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div id="donutchartyz" style="height: 330px;"></div>

                  <!-- load api   -->
                  <script type="text/javascript" src="<?=base_url('/')?>build/source_ant/js/r_loader.js"></script>
                  <script type="text/javascript">
                  google.charts.load("current", {packages:["corechart"]});
                  google.charts.setOnLoadCallback(drawChart);
                  function drawChart() {
                  var data = google.visualization.arrayToDataTable([
                  ['Task', 'Hours per Day'],
                  <?php
                       foreach ($data_jenis_pasien as $row)
                  { ?>
                          ['<?php echo $row->nama_jenis_pasien; ?>',<?php echo $row->jumlah; ?>],
                  <?php } ?>
                  ['',0]
                  ]);

                  var options = {
                      title: 'Data Prosentase Jenis Pasien',
                      is3D: true,
                    };

                  var chart = new google.visualization.PieChart(document.getElementById('donutchartyz'));
                  chart.draw(data, options);
                  }
                  </script>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>

            <div class="col-md-4">
              <div class="box box-default">
                <div class="box-header with-border">
                  <i class="fa fa-adjust"></i>

                  <h3 class="box-title">Grafik Kunjungan Pasien</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div id="donutchartyxx" style="height: 330px;"></div>

                  <!-- load api   -->
                  <script type="text/javascript" src="<?=base_url('/')?>build/source_ant/js/r_loader.js"></script>
                  <script type="text/javascript">
                  google.charts.load("current", {packages:["corechart"]});
                  google.charts.setOnLoadCallback(drawChart);
                  function drawChart() {
                  var data = google.visualization.arrayToDataTable([
                  ['Task', 'Hours per Day'],
                  <?php
                       foreach ($data_kunjungan as $row)
                  { ?>
                          ['<?php echo $row->nama_poli; ?>',<?php echo $row->jumlah; ?>],
                  <?php } ?>
                  ['',0]
                  ]);

                  var options = {
                      title: 'Data Prosentase Kunjungan Poli',
                      is3D: true,
                    };

                  var chart = new google.visualization.PieChart(document.getElementById('donutchartyxx'));
                  chart.draw(data, options);
                  }
                  </script>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->


            <!-- /.col -->
          </div>

  </section>
  <!-- /.content -->
</div>
<!--tambahkan custom js disini-->
<!-- jQuery UI 1.11.2 -->


<?php
$this->load->view('includefile/foot.php');
?>
