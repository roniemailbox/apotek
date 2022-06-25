<?php
class Mspekerjaan extends CI_Controller{
  function __construct(){
        parent::__construct();
        $this->load->model('umum/Bis_model');
        $this->load->model('Menu_m');
        $this->load->model('Hak_Akses_m');
        $this->load->model('Login_m');

    }
  function index()
  {
    //'kd_barang'=>$this->model_app->getKodeBarang(),
    $id = get_cookie('dahanr');
    $query_pekerjaan="SELECT
                      	a.nama AS nama_pegawai,
                      	b.nama AS nama_edit_pegawai,
                      	UPPER(ms_pekerjaan.nama) as nama,
                      	ms_pekerjaan.edit_date,
                      	ms_pekerjaan.entry_date,
                      	ms_pekerjaan.id_pekerjaan
                      FROM
                      	ms_pekerjaan
                      	LEFT JOIN ms_penduduk AS a ON ms_pekerjaan.entry_user = a.ktp
                      	LEFT JOIN ms_penduduk AS b ON ms_pekerjaan.edit_user = b.ktp";
    $data=array(
        'perintah'=>'Baru',
        'title'=>'Daftar Pekerjaan',
        'title_filter'=>'Cari Pekerjaan',
        'title_tambah'=>'Input Pekerjaan Baru',
        'title_reporw'=>'Laporan Pekerjaan',
        'data_pekerjaan'=>$this->Bis_model->manualQuery($query_pekerjaan),
        'users'=>$this->Hak_Akses_m->get_user($id),
        'menu'=>$this->Menu_m->get_menu($id),
        'submenu'=>$this->Menu_m->get_submenu($id),
    );

    $this->load->view('Mspekerjaan_view',$data);
  }


  function ambiledit()
  {
    $id = get_cookie('dahanr');
    //$id_edit=$this->uri->segment(3);
    $id_edit=$this->input->post('id_pekerjaan');
    $query_pekerjaan="SELECT
                      	a.nama AS nama_pegawai,
                      	b.nama AS nama_edit_pegawai,
                      	UPPER(ms_pekerjaan.nama) as nama,
                      	ms_pekerjaan.edit_date,
                      	ms_pekerjaan.entry_date,
                      	ms_pekerjaan.id_pekerjaan
                      FROM
                      	ms_pekerjaan
                      	LEFT JOIN ms_penduduk AS a ON ms_pekerjaan.entry_user = a.ktp
                      	LEFT JOIN ms_penduduk AS b ON ms_pekerjaan.edit_user = b.ktp";

    $query_pekerjaan_edit="SELECT
                      	a.nama AS nama_pegawai,
                      	b.nama AS nama_edit_pegawai,
                      	UPPER(ms_pekerjaan.nama) as nama,
                      	ms_pekerjaan.edit_date,
                      	ms_pekerjaan.entry_date,
                      	ms_pekerjaan.id_pekerjaan
                      FROM
                      	ms_pekerjaan
                      	LEFT JOIN ms_penduduk AS a ON ms_pekerjaan.entry_user = a.ktp
                      	LEFT JOIN ms_penduduk AS b ON ms_pekerjaan.edit_user = b.ktp
                WHERE
                  ms_pekerjaan.id_pekerjaan='$id_edit'";


    $data=array(
        'perintah'=>'Edit',
        'title'=>'Daftar Pekerjaan',
        'title_filter'=>'Cari Pekerjaan',
        'title_tambah'=>'Edit Data Pekerjaan',
        'title_reporw'=>'Laporan Pekerjaan',
        'data_pekerjaan'=>$this->Bis_model->manualQuery($query_pekerjaan),
        'data_pekerjaan_edit'=>$this->Bis_model->manualQuery($query_pekerjaan_edit),

        'users'=>$this->Hak_Akses_m->get_user($id),
        'menu'=>$this->Menu_m->get_menu($id),
        'submenu'=>$this->Menu_m->get_submenu($id),
    );
    $this->load->view('Mspekerjaan_view',$data);
  }
//    ===================== INSERT =====================
    function tambah()
    {
      $now = date('Y-m-d H:i:s');
      $cookie_id_user = get_cookie('dahanr');
      $id_pekerjaan=str_replace(' ', '',$this->input->post('id_pekerjaan'));
      $data=array(
          'id_pekerjaan'=>$id_pekerjaan,
          'nama'=>$this->input->post('pekerjaan'),
          'entry_user'=>$cookie_id_user,
          'entry_date'=>$now,
      );


      $this->db->trans_begin();
      $this->Bis_model->insertData('ms_pekerjaan',$data);
      if ($this->db->trans_status() === FALSE)
      {
              $this->db->trans_rollback();
      }
      else
      {
              $this->db->trans_commit();
              $this->session->set_flashdata('message', 'Sukses tambah data.');
              $this->session->set_flashdata('jenis', 'success');
              redirect(site_url('Mspekerjaan'));
      }

      }

//    ======================== EDIT =======================
    function edit(){
        $id['id_pekerjaan'] = $this->input->post('id_pekerjaan');

        $now = date('Y-m-d H:i:s');
        $cookie_id_user = get_cookie('dahanr');
        $data=array(
          'nama'=>$this->input->post('pekerjaan'),
          'edit_user'=>$cookie_id_user,
          'edit_date'=>$now,
        );
        $this->load->model('umum/Bis_model');

        $this->db->trans_begin();
        $this->Bis_model->updateData('ms_pekerjaan',$data,$id);
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses edit data.');
                $this->session->set_flashdata('jenis', 'info');
                redirect(site_url('Mspekerjaan'));
        }

    }

//    ========================== DELETE =======================
    function hapus(){
        $id['id_pekerjaan'] = $this->uri->segment(3);
        $this->load->model('umum/Bis_model');
        $this->db->trans_begin();
        $this->Bis_model->deleteData('ms_pekerjaan',$id);
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses hapus data.');
                $this->session->set_flashdata('jenis', 'danger');
                redirect(site_url('mspekerjaan'));
        }

    }
//    ====================== EXPORT KE EXCEL ===================

}
