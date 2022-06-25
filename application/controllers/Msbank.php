<?php
class Msbank extends CI_Controller{
  function __construct(){
      parent::__construct();
       $this->load->model('umum/Bis_model');
       $this->load->model('Menu_m');
       $this->load->model('Hak_Akses_m');
       $this->load->model('Login_m');
       //$this->load->model('umum/model_select');
       $this->load->helper('currency_format_helper');
   		$this->load->helper(array('url'));
    }

    function index()
  {
    //'kd_barang'=>$this->model_app->getKodeBarang(),
    $id = get_cookie('eklinik');
    $query_status = "SELECT * FROM ms_status_aktif";
    $query_akun = "SELECT
                   masterakun.kd_akun,
                   masterakun.nama
                   FROM
                   masterakun
                   ORDER BY
                   masterakun.kd_akun ASC";
    $query_bank= "SELECT
                  ms_bank.kd_bank,
                  ms_bank.nama_bank,
                  ms_bank.kd_akun,
                  ms_bank.jenis,
                  ms_bank.atas_nama,
                  ms_bank.rekening,
                  ms_bank.edit_date,
                  ms_bank.edit_user,
                  ms_bank.entry_date,
                  ms_bank.entry_user,
                  ms_bank.status_aktif,
                  ms_status_aktif.id_status_aktif
                FROM
                  ms_bank
                  LEFT JOIN ms_pegawai ON ms_bank.entry_user = ms_pegawai.id_pegawai
                  LEFT JOIN ms_status_aktif ON ms_bank.status_aktif = ms_status_aktif.id_status_aktif
                ORDER BY
                  ms_bank.kd_bank ASC";
      
      $data=array(
        'perintah' => 'Baru',
        'title'=>'Master Bank',
        'title_filter' => 'Cari Master Bank',
        'title_tambah' => 'Input Bank Baru',
        //'title_report' => 'Laporan Barang',

        'data_bank'=>$this->Bis_model->manualQuery($query_bank),
        'data_status'=>$this->Bis_model->manualQuery($query_status),
        'data_akun'=>$this->Bis_model->manualQuery($query_akun),
        'users'=>$this->Hak_Akses_m->get_user($id),
        'menu'=>$this->Menu_m->get_menu($id),
        'submenu'=>$this->Menu_m->get_submenu($id)
      );

      $this->load->view('Msbank_view', $data);
  }

  function Dataedit(){
    $id = get_cookie('eklinik');
    $query_status = "SELECT * FROM ms_status_aktif";
    $kd_bank = $this->input->post('kd_bank');
    $query_akun = "SELECT
                   masterakun.kd_akun,
                   masterakun.nama
                   FROM
                   masterakun
                   ORDER BY
                   masterakun.kd_akun ASC";
    $query_bank= "SELECT
                  ms_bank.kd_bank,
                  ms_bank.nama_bank,
                  ms_bank.kd_akun,
                  ms_bank.jenis,
                  ms_bank.atas_nama,
                  ms_bank.rekening,
                  ms_bank.edit_date,
                  ms_bank.edit_user,
                  ms_bank.entry_date,
                  ms_bank.entry_user,
                  ms_bank.status_aktif,
                  ms_status_aktif.id_status_aktif 
                FROM
                  ms_bank
                  LEFT JOIN ms_pegawai ON ms_bank.entry_user = ms_pegawai.id_pegawai
                  LEFT JOIN ms_status_aktif ON ms_bank.status_aktif = ms_status_aktif.id_status_aktif
                ORDER BY
                  ms_bank.kd_bank ASC";
      
      $query_edit= "SELECT
      ms_bank.kd_bank,
      ms_bank.nama_bank,
      ms_bank.kd_akun,
      ms_bank.jenis,
      ms_bank.edit_date,
      ms_bank.edit_user,
      ms_bank.entry_date,
      ms_bank.entry_user,
      ms_bank.status_aktif, 
      ms_status_aktif.id_status_aktif
    FROM
      ms_bank
      LEFT JOIN ms_pegawai ON ms_bank.entry_user = ms_pegawai.id_pegawai
      LEFT JOIN ms_status_aktif ON ms_bank.status_aktif = ms_status_aktif.id_status_aktif
    WHERE 
    ms_bank.kd_bank = '$kd_bank'
    ";

$data=array(
  'perintah' => 'Edit',
  'title'=>'Master Bank',
  'title_filter' => 'Cari Master Bank',
  'title_tambah' => 'Input Bank Baru',
  //'title_report' => 'Laporan Barang',
  'data_akun'=>$this->Bis_model->manualQuery($query_akun),
  'data_bank'=>$this->Bis_model->manualQuery($query_bank),
  'data_edit'=>$this->Bis_model->manualQuery($query_edit),
  'data_status'=>$this->Bis_model->manualQuery($query_status),
  'users'=>$this->Hak_Akses_m->get_user($id),
  'menu'=>$this->Menu_m->get_menu($id),
  'submenu'=>$this->Menu_m->get_submenu($id),
);

    $this->load->view('Msbank_view', $data);
  }

  function filter(){
    $id = get_cookie('eklinik');
    $filter = $this->input->post('katakunci');
    $query_status = "SELECT * FROM ms_status_aktif";
    $query_akun = "SELECT
                   masterakun.kd_akun,
                   masterakun.nama
                   FROM
                   masterakun
                   ORDER BY
                   masterakun.kd_akun ASC";
    $query_bank= "SELECT
                  ms_bank.kd_bank,
                  ms_bank.nama_bank,
                  ms_bank.kd_akun,
                  ms_bank.jenis,
                  ms_bank.atas_nama,
                  ms_bank.rekening,
                  ms_bank.edit_date,
                  ms_bank.edit_user,
                  ms_bank.entry_date,
                  ms_bank.entry_user,
                  ms_bank.status_aktif,
                  ms_status_aktif.id_status_aktif 
                FROM
                  ms_bank
                  LEFT JOIN ms_pegawai ON ms_bank.entry_user = ms_pegawai.id_pegawai
                  LEFT JOIN ms_status_aktif ON ms_bank.status_aktif = ms_status_aktif.id_status_aktif
                WHERE 
                ms_bank.kd_bank LIKE '%$filter%' OR ms_bank.nama_bank LIKE '%$filter%' 
                ORDER BY
                  ms_bank.kd_bank ASC";

    $data=array(
          'perintah' => 'Baru',
          'title'=>'Master Bank',
          'title_filter' => 'Cari Master Bank',
          'title_tambah' => 'Input Bank Baru',
          //'title_report' => 'Laporan Barang',
          'data_akun'=>$this->Bis_model->manualQuery($query_akun),
          'data_bank'=>$this->Bis_model->manualQuery($query_bank),
          'data_status'=>$this->Bis_model->manualQuery($query_status),
          'users'=>$this->Hak_Akses_m->get_user($id),
          'menu'=>$this->Menu_m->get_menu($id),
          'submenu'=>$this->Menu_m->get_submenu($id)
    );

    $this->load->view('Msbank_view', $data);
  }

  //    ===================== INSERT =====================
  function tambah()
  {
    $now = date('Y-m-d H:i:s');
    $cookie_id_user = get_cookie('eklinik');
    $date = new DateTime($now);
    //$id_jenis =  $this->input->post('id_jenis');
    //$year = $date -> format('y');
    //$month = $date -> format('m');
    //$day = $date -> format('d');
    //$kode_bukti=$this->input->post('id_jenis');
    //$id_barang= $this->Bis_model->getIdBarang($kode_bukti);
    $kd_bank= $this->input->post('kd_bank');

    $data=array(
        'kd_bank'=>$this->input->post('kd_bank'),
        'nama_bank'=>$this->input->post('nama_bank'),
        'kd_akun'=>$this->input->post('kd_akun'),
        'jenis'=>$this->input->post('jenis'),
        'atas_nama'=>$this->input->post('atas_nama'),
        'rekening'=>$this->input->post('rekening'),
        'status_aktif'=>$this->input->post('id_status_aktif'),
        'entry_user'=>$cookie_id_user,
        'entry_date'=>$now,
    );
    $this->db->trans_begin();
    $this->Bis_model->insertData('ms_bank',$data);

    if ($this->db->trans_status() === FALSE)
    {
            $this->db->trans_rollback();
    }
    else
    {
            $this->db->trans_commit();
            $this->session->set_flashdata('message', 'Sukses tambah data baru.');
            $this->session->set_flashdata('jenis', 'success');
            redirect(site_url('Msbank'));
    }

    }

//    ======================== EDIT =======================
  function edit(){
      $id['kd_bank'] = $this->input->post('kd_bank');
      //$id=$this->input->post('id_barang');
      $now = date('Y-m-d H:i:s');
      $cookie_id_user = get_cookie('eklinik');

      $data=array(
        'kd_bank'=>$this->input->post('kd_bank'),
        'nama_bank'=>$this->input->post('nama_bank'),
        'kd_akun'=>$this->input->post('kd_akun'),
        'jenis'=>$this->input->post('jenis'),
        'atas_nama'=>$this->input->post('atas_nama'),
        'rekening'=>$this->input->post('rekening'),
        'status_aktif'=>$this->input->post('id_status_aktif'),
        'entry_user'=>$cookie_id_user,
        'entry_date'=>$now,
      );

      $this->db->trans_begin();
      $this->Bis_model->updateData('ms_bank',$data,$id);

      if ($this->db->trans_status() === FALSE)
      {
              $this->db->trans_rollback();
      }
      else
      {
              $this->db->trans_commit();
              $this->session->set_flashdata('message', 'Sukses edit data.');
              $this->session->set_flashdata('jenis', 'info');
              redirect(site_url('Msbank'));
      }

  }

//    ========================== DELETE =======================
  function hapus(){
      //$id['id_barang'] = $this->uri->segment(3);
      $id['kd_bank'] = $this->input->post('kd_bank');
      $this->db->trans_begin();
      $this->Bis_model->deleteData('ms_bank',$id);
      if ($this->db->trans_status() === FALSE)
      {
              $this->db->trans_rollback();
      }
      else
      {
              $this->db->trans_commit();
              $this->session->set_flashdata('message', 'Sukses hapus data.');
              $this->session->set_flashdata('jenis', 'danger');
              redirect(site_url('Msbank'));
      }

  }











}