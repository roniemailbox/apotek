<?php
class Tkp extends CI_Controller{
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
    $kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
    $query_data="SELECT
                  trans_cb.no_bukti,
                  trans_cb.tgl_trans,
                	trans_cb.tgl_trans,
                	Sum( trans_cb.jml_trans ) AS nilai_kas,
                	trans_cb.kd_sub_unit,
                	trans_cb.entry_user,
                	ms_pegawai.nama AS nama_kasir,
                	mastersubunit.nama_sub_unit
                FROM
                	trans_cb
                	INNER JOIN `user` ON trans_cb.entry_user = `user`.id_user
                	INNER JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
                	INNER JOIN mastersubunit ON trans_cb.kd_sub_unit = mastersubunit.kd_sub_unit
                GROUP BY
                	ms_pegawai.nama,
                	trans_cb.kd_sub_unit
                HAVING
                	trans_cb.kd_sub_unit = $kd_sub_unit
                ";
               //echo $query_data;
    $data=array(
            'perintah'=>'Baru',
            'title'=>'Daftar Kas Pos Belum Disetorkan',
            'title_filter'=>'Cari Kunjungan',
            'title_tambah'=>'Daftar Kas Pos Belum Disetorkan',
            'title_report'=>'Laporan Kunjungan',
            'title_penduduk'=>'Data Pasien Terdaftar',
            'data_kaspos' => $this->Bis_model->manualQuery($query_data),
            'users'=>$this->Hak_Akses_m->get_user($id),
            'menu'=>$this->Menu_m->get_menu($id),
            'submenu'=>$this->Menu_m->get_submenu($id),
     );
     $this->load->view('Tarikkaspos_view',$data);
  }

  function filter()
  {
    //'kd_barang'=>$this->model_app->getKodeBarang(),
    $filter = $this->input->post('katakunci');
    $id = get_cookie('eklinik');
    $cookie_id_user = get_cookie('eklinik');

    //$query_bisnis="select * from ms_bisnis where aktif=1 and id_bisnis='EUR'";

    $query_resep="SELECT
                    judul_ro.no_bukti,
                    judul_ro.tgl_trans,
                    trans_wo.no_wo,
                    trans_wo.id_dokter,
                    trans_wo.no_register_px,
                    ms_pasien.nama AS nama_pasien,
                    ms_pasien.telepon,
                    ms_pegawai.nama AS nama_dokter
                  FROM
                    judul_ro
                    LEFT JOIN trans_wo ON judul_ro.no_ref = trans_wo.no_wo
                    LEFT JOIN ms_pasien ON trans_wo.no_register_px = ms_pasien.no_register
                    LEFT JOIN ms_pegawai ON trans_wo.id_dokter = ms_pegawai.id_pegawai
                  WHERE judul_ro.no_bukti like '%$filter%' or ms_pasien.nama like '%$filter%' or trans_wo.no_wo like '%$filter%' or ms_pegawai.nama like '%$filter%'";
                            // AND trans_wo.status_wo IS NULL

     // echo $query_wo;
    $data=array(
            'perintah'=>'Baru',
            'title'=>'Daftar Permintaan Obat Tindakan Medis',
            'title_filter'=>'Cari Kunjungan',
            'title_tambah'=>'Daftar Permintaan Obat Tindakan Medis',
            'title_report'=>'Laporan Kunjungan',
            'title_penduduk'=>'Data Pasien Terdaftar',
            //'data_pasien' => $this->Bis_model->manualQuery($query_data),
            //'data_dokter' => $this->Bis_model->manualQuery($query_dokter),
            'data_wo' => $this->Bis_model->manualQuery($query_resep),

            'users'=>$this->Hak_Akses_m->get_user($id),
            'menu'=>$this->Menu_m->get_menu($id),
            'submenu'=>$this->Menu_m->get_submenu($id),
     );
     $this->load->view('Obatresep_view',$data);
  }
  function tagihan()
  {
    $id = get_cookie('eklinik');
    $cookie_id_user = get_cookie('eklinik');
    $idx = get_cookie('eklinik');
    $kd_sub_unit=$this->session->userdata('kd_sub_unit'.$idx);
    $ses_id_jenis=$this->session->userdata('id_jenis'.$idx);

    $no_wo=$this->input->post('no_wo');;
    if($ses_id_jenis<3)
    {
      $dan="";
      $dan2="";
    }
    else {
      $dan=" WHERE
      detail_ms_barang.kd_sub_unit = '$kd_sub_unit'";

      $dan2=" WHERE
      mastersubunit.kd_sub_unit = '$kd_sub_unit'";
    }
    $query_sub_unit="SELECT
                        mastersubunit.kd_sub_unit,
                        mastersubunit.nama_sub_unit,
                        mastersubunit.kd_unit
                      FROM
                        mastersubunit
                        $dan2
                      ORDER BY
                        mastersubunit.nama_sub_unit ASC";

    $no_resep=$this->input->post('no_resep');
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
    $query_jasa="SELECT
                	trans_jasa_wo.id,
                	trans_jasa_wo.no_wo,
                	trans_jasa_wo.id_jasa,
                	trans_jasa_wo.nilai,
                	ms_jasa.nama
                FROM
                	trans_jasa_wo
                	INNER JOIN ms_jasa ON trans_jasa_wo.id_jasa = ms_jasa.id_jasa
                WHERE
                	trans_jasa_wo.no_wo = '$no_wo'";
    $query_judul_resep="SELECT
                        	judul_ro.no_bukti,
                        	judul_ro.tgl_trans,
                        	judul_ro.no_ref,
                        	judul_ro.keterangan,
                        	judul_ro.kd_sub_unit,
                        	judul_ro.entry_user,
                        	judul_ro.entry_date,
                        	trans_wo.no_wo,
                        	trans_wo.no_register_px AS id_customer,
                        	trans_wo.id_poli,
                        	trans_wo.id_dokter,
                        	trans_wo.nama AS nama_customer,
                        	trans_wo.alamat AS alamat_customer,
                        	ms_poli.nama_poli,
                        	trans_wo.tipe_wo,
                        	ms_pegawai.nama AS nama_dokter,
                        	mastersubunit.nama_sub_unit AS nama_sub_unit,
                        	ms_jenis_pasien.nama AS nama_jenis
                        FROM
                        	judul_ro
                        	INNER JOIN trans_wo ON judul_ro.no_ref = trans_wo.no_wo
                        	LEFT JOIN ms_poli ON trans_wo.id_poli = ms_poli.id_poli
                        	LEFT JOIN ms_pegawai ON trans_wo.id_dokter = ms_pegawai.id_pegawai
                        	LEFT JOIN mastersubunit ON judul_ro.kd_sub_unit = mastersubunit.kd_sub_unit
                        	INNER JOIN ms_jenis_pasien ON trans_wo.tipe_wo = ms_jenis_pasien.id_jenis_pasien
                        WHERE
                        	judul_ro.no_bukti = '$no_resep'";

    $query_detail_resep="SELECT
                        	judul_ro.no_bukti,
                        	detail_si.hj,
                        	detail_si.qty,
                        	detail_si.nama_barang,
                        	detail_si.satuan,
                        	detail_si.total
                        FROM
                        	judul_ro
                        	INNER JOIN judul_si ON judul_ro.no_bukti = judul_si.no_ref
                        	INNER JOIN detail_si ON judul_si.no_bukti = detail_si.no_bukti
                        WHERE
                        	judul_ro.no_bukti = '$no_resep'";
                            // AND trans_wo.status_wo IS NULL

    //echo $query_detail_resep;
    $data=array(
            'perintah'=>'Baru',
            'title'=>'Penentuan Nilai Tindakan Jasa',
            'title_filter'=>'Cari Penjualan',
            'title_tambah'=>'Daftar Permintaan Obat Tindakan Medis',
            'title_report'=>'Laporan Kunjungan',
            'title_penduduk'=>'Data Pasien Terdaftar',
            'xmenu'=>'Kasir',
            'xsubmenu'=>'Kasir Klinik',
            'data_judul_resep' => $this->Bis_model->manualQuery($query_judul_resep),
            'data_detail_resep' => $this->Bis_model->manualQuery($query_detail_resep),
            'data_edit' => $this->Bis_model->manualQuery($query_judul_resep),
            'data_detail_resep' => $this->Bis_model->manualQuery($query_detail_resep),
            'data_sub_unit'=>$this->Bis_model->manualQuery($query_sub_unit),
            'data_wo' => $this->Bis_model->manualQuery($query_wo_edit),
            'data_jasa' => $this->Bis_model->manualQuery($query_jasa),
            'users'=>$this->Hak_Akses_m->get_user($id),
            'menu'=>$this->Menu_m->get_menu($id),
            'submenu'=>$this->Menu_m->get_submenu($id),
     );
     $this->load->view('Kasir_klinik_view',$data);
  }
  function simpankaspos()
  {
    $id = get_cookie('eklinik');
    $kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
    $now = date('Y-m-d H:i:s');
    $date = new DateTime($this->input->post('tgl_produksi'));
    $id_plant = $this->input->post('id_plant');
    $year = $date -> format('Y');
    $month = $date -> format('m');
    $day = $date -> format('d');
    $cookie_id_user = get_cookie('eklinik');
    $tipe_trans="M";
    $no_cb=  $kd_sub_unit."-".time();
    $no_wo=$this->input->post('no_wo');
    $datacb=array(
      'no_bukti'=>$no_cb,
      'tgl_trans'=>$this->input->post('tgl_trans'),
      'no_ref'=>$no_wo,
      'jml_trans'=>$this->input->post('total'),
      'tipe_trans'=>$tipe_trans,
      'kd_sub_unit'=>$kd_sub_unit,
      'modul_asal'=>'RM',
      'keterangan'=>$keterangan,
      'entry_user'=>$cookie_id_user,
      'entry_date'=>$now,
    );

    $data=array(
      'total_jasa'=>$this->input->post('total_jasa'),
      'total_obat'=>$this->input->post('total_barang'),
      'total'=>$this->input->post('total'),
      'status_ar'=>0,
    );
    $idwo['no_wo']=$this->input->post('no_wo');

    $this->db->trans_off();
    $this->db->trans_begin();
    $this->db->trans_strict(true);
    $this->Bis_model->insertData('trans_cb',$datacb);
    $this->Bis_model->updateData('trans_wo',$data,$idwo);

    foreach ($this->input->post('rowsBM') as $key => $count )
    {

        $data_jasa=array(
          'no_bukti'=>$no_bukti,
          'kd_barang'=>$this->input->post('id_barang_'.$count),
          //'no_row'=>$this->input->post('no_row_'.$count),
          'hj'=>$this->input->post('hj_'.$count),
          'dpp'=>$this->input->post('dpp_'.$count),
          'nilaippn'=>$this->input->post('nilaippn_'.$count),
          'qty'=>$this->input->post('qty_'.$count),
          'nama_barang'=>$this->input->post('nama_barang_'.$count),
          'diskon'=>$this->input->post('diskon_'.$count),
          'perc_diskon'=>$this->input->post('perc_diskon_'.$count),
          'total'=>$this->input->post('total_'.$count),
          'satuan'=>$this->input->post('satuan_'.$count),
        );
        //$this->Bis_model->insertData('detail_si',$data);
    }
    $this->db->trans_complete();
    if ($this->db->trans_status() === FALSE)
    {
            $this->db->trans_rollback();
            $this->session->set_flashdata('message', 'Gagal input data produksi.');
            $this->session->set_flashdata('jenis', 'danger');
            $this->session->set_flashdata('no_penjuaan', $no_bukti);
            redirect(site_url('Kasirklinik'));
    }
    else
    {
            $this->db->trans_commit();
            $this->session->set_flashdata('message', 'Sukses tambah data baru.');
            $this->session->set_flashdata('jenis', 'success');
            $this->session->set_flashdata('no_penjuaan', $no_bukti);
            redirect(site_url('Kasirklinik'));
    }
    }

  function tambah()
  {
    $id = get_cookie('eklinik');
    $kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
    $pad_kd_sub_unit = sprintf("%02d", $kd_sub_unit);
    $now = date('Y-m-d H:i:s');
    $date = new DateTime($this->input->post('tgl_produksi'));
    $id_plant = $this->input->post('id_plant');
    $year = $date -> format('y');
    $month = $date -> format('m');
    $day = $date -> format('d');
    $jenis_bayar=$this->input->post('jenis_bayar');
    if ($jenis_bayar=="TUNAI") {
      $kode_bayar="NPT";
    }
    else {
      $kode_bayar="NPK";
    }
    $kode_bukti=$kode_bayar.$pad_kd_sub_unit.$year.$month;
    $cookie_id_user = get_cookie('eklinik');

    $no_bukti= $this->Bis_model->getIdSi($kode_bukti);
    $data=array(
      'no_bukti'=>$no_bukti,
      'tgl_trans'=>$this->input->post('tgl_trans'),
      'id_customer'=>$this->input->post('npa'),
      //'id_sales'=>$this->input->post('id_sales'),
      'kd_sub_unit'=>$kd_sub_unit,
      'kd_sub_unit_anggota'=>$this->input->post('kd_sub_unit'),
      //'id_slock'=>$this->input->post('id_slock'),
      //'id_plant'=>$this->input->post('id_plant'),
      'jenis_bayar'=>$this->input->post('jenis_bayar'),
      //'top'=>$this->input->post('top'),
      'jenis_ppn'=>$this->input->post('jenis_ppn'),
      'no_ref'=>$this->input->post('no_resep'),
      'subtotal'=>$this->input->post('subtotal'),
      'diskon'=>$this->input->post('diskon'),
      'dpp'=>$this->input->post('dpp'),
      'ppn'=>$this->input->post('ppn'),
      'total'=>$this->input->post('grandtotal'),
      'voucher'=>$this->input->post('voucher'),
      'dp'=>$this->input->post('dp'),
      //'ar'=>$this->input->post('ar'),
      //'jml_cicilan'=>$this->input->post('jml_cicilan'),
      'keterangan'=>$this->input->post('keterangan'),
      'entry_user'=>$cookie_id_user,
      'entry_date'=>$now,
    );
    $idwo['no_wo']=$this->input->post('no_wo');
    $datawo=array(
      'status_resep'=>1,
    );

    $this->db->trans_off();
    $this->db->trans_begin();
    $this->db->trans_strict(true);
    $this->Bis_model->insertData('judul_si',$data);
    $this->Bis_model->updateData('trans_wo',$datawo,$idwo);

    foreach ($this->input->post('rowsBM') as $key => $count )
    {

        $data=array(
          'no_bukti'=>$no_bukti,
          'kd_barang'=>$this->input->post('id_barang_'.$count),
          //'no_row'=>$this->input->post('no_row_'.$count),
          'hj'=>$this->input->post('hj_'.$count),
          'dpp'=>$this->input->post('dpp_'.$count),
          'nilaippn'=>$this->input->post('nilaippn_'.$count),
          'qty'=>$this->input->post('qty_'.$count),
          'nama_barang'=>$this->input->post('nama_barang_'.$count),
          'diskon'=>$this->input->post('diskon_'.$count),
          'perc_diskon'=>$this->input->post('perc_diskon_'.$count),
          'total'=>$this->input->post('total_'.$count),
          'satuan'=>$this->input->post('satuan_'.$count),
        );
        $this->Bis_model->insertData('detail_si',$data);
    }
    $this->db->trans_complete();
    if ($this->db->trans_status() === FALSE)
    {
            $this->db->trans_rollback();
            $this->session->set_flashdata('message', 'Gagal input data produksi.');
            $this->session->set_flashdata('jenis', 'danger');
            $this->session->set_flashdata('no_penjuaan', $no_bukti);
            redirect(site_url('Obatresep'));
    }
    else
    {
            $this->db->trans_commit();
            $this->session->set_flashdata('message', 'Sukses tambah data baru.');
            $this->session->set_flashdata('jenis', 'success');
            $this->session->set_flashdata('no_penjuaan', $no_bukti);
            redirect(site_url('Obatresep'));
    }
    }
//    ====================== EXPORT KE EXCEL ===================
function Cetaktagihan()
{


  $id = get_cookie('eklinik');
  $cookie_id_user = get_cookie('eklinik');
  $idx = get_cookie('eklinik');
  $kd_sub_unit=$this->session->userdata('kd_sub_unit'.$idx);
  $ses_id_jenis=$this->session->userdata('id_jenis'.$idx);

  $no_wo=$this->input->post('no_wo');;
  $no_resep=$this->input->post('no_resep');
  $query_wo="SELECT
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
  $query_jasa="SELECT
                trans_jasa_wo.id,
                trans_jasa_wo.no_wo,
                trans_jasa_wo.id_jasa,
                trans_jasa_wo.nilai,
                UPPER(ms_jasa.nama) as nama
              FROM
                trans_jasa_wo
                INNER JOIN ms_jasa ON trans_jasa_wo.id_jasa = ms_jasa.id_jasa
              WHERE
                trans_jasa_wo.no_wo = '$no_wo'";

  $query_detail_resep="SELECT
                        judul_ro.no_bukti,
                        detail_si.hj,
                        detail_si.qty,
                        detail_si.nama_barang as nama_obat,
                        detail_si.satuan,
                        detail_si.total
                      FROM
                        judul_ro
                        INNER JOIN judul_si ON judul_ro.no_bukti = judul_si.no_ref
                        INNER JOIN detail_si ON judul_si.no_bukti = detail_si.no_bukti
                      WHERE
                        judul_ro.no_bukti = '$no_resep'";
                          // AND trans_wo.status_wo IS NULL

 //echo $query_wo;
  $data=array(

          'title'=>'TAGIHAN PEMBAYARAN',
          'xmenu'=>'Kasir',
          'xsubmenu'=>'Kasir Klinik',


          'detail_resep' => $this->Bis_model->manualQuery($query_detail_resep),

          'data_wo' => $this->Bis_model->manualQuery($query_wo),
          'data_jasa' => $this->Bis_model->manualQuery($query_jasa),
          'users'=>$this->Hak_Akses_m->get_user($id),
          'menu'=>$this->Menu_m->get_menu($id),
          'submenu'=>$this->Menu_m->get_submenu($id),
   );
  $this->load->view('report/Cetaktagihanrmkecil',$data);
}

}
