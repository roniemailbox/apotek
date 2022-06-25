<?php
class Finishworkorder extends CI_Controller{
  function __construct(){
      parent::__construct();
       $this->load->model('umum/Bis_model');
       //$this->load->model('umum/model_select');
       $this->load->model('Menu_m');
       $this->load->model('Jasa_m');
       $this->load->model('Hak_Akses_m');
       $this->load->model('Login_m');
       $this->load->helper('currency_format_helper');
       $this->load->database();
   		 $this->load->helper(array('url'));
    }
  function index()
  {
    //'kd_barang'=>$this->model_app->getKodeBarang(),
    $id = get_cookie('eklinik');
    $cookie_id_user = get_cookie('eklinik');
    $id_plant=$this->session->userdata('id_plant'.$cookie_id_user);
    $id_jenis=$this->session->userdata('id_jenis'.$cookie_id_user);
    if ($id_jenis=="P")
    {
      $dan=" ";
    }
    elseif ($id_jenis=="C")
     {
      $dan=" AND trans_wo.id_plant = $id_plant_id";
    }
    //$query_bisnis="select * from ms_bisnis where aktif=1 and id_bisnis='EUR'";
    $query_jasa="select * from ms_jasa";
    $query_dokter="SELECT
                  	ms_pegawai.id_pegawai,
                  	ms_pegawai.nama
                  FROM
                  	ms_pegawai
                  	INNER JOIN ms_jabatan ON ms_pegawai.id_jabatan = ms_jabatan.id_jabatan
                  WHERE
                  	ms_jabatan.nama LIKE 'DOKTER%'
                  ORDER BY ms_pegawai.nama ASC
                  ";
    $query_data="SELECT
                	ms_pasien.no_register,
                	ms_pasien.nama,
                	ms_pasien.alamat,
                	ms_pasien.kodepos,
                	ms_pasien.kotalahir,
                	ms_pasien.tgllahir,
                	ms_pasien.jk,
                	ms_pasien.telepon,
                	ms_pasien.email,
                	ms_pasien.keterangan,
                	ms_pasien.bpjs_kes
                FROM
                	ms_pasien
                ORDER BY
                	ms_pasien.nama ASC";
    $query_wo="SELECT
                	trans_wo.no_wo,
                	trans_wo.tgl_masuk,
                	trans_wo.tgl_keluar,
                	trans_wo.tipe_wo,
                	trans_wo.id_customer,
                	trans_wo.id_plant,
                	UPPER(trans_wo.nama) as nama,
                	trans_wo.alamat,
                	trans_wo.telepon,
                	trans_wo.no_register_px,
                	trans_wo.tekanan_darah,
                	trans_wo.tinggi_badan,
                	trans_wo.berat_badan,
                	trans_wo.jam_masuk,
                	trans_wo.estimasi,
                	trans_wo.diketahui,
                	trans_wo.keluhan,
                	trans_wo.person,
                	trans_wo.diserahkan,
                	trans_wo.perintah,
                	trans_wo.tindakan,
                	trans_wo.status_wo,
                	trans_wo.status_ar,
                	trans_wo.no_ar,
                	trans_wo.edit_date,
                	trans_wo.edit_user,
                	trans_wo.entry_date,
                	trans_wo.entry_user,
                	bb.nama AS nama_pegawai_edit,
                	aa.nama AS nama_pegawai,
                	ms_pasien.jk,

                  ms_pasien.bpjs_kes,
                  ms_pasien.email,
                	ms_pasien.ktp,
                  CONCAT(FLOOR(PERIOD_DIFF(DATE_FORMAT(NOW(), '%Y%m'), DATE_FORMAT(ms_pasien.tgllahir, '%Y%m'))/12), ' TAHUN ',
                  MOD(PERIOD_DIFF(DATE_FORMAT(NOW(), '%Y%m'), DATE_FORMAT(ms_pasien.tgllahir, '%Y%')),12), ' BULAN ') as usia_pasien
                FROM
                	trans_wo
                	LEFT JOIN `user` AS a ON trans_wo.entry_user = a.id_user
                	LEFT JOIN `user` AS b ON trans_wo.edit_user = b.id_user
                	LEFT JOIN ms_pegawai AS aa ON a.id_pegawai = aa.id_pegawai
                	LEFT JOIN ms_pegawai AS bb ON b.id_pegawai = bb.id_pegawai
                	LEFT JOIN ms_pasien ON trans_wo.no_register_px = ms_pasien.no_register
                WHERE
                	trans_wo.no_wo is not NULL
                ORDER BY
                	trans_wo.tgl_masuk DESC LIMIT 100";
                            // AND trans_wo.status_wo IS NULL

     // echo $query_wo;
    $data=array(
            'perintah'=>'Baru',
            'title'=>'Daftar Pelayanan Medis',
            'title_filter'=>'Cari Kunjungan',
            'title_tambah'=>'Daftar Pelayanan Medis',
            'title_report'=>'Laporan Kunjungan',
            'title_penduduk'=>'Data Pasien Terdaftar',
            'data_pasien' => $this->Bis_model->manualQuery($query_data),
            'data_dokter' => $this->Bis_model->manualQuery($query_dokter),
            'data_wo' => $this->Bis_model->manualQuery($query_wo),
            'data_jasa' => $this->Bis_model->manualQuery($query_jasa),
            'users'=>$this->Hak_Akses_m->get_user($id),
            'menu'=>$this->Menu_m->get_menu($id),
            'submenu'=>$this->Menu_m->get_submenu($id),
     );
     $this->load->view('Finish_view',$data);
  }
  function filter()
  {
    //'kd_barang'=>$this->model_app->getKodeBarang(),
    $id = get_cookie('eklinik');
    $filter = $this->input->post('katakunci');
    $query_jasa="select * from ms_jasa";
    $query_data="SELECT
                	ms_pasien.no_register,
                	ms_pasien.nama,
                	ms_pasien.alamat,
                	ms_pasien.kodepos,
                	ms_pasien.kotalahir,
                	ms_pasien.tgllahir,
                	ms_pasien.jk,
                	ms_pasien.telepon,
                	ms_pasien.email,
                	ms_pasien.keterangan,
                	ms_pasien.bpjs_kes
                FROM
                	ms_pasien
                ORDER BY
                	ms_pasien.nama ASC";
    $query_wo="SELECT
                	trans_wo.no_wo,
                	trans_wo.tgl_masuk,
                	trans_wo.tgl_keluar,
                	trans_wo.tipe_wo,
                	trans_wo.id_customer,
                	trans_wo.id_plant,
                	UPPER(trans_wo.nama) as nama,
                	trans_wo.alamat,
                	trans_wo.telepon,
                	trans_wo.no_register_px,
                	trans_wo.tekanan_darah,
                	trans_wo.tinggi_badan,
                	trans_wo.berat_badan,
                	trans_wo.jam_masuk,
                	trans_wo.estimasi,
                	trans_wo.diketahui,
                	trans_wo.keluhan,
                	trans_wo.person,
                	trans_wo.diserahkan,
                	trans_wo.perintah,
                	trans_wo.tindakan,
                	trans_wo.status_wo,
                	trans_wo.status_ar,
                	trans_wo.no_ar,
                	trans_wo.edit_date,
                	trans_wo.edit_user,
                	trans_wo.entry_date,
                	trans_wo.entry_user,
                	bb.nama AS nama_pegawai_edit,
                	aa.nama AS nama_pegawai,
                	ms_pasien.jk,
                  ms_pasien.bpjs_kes,
                  ms_pasien.email,
                	ms_pasien.ktp,
                  CONCAT(FLOOR(PERIOD_DIFF(DATE_FORMAT(NOW(), '%Y%m'), DATE_FORMAT(ms_pasien.tgllahir, '%Y%m'))/12), ' TAHUN ',
                  MOD(PERIOD_DIFF(DATE_FORMAT(NOW(), '%Y%m'), DATE_FORMAT(ms_pasien.tgllahir, '%Y%')),12), ' BULAN ') as usia_pasien
                FROM
                	trans_wo
                	LEFT JOIN `user` AS a ON trans_wo.entry_user = a.id_user
                	LEFT JOIN `user` AS b ON trans_wo.edit_user = b.id_user
                	LEFT JOIN ms_pegawai AS aa ON a.id_pegawai = aa.id_pegawai
                	LEFT JOIN ms_pegawai AS bb ON b.id_pegawai = bb.id_pegawai
                	LEFT JOIN ms_pasien ON trans_wo.no_register_px = ms_pasien.no_register
                WHERE
                (ms_pasien.nama like '%$filter%' OR trans_wo.alamat like '%$filter%' OR trans_wo.no_wo like '%$filter%' OR trans_wo.keluhan like '%$filter%' )";
    //echo $query_wo;
    $data=array(
      'perintah'=>'Baru',
      'title'=>'Daftar Pelayanan Medis',
      'title_filter'=>'Cari Kunjungan',
      'title_tambah'=>'Daftar Pelayanan Medis',
      'title_report'=>'Laporan Kunjungan',
      'title_penduduk'=>'Data Pasien Terdaftar',
      'data_pasien' => $this->Bis_model->manualQuery($query_data),
      'data_wo' => $this->Bis_model->manualQuery($query_wo),
      'data_jasa' => $this->Bis_model->manualQuery($query_jasa),
      'users'=>$this->Hak_Akses_m->get_user($id),
      'menu'=>$this->Menu_m->get_menu($id),
      'submenu'=>$this->Menu_m->get_submenu($id),
     );
   $this->load->view('Finish_view',$data);
  }



  function Dataedit()
  {

    $no_wo= $this->input->post('no_wo');
    $no_register= $this->input->post('no_register_px');
    $id = get_cookie('eklinik');
    $cookie_id_user = get_cookie('eklinik');
    $id_plant_id=$this->session->userdata('id_plant'.$cookie_id_user);
    $id_jenis=$this->session->userdata('id_jenis'.$cookie_id_user);

    if ($id_jenis=="P")
    {
      $dan=" ";
    }
    elseif ($id_jenis=="C")
     {
      $dan=" AND ms_plant.id_plant = $id_plant_id";
    }


    $query_jasa="select * from ms_jasa";
    $query_dokter="SELECT
                  	ms_pegawai.id_pegawai,
                  	ms_pegawai.nama
                  FROM
                  	ms_pegawai
                  	INNER JOIN ms_jabatan ON ms_pegawai.id_jabatan = ms_jabatan.id_jabatan
                  WHERE
                  	ms_jabatan.nama LIKE 'DOKTER%'
                  ORDER BY ms_pegawai.nama ASC
                  ";
                  $query_data="SELECT
                              	trans_wo.no_wo,
                              	trans_wo.no_register_px,
                              	trans_wo.tgl_masuk,
                                trans_wo.jam_masuk,
                              	trans_wo.keluhan,
                              	trans_wo.id_dokter,
                              	ms_pegawai.nama AS nama_dokter,
                              	ms_pasien.nama,
                              	trans_wo.instruksi,
                              	trans_wo.subjective,
                              	trans_wo.objective,
                              	trans_wo.assesment,
                              	trans_wo.planing
                              FROM
                              	trans_wo
                              	LEFT JOIN ms_pegawai ON trans_wo.id_dokter = ms_pegawai.id_pegawai
                              	INNER JOIN ms_pasien ON trans_wo.no_register_px = ms_pasien.no_register
                              WHERE
                              	trans_wo.no_register_px = '$no_register' AND trans_wo.no_wo <> '$no_wo' ";
    $query_wo="SELECT
                	trans_wo.no_wo,
                	trans_wo.tgl_masuk,
                	trans_wo.tgl_keluar,
                	trans_wo.tipe_wo,
                	trans_wo.id_customer,
                	trans_wo.id_plant,
                	UPPER(trans_wo.nama) as nama,
                	trans_wo.alamat,
                	trans_wo.telepon,
                	trans_wo.no_register_px,
                	trans_wo.tekanan_darah,
                	trans_wo.tinggi_badan,
                	trans_wo.berat_badan,
                	trans_wo.jam_masuk,
                	trans_wo.estimasi,
                	trans_wo.diketahui,
                	trans_wo.keluhan,
                	trans_wo.person,
                	trans_wo.diserahkan,
                	trans_wo.perintah,
                	trans_wo.tindakan,
                	trans_wo.status_wo,
                	trans_wo.status_ar,
                	trans_wo.no_ar,
                	trans_wo.edit_date,
                	trans_wo.edit_user,
                	trans_wo.entry_date,
                	trans_wo.entry_user,
                	bb.nama AS nama_pegawai_edit,
                	aa.nama AS nama_pegawai,
                	ms_pasien.jk,
                  ms_pasien.tgllahir,
                  ms_pasien.bpjs_kes,
                  ms_pasien.email,
                  ms_pasien.keterangan,
                	ms_pasien.ktp,
                  CONCAT(FLOOR(PERIOD_DIFF(DATE_FORMAT(NOW(), '%Y%m'), DATE_FORMAT(ms_pasien.tgllahir, '%Y%m'))/12), ' TAHUN ',
                  MOD(PERIOD_DIFF(DATE_FORMAT(NOW(), '%Y%m'), DATE_FORMAT(ms_pasien.tgllahir, '%Y%')),12), ' BULAN ') as usia_pasien
                FROM
                	trans_wo
                	LEFT JOIN `user` AS a ON trans_wo.entry_user = a.id_user
                	LEFT JOIN `user` AS b ON trans_wo.edit_user = b.id_user
                	LEFT JOIN ms_pegawai AS aa ON a.id_pegawai = aa.id_pegawai
                	LEFT JOIN ms_pegawai AS bb ON b.id_pegawai = bb.id_pegawai
                	LEFT JOIN ms_pasien ON trans_wo.no_register_px = ms_pasien.no_register
                WHERE
                	trans_wo.no_wo is not NULL
                ORDER BY
                	trans_wo.tgl_masuk DESC LIMIT 100";
                  $query_wo_edit="SELECT
                                  	trans_wo.no_wo,
                                  	trans_wo.tgl_masuk,
                                  	trans_wo.tipe_wo,
                                  	trans_wo.id_customer,
                                  	trans_wo.id_plant,
                                  	UPPER( trans_wo.nama ) AS nama,
                                  	trans_wo.alamat,
                                  	trans_wo.telepon,
                                  	trans_wo.no_register_px,
                                  	trans_wo.tekanan_darah,
                                  	trans_wo.tinggi_badan,
                                  	trans_wo.berat_badan,
                                  	trans_wo.jam_masuk,
                                  	trans_wo.estimasi,
                                  	trans_wo.diketahui,
                                  	trans_wo.keluhan,
                                  	trans_wo.person,
                                  	trans_wo.diserahkan,
                                  	trans_wo.perintah,
                                  	trans_wo.tindakan,
                                  	trans_wo.status_wo,
                                  	trans_wo.status_ar,
                                  	trans_wo.no_ar,
                                  	trans_wo.edit_date,
                                  	trans_wo.edit_user,
                                  	trans_wo.entry_date,
                                  	trans_wo.entry_user,
                                  	bb.nama AS nama_pegawai_edit,
                                  	aa.nama AS nama_pegawai,
                                    ms_pasien.jk,
                                    ms_pasien.tgllahir,
                                    ms_pasien.bpjs_kes,
                                    ms_pasien.email,
                                    ms_pasien.keterangan,
                                  	ms_pasien.ktp,
                                  	CONCAT(
                                  		FLOOR( PERIOD_DIFF( DATE_FORMAT( NOW( ), '%Y%m' ), DATE_FORMAT( ms_pasien.tgllahir, '%Y%m' ) ) / 12 ),
                                  		' TAHUN ',
                                  		MOD ( PERIOD_DIFF( DATE_FORMAT( NOW( ), '%Y%m' ), DATE_FORMAT( ms_pasien.tgllahir, '%Y%' ) ), 12 ),
                                  		' BULAN '
                                  	) AS usia_pasien,
                                  	trans_wo.subjective,
                                  	trans_wo.objective,
                                  	trans_wo.assesment,
                                  	trans_wo.planing,
                                    trans_wo.instruksi
                                  FROM
                                  	trans_wo
                                  	LEFT JOIN `user` AS a ON trans_wo.entry_user = a.id_user
                                  	LEFT JOIN `user` AS b ON trans_wo.edit_user = b.id_user
                                  	LEFT JOIN ms_pegawai AS aa ON a.id_pegawai = aa.id_pegawai
                                  	LEFT JOIN ms_pegawai AS bb ON b.id_pegawai = bb.id_pegawai
                                  	LEFT JOIN ms_pasien ON trans_wo.no_register_px = ms_pasien.no_register
                              WHERE
                              	trans_wo.no_wo ='$no_wo'";
                                $query_dataaa="SELECT
                                            	trans_wo.no_wo,
                                            	trans_wo.no_register_px,
                                            	trans_wo.tgl_masuk,
                                            	trans_wo.keluhan,
                                            	trans_wo.tindakan,
                                            	trans_wo.id_dokter,
                                            	ms_pegawai.nama AS nama_dokter,
                                            	ms_pasien.nama
                                            FROM
                                            	trans_wo
                                            	LEFT JOIN ms_pegawai ON trans_wo.id_dokter = ms_pegawai.id_pegawai
                                            	INNER JOIN ms_pasien ON trans_wo.no_register_px = ms_pasien.no_register
                                            WHERE
                                            	trans_wo.no_register_px = '$no_register'";
    $tipe_wo="D";
    //echo $query_data;
    $data=array(
      'perintah'=>'Edit',
      'xmenu'=>'Klinik',
      'xsubmenu'=>'Tindakan & Resep',
      'title'=>'Daftar Kunjungan',
      'title_filter'=>'Cari Kunjungan',
      'title_tambah'=>'Edit Kunjungan',
      'title_report'=>'Laporan Kunjungan',
      'title_penduduk'=>'Data Pasien Terdaftar',
      'data_pasien' => $this->Bis_model->manualQuery($query_data),
      'data_dokter' => $this->Bis_model->manualQuery($query_dokter),
      'data_wo' => $this->Bis_model->manualQuery($query_wo),
      'data_wo_edit' => $this->Bis_model->manualQuery($query_wo_edit),
      'data_jasa' => $this->Bis_model->manualQuery($query_jasa),
      'data_jasa_in' => $this->Jasa_m->get_jasa_in($no_wo,$tipe_wo),
      'data_jasa_out' => $this->Jasa_m->get_jasa_out($no_wo,$tipe_wo),
      'data_histori' => $this->Bis_model->manualQuery($query_data),
      'users'=>$this->Hak_Akses_m->get_user($id),
      'menu'=>$this->Menu_m->get_menu($id),
      'submenu'=>$this->Menu_m->get_submenu($id),
     );
   $this->load->view('Finishworkorder_view',$data);
  }

  function Finishjob()
  {
    //'kd_barang'=>$this->model_app->getKodeBarang(),

    $no_wo= $this->input->post('no_wo');
    $no_register= $this->input->post('no_register');

    $id = get_cookie('eklinik');
    $cookie_id_user = get_cookie('eklinik');

    $id_plant_id=$this->session->userdata('id_plant'.$cookie_id_user);
    $id_jenis=$this->session->userdata('id_jenis'.$cookie_id_user);

    if ($id_jenis=="P")
    {
      $dan=" ";
    }
    elseif ($id_jenis=="C")
    {
      $dan=" AND ms_plant.id_plant = $id_plant_id";
    }


    $query_jasa="select * from ms_jasa";
    $query_dokter="SELECT
                  	ms_pegawai.id_pegawai,
                  	ms_pegawai.nama
                  FROM
                  	ms_pegawai
                  	INNER JOIN ms_jabatan ON ms_pegawai.id_jabatan = ms_jabatan.id_jabatan
                  WHERE
                  	ms_jabatan.nama LIKE 'DOKTER%'
                  ORDER BY ms_pegawai.nama ASC
                  ";
    $query_data="SELECT
                	trans_wo.no_wo,
                	trans_wo.no_register_px,
                	trans_wo.tgl_masuk,
                  trans_wo.jam_masuk,
                	trans_wo.keluhan,
                	trans_wo.id_dokter,
                	ms_pegawai.nama AS nama_dokter,
                	ms_pasien.nama,
                	trans_wo.instruksi,
                	trans_wo.subjective,
                	trans_wo.objective,
                	trans_wo.assesment,
                	trans_wo.planing
                FROM
                	trans_wo
                	LEFT JOIN ms_pegawai ON trans_wo.id_dokter = ms_pegawai.id_pegawai
                	INNER JOIN ms_pasien ON trans_wo.no_register_px = ms_pasien.no_register
                WHERE
                	trans_wo.no_register_px = '$no_register' AND trans_wo.no_wo <> '$no_wo' ";
    //echo $query_data;
    $query_wo="SELECT
                	trans_wo.no_wo,
                	trans_wo.tgl_masuk,
                	trans_wo.tgl_keluar,
                	trans_wo.tipe_wo,
                	trans_wo.id_customer,
                	trans_wo.id_plant,
                	UPPER(trans_wo.nama) as nama,
                	trans_wo.alamat,
                	trans_wo.telepon,
                	trans_wo.no_register_px,
                	trans_wo.tekanan_darah,
                	trans_wo.tinggi_badan,
                	trans_wo.berat_badan,
                	trans_wo.jam_masuk,
                	trans_wo.estimasi,
                	trans_wo.diketahui,
                	trans_wo.keluhan,
                	trans_wo.person,
                	trans_wo.diserahkan,
                	trans_wo.perintah,
                	trans_wo.tindakan,
                	trans_wo.status_wo,
                	trans_wo.status_ar,
                	trans_wo.no_ar,
                	trans_wo.edit_date,
                	trans_wo.edit_user,
                	trans_wo.entry_date,
                	trans_wo.entry_user,
                	bb.nama AS nama_pegawai_edit,
                	aa.nama AS nama_pegawai,
                	ms_pasien.jk,
                  ms_pasien.keterangan,
                  ms_pasien.bpjs_kes,
                  ms_pasien.email,
                	ms_pasien.ktp,
                  ms_pasien.tgllahir,
                  CONCAT(FLOOR(PERIOD_DIFF(DATE_FORMAT(NOW(), '%Y%m'), DATE_FORMAT(ms_pasien.tgllahir, '%Y%m'))/12), ' TAHUN ',
                  MOD(PERIOD_DIFF(DATE_FORMAT(NOW(), '%Y%m'), DATE_FORMAT(ms_pasien.tgllahir, '%Y%')),12), ' BULAN ') as usia_pasien
                FROM
                	trans_wo
                	LEFT JOIN `user` AS a ON trans_wo.entry_user = a.id_user
                	LEFT JOIN `user` AS b ON trans_wo.edit_user = b.id_user
                	LEFT JOIN ms_pegawai AS aa ON a.id_pegawai = aa.id_pegawai
                	LEFT JOIN ms_pegawai AS bb ON b.id_pegawai = bb.id_pegawai
                	LEFT JOIN ms_pasien ON trans_wo.no_register_px = ms_pasien.no_register

                WHERE
                  trans_wo.no_wo ='$no_wo'";
                  $query_wo_edit="SELECT
                              	trans_wo.no_wo,
                              	trans_wo.tgl_masuk,
                              	trans_wo.tgl_keluar,
                              	trans_wo.tipe_wo,
                              	trans_wo.id_customer,
                              	trans_wo.id_plant,
                              	UPPER( trans_wo.nama ) AS nama,
                              	trans_wo.alamat,
                              	trans_wo.telepon,
                              	trans_wo.no_register_px,
                              	trans_wo.tekanan_darah,
                              	trans_wo.tinggi_badan,
                              	trans_wo.berat_badan,
                              	trans_wo.jam_masuk,
                              	trans_wo.estimasi,
                              	trans_wo.diketahui,
                              	trans_wo.keluhan,
                              	trans_wo.person,
                              	trans_wo.diserahkan,
                              	trans_wo.perintah,
                              	trans_wo.tindakan,
                              	trans_wo.status_wo,
                              	trans_wo.status_ar,
                              	trans_wo.no_ar,
                              	trans_wo.edit_date,
                              	trans_wo.edit_user,
                              	trans_wo.entry_date,
                              	trans_wo.entry_user,
                              	bb.nama AS nama_pegawai_edit,
                              	aa.nama AS nama_pegawai,
                              	ms_pasien.jk,
                              	ms_pasien.tgllahir,
                              	ms_pasien.bpjs_kes,
                              	ms_pasien.email,
                              	ms_pasien.ktp,
                                trans_wo.id_dokter,
                              	dokter.nama AS nama_dokter,
                              	ms_kabupaten.`name` AS kota_lahir,
                              	ms_pasien.kotalahir,
                                CONCAT(FLOOR(PERIOD_DIFF(DATE_FORMAT(NOW(), '%Y%m'), DATE_FORMAT(ms_pasien.tgllahir, '%Y%m'))/12), ' TAHUN ',
                                MOD(PERIOD_DIFF(DATE_FORMAT(NOW(), '%Y%m'), DATE_FORMAT(ms_pasien.tgllahir, '%Y%')),12), ' BULAN ') as usia_pasien
                              FROM
                              	trans_wo
                              	LEFT JOIN `user` AS a ON trans_wo.entry_user = a.id_user
                              	LEFT JOIN `user` AS b ON trans_wo.edit_user = b.id_user
                              	LEFT JOIN ms_pegawai AS aa ON a.id_pegawai = aa.id_pegawai
                              	LEFT JOIN ms_pegawai AS bb ON b.id_pegawai = bb.id_pegawai
                              	LEFT JOIN ms_pasien ON trans_wo.no_register_px = ms_pasien.no_register
                              	LEFT JOIN ms_pegawai AS dokter ON trans_wo.id_dokter = dokter.id_pegawai
                              	LEFT JOIN ms_kabupaten ON ms_pasien.kotalahir = ms_kabupaten.id
                              WHERE
                              	trans_wo.no_wo ='$no_wo'";
    $tipe_wo="D";
    $data=array(
      'perintah'=>'Baru',
      'xmenu'=>'Klinik',
      'xsubmenu'=>'Pelayanan Klinik',
      'title'=>'Tindakan Medis',
      'title_filter'=>'Cari Kunjungan',
      'title_tambah'=>'Tindakan Medis',
      'title_report'=>'Laporan Kunjungan',
      'title_penduduk'=>'Data Pasien Terdaftar',
      'data_jasa_in' => $this->Jasa_m->get_jasa_in($no_wo,$tipe_wo),
      'data_jasa_out' => $this->Jasa_m->get_jasa_out($no_wo,$tipe_wo),
      'data_histori' => $this->Bis_model->manualQuery($query_data),
      'data_dokter' => $this->Bis_model->manualQuery($query_dokter),
      'data_wo' => $this->Bis_model->manualQuery($query_wo),
      'data_wo_edit' => $this->Bis_model->manualQuery($query_wo_edit),
      'data_jasa' => $this->Bis_model->manualQuery($query_jasa),
      'users'=>$this->Hak_Akses_m->get_user($id),
      'menu'=>$this->Menu_m->get_menu($id),
      'submenu'=>$this->Menu_m->get_submenu($id),
     );
   $this->load->view('Finishworkorder_view',$data);

  }

  function x_simpanfinish(){
    $this->db->trans_off();
    $this->db->trans_begin();
    $no_wo = $this->input->post('no_wo');
    $idwo['no_wo'] = $no_wo;
    $datawo=array(
      //'status_wo'=>$this->input->post('status_wo'),
      //'diketahui'=>$this->input->post('diketahui'),
      //'km_akhir'=>$this->input->post('km_akhir'),
      'subjektif'=>$this->input->post('subjektif'),
      'objective'=>$this->input->post('objective'),
      'assesment'=>$this->input->post('assesment'),
      'intruksi'=>$this->input->post('intruksi'),
      'planing'=>$this->input->post('planing'),
    );
    $this->db->trans_begin();
    $this->Bis_model->updateData('trans_wo',$datawo,$idwo);
    $this->Bis_model->deleteData('trans_jasa_wo',$idwo);

    foreach ($this->input->post('rowJasa') as $key => $count )
    //$hak = $this->input->post('rowJasa'.$count.'[]');
    {
          $data=array(
            'no_wo'=>$no_wo,
            'id_jasa'=>$this->input->post('id_jasa_'.$count),
            'nilai'=>$this->input->post('nilai_'.$count),
            'diskon'=>$this->input->post('diskon_'.$count),
          );
          $this->Bis_model->insertData('trans_jasa_wo',$data);
    // UPDATE BARANG
    }
    foreach ($this->input->post('rowBM') as $key => $count )
    //$hak = $this->input->post('rowJasa'.$count.'[]');
    {
          $data=array(
            'no_wo'=>$no_wo,
            'id_jasa'=>$this->input->post('id_jasa_'.$count),
            'nilai'=>$this->input->post('nilai_'.$count),
            'diskon'=>$this->input->post('diskon_'.$count),
          );
          //$this->Bis_model->insertData('trans_jasa_wo',$data);
    // UPDATE BARANG
    }
    $this->db->trans_complete();
    if ($this->db->trans_status() === FALSE)
    {
            $this->db->trans_rollback();
            $this->session->set_flashdata('message', 'Gagal input data produksi.');
            $this->session->set_flashdata('jenis', 'danger');
            redirect(site_url('Workorder'));
    }
    else
    {
            $this->db->trans_commit();
            $this->session->set_flashdata('message', 'Sukses tambah data baru.');
            $this->session->set_flashdata('jenis', 'success');
            redirect(site_url('Workorder'));
    }


  }
  function simpanfinish(){
    $now = date('Y-m-d H:i:s');

    $date = new DateTime($this->input->post('tgl_trans'));
    $year = $date -> format('y');
    $month = $date -> format('m');
    $day = $date -> format('d');
    $kode_bayar="RSP";
    $kode_bukti=$kode_bayar.$year.$month;
    $cookie_id_user = get_cookie('eklinik');
    //$kodejenis =  $this->input->post('id_status_pegawai');
    //$no_krit="EMP-";
    $no_bukti= $this->Bis_model->getIdRo($kode_bukti);

    $this->db->trans_off();
    $this->db->trans_begin();
    $no_wo = $this->input->post('no_wo');
    $idwo['no_wo'] = $no_wo;

    $datawo=array(
      'status_wo'=>2,
      'subjective'=>$this->input->post('subjective'),
      'objective'=>$this->input->post('objective'),
      'assesment'=>$this->input->post('assesment'),
      'planing'=>$this->input->post('planing'),
      'instruksi'=>$this->input->post('instruksi'),
      'dr_entry'=>$cookie_id_user,
      'dr_entry_date'=>$now,
      //'tindakan'=>$this->input->post('tindakan'),
    );
    $data=array(
      'no_bukti'=>$no_bukti,
      'tgl_trans'=>$this->input->post('tgl_trans'),
      'keterangan'=>$this->input->post('keterangan_resep'),
      'no_ref'=>$this->input->post('no_wo'),
      'entry_user'=>$cookie_id_user,
      'entry_date'=>$now,
    );
    $this->db->trans_begin();
    $this->Bis_model->updateData('trans_wo',$datawo,$idwo);
    $this->Bis_model->deleteData('trans_jasa_wo',$idwo);
    $this->Bis_model->insertData('judul_ro',$data);
    foreach ($this->input->post('rowJasa') as $key => $count )
    //$hak = $this->input->post('rowJasa'.$count.'[]');
    {
          $data=array(
            'no_wo'=>$no_wo,
            'id_jasa'=>$this->input->post('id_jasa_'.$count),
            'nilai'=>$this->input->post('nilai_'.$count),
            'diskon'=>$this->input->post('diskon_'.$count),
          );
          $this->Bis_model->insertData('trans_jasa_wo',$data);
    // UPDATE BARANG
    }



    foreach ($this->input->post('rowsBM') as $key => $count )
    {

        $data=array(
          'no_row'=>$count,
          'no_bukti'=>$no_bukti,
          'kd_barang'=>$this->input->post('id_barang_ro_'.$count),
          'qty'=>$this->input->post('qty_ro_'.$count),
          'satuan'=>$this->input->post('satuan_ro_'.$count),
          'keterangan'=>$this->input->post('keterangan_ro_'.$count),
        );
        $this->Bis_model->insertData('detail_ro',$data);
    }

    $this->db->trans_complete();
    if ($this->db->trans_status() === FALSE)
    {
            $this->db->trans_rollback();
            $this->session->set_flashdata('message', 'Gagal input data produksi.');
            $this->session->set_flashdata('jenis', 'danger');
            redirect(site_url('Finishworkorder'));
    }
    else
    {
            $this->db->trans_commit();
            $this->session->set_flashdata('message', 'Sukses tambah data baru.');
            $this->session->set_flashdata('jenis', 'success');
            redirect(site_url('Finishworkorder'));
    }


  }

  function editfinish(){
    $now = date('Y-m-d H:i:s');

    $date = new DateTime($this->input->post('tgl_trans'));
    $year = $date -> format('y');
    $month = $date -> format('m');
    $day = $date -> format('d');
    $kode_bayar="RSP";
    $kode_bukti=$kode_bayar.$year.$month;
    $cookie_id_user = get_cookie('eklinik');
    //$kodejenis =  $this->input->post('id_status_pegawai');
    //$no_krit="EMP-";
    $no_bukti= $this->Bis_model->getIdRo($kode_bukti);

    $this->db->trans_off();
    $this->db->trans_begin();
    $no_wo = $this->input->post('no_wo');
    $idwo['no_wo'] = $no_wo;

    $datawo=array(
      'status_wo'=>2,
      'subjective'=>$this->input->post('subjective'),
      'objective'=>$this->input->post('objective'),
      'assesment'=>$this->input->post('assesment'),
      'planing'=>$this->input->post('planing'),
      'instruksi'=>$this->input->post('instruksi'),
      'dr_entry'=>$cookie_id_user,
      'dr_entry_date'=>$now,
      //'tindakan'=>$this->input->post('tindakan'),
    );
    $data=array(
      'no_bukti'=>$no_bukti,
      'tgl_trans'=>$this->input->post('tgl_trans'),
      'keterangan'=>$this->input->post('keterangan_resep'),
      'no_ref'=>$this->input->post('no_wo'),
      'entry_user'=>$cookie_id_user,
      'entry_date'=>$now,
    );
    $this->db->trans_begin();
    $this->Bis_model->updateData('trans_wo',$datawo,$idwo);
    $this->Bis_model->deleteData('trans_jasa_wo',$idwo);
    $this->Bis_model->insertData('judul_ro',$data);
    foreach ($this->input->post('rowJasa') as $key => $count )
    //$hak = $this->input->post('rowJasa'.$count.'[]');
    {
          $data=array(
            'no_wo'=>$no_wo,
            'id_jasa'=>$this->input->post('id_jasa_'.$count),
            'nilai'=>$this->input->post('nilai_'.$count),
            'diskon'=>$this->input->post('diskon_'.$count),
          );
          $this->Bis_model->insertData('trans_jasa_wo',$data);
    // UPDATE BARANG
    }



    foreach ($this->input->post('rowsBM') as $key => $count )
    {

        $data=array(
          'no_row'=>$count,
          'no_bukti'=>$no_bukti,
          'kd_barang'=>$this->input->post('id_barang_ro_'.$count),
          'qty'=>$this->input->post('qty_ro_'.$count),
          'keterangan'=>$this->input->post('keterangan_ro_'.$count),
        );
        $this->Bis_model->insertData('detail_ro',$data);
    }

    $this->db->trans_complete();
    if ($this->db->trans_status() === FALSE)
    {
            $this->db->trans_rollback();
            $this->session->set_flashdata('message', 'Gagal input data produksi.');
            $this->session->set_flashdata('jenis', 'danger');
            redirect(site_url('Finishworkorder'));
    }
    else
    {
            $this->db->trans_commit();
            $this->session->set_flashdata('message', 'Sukses tambah data baru.');
            $this->session->set_flashdata('jenis', 'success');
            redirect(site_url('Finishworkorder'));
    }


  }
//    ===================== INSERT =====================
    function tambah()
    {
      $now = date('Y-m-d H:i:s');
      $tgl_lahir = $this->input->post('tgllahir');
      $tgl_masuk = $this->input->post('tglmasuk');
      $tgl_keluar= $this->input->post('tglkeluar');
      $cookie_id_user = get_cookie('eklinik');
      $datex = new DateTime($this->input->post('tgl_produksi'));
      $no_krit='NKP';
      //$no_krit=
      $year = $datex -> format('y');
      $month = $datex -> format('m');
      $day = $datex -> format('d');
      $kode_bukti=$no_krit.$year.$month;

      $id_wo= $this->Bis_model->getIdWO($kode_bukti);
      $data=array(
        'no_wo'=>$id_wo,
        'tgl_masuk'=>$this->input->post('tgl_wo'),
        //'tgl_keluar'=>$this->input->post('tgl_keluar'),
        'tipe_wo'=>$this->input->post('tipe_wo'),
        'no_register_px'=>$this->input->post('no_register'),
        'nama'=>$this->input->post('nama'),
        'alamat'=>$this->input->post('alamat'),
        'telepon'=>$this->input->post('telepon'),
        'id_dokter'=>$this->input->post('id_dokter'),
        //'id_plant'=>$this->input->post('id_plant'),
        'tinggi_badan'=>$this->input->post('tinggi_badan'),
        'berat_badan'=>$this->input->post('berat_badan'),
        'tekanan_darah'=>$this->input->post('tekanan_darah'),
        'jam_masuk'=>$this->input->post('jam_masuk'),
        //'estimasi'=>$this->input->post('estimasi'),
        'keluhan'=>nl2br($this->input->post('keluhan')),
        'perintah'=>nl2br($this->input->post('perintah')),

        'entry_user'=>$cookie_id_user,
        'entry_date'=>$now,
      );
      $this->db->trans_begin();
      $this->Bis_model->insertData('trans_wo',$data);
      if ($this->db->trans_status() === FALSE)
      {
              $this->db->trans_rollback();
      }
      else
      {
              $this->db->trans_commit();
              $this->session->set_flashdata('message', 'Sukses tambah data baru.');
              $this->session->set_flashdata('jenis', 'success');
              redirect(site_url('Workorder'));
      }
      }



//    ========================== DELETE =======================
    function hapus(){
        $id['no_wo'] = $this->input->post('no_wo');
        $no_wo = $this->input->post('no_wo');
        $this->db->trans_begin();
        $this->Bis_model->deleteData('trans_wo',$id);
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses delete.');
                $this->session->set_flashdata('jenis', 'danger');
                redirect(site_url('Finishworkorder'));
        }

    }
//    ====================== EXPORT KE EXCEL ===================
function cetak()
{

  $no_wo = $this->input->post('no_wo');
  $id = get_cookie('eklinik');

                  $query_wo="SELECT
                            	trans_wo.no_wo,
                            	trans_wo.tgl_masuk,
                            	trans_wo.tgl_keluar,
                            	trans_wo.tipe_wo,
                            	trans_wo.id_customer,
                            	trans_wo.id_plant,
                            	trans_wo.nama,
                            	trans_wo.alamat,
                            	trans_wo.telepon,
                            	trans_wo.no_register_px,
                            	trans_wo.tekanan_darah,
                            	trans_wo.tinggi_badan,
                            	trans_wo.berat_badan,
                            	trans_wo.jam_masuk,
                            	trans_wo.estimasi,
                            	trans_wo.diketahui,
                            	trans_wo.keluhan,
                            	trans_wo.person,
                            	trans_wo.diserahkan,
                            	trans_wo.perintah,
                            	trans_wo.tindakan,
                            	trans_wo.status_wo,
                            	trans_wo.status_ar,
                            	trans_wo.no_ar,
                            	trans_wo.edit_date,
                            	trans_wo.edit_user,
                            	trans_wo.entry_date,
                            	trans_wo.entry_user,
                            	bb.nama AS nama_pegawai_edit,
                            	aa.nama AS nama_pegawai,
                            	ms_pasien.jk,
                            	ms_pasien.bpjs_kes,
                            	ms_pasien.email,
                            	ms_pasien.ktp,
                            	ms_pasien.keterangan AS riwayat,
                            	cc.nama AS nama_dokter,
                            	cc.id_pegawai AS id_dokter,
                            	trans_wo.instruksi,
                            	trans_wo.subjective,
                            	trans_wo.objective,
                            	trans_wo.assesment,
                            	trans_wo.planing
                            FROM
                            	trans_wo
                            	LEFT JOIN `user` AS a ON trans_wo.entry_user = a.id_user
                            	LEFT JOIN `user` AS b ON trans_wo.edit_user = b.id_user
                            	LEFT JOIN ms_pegawai AS aa ON a.id_pegawai = aa.id_pegawai
                            	LEFT JOIN ms_pegawai AS bb ON b.id_pegawai = bb.id_pegawai
                            	LEFT JOIN ms_pasien ON trans_wo.no_register_px = ms_pasien.no_register
                            	INNER JOIN ms_pegawai AS cc ON trans_wo.id_dokter = cc.id_pegawai
                            WHERE
                                	trans_wo.no_wo = '$no_wo'";
                              //echo $query_wo;
        $query_jasa="SELECT
                    	ms_jasa.nama,
                    	trans_jasa_wo.id,
                    	trans_jasa_wo.no_wo
                    FROM
                    	trans_jasa_wo
                    	INNER JOIN ms_jasa ON trans_jasa_wo.id_jasa = ms_jasa.id_jasa
                    WHERE
                    	trans_jasa_wo.no_wo = '$no_wo'";
                              $data=array(
                                     'title'=>'FORM PELAYANAN KLINIK',
                                     //'data_customer' => $this->Bis_model->manualQuery($query_data),
                                     'data_wo' => $this->Bis_model->manualQuery($query_wo),
                                     'data_jasa' => $this->Bis_model->manualQuery($query_jasa),

                                     'users'=>$this->Hak_Akses_m->get_user($id),
                                     'menu'=>$this->Menu_m->get_menu($id),
                                     'submenu'=>$this->Menu_m->get_submenu($id),
                               );
  $this->load->view('report/Cetakfinishwo',$data);
}

}
