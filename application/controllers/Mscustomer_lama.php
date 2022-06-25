<?php
class Mscustomer extends CI_Controller{
  function __construct(){
      parent::__construct();
       $this->load->model('umum/Bis_model');
       //$this->load->model('umum/model_select');
       $this->load->helper('currency_format_helper');
       $this->load->database();
   		$this->load->helper(array('url'));
    }
  function index()
  {
    //'kd_barang'=>$this->model_app->getKodeBarang(),
    $id = get_cookie('tkkop');
    $this->load->model('Menu_m');
    $this->load->model('Hak_Akses_m');
    $this->load->model('Login_m');

    $data['data_status_aktif'] = $this->Bis_model->getAllData('ms_status_aktif');
    $data['data_kota'] = $this->Bis_model->getAllData('ms_kota');
    $data['data_bank'] = $this->Bis_model->getAllData('ms_bank');
    $query_coa="SELECT
                masterakun.kd_akun,
                masterakun.nama as nama_akun,
                masterakun.induk,
                masterakun.detail,
                masterakun.`level`
                FROM
                masterakun
                where kd_akun like '112%' and `level`=3";
    $data['data_coa'] = $this->Bis_model->manualQuery($query_coa);
    $query_data=" SELECT
                  ms_customer.id_customer,
                  ms_customer.id_kota,
                  ms_customer.id_bank,
                  upper(ms_customer.nama) AS nama_customer,
                  ms_customer.alamat AS alamat_customer,
                  IFNULL(ms_customer.top,0) AS top,
                  ms_customer.fax,
                  ms_customer.email,
                  ms_customer.npwp,
                  ms_customer.telpon,
                  ms_kabupaten.`name` AS nama_kabupaten,
                  ms_bank.nama_bank
                  FROM
                  ms_customer
                  LEFT JOIN ms_kabupaten ON ms_customer.id_kota = ms_kabupaten.id
                  LEFT JOIN ms_bank ON ms_customer.id_bank = ms_bank.kd_bank
                  ORDER BY
                  nama_customer ASC ";
    $data['data_customer'] = $this->Bis_model->manualQuery($query_data);
    $data['jabatan'] = $this->Login_m->get_jabatan();
    $data['users'] = $this->Hak_Akses_m->get_user();
    $data['menu'] = $this->Menu_m->get_menu($id);
    $data['submenu'] = $this->Menu_m->get_submenu($id);
    $this->load->view('Mscustomer_view',$data);
  }

  function ambil_data(){
    $modul=$this->input->post('modul');
    $id=$this->input->post('id');

    if($modul=="kabupaten"){
      echo $this->model_select->kabupaten($id);
    } else if($modul=="kecamatan"){
      echo $this->model_select->kecamatan($id);
    } else if($modul=="kelurahan"){
      echo $this->model_select->kelurahan($id);
    }
  }
//    ===================== INSERT =====================
    function tambah()
    {
      $now = date('Y-m-d H:i:s');
      $tgl_lahir = $this->input->post('tgllahir');
      $tgl_masuk = $this->input->post('tglmasuk');
      $tgl_keluar= $this->input->post('tglkeluar');
      $cookie_id_user = get_cookie('tkkop');

      $no_krit="CUS";
      $id_cust= $this->Bis_model->getIdCustomer($no_krit);
      $data=array(
        'id_customer'=>$id_cust,
        'id_kota'=>$this->input->post('id_kabupaten'),
        'id_bank'=>$this->input->post('id_bank'),
        'kd_akun'=>$this->input->post('kd_akun'),
        'nama'=>$this->input->post('nama'),
        'alamat'=>$this->input->post('alamat'),
        'alamat_invoice'=>$this->input->post('alamat_invoice'),
        'kode_pos'=>$this->input->post('kode_pos'),
        'telpon'=>$this->input->post('telpon'),
        //'provinsi'=>$this->input->post('provinsi'),

        'fax'=>$this->input->post('fax'),
        'email'=>$this->input->post('email'),
        'npwp'=>$this->input->post('npwp'),
        'top'=>$this->input->post('top'),
		    'attention'=>$this->input->post('attention'),
        //'status_aktif'=>$this->input->post('status_aktif'),
        'no_rekening'=>$this->input->post('no_rekening'),
        'an_rekening'=>$this->input->post('an_rekening'),
        'kontak_person'=>$this->input->post('kontak_person'),
        'keterangan'=>$this->input->post('keterangan'),
        //'foto'=>$this->input->post('foto'),
        'entry_user'=>$cookie_id_user,
        'entry_date'=>$now,
      );
      $this->db->trans_begin();
      $this->Bis_model->insertData('ms_customer',$data);
      if ($this->db->trans_status() === FALSE)
      {
              $this->db->trans_rollback();
      }
      else
      {
              $this->db->trans_commit();
              $this->session->set_flashdata('message', 'Sukses tambah data baru.');
              $this->session->set_flashdata('jenis', 'success');
              redirect(site_url('mscustomer'));
      }
      }

//    ======================== EDIT =======================
    function edit()
    {

        $id['id_customer'] = $this->input->post('id_customer');
        $now = date('Y-m-d H:i:s');
        $cookie_id_user = get_cookie('tkkop');
        $data=array(
          	'id_kota'=>$this->input->post('id_kabupaten'),
      			'id_bank'=>$this->input->post('id_bank'),
      			'nama'=>$this->input->post('nama'),
      			'alamat'=>$this->input->post('alamat'),
      			'alamat_invoice'=>$this->input->post('alamat_invoice'),
      			'kode_pos'=>$this->input->post('kode_pos'),
      			'telpon'=>$this->input->post('telpon'),
      			//'provinsi'=>$this->input->post('provinsi'),
            'kd_akun'=>$this->input->post('kd_akun'),
      			'fax'=>$this->input->post('fax'),
      			'email'=>$this->input->post('email'),
      			'npwp'=>$this->input->post('npwp'),
      			'top'=>$this->input->post('top'),
      			'attention'=>$this->input->post('attention'),
      			//'status_aktif'=>$this->input->post('status_aktif'),
      			'no_rekening'=>$this->input->post('no_rekening'),
      			'an_rekening'=>$this->input->post('an_rekening'),
      			'kontak_person'=>$this->input->post('kontak_person'),
      			'keterangan'=>$this->input->post('keterangan'),
      			//'foto'=>$this->input->post('foto'),
      			'edit_user'=>$cookie_id_user,
      			'edit_date'=>$now,
        );
        $this->db->trans_begin();
        $this->Bis_model->updateData('ms_customer',$data,$id);
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses edit data.');
                $this->session->set_flashdata('jenis', 'info');
                redirect(site_url('Mscustomer'));
        }
      }
      function ambiledit()
          {
              $id['id_customer'] = $this->uri->segment(3);

              $id_customer= $this->uri->segment(3);
              $id = get_cookie('tkkop');
              $this->load->model('Menu_m');
              $this->load->model('Hak_Akses_m');
              $this->load->model('Login_m');
              $data['data_jabatan'] = $this->Bis_model->getAllData('ms_jabatan');
              //$query_plant="SELECT * from ms_plant";
              //$data['data_plant'] = $this->Bis_model->manualQuery($query_plant);
			        $data['data_bank'] = $this->Bis_model->getAllData('ms_bank');
              $query_data="SELECT
                            ms_customer.id_customer,
                            ms_customer.id_bank,
                            ms_customer.nama,
                            ms_customer.alamat,
                            ms_customer.alamat_invoice,
                            ms_customer.kode_pos,
                            ms_customer.telpon,
                            ms_customer.top,
                            ms_customer.fax,
                            ms_customer.email,
                            ms_customer.npwp,
                            ms_customer.no_rekening,
                            ms_customer.an_rekening,
                            ms_customer.kontak_person,
                            ms_customer.attention,
                            ms_customer.keterangan,
                            ms_customer.foto,
                            ms_kabupaten.`name` AS nama_kabupaten,
                            ms_kabupaten.id AS id_kabupaten,
                            ms_bank.nama_bank,
                            masterakun.nama AS nama_akun,
                            masterakun.kd_akun
                            FROM
                            ms_customer
                            LEFT JOIN ms_kabupaten ON ms_customer.id_kota = ms_kabupaten.id
                            LEFT JOIN ms_bank ON ms_customer.id_bank = ms_bank.kd_bank
                            LEFT JOIN masterakun ON ms_customer.kd_akun = masterakun.kd_akun
                            where ms_customer.id_customer='$id_customer'";
              //$q_pegawai="select * from ms_pegawai order by nama asc";
              $data['data_customer'] = $this->Bis_model->manualQuery($query_data);
              $query_coa="SELECT
                          masterakun.kd_akun,
                          masterakun.nama as nama_akun,
                          masterakun.induk,
                          masterakun.detail,
                          masterakun.`level`
                          FROM
                          masterakun
                          where kd_akun like '112%' and `level`=3";
              $data['data_coa'] = $this->Bis_model->manualQuery($query_coa);
              //$data['data_pegawai'] = $this->Bis_model->manualQuery($q_pegawai);
              $data['jabatan'] = $this->Login_m->get_jabatan();
              $data['users'] = $this->Hak_Akses_m->get_user();
              $data['menu'] = $this->Menu_m->get_menu($id);
              $data['submenu'] = $this->Menu_m->get_submenu($id);
              $this->load->view('Mscustomer_edit_view',$data);
            }

	function tambahbaru()
          {
              $id['id_customer'] = $this->uri->segment(3);

              $id_customer= $this->uri->segment(3);
              $id = get_cookie('tkkop');
              $this->load->model('Menu_m');
              $this->load->model('Hak_Akses_m');
              $this->load->model('Login_m');
              $data['data_jabatan'] = $this->Bis_model->getAllData('ms_jabatan');
			   $data['data_bank'] = $this->Bis_model->getAllData('ms_bank');
         $query_coa="SELECT
                     masterakun.kd_akun,
                     masterakun.nama as nama_akun,
                     masterakun.induk,
                     masterakun.detail,
                     masterakun.`level`
                     FROM
                     masterakun
                     where kd_akun like '112%' and `level`=3";
         $data['data_coa'] = $this->Bis_model->manualQuery($query_coa);

              $data['jabatan'] = $this->Login_m->get_jabatan();
              $data['users'] = $this->Hak_Akses_m->get_user();
              $data['menu'] = $this->Menu_m->get_menu($id);
              $data['submenu'] = $this->Menu_m->get_submenu($id);
              $this->load->view('Mscustomer_tambah_view',$data);
            }
//    ========================== DELETE =======================
    function hapus(){
        $id['id_customer'] = $this->uri->segment(3);
        $this->db->trans_begin();
        $this->Bis_model->deleteData('ms_customer',$id);
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses delete.');
                $this->session->set_flashdata('jenis', 'danger');
                redirect(site_url('mscustomer'));
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
