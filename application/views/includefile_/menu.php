<?php $id = get_cookie('eklinik'); ?>
<!-- Sidebar user panel -->
<div class="user-panel">
    <div class="pull-left image">
        <img src="<?php echo base_url(); ?>assets/foto/<?php echo $this->session->userdata('foto_pic'.$id); ?>" class="img-circle" alt="User Image" />
    </div>
    <div class="pull-left info">
        <p><?php echo strtoupper($this->session->userdata('nama'.$id)); ?></p>


        <div id="txt"></div>
    </div>
</div>

<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>

    <?php foreach ($menu as $m1)
    {
      ?>
      <?php if($m1->submenu != "") {?>

        <li class="treeview">
            <a href="#">
                <i class="fa <?=$m1->icon?>"></i> <span><?=$m1->menu?></span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <?php foreach ($submenu as $m2)
              {
                if($m1->menu == $m2->menu)
                {

                  echo '<li><a href="'.site_url('/'.$m2->link).'"><i class="fa fa-circle-o"></i> '.$m2->submenu.'</a></li>';
                }
              }
              ?>

            </ul>
          <?php } else { ?>
            <li><a href="<?= site_url('/'.$m1->link)?>"><i class="fa <?=$m1->icon?>"></i> <?=$m1->menu?> </span></a>
          <?php } ?>

        </li>

      <?php
    }
    ?>



</ul>
