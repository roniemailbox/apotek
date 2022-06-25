<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends CI_Controller
{
  function index()
  {
    $id = get_cookie('eklinik');
    $this->load->model('Menu_m');
    $data['menu'] = $this->Menu_m->get_menu($id);
    $data['submenu'] = $this->Menu_m->get_submenu($id);
    $this->load->view('Error_v',$data);
  }
}
?>
