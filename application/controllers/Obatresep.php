<?php
class Obatresep extends CI_Controller{
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
                  	INNER JOIN trans_wo ON judul_ro.no_ref = trans_wo.no_wo
                  	INNER JOIN ms_pasien ON trans_wo.no_register_px = ms_pasien.no_register
                  	LEFT JOIN ms_pegawai ON trans_wo.id_dokter = ms_pegawai.id_pegawai
                  WHERE judul_ro.status IS NULL LIMIT 100";
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
  function Ambilobat()
  {
    //'kd_barang'=>$this->model_app->getKodeBarang(),
    $id = get_cookie('eklinik');
    $cookie_id_user = get_cookie('eklinik');

    $idx = get_cookie('eklinik');
    $kd_sub_unit=$this->session->userdata('kd_sub_unit'.$idx);
    $ses_id_jenis=$this->session->userdata('id_jenis'.$idx);
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
                  	detail_ro.no_bukti,
                  	ms_barang.id_barang as kd_barang,
                  	ms_barang.nama as nama_barang,
                  	ms_barang.satuan,
                  	detail_ro.no_row,
                  	detail_ro.qty,
                  	ms_barang.harga_jual as hb,
                    detail_ro.qty*ms_barang.harga_jual as total,
                  	detail_ro.keterangan
                  FROM
                  	detail_ro
                  	INNER JOIN ms_barang ON detail_ro.kd_barang = ms_barang.id_barang
                  WHERE
                  	detail_ro.no_bukti = '$no_resep'
                  ORDER BY
                  	detail_ro.no_row ASC";
                            // AND trans_wo.status_wo IS NULL

   //echo $query_detail_resep;
    $data=array(
            'perintah'=>'Baru',
            'title'=>'Penjualan Obat Resep',
            'title_filter'=>'Cari Penjualan',
            'title_tambah'=>'Daftar Permintaan Obat Tindakan Medis',
            'title_report'=>'Laporan Kunjungan',
            'title_penduduk'=>'Data Pasien Terdaftar',
            'xmenu'=>'Farmasi',
            'xsubmenu'=>'Obat Resep',
            'data_judul_resep' => $this->Bis_model->manualQuery($query_judul_resep),
            'data_detail_resep' => $this->Bis_model->manualQuery($query_detail_resep),
            'data_edit' => $this->Bis_model->manualQuery($query_judul_resep),
            'data_detail' => $this->Bis_model->manualQuery($query_detail_resep),
            'data_sub_unit'=>$this->Bis_model->manualQuery($query_sub_unit),
            //'data_wo' => $this->Bis_model->manualQuery($query_resep),
            'users'=>$this->Hak_Akses_m->get_user($id),
            'menu'=>$this->Menu_m->get_menu($id),
            'submenu'=>$this->Menu_m->get_submenu($id),
     );
     $this->load->view('Posreseptrans_edit_view',$data);
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
function Cetakresep()
{


  $id = get_cookie('eklinik');
  $no_bukti = $this->input->post('no_bukti');
  $query_detail="SELECT
	judul_ro.no_bukti,
	detail_ro.kd_barang,
	detail_ro.qty,
  detail_ro.satuan,
	detail_ro.keterangan,
	ms_barang.nama AS nama_obat
FROM
	judul_ro
	INNER JOIN detail_ro ON judul_ro.no_bukti = detail_ro.no_bukti
	INNER JOIN ms_barang ON detail_ro.kd_barang = ms_barang.id_barang
WHERE
	judul_ro.no_bukti = '$no_bukti'";
  $query_resep="SELECT
	judul_ro.no_bukti,
	judul_ro.tgl_trans,
	judul_ro.no_ref,
	judul_ro.keterangan,
	judul_ro.entry_user,
	judul_ro.entry_date,
	trans_wo.no_wo,
	trans_wo.no_register_px,
	trans_wo.id_poli,
	trans_wo.id_dokter,
	UPPER( trans_wo.nama ) AS nama_pasien,
	trans_wo.alamat,
	ms_poli.nama_poli,
	trans_wo.tipe_wo,
	ms_pegawai.nama AS nama_dokter
FROM
	judul_ro
	INNER JOIN trans_wo ON judul_ro.no_ref = trans_wo.no_wo
	INNER JOIN ms_poli ON trans_wo.id_poli = ms_poli.id_poli
	LEFT JOIN ms_pegawai ON trans_wo.id_dokter = ms_pegawai.id_pegawai

                    WHERE
                      judul_ro.no_bukti = '$no_bukti'";
                           //echo $query_resep;
                              $data=array(
                                     'title'=>'RESEP DOKTER',
                                     //'data_customer' => $this->Bis_model->manualQuery($query_data),
                                     'data_resep' => $this->Bis_model->manualQuery($query_resep),
                                     'detail_resep' => $this->Bis_model->manualQuery($query_detail),
                                     'users'=>$this->Hak_Akses_m->get_user($id),
                                     'menu'=>$this->Menu_m->get_menu($id),
                                     'submenu'=>$this->Menu_m->get_submenu($id),
                               );
  $this->load->view('report/Cetakresep',$data);
  //$this->load->view('report/Cetakresepkecil',$data);
}
function Cetakresepkecil()
{


  $id = get_cookie('eklinik');
  $no_bukti = $this->input->post('no_bukti');
  $query_detail="SELECT
	judul_ro.no_bukti,
	detail_ro.kd_barang,
	detail_ro.qty,
  detail_ro.satuan,
	detail_ro.keterangan,
	ms_barang.nama AS nama_obat
FROM
	judul_ro
	INNER JOIN detail_ro ON judul_ro.no_bukti = detail_ro.no_bukti
	INNER JOIN ms_barang ON detail_ro.kd_barang = ms_barang.id_barang
WHERE
	judul_ro.no_bukti = '$no_bukti'";
  $query_resep="SELECT
	judul_ro.no_bukti,
	judul_ro.tgl_trans,
	judul_ro.no_ref,
	judul_ro.keterangan,
	judul_ro.entry_user,
	judul_ro.entry_date,
	trans_wo.no_wo,
	trans_wo.no_register_px,
	trans_wo.id_poli,
	trans_wo.id_dokter,
	UPPER( trans_wo.nama ) AS nama_pasien,
	trans_wo.alamat,
	ms_poli.nama_poli,
	trans_wo.tipe_wo,
	ms_pegawai.nama AS nama_dokter
FROM
	judul_ro
	INNER JOIN trans_wo ON judul_ro.no_ref = trans_wo.no_wo
	INNER JOIN ms_poli ON trans_wo.id_poli = ms_poli.id_poli
	LEFT JOIN ms_pegawai ON trans_wo.id_dokter = ms_pegawai.id_pegawai

                    WHERE
                      judul_ro.no_bukti = '$no_bukti'";
                           //echo $query_resep;
                              $data=array(
                                     'title'=>'RESEP DOKTER',
                                     //'data_customer' => $this->Bis_model->manualQuery($query_data),
                                     'data_resep' => $this->Bis_model->manualQuery($query_resep),
                                     'detail_resep' => $this->Bis_model->manualQuery($query_detail),
                                     'users'=>$this->Hak_Akses_m->get_user($id),
                                     'menu'=>$this->Menu_m->get_menu($id),
                                     'submenu'=>$this->Menu_m->get_submenu($id),
                               );
  //$this->load->view('report/Cetakresep',$data);
  $this->load->view('report/Cetakresepkecil',$data);
}

}
