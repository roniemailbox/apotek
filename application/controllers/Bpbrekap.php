<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bpbrekap extends CI_Controller{

	public $CI = NULL;

	function __construct(){
        parent::__construct();
		$this->load->helper('currency_format_helper');

		$this->CI = & get_instance();

		$this->load->helper(array('url'));
		$this->load->model('umum/Bis_model');
		$this->load->model('umum/Bis_model_ant');
		$this->load->model('Menu_m');
		$this->load->model('Hak_Akses_m');
		$this->load->model('Login_m');
		 $this->load->helper('format_tanggal_helper');
    }

	function index(){

		$id = get_cookie('eklinik');
		$kd_unit=$this->session->userdata('kd_unit'.$id);
		$ses_id_jenis=$this->session->userdata('id_jenis'.$id);
		if($ses_id_jenis<3)
		{
			$dan=" ";
		}
		else {
			 $dan=" WHERE kd_unit = '$kd_unit'";
		}
		$query_chart="SELECT
					 trans_idh.id_plant,
					 Sum(trans_idh.tonase)/1000 AS ton,
					 ms_plant.nama
					 FROM
					 trans_idh
					 INNER JOIN ms_plant ON trans_idh.id_plant = ms_plant.id_plant
					 GROUP BY
					 trans_idh.id_plant

					 ";

		$query_unit="select * from masterunit $dan";
		$data=array(
				'title'=>'Rekap Penjualan',
				'xmenu'=>'Laporan',
				'xsubmenu'=>'Rekap Penjualan',
				'data_unit'=>$this->Bis_model->manualQuery($query_unit),
				'data_chart'=> $this->Bis_model->manualQuery($query_chart),
				'users'=>$this->Hak_Akses_m->get_user(),
				'menu'=>$this->Menu_m->get_menu($id),
				'submenu'=>$this->Menu_m->get_submenu($id),
		);

		$this->load->view('Bpb_report',$data);
	}

	function cetak_rekap()
			{
				$id['no_bukti'] = $this->uri->segment(3);
				$no_bukti=$this->uri->segment(3);
				$id = get_cookie('eklinik');
				$tgl_awal=$this->input->post('tgl_awal');
				$tgl_akhir=$this->input->post('tgl_akhir');
				$kd_unit=$this->input->post('kd_unit');
				$query_unit="select * from masterunit where kd_unit='$kd_unit'";
				$query_data="SELECT
		                	judul_bpb.no_bukti,
		                	judul_bpb.no_po,
		                	judul_bpb.tipe,
		                	judul_bpb.tgl_trans,
		                	judul_bpb.keterangan,
		                	judul_bpb.id_supplier,
		                	ms_supplier.nama AS nama_supplier,
		                	judul_bpb.subtotal,
		                	judul_bpb.diskon,
		                	judul_bpb.dpp,
		                	judul_bpb.ppn,
		                	judul_bpb.total,
		                	judul_bpb.jenis_bayar,
		                	judul_bpb.top,
		                	judul_bpb.jenis_ppn,
		                	judul_bpb.no_ref,
		                	ms_supplier.alamat,
		                	masterunit.nama_unit,
		                	ms_pegawai.nama AS nama_pegawai
		                FROM
		                	judul_bpb
		                LEFT JOIN ms_supplier ON judul_bpb.id_supplier = ms_supplier.id_supplier
		                LEFT JOIN mastersubunit ON judul_bpb.kd_sub_unit = mastersubunit.kd_sub_unit
		                LEFT JOIN masterunit ON mastersubunit.kd_unit = masterunit.kd_unit
		                INNER JOIN `user` ON judul_bpb.entry_user = `user`.id_user
		                INNER JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
										WHERE (judul_bpb.tgl_trans between '$tgl_awal' and '$tgl_akhir') and masterunit.kd_unit='$kd_unit'";

						$q_detail="SELECT
												detail_si.kd_barang,
												detail_si.hj,
												detail_si.dpp,
												detail_si.nilaippn,
												detail_si.qty,
												detail_si.diskon,
												detail_si.perc_diskon,
												detail_si.total,
												detail_si.satuan,
												ms_barang.barcode,
												detail_si.nama_barang,
												judul_si.no_bukti
												FROM
												judul_si
												INNER JOIN detail_si ON judul_si.no_bukti = detail_si.no_bukti
												INNER JOIN ms_barang ON detail_si.kd_barang = ms_barang.id_barang
												WHERE
												judul_si.no_bukti = '$no_bukti'";

				$data=array(
						'title'=>'Laporan Rekap Penjualan',
						'xmenu'=>'Barang Keluar',
						'xsubmenu'=>'Penjualan Kredit',
						'tgl_awal'=>$tgl_awal,
						'tgl_akhir'=>$tgl_akhir,
						'data_bpb'=>$this->Bis_model->manualQuery($query_data),
						'data_unit'=>$this->Bis_model->manualQuery($query_unit),
						'detail_bpb' => $this->Bis_model->manualQuery($q_detail),
						'users'=>$this->Hak_Akses_m->get_user(),
						'menu'=>$this->Menu_m->get_menu($id),
						'submenu'=>$this->Menu_m->get_submenu($id),
				);

				$this->load->view('report/Cetak_rekap_bpb',$data);
			}

	function cetak()
	{
		$id = get_cookie('eklinik');
		$this->load->model('Menu_m');
		$this->load->model('Hak_Akses_m');
		$this->load->model('Login_m');
		$id_plant=$this->input->post('id_plant');
		$tgl_awal=$this->input->post('tgl_awal');
		$tgl_akhir=$this->input->post('tgl_akhir');
    $tipe=$this->input->get('get');
		$data['xtglawal']= $this->input->post('tgl_awal');
		$data['xtglakhir']= $this->input->post('tgl_akhir');

		$query_plant="select * from ms_plant where id_plant='$id_plant'";

		$id_supplier=$this->input->post('id_supplier');
		$jenis_bayar=$this->input->post('jenis_bayar');

		if(!empty($id_supplier))
		{
				$dan1=" AND judul_bpb.id_supplier = '$id_supplier' ";
		}
		else {
			$dan1="";
		}

		if(!empty($jenis_bayar))
		{
				$dan2=" AND judul_bpb.jenis_bayar = '$jenis_bayar' ";
		}
		else {
			$dan2="";
		}



		 //echo ($id_driver.'-'.$id_unit);

		$query_data="SELECT
			judul_bpb.no_bukti,
			judul_bpb.tipe,
			judul_bpb.no_po,
			judul_bpb.tgl_trans,
			judul_bpb.keterangan,
			judul_bpb.id_supplier,
			UPPER(ms_supplier.nama) AS nama_supplier,
			judul_bpb.subtotal,
			judul_bpb.diskon,
			judul_bpb.dpp,
			judul_bpb.ppn,
			judul_bpb.total,
			judul_bpb.jenis_bayar,
			judul_bpb.top,
			judul_bpb.jenis_ppn,
			judul_bpb.no_ref,
			ms_supplier.alamat
		FROM
			judul_bpb
		INNER JOIN ms_supplier ON judul_bpb.id_supplier = ms_supplier.id_supplier
		WHERE
		(judul_bpb.tgl_trans BETWEEN '$tgl_awal' AND '$tgl_akhir') $dan1 $dan2 ORDER BY judul_bpb.tgl_trans ASC";

		$data['data_bpb'] = $this->Bis_model->manualQuery($query_data);

		$query_Q = "SELECT DISTINCT
								judul_bpb.tgl_trans
								FROM
								judul_bpb
								WHERE (judul_bpb.tgl_trans BETWEEN '$tgl_awal' AND '$tgl_akhir')
								ORDER BY judul_bpb.tgl_trans asc";
		//echo $query_Q;
 		$query_Q = $this->db->query($query_Q);
 		$data['dt_unit_x_l1'] = $query_Q->result_array();
		$data['dt_no_bpb'] = $query_Q->result_array();

		//looping ke 2
 		foreach($query_Q->result_array() as $key => $value_1){

		$query_Q_level1 ="SELECT DISTINCT
											judul_bpb.no_bukti
											FROM
											judul_bpb
											WHERE judul_bpb.tgl_trans = '".$value_1['tgl_trans']."'";
		//echo $query_Q_level1;
    $query_Q_level1 = $this->db->query($query_Q_level1);

 		$data['dt_unit_x_l1'][$key]['dt_unit_x_l0'] = $query_Q_level1->result_array();
 		}

		$data['data_plant']= $this->Bis_model->manualQuery($query_plant);
		$data['jabatan'] = $this->Login_m->get_jabatan();
		$data['users'] = $this->Hak_Akses_m->get_user();
		$data['menu'] = $this->Menu_m->get_menu($id);
		$data['submenu'] = $this->Menu_m->get_submenu($id);

		if( $tipe == '1' )
      $this->load->view('report/Cetak_rekap_bpb',$data);
  	 else
   	  $this->load->view('report/Cetak_detail_bpb',$data);


	}

	function foreach_level3($no_bukti){

  $query_data_l1="SELECT
 						 judul_bpb.no_bukti,
 						 judul_bpb.tgl_trans,
 						 judul_bpb.total,
 						 judul_bpb.ppn,
 						 judul_bpb.dpp,
 						 judul_bpb.keterangan,
 						 ms_supplier.nama,
 						 ms_supplier.alamat,
 						 ms_supplier.kontak_person,
 						 detail_bpb.kd_barang,
 						 detail_bpb.hb,
 						 detail_bpb.qty,
 						 detail_bpb.ppn,
 						 detail_bpb.qty*detail_bpb.ppn as totalppn,
 						 detail_bpb.hb * detail_bpb.qty+detail_bpb.qty*detail_bpb.ppn AS total,
 						 ms_barang.nama AS nama_barang_asli,
 						 ms_barang.keterangan,
 						 ms_barang.part_number,
 						 '' as ket1,
 						 '' as ket2,
 						 UPPER(ms_barang.nama) AS nama_barang
 					 FROM
 						 judul_bpb
 					 LEFT JOIN ms_supplier ON judul_bpb.id_supplier = ms_supplier.id_supplier
 					 INNER JOIN detail_bpb ON judul_bpb.no_bukti = detail_bpb.no_bukti
 					 INNER JOIN ms_barang ON detail_bpb.kd_barang = ms_barang.id_barang
 					 WHERE  judul_bpb.no_bukti = '$no_bukti'";
 	 //echo $query_data_l1;
 	 $query_data_l1 = $this->db->query($query_data_l1);
 	 return $query_data_l1->result_array();
  }
}
?>
