<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
  function __construct(){
        parent::__construct();
        $this->load->model('umum/Bis_model');
        $this->load->model('Menu_m');
        $this->load->model('Hak_Akses_m');
        $this->load->model('Login_m');
        //$this->load->helper('currency_format_helper');

    }
  function index()
  {
    $id = get_cookie('eklinik');

    $data_avail="SELECT
        ms_pegawai.nama AS nama,
        ms_pegawai.id_pegawai
        FROM
        ms_pegawai
        where ms_pegawai.id_status_aktif=1 AND ms_pegawai.id_pegawai not in (select `user`.id_pegawai from `user`) order by ms_pegawai.nama";
    //$data['data_pegawai'] = $this->Bis_model->manualQuery($data_avail);

    $data['jabatan'] = $this->Login_m->get_jabatan();
    $query_data='SELECT
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
                LEFT JOIN mastersubunit ON ms_pegawai.id_subunit = mastersubunit.kd_sub_unit
                LEFT JOIN masterunit ON mastersubunit.kd_unit = masterunit.kd_unit
                ORDER BY
                	u.id_user ASC,
                	ms_pegawai.id_pegawai ASC,
                	ms_pegawai.nama ASC';



    $data=array(
        'title'=>'Data Login',
        'xmenu'=>'Akses',
        'xsubmenu'=>'User Akun',
        'data_pegawai'=>$this->Bis_model->manualQuery($data_avail),
        'data_user' => $this->Bis_model->manualQuery($query_data),
        'users'=>$this->Hak_Akses_m->get_user(),
        'menu'=>$this->Menu_m->get_menu($id),
        'submenu'=>$this->Menu_m->get_submenu($id),
    );

    $this->load->view('user_v',$data);
  }

    function daftar()
    {
      $now = date('Y-m-d H:i:s');
      $cookie_id_user = get_cookie('eklinik');
      $data=array(
        //'id_user'=>$this->input->post('id_user'),
        'email'=>$this->input->post('email'),
        'password'=>$this->input->post('password'),
        'id_pegawai'=>$this->input->post('id_pegawai'),
        'entry_user'=>$cookie_id_user,
        'entry_date'=>$now,
      );
      $this->db->trans_begin();
      $this->Bis_model->insertData('user',$data);
      if ($this->db->trans_status() === FALSE)
      {
              $this->db->trans_rollback();
      }
      else
      {
              $this->db->trans_commit();
              $this->session->set_flashdata('message', 'Sukses tambah user baru.');
              $this->session->set_flashdata('jenis', 'success');
              redirect(site_url('user'));
      }


    }

  function daftarX()
  {
    $this->load->model('Login_m');
    $data['daftar'] = $this->Login_m->register();
		$data['jabatan'] = $this->Login_m->get_jabatan();
    redirect(site_url('user'));
  }
  function hapusx()
  {
    $id['id_user'] = $this->uri->segment(3);
    $this->Bis_model->deleteData('user',$id);
    redirect(site_url('user'));
  }

  function hapus(){
      $id['id_user'] = $this->uri->segment(3);
      $this->db->trans_begin();
          $this->Bis_model->deleteData('user',$id);
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses delete.');
                $this->session->set_flashdata('jenis', 'danger');
                redirect(site_url('user'));
        }


  }
  function edit(){
      $id['id_user'] = $this->input->post('id_user');
      $now = date('Y-m-d H:i:s');
      $cookie_id_user = get_cookie('eklinik');
      $data=array(
        'email'=>$this->input->post('email'),
        'password'=>$this->input->post('password'),
        'id_pegawai'=>$this->input->post('id_pegawai'),
        'edit_user'=>$cookie_id_user,
        'edit_date'=>$now,
      );
      $this->db->trans_begin();
      $this->Bis_model->updateData('user',$data,$id);
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses edit data.');
                $this->session->set_flashdata('jenis', 'info');
                redirect(site_url('user'));
        }


  }

  function ubah()
  {
    $this->load->model('Login_m');
    $this->Login_m->update($this->input->post('id_user'));
    redirect(site_url('user'));
  }
}
?>
