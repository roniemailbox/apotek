<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sirekap extends CI_Controller{
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

		$id = get_cookie('eklinik');

		$kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
		$ses_id_jenis=$this->session->userdata('id_jenis'.$id);
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
												mastersubunit.kd_sub_unit ASC";
		//echo $query_sub_unit;
		$data=array(
				'title'=>'Rekap Penjualan',
				'xmenu'=>'Laporan',
				'xsubmenu'=>'Rekap Penjualan',
				'data_unit'=>$this->Bis_model->manualQuery($query_sub_unit),
				'users'=>$this->Hak_Akses_m->get_user(),
				'menu'=>$this->Menu_m->get_menu($id),
				'submenu'=>$this->Menu_m->get_submenu($id),
		);

		$this->load->view('Si_report',$data);
	}
	function cetak_rekap()
			{
				$id['no_bukti'] = $this->uri->segment(3);
				$no_bukti=$this->uri->segment(3);
				$id = get_cookie('eklinik');
				$tgl_awal=$this->input->post('tgl_awal');
				$tgl_akhir=$this->input->post('tgl_akhir');
				$kd_sub_unit=$this->input->post('kd_sub_unit');
			  $query_unit="select * from mastersubunit where kd_sub_unit='$kd_sub_unit'";
				$query_data="SELECT
											judul_si.no_bukti,
											judul_si.tgl_trans,
											judul_si.id_customer as npa,
											judul_si.nama_customer,
											judul_si.jenis_bayar,
											judul_si.jenis_ppn,
											judul_si.diskon,
											judul_si.dpp,
											judul_si.ppn,
											judul_si.total,
											judul_si.grandtotal,
											judul_si.subtotal,
											judul_si.voucher,
											judul_si.jml_cicilan,
											judul_si.entry_user,
											judul_si.entry_date,
											a.nama AS nama_pegawai,
											judul_si.kd_sub_unit_anggota,
											judul_si.kd_sub_unit,
											c.kd_unit,
											re.nama_unit AS nama_unit_transaksi,
											re.kd_unit AS kd_unit_transaksi
											FROM
											judul_si
											LEFT JOIN armaster ON judul_si.id_customer = armaster.npa
											LEFT JOIN mastersubunit AS c ON judul_si.kd_sub_unit_anggota = c.kd_sub_unit
											LEFT JOIN `user` ON judul_si.entry_user = `user`.id_user
											LEFT JOIN ms_pegawai AS a ON `user`.id_pegawai = a.id_pegawai
											LEFT JOIN mastersubunit AS cd ON judul_si.kd_sub_unit = cd.kd_sub_unit
											LEFT JOIN masterunit AS re ON cd.kd_unit = re.kd_unit
											WHERE
											(judul_si.tgl_trans between '$tgl_awal' and '$tgl_akhir') AND
											cd.kd_sub_unit = '$kd_sub_unit'";
					  //echo $query_data;
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
						'data_si'=>$this->Bis_model->manualQuery($query_data),
					  'data_sub_unit'=>$this->Bis_model->manualQuery($query_unit),
						'detail_si' => $this->Bis_model->manualQuery($q_detail),
						'users'=>$this->Hak_Akses_m->get_user(),
						'menu'=>$this->Menu_m->get_menu($id),
						'submenu'=>$this->Menu_m->get_submenu($id),
				);

				$this->load->view('report/Cetak_rekap_si',$data);
			}

	function cetak()
	{
		$id = get_cookie('eklinik');


		$tgl_awal=$this->input->post('tgl_awal');
		$tgl_akhir=$this->input->post('tgl_akhir');
		$tipe=$this->input->get('get');
		$id_customer=$this->input->post('id_customer');
		$jenis_bayar=$this->input->post('jenis_bayar');

		$data['xtglawal']= $this->input->post('tgl_awal');
		$data['xtglakhir']= $this->input->post('tgl_akhir');

		if(!empty($id_customer))
		{
				$dan1=" AND judul_si.id_customer = '$id_customer' ";
		}
		else {
			$dan1="";
		}

		if(!empty($jenis_bayar))
		{
				$dan2=" AND judul_si.jenis_bayar = '$jenis_bayar' ";
		}
		else {
			$dan2="";
		}

		$query_data="SELECT
									judul_si.no_bukti,
									judul_si.tgl_trans,
									judul_si.id_customer,
									judul_si.jenis_bayar,
									judul_si.jenis_ppn,
									judul_si.no_ref,
									judul_si.subtotal,
									judul_si.diskon,
									judul_si.dpp,
									judul_si.ppn,
									judul_si.total,
									judul_si.nama_customer,
									judul_si.kd_sub_unit,
									judul_si.no_po,
									judul_si.grandtotal,
									judul_si.keterangan
								FROM
									judul_si
									LEFT JOIN ms_customer ON judul_si.id_customer = ms_customer.id_customer
								WHERE
									( judul_si.tgl_trans BETWEEN '$tgl_awal' AND '$tgl_akhir' ) $dan1$dan2
								ORDER BY
									judul_si.tgl_trans ASC ";

		$data['data_si'] = $this->Bis_model->manualQuery($query_data);

		$query_Q = "SELECT DISTINCT
								judul_si.tgl_trans
								FROM
								judul_si
								WHERE (judul_si.tgl_trans BETWEEN '$tgl_awal' AND '$tgl_akhir')
								ORDER BY judul_si.tgl_trans asc";

 		$hasil_query = $this->db->query($query_Q);
 		$data['dt_unit_x_l1'] = $hasil_query->result_array();
		$data['dt_no_si'] = $hasil_query->result_array();

 		foreach($hasil_query->result_array() as $key => $value_1)
		{
		$query_Q_level1 ="SELECT DISTINCT
											judul_si.no_bukti
											FROM
											judul_si
											WHERE judul_si.tgl_trans = '".$value_1['tgl_trans']."'";

    $query_Q_level1 = $this->db->query($query_Q_level1);
 		$data['dt_unit_x_l1'][$key]['dt_unit_x_l0'] = $query_Q_level1->result_array();
 		}



		$data['users'] = $this->Hak_Akses_m->get_user($id);
		$data['menu'] = $this->Menu_m->get_menu($id);
		$data['submenu'] = $this->Menu_m->get_submenu($id);

		if( $tipe == '1' )
      $this->load->view('report/Cetak_rekap_si',$data);
  	 else
   	  $this->load->view('report/Cetak_detail_si',$data);


	}

	function foreach_level3($no_bukti){

	$query_data_l1="SELECT
									judul_si.no_bukti,
									judul_si.tgl_trans,
									judul_si.ppn,
									detail_si.kd_barang,
									detail_si.hj,
									detail_si.qty,
									detail_si.nilaippn,
									detail_si.dpp,
									detail_si.nama_barang,
									detail_si.diskon,
									detail_si.perc_diskon,
									detail_si.total,
									detail_si.satuan,
									judul_si.keterangan
								FROM
									judul_si
									LEFT JOIN ms_customer ON judul_si.id_customer = ms_customer.id_customer
									INNER JOIN detail_si ON judul_si.no_bukti = detail_si.no_bukti
									INNER JOIN ms_barang ON detail_si.kd_barang = ms_barang.id_barang
						WHERE  judul_si.no_bukti = '$no_bukti'";
		//echo $query_data_l1;
		$query_data_l1 = $this->db->query($query_data_l1);
		return $query_data_l1->result_array();
	}

}
?>
