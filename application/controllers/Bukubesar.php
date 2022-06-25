<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bukubesar extends CI_Controller{

	public $CI = NULL;

	function __construct(){
        parent::__construct();
				$this->load->helper('currency_format_helper');
				$this->load->helper('get_month');
				$this->CI = & get_instance();
				$this->load->helper(array('url'));
				$this->load->model('umum/Bis_model');
				$this->load->model('umum/Bis_model_ant');
				$this->load->model('Menu_m');
				$this->load->model('Hak_Akses_m');
				$this->load->model('Login_m');
		    $this->load->helper('format_tanggal_helper');
				$this->load->helper('tgl_indo_helper');
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


		$query_unit="select * from masterunit";
		$query_akun="select * from masterakun";
		$data=array(
				'title'=>'Buku Besar (General Ledger)',
				'xmenu'=>'Akuntansi',
				'xsubmenu'=>'Buku Besar',
				'data_unit'=>$this->Bis_model->manualQuery($query_unit),
				'data_akun'=>$this->Bis_model->manualQuery($query_akun),
				//'data_chart'=> $this->Bis_model->manualQuery($query_chart),
				'users'=>$this->Hak_Akses_m->get_user($id),
				'menu'=>$this->Menu_m->get_menu($id),
				'submenu'=>$this->Menu_m->get_submenu($id),
		);

		$this->load->view('Bukubesarfilter_view',$data);
	}

	function cetak()
	{
		$id = get_cookie('eKlinik');
		//include('get_month.php');

		$tgl_awal=$this->input->post('tgl_awal');
		$tgl_akhir=$this->input->post('tgl_akhir');
    $tipe=$this->input->get('get');

		$tglawal_x = $this->input->post('tgl_awal');
		$tglakhir_x = $this->input->post('tgl_akhir');
		$kd_akun_x = $this->input->post('kd_akun');
		$bln_rep = substr($tglawal_x,5,2);
		$tahun_rep= substr($tglawal_x,0,4);

		$kd_akun=$this->input->post('kd_akun');
		$id_unit=$this->input->post('id_unit');
		if (!empty($kd_akun)){
					 $dan="and gltransjalan.kd_akun='$kd_akun'";
				 }
				 else {

					 $dan="";
				 }
    if (!empty($id_unit)){
		 		 $dan_unit="and gltransjalan.id_plant='$id_unit'";
		}
		else {
				 $dan_unit="";
		}
		$query_Q="SELECT DISTINCT
								gltransjalan.kd_akun,
								masterakun.nama
							FROM
								gltransjalan
								INNER JOIN masterakun ON gltransjalan.kd_akun = masterakun.kd_akun
							WHERE
								( gltransjalan.tgl_trans BETWEEN '$tgl_awal' AND '$tgl_akhir' ) $dan_unit $dan";

 		$query_Q = $this->db->query($query_Q);
 		$data['dt_unit_x_l1'] = $query_Q->result_array();
	 	foreach($query_Q->result_array() as $key => $value_1){
			$query_Q_level1 = "SELECT gltransjalan.*
					FROM gltransjalan
						INNER JOIN ms_plant ON gltransjalan.id_plant = ms_plant.id_plant
					WHERE gltransjalan.kd_akun = '".$value_1['kd_akun']."'
						and gltransjalan.tgl_trans between '$tglawal_x' and '$tglakhir_x'
					order by gltransjalan.tgl_trans asc,gltransjalan.no_bukti asc";
	 		$query_Q_level1 = $this->db->query($query_Q_level1);
			$data['dt_unit_x_l1'][$key]['dt_unit_x_l0'] = $query_Q_level1->result_array();
		}

		$tgl_rep = substr($tglawal_x,8,2);
		$bln_rep = substr($tglawal_x,5,2);
		$bln_repx = substr($tglawal_x,5,2);
		$tahun_rep = substr($tglawal_x,0,4);
		$bln_rep = bulan($bln_rep);
		$tgl_rep2 = substr($tglakhir_x,8,2);
		$bln_rep2 = substr($tglakhir_x,5,2);
		$tahun_rep2 = substr($tglakhir_x,0,4);
		$bln_rep2 = bulan($bln_rep2);
		$awal_tahun = $tahun_rep."-01-01";
		$tahun_kemarin = $tahun_rep-1;
		$data['tgl_rep'] = substr($tglawal_x,8,2);
		$data['bln_rep'] = substr($tglawal_x,5,2);
		$data['bln_repx'] = substr($tglawal_x,5,2);
		$data['tahun_rep'] = substr($tglawal_x,0,4);
		$data['bln_rep'] = bulan($bln_rep);
		$data['tgl_rep2'] = substr($tglakhir_x,8,2);
		$data['bln_rep2'] = substr($tglakhir_x,5,2);
		$data['tahun_rep2'] = substr($tglakhir_x,0,4);
		$data['bln_rep2'] = bulan($bln_rep2);
		$data['xtglawal']= $this->input->post('tgl_awal');
		$data['xtglakhir']= $this->input->post('tgl_akhir');
		$data['tglawal']= $this->input->post('tgl_awal');
		$data['tglakhir']= $this->input->post('tgl_akhir');
		$data['awal_tahun'] = $tahun_rep."-01-01";
		$data['tahun_kemarin'] = $tahun_rep-1;
		$data['users'] = $this->Hak_Akses_m->get_user();
		$data['menu'] = $this->Menu_m->get_menu($id);
		$data['submenu'] = $this->Menu_m->get_submenu($id);
		$data['title'] = "BUKU BESAR ( GENERAL LEDGER )";

	  $this->load->view('report/Cetakbukubesar',$data);


	}

	function get_saldoAkun($awal_tahun, $tglawal, $bln_repx, $kd_akun_x, $tahun_kemarin){
		if ($bln_repx=='01')
		{
			$query_saldoAkun = "SELECT defTab.kd_akun,IFNULL(SUM(defTab.saldo),0) AS SALDO
				FROM (
					SELECT gltransjalan.kd_akun AS kd_akun, SUM(jml_d)-SUM(jml_k) AS SALDO
					FROM gltransjalan

					WHERE  gltransjalan.tgl_trans >= '$awal_tahun' and tgl_trans<'$tglawal'
						AND gltransjalan.kd_akun = '$kd_akun_x'
					GROUP BY gltransjalan.kd_akun

					UNION ALL

					SELECT glsaldo.kd_akun AS kd_akun, nilai_buku AS SALDO
					FROM glsaldo
					WHERE glsaldo.tahun_buku='$tahun_kemarin'
						AND glsaldo.kd_akun = '$kd_akun_x'
				) AS defTab
				GROUP BY defTab.kd_akun";
		}
		else
		{
			$query_saldoAkun="SELECT defTab.kd_akun,IFNULL(SUM(defTab.saldo),0) AS SALDO
				FROM (
					SELECT gltransjalan.kd_akun AS kd_akun, SUM(jml_d)-SUM(jml_k) AS SALDO
					FROM gltransjalan

					WHERE  (gltransjalan.tgl_trans between '$awal_tahun' and '$tglawal')
						AND gltransjalan.kd_akun = '$kd_akun_x'
					GROUP BY gltransjalan.kd_akun

					UNION ALL

					SELECT glsaldo.kd_akun AS kd_akun, nilai_buku AS SALDO
					FROM glsaldo
					WHERE glsaldo.tahun_buku='$tahun_kemarin'
						AND glsaldo.kd_akun = '$kd_akun_x'
				) AS defTab
				GROUP BY defTab.kd_akun";
		}
		$mq_query_saldoAkun = $this->Bis_model->manualQuery($query_saldoAkun);
    foreach ($mq_query_saldoAkun as $fq_query_saldoAkun){
				 $tampil_data_saldoAkun = $fq_query_saldoAkun->SALDO;
		}
   	return $tampil_data_saldoAkun;
	}
}
?>
