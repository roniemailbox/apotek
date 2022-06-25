<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('Model_app');
        $this->load->model('umum/Bis_model');
    }

    function index(){
      $id= get_cookie('eklinik');
      if(empty($this->session->userdata('email'.$id))
      OR empty($this->session->userdata('password'.$id)))
      {
        $this->load->model('Login_m');
        $this->load->view('Login');
      }
      else
      {
        $user = array
          (
              'email' => $this->session->userdata('email'.$id),
              'password' => $this->session->userdata('password'.$id),
          );
        $usr = $this->db->get_where('user',$user)->num_rows();
        if($usr < 1)
        {
          $this->load->model('Login_m');
          //$data['jabatan'] = $this->Login_m->get_jabatan();
          $this->load->view('Login', $data);
        }
        else
        {
          $cookie_id_user = get_cookie('eklinik');
          $now = date('Y-m-d H:i:s');
          $data=array(
                    'id_user'=>  $cookie_id_user,
                    'modul'=>'KLINIK',
                    'date'=>$now,
          );
          //$this->load->model('umum/Bis_model');
          $this->db->trans_begin();
          $this->Bis_model->insertData('log_history',$data);
          if ($this->db->trans_status() === FALSE)
          {
                  $this->db->trans_rollback();
          }
          else
          {
                  $this->db->trans_commit();
          }

          redirect(site_url('Utama'));
        }
      }

    }

    function cek_login() {
      {
        $xuser=$this->input->post('email');
        $xpass=$this->input->post('password');

        $kondisi = array
          (
              'email' => $this->input->post('email'),
              'password' => $this->input->post('password')

          );
        $jml = $this->db->get_where('user',$kondisi)->num_rows();
        $xusername=$this->input->post('username');
        $x_query="SELECT u.id_user,
                                    u.username,
                                    u.email,
                                    u.`password`,
                                    u.id_pegawai,
                                    u.foto,
                                    ms_pegawai.nama,
                                    mastersubunit.kd_sub_unit,
                                    mastersubunit.nama_sub_unit,
                                    ms_jenis.nama AS nama_jenis,
                                    ms_jabatan.nama AS nama_jabatan,
                                    ms_jenis.id_jenis,
                                    ms_jabatan.id_jabatan,
                                    masterunit.nama_unit,
                                    ms_perusahaan.nama AS nama_perusahaan,
                                    ms_perusahaan.alias AS alias_perusahaan,
                                    ms_perusahaan.alamat AS alamat_perusahaan,
                                    ms_perusahaan.kota AS kota_perusahaan,
                                    ms_perusahaan.telepon AS telepon_perusahaan,
                                    ms_perusahaan.email AS email_perusahaan,
                                    ms_perusahaan.fax AS fax_perusahaan,
                                    ms_perusahaan.siup AS siup_perusahaan,
                                    ms_perusahaan.npwp AS npwp_perusahaan,
                                    ms_perusahaan.diskripsi AS diskripsi_perusahaan,
                                    ms_perusahaan.id_perusahaan,
                                    IFNULL(tbl_galeri.gambar,'user.png') AS foto_pic,
                                    masterunit.kd_unit,
                                    ms_pegawai.tgl_masuk
                                    FROM
                                    `user` AS u
                                    INNER JOIN ms_pegawai ON u.id_pegawai = ms_pegawai.id_pegawai
                                    LEFT JOIN mastersubunit ON ms_pegawai.id_subunit = mastersubunit.kd_sub_unit
                                    INNER JOIN ms_jenis ON ms_pegawai.id_jenis = ms_jenis.id_jenis
                                    INNER JOIN ms_jabatan ON ms_pegawai.id_jabatan = ms_jabatan.id_jabatan
                                    INNER JOIN masterunit ON mastersubunit.kd_unit = masterunit.kd_unit
                                    INNER JOIN ms_perusahaan ON masterunit.id_perusahaan = ms_perusahaan.id_perusahaan
                                    LEFT JOIN tbl_galeri ON u.id_user = tbl_galeri.judul
                                  WHERE u.email = '$xuser' AND u.`password` = '$xpass'";
                                  $data = $this->db->query($x_query)->result();

                                  //echo $x_query;
        if($jml > 0)
        {
          foreach($data as $user)
          {
            $data_session = array
              (
                'id_user'.$user->id_user => $user->id_user,
                'id_pegawai'.$user->id_user => $user->id_pegawai,
                'email'.$user->id_user => $user->email,
                'password'.$user->id_user => $user->password,
                'nama'.$user->id_user => $user->nama,
                'id_jabatan'.$user->id_user => $user->id_jabatan,
                'kd_unit'.$user->id_user => $user->kd_unit,
                'kd_sub_unit'.$user->id_user => $user->kd_sub_unit,
                'nama_jabatan'.$user->id_user => $user->nama_jabatan,
                'nama_jenis'.$user->id_user => $user->nama_jenis,
                'nama_unit'.$user->id_user => $user->nama_unit,
                'nama_sub_unit'.$user->id_user => $user->nama_sub_unit,
                'nama_perusahaan'.$user->id_user=>$user->nama_perusahaan,
                'alias_perusahaan'.$user->id_user=>$user->alias_perusahaan,
                'alamat_perusahaan'.$user->id_user=>$user->alamat_perusahaan,
                'kota_perusahaan'.$user->id_user=>$user->kota_perusahaan,
                'telepon_perusahaan'.$user->id_user=>$user->telepon_perusahaan,
                'fax_perusahaan'.$user->id_user=>$user->fax_perusahaan,
                'email_perusahaan'.$user->id_user=>$user->email_perusahaan,
                'npwp_perusahaan'.$user->id_user=>$user->npwp_perusahaan,
                'siup_perusahaan'.$user->id_user=>$user->siup_perusahaan,
                'diskripsi'.$user->id_user=>$user->diskripsi_perusahaan,
                'foto_pic'.$user->id_user=>$user->foto_pic,
                'id_jenis'.$user->id_user=>$user->id_jenis,
                'tgl_masuk'.$user->id_user=>$user->tgl_masuk,

              );

            $this->session->set_userdata($data_session);
            set_cookie('eklinik', $user->id_user, 13000);
            $now = date('Y-m-d H:i:s');
            $xd_user = $user->id_user;
            $data=array(
                      'id_user'=>  $xd_user,
                      'modul'=>'Klinik',
                      'date'=>$now,
            );
            //$this->load->model('umum/Bis_model');
            $this->db->trans_begin();
            $this->Bis_model->insertData('log_history',$data);
            if ($this->db->trans_status() === FALSE)
            {
                    $this->db->trans_rollback();
            }
            else
            {
                    $this->db->trans_commit();
            }
            redirect(site_url('Utama'));
          }

        }
        else
        {
          $this->load->model('Login_m');
          //$data['pass_salah'] = "CEK PASSWORD";
          //$data['jabatan'] = $this->Login_m->get_jabatan();
          $data=array(
              'salah'=>'Salah Password',

          );
          $this->load->view('Login', $data);
        }
      }
    }

    function logout() {
        //$this->session->unset_userdata('ID');
        //  $this->session->unset_userdata('EMAIL');
        //$this->session->unset_userdata('PASS');
        //$this->session->unset_userdata('NAME');
        //$this->session->unset_userdata('LEVEL');
        //$this->session->unset_userdata('login_status');
        //$this->session->set_flashdata('notif','Terima Kasih dan Semangat Bekerja');
        //redirect('login');
        $this->session->sess_destroy();
        redirect(site_url('Login'));
    }
}
