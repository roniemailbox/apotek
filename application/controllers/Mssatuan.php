<?php
class Mssatuan extends CI_Controller{
  function __construct(){
        parent::__construct();
        $this->load->model('umum/Bis_model');
        $this->load->model('Menu_m');
        $this->load->model('Hak_Akses_m');
        $this->load->model('Login_m');
        //$this->load->helper('currency_format_helper');
  }
  function index()
  {
    $id = get_cookie('eklinik');
    $query_data="SELECT
                ms_satuan.id_satuan,
                ms_satuan.nama,
                ms_satuan.keterangan,
                ms_satuan.status_aktif,
                ms_satuan.entry_date,
                `user`.id_user,
                ms_pegawai.nama AS nama_pegawai,
                ms_status_aktif.nama_status_aktif
                FROM
                ms_satuan
                LEFT JOIN `user` ON ms_satuan.entry_user = `user`.id_user
                LEFT JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
                LEFT JOIN ms_status_aktif ON ms_satuan.status_aktif = ms_status_aktif.id_status_aktif 
                ORDER BY ms_satuan.nama ASC";


      $data=array(
        'perintah'=>'Baru',
        'title'=>'Master Satuan',
        'title_filter'=>'Cari Master Satuan',
        'title_tambah'=>'Input Data',
        'data_satuan'=>$this->Bis_model->manualQuery($query_data),
        'data_status_aktif' => $this->Bis_model->getAllData('ms_status_aktif'),
        'users'=>$this->Hak_Akses_m->get_user($id),
        'menu'=>$this->Menu_m->get_menu($id),
        'submenu'=>$this->Menu_m->get_submenu($id),
      );

      $this->load->view('Mssatuan_view',$data);
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
      //$kode_bukti=$this->input->post('id_jenis');
      //$id_satuan= $this->Bis_model->getIdsatuan($kode_bukti);
      $data=array(
          'id_satuan'=>strtoupper($this->input->post('id_satuan')),
          'nama'=>$this->input->post('nama'),

          'status_aktif'=>$this->input->post('id_status_aktif'),

          'entry_user'=>$cookie_id_user,
          'entry_date'=>$now,
      );
      $this->db->trans_begin();
      $this->Bis_model->insertData('ms_satuan',$data);

      if ($this->db->trans_status() === FALSE)
      {
              $this->db->trans_rollback();
              $this->session->set_flashdata('message', 'Gagal tambah data baru.');
              $this->session->set_flashdata('jenis', 'danger');
              redirect(site_url('Mssatuan'));
      }
      else
      {
              $this->db->trans_commit();
              $this->session->set_flashdata('message', 'Sukses tambah data baru.');
              $this->session->set_flashdata('jenis', 'success');
              redirect(site_url('Mssatuan'));
      }

      }

      function filter(){
        $id = get_cookie('eklinik');
        $filter = $this->input->post('katakunci');
        //$query_supplier="select * from ms_supplier";
        //$query_kategori="select * from ms_kategori";
        //$query_satuan="select * from ms_satuan";
        $query_data="SELECT
                      ms_satuan.id_satuan,
                      ms_satuan.nama,
                      ms_satuan.keterangan,
                      ms_satuan.status_aktif,
                      ms_satuan.entry_date,
                      `user`.id_user,
                      ms_pegawai.nama AS nama_pegawai,
                      ms_status_aktif.nama_status_aktif 
                    FROM
                      ms_satuan
                      LEFT JOIN `user` ON ms_satuan.entry_user = `user`.id_user
                      LEFT JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
                      LEFT JOIN ms_status_aktif ON ms_satuan.status_aktif = ms_status_aktif.id_status_aktif 
                    WHERE
                      ms_satuan.nama LIKE '%$filter%' 
                      OR ms_status_aktif.nama_status_aktif LIKE '%$filter%' 
                    ORDER BY
                      ms_satuan.nama ASC";
        //echo $query_data;
        $data=array(
          'perintah'=>'Baru',
          'title'=>'Master Satuan',
          'title_filter'=>'Cari Master Satuan',
          'title_tambah'=>'Input Data',
          'data_satuan'=>$this->Bis_model->manualQuery($query_data),
          'data_status_aktif' => $this->Bis_model->getAllData('ms_status_aktif'),
          'users'=>$this->Hak_Akses_m->get_user($id),
          'menu'=>$this->Menu_m->get_menu($id),
          'submenu'=>$this->Menu_m->get_submenu($id),
        );


        $this->load->view('Mssatuan_view',$data);
      }

      function Dataedit()
      {
        $id = get_cookie('eklinik');
        $id_satuan=$this->input->post('id_satuan');
        
        $query_satuan="SELECT
                    ms_satuan.id_satuan,
                    ms_satuan.nama,
                    ms_satuan.keterangan,
                    ms_satuan.status_aktif,
                    ms_satuan.entry_date,
                    `user`.id_user,
                    ms_pegawai.nama AS nama_pegawai,
                    ms_status_aktif.nama_status_aktif
                    FROM
                    ms_satuan
                    LEFT JOIN `user` ON ms_satuan.entry_user = `user`.id_user
                    LEFT JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
                    LEFT JOIN ms_status_aktif ON ms_satuan.status_aktif = ms_status_aktif.id_status_aktif 
                    ORDER BY 
                    ms_satuan.nama ASC";
    
        $query_satuan_edit="SELECT
              ms_satuan.id_satuan,
              ms_satuan.nama,
              ms_satuan.keterangan,
              ms_satuan.status_aktif,
              ms_satuan.entry_date,
              `user`.id_user,
              ms_pegawai.nama AS nama_pegawai,
              ms_status_aktif.nama_status_aktif,
              ms_status_aktif.id_status_aktif 
            FROM
              ms_satuan
              LEFT JOIN `user` ON ms_satuan.entry_user = `user`.id_user
              LEFT JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
              LEFT JOIN ms_status_aktif ON ms_satuan.status_aktif = ms_status_aktif.id_status_aktif 
            WHERE
              ms_satuan.id_satuan = '$id_satuan'
                    ";

          $data=array(
            'perintah'=>'Edit',
            'title'=>'Master Satuan',
            'title_filter'=>'Cari Master Satuan',
            'title_tambah'=>'Input Data',
            'data_satuan'=>$this->Bis_model->manualQuery($query_satuan),
            'data_satuan_edit'=> $this->Bis_model->manualQuery($query_satuan_edit),
            //'data_status_aktif' => $this->Bis_model->getAllData('ms_status_aktif'),
            'data_status_aktif' => $this->Bis_model->getAllData('ms_status_aktif'),
            'users'=>$this->Hak_Akses_m->get_user(),
            'menu'=>$this->Menu_m->get_menu($id),
            'submenu'=>$this->Menu_m->get_submenu($id),
          );
    
          $this->load->view('Mssatuan_view',$data);
      }

//    ======================== EDIT =======================
    function edit(){
        $id['id_satuan'] = $this->input->post('id_satuan');
		    //$id_satuan=$this->input->post('id_satuan');
        $now = date('Y-m-d H:i:s');
        $cookie_id_user = get_cookie('eklinik');

        $data=array(


          'nama'=>$this->input->post('nama'),

          'status_aktif'=>$this->input->post('id_status_aktif'),
          'edit_user'=>$cookie_id_user,
          'edit_date'=>$now,
        );

        $this->db->trans_begin();
        $this->Bis_model->updateData('ms_satuan',$data,$id);

        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                $this->session->set_flashdata('message', 'Gagal edit data.');
                $this->session->set_flashdata('jenis', 'danger');
                redirect(site_url('Mssatuan'));
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses edit data.');
                $this->session->set_flashdata('jenis', 'info');
                redirect(site_url('Mssatuan'));
        }



    }

//    ========================== DELETE =======================
    function hapus(){
        //$id['id_satuan'] = $this->uri->segment(3);
        $id['id_satuan'] = $this->input->post('id_satuan');
        $this->db->trans_begin();
        $this->Bis_model->deleteData('ms_satuan',$id);
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
                redirect(site_url('mssatuan'));
        }

    }
//    ====================== EXPORT KE EXCEL ===================
      function exportexcel()
      {
        $data['data_jabatan'] = $this->Bis_model->getAllData('ms_jabatan');
        $this->load->view('export/msjabatan_export',$data);
      }
}
