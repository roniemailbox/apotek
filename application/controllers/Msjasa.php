<?php
class Msjasa extends CI_Controller{
  function __construct(){
        parent::__construct();
        $this->load->model('umum/Bis_model');
        $this->load->model('Menu_m');
        $this->load->model('Hak_Akses_m');
        $this->load->model('Login_m');
        $this->load->helper('currency_format_helper');
   	    $this->load->helper('terbilang_helper');
   	    $this->load->helper('format_tanggal_helper');
        //$this->load->helper('currency_format_helper');
        //

    }
  function index()
  {

    $id = get_cookie('eklinik');

    $query_jasa="SELECT
                  	ms_jasa.id_jasa,
                  	ms_jasa.nama as jasa,
                  	ms_jasa.nilai,
                  	ms_jasa.edit_date,
                  	ms_jasa.edit_user,
                  	ms_jasa.entry_date,
                  	ms_jasa.entry_user,
                  	ms_jasa.status_aktif,
                  	b.nama AS nama_pegawai,
                  	d.nama AS nama_edit_pegawai
                  FROM
                  	ms_jasa
                  	LEFT JOIN `user` AS a ON ms_jasa.entry_user = a.id_user
                  	LEFT JOIN ms_pegawai AS b ON a.id_pegawai = b.id_pegawai
                  	LEFT JOIN `user` AS c ON ms_jasa.edit_user = c.id_user
                  	LEFT JOIN ms_pegawai AS d ON c.id_pegawai = d.id_pegawai limit 100";
    $data=array(
                        'perintah'=>'Baru',
                        'title'=>'Daftar Jasa',
                        'title_filter'=>'Cari Jasa',
                        'title_tambah'=>'Input Jasa Baru',
                        'title_report'=>'Laporan Jasa',
                        'data_jasa'=> $this->Bis_model->manualQuery($query_jasa),
                       'users'=> $this->Hak_Akses_m->get_user($id),
                       'menu'=> $this->Menu_m->get_menu($id),
                       'submenu'=> $this->Menu_m->get_submenu($id),
    );

    $this->load->view('Msjasa_view',$data);
  }
  function ambiledit()
  {
    $id = get_cookie('eklinik');
    //$id_edit=$this->uri->segment(3);
    $id_edit=$this->input->post('id_jasa');
    $query_jasa="SELECT
                  	ms_jasa.id_jasa,
                  	ms_jasa.nama as jasa,
                  	ms_jasa.nilai,
                  	ms_jasa.edit_date,
                  	ms_jasa.edit_user,
                  	ms_jasa.entry_date,
                  	ms_jasa.entry_user,
                  	ms_jasa.status_aktif,
                  	b.nama AS nama_pegawai,
                  	d.nama AS nama_edit_pegawai
                  FROM
                  	ms_jasa
                  	LEFT JOIN `user` AS a ON ms_jasa.entry_user = a.id_user
                  	LEFT JOIN ms_pegawai AS b ON a.id_pegawai = b.id_pegawai
                  	LEFT JOIN `user` AS c ON ms_jasa.edit_user = c.id_user
                  	LEFT JOIN ms_pegawai AS d ON c.id_pegawai = d.id_pegawai limit 100";

   $query_jasa_edit="SELECT
                  	ms_jasa.id_jasa,
                  	ms_jasa.nama AS jasa,
                  	ms_jasa.nilai,
                  	ms_jasa.edit_date,
                  	ms_jasa.edit_user,
                  	ms_jasa.entry_date,
                  	ms_jasa.entry_user,
                  	ms_jasa.status_aktif,
                  	b.nama AS nama_pegawai,
                  	d.nama AS nama_edit_pegawai
                  FROM
                  	ms_jasa
                  	LEFT JOIN `user` AS a ON ms_jasa.entry_user = a.id_user
                  	LEFT JOIN ms_pegawai AS b ON a.id_pegawai = b.id_pegawai
                  	LEFT JOIN `user` AS c ON ms_jasa.edit_user = c.id_user
                  	LEFT JOIN ms_pegawai AS d ON c.id_pegawai = d.id_pegawai
                  WHERE
                  	ms_jasa.id_jasa = '$id_edit'";


    $data=array(
        'perintah'=>'Edit',
        'title'=>'Daftar Jasa',
        'title_filter'=>'Cari Jasa',
        'title_tambah'=>'Edit Data Jasa',
        'title_report'=>'Laporan Jasa',
        'data_jasa'=>$this->Bis_model->manualQuery($query_jasa),
        'data_jasa_edit'=>$this->Bis_model->manualQuery($query_jasa_edit),

        'users'=>$this->Hak_Akses_m->get_user($id),
        'menu'=>$this->Menu_m->get_menu($id),
        'submenu'=>$this->Menu_m->get_submenu($id),
    );
    $this->load->view('Msjasa_view',$data);
  }
//    ===================== INSERT =====================
    function tambah()
    {
      $now = date('Y-m-d H:i:s');
      $cookie_id_user = get_cookie('eklinik');
      //$id_jasa=str_replace(' ', '',$this->input->post('id_jasa'));
      $kodeUnit="J";
      $id_jasa= $this->Bis_model->getIdJasa($kodeUnit);
      $data=array(
          'id_jasa'=>$id_jasa,
          'nama'=>$this->input->post('nama'),
          'nilai'=>$this->input->post('nilai'),
          //'jenis_jasa'=>$this->input->post('jenis_jasa'),
          //'id_bisnis'=>$this->input->post('id_bisnis'),
          'entry_user'=>$cookie_id_user,
          'entry_date'=>$now,
      );
      $this->load->model('umum/Bis_model');

      $this->db->trans_begin();
      $this->Bis_model->insertData('ms_jasa',$data);
      if ($this->db->trans_status() === FALSE)
      {
              $this->db->trans_rollback();
      }
      else
      {
              $this->db->trans_commit();
              $this->session->set_flashdata('message', 'Sukses tambah data.');
              $this->session->set_flashdata('jenis', 'success');
              redirect(site_url('msjasa'));
      }

      }

//    ======================== EDIT =======================
    function edit(){
        $id['id_jasa'] = $this->input->post('id_jasa');
        $now = date('Y-m-d H:i:s');
        $cookie_id_user = get_cookie('eklinik');
        $data=array(
          'nama'=>$this->input->post('nama'),
          'nilai'=>$this->input->post('nilai'),
          //'jenis_jasa'=>$this->input->post('jenis_jasa'),
          //'id_bisnis'=>$this->input->post('id_bisnis'),
          'edit_user'=>$cookie_id_user,
          'edit_date'=>$now,
        );
        $this->load->model('umum/Bis_model');

        $this->db->trans_begin();
        $this->Bis_model->updateData('ms_jasa',$data,$id);
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses edit data.');
                $this->session->set_flashdata('jenis', 'info');
                redirect(site_url('Msjasa'));
        }

    }

//    ========================== DELETE =======================
    function hapus(){
        $id['id_jasa'] = $this->uri->segment(3);
        $this->load->model('umum/Bis_model');
        $this->db->trans_begin();
        $this->Bis_model->deleteData('ms_jasa',$id);
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses hapus data.');
                $this->session->set_flashdata('jenis', 'danger');
                redirect(site_url('msjasa'));
        }

    }
//    ====================== EXPORT KE EXCEL ===================

}
