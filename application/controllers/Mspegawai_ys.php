<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mspegawai extends CI_Controller{
  function __construct(){
       parent::__construct();
       $this->load->model('umum/Bis_model');
       $this->load->model('Menu_m');
       $this->load->model('Hak_Akses_m');
       $this->load->model('Login_m');
       $this->load->helper('currency_format_helper');
       $this->load->helper('format_tanggal_helper');
    }
  function index()
  {
    $id = get_cookie('eklinik');
    $query_kabupaten="SELECT id,`name` as nama_kota FROM ms_kabupaten";
    $query_sub_unit="SELECT mastersubunit.nama_sub_unit, mastersubunit.kd_sub_unit FROM mastersubunit WHERE mastersubunit.status LIKE '%1%'";
    $query_data="SELECT
                  ms_pegawai.id_pegawai,
                  upper(ms_pegawai.nama) AS nama,
                  mastersubunit.kd_sub_unit,
                  mastersubunit.nama_sub_unit,
                  ms_jenis.nama AS nama_jenis,
                  ms_jabatan.nama AS nama_jabatan,
                  ms_jenis.id_jenis,
                  ms_jabatan.id_jabatan,
                  masterunit.nama_unit,
                  masterunit.kd_unit,
                  ms_pegawai.tgl_masuk,
                  CONCAT(FLOOR(PERIOD_DIFF(DATE_FORMAT(NOW(), '%Y%m'), DATE_FORMAT(ms_pegawai.tgl_masuk, '%Y%m'))/12), ' TAHUN ', MOD(PERIOD_DIFF(DATE_FORMAT(NOW(), '%Y%m'), DATE_FORMAT(ms_pegawai.tgl_masuk, '%Y%')),12), ' BULAN ') AS lama_kerja,
                  ms_status_pegawai.nama_status_pegawai,
                  ms_status_aktif.nama_status_aktif,
                  ms_status_pegawai.id_status_pegawai,
                  ms_status_aktif.id_status_aktif,
                  a.`name` AS nama_kota,
                  ms_kabupaten.`name`,
                  ms_pegawai.id_kota,
                  ms_pegawai.id_kota_lahir,
                  ms_pegawai.alamat,
                  ms_pegawai.ktp,
                  ms_pegawai.tgl_lahir,
                  ms_pegawai.telepon,
                  ms_pegawai.email,
                  ms_pegawai.pendidikan,
                  ms_pegawai.no_rekening,
                  ms_pegawai.jk,
                  ms_pegawai.tgl_keluar,
                  ms_pegawai.edit_date,
                  ms_pegawai.entry_date,
                  ms_bank.nama_bank
                  FROM
                  ms_pegawai
                  LEFT JOIN mastersubunit ON ms_pegawai.id_subunit = mastersubunit.kd_sub_unit
                  LEFT JOIN ms_jenis ON ms_pegawai.id_jenis = ms_jenis.id_jenis
                  LEFT JOIN ms_jabatan ON ms_pegawai.id_jabatan = ms_jabatan.id_jabatan
                  LEFT JOIN masterunit ON mastersubunit.kd_unit = masterunit.kd_unit
                  LEFT JOIN ms_status_pegawai ON ms_pegawai.id_status_pegawai = ms_status_pegawai.id_status_pegawai
                  LEFT JOIN ms_status_aktif ON ms_pegawai.id_status_aktif = ms_status_aktif.id_status_aktif
                  LEFT JOIN ms_kabupaten AS a ON ms_pegawai.id_kota = a.id
                  LEFT JOIN ms_kabupaten ON ms_pegawai.id_kota_lahir = ms_kabupaten.id
                  LEFT JOIN ms_bank ON ms_pegawai.id_bank = ms_bank.kd_bank
                  ";
  //echo $query_kabupaten;
  echo $query_data;
    $data=array(
        'perintah' => 'Baru',
        'title'=>'Data Pegawai',
        'title_filter'=>'Cari Data Pegawai',
        'title_tambah'=>'Input Baru Data Pegawai',
        'data_kabupaten'=> $this->Bis_model->manualQuery($query_kabupaten),
        'data_status_aktif' => $this->Bis_model->getAllData('ms_status_aktif'),
        'data_status_pegawai' => $this->Bis_model->getAllData('ms_status_pegawai'),
        'data_subunit'=>$this->Bis_model->manualQuery($query_sub_unit),
        'data_jenis'=>$this->Bis_model->getAllData('ms_jenis'),
        'data_jabatan'=>$this->Bis_model->getAllData('ms_jabatan'),
        'data_pendidikan'=>$this->Bis_model->getAllData('ms_pendidikan'),
        'data_bank'=>$this->Bis_model->getAllData('ms_bank'),
        'data_pegawai'=>$this->Bis_model->manualQuery($query_data),
        'users'=>$this->Hak_Akses_m->get_user($id),
        'menu'=>$this->Menu_m->get_menu($id),
        'submenu'=>$this->Menu_m->get_submenu($id),
    );

    $this->load->view('mspegawai_view',$data);
  }

  function Dataedit ()
  {
    $id = get_cookie('eklinik');
    $id_edit=$this->input->post('id_pegawai');
    $query_kabupaten="SELECT id,`name` as nama_kota FROM ms_kabupaten";
    $query_subunit="SELECT mastersubunit.nama_sub_unit FROM mastersubunit WHERE mastersubunit.status LIKE '%1%'";
    $query_data="SELECT
                  ms_pegawai.id_pegawai,
                  upper(ms_pegawai.nama) AS nama,
                  mastersubunit.kd_sub_unit,
                  mastersubunit.nama_sub_unit,
                  ms_jenis.nama AS nama_jenis,
                  ms_jabatan.nama AS nama_jabatan,
                  ms_jenis.id_jenis,
                  ms_jabatan.id_jabatan,
                  masterunit.nama_unit,
                  masterunit.kd_unit,
                  ms_pegawai.tgl_masuk,
                  CONCAT(FLOOR(PERIOD_DIFF(DATE_FORMAT(NOW(), '%Y%m'), DATE_FORMAT(ms_pegawai.tgl_masuk, '%Y%m'))/12), ' TAHUN ', MOD(PERIOD_DIFF(DATE_FORMAT(NOW(), '%Y%m'), DATE_FORMAT(ms_pegawai.tgl_masuk, '%Y%')),12), ' BULAN ') AS lama_kerja,
                  ms_status_pegawai.nama_status_pegawai,
                  ms_status_aktif.nama_status_aktif,
                  ms_status_pegawai.id_status_pegawai,
                  ms_status_aktif.id_status_aktif,
                  a.`name` AS nama_kota,
                  ms_kabupaten.name AS nama_kota_lahir,
                  ms_pegawai.id_kota,
                  ms_pegawai.id_kota_lahir,
                  ms_pegawai.alamat,
                  ms_pegawai.ktp,
                  ms_pegawai.tgl_lahir,
                  ms_pegawai.telepon,
                  ms_pegawai.email,
                  ms_pegawai.pendidikan,
                  ms_pegawai.no_rekening,
                  ms_pegawai.jk,
                  ms_pegawai.tgl_keluar,
                  ms_pegawai.edit_date,
                  ms_pegawai.entry_date,
                  ms_bank.nama_bank
                  FROM
                  ms_pegawai
                  LEFT JOIN mastersubunit ON ms_pegawai.id_subunit = mastersubunit.kd_sub_unit
                  LEFT JOIN ms_jenis ON ms_pegawai.id_jenis = ms_jenis.id_jenis
                  LEFT JOIN ms_jabatan ON ms_pegawai.id_jabatan = ms_jabatan.id_jabatan
                  LEFT JOIN masterunit ON mastersubunit.kd_unit = masterunit.kd_unit
                  LEFT JOIN ms_status_pegawai ON ms_pegawai.id_status_pegawai = ms_status_pegawai.id_status_pegawai
                  LEFT JOIN ms_status_aktif ON ms_pegawai.id_status_aktif = ms_status_aktif.id_status_aktif
                  LEFT JOIN ms_kabupaten AS a ON ms_pegawai.id_kota = a.id
                  LEFT JOIN ms_kabupaten ON ms_pegawai.id_kota_lahir = ms_kabupaten.id
                  LEFT JOIN ms_bank ON ms_pegawai.id_bank = ms_bank.kd_bank
                  ";
    $query_data_edit="SELECT
                      ms_pegawai.id_pegawai,
                      upper(ms_pegawai.nama) AS nama,
                      mastersubunit.kd_sub_unit,
                      mastersubunit.nama_sub_unit,
                      ms_jenis.nama AS nama_jenis,
                      ms_jabatan.nama AS nama_jabatan,
                      ms_jenis.id_jenis,
                      ms_jabatan.id_jabatan,
                      masterunit.nama_unit,
                      masterunit.kd_unit,
                      ms_pegawai.tgl_masuk,
                      CONCAT(FLOOR(PERIOD_DIFF(DATE_FORMAT(NOW(), '%Y%m'), DATE_FORMAT(ms_pegawai.tgl_masuk, '%Y%m'))/12), ' TAHUN ', MOD(PERIOD_DIFF(DATE_FORMAT(NOW(), '%Y%m'), DATE_FORMAT(ms_pegawai.tgl_masuk, '%Y%')),12), ' BULAN ') AS lama_kerja,
                      ms_status_pegawai.nama_status_pegawai,
                      ms_status_aktif.nama_status_aktif,
                      ms_status_pegawai.id_status_pegawai,
                      ms_status_aktif.id_status_aktif,
                      a.`name` AS nama_kota,
                      ms_kabupaten.`name` AS nama_kota_lahir,
                      ms_pegawai.id_kota,
                      ms_pegawai.id_kota_lahir,
                      ms_pegawai.alamat,
                      ms_pegawai.ktp,
                      ms_pegawai.tgl_lahir,
                      ms_pegawai.telepon,
                      ms_pegawai.email,
                      ms_pegawai.pendidikan,
                      ms_pegawai.no_rekening,
                      ms_pegawai.jk,
                      ms_pegawai.tgl_keluar,
                      ms_pegawai.edit_date,
                      ms_pegawai.entry_date,
                      ms_pegawai.id_bank,
                      ms_bank.nama_bank
                      FROM
                      ms_pegawai
                      LEFT JOIN mastersubunit ON ms_pegawai.id_subunit = mastersubunit.kd_sub_unit
                      LEFT JOIN ms_jenis ON ms_pegawai.id_jenis = ms_jenis.id_jenis
                      LEFT JOIN ms_jabatan ON ms_pegawai.id_jabatan = ms_jabatan.id_jabatan
                      LEFT JOIN masterunit ON mastersubunit.kd_unit = masterunit.kd_unit
                      LEFT JOIN ms_status_pegawai ON ms_pegawai.id_status_pegawai = ms_status_pegawai.id_status_pegawai
                      LEFT JOIN ms_status_aktif ON ms_pegawai.id_status_aktif = ms_status_aktif.id_status_aktif
                      LEFT JOIN ms_kabupaten AS a ON ms_pegawai.id_kota = a.id
                      LEFT JOIN ms_kabupaten ON ms_pegawai.id_kota_lahir = ms_kabupaten.id
                      LEFT JOIN ms_bank ON ms_pegawai.id_bank = ms_bank.kd_bank
                      WHERE
                      ms_pegawai.id_pegawai = '$id_edit'";

    $data=array(
      'perintah' => 'Edit',
        'title'=>'Data Pegawai',
        'title_filter'=>'Cari Data Pegawai',
        'title_tambah'=>'Edit Data Pegawai',
        'data_kabupaten'=> $this->Bis_model->manualQuery($query_kabupaten),
        'data_status_aktif' => $this->Bis_model->getAllData('ms_status_aktif'),
        'data_subunit'=>$this->Bis_model->manualQuery($query_subunit),
        'data_jenis'=>$this->Bis_model->getAllData('ms_jenis'),
        'data_jabatan'=>$this->Bis_model->getAllData('ms_jabatan'),
        'data_pendidikan'=>$this->Bis_model->getAllData('ms_pendidikan'),
        'data_bank'=>$this->Bis_model->getAllData('ms_bank'),
        'data_pegawai'=>$this->Bis_model->manualQuery($query_data),
        'data_pegawai_edit'=>$this->Bis_model->manualQuery($query_data_edit),
        'users'=>$this->Hak_Akses_m->get_user($id),
        'menu'=>$this->Menu_m->get_menu($id),
        'submenu'=>$this->Menu_m->get_submenu($id),
  );
  $this->load->view('mspegawai_view',$data);
//echo $query_data_edit;
  }
  function filter()
            {
              $id = get_cookie('eklinik');
              $query_kabupaten="SELECT id,`name` as nama_kota FROM ms_kabupaten";
              $query_subunit="SELECT mastersubunit.nama_sub_unit FROM mastersubunit WHERE mastersubunit.status LIKE '%1%'";
              $filter = $this->input->post('katakunci');
              $query_data="SELECT
                        ms_pegawai.id_pegawai,
                        upper(ms_pegawai.nama) as nama,
                        mastersubunit.kd_sub_unit,
                        mastersubunit.nama_sub_unit,
                        ms_jenis.nama AS nama_jenis,
                        ms_jabatan.nama AS nama_jabatan,
                        ms_jenis.id_jenis,
                        ms_jabatan.id_jabatan,
                        masterunit.nama_unit,
                        masterunit.kd_unit,
                        ms_pegawai.tgl_masuk,
                        CONCAT(FLOOR(PERIOD_DIFF(DATE_FORMAT(NOW(), '%Y%m'), DATE_FORMAT(ms_pegawai.tgl_masuk, '%Y%m'))/12), ' TAHUN ', MOD(PERIOD_DIFF(DATE_FORMAT(NOW(), '%Y%m'), DATE_FORMAT(ms_pegawai.tgl_masuk, '%Y%')),12), ' BULAN ') AS lama_kerja,
                        ms_status_pegawai.nama_status_pegawai,
                        ms_status_aktif.nama_status_aktif,
                        ms_status_pegawai.id_status_pegawai,
                        ms_status_aktif.id_status_aktif
                        FROM
                        ms_pegawai
                        LEFT JOIN mastersubunit ON ms_pegawai.id_subunit = mastersubunit.kd_sub_unit
                        INNER JOIN ms_jenis ON ms_pegawai.id_jenis = ms_jenis.id_jenis
                        INNER JOIN ms_jabatan ON ms_pegawai.id_jabatan = ms_jabatan.id_jabatan
                        INNER JOIN masterunit ON mastersubunit.kd_unit = masterunit.kd_unit
                        LEFT JOIN ms_status_pegawai ON ms_pegawai.id_status_pegawai = ms_status_pegawai.id_status_pegawai
                        LEFT JOIN ms_status_aktif ON ms_pegawai.id_status_aktif = ms_status_aktif.id_status_aktif
                        WHERE ms_pegawai.id_pegawai like '%$filter%' OR ms_pegawai.nama like '%$filter%' OR mastersubunit.nama_sub_unit like '%$filter%' OR masterunit.nama_unit like '%$filter%' OR ms_jabatan.nama like '%$filter%'";

              $data=array(
                'perintah' => 'Baru',
                'title'=>'Data Pegawai',
                'title_filter'=>'Cari Data Pegawai',
                'title_tambah'=>'Input Baru Data Pegawai',
                'data_kabupaten'=> $this->Bis_model->manualQuery($query_kabupaten),
                'data_status_aktif' => $this->Bis_model->getAllData('ms_status_aktif'),
                'data_subunit'=>$this->Bis_model->manualQuery($query_subunit),
                'data_jenis'=>$this->Bis_model->getAllData('ms_jenis'),
                'data_jabatan'=>$this->Bis_model->getAllData('ms_jabatan'),
                'data_pendidikan'=>$this->Bis_model->getAllData('ms_pendidikan'),
                'data_bank'=>$this->Bis_model->getAllData('ms_bank'),
                'data_pegawai'=>$this->Bis_model->manualQuery($query_data),
                'users'=>$this->Hak_Akses_m->get_user($id),
                'menu'=>$this->Menu_m->get_menu($id),
                'submenu'=>$this->Menu_m->get_submenu($id),
              );

              $this->load->view('mspegawai_view',$data);
              }

  function showprofile($ids)
  {

    $id = get_cookie('eklinik');
    $this->load->model('Menu_m');
    $this->load->model('Hak_Akses_m');
    $this->load->model('Login_m');
    $data['data_jabatan'] = $this->Bis_model->getAllData('ms_jabatan');
    $data['data_jenis'] = $this->Bis_model->getAllData('ms_jenis');
    $data['data_plant'] = $this->Bis_model->getAllData('ms_plant');
    $data['data_divisi'] = $this->Bis_model->getAllData('ms_divisi');
    $data['data_departement'] = $this->Bis_model->getAllData('ms_departement');
    $data['data_status_aktif'] = $this->Bis_model->getAllData('ms_status_aktif');
    $data['data_kota'] = $this->Bis_model->getAllData('ms_kabupaten');
    $data['data_pendidikan'] = $this->Bis_model->getAllData('ms_pendidikan');
    $data['data_bank'] = $this->Bis_model->getAllData('ms_bank');
    $data['data_status_pegawai'] = $this->Bis_model->getAllData('ms_status_pegawai');
    $data['data_var_payroll'] = $this->Bis_model->getAllData('var_payroll');
    $data['data_sloc'] = $this->Bis_model->getAllData('ms_slock');
    $query_data="SELECT
ms_pegawai.id_pegawai,
upper(ms_pegawai.nama) AS nama_pegawai,
mastersubunit.kd_sub_unit,
mastersubunit.nama_sub_unit,
ms_jenis.nama AS nama_jenis,
ms_jabatan.nama AS nama_jabatan,
ms_jenis.id_jenis,
ms_jabatan.id_jabatan,
masterunit.nama_unit,
masterunit.kd_unit,
ms_pegawai.tgl_masuk,
CONCAT(FLOOR(PERIOD_DIFF(DATE_FORMAT(NOW(), '%Y%m'), DATE_FORMAT(ms_pegawai.tgl_masuk, '%Y%m'))/12), ' TAHUN ', MOD(PERIOD_DIFF(DATE_FORMAT(NOW(), '%Y%m'), DATE_FORMAT(ms_pegawai.tgl_masuk, '%Y%')),12), ' BULAN ') AS lama_kerja,
ms_status_pegawai.nama_status_pegawai,
ms_status_aktif.nama_status_aktif,
ms_status_pegawai.id_status_pegawai,
ms_status_aktif.id_status_aktif,
a.`name` AS nama_kota,
ms_kabupaten.`name` AS nama_kota_lahir,
ms_pegawai.id_kota,
ms_pegawai.id_kota_lahir,
ms_pegawai.alamat,
ms_pegawai.ktp,
ms_pegawai.tgl_lahir,
ms_pegawai.telepon,
ms_pegawai.email,
ms_pegawai.pendidikan,
ms_pegawai.no_rekening,
ms_pegawai.jk,
ms_pegawai.tgl_keluar,
ms_pegawai.edit_date,
ms_pegawai.entry_date,
ms_bank.nama_bank,
ms_bank.kd_bank
FROM
ms_pegawai
LEFT JOIN mastersubunit ON ms_pegawai.id_subunit = mastersubunit.kd_sub_unit
LEFT JOIN ms_jenis ON ms_pegawai.id_jenis = ms_jenis.id_jenis
LEFT JOIN ms_jabatan ON ms_pegawai.id_jabatan = ms_jabatan.id_jabatan
LEFT JOIN masterunit ON mastersubunit.kd_unit = masterunit.kd_unit
LEFT JOIN ms_status_pegawai ON ms_pegawai.id_status_pegawai = ms_status_pegawai.id_status_pegawai
LEFT JOIN ms_status_aktif ON ms_pegawai.id_status_aktif = ms_status_aktif.id_status_aktif
LEFT JOIN ms_kabupaten AS a ON ms_pegawai.id_kota = a.id
LEFT JOIN ms_kabupaten ON ms_pegawai.id_kota_lahir = ms_kabupaten.id
LEFT JOIN ms_bank ON ms_pegawai.id_bank = ms_bank.kd_bank


              WHERE
              ms_pegawai.id_pegawai = '$ids'
              ";
    $data['data_pegawai'] = $this->Bis_model->manualQuery($query_data);
    $data['jabatan'] = $this->Login_m->get_jabatan();
    $data['users'] = $this->Hak_Akses_m->get_user();
    $data['menu'] = $this->Menu_m->get_menu($id);
    $data['submenu'] = $this->Menu_m->get_submenu($id);
    $this->load->view('master/pegawai/profile_view',$data);
  }






//    ===================== INSERT =====================
    function tambah()
    {
      $now = date('Y-m-d H:i:s');
      $tgl_masuk = $this->input->post('tgl_masuk');
      $date = new DateTime($this->input->post('tgl_masuk'));
      $id_jenis =  $this->input->post('id_jenis');
      $year = $date -> format('Y');
      $month = $date -> format('m');
      $day = $date -> format('d');
      $tgl_lahir = $this->input->post('tgllahir');
      $tgl_keluar= $this->input->post('tglkeluar');
      $cookie_id_user = get_cookie('eklinik');
      $kodejenis = $id_jenis;

      //$no_nik= $this->Bis_model->getIdPegawai($year,$kodejenis);
      //$no_nik=  $this->input->post('id_pegawai');
      $no_nik= time();
      $data=array(
          'id_pegawai'=>'P'.$no_nik,

          'id_subunit'=>$this->input->post('kd_sub_unit'),
          'id_jabatan'=>$this->input->post('id_jabatan'),
          'id_jenis'=>$this->input->post('id_jenis'),
          'id_kota'=>$this->input->post('id_kota'),
          'id_bank'=>$this->input->post('id_bank'),
          'id_kota_lahir'=>$this->input->post('id_kota_lahir'),
          'nama'=>$this->input->post('nama'),
          'alamat'=>$this->input->post('alamat'),
          'ktp'=>$this->input->post('ktp'),
          'tgl_lahir'=>$this->input->post('tgllahir'),
          'telepon'=>$this->input->post('telepon'),
          'email'=>$this->input->post('email'),
          'pendidikan'=>$this->input->post('id_pendidikan'),
          'no_rekening'=>$this->input->post('no_rekening'),
          'jk'=>$this->input->post('jk'),
          'id_status_aktif'=>$this->input->post('id_status_aktif'),
          'id_status_pegawai'=>$this->input->post('id_status_pegawai'),
          'foto'=>$this->input->post('foto'),
          'nama_file'=>$this->input->post('nama_file'),
          'mime'=>$this->input->post('mime'),
          'tgl_masuk'=>$this->input->post('tgl_masuk'),
          'tgl_keluar'=>$this->input->post('tglkeluar'),


          'entry_user'=>$cookie_id_user,
          'entry_date'=>$now,
      );
		  $this->db->trans_begin();
		  $this->Bis_model->insertData('ms_pegawai',$data);

		  if ($this->db->trans_status() === FALSE)
		  {
				  $this->db->trans_rollback();
          $this->session->set_flashdata('message', 'Gagal tambah data baru.');
				  $this->session->set_flashdata('jenis', 'danger');
		  }
		  else
		  {
				  $this->db->trans_commit();
				  $this->session->set_flashdata('message', 'Sukses tambah data baru.');
				  $this->session->set_flashdata('jenis', 'success');
				  redirect(site_url('mspegawai'));
		  }
      }

//    ======================== EDIT =======================
    function edit()
    {
        $tgl_lahir = $this->input->post('tgllahir');
        $tgl_masuk = $this->input->post('tgl_masuk');
        $tgl_keluar= $this->input->post('tglkeluar');
        $id['id_pegawai'] = $this->input->post('id_pegawai');
		    $no_nik= $this->input->post('id_pegawai');
        $now = date('Y-m-d H:i:s');
        $cookie_id_user = get_cookie('eklinik');
        $data=array(
              'id_subunit'=>$this->input->post('kd_sub_unit'),
              'id_jabatan'=>$this->input->post('id_jabatan'),
              'id_jenis'=>$this->input->post('id_jenis'),
              'id_kota'=>$this->input->post('id_kota'),
              'id_bank'=>$this->input->post('id_bank'),
              'id_kota_lahir'=>$this->input->post('id_kota_lahir'),
              'nama'=>$this->input->post('nama'),
              'alamat'=>$this->input->post('alamat'),
              'ktp'=>$this->input->post('ktp'),
              'tgl_lahir'=>$this->input->post('tgl_lahir'),
              'telepon'=>$this->input->post('telepon'),
              'email'=>$this->input->post('email'),
              'pendidikan'=>$this->input->post('id_pendidikan'),
              'no_rekening'=>$this->input->post('no_rekening'),
              'jk'=>$this->input->post('jk'),
              'id_status_aktif'=>$this->input->post('id_status_aktif'),
              'id_status_pegawai'=>$this->input->post('id_status_pegawai'),
              'foto'=>$this->input->post('foto'),
              'nama_file'=>$this->input->post('nama_file'),
              'mime'=>$this->input->post('mime'),
              'tgl_masuk'=>$this->input->post('tgl_masuk'),
              'tgl_keluar'=>$this->input->post('tgl_keluar'),
              'edit_user'=>$cookie_id_user,
              'edit_date'=>$now,
        );
        $this->db->trans_begin();
        $this->Bis_model->updateData('ms_pegawai',$data,$id);




        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                $this->session->set_flashdata('message', 'Gagal edit data.');
                $this->session->set_flashdata('jenis', 'danger');
                redirect(site_url('mspegawai'));
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses edit data.');
                $this->session->set_flashdata('jenis', 'info');
                redirect(site_url('mspegawai'));
        }
      }

//    ========================== DELETE =======================
    function hapus(){
        $id['id_pegawai'] = $this->uri->segment(3);
        $this->db->trans_begin();
        $this->Bis_model->deleteData('ms_pegawai',$id);
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses delete.');
                $this->session->set_flashdata('jenis', 'danger');
                redirect(site_url('mspegawai'));
        }

    }
//    ====================== EXPORT KE EXCEL ===================


      function exportexcel()
      {
        $query_data='SELECT
                      ms_pegawai.id_pegawai,
                      ms_pegawai.nama AS nama_pegawai,
                      ms_pegawai.id_plant,
                      ms_pegawai.id_divisi,
                      ms_pegawai.id_departement,
                      ms_pegawai.id_jabatan,
                      ms_pegawai.id_kota,
                      ms_pegawai.id_bank,
                      ms_pegawai.id_kota_lahir,
                      ms_pegawai.alamat,
                      ms_pegawai.ktp,
                      ms_pegawai.tgl_lahir,
                      ms_pegawai.telepon,
                      ms_pegawai.email,
                      ms_pegawai.pendidikan,
                      ms_pegawai.no_rekening,
                      ms_pegawai.jk,
                      ms_pegawai.id_status_aktif,
                      ms_pegawai.id_status_pegawai,
                      ms_pegawai.foto,
                      ms_pegawai.ttd,
                      ms_pegawai.tgl_masuk,
                      ms_pegawai.tgl_keluar,
                      ms_divisi.nama AS nama_divisi,
                      ms_plant.nama AS nama_plant,
                      ms_status_aktif.nama_status_aktif,
                      ms_status_pegawai.nama_status_pegawai,
                      ms_departement.nama AS nama_departement,
                      ms_jabatan.nama AS nama_jabatan,
                      ms_bank.nama_bank AS nama_bank,
                      alamat_kota.`name` AS alamat_kota,
                      kota_lahir.`name` AS kota_lahir,
                      ms_jenis.nama AS nama_jenis,
                      ms_pegawai.id_jenis
                      FROM
                      ms_pegawai
                      INNER JOIN ms_divisi ON ms_pegawai.id_divisi = ms_divisi.id_divisi
                      INNER JOIN ms_plant ON ms_pegawai.id_plant = ms_plant.id_plant
                      INNER JOIN ms_departement ON ms_pegawai.id_departement = ms_departement.id_departement
                      INNER JOIN ms_status_aktif ON ms_pegawai.id_status_aktif = ms_status_aktif.id_status_aktif
                      INNER JOIN ms_status_pegawai ON ms_pegawai.id_status_pegawai = ms_status_pegawai.id_status_pegawai
                      INNER JOIN ms_jabatan ON ms_pegawai.id_jabatan = ms_jabatan.id_jabatan
                      LEFT JOIN ms_bank ON ms_pegawai.id_bank = ms_bank.kd_bank
                      LEFT JOIN ms_kabupaten AS alamat_kota ON ms_pegawai.id_kota = alamat_kota.id
                      LEFT JOIN ms_kabupaten AS kota_lahir ON ms_pegawai.id_kota_lahir = kota_lahir.id
                      LEFT JOIN ms_jenis ON ms_pegawai.id_jenis = ms_jenis.id_jenis
                      ';
        $data['data_pegawai'] = $this->Bis_model->manualQuery($query_data);
        $this->load->view('export/Mspegawai_export',$data);
      }
}
?>
