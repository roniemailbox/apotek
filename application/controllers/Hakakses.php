<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hakakses extends CI_Controller
{
  function __construct(){
        parent::__construct();
        $this->load->model('Menu_m');
        $this->load->model('Hak_Akses_m');
        $this->load->model('Login_m');
        $this->load->model('umum/Bis_model');
  }
  function index()
  {
    $id = get_cookie('eklinik');

    $data['jabatan'] = $this->Login_m->get_jabatan();
    //$data['users'] = $this->Hak_Akses_m->get_user();
    $query_data="SELECT
                	u.id_user,
                	u.email,
                	u.`password`,
                	UPPER(ms_pegawai.nama) AS nama_pegawai,
                	ms_jabatan.nama AS nama_jabatan,
                	ms_jabatan.id_jabatan,
                	ms_pegawai.id_pegawai,
                	ms_jenis.nama AS nama_jenis,
                	mastersubunit.nama_sub_unit,
                	masterunit.nama_unit
                FROM
                	`user` AS u
                LEFT JOIN ms_pegawai ON u.id_pegawai = ms_pegawai.id_pegawai
                LEFT JOIN ms_jabatan ON ms_pegawai.id_jabatan = ms_jabatan.id_jabatan
                LEFT JOIN ms_jenis ON ms_pegawai.id_jenis = ms_jenis.id_jenis
                INNER JOIN mastersubunit ON ms_pegawai.id_subunit = mastersubunit.kd_sub_unit
                INNER JOIN masterunit ON mastersubunit.kd_unit = masterunit.kd_unit
                ORDER BY
                	u.id_user ASC,
                	ms_pegawai.id_pegawai ASC,
                	ms_pegawai.nama ASC";


    $data=array(
        'title'=>'Data Login',
        'xmenu'=>'Akses',
        'xsubmenu'=>'Atur Hak Akses',
        //'data_pegawai'=>$this->Bis_model->manualQuery($data_avail),
        'data_user' => $this->Bis_model->manualQuery($query_data),
        'users'=>$this->Hak_Akses_m->get_user(),
        'menu'=>$this->Menu_m->get_menu($id),
        'submenu'=>$this->Menu_m->get_submenu($id),
    );
    $this->load->view('hak_akses_v',$data);
  }
  function edit($id_user)
  {
    $id = get_cookie('eklinik');
    $this->load->model('Menu_m');
    $this->load->model('Hak_Akses_m');

    $data['users'] = $this->Hak_Akses_m->get_user_id($id_user);
    $data['menu_user_in'] = $this->Menu_m->get_menu_user_in($id_user);
    $data['menu_user_out'] = $this->Menu_m->get_menu_user_out($id_user);
    $data['menu'] = $this->Menu_m->get_menu($id);
    $data['submenu'] = $this->Menu_m->get_submenu($id);
    $this->load->view('Hak_Akses_v2',$data);
  }
  function update_hak()
  {
    $data = explode(',',$this->input->post('info'));
    $id_user = $data[0];
    $menu = $data[1];
    $this->load->model('Hak_Akses_m');
    $this->Hak_Akses_m->hapus_hak_akses($id_user);
    $id_menu = 0;
    for($i = 1; $i <= $menu; $i++)
    {
      $hak = $this->input->post('hak'.$i.'[]');
      if($hak != NULL)
      {
        $c = 0; $r = 0; $u = 0; $d = 0; $p = 0;
        foreach ($hak as $dt)
        {
          $data = explode(',',$dt);
          $id_menu = $data[0];
          if($data[1] == 'c') { $c = 1; }
          if($data[1] == 'r') { $r = 1; }
          if($data[1] == 'u') { $u = 1; }
          if($data[1] == 'd') { $d = 1; }
          if($data[1] == 'p') { $p = 1; }
        }
        $this->Hak_Akses_m->insert_hak($id_user,$c,$r,$u,$d,$p,$id_menu);
      }
    }
    redirect(site_url('hakakses'));
  }
}
?>
