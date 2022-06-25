<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bb_2 extends CI_Controller{

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
    }

	function index(){
		$id = get_cookie('xau');


		$data=array(
				//'perintah'=>'Baru',
				'title'=>'Buku Besar',
				//'data_po'=>$this->Bis_model->manualQuery($query_po),
				//'data_bpb'=>$this->Bis_model->manualQuery($query_data),
				'combo_plant'=>$this->Bis_model_ant->get_combo_plant(),
				'users'=>$this->Hak_Akses_m->get_user(),
				'menu'=>$this->Menu_m->get_menu($id),
				'submenu'=>$this->Menu_m->get_submenu($id),
		);



		$this->load->view('bukubesar_v',$data);
	}

	function tampil_datax(){
		$id = get_cookie('xau');
		$this->load->model('Menu_m');
		$this->load->model('Hak_Akses_m');
		$this->load->model('Login_m');

		$data['menu'] = $this->Menu_m->get_menu($id);
		$data['submenu'] = $this->Menu_m->get_submenu($id);

		$kd_unit = $this->input->post('id_plant');
		$tglawal_x = $this->input->post('tglawal');
		$tglakhir_x = $this->input->post('tglakhir');
		$kd_akun_x = $this->input->post('fil_kd_akun');
		if ($kd_akun_x <> ""){
						$dan = "AND gltransjalan.kd_akun = '$kd_akun_x'";
		} else {
						$dan = "";
		}

		$tahun_rep = substr($tglawal_x,0,4);
		$bln_repx = substr($tglawal_x,5,2);
		$awal_tahun = $tahun_rep."-01-01";
		$tahun_kemarin = $tahun_rep-1;


		if ($kd_unit==''){
			$dan_saldo="";
			$dan_gl="";
			}
			else {
				$dan_saldo="AND glsaldo.id_plant = '$kd_unit'";
				$dan_gl="AND gltransjalan.id_plant = '$kd_unit'";
				// code...
			}
		//looping ke 1
		//$query_Q = "SELECT DISTINCT gltransjalan.kd_akun,masterakun.nama
		//	FROM gltransjalan
		//		INNER JOIN masterakun ON gltransjalan.kd_akun = masterakun.kd_akun
		//		INNER JOIN ms_plant ON gltransjalan.kd_sub_unit = ms_plant.id_plant
		//	WHERE ms_plant.id_plant = '$kd_unit'
		//		$dan
		//	order by gltransjalan.kd_akun ASC";
		$query_Q = "SELECT DISTINCT gltransjalan.kd_akun,masterakun.nama
					FROM
					gltransjalan
					INNER JOIN masterakun ON gltransjalan.kd_akun = masterakun.kd_akun
					INNER JOIN ms_plant ON gltransjalan.id_plant = ms_plant.id_plant
					WHERE gltransjalan.tgl_trans<>'' $dan_gl
					$dan
					order by gltransjalan.kd_akun ASC";
		$query_Q = $this->db->query($query_Q);
		$data['dt_unit_x_l1'] = $query_Q->result_array();

		//looping ke 2
		foreach($query_Q->result_array() as $key => $value_1){
			$query_Q_level1 = "SELECT gltransjalan.*
					FROM gltransjalan
						INNER JOIN ms_plant ON gltransjalan.id_plant = ms_plant.id_plant
					WHERE gltransjalan.kd_akun = '".$value_1['kd_akun']."'
						and gltransjalan.tgl_trans between '$tglawal_x' and '$tglakhir_x'
					order by gltransjalan.tgl_trans asc,gltransjalan.no_bukti asc";
			//echo 	$query_Q_level1;
			//echo "<br>";
			//echo "<br>";
			$query_Q_level1 = $this->db->query($query_Q_level1);
			$data['dt_unit_x_l1'][$key]['dt_unit_x_l0'] = $query_Q_level1->result_array();
		}

		$data['combo_plant']=$this->Bis_model_ant->get_combo_plant();
		//$data['data_plant'] = $this->Bis_model->getAllData('ms_plant');
		$this->load->view('bukubesar_v',$data);
	}

	function get_saldoAkun($kd_unit, $awal_tahun, $tglawal, $bln_repx, $kd_akun_x, $tahun_kemarin){
		if ($bln_repx=='01'){


			$query_saldoAkun = "SELECT defTab.kd_akun,SUM(defTab.saldo) AS SALDO
				FROM (
					SELECT gltransjalan.kd_akun AS kd_akun, SUM(jml_d)-SUM(jml_k) AS SALDO
					FROM gltransjalan
						INNER JOIN ms_plant ON gltransjalan.id_plant = ms_plant.id_plant
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
		}  else {
			$query_saldoAkun="SELECT defTab.kd_akun,SUM(defTab.saldo) AS SALDO
				FROM (
					SELECT gltransjalan.kd_akun AS kd_akun, SUM(jml_d)-SUM(jml_k) AS SALDO
					FROM gltransjalan
						INNER JOIN ms_plant ON gltransjalan.id_plant = ms_plant.id_plant
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
	//echo $query_saldoAkun;
	 //echo "<br>";
		$mq_query_saldoAkun = $this->Bis_model->manualQuery($query_saldoAkun);
	   	foreach ($mq_query_saldoAkun as $fq_query_saldoAkun){
			$tampil_data_saldoAkun = $fq_query_saldoAkun->SALDO;
		}
		return $tampil_data_saldoAkun;
	}

	function get_nama_plant($kd_unit_pilih){
		$q_cari_unit = "SELECT nama FROM ms_plant
			WHERE id_plant = '$kd_unit_pilih'";
		$mq_cari_unit = $this->Bis_model->manualQuery($q_cari_unit);
	   	foreach ($mq_cari_unit as $fq_cari_unit){
			$tampil_data = $fq_cari_unit->nama;
		}
		return $tampil_data;
	}
}
?>
