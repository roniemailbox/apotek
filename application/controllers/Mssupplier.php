<?php
class Mssupplier extends CI_Controller{
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
    $query_data= "SELECT
                    ms_supplier.id_supplier,
                    ms_supplier.id_kota,
                    ms_supplier.id_bank,
                    UPPER(ms_supplier.nama) as nama,
                    UPPER(ms_supplier.alamat) as alamat,
                    ms_supplier.alamat_invoice,
                    ms_supplier.kode_pos,
                    ms_supplier.telepon,
                    ms_supplier.hp,
                    ms_supplier.fax,
                    ms_supplier.email,
                    ms_supplier.npwp,
                    ms_supplier.top,
                    ms_supplier.no_rekening,
                    ms_supplier.an_rekening,
                    ms_supplier.kontak_person,
                    ms_supplier.keterangan,
                    ms_kabupaten.`name` AS nama_kota,
                    ms_bank.nama_bank AS nama_bank
                    FROM
                    ms_supplier
                    LEFT JOIN ms_kabupaten ON ms_supplier.id_kota = ms_kabupaten.id
                    LEFT JOIN ms_bank ON ms_supplier.id_bank = ms_bank.kd_bank
                    ORDER BY
                    ms_supplier.id_supplier ASC
                    ";

    $data=array(
        'perintah'=>'Baru',
        'title'=>'Data Supplier',
        'title_filter' => 'Cari Data SUpplier',
        'title_tambah' => 'Input Supplier baru',
        'title_report' => 'Laporan Supplier',
        'data_supplier'=>$this->Bis_model->manualQuery($query_data),
        'users'=>$this->Hak_Akses_m->get_user($id),
        'menu'=>$this->Menu_m->get_menu($id),
        'submenu'=>$this->Menu_m->get_submenu($id),
    );
    $this->load->view('Mssupplier_view',$data);
  }
  function filter()
            {
              $id = get_cookie('eklinik');
              $filter = $this->input->post('katakunci');
              $query_data="SELECT
                              ms_supplier.id_supplier,
                              ms_supplier.id_kota,
                              ms_supplier.id_bank,
                              UPPER(ms_supplier.nama) as nama,
                              UPPER(ms_supplier.alamat) as alamat,
                              ms_supplier.alamat_invoice,
                              ms_supplier.kode_pos,
                              ms_supplier.telepon,
                              ms_supplier.hp,
                              ms_supplier.fax,
                              ms_supplier.email,
                              ms_supplier.npwp,
                              ms_supplier.top,
                              ms_supplier.no_rekening,
                              ms_supplier.an_rekening,
                              ms_supplier.kontak_person,
                              ms_supplier.keterangan,
                              ms_kabupaten.`name` AS nama_kota,
                              ms_bank.nama_bank AS nama_bank
                              FROM
                              ms_supplier
                              LEFT JOIN ms_kabupaten ON ms_supplier.id_kota = ms_kabupaten.id
                              LEFT JOIN ms_bank ON ms_supplier.id_bank = ms_bank.kd_bank
                              WHERE ms_supplier.nama like '%$filter%'";

                        $data=array(
                          'perintah'=>'Baru',
                          'title'=>'Data Supplier',
                          'title_filter' => 'Cari Data SUpplier',
                          'title_tambah' => 'Input Supplier baru',
                          'title_report' => 'Laporan Supplier',
                            'data_supplier'=>$this->Bis_model->manualQuery($query_data),
                            'users'=>$this->Hak_Akses_m->get_user($id),
                            'menu'=>$this->Menu_m->get_menu($id),
                            'submenu'=>$this->Menu_m->get_submenu($id),
                        );
                        $this->load->view('Mssupplier_view',$data);
              }

  function Dataedit()
  {
    $id = get_cookie('eklinik');
    $id_supplier= $this->input->post('id_supplier');
    
    $query_data= "SELECT
    ms_supplier.id_supplier,
    ms_supplier.id_kota,
    ms_supplier.id_bank,
    UPPER( ms_supplier.nama ) AS nama,
    UPPER( ms_supplier.alamat ) AS alamat,
    ms_supplier.alamat_invoice,
    ms_supplier.kode_pos,
    ms_supplier.telepon,
    ms_supplier.hp,
    ms_supplier.fax,
    ms_supplier.email,
    ms_supplier.npwp,
    ms_supplier.top,
    ms_supplier.no_rekening,
    ms_supplier.an_rekening,
    ms_supplier.kontak_person,
    ms_supplier.keterangan,
    ms_kabupaten.`name` AS nama_kota,
    ms_bank.nama_bank AS nama_bank 
  FROM
    ms_supplier
    LEFT JOIN ms_kabupaten ON ms_supplier.id_kota = ms_kabupaten.id
    LEFT JOIN ms_bank ON ms_supplier.id_bank = ms_bank.kd_bank 
  ORDER BY
    ms_supplier.id_supplier ASC"; 

    $query_edit= "SELECT
                    ms_supplier.id_supplier,
                    ms_supplier.id_kota,
                    ms_supplier.id_bank,
                    UPPER(ms_supplier.nama) as nama,
                    UPPER(ms_supplier.alamat) as alamat,
                    ms_supplier.alamat_invoice,
                    ms_supplier.kode_pos,
                    ms_supplier.telepon,
                    ms_supplier.hp,
                    ms_supplier.fax,
                    ms_supplier.email,
                    ms_supplier.npwp,
                    ms_supplier.top,
                    ms_supplier.no_rekening,
                    ms_supplier.an_rekening,
                    ms_supplier.kontak_person,
                    ms_supplier.keterangan,
                    ms_kabupaten.`name` AS nama_kota,
                    ms_bank.nama_bank AS nama_bank
                    FROM
                    ms_supplier
                    LEFT JOIN ms_kabupaten ON ms_supplier.id_kota = ms_kabupaten.id
                    LEFT JOIN ms_bank ON ms_supplier.id_bank = ms_bank.kd_bank
          WHERE
          ms_supplier.id_supplier = '$id_supplier'
          ";

          $data=array(
              'perintah'=>'Edit',
              'title'=>'Data Supplier',
              'title_filter' => 'Cari Data SUpplier',
              'title_tambah' => 'Edit Data Supplier',
              'title_report' => 'Laporan Supplier',
              //'data_kabupaten' => $this->Bis_model->getAllData('ms_kabupaten'),
              //'data_bank' => $this->Bis_model->getAllData('ms_bank'),
              'data_supplier'=>$this->Bis_model->manualQuery($query_data),
              'data_edit'=>$this->Bis_model->manualQuery($query_edit),
              'users'=>$this->Hak_Akses_m->get_user(),
              'menu'=>$this->Menu_m->get_menu($id),
              'submenu'=>$this->Menu_m->get_submenu($id),
          );
    $this->load->view('Mssupplier_view',$data);
  }

//    ===================== INSERT =====================
function tambah()
{
  $now = date('Y-m-d H:i:s');
  $tgl_lahir = $this->input->post('tgllahir');
  $tgl_masuk = $this->input->post('tglmasuk');
  $tgl_keluar= $this->input->post('tglkeluar');
  $cookie_id_user = get_cookie('eklinik');
  $kodejenis =  $this->input->post('id_status_pegawai');
  //$no_krit="EMP-";
  //$no_nik= $this->Bis_model->getIdPegawai($kodejenis);
  $no_krit="SUP";
  $id_supplier= $this->Bis_model->getIdSupplier($no_krit);
  $data=array(
    'id_supplier'=>$id_supplier,
    'id_kota'=>$this->input->post('id_kota'),
    'id_bank'=>$this->input->post('id_bank'),
    'nama'=>$this->input->post('nama'),
    'alamat'=>$this->input->post('alamat'),
    'alamat_invoice'=>$this->input->post('alamat_invoice'),
    'kode_pos'=>$this->input->post('kode_pos'),
    'telepon'=>$this->input->post('telepon'),
    'hp'=>$this->input->post('hp'),
    'fax'=>$this->input->post('fax'),
    'email'=>$this->input->post('email'),
    'npwp'=>$this->input->post('npwp'),
    'status_aktif'=>$this->input->post('status_aktif'),
    'no_rekening'=>$this->input->post('no_rekening'),
    'an_rekening'=>$this->input->post('an_rekening'),
    'kontak_person'=>$this->input->post('kontak_person'),
    'foto'=>$this->input->post('foto'),
    'top'=>$this->input->post('top'),
    'keterangan'=>$this->input->post('keterangan'),
    'entry_user'=>$cookie_id_user,
    'entry_date'=>$now,
  );
  $this->db->trans_begin();
  $this->Bis_model->insertData('ms_supplier',$data);
  if ($this->db->trans_status() === FALSE)
  {
          $this->db->trans_rollback();
  }
  else
  {
          $this->db->trans_commit();
          $this->session->set_flashdata('message', 'Sukses tambah data baru.');
          $this->session->set_flashdata('jenis', 'success');
          redirect(site_url('mssupplier'));
  }
  }

//    ======================== EDIT =======================
    function edit()
    {
        $tgl_lahir = $this->input->post('tgllahir');
        $tgl_masuk = $this->input->post('tglmasuk');
        $tgl_keluar= $this->input->post('tglkeluar');
        $id['id_supplier'] = $this->input->post('id_supplier');

        $now = date('Y-m-d H:i:s');
        $cookie_id_user = get_cookie('eklinik');
        $data=array(
          'id_kota'=>$this->input->post('id_kota'),
          'id_bank'=>$this->input->post('id_bank'),
          'nama'=>$this->input->post('nama'),
          'alamat'=>$this->input->post('alamat'),
          'alamat_invoice'=>$this->input->post('alamat_invoice'),
          'kode_pos'=>$this->input->post('kode_pos'),
          'telepon'=>$this->input->post('telepon'),
          'hp'=>$this->input->post('hp'),
          'fax'=>$this->input->post('fax'),
          'email'=>$this->input->post('email'),
          'npwp'=>$this->input->post('npwp'),
          'status_aktif'=>$this->input->post('status_aktif'),
          'no_rekening'=>$this->input->post('no_rekening'),
          'an_rekening'=>$this->input->post('an_rekening'),
          'kontak_person'=>$this->input->post('kontak_person'),
          'foto'=>$this->input->post('foto'),
          'top'=>$this->input->post('top'),
          'keterangan'=>$this->input->post('keterangan'),

              'edit_user'=>$cookie_id_user,
              'edit_date'=>$now,
        );
        $this->db->trans_begin();
        $this->Bis_model->updateData('ms_supplier',$data,$id);
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses edit data.');
                $this->session->set_flashdata('jenis', 'info');
                redirect(site_url('Mssupplier'));
        }
      }

//    ========================== DELETE =======================
    function hapus(){
        //$id['id_supplier'] = $this->uri->segment(3);
        $id['id_supplier'] = $this->input->post('id_supplier');
        $this->db->trans_begin();
        $this->Bis_model->deleteData('ms_supplier',$id);
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses delete.');
                $this->session->set_flashdata('jenis', 'danger');
                redirect(site_url('mssupplier'));
        }

    }
//    ====================== EXPORT KE EXCEL ===================
      function exportexcel()
      {
        $query_data='SELECT
            ms_pegawai.id_pegawai,
            ms_pegawai.nama as nama_pegawai,
            ms_pegawai.alamat,
            ms_pegawai.ktp,
            ms_pegawai.telepon,
            ms_pegawai.email,
            ms_pegawai.pendidikan,
            ms_pegawai.no_rekening,
            ms_pegawai.jk,
            ms_pegawai.username,
            ms_pegawai.password,
            ms_pegawai.foto,
            ms_pegawai.tgl_lahir,
            ms_pegawai.tgl_masuk,
            ms_pegawai.tgl_keluar,
            ms_pegawai.edit_date,
            ms_pegawai.edit_user,
            ms_pegawai.entry_date,
            ms_pegawai.entry_user,
            ms_pegawai.id_status_aktif,
            ms_pegawai.id_status_pegawai,
            ms_pegawai.id_departement,
            ms_pegawai.id_jabatan,
            ms_pegawai.id_kota,
            ms_pegawai.id_bank,
            ms_departement.nama as nama_departement,
            ms_jabatan.nama as nama_jabatan,
            ms_kota.nama as nama_kota,
            ms_bank.nama as nama_bank,
            ms_status_pegawai.nama_status_pegawai,
            ms_status_aktif.nama_status_aktif,
            ms_divisi.nama as nama_divisi,
            ms_plant.nama as nama_plant
            FROM
            ms_pegawai
            INNER JOIN ms_departement ON ms_pegawai.id_departement = ms_departement.id_departement
            INNER JOIN ms_jabatan ON ms_pegawai.id_jabatan = ms_jabatan.id_jabatan
            INNER JOIN ms_kota ON ms_pegawai.id_kota = ms_kota.id_kota
            INNER JOIN ms_bank ON ms_pegawai.id_bank = ms_bank.id_bank
            INNER JOIN ms_status_aktif ON ms_pegawai.id_status_aktif = ms_status_aktif.id_status_aktif
            INNER JOIN ms_status_pegawai ON ms_pegawai.id_status_pegawai = ms_status_pegawai.id_status_pegawai
            INNER JOIN ms_divisi ON ms_departement.id_divisi = ms_divisi.id_divisi
            INNER JOIN ms_plant ON ms_divisi.id_plant = ms_plant.id_plant';
        $data['data_pegawai'] = $this->Bis_model->manualQuery($query_data);
        $this->load->view('export/mspegawai_export',$data);
      }
}
