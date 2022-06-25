<?php
class Mssubunit extends CI_Controller{
  function __construct(){
        parent::__construct();
        $this->load->model('umum/Bis_model');
        $this->load->model('Menu_m');
        $this->load->model('Hak_Akses_m');
        $this->load->model('Login_m');
        $this->load->helper('currency_format_helper');
  }
  function index()
  {
    $id = get_cookie('eklinik');
    $query_data="SELECT
mastersubunit.kd_sub_unit,
mastersubunit.nama_sub_unit,
mastersubunit.alamat_sub_unit,
mastersubunit.id_kota,
mastersubunit.telepon,
mastersubunit.email,
mastersubunit.fax,
mastersubunit.entry_user,
mastersubunit.entry_date,
masterunit.kd_unit,
masterunit.nama_unit,
ms_pegawai.nama AS nama_pegawai,
ms_kabupaten.`name` AS nama_kota
FROM
mastersubunit
LEFT JOIN masterunit ON mastersubunit.kd_unit = masterunit.kd_unit
LEFT JOIN `user` ON mastersubunit.entry_user = `user`.id_user
LEFT JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
LEFT JOIN ms_kabupaten ON mastersubunit.id_kota = ms_kabupaten.id";

      $data=array(
          'title'=>'Master Sub unit',
          'xmenu'=>'Master',
          'xsubmenu'=>'Sub Unit',
          'data_subunit'=>$this->Bis_model->manualQuery($query_data),
          'users'=>$this->Hak_Akses_m->get_user(),
          'menu'=>$this->Menu_m->get_menu($id),
          'submenu'=>$this->Menu_m->get_submenu($id),
      );

      $this->load->view('Mssubunit_view',$data);
  }

//    ===================== INSERT =====================
    function tambah()
    {
      $now = date('Y-m-d H:i:s');
      $cookie_id_user = get_cookie('eklinik');
      $date = new DateTime($now);
      //$id_jenis =  $this->input->post('id_jenis');
      $year = $date -> format('y');
      $month = $date -> format('m');
      $day = $date -> format('d');
      $kode_bukti=$this->input->post('id_jenis');
      //$id_subunit= $this->Bis_model->getIdsubunit($kode_bukti);
      $data=array(
        'nama_sub_unit'=>$this->input->post('nama_sub_unit'),
        'alamat_sub_unit'=>$this->input->post('alamat_sub_unit'),
        'telepon'=>$this->input->post('telepon'),
        'fax'=>$this->input->post('fax'),
        'email'=>$this->input->post('email'),
        'kd_unit'=>$this->input->post('kd_unit'),
        'id_kota'=>$this->input->post('id_kabupaten'),
        'entry_user'=>$cookie_id_user,
        'entry_date'=>$now,
      );
      $this->db->trans_begin();
      $this->Bis_model->insertData('mastersubunit',$data);

      if ($this->db->trans_status() === FALSE)
      {
              $this->db->trans_rollback();
              $this->session->set_flashdata('message', 'Gagal tambah data baru.');
              $this->session->set_flashdata('jenis', 'danger');
              redirect(site_url('Mssubunit'));
      }
      else
      {
              $this->db->trans_commit();
              $this->session->set_flashdata('message', 'Sukses tambah data baru.');
              $this->session->set_flashdata('jenis', 'success');
              redirect(site_url('Mssubunit'));
      }

      }

      function baru(){
        $id = get_cookie('eklinik');

        $query_supplier="select * from ms_kabupaten";
        $query_kategori="select * from ms_kategori";
        $query_perusahaan="select * from ms_perusahaan";


        $data=array(
            'perintah'=>'Baru',
            'title'=>'Master subunit',
            'xmenu'=>'Master',
            'xsubmenu'=>'subunit',


            'data_status_aktif' => $this->Bis_model->getAllData('ms_status_aktif'),
            'data_unit' => $this->Bis_model->getAllData('masterunit'),
            'data_kabupaten' => $this->Bis_model->getAllData('ms_kabupaten'),
            'data_perusahaan' => $this->Bis_model->getAllData('ms_perusahaan'),
            'users'=>$this->Hak_Akses_m->get_user(),
            'menu'=>$this->Menu_m->get_menu($id),
            'submenu'=>$this->Menu_m->get_submenu($id),
        );


        $this->load->view('Mssubunit_baru_view',$data);
      }

      function filter(){
        $id = get_cookie('eklinik');
        $filter = $this->input->post('katakunci');
        $query_supplier="select * from ms_supplier";

        $query_kategori="select * from ms_kategori";
        $query_satuan="select * from ms_satuan";
        $query_data="SELECT
    mastersubunit.kd_sub_unit,
    mastersubunit.nama_sub_unit,
    mastersubunit.alamat_sub_unit,
    mastersubunit.id_kota,
    mastersubunit.telepon,
    mastersubunit.email,
    mastersubunit.fax,
    mastersubunit.entry_user,
    mastersubunit.entry_date,
    masterunit.kd_unit,
    masterunit.nama_unit,
    ms_pegawai.nama AS nama_pegawai,
    ms_kabupaten.`name` AS nama_kota
    FROM
    mastersubunit
    LEFT JOIN masterunit ON mastersubunit.kd_unit = masterunit.kd_unit
    LEFT JOIN `user` ON mastersubunit.entry_user = `user`.id_user
    LEFT JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
    LEFT JOIN ms_kabupaten ON mastersubunit.id_kota = ms_kabupaten.id
    WHERE mastersubunit.kd_sub_unit like '%$filter%' OR mastersubunit.nama_sub_unit like '%$filter%' OR masterunit.nama_unit like '%$filter%'";
        //echo $query_data;
        $data=array(
            'title'=>'Master subunit',
            'xmenu'=>'Master',
            'xsubmenu'=>'subunit',

            'data_subunit'=>$this->Bis_model->manualQuery($query_data),
            'data_status_aktif' => $this->Bis_model->getAllData('ms_status_aktif'),

            'data_kabupaten' => $this->Bis_model->getAllData('ms_kabupaten'),
            'data_perusahaan' => $this->Bis_model->getAllData('ms_perusahaan'),
            'users'=>$this->Hak_Akses_m->get_user(),
            'menu'=>$this->Menu_m->get_menu($id),
            'submenu'=>$this->Menu_m->get_submenu($id),
        );


        $this->load->view('Mssubunit_view',$data);
      }

	  function ambiledit($ids)
		  {
        $id = get_cookie('eklinik');
        $id_subunit=$this->uri->segment(3);

        $query_data="SELECT
    mastersubunit.kd_sub_unit,
    mastersubunit.nama_sub_unit,
    mastersubunit.alamat_sub_unit,
    mastersubunit.id_kota,
    mastersubunit.telepon,
    mastersubunit.email,
    mastersubunit.fax,
    mastersubunit.entry_user,
    mastersubunit.entry_date,
    masterunit.kd_unit,
    masterunit.nama_unit,
    ms_pegawai.nama AS nama_pegawai,
    ms_kabupaten.`name` AS nama_kota
    FROM
    mastersubunit
    LEFT JOIN masterunit ON mastersubunit.kd_unit = masterunit.kd_unit
    LEFT JOIN `user` ON mastersubunit.entry_user = `user`.id_user
    LEFT JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
    LEFT JOIN ms_kabupaten ON mastersubunit.id_kota = ms_kabupaten.id
                    WHERE mastersubunit.kd_sub_unit = '$id_subunit'";
        //echo $query_data;
        $data=array(
            'perintah'=>'Update',
            'title'=>'Master subunit',
            'xmenu'=>'Master',
            'xsubmenu'=>'Master subunit',
            'data_sub_unit'=>$this->Bis_model->manualQuery($query_data),
            'data_status_aktif' => $this->Bis_model->getAllData('ms_status_aktif'),
            'data_kabupaten' => $this->Bis_model->getAllData('ms_kabupaten'),
            'data_unit' => $this->Bis_model->getAllData('masterunit'),
            'users'=>$this->Hak_Akses_m->get_user(),
            'menu'=>$this->Menu_m->get_menu($id),
            'submenu'=>$this->Menu_m->get_submenu($id),
        );
			$this->load->view('Mssubunit_baru_view',$data);
  }

//    ======================== EDIT =======================
    function edit(){
        $id['kd_sub_unit'] = $this->input->post('kd_sub_unit');
		    //$id_subunit=$this->input->post('id_subunit');
        $now = date('Y-m-d H:i:s');
        $cookie_id_user = get_cookie('eklinik');

        $data=array(
          'nama_sub_unit'=>$this->input->post('nama_sub_unit'),
          'alamat_sub_unit'=>$this->input->post('alamat_sub_unit'),
          'telepon'=>$this->input->post('telepon'),
          'fax'=>$this->input->post('fax'),
          'email'=>$this->input->post('email'),
          'kd_unit'=>$this->input->post('kd_unit'),
          'id_kota'=>$this->input->post('id_kota'),
          'edit_user'=>$cookie_id_user,
          'edit_date'=>$now,
        );

        $this->db->trans_begin();
        $this->Bis_model->updateData('mastersubunit',$data,$id);

        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                $this->session->set_flashdata('message', 'Gagal edit data.');
                $this->session->set_flashdata('jenis', 'danger');
                redirect(site_url('Mssubunit'));
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses edit data.');
                $this->session->set_flashdata('jenis', 'info');
                redirect(site_url('Mssubunit'));
        }



    }

//    ========================== DELETE =======================
    function hapus(){
        $id['kd_sub_unit'] = $this->uri->segment(3);
        $this->db->trans_begin();
        $this->Bis_model->deleteData('mastersubunit',$id);
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Gagal hapus data.');
                $this->session->set_flashdata('jenis', 'danger');
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses hapus data.');
                $this->session->set_flashdata('jenis', 'success');
                redirect(site_url('mssubunit'));
        }

    }
//    ====================== EXPORT KE EXCEL ===================
      function exportexcel()
      {
        $data['data_jabatan'] = $this->Bis_model->getAllData('ms_jabatan');
        $this->load->view('export/msjabatan_export',$data);
      }
}
