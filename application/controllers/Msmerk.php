<?php
class Msmerk extends CI_Controller{
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
ms_merk.id_merk,
ms_merk.nama,
ms_merk.keterangan,
ms_merk.status_aktif,
ms_merk.entry_date,
`user`.id_user,
ms_pegawai.nama AS nama_pegawai,
ms_status_aktif.nama_status_aktif
FROM
ms_merk
LEFT JOIN `user` ON ms_merk.entry_user = `user`.id_user
LEFT JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
LEFT JOIN ms_status_aktif ON ms_merk.status_aktif = ms_status_aktif.id_status_aktif ORDER BY ms_merk.nama ASC";


      $data=array(
          'perintah' => 'Baru',
          'title'=>'Master Merk',
          'title_filter'=>'Cari Merk',
          'title_tambah'=>'Input Merk Baru',
          'xmenu'=>'Master',
          'xsubmenu'=>'Merk',
          'data_merk'=>$this->Bis_model->manualQuery($query_data),
          'data_status_aktif' => $this->Bis_model->getAllData('ms_status_aktif'),
          'users'=>$this->Hak_Akses_m->get_user(),
          'menu'=>$this->Menu_m->get_menu($id),
          'submenu'=>$this->Menu_m->get_submenu($id),
      );

      $this->load->view('Msmerk_view',$data);
  }

    function Dataedit ()
    {
      $id = get_cookie('eklinik');
      $id_edit=$this->input->post('id_merk');
    $query_data="SELECT
                  ms_merk.id_merk,
                  ms_merk.nama,
                  ms_merk.keterangan,
                  ms_merk.status_aktif,
                  ms_merk.entry_date,
                  `user`.id_user,
                  ms_pegawai.nama AS nama_pegawai,
                  ms_status_aktif.nama_status_aktif,
                  ms_status_aktif.id_status_aktif
                  FROM
                  ms_merk
                  LEFT JOIN `user` ON ms_merk.entry_user = `user`.id_user
                  LEFT JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
                  LEFT JOIN ms_status_aktif ON ms_merk.status_aktif = ms_status_aktif.id_status_aktif ORDER BY ms_merk.nama ASC";

      $query_data_edit="SELECT
                  ms_merk.id_merk,
                  ms_merk.nama,
                  ms_merk.keterangan,
                  ms_merk.status_aktif,
                  ms_merk.entry_date,
                  `user`.id_user,
                  ms_pegawai.nama AS nama_pegawai,
                  ms_status_aktif.nama_status_aktif,
                  ms_status_aktif.id_status_aktif
                  FROM
                  ms_merk
                  LEFT JOIN `user` ON ms_merk.entry_user = `user`.id_user
                  LEFT JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
                  LEFT JOIN ms_status_aktif ON ms_merk.status_aktif = ms_status_aktif.id_status_aktif
                  WHERE
                  ms_merk.id_merk = '$id_edit'";

      $data=array(
          'perintah' => 'Edit',
          'title'=>'Master Merk',
          'title_filter'=>'Cari Merk',
          'title_tambah'=>'Input Merk Baru',

          'data_merk'=>$this->Bis_model->manualQuery($query_data),
          'data_merk_edit'=>$this->Bis_model->manualQuery($query_data_edit),
          'data_status_aktif' => $this->Bis_model->getAllData('ms_status_aktif'),
          'users'=>$this->Hak_Akses_m->get_user($id),
          'menu'=>$this->Menu_m->get_menu($id),
          'submenu'=>$this->Menu_m->get_submenu($id),
      );

      $this->load->view('Msmerk_view',$data);
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
      $id_merk= $this->Bis_model->getIdmerk();
      //$id_merk=$this->input->post('id_merk');
      $data=array(
          'id_merk'=>$id_merk,
          'nama'=>$this->input->post('nama'),

          'status_aktif'=>$this->input->post('id_status_aktif'),

          'entry_user'=>$cookie_id_user,
          'entry_date'=>$now,
      );
      $this->db->trans_begin();
      $this->Bis_model->insertData('ms_merk',$data);

      if ($this->db->trans_status() === FALSE)
      {
              $this->db->trans_rollback();
              $this->session->set_flashdata('message', 'Gagal tambah data baru.');
              $this->session->set_flashdata('jenis', 'danger');
              redirect(site_url('Msmerk'));
      }
      else
      {
              $this->db->trans_commit();
              $this->session->set_flashdata('message', 'Sukses tambah data baru.');
              $this->session->set_flashdata('jenis', 'success');
              redirect(site_url('Msmerk'));
      }

      }



      function filter(){
        $id = get_cookie('eklinik');
        $filter = $this->input->post('katakunci');
        $query_data="SELECT
                    ms_merk.id_merk,
                    ms_merk.nama,
                    ms_merk.keterangan,
                    ms_merk.status_aktif,
                    ms_merk.entry_date,
                    `user`.id_user,
                    ms_pegawai.nama AS nama_pegawai,
                    ms_status_aktif.nama_status_aktif
                    FROM
                    ms_merk
                    LEFT JOIN `user` ON ms_merk.entry_user = `user`.id_user
                    LEFT JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
                    LEFT JOIN ms_status_aktif ON ms_merk.status_aktif = ms_status_aktif.id_status_aktif
                    WHERE ms_merk.nama like '%$filter%' or ms_merk.id_merk like '%$filter%'
                    ORDER BY ms_merk.nama ASC ";
        //echo $query_data;
        $data=array(
            'perintah' => 'Baru',
            'title'=>'Master Merk',

            'title_filter'=>'Cari Merk',
            'title_tambah'=>'Input Merk Baru',
            'data_merk'=>$this->Bis_model->manualQuery($query_data),
            'data_status_aktif' => $this->Bis_model->getAllData('ms_status_aktif'),
            'users'=>$this->Hak_Akses_m->get_user($id),
            'menu'=>$this->Menu_m->get_menu($id),
            'submenu'=>$this->Menu_m->get_submenu($id),
        );


        $this->load->view('Msmerk_view',$data);
      }



//    ======================== EDIT =======================
    function edit(){
        $id['id_merk'] = $this->input->post('id_merk');
		    //$id_merk=$this->input->post('id_merk');
        $now = date('Y-m-d H:i:s');
        $cookie_id_user = get_cookie('eklinik');

        $data=array(


          'nama'=>$this->input->post('nama'),

          'status_aktif'=>$this->input->post('id_status_aktif'),
          'edit_user'=>$cookie_id_user,
          'edit_date'=>$now,
        );

        $this->db->trans_begin();
        $this->Bis_model->updateData('ms_merk',$data,$id);

        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                $this->session->set_flashdata('message', 'Gagal edit data.');
                $this->session->set_flashdata('jenis', 'danger');
                redirect(site_url('Msmerk'));
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses edit data.');
                $this->session->set_flashdata('jenis', 'info');
                redirect(site_url('Msmerk'));
        }



    }

//    ========================== DELETE =======================
    function hapus(){
        //$id['id_merk'] = $this->uri->segment(3);
        $id['id_merk'] = $this->input->post('id_merk');

        $this->Bis_model->deleteData('ms_merk',$id);
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
                redirect(site_url('Msmerk'));
        }

    }
//    ====================== EXPORT KE EXCEL ===================
      function exportexcel()
      {
        $data['data_jabatan'] = $this->Bis_model->getAllData('ms_jabatan');
        $this->load->view('export/msjabatan_export',$data);
      }
}
