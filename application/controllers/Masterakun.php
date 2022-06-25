<?php
class Masterakun extends CI_Controller{
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

      $query_akun="SELECT 
                  masterakun.kd_akun,
                  masterakun.nama,
                  masterakun.induk,
                  masterakun.detail,
                  masterakun.level,
                  masterakun.group,
                  masterakun.total,
                  masterakun.jenis_akun,
                  masterakun.saldo_normal,
                  masterakun.finance,
                  masterakun.status_akun,
                  masterakun.user_entry,
                  masterakun.date_entry,
                  masterakun.date_edit,
                  masterakun.user_edit
                  from 
                  masterakun limit 100"
                  ;

      $jml_akun = $this->db->get_where('masterakun')->num_rows();

      $data=array(
                          'perintah'=>'Baru',
                          'title'=>'Master Akun (COA)',
                          'title_filter'=>'Cari Akun',
                          'title_tambah'=>'Input Akun Baru',
                          
                          'data_akun'=> $this->Bis_model->manualQuery($query_akun),
                          'jml_akun' => $jml_akun,
                          'users'=> $this->Hak_Akses_m->get_user($id),
                          'menu'=> $this->Menu_m->get_menu($id),
                          'submenu'=> $this->Menu_m->get_submenu($id),
      );

      $this->load->view('Masterakun_view',$data);
    }

  function filter()
  {
    //'kd_barang'=>$this->model_app->getKodeBarang(),
    $id = get_cookie('eklinik');
    $filter = $this->input->post('katakunci');
    $jml_akun = $this->db->get_where('masterakun')->num_rows();
    
    $query_akun="SELECT 
                  masterakun.kd_akun,
                  masterakun.nama,
                  masterakun.induk,
                  masterakun.detail,
                  masterakun.level,
                  masterakun.group,
                  masterakun.total,
                  masterakun.jenis_akun,
                  masterakun.saldo_normal,
                  masterakun.finance,
                  masterakun.status_akun,
                  masterakun.user_entry,
                  masterakun.date_entry,
                  masterakun.date_edit,
                  masterakun.user_edit
                  from 
                  masterakun
                  WHERE masterakun.nama like '%$filter%' or masterakun.kd_akun like '%$filter%'";

                    $data=array(
                                        'perintah'=>'Baru',
                                        'title'=>'Master Akun (COA)',
                                        'title_filter'=>'Cari Akun',
                                        'title_tambah'=>'Input Akun Baru',
                                        'data_akun'=> $this->Bis_model->manualQuery($query_akun),
                                        'jml_akun' => $jml_akun,
                                        'users'=> $this->Hak_Akses_m->get_user($id),
                                       'menu'=> $this->Menu_m->get_menu($id),
                                       'submenu'=> $this->Menu_m->get_submenu($id),
                    );

                    $this->load->view('Masterakun_view',$data);

  }


  function Dataedit()
  {
    $id = get_cookie('eklinik');
    //$id_edit=$this->uri->segment(3);
    $id_edit=$this->input->post('kd_akun');
    $jml_akun = $this->db->get_where('masterakun')->num_rows();
    $query_akun="SELECT 
                  masterakun.kd_akun,
                  masterakun.nama,
                  masterakun.induk,
                  masterakun.detail,
                  masterakun.level,
                  masterakun.group,
                  masterakun.total,
                  masterakun.jenis_akun,
                  masterakun.saldo_normal,
                  masterakun.finance,
                  masterakun.status_akun,
                  masterakun.user_entry,
                  masterakun.date_entry,
                  masterakun.date_edit,
                  masterakun.user_edit
                  from 
                  masterakun
                    limit 100";

  $query_akun_edit="SELECT 
                    masterakun.kd_akun,
                    masterakun.nama,
                    masterakun.induk,
                    masterakun.detail,
                    masterakun.level,
                    masterakun.group,
                    masterakun.total,
                    masterakun.jenis_akun,
                    masterakun.saldo_normal,
                    masterakun.finance,
                    masterakun.status_akun,
                    masterakun.user_entry,
                    masterakun.date_entry,
                    masterakun.date_edit,
                    masterakun.user_edit
                    from 
                    masterakun
                    WHERE
                    masterakun.kd_akun = '$id_edit'";
    //echo $query_jenis_px;
//aa
    $data=array(
        'perintah'=>'Edit',
        'title'=>'Master Akun (COA)',
        'title_filter'=>'Cari Akun',
        'title_tambah'=>'Edit Data Akun',
        'title_report'=>'Laporan Pasien',
        'data_akun'=>$this->Bis_model->manualQuery($query_akun),
        'data_akun_edit'=>$this->Bis_model->manualQuery($query_akun_edit),
        'jml_akun' => $jml_akun,
        'users'=>$this->Hak_Akses_m->get_user($id),
        'menu'=>$this->Menu_m->get_menu($id),
        'submenu'=>$this->Menu_m->get_submenu($id),
    );
    $this->load->view('Masterakun_view',$data);
  }
//    ===================== INSERT =====================
    function tambah()
    {
      $now = date('Y-m-d H:i:s');
      $cookie_id_user = get_cookie('eklinik');
      $no_reg=time();
      $data=array(
        'kd_akun'=>$this->input->post('kd_akun'),
        'nama'=>strtoupper($this->input->post('nama')),
        'induk'=>$this->input->post('induk'),
        'detail'=>$this->input->post('detail'),
        'level'=>$this->input->post('level'),
        'group'=>$this->input->post('group'),
        'total'=>$this->input->post('total'),
        'jenis_akun'=>$this->input->post('jenis_akun'),
        'saldo_akun'=>$this->input->post('saldo_akun'),
        'finance'=>$this->input->post('finance'),
        'status_akun'=>$this->input->post('status_akun'),
        'entry_user'=>$cookie_id_user,
        'entry_date'=>$now
      );

      $this->db->trans_begin();
      $this->Bis_model->insertData('masterakun',$data);
      //$this->Bis_model->insertData('ms_pasien',$data);
      //$this->Bis_model->insertData('ms_pasien',$data);
      if
       ($this->db->trans_status() === FALSE)
      {
              $this->db->trans_rollback();

      }
      else
      {
              $this->db->trans_commit();
              $this->session->set_flashdata('message', 'Sukses tambah data baru.');
              $this->session->set_flashdata('jenis', 'success');
              redirect(site_url('Masterakun'));
      }

      }

//    ======================== EDIT =======================
    function edit(){
        $id['kd_akun'] = $this->input->post('kd_akun');
        $now = date('Y-m-d H:i:s');
        $cookie_id_user = get_cookie('eklinik');
        $data=array(
          'kd_akun'=>$this->input->post('kd_akun'),
        'nama'=>strtoupper($this->input->post('nama')),
        'induk'=>$this->input->post('induk'),
        'detail'=>$this->input->post('detail'),
        'level'=>$this->input->post('level'),
        'group'=>$this->input->post('group'),
        'total'=>$this->input->post('total'),
        'jenis_akun'=>$this->input->post('jenis_akun'),
        'saldo_akun'=>$this->input->post('saldo_akun'),
        'finance'=>$this->input->post('finance'),
        'status_akun'=>$this->input->post('status_akun'),
        'edit_user'=>$cookie_id_user,
        'edit_date'=>$now
        );


        $this->db->trans_begin();
        $this->Bis_model->updateData('masterakun',$data,$id);
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses edit data.');
                $this->session->set_flashdata('jenis', 'info');
                redirect(site_url('Masterakun'));
        }

    }

//    ========================== DELETE =======================
    function hapus(){
        $id['kd_akun'] = $this->input->post('kd_akun');


        $this->Bis_model->deleteData('masterakun',$id);
        redirect(site_url('Masterakun'));
    }
//    ========================== CETAK =======================
    function print_unit(){
        $id=$this->uri->segment(3);
        $this->load->model('umum/Bis_model');
        $data['data_model_unit'] = $this->Bis_model->getAllData('ms_model_unit');
        $data['data_plant'] = $this->Bis_model->getAllData('ms_plant');
        $data['data_merk'] = $this->Bis_model->getAllData('ms_merk');
        $data['status_unit'] = $this->Bis_model->getAllData('ms_status_unit');
        $data['status_aktif'] = $this->Bis_model->getAllData('ms_status_aktif');
        $query_data="SELECT
                      ms_plant.id_plant,
                      ms_plant.nama AS nama_plant,
                      ms_model_unit.id_model_unit,
                      ms_model.id_model,
                      ms_unit.id_unit,
                      ms_unit.keterangan,
                      ms_unit.serial_number,
                      ms_unit.full_tank,
                      ms_unit.tahun_produksi,
                      ms_unit.tahun_perolehan,
                      ms_unit.km_hm,
                      ms_unit.nilai_sewa,
                      ms_unit.entry_user,
                      ms_unit.entry_date,
                      ms_unit.edit_user,
                      ms_unit.edit_date,
                      ms_model_unit.keterangan AS keterangan_model_unit,
                      ms_model.keterangan AS keterangan_model,
                      ms_merk.id_merk,
                      ms_merk.nama AS nama_merk,
                      ms_status_aktif.id_status_aktif,
                      ms_status_aktif.nama_status_aktif as status_aktif,
                      ms_status_unit.id_status_unit,
                      ms_status_unit.nama_status_unit as status_unit
                      FROM
                      ms_unit
                      INNER JOIN ms_model_unit ON ms_unit.id_model_unit = ms_model_unit.id_model_unit
                      INNER JOIN ms_model ON ms_model_unit.id_model = ms_model.id_model
                      INNER JOIN ms_plant ON ms_unit.id_plant = ms_plant.id_plant
                      INNER JOIN ms_merk ON ms_unit.id_merk = ms_merk.id_merk
                      INNER JOIN ms_status_aktif ON ms_unit.id_status_aktif = ms_status_aktif.id_status_aktif
                      INNER JOIN ms_status_unit ON ms_unit.id_status_unit = ms_status_unit.id_status_unit
                      WHERE ms_unit.id_unit = '$id'";
        $data['data_unit'] = $this->Bis_model->manualQuery($query_data);
        $this->load->view('msunit_print',$data);
    }
//    ====================== EXPORT KE EXCEL ===================
      function exportexcel()
      {
        $this->load->model('umum/Bis_model');
        //$data['data_model_unit'] = $this->Bis_model->getAllData('ms_model_unit');
        $query_data="SELECT
                    	ms_pasien.no_register,
                    	ms_pasien.ktp,
                    	ms_pasien.kk,
                    	UPPER( ms_pasien.nama ) AS nama,
                    	ms_pasien.alamat,
                    	ms_pasien.kodepos,
                    	ms_pasien.kotalahir,
                    	ms_pasien.tgllahir,
                    	ms_pasien.jk,
                    	ms_pasien.foto,
                    	ms_pasien.hp,
                    	ms_pasien.telepon,
                    	ms_pasien.email,
                    	ms_pasien.keterangan,
                    	ms_pasien.edit_user,
                    	ms_pasien.entry_date,
                    	ms_pasien.entry_user,
                    	ms_pasien.id_pendidikan,
                    	ms_pasien.npwp,
                    	ms_pasien.rw,
                    	ms_pasien.nama_faskes,
                    	ms_pasien.bpjs_kes,
                    	aa.nama AS nama_pegawai,
                    	bb.nama AS nama_pegawai_edit,
                    	ms_status_aktif.nama_status_aktif,
                    	ms_status_aktif.id_status_aktif,
                    	ms_pasien.edit_date,
                    	ms_pasien.id_jenis_pasien,
                    	ms_jenis_pasien.nama AS nama_jenis_pasien,
                    	CONCAT(
                    		FLOOR( PERIOD_DIFF( DATE_FORMAT( NOW( ), '%Y%m' ), DATE_FORMAT( ms_pasien.tgllahir, '%Y%m' ) ) / 12 ),
                    		' TAHUN ',
                    		MOD ( PERIOD_DIFF( DATE_FORMAT( NOW( ), '%Y%m' ), DATE_FORMAT( ms_pasien.tgllahir, '%Y%' ) ), 12 ),
                    		' BULAN '
                    	) AS usia_pasien
                    FROM
                    	ms_pasien
                    	LEFT JOIN `user` AS a ON ms_pasien.entry_user = a.id_user
                    	LEFT JOIN `user` AS b ON ms_pasien.edit_user = b.id_user
                    	LEFT JOIN ms_pegawai AS aa ON a.id_pegawai = aa.id_pegawai
                    	LEFT JOIN ms_pegawai AS bb ON b.id_pegawai = bb.id_pegawai
                    	LEFT JOIN ms_status_aktif ON ms_pasien.id_status_aktif = ms_status_aktif.id_status_aktif
                    	LEFT JOIN ms_jenis_pasien ON ms_pasien.id_jenis_pasien = ms_jenis_pasien.id_jenis_pasien";
        //$data['data_pasien'] = $this->Bis_model->manualQuery($query_data);
        $data=array(
               'title'=>'DATA PASIEN',
               //'data_customer' => $this->Bis_model->manualQuery($query_data),
               'data_pasien' => $this->Bis_model->manualQuery($query_data),
               //'detail_resep' => $this->Bis_model->manualQuery($query_detail),
               //'users'=>$this->Hak_Akses_m->get_user($id),
               //'menu'=>$this->Menu_m->get_menu($id),
               //'submenu'=>$this->Menu_m->get_submenu($id),
         );
        $this->load->view('export/mspasien_export',$data);
      }
}
