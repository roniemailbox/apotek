<?php
class Pendapatan extends CI_Controller{
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
    $status_aktif='1';
    #$query_status = "SELECT * FROM ms_status_aktif";
    $query_akun = "SELECT
                   masterakun.kd_akun,
                   masterakun.nama
                   FROM
                   masterakun
                   ORDER BY
                   masterakun.kd_akun ASC";
    $query_pendapatan= "SELECT
                  	ms_pendapatan.id_pendapatan,
                  	ms_pendapatan.kd_akun,
                  	ms_pendapatan.nama,
                    ms_pendapatan.diskripsi,
                    ms_pendapatan.status_aktif,
                  	ms_pendapatan.entry_user,
                  	ms_pendapatan.entry_date,
                  	ms_pendapatan.edit_user,
                  	ms_pendapatan.edit_date
                  FROM
                  	ms_pendapatan
                  LEFT JOIN ms_pegawai ON ms_pendapatan.entry_user = ms_pegawai.id_pegawai
                  #LEFT JOIN ms_status_aktif ON ms_bank.status_aktif = ms_status_aktif.id_status_aktif";
      $query_unit="SELECT
                    masterunit.kd_unit,
                    masterunit.nama_unit,
                    masterunit.alamat_unit,
                    masterunit.telepon,
                    masterunit.entry_date,
                    masterunit.entry_user,
                    masterunit.edit_user,
                    masterunit.edit_date
                    FROM
                    masterunit
                      ";

      $data=array(
        'perintah' => 'Baru',
        'title'=>'Pendapatan',
        'title_filter' => 'Cari Pendapatan',
        'title_tambah' => 'Input Pendapatan',
        //'title_report' => 'Laporan Barang',\
        'data_unit'=>$this->Bis_model->manualQuery($query_unit),
        'data_pendapatan'=>$this->Bis_model->manualQuery($query_pendapatan),
        'data_status'=>$status_aktif,
        'data_akun'=>$this->Bis_model->manualQuery($query_akun),
        'users'=>$this->Hak_Akses_m->get_user($id),
        'menu'=>$this->Menu_m->get_menu($id),
        'submenu'=>$this->Menu_m->get_submenu($id)
      );

      $this->load->view('pendapatan_view', $data);
  }

//    ===================== DATAEDIT =====================
  function Dataedit(){
    $id = get_cookie('eklinik');
    $query_status = "SELECT * FROM ms_status_aktif";
    $id_pendapatan = $this->input->post('id_pendapatan');
                  $query_akun = "SELECT
                                 masterakun.kd_akun,
                                 masterakun.nama
                                 FROM
                                 masterakun
                                 ORDER BY
                                 masterakun.kd_akun ASC";
                                 $query_pendapatan= "SELECT
                                              	ms_pendapatan.id_pendapatan,
                                              	ms_pendapatan.kd_akun,
                                              	ms_pendapatan.nama,
                                              	ms_pendapatan.diskripsi,
                                              	ms_pendapatan.status_aktif,
                                              	ms_pendapatan.entry_user,
                                              	ms_pendapatan.entry_date,
                                              	ms_pendapatan.edit_user,
                                              	ms_pendapatan.edit_date
                                              FROM
                                              	ms_pendapatan
                                               LEFT JOIN ms_pegawai ON ms_pendapatan.entry_user = ms_pegawai.id_pegawai
                                 #LEFT JOIN ms_status_aktif ON ms_bank.status_aktif = ms_status_aktif.id_status_aktif";
                     $query_unit="SELECT
                                   masterunit.kd_unit,
                                   masterunit.nama_unit,
                                   masterunit.alamat_unit,
                                   masterunit.telepon,
                                   masterunit.entry_date,
                                   masterunit.entry_user,
                                   masterunit.edit_user,
                                   masterunit.edit_date
                                   FROM
                                   masterunit
                                       ";

      $query_edit= "SELECT
                    	ms_pendapatan.id_pendapatan,
                    	ms_pendapatan.kd_akun,
                    	ms_pendapatan.nama,
                    	ms_pendapatan.diskripsi,
                    	ms_pendapatan.status_aktif,
                    	ms_pendapatan.entry_user,
                    	ms_pendapatan.entry_date,
                    	ms_pendapatan.edit_user,
                    	ms_pendapatan.edit_date
                    FROM
                    	ms_pendapatan
                    LEFT JOIN ms_pegawai ON ms_pendapatan.entry_user = ms_pegawai.id_pegawai
                    #LEFT JOIN ms_status_aktif ON ms_bank.status_aktif = ms_status_aktif.id_status_aktif
                    WHERE
                    ms_pendapatan.id_pendapatan = '$id_pendapatan'
                    ";

$data=array(
  'perintah' => 'Edit',
  'title'=>'Pendapatan',
  'title_filter' => 'Cari Pendapatan',
  'title_tambah' => 'Input Pendapatan',
  //'title_report' => 'Laporan Barang',
  'data_akun'=>$this->Bis_model->manualQuery($query_akun),
  'data_pendapatan'=>$this->Bis_model->manualQuery($query_pendapatan),
  'data_edit'=>$this->Bis_model->manualQuery($query_edit),
  'data_unit'=>$this->Bis_model->manualQuery($query_unit),
  'data_status'=>$this->Bis_model->manualQuery($query_status),
  'users'=>$this->Hak_Akses_m->get_user($id),
  'menu'=>$this->Menu_m->get_menu($id),
  'submenu'=>$this->Menu_m->get_submenu($id),
);



    $this->load->view('pendapatan_view', $data);
  }

  //    ===================== INSERT =====================
  function tambah()
  {
    $now = date('Y-m-d H:i:s');
    $cookie_id_user = get_cookie('eklinik');
    $date = new DateTime($now);
    $status_aktif='aktif';
    //$id_jenis =  $this->input->post('id_jenis');
    //$year = $date -> format('y');
    //$month = $date -> format('m');
    //$day = $date -> format('d');
    //$kode_bukti=$this->input->post('id_jenis');
    //$id_barang= $this->Bis_model->getIdBarang($kode_bukti);
    $id_pendapatan= $this->input->post('id_pendapatan');

    $data=array(
        'id_pendapatan'=>$this->input->post('id_pendapatan'),
        'kd_akun'=>$this->input->post('kd_akun'),
        'nama'=>$this->input->post('nama'),
        'diskripsi'=>$this->input->post('diskripsi'),
        'status_aktif'=>$status_aktif,
        #'jenis'=>$this->input->post('jenis'),
        #'atas_nama'=>$this->input->post('atas_nama'),
        #'keterangan'=>$this->input->post('keterangan'),
        #'rekening'=>$this->input->post('rekening'),
        #'status_aktif'=>$this->input->post('id_status_aktif'),
        'entry_user'=>$cookie_id_user,
        'entry_date'=>$now,
    );
    $this->db->trans_begin();
    $this->Bis_model->insertData('ms_pendapatan',$data);

    if ($this->db->trans_status() === FALSE)
    {
            $this->db->trans_rollback();
    }
    else
    {
            $this->db->trans_commit();
            $this->session->set_flashdata('message', 'Sukses tambah data baru.');
            $this->session->set_flashdata('jenis', 'success');
            redirect(site_url('Pendapatan'));
    }

    }

  //    ======================== EDIT =======================
    function edit(){
        $id['id_pendapatan'] = $this->input->post('id_pendapatan');
        //$id=$this->input->post('id_barang');
        $now = date('Y-m-d H:i:s');
        $cookie_id_user = get_cookie('eklinik');

        $data=array(
          #'nama_unit'=>$this->input->post('nama_unit'),
          'id_pendapatan'=>$this->input->post('id_pendapatan'),
          'kd_akun'=>$this->input->post('kd_akun'),
          'nama'=>$this->input->post('nama'),
          'diskripsi'=>$this->input->post('diskripsi'),
          'status_aktif'=>$this->input->post('status_aktif'),
          #'atas_nama'=>$this->input->post('atas_nama'),
          #'keterangan'=>$this->input->post('keterangan'),
          #'status_aktif'=>$this->input->post('id_status_aktif'),
          'entry_user'=>$cookie_id_user,
          'entry_date'=>$now,
        );

        $this->db->trans_begin();
        $this->Bis_model->updateData('ms_pendapatan',$data,$id);

        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses edit data.');
                $this->session->set_flashdata('jenis', 'info');
                redirect(site_url('Pendapatan'));
        }

    }

  //    ========================== FILTER =======================
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
                   $query_pendapatan= "SELECT
                                	ms_pendapatan.id_pendapatan,
                                	ms_pendapatan.kd_akun,
                                	ms_pendapatan.nama,
                                	ms_pendapatan.diskripsi,
                                	ms_pendapatan.status_aktif,
                                	ms_pendapatan.entry_user,
                                	ms_pendapatan.entry_date,
                                	ms_pendapatan.edit_user,
                                	ms_pendapatan.edit_date
                                FROM
                                	ms_pendapatan
                                 LEFT JOIN ms_pegawai ON ms_pendapatan.entry_user = ms_pegawai.id_pegawai
                  #LEFT JOIN ms_status_aktif ON ms_bank.status_aktif = ms_status_aktif.id_status_aktif
                  WHERE
                  ms_pendapatan.id_pendapatan LIKE '%$filter%' OR ms_pendapatan.nama LIKE '%$filter%'
                  ORDER BY
                    ms_pendapatan.id_pendapatan ASC";
      $query_unit="SELECT
                    masterunit.kd_unit,
                    masterunit.nama_unit,
                    masterunit.alamat_unit,
                    masterunit.telepon,
                    masterunit.entry_date,
                    masterunit.entry_user,
                    masterunit.edit_user,
                    masterunit.edit_date
                    FROM
                    masterunit
                WHERE
                masterunit.kd_unit LIKE '%$filter%' OR masterunit.nama_unit LIKE '%$filter%'
                ORDER BY
                  masterunit.kd_unit ASC";

    $data=array(
          'perintah' => 'Baru',
          'title'=>'Pendapatan',
          'title_filter' => 'Cari Pendapatan',
          'title_tambah' => 'Input Pendapatan',
          //'title_report' => 'Laporan Barang',\
          'data_unit'=>$this->Bis_model->manualQuery($query_unit),
          'data_pendapatan'=>$this->Bis_model->manualQuery($query_pendapatan),
          'data_status'=>$this->Bis_model->manualQuery($query_status),
          'data_akun'=>$this->Bis_model->manualQuery($query_akun),
          'users'=>$this->Hak_Akses_m->get_user($id),
          'menu'=>$this->Menu_m->get_menu($id),
          'submenu'=>$this->Menu_m->get_submenu($id)
    );

    $this->load->view('pendapatan_view', $data);
  }


  //    ========================== DELETE =======================
    function hapus(){
        $id['id_pendapatan'] = $this->uri->segment(3);
        $id['id_pendapatan'] = $this->input->post('id_pendapatan');
        $this->db->trans_begin();
        $this->Bis_model->deleteData('ms_pendapatan',$id);
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses hapus data.');
                $this->session->set_flashdata('jenis', 'danger');
                redirect(site_url('Pendapatan'));
        }

    }


}
