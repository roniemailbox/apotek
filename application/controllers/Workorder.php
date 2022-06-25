<?php
class Workorder extends CI_Controller{
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
    $query_poli="select * from ms_poli";
    $query_dokter="SELECT
                    ms_pegawai.id_pegawai,
                    UPPER(ms_pegawai.nama) as nama
                  FROM
                    ms_pegawai
                    INNER JOIN ms_jabatan ON ms_pegawai.id_jabatan = ms_jabatan.id_jabatan
                  WHERE
                    ms_jabatan.nama LIKE 'DOKTER%' OR ms_jabatan.nama like '%MEDIS%'
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
    $query_jml_wo="SELECT
                    	Count( trans_wo.no_wo ) AS jml
                    FROM
                    	trans_wo";
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
                  ms_poli.id_poli,
                  ms_poli.nama_poli,
                  cc.nama as nama_dokter
                FROM
                	trans_wo
                	LEFT JOIN `user` AS a ON trans_wo.entry_user = a.id_user
                	LEFT JOIN `user` AS b ON trans_wo.edit_user = b.id_user
                	LEFT JOIN ms_pegawai AS aa ON a.id_pegawai = aa.id_pegawai
                	LEFT JOIN ms_pegawai AS bb ON b.id_pegawai = bb.id_pegawai
                	LEFT JOIN ms_pasien ON trans_wo.no_register_px = ms_pasien.no_register
                  LEFT JOIN ms_poli ON trans_wo.id_poli= ms_poli.id_poli
                  LEFT JOIN ms_pegawai as cc ON trans_wo.id_dokter = cc.id_pegawai
                WHERE
                	trans_wo.no_wo IS NOT NULL
                ORDER BY
                	trans_wo.tgl_masuk DESC LIMIT 10";
                            // AND trans_wo.status_wo IS NULL

     // echo $query_wo;
    $query_jenis_px="select * from ms_jenis_pasien";
    $jml_wo = $this->db->get_where('trans_wo')->num_rows();
    $data=array(
            'perintah'=>'Baru',
            'title'=>'Daftar Kunjungan',
            'title_filter'=>'Cari Kunjungan',
            'title_tambah'=>'Input Kunjungan',
            'title_report'=>'Laporan Kunjungan',
            'title_penduduk'=>'Data Pasien Terdaftar',
            'data_pasien' => $this->Bis_model->manualQuery($query_data),
            'data_jenis_px'=>$this->Bis_model->manualQuery($query_jenis_px),
            'data_dokter' => $this->Bis_model->manualQuery($query_dokter),
            'data_wo' => $this->Bis_model->manualQuery($query_wo),
            'jml_wo' => $jml_wo,
            'data_jasa' => $this->Bis_model->manualQuery($query_jasa),
            'data_poli' => $this->Bis_model->manualQuery($query_poli),
            'users'=>$this->Hak_Akses_m->get_user($id),
            'menu'=>$this->Menu_m->get_menu($id),
            'submenu'=>$this->Menu_m->get_submenu($id),
     );
     $this->load->view('Workorder_view',$data);
  }
  function filter()
  {
    //'kd_barang'=>$this->model_app->getKodeBarang(),
    $id = get_cookie('eklinik');
    $filter = $this->input->post('katakunci');
    $query_jasa="select * from ms_jasa";
    $jml_wo = $this->db->get_where('trans_wo')->num_rows();
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
                  ms_poli.id_poli,
                  ms_poli.nama_poli,
                  cc.nama as nama_dokter
                FROM
                	trans_wo
                	LEFT JOIN `user` AS a ON trans_wo.entry_user = a.id_user
                	LEFT JOIN `user` AS b ON trans_wo.edit_user = b.id_user
                	LEFT JOIN ms_pegawai AS aa ON a.id_pegawai = aa.id_pegawai
                	LEFT JOIN ms_pegawai AS bb ON b.id_pegawai = bb.id_pegawai
                	LEFT JOIN ms_pasien ON trans_wo.no_register_px = ms_pasien.no_register
                  LEFT JOIN ms_poli ON trans_wo.id_poli= ms_poli.id_poli
                  LEFT JOIN ms_pegawai as cc ON trans_wo.id_dokter = cc.id_pegawai
                WHERE
                (trans_wo.nama like '%$filter%' OR trans_wo.alamat like '%$filter%' OR trans_wo.no_wo like '%$filter%' OR trans_wo.keluhan like '%$filter%' )";

    $data=array(
      'perintah'=>'Baru',
      'title'=>'Daftar Kunjungan',
      'title_filter'=>'Cari Kunjungan',
      'title_tambah'=>'Input Kunjungan',
      'title_report'=>'Laporan Kunjungan',
      'title_penduduk'=>'Data Pasien Terdaftar',
      'data_pasien' => $this->Bis_model->manualQuery($query_data),
      'data_wo' => $this->Bis_model->manualQuery($query_wo),
      'data_jasa' => $this->Bis_model->manualQuery($query_jasa),
      'jml_wo' => $jml_wo,
      'users'=>$this->Hak_Akses_m->get_user($id),
      'menu'=>$this->Menu_m->get_menu($id),
      'submenu'=>$this->Menu_m->get_submenu($id),
     );
   $this->load->view('Workorder_view',$data);
  }



  function Dataedit()
  {
    //'kd_barang'=>$this->model_app->getKodeBarang(),
    $no_wo= $this->input->post('no_wo');
    $id = get_cookie('eklinik');
    $cookie_id_user = get_cookie('eklinik');
    $id_plant_id=$this->session->userdata('id_plant'.$cookie_id_user);
    $id_jenis=$this->session->userdata('id_jenis'.$cookie_id_user);
    $jml_wo = $this->db->get_where('trans_wo')->num_rows();
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
                    UPPER(ms_pegawai.nama) as nama
                  FROM
                    ms_pegawai
                    INNER JOIN ms_jabatan ON ms_pegawai.id_jabatan = ms_jabatan.id_jabatan
                  WHERE
                    ms_jabatan.nama LIKE 'DOKTER%' OR ms_jabatan.nama like '%MEDIS%'
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
                  ms_poli.id_poli,
                  ms_poli.nama_poli,
                  cc.nama as nama_dokter
                FROM
                	trans_wo
                	LEFT JOIN `user` AS a ON trans_wo.entry_user = a.id_user
                	LEFT JOIN `user` AS b ON trans_wo.edit_user = b.id_user
                	LEFT JOIN ms_pegawai AS aa ON a.id_pegawai = aa.id_pegawai
                	LEFT JOIN ms_pegawai AS bb ON b.id_pegawai = bb.id_pegawai
                	LEFT JOIN ms_pasien ON trans_wo.no_register_px = ms_pasien.no_register
                  LEFT JOIN ms_poli ON trans_wo.id_poli= ms_poli.id_poli
                  LEFT JOIN ms_pegawai as cc ON trans_wo.id_dokter = cc.id_pegawai
                WHERE
                	trans_wo.no_wo IS NOT NULL
                ORDER BY
                	trans_wo.tgl_masuk DESC LIMIT 10";
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
                                	ms_pasien.bpjs_kes,
                                	ms_pasien.email,
                                  ms_pasien.tgllahir,
                                	ms_pasien.ktp,
                                	ms_poli.id_poli,
                                	ms_poli.nama_poli,
                                	cc.nama AS nama_dokter,
                                	trans_wo.id_dokter,
                                	ms_pasien.kotalahir,
                                	ms_kabupaten.`name` AS kota_lahir
                                FROM
                                	trans_wo
                                	LEFT JOIN `user` AS a ON trans_wo.entry_user = a.id_user
                                	LEFT JOIN `user` AS b ON trans_wo.edit_user = b.id_user
                                	LEFT JOIN ms_pegawai AS aa ON a.id_pegawai = aa.id_pegawai
                                	LEFT JOIN ms_pegawai AS bb ON b.id_pegawai = bb.id_pegawai
                                	LEFT JOIN ms_pasien ON trans_wo.no_register_px = ms_pasien.no_register
                                	LEFT JOIN ms_poli ON trans_wo.id_poli = ms_poli.id_poli
                                	LEFT JOIN ms_pegawai AS cc ON trans_wo.id_dokter = cc.id_pegawai
                                  LEFT JOIN ms_kabupaten ON ms_pasien.kotalahir = ms_kabupaten.id
                                  LEFT JOIN ms_jenis_pasien ON trans_wo.tipe_wo = ms_jenis_pasien.id_jenis_pasien
                                WHERE
                                trans_wo.no_wo ='$no_wo'";
      $query_jenis_px="select * from ms_jenis_pasien";
    $data=array(
      'perintah'=>'Edit',
      'title'=>'Daftar Kunjungan',
      'title_filter'=>'Cari Kunjungan',
      'title_tambah'=>'Edit Kunjungan',
      'title_report'=>'Laporan Kunjungan',
      'title_penduduk'=>'Data Pasien Terdaftar',
      'data_pasien' => $this->Bis_model->manualQuery($query_data),
      'data_jenis_px'=>$this->Bis_model->manualQuery($query_jenis_px),
      'data_dokter' => $this->Bis_model->manualQuery($query_dokter),
      'data_wo' => $this->Bis_model->manualQuery($query_wo),
      'jml_wo' => $jml_wo,
      'data_wo_edit' => $this->Bis_model->manualQuery($query_wo_edit),
      'data_jasa' => $this->Bis_model->manualQuery($query_jasa),
      'users'=>$this->Hak_Akses_m->get_user($id),
      'menu'=>$this->Menu_m->get_menu($id),
      'submenu'=>$this->Menu_m->get_submenu($id),
     );
   $this->load->view('Workorder_view',$data);
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
                    UPPER(ms_pegawai.nama) as nama
                  FROM
                    ms_pegawai
                    INNER JOIN ms_jabatan ON ms_pegawai.id_jabatan = ms_jabatan.id_jabatan
                  WHERE
                    ms_jabatan.nama LIKE 'DOKTER%' OR ms_jabatan.nama like '%MEDIS%'
                  ORDER BY ms_pegawai.nama ASC
                  ";
    $query_data="SELECT
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
                	INNER JOIN ms_pegawai ON trans_wo.id_dokter = ms_pegawai.id_pegawai
                	INNER JOIN ms_pasien ON trans_wo.no_register_px = ms_pasien.no_register
                WHERE
                	trans_wo.no_register_px = '$no_register'";
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
                	ms_pasien.ktp
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
                              	ms_pasien.kotalahir
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
    $query_poli="SELECT
                	ms_poli.id_poli,
                	ms_poli.nama_poli,
                	ms_poli.entry_user,
                	ms_poli.entry_date,
                	ms_poli.edit_user,
                	ms_poli.edit_date
                FROM
                	ms_poli";
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
                'data_poli' => $this->Bis_model->manualQuery($query_poli),
                'users'=>$this->Hak_Akses_m->get_user($id),
                'menu'=>$this->Menu_m->get_menu($id),
                'submenu'=>$this->Menu_m->get_submenu($id),
     );
   $this->load->view('Finishworkorder_view',$data);

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
      'status_wo'=>1,
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
      $datex = new DateTime($this->input->post('tgl_wo'));
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
        'id_poli'=>$this->input->post('id_poli'),
        'tinggi_badan'=>$this->input->post('tinggi_badan'),
        'berat_badan'=>$this->input->post('berat_badan'),
        'tekanan_darah'=>$this->input->post('tekanan_darah'),
        'jam_masuk'=>$this->input->post('jam_masuk'),
        //'estimasi'=>$this->input->post('estimasi'),
        'keluhan'=>$this->input->post('keluhan'),
        'status_wo'=>1,
        'perintah'=>$this->input->post('perintah'),
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

      function edit()
      {
        $now = date('Y-m-d H:i:s');

        $cookie_id_user = get_cookie('eklinik');
        $no_wo = $this->input->post('no_wo');
        $idwo['no_wo'] = $no_wo;


        //$id_wo= $this->Bis_model->getIdWO($kode_bukti);
        $datawo=array(
          //'no_wo'=>$id_wo,
          'tgl_masuk'=>$this->input->post('tgl_wo'),
          //'tgl_keluar'=>$this->input->post('tgl_keluar'),
          'tipe_wo'=>$this->input->post('tipe_wo'),
          'no_register_px'=>$this->input->post('no_register'),
          'nama'=>$this->input->post('nama'),
          'alamat'=>$this->input->post('alamat'),
          'telepon'=>$this->input->post('telepon'),
          'id_dokter'=>$this->input->post('id_dokter'),
          'id_poli'=>$this->input->post('id_poli'),
          'tinggi_badan'=>$this->input->post('tinggi_badan'),
          'berat_badan'=>$this->input->post('berat_badan'),
          'tekanan_darah'=>$this->input->post('tekanan_darah'),
          'jam_masuk'=>$this->input->post('jam_masuk'),
          //'estimasi'=>$this->input->post('estimasi'),
          'keluhan'=>$this->input->post('keluhan'),
          'status_wo'=>0,
          'perintah'=>$this->input->post('perintah'),
          'edit_user'=>$cookie_id_user,
          'edit_date'=>$now,
        );

        $this->db->trans_begin();
        $this->Bis_model->updateData('trans_wo',$datawo,$idwo);
        //$this->Bis_model->insertData('trans_wo',$data);
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses edit data.');
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
                redirect(site_url('Workorder'));
        }

    }
//    ====================== EXPORT KE EXCEL ===================
function cetak()
{

  $no_wo = $this->input->post('no_wo');
  $no_register = $this->input->post('no_register_px');
  $id = get_cookie('eklinik');
  $query_data="SELECT
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
                INNER JOIN ms_pegawai ON trans_wo.id_dokter = ms_pegawai.id_pegawai
                INNER JOIN ms_pasien ON trans_wo.no_register_px = ms_pasien.no_register
              WHERE
                trans_wo.no_register_px = '$no_register'";

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
                            ms_pasien.keterangan as riwayat,
                            cc.nama AS nama_dokter,
                            cc.id_pegawai AS id_dokter
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
                              $data=array(
                                     'title'=>'FORM PELAYANAN KLINIK',
                                     //'data_customer' => $this->Bis_model->manualQuery($query_data),
                                     'data_histori' => $this->Bis_model->manualQuery($query_data),
                                     'data_wo' => $this->Bis_model->manualQuery($query_wo),
                                     'users'=>$this->Hak_Akses_m->get_user($id),
                                     'menu'=>$this->Menu_m->get_menu($id),
                                     'submenu'=>$this->Menu_m->get_submenu($id),
                               );
  $this->load->view('report/Cetakwo',$data);
}

}
