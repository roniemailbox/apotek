<?php
class Msjabatan extends CI_Controller{
  function __construct(){
        parent::__construct();
        $this->load->model('umum/Bis_model');
        $this->load->model('umum/Bis_model_ant');
        $this->load->model('Menu_m');
        $this->load->model('Hak_Akses_m');
        $this->load->model('Login_m');
        //$this->load->helper('currency_format_helper');
  }
  function index()
  {
    $id = get_cookie('eklinik');
    //$query_status = "SELECT * FROM ms_jabatan";
    $query_data="SELECT
      ms_jabatan.id_jabatan,
      ms_jabatan.nama,
      ms_jabatan.keterangan,
      ms_jabatan.status_aktif,
      ms_jabatan.entry_date,
      `user`.id_user,
      ms_pegawai.nama AS nama_pegawai,
      ms_status_aktif.nama_status_aktif 
    FROM
      ms_jabatan
      LEFT JOIN `user` ON ms_jabatan.entry_user = `user`.id_user
      LEFT JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
      LEFT JOIN ms_status_aktif ON ms_jabatan.status_aktif = ms_status_aktif.id_status_aktif 
    ORDER BY
      ms_jabatan.id_jabatan ASC";


      $data=array(
        'perintah'=>'Baru',
        'title'=>'Master Jabatan',
        'title_filter'=>'Cari Data',
        'title_tambah'=>'Input Baru',
        //'title_repopasien'=>'Laporan Pasien',
        'data_jabatan'=>$this->Bis_model->manualQuery($query_data),
        'data_status_aktif' => $this->Bis_model->getAllData('ms_status_aktif'),
        'users'=>$this->Hak_Akses_m->get_user($id),
        'menu'=>$this->Menu_m->get_menu($id),
        'submenu'=>$this->Menu_m->get_submenu($id),
      );

      $this->load->view('Msjabatan_view',$data);
  }

//    ===================== INSERT =====================
    function tambah()
    {
      $now = date('Y-m-d H:i:s');
      $cookie_id_user = get_cookie('eklinik');
      $date = new DateTime($now);

      $year = $date -> format('y');
      $month = $date -> format('m');
      $day = $date -> format('d');

      $data=array(

          'nama'=>$this->input->post('nama'),

          'status_aktif'=>$this->input->post('id_status_aktif'),

          'entry_user'=>$cookie_id_user,
          'entry_date'=>$now
      );
      $this->db->trans_begin();
      $this->Bis_model->insertData('ms_jabatan',$data);

      if ($this->db->trans_status() === FALSE)
      {
              $this->db->trans_rollback();
              $this->session->set_flashdata('message', 'Gagal tambah data baru.');
              $this->session->set_flashdata('jenis', 'danger');
              redirect(site_url('Msjabatan'));
      }
      else
      {
              $this->db->trans_commit();
              $this->session->set_flashdata('message', 'Sukses tambah data baru.');
              $this->session->set_flashdata('jenis', 'success');
              redirect(site_url('Msjabatan'));
      }

      }

      function Dataedit()
    {
    $id = get_cookie('eklinik');
    $id_jabatan=$this->input->post('id_jabatan');
    //$query_status = "SELECT * FROM ms_jabatan";
    $query_jabatan="SELECT
      ms_jabatan.id_jabatan,
      ms_jabatan.nama,
      ms_jabatan.keterangan,
      ms_jabatan.status_aktif,
      ms_jabatan.entry_date,
      `user`.id_user,
      ms_pegawai.nama AS nama_pegawai,
      ms_status_aktif.nama_status_aktif 
    FROM
      ms_jabatan
      LEFT JOIN `user` ON ms_jabatan.entry_user = `user`.id_user
      LEFT JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
      LEFT JOIN ms_status_aktif ON ms_jabatan.status_aktif = ms_status_aktif.id_status_aktif 
    ORDER BY
      ms_jabatan.id_jabatan ASC";

    $query_jabatan_edit="SELECT
    ms_jabatan.id_jabatan,
    ms_jabatan.nama,
    ms_jabatan.keterangan,
    ms_jabatan.status_aktif,
    ms_jabatan.entry_date,
    `user`.id_user,
    ms_pegawai.nama AS nama_pegawai,
    ms_status_aktif.nama_status_aktif,
    ms_status_aktif.id_status_aktif
    FROM
    ms_jabatan
    LEFT JOIN `user` ON ms_jabatan.entry_user = `user`.id_user
    LEFT JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
    LEFT JOIN ms_status_aktif ON ms_jabatan.status_aktif = ms_status_aktif.id_status_aktif
    WHERE
    ms_jabatan.id_jabatan = '$id_jabatan'
    ";

      $data=array(
        'perintah'=>'Edit',
        'title'=>'Edit Master Jabatan',
        'title_filter'=>'Cari Data',
        'title_tambah'=>'Input Baru',
        //'title_repopasien'=>'Laporan Pasien',
        'data_jabatan'=>$this->Bis_model->manualQuery($query_jabatan),
        'data_jabatan_edit'=>$this->Bis_model->manualQuery($query_jabatan_edit),
        'data_status_aktif' => $this->Bis_model->getAllData('ms_status_aktif'),
        'users'=>$this->Hak_Akses_m->get_user($id),
        'menu'=>$this->Menu_m->get_menu($id),
        'submenu'=>$this->Menu_m->get_submenu($id),
      );

      $this->load->view('Msjabatan_view',$data);
  }


      function filter(){
        $id = get_cookie('eklinik');
        $filter = $this->input->post('katakunci');
        //$query_status = "SELECT * FROM ms_jabatan";
        $query_data="SELECT
            ms_jabatan.id_jabatan,
            ms_jabatan.nama,
            ms_jabatan.keterangan,
            ms_jabatan.status_aktif,
            ms_jabatan.entry_date,
            `user`.id_user,
            ms_pegawai.nama AS nama_pegawai,
            ms_status_aktif.nama_status_aktif 
          FROM
            ms_jabatan
            LEFT JOIN `user` ON ms_jabatan.entry_user = `user`.id_user
            LEFT JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
            LEFT JOIN ms_status_aktif ON ms_jabatan.status_aktif = ms_status_aktif.id_status_aktif 
          WHERE
            ms_jabatan.nama LIKE '%$filter%' 
          ORDER BY
            ms_jabatan.nama ASC ";
        //echo $query_data;
        $data=array(
            'perintah'=>'Baru',
            'title'=>'Master Jabatan',
            'title_filter'=>'Cari Data',
            'title_tambah'=>'Input Baru',
            'data_jabatan'=>$this->Bis_model->manualQuery($query_data),
            'data_status_aktif' => $this->Bis_model->getAllData('ms_status_aktif'),
            'users'=>$this->Hak_Akses_m->get_user($id),
            'menu'=>$this->Menu_m->get_menu($id),
            'submenu'=>$this->Menu_m->get_submenu($id),
        );


        $this->load->view('Msjabatan_view',$data);
      }

//    ======================== EDIT =======================
    function edit(){
        $id['id_jabatan'] = $this->input->post('id_jabatan');
		    //$id_jabatan=$this->input->post('id_jabatan');
        $now = date('Y-m-d H:i:s');
        $cookie_id_user = get_cookie('eklinik');

        $data=array(


          'nama'=>$this->input->post('nama'),

          'status_aktif'=>$this->input->post('id_status_aktif'),
          'edit_user'=>$cookie_id_user,
          'edit_date'=>$now
        );

        $this->db->trans_begin();
        $this->Bis_model->updateData('ms_jabatan',$data,$id);

        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                $this->session->set_flashdata('message', 'Gagal edit data.');
                $this->session->set_flashdata('jenis', 'danger');
                redirect(site_url('Msjabatan'));
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses edit data.');
                $this->session->set_flashdata('jenis', 'info');
                redirect(site_url('Msjabatan'));
        }



    }

//    ========================== DELETE =======================
    function hapus(){
        $id['id_jabatan'] = $this->input->post('id_jabatan');
        $this->db->trans_begin();
        $this->Bis_model->deleteData('ms_jabatan',$id);
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
                redirect(site_url('msjabatan'));
        }

    }
//    ====================== EXPORT KE EXCEL ===================
      function exportexcel()
      {
        $data['data_jabatan'] = $this->Bis_model->getAllData('ms_jabatan');
        $this->load->view('export/msjabatan_export',$data);
      }
}
