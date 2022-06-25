<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurnal extends CI_Controller{

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
				'title'=>'Jurnal',
				'xmenu'=>'Akuntansi',
				'xsubmenu'=>'Jurnal',
				'data_unit'=>$this->Bis_model->manualQuery($query_unit),
				'data_akun'=>$this->Bis_model->manualQuery($query_akun),
				//'data_chart'=> $this->Bis_model->manualQuery($query_chart),
				'users'=>$this->Hak_Akses_m->get_user($id),
				'menu'=>$this->Menu_m->get_menu($id),
				'submenu'=>$this->Menu_m->get_submenu($id),
		);

		$this->load->view('Jurnalfilter_view',$data);
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

		$query_Q="SELECT DISTINCT
								gltransjalan.tgl_trans
							FROM
								gltransjalan
								INNER JOIN mastersubunit ON gltransjalan.kd_sub_unit = mastersubunit.kd_sub_unit
								INNER JOIN masterunit ON mastersubunit.kd_unit = masterunit.kd_unit
							WHERE

									gltransjalan.tgl_trans BETWEEN '$tgl_awal'
									AND '$tgl_akhir'

							ORDER BY
								gltransjalan.tgl_trans ASC";
	 //echo $query_Q;
		$query_Q = $this->db->query($query_Q);
		$data['dt_unit_x_l1'] = $query_Q->result_array();
		//$data['dt_no_bpb'] = $query_Q->result_array();

		//looping ke 2
		foreach($query_Q->result_array() as $key => $value_1){
			$query_Q_level1 = "SELECT DISTINCT
	gltransjalan.no_bukti
FROM
	gltransjalan
	INNER JOIN mastersubunit ON gltransjalan.kd_sub_unit = mastersubunit.kd_sub_unit
	INNER JOIN masterunit ON mastersubunit.kd_unit = masterunit.kd_unit
				WHERE gltransjalan.tgl_trans = '".$value_1['tgl_trans']."'
				ORDER BY gltransjalan.no_bukti asc";
			//echo 	$query_Q_level1;
			//echo "<br>";
			//echo "<br>";
			$query_Q_level1 = $this->db->query($query_Q_level1);
			$data['dt_unit_x_l1'][$key]['dt_unit_x_l0'] = $query_Q_level1->result_array();
		}

		//$data['data_plant']= $this->Bis_model->manualQuery($query_plant);
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
		//$bln_rep2 = substr($tglakhir_x,5,2);
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

		$data['jabatan'] = $this->Login_m->get_jabatan();
		$data['users'] = $this->Hak_Akses_m->get_user();
		$data['menu'] = $this->Menu_m->get_menu($id);
		$data['submenu'] = $this->Menu_m->get_submenu($id);
		$data['title'] = "J U R N A L";

    $this->load->view('report/Cetakjurnal',$data);


	}


	function foreach_level3($no_bukti){
		$query_data_l1 = "SELECT gltransjalan.no_bukti,
				 gltransjalan.kd_akun, masterakun.nama,gltransjalan.tgl_trans,
				 gltransjalan.jml_D, gltransjalan.jml_K,gltransjalan.keterangan
			FROM gltransjalan
				INNER JOIN masterakun ON masterakun.kd_akun = gltransjalan.kd_akun
			WHERE gltransjalan.no_bukti = '$no_bukti'
			ORDER BY gltransjalan.no_bukti desc";
		$query_data_l1 = $this->db->query($query_data_l1);
		//$data['dt_unit_x_l3'] = $query_data_l1->result_array();

		return $query_data_l1->result_array();
	}

}
?>
