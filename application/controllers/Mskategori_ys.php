<?php
class Mskategori extends CI_Controller{
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
ms_kategori.id_kategori,
ms_kategori.nama,
ms_kategori.keterangan,
ms_kategori.status_aktif,
ms_kategori.entry_date,
`user`.id_user,
ms_pegawai.nama AS nama_pegawai,
ms_status_aktif.nama_status_aktif
FROM
ms_kategori
LEFT JOIN `user` ON ms_kategori.entry_user = `user`.id_user
LEFT JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
LEFT JOIN ms_status_aktif ON ms_kategori.status_aktif = ms_status_aktif.id_status_aktif ORDER BY ms_kategori.nama ASC";


      $data=array(
          'title'=>'Master kategori',
          'xmenu'=>'Master',
          'xsubmenu'=>'kategori',
          'data_kategori'=>$this->Bis_model->manualQuery($query_data),
          'users'=>$this->Hak_Akses_m->get_user(),
          'menu'=>$this->Menu_m->get_menu($id),
          'submenu'=>$this->Menu_m->get_submenu($id),
      );

      $this->load->view('Mskategori_view',$data);
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
      //$id_kategori= $this->Bis_model->getIdkategori($kode_bukti);
      $data=array(

          'nama'=>$this->input->post('nama'),

          'status_aktif'=>$this->input->post('id_status_aktif'),

          'entry_user'=>$cookie_id_user,
          'entry_date'=>$now,
      );
      $this->db->trans_begin();
      $this->Bis_model->insertData('ms_kategori',$data);

      if ($this->db->trans_status() === FALSE)
      {
              $this->db->trans_rollback();
              $this->session->set_flashdata('message', 'Gagal tambah data baru.');
              $this->session->set_flashdata('jenis', 'danger');
              redirect(site_url('Mskategori'));
      }
      else
      {
              $this->db->trans_commit();
              $this->session->set_flashdata('message', 'Sukses tambah data baru.');
              $this->session->set_flashdata('jenis', 'success');
              redirect(site_url('Mskategori'));
      }

      }

      function baru(){
        $id = get_cookie('eklinik');

        $query_supplier="select * from ms_supplier";

        $query_kategori="select * from ms_kategori";
        $query_kategori="select * from ms_kategori";
    		//$data['data_jenis'] = $this->Bis_model->getAllData('ms_jenis');
    		//$data['data_kategori'] = $this->Bis_model->getAllData('ms_kategori');
    		//$data['data_supplier'] = $this->Bis_model->getAllData('ms_supplier');

        $data=array(
            'perintah'=>'Baru',
            'title'=>'Master kategori',
            'xmenu'=>'Master',
            'xsubmenu'=>'kategori',


            'data_status_aktif' => $this->Bis_model->getAllData('ms_status_aktif'),
            'data_kategori' => $this->Bis_model->getAllData('ms_kategori'),
            'data_tipe' => $this->Bis_model->getAllData('ms_tipe'),
            'users'=>$this->Hak_Akses_m->get_user(),
            'menu'=>$this->Menu_m->get_menu($id),
            'submenu'=>$this->Menu_m->get_submenu($id),
        );


        $this->load->view('Mskategori_baru_view',$data);
      }

      function filter(){
        $id = get_cookie('eklinik');
        $filter = $this->input->post('katakunci');
        $query_supplier="select * from ms_supplier";

        $query_kategori="select * from ms_kategori";
        $query_kategori="select * from ms_kategori";
        $query_data="SELECT
                    ms_kategori.id_kategori,
                    ms_kategori.nama,
                    ms_kategori.keterangan,
                    ms_kategori.status_aktif,
                    ms_kategori.entry_date,
                    `user`.id_user,
                    ms_pegawai.nama AS nama_pegawai,
                    ms_status_aktif.nama_status_aktif
                    FROM
                    ms_kategori
                    LEFT JOIN `user` ON ms_kategori.entry_user = `user`.id_user
                    LEFT JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
                    LEFT JOIN ms_status_aktif ON ms_kategori.status_aktif = ms_status_aktif.id_status_aktif
                    WHERE ms_kategori.nama like '%$filter%' ORDER BY ms_kategori.nama ASC ";
        //echo $query_data;
        $data=array(
            'title'=>'Master kategori',
            'xmenu'=>'Master',
            'xsubmenu'=>'kategori',

            'data_kategori'=>$this->Bis_model->manualQuery($query_data),
            'data_status_aktif' => $this->Bis_model->getAllData('ms_status_aktif'),


            'users'=>$this->Hak_Akses_m->get_user(),
            'menu'=>$this->Menu_m->get_menu($id),
            'submenu'=>$this->Menu_m->get_submenu($id),
        );


        $this->load->view('Mskategori_view',$data);
      }

	  function ambiledit($ids)
		  {
        $id = get_cookie('eklinik');
        $id_kategori=$this->uri->segment(3);
        //$id['id_kategori'] = $this->uri->segment(3);
        $query_supplier="select * from ms_supplier";
        $query_jenis="select * from ms_jenis_kategori";
        $query_kategori="select * from ms_kategori";
        $query_kategori="select * from ms_kategori";
        $query_data="SELECT
                    ms_kategori.id_kategori,
                    ms_kategori.nama,
                    ms_kategori.keterangan,
                    ms_kategori.status_aktif,
                    ms_kategori.entry_date,
                    `user`.id_user,
                    ms_pegawai.nama AS nama_pegawai,
                    ms_status_aktif.nama_status_aktif,
                    ms_status_aktif.id_status_aktif
                    FROM
                    ms_kategori
                    LEFT JOIN `user` ON ms_kategori.entry_user = `user`.id_user
                    LEFT JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
                    LEFT JOIN ms_status_aktif ON ms_kategori.status_aktif = ms_status_aktif.id_status_aktif
                    WHERE ms_kategori.id_kategori = '$id_kategori'";
        //echo $query_data;
        $data=array(
            'perintah'=>'Update',
            'title'=>'Master kategori',
            'xmenu'=>'Master',
            'xsubmenu'=>'Master kategori',
            'data_kategori'=>$this->Bis_model->manualQuery($query_kategori),
            'data_kategori'=>$this->Bis_model->manualQuery($query_data),
            'data_status_aktif' => $this->Bis_model->getAllData('ms_status_aktif'),


            'users'=>$this->Hak_Akses_m->get_user(),
            'menu'=>$this->Menu_m->get_menu($id),
            'submenu'=>$this->Menu_m->get_submenu($id),
        );
			$this->load->view('Mskategori_baru_view',$data);
  }

//    ======================== EDIT =======================
    function edit(){
        $id['id_kategori'] = $this->input->post('id_kategori');
		    $id_kategori=$this->input->post('id_kategori');
        $now = date('Y-m-d H:i:s');
        $cookie_id_user = get_cookie('eklinik');

        $data=array(


          'nama'=>$this->input->post('nama'),

          'status_aktif'=>$this->input->post('id_status_aktif'),
          'edit_user'=>$cookie_id_user,
          'edit_date'=>$now,
        );

        $this->db->trans_begin();
        $this->Bis_model->updateData('ms_kategori',$data,$id);

        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                $this->session->set_flashdata('message', 'Gagal edit data.');
                $this->session->set_flashdata('jenis', 'danger');
                redirect(site_url('Mskategori'));
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses edit data.');
                $this->session->set_flashdata('jenis', 'info');
                redirect(site_url('Mskategori'));
        }



    }

//    ========================== DELETE =======================
    function hapus(){
        $id['id_kategori'] = $this->uri->segment(3);
        $this->db->trans_begin();
        $this->Bis_model->deleteData('ms_kategori',$id);
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
                redirect(site_url('mskategori'));
        }

    }
//    ====================== EXPORT KE EXCEL ===================
      function exportexcel()
      {
        $data['data_jabatan'] = $this->Bis_model->getAllData('ms_jabatan');
        $this->load->view('export/msjabatan_export',$data);
      }
}
