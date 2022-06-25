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
                  	LEFT JOIN ms_pegawai ON trans_wo.id_dokter = ms_pegawai.id_pegawai";
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
    $no_resep=$this->input->post('no_resep');
    $query_judul_resep="SELECT
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
                      	trans_wo.nama,
                      	trans_wo.alamat,
                      	ms_poli.nama_poli,
                      	trans_wo.tipe_wo
                      FROM
                      	judul_ro
                      	INNER JOIN trans_wo ON judul_ro.no_ref = trans_wo.no_wo
                      	INNER JOIN ms_poli ON trans_wo.id_poli = ms_poli.id_poli
                      WHERE
                      	judul_ro.no_bukti = '$no_resep'";

    $query_detail_resep="SELECT
                  	detail_ro.no_bukti,
                  	ms_barang.id_barang,
                  	ms_barang.nama as nama_barang,
                  	ms_barang.satuan,
                  	detail_ro.no_row,
                  	detail_ro.qty,
                  	ms_barang.harga_jual as hj,
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
            //'data_wo' => $this->Bis_model->manualQuery($query_resep),
            'users'=>$this->Hak_Akses_m->get_user($id),
            'menu'=>$this->Menu_m->get_menu($id),
            'submenu'=>$this->Menu_m->get_submenu($id),
     );
     $this->load->view('Penjualanobatresep_view',$data);
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
}

}
