<?php
class Bukubesar extends CI_Controller{
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

      $query_jurnal="SELECT
                      	gltransjalan.no_bukti,
                      	gltransjalan.kd_sub_unit,
                      	gltransjalan.kd_akun,
                      	gltransjalan.no_baris,
                      	gltransjalan.nama_akun,
                      	gltransjalan.tgl_trans,
                      	gltransjalan.modul_asal,
                      	gltransjalan.tipe_trans,
                      	gltransjalan.kd_reklas,
                      	gltransjalan.keterangan,
                      	gltransjalan.jml_D,
                      	gltransjalan.jml_K,
                      	gltransjalan.del_indek,
                      	gltransjalan.entry_date,
                      	gltransjalan.user_entry,
                      	gltransjalan.kd_person,
                      	gltransjalan.jml_trans,
                      	gltransjalan.tipe_bayar,
                      	gltransjalan.kd_jp,
                      	gltransjalan.id_sloc,
                      	gltransjalan.id_plant,
                      	masterakun.nama
                      FROM
                      	gltransjalan
                      	INNER JOIN masterakun ON gltransjalan.kd_akun = masterakun.kd_akun
                      WHERE
                      	MONTH(gltransjalan.tgl_trans) = MONTH(now())
                      ORDER BY
                      	gltransjalan.tgl_trans DESC,gltransjalan.no_bukti DESC,gltransjalan.kd_akun ASC ";

      $data=array(
                          'perintah'=>'Baru',
                          'title'=>'Jurnal Transaksi',
                          'title_filter'=>'Cari Transaksi',
                          'title_tambah'=>'Input Akun Baru',
                          'title_repopasien'=>'Laporan Jurnal',
                          'data_jurnal'=> $this->Bis_model->manualQuery($query_jurnal),
                          'xmenu'=>'Akuntansi',
                          'xsubmenu'=>'Jurnal',
                          'users'=> $this->Hak_Akses_m->get_user($id),
                          'menu'=> $this->Menu_m->get_menu($id),
                          'submenu'=> $this->Menu_m->get_submenu($id),
      );

      $this->load->view('Bukubesar_view',$data);
    }

  function filter()
  {
    //'kd_barang'=>$this->model_app->getKodeBarang(),
    $id = get_cookie('eklinik');
    $filter = $this->input->post('katakunci');
    $jml_px = $this->db->get_where('ms_pasien')->num_rows();
    $query_jenis_px="SELECT
                      *
                    FROM
                      ms_jenis_pasien";

    $query_pasien="SELECT
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
                    CONCAT(FLOOR(PERIOD_DIFF(DATE_FORMAT(NOW(), '%Y%m'), DATE_FORMAT(ms_pasien.tgllahir, '%Y%m'))/12), ' TAHUN ',
                    MOD(PERIOD_DIFF(DATE_FORMAT(NOW(), '%Y%m'), DATE_FORMAT(ms_pasien.tgllahir, '%Y%')),12), ' BULAN ') as usia_pasien
                  FROM
                    ms_pasien
                    LEFT JOIN `user` AS a ON ms_pasien.entry_user = a.id_user
                    LEFT JOIN `user` AS b ON ms_pasien.edit_user = b.id_user
                    LEFT JOIN ms_pegawai AS aa ON a.id_pegawai = aa.id_pegawai
                    LEFT JOIN ms_pegawai AS bb ON b.id_pegawai = bb.id_pegawai
                    LEFT JOIN ms_status_aktif ON ms_pasien.id_status_aktif = ms_status_aktif.id_status_aktif
                    LEFT JOIN ms_jenis_pasien ON ms_pasien.id_jenis_pasien = ms_jenis_pasien.id_jenis_pasien
                  WHERE ms_pasien.nama like '%$filter%' or ms_pasien.bpjs_kes like '%$filter%'";

                    $data=array(
                                        'perintah'=>'Baru',
                                        'title'=>'Daftar Pasien',
                                        'title_filter'=>'Cari Pasien',
                                        'title_tambah'=>'Input Pasien Baru',
                                        'title_repopasien'=>'Laporan Pasien',
                                        'data_pasien'=> $this->Bis_model->manualQuery($query_pasien),
                                        'data_kota'=> $this->Bis_model->getAllData('ms_kabupaten'),
                                        'data_pekerjaan'=> $this->Bis_model->getAllData('ms_pekerjaan'),
                                        'jml_px' => $jml_px,
                                        'data_jenis_pasien'=> $this->Bis_model->manualQuery($query_jenis_px),
                                       'users'=> $this->Hak_Akses_m->get_user($id),
                                       'menu'=> $this->Menu_m->get_menu($id),
                                       'submenu'=> $this->Menu_m->get_submenu($id),
                    );

                    $this->load->view('Regpx_view',$data);

  }


  function Dataedit()
  {
    $id = get_cookie('eklinik');
    //$id_edit=$this->uri->segment(3);
    $id_edit=$this->input->post('no_register');
    $jml_px = $this->db->get_where('ms_pasien')->num_rows();
    $query_jenis_px="SELECT
                      *
                    FROM
                      ms_jenis_pasien";
    $query_pasien="SELECT
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
                    	ms_pasien.edit_date,
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
                      ms_pasien.id_jenis_pasien,
                      ms_jenis_pasien.nama AS nama_jenis_pasien,
                      CONCAT(FLOOR(PERIOD_DIFF(DATE_FORMAT(NOW(), '%Y%m'), DATE_FORMAT(ms_pasien.tgllahir, '%Y%m'))/12), ' TAHUN ',
                      MOD(PERIOD_DIFF(DATE_FORMAT(NOW(), '%Y%m'), DATE_FORMAT(ms_pasien.tgllahir, '%Y%')),12), ' BULAN ') as usia_pasien
                    FROM
                    	ms_pasien
                    	LEFT JOIN `user` AS a ON ms_pasien.entry_user = a.id_user
                    	LEFT JOIN `user` AS b ON ms_pasien.edit_user = b.id_user
                    	LEFT JOIN ms_pegawai AS aa ON a.id_pegawai = aa.id_pegawai
                    	LEFT JOIN ms_pegawai AS bb ON b.id_pegawai = bb.id_pegawai
                      LEFT JOIN ms_jenis_pasien ON ms_pasien.id_jenis_pasien = ms_jenis_pasien.id_jenis_pasien
                    	LEFT JOIN ms_status_aktif ON ms_pasien.id_status_aktif = ms_status_aktif.id_status_aktif
                    limit 100";

   $query_pasien_edit="SELECT
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
                    	ms_pasien.edit_date,
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
                    	ms_kabupaten.`name` AS kota_lahir,
                    	ms_pasien.id_jenis_pasien,
                    	ms_jenis_pasien.nama AS nama_jenis_pasien,
                    	ms_pekerjaan.id_pekerjaan,
                    	ms_pekerjaan.nama AS nama_pekerjaan,
                      CONCAT(FLOOR(PERIOD_DIFF(DATE_FORMAT(NOW(), '%Y%m'), DATE_FORMAT(ms_pasien.tgllahir, '%Y%m'))/12), ' TAHUN ',
                      MOD(PERIOD_DIFF(DATE_FORMAT(NOW(), '%Y%m'), DATE_FORMAT(ms_pasien.tgllahir, '%Y%')),12), ' BULAN ') as usia_pasien
                    FROM
                    	ms_pasien
                    	LEFT JOIN `user` AS a ON ms_pasien.entry_user = a.id_user
                    	LEFT JOIN `user` AS b ON ms_pasien.edit_user = b.id_user
                    	LEFT JOIN ms_pegawai AS aa ON a.id_pegawai = aa.id_pegawai
                    	LEFT JOIN ms_pegawai AS bb ON b.id_pegawai = bb.id_pegawai
                    	LEFT JOIN ms_jenis_pasien ON ms_pasien.id_jenis_pasien = ms_jenis_pasien.id_jenis_pasien
                    	LEFT JOIN ms_status_aktif ON ms_pasien.id_status_aktif = ms_status_aktif.id_status_aktif
                    	LEFT JOIN ms_kabupaten ON ms_pasien.kotalahir = ms_kabupaten.id
                    	LEFT JOIN ms_pekerjaan ON ms_pasien.id_pekerjaan = ms_pekerjaan.id_pekerjaan
                    WHERE
                    ms_pasien.no_register = '$id_edit'";
    //echo $query_jenis_px;
//aa
    $data=array(
        'perintah'=>'Edit',
        'title'=>'Daftar Pasien',
        'title_filter'=>'Cari Pasien',
        'title_tambah'=>'Edit Data Pasien',
        'title_report'=>'Laporan Pasien',
        'title_penduduk'=>'Data Pasien Terdaftar',
        'data_pasien'=>$this->Bis_model->manualQuery($query_pasien),
        'data_pasien_edit'=>$this->Bis_model->manualQuery($query_pasien_edit),
        'data_jenis_pasien'=>$this->Bis_model->manualQuery($query_jenis_px),
        'data_kota'=> $this->Bis_model->getAllData('ms_kabupaten'),
        'jml_px' => $jml_px,
        'data_pekerjaan'=> $this->Bis_model->getAllData('ms_pekerjaan'),
        'users'=>$this->Hak_Akses_m->get_user($id),
        'menu'=>$this->Menu_m->get_menu($id),
        'submenu'=>$this->Menu_m->get_submenu($id),
    );
    $this->load->view('Regpx_view',$data);
  }
//    ===================== INSERT =====================
    function tambah()
    {
      $now = date('Y-m-d H:i:s');
      $cookie_id_user = get_cookie('eklinik');
      $no_reg=time();
      $data=array(
        'no_register'=>$this->input->post('no_register'),
        'ktp'=>$this->input->post('ktp'),
        //'kk'=>$this->input->post('kk'),
        //'npwp'=>$this->input->post('npwp'),
        //'id_rt'=>$this->input->post('id_rt'),
        //'id_dusun'=>$this->input->post('id_dusun'),
        'id_status_aktif'=>$this->input->post('id_status_aktif'),
        'nama'=>strtoupper($this->input->post('nama')),
        'alamat'=>$this->input->post('alamat'),
        //'id_agama'=>$this->input->post('id_agama'),
        //'id_pendidikan'=>$this->input->post('id_pendidikan'),
        //'kodepos'=>$this->input->post('kodepos'),
        'kotalahir'=>$this->input->post('kotalahir'),
        'tgllahir'=>$this->input->post('tgllahir'),
        'jk'=>$this->input->post('jk'),
        //'pekerjaan'=>$this->input->post('pekerjaan'),
        //'warganegara'=>$this->input->post('warganegara'),
        //'status'=>$this->input->post('status'),
        //'id_status_kawin'=>$this->input->post('id_status_kawin'),
        //'status_aktif'=>$this->input->post('status_aktif'),
        //'foto'=>$this->input->post('foto'),
        'hp'=>$this->input->post('hp'),
        'telepon'=>$this->input->post('telepon'),
        //'no_bpjs_tng'=>$this->input->post('bpjs_tk'),
        'bpjs_kes'=>$this->input->post('bpjs_kes'),
        //'nama_faskes'=>$this->input->post('nama_faskes'),
        'id_pekerjaan'=>$this->input->post('id_pekerjaan'),
        'id_jenis_pasien'=>$this->input->post('id_jenis_pasien'),
        //'id_status_aktif'=>$this->input->post('id_status_aktif'),
        'email'=>$this->input->post('email'),
        'keterangan'=>$this->input->post('keterangan'),
        'entry_user'=>$cookie_id_user,
        'entry_date'=>$now,
      );

      $this->db->trans_begin();
      $this->Bis_model->insertData('ms_pasien',$data);
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
              redirect(site_url('Regpx'));
      }

      }

//    ======================== EDIT =======================
    function edit(){
        $id['no_register'] = $this->input->post('no_register');
        $now = date('Y-m-d H:i:s');
        $cookie_id_user = get_cookie('eklinik');
        $data=array(
          'ktp'=>$this->input->post('ktp'),
          'nama'=>strtoupper($this->input->post('nama')),
          'alamat'=>$this->input->post('alamat'),
          'id_status_aktif'=>$this->input->post('id_status_aktif'),
          //'id_agama'=>$this->input->post('id_agama'),
          //'id_pendidikan'=>$this->input->post('id_pendidikan'),
          //'kodepos'=>$this->input->post('kodepos'),
          'kotalahir'=>$this->input->post('kotalahir'),
          'tgllahir'=>$this->input->post('tgllahir'),
          'jk'=>$this->input->post('jk'),
          //'pekerjaan'=>$this->input->post('pekerjaan'),
          //'warganegara'=>$this->input->post('warganegara'),
          //'status'=>$this->input->post('status'),
          //'id_status_kawin'=>$this->input->post('id_status_kawin'),
          //'status_aktif'=>$this->input->post('status_aktif'),
          //'foto'=>$this->input->post('foto'),
          'hp'=>$this->input->post('hp'),
          'telepon'=>$this->input->post('telepon'),
          //'no_bpjs_tng'=>$this->input->post('bpjs_tk'),
          'bpjs_kes'=>$this->input->post('bpjs_kes'),
          //'nama_faskes'=>$this->input->post('nama_faskes'),
          'id_pekerjaan'=>$this->input->post('id_pekerjaan'),
          'id_jenis_pasien'=>$this->input->post('id_jenis_pasien'),
          //'id_jenis'=>$this->input->post('id_jenis'),
          //'id_status_aktif'=>$this->input->post('id_status_aktif'),
          'email'=>$this->input->post('email'),
          'keterangan'=>$this->input->post('keterangan'),

          'edit_user'=>$cookie_id_user,
          'edit_date'=>$now,
        );


        $this->db->trans_begin();
        $this->Bis_model->updateData('ms_pasien',$data,$id);
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses edit data.');
                $this->session->set_flashdata('jenis', 'info');
                redirect(site_url('Regpx'));
        }

    }

//    ========================== DELETE =======================
    function hapus(){
        $id['no_register'] = $this->input->post('no_register');


        $this->Bis_model->deleteData('ms_pasien',$id);
        redirect(site_url('Regpx'));
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
