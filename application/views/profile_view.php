<?php include 'includefile/Header.php'; ?>
<?php $id = get_cookie('tkkop'); ?>



<div class="right_col" role="main">
         <div class="">
           <div class="page-title">
             <div class="title_left">
               <h3>Profil Pegawai</h3>
             </div>
           </div>

           <div class="clearfix"></div>


           <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="x_panel">
                 <div class="x_title">
                   <h2>Laporan Pegawai <small>laporan aktifitas</small></h2>
                   <ul class="nav navbar-right panel_toolbox">
                     <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                     </li>
                     <li class="dropdown">
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                       <ul class="dropdown-menu" role="menu">
                         <li><a href="#">Settings 1</a>
                         </li>
                         <li><a href="#">Settings 2</a>
                         </li>
                       </ul>
                     </li>
                     <li><a class="close-link"><i class="fa fa-close"></i></a>
                     </li>
                   </ul>
                   <div class="clearfix"></div>
                 </div>
                 <div class="x_content">

                   <?php
                                      if(isset($data_pegawai))
                                         {
                                           foreach ($data_pegawai as $row)
                                              { ?>

                   <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                     <div class="profile_img">
                       <div id="crop-avatar">
                         <!-- Current avatar -->
                         <img class="img-responsive avatar-view" src="<?php echo base_url(); ?>build/images/<?php echo $row->foto_pic; ?>" alt="..." class="img-circle profile_img" alt="Avatar" title="Ganti Foto">

                       </div>
                     </div>
                     <h3><?php echo $row->nama_pegawai; ?></h3>

                     <ul class="list-unstyled user_data">
                       <li><i class="fa fa-map-marker user-profile-icon"></i> <?php echo " ".$row->nama_plant." - ".$row->nama_divisi." - ".$row->nama_departement; ?>
                       </li>

                       <li>
                         <i class="fa fa-briefcase user-profile-icon"></i> <?php echo " ".$row->nama_jabatan; ?>
                       </li>

                       <li class="m-top-xs">
                         <i class="fa fa-external-link user-profile-icon"></i>
                         <!-- <a href="http://www.kimlabs.com/profile/" target="_blank">www.kimlabs.com</a> -->
                       </li>
                     </ul>

                     <!-- <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a> -->
                     <br />

                     <!-- start skills -->
                     <h4>Skills</h4>
                     <ul class="list-unstyled user_data">
                        <li>
                          <p>Leadership</p>
                          <div class="progress progress_sm">
                            <div role="progressbar" data-transitiongoal="50"></div>
                          </div>
                        </li>
                        <li>
                          <p>Monitoring</p>
                          <div class="progress progress_sm">
                            <div role="progressbar" data-transitiongoal="70"></div>
                          </div>
                        </li>
                        <li>
                          <p>Enginering</p>
                          <div class="progress progress_sm">
                            <div role="progressbar" data-transitiongoal="30"></div>
                          </div>
                        </li>
                        <li>
                          <p>Others</p>
                          <div class="progress progress_sm">
                            <div role="progressbar" data-transitiongoal="50"></div>
                          </div>
                        </li>
                      </ul>
                     <!-- end of skills -->

                   </div>



                   <div class="col-md-9 col-sm-9 col-xs-12">

                     <div class="profile_title">
                       <div class="col-md-6">
                         <h2>Aktifitas Karyawan</h2>
                       </div>
                       <div class="col-md-6">

                       </div>
                     </div>
                     <!-- start of user-activity-graph -->

                     <!-- end of user-activity-graph -->

                     <div class="" role="tabpanel" data-example-id="togglable-tabs">
                       <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                         <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Terbaru</a>
                         </li>

                         <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profil</a>
                         </li>
                       </ul>
                       <div id="myTabContent" class="tab-content">
                         <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                           <!-- start recent activity -->
                           <ul class="messages">

                             <li>
                               <img src="<?php echo base_url(); ?>build/images/<?php echo $row->foto_pic; ?>" class="avatar" alt="Avatar">
                               <div class="message_date">
                                 <h3 class="date text-error">21</h3>
                                 <p class="month">May</p>
                               </div>
                               <div class="message_wrapper">
                                 <h4 class="heading">Join Date</h4>
                                 <blockquote class="message">Laporan pekerjaan disini.</blockquote>
                                 <br />
                                 <p class="url">
                                   <span class="fs1" aria-hidden="true" data-icon=""></span>
                                   <a href="#" data-original-title="">Download</a>
                                 </p>
                               </div>
                             </li>

                           </ul>
                           <!-- end recent activity -->

                         </div>

                         <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                           <p>Profile Karyawan bisa di isikan Histori </p>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>



               </div>
             </div>
           </div>

         </div>
       </div>

       <?php } } ?>
<?php include 'includefile/Footer.php'; ?>
