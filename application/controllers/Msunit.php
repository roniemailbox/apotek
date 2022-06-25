<?php
class Msunit extends CI_Controller{
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
      ms_perusahaan.nama AS nama_perusahaan,
      ms_kabupaten.`name` AS nama_kota,
      masterunit.kd_unit,
      masterunit.nama_unit,
      masterunit.alamat_unit,
      masterunit.telepon,
      masterunit.fax,
      masterunit.email,
      ms_pegawai.nama AS nama_pegawai,
      masterunit.tema,
      masterunit.entry_date
      FROM
      masterunit
      LEFT JOIN ms_kabupaten ON masterunit.id_kabupaten = ms_kabupaten.id
      LEFT JOIN ms_perusahaan ON masterunit.id_perusahaan = ms_perusahaan.id_perusahaan
      LEFT JOIN `user` ON masterunit.entry_user = `user`.id_user
      LEFT JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai";

      $data=array(
          'title'=>'Master Unit',
          'xmenu'=>'Master',
          'xsubmenu'=>'Unit',
          'data_unit'=>$this->Bis_model->manualQuery($query_data),
          'users'=>$this->Hak_Akses_m->get_user(),
          'menu'=>$this->Menu_m->get_menu($id),
          'submenu'=>$this->Menu_m->get_submenu($id),
      );

      $this->load->view('Msunit_view',$data);
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
      //$id_unit= $this->Bis_model->getIdunit($kode_bukti);
      $data=array(
        'nama_unit'=>$this->input->post('nama_unit'),
        'alamat_unit'=>$this->input->post('alamat_unit'),
        'telepon'=>$this->input->post('telepon'),
        'fax'=>$this->input->post('fax'),
        'email'=>$this->input->post('email'),
        'id_perusahaan'=>$this->input->post('id_perusahaan'),
        'id_kabupaten'=>$this->input->post('id_kabupaten'),
        'entry_user'=>$cookie_id_user,
        'entry_date'=>$now,
      );
      $this->db->trans_begin();
      $this->Bis_model->insertData('masterunit',$data);

      if ($this->db->trans_status() === FALSE)
      {
              $this->db->trans_rollback();
              $this->session->set_flashdata('message', 'Gagal tambah data baru.');
              $this->session->set_flashdata('jenis', 'danger');
              redirect(site_url('Msunit'));
      }
      else
      {
              $this->db->trans_commit();
              $this->session->set_flashdata('message', 'Sukses tambah data baru.');
              $this->session->set_flashdata('jenis', 'success');
              redirect(site_url('Msunit'));
      }

      }

      function baru(){
        $id = get_cookie('eklinik');

        $query_supplier="select * from ms_kabupaten";
        $query_kategori="select * from ms_kategori";
        $query_perusahaan="select * from ms_perusahaan";


        $data=array(
            'perintah'=>'Baru',
            'title'=>'Master unit',
            'xmenu'=>'Master',
            'xsubmenu'=>'unit',


            'data_status_aktif' => $this->Bis_model->getAllData('ms_status_aktif'),
            'data_unit' => $this->Bis_model->getAllData('ms_unit'),
            'data_kabupaten' => $this->Bis_model->getAllData('ms_kabupaten'),
            'data_perusahaan' => $this->Bis_model->getAllData('ms_perusahaan'),
            'users'=>$this->Hak_Akses_m->get_user(),
            'menu'=>$this->Menu_m->get_menu($id),
            'submenu'=>$this->Menu_m->get_submenu($id),
        );


        $this->load->view('Msunit_baru_view',$data);
      }

      function filter(){
        $id = get_cookie('eklinik');
        $filter = $this->input->post('katakunci');
        $query_supplier="select * from ms_supplier";

        $query_kategori="select * from ms_kategori";
        $query_satuan="select * from ms_satuan";
        $query_data="SELECT
                    ms_perusahaan.nama AS nama_perusahaan,
                    ms_kabupaten.`name` AS nama_kota,
                    masterunit.kd_unit,
                    masterunit.nama_unit,
                    masterunit.alamat_unit,
                    masterunit.telepon,
                    masterunit.fax,
                    masterunit.email,
                    ms_pegawai.nama AS nama_pegawai,
                    masterunit.tema,,
                    masterunit.entry_date
                    FROM
                    masterunit
                    LEFT JOIN ms_kabupaten ON masterunit.id_kabupaten = ms_kabupaten.id
                    LEFT JOIN ms_perusahaan ON masterunit.id_perusahaan = ms_perusahaan.id_perusahaan
                    LEFT JOIN `user` ON masterunit.entry_user = `user`.id_user
                    LEFT JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
                    WHERE masterunit.nama like '%$filter%' ORDER BY masterunit.nama ASC ";
        //echo $query_data;
        $data=array(
            'title'=>'Master Unit',
            'xmenu'=>'Master',
            'xsubmenu'=>'Unit',

            'data_unit'=>$this->Bis_model->manualQuery($query_data),
            'data_status_aktif' => $this->Bis_model->getAllData('ms_status_aktif'),

            'data_kabupaten' => $this->Bis_model->getAllData('ms_kabupaten'),
            'data_perusahaan' => $this->Bis_model->getAllData('ms_perusahaan'),
            'users'=>$this->Hak_Akses_m->get_user(),
            'menu'=>$this->Menu_m->get_menu($id),
            'submenu'=>$this->Menu_m->get_submenu($id),
        );


        $this->load->view('Msunit_view',$data);
      }

	  function ambiledit($ids)
		  {
        $id = get_cookie('eklinik');
        $id_unit=$this->uri->segment(3);

        $query_data="SELECT
                    ms_perusahaan.nama AS nama_perusahaan,
                    ms_kabupaten.`name` AS nama_kota,
                    masterunit.kd_unit,
                    masterunit.nama_unit,
                    masterunit.alamat_unit,
                    masterunit.telepon,
                    masterunit.fax,
                    masterunit.email,
                    ms_pegawai.nama AS nama_pegawai,
                    masterunit.tema,
                    masterunit.entry_date,
                    ms_perusahaan.id_perusahaan,
                    masterunit.id_kabupaten
                    FROM
                    	masterunit
                    LEFT JOIN ms_kabupaten ON masterunit.id_kabupaten = ms_kabupaten.id
                    LEFT JOIN ms_perusahaan ON masterunit.id_perusahaan = ms_perusahaan.id_perusahaan
                    LEFT JOIN `user` ON masterunit.entry_user = `user`.id_user
                    LEFT JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
                    WHERE masterunit.kd_unit = '$id_unit'";
        //echo $query_data;
        $data=array(
            'perintah'=>'Update',
            'title'=>'Master Unit',
            'xmenu'=>'Master',
            'xsubmenu'=>'Master Unit',
            'data_unit'=>$this->Bis_model->manualQuery($query_data),
            'data_status_aktif' => $this->Bis_model->getAllData('ms_status_aktif'),
            'data_kabupaten' => $this->Bis_model->getAllData('ms_kabupaten'),
            'data_perusahaan' => $this->Bis_model->getAllData('ms_perusahaan'),
            'users'=>$this->Hak_Akses_m->get_user(),
            'menu'=>$this->Menu_m->get_menu($id),
            'submenu'=>$this->Menu_m->get_submenu($id),
        );
			$this->load->view('Msunit_baru_view',$data);
  }

//    ======================== EDIT =======================
    function edit(){
        $id['kd_unit'] = $this->input->post('id_unit');
		    //$id_unit=$this->input->post('id_unit');
        $now = date('Y-m-d H:i:s');
        $cookie_id_user = get_cookie('eklinik');

        $data=array(
          'nama_unit'=>$this->input->post('nama_unit'),
          'alamat_unit'=>$this->input->post('alamat_unit'),
          'telepon'=>$this->input->post('telepon'),
          'fax'=>$this->input->post('fax'),
          'email'=>$this->input->post('email'),
          'id_perusahaan'=>$this->input->post('id_perusahaan'),
          'id_kabupaten'=>$this->input->post('id_kabupaten'),
          'edit_user'=>$cookie_id_user,
          'edit_date'=>$now,
        );

        $this->db->trans_begin();
        $this->Bis_model->updateData('masterunit',$data,$id);

        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                $this->session->set_flashdata('message', 'Gagal edit data.');
                $this->session->set_flashdata('jenis', 'danger');
                redirect(site_url('Msunit'));
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses edit data.');
                $this->session->set_flashdata('jenis', 'info');
                redirect(site_url('Msunit'));
        }



    }

//    ========================== DELETE =======================
    function hapus(){
        $id['kd_unit'] = $this->uri->segment(3);
        $this->db->trans_begin();
        $this->Bis_model->deleteData('masterunit',$id);
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
                redirect(site_url('msunit'));
        }

    }
//    ====================== EXPORT KE EXCEL ===================
      function exportexcel()
      {
        $data['data_jabatan'] = $this->Bis_model->getAllData('ms_jabatan');
        $this->load->view('export/msjabatan_export',$data);
      }
}
