<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller
{
  function __construct(){
        parent::__construct();
        $this->load->model('umum/Bis_model');
        //$this->load->model('M_upload');
  }
  function index()
  {
    $id = get_cookie('eklinik');
    $this->load->model('Menu_m');
    $this->load->model('Login_m');
    //$data['jabatan'] = $this->Login_m->get_jabatan();
    $query_data="SELECT
          u.id_user,
          u.email,
          u.`password`,
          u.id_jabatan,
          ms_jabatan.nama as nama_jabatan
          FROM
          `user` AS u
          INNER JOIN ms_pegawai ON u.id_pegawai = ms_pegawai.id_pegawai
          INNER JOIN ms_jabatan ON ms_pegawai.id_jabatan = ms_jabatan.id_jabatan
          WHERE
          u.id_user = '$id'";
    $data['data_profil']=$this->Bis_model->manualQuery($query_data);
    //$data['users'] = $this->Login_m->get_user_edit($id);
    $data['menu'] = $this->Menu_m->get_menu($id);
    $data['submenu'] = $this->Menu_m->get_submenu($id);
    $this->load->view('Profil_v',$data);
  }



  function ubah()
  {
    //file
      $idx['judul'] = $this->input->post('judul');
      $judul= $this->input->post('judul');
      $config['upload_path']="./assets/foto";
      $config['allowed_types']='gif|jpg|png';
      $config['max_size']  = '1024';
      $config['encrypt_name'] = TRUE;
      $this->load->library('upload',$config);
      if($this->upload->do_upload("file"))
      {
        $this->Bis_model->deleteData('tbl_galeri',$idx);
        $data = array('upload_data' => $this->upload->data());
        $image= $data['upload_data']['file_name'];
        //$result= $this->M_upload->simpan_upload($judul,$image);
        $datag = array(
                 'judul' => $judul,
                 'gambar' => $image
                 );
        $this->Bis_model->insertData('tbl_galeri',$datag);

      }


      // update
      $id['id_user'] = $this->input->post('id_user');
      $now = date('Y-m-d H:i:s');
      $cookie_id_user = get_cookie('eklinik');
      $datax=array(
        'email'=>$this->input->post('email'),
        'password'=>$this->input->post('password'),
        'edit_user'=>$cookie_id_user,
        'edit_date'=>$now,
      );
      $this->db->trans_begin();
      $this->Bis_model->updateData('user',$datax,$id);

      if ($this->db->trans_status() === FALSE)
          {
            $this->db->trans_rollback();
            $this->session->set_flashdata('message', 'Gagal edit data.');
            $this->session->set_flashdata('jenis', 'info');
            redirect(site_url('profil'));
          }
      else
              {
                      $this->db->trans_commit();
                      $this->session->set_flashdata('message', 'Sukses edit data.');
                      $this->session->set_flashdata('jenis', 'info');
                      redirect(site_url('profil'));
              }


  }

}
?>
