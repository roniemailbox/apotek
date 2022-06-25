<?php
class Bbiaya extends CI_Controller{
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
    $query_beban= "SELECT
                  	ms_beban.id_beban,
                  	ms_beban.id_akun,
                  	ms_beban.nama,
                  	ms_beban.entry_user,
                  	ms_beban.entry_date,
                  	ms_beban.edit_user,
                  	ms_beban.edit_date
                  FROM
                  	ms_beban
                  LEFT JOIN ms_pegawai ON ms_beban.entry_user = ms_pegawai.id_pegawai
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
        'title'=>'Beban Biaya',
        'title_filter' => 'Cari Beban',
        'title_tambah' => 'Input Beban',
        //'title_report' => 'Laporan Barang',\
        'data_unit'=>$this->Bis_model->manualQuery($query_unit),
        'data_beban'=>$this->Bis_model->manualQuery($query_beban),
        'data_status'=>$this->Bis_model->manualQuery($query_status),
        'data_akun'=>$this->Bis_model->manualQuery($query_akun),
        'users'=>$this->Hak_Akses_m->get_user($id),
        'menu'=>$this->Menu_m->get_menu($id),
        'submenu'=>$this->Menu_m->get_submenu($id)
      );

      $this->load->view('biaya_view', $data);
  }

//    ===================== DATAEDIT =====================
  function Dataedit(){
    $id = get_cookie('eklinik');
    $query_status = "SELECT * FROM ms_status_aktif";
    $id_beban = $this->input->post('id_beban');
    $query_akun = "SELECT
                   masterakun.kd_akun,
                   masterakun.nama
                   FROM
                   masterakun
                   ORDER BY
                   masterakun.kd_akun ASC";
                   $query_beban= "SELECT
                                 	ms_beban.id_beban,
                                 	ms_beban.id_akun,
                                 	ms_beban.nama,
                                 	ms_beban.entry_user,
                                 	ms_beban.entry_date,
                                 	ms_beban.edit_user,
                                 	ms_beban.edit_date
                                 FROM
                                 	ms_beban
                                 LEFT JOIN ms_pegawai ON ms_beban.entry_user = ms_pegawai.id_pegawai
                                 #LEFT JOIN ms_status_aktif ON ms_bank.status_aktif = ms_status_aktif.id_status_aktif";
                     $query_unit="SELECT
                                   masterunit.kd_unit,
                                   masterunit.nama_unit,
                                   masterunit.alamat_unit,
                                   masterunit.telepon,
                                   masterunit.entry_date,
                                   masterunit.entry_user,
                                   masterunit.edit_user,
                                   masterunit.edit_date,
                                   masterunit.status_aktif
                                   FROM
                                   masterunit
                                      ";

      $query_edit= "SELECT
                     ms_beban.id_beban,
                     ms_beban.id_akun,
                     ms_beban.nama,
                     ms_beban.entry_user,
                     ms_beban.entry_date,
                     ms_beban.edit_user,
                     ms_beban.edit_date
                    FROM
                     ms_beban
                    LEFT JOIN ms_pegawai ON ms_beban.entry_user = ms_pegawai.id_pegawai
                    #LEFT JOIN ms_status_aktif ON ms_bank.status_aktif = ms_status_aktif.id_status_aktif
                    WHERE
                    ms_beban.id_beban = '$id_beban'
                    ";

$data=array(
  'perintah' => 'Edit',
  'title'=>'Beban Biaya',
  'title_filter' => 'Cari Beban',
  'title_tambah' => 'Input Beban',
  //'title_report' => 'Laporan Barang',
  'data_akun'=>$this->Bis_model->manualQuery($query_akun),
  'data_beban'=>$this->Bis_model->manualQuery($query_beban),
  'data_edit'=>$this->Bis_model->manualQuery($query_edit),
  'data_unit'=>$this->Bis_model->manualQuery($query_unit),
  #'data_status'=>$this->Bis_model->manualQuery($query_status),
  'users'=>$this->Hak_Akses_m->get_user($id),
  'menu'=>$this->Menu_m->get_menu($id),
  'submenu'=>$this->Menu_m->get_submenu($id),
);



    $this->load->view('biaya_view', $data);
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
    $id_beban= $this->input->post('id_beban');

    $data=array(
        'id_beban'=>$this->input->post('id_beban'),
        'id_akun'=>$this->input->post('id_akun'),
        'nama'=>$this->input->post('nama'),
        #'jenis'=>$this->input->post('jenis'),
        #'atas_nama'=>$this->input->post('atas_nama'),
        #'keterangan'=>$this->input->post('keterangan'),
        #'rekening'=>$this->input->post('rekening'),
        #'status_aktif'=>$this->input->post('id_status_aktif'),
        'entry_user'=>$cookie_id_user,
        'entry_date'=>$now,
    );
    $this->db->trans_begin();
    $this->Bis_model->insertData('ms_beban',$data);

    if ($this->db->trans_status() === FALSE)
    {
            $this->db->trans_rollback();
    }
    else
    {
            $this->db->trans_commit();
            $this->session->set_flashdata('message', 'Sukses tambah data baru.');
            $this->session->set_flashdata('jenis', 'success');
            redirect(site_url('Bbiaya'));
    }

    }

  //    ======================== EDIT =======================
    function edit(){
        $id['id_beban'] = $this->input->post('id_beban');
        //$id=$this->input->post('id_barang');
        $now = date('Y-m-d H:i:s');
        $cookie_id_user = get_cookie('eklinik');

        $data=array(
          #'nama_unit'=>$this->input->post('nama_unit'),
          'id_beban'=>$this->input->post('id_beban'),
          'id_akun'=>$this->input->post('id_akun'),
          'nama'=>$this->input->post('nama'),
          #'atas_nama'=>$this->input->post('atas_nama'),
          #'keterangan'=>$this->input->post('keterangan'),
          #'status_aktif'=>$this->input->post('id_status_aktif'),
          'entry_user'=>$cookie_id_user,
          'entry_date'=>$now,
        );

        $this->db->trans_begin();
        $this->Bis_model->updateData('ms_beban',$data,$id);

        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses edit data.');
                $this->session->set_flashdata('jenis', 'info');
                redirect(site_url('Bbiaya'));
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
    $query_beban= "SELECT
                  	ms_beban.id_beban,
                  	ms_beban.id_akun,
                  	ms_beban.nama,
                  	ms_beban.entry_user,
                  	ms_beban.entry_date,
                  	ms_beban.edit_user,
                  	ms_beban.edit_date
                  FROM
                  	ms_beban
                  LEFT JOIN ms_pegawai ON ms_beban.entry_user = ms_pegawai.id_pegawai
                  #LEFT JOIN ms_status_aktif ON ms_bank.status_aktif = ms_status_aktif.id_status_aktif
                  WHERE
                  ms_beban.id_beban LIKE '%$filter%' OR ms_beban.nama LIKE '%$filter%'
                  ORDER BY
                    ms_beban.id_beban ASC";
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
          'title'=>'Beban Biaya',
          'title_filter' => 'Cari Beban',
          'title_tambah' => 'Input Beban',
          //'title_report' => 'Laporan Barang',\
          'data_unit'=>$this->Bis_model->manualQuery($query_unit),
          'data_beban'=>$this->Bis_model->manualQuery($query_beban),
          'data_status'=>$this->Bis_model->manualQuery($query_status),
          'data_akun'=>$this->Bis_model->manualQuery($query_akun),
          'users'=>$this->Hak_Akses_m->get_user($id),
          'menu'=>$this->Menu_m->get_menu($id),
          'submenu'=>$this->Menu_m->get_submenu($id)
    );

    $this->load->view('biaya_view', $data);
  }


  //    ========================== DELETE =======================
    function hapus(){
        $id['id_beban'] = $this->uri->segment(3);
        $id['id_beban'] = $this->input->post('id_beban');
        $this->db->trans_begin();
        $this->Bis_model->deleteData('ms_beban',$id);
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses hapus data.');
                $this->session->set_flashdata('jenis', 'danger');
                redirect(site_url('Bbiaya'));
        }

    }


}
