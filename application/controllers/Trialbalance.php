<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trialbalance extends CI_Controller{

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
				'title'=>'Trial Balance',
				'xmenu'=>'Akuntansi',
				'xsubmenu'=>'Trial Balance',
				'data_unit'=>$this->Bis_model->manualQuery($query_unit),
				'data_akun'=>$this->Bis_model->manualQuery($query_akun),
				//'data_chart'=> $this->Bis_model->manualQuery($query_chart),
				'users'=>$this->Hak_Akses_m->get_user($id),
				'menu'=>$this->Menu_m->get_menu($id),
				'submenu'=>$this->Menu_m->get_submenu($id),
		);

		$this->load->view('Trialbalancefilter_view',$data);
	}

	function cetak(){
		$id = get_cookie('eKlinik');
	  $kd_unit = $this->input->post('id_unit');
		$tglawal_x = $this->input->post('tgl_awal');
		$tglakhir_x = $this->input->post('tgl_akhir');
		$kd_akun_x = $this->input->post('kd_akun');
		if ($kd_akun_x <> ""){
			$dan = " WHERE tabTB.kd_akun = '$kd_akun_x'";
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
			$dan_group="";
			}
			else {
				$dan_saldo="AND glsaldo.id_plant = '$kd_unit'";
				$dan_gl="AND gltransjalan.id_plant = '$kd_unit'";
				$dan_group=", ms_plant.id_plant";
				// code...
			}
		//looping ke 1
		if ($bln_repx == '01'){
			$query_rsDataLKH = "select tabTB.kd_akun,masterakun.nama as namaakun,
					sum(tabTB.saldoawal) as saldoawal,sum(tabTB.debet) as debet,
					sum(tabTB.kredit) as kredit,
					sum(tabTB.saldoawal)+sum(tabTB.debet)-sum(tabTB.kredit) as saldoakhir
				from (
					SELECT glsaldo.kd_akun, nilai_buku AS saldoawal,
						0 AS debet, 0 AS kredit
					FROM glsaldo
					WHERE
						glsaldo.tahun_buku='$tahun_kemarin' $dan_saldo

					UNION ALL

					select gltransjalan.kd_akun, sum(gltransjalan.jml_d)-sum(gltransjalan.jml_k) as saldoawal,
						0 as debet,0 as kredit
					from gltransjalan
						INNER JOIN ms_plant ON gltransjalan.id_plant = ms_plant.id_plant
					WHERE gltransjalan.tgl_trans between '$awal_tahun' and '$tglawal_x' $dan_gl
					group by gltransjalan.kd_akun$dan_group

					union ALL

					select gltransjalan.kd_akun,0 as saldoawal,
						sum(gltransjalan.jml_d) as debet, sum(gltransjalan.jml_k) as kredit
					from gltransjalan
						INNER JOIN ms_plant ON gltransjalan.id_plant = ms_plant.id_plant
					WHERE (gltransjalan.tgl_trans between '$tglawal_x' and '$tglakhir_x') $dan_gl
					group by gltransjalan.kd_akun$dan_group
				) as tabTB
					INNER JOIN masterakun ON tabTB.kd_akun=masterakun.kd_akun
				$dan
				group by tabTB.kd_akun";
		} else {
			$query_rsDataLKH = "select tabTB.kd_akun,masterakun.nama as namaakun, sum(tabTB.saldoawal) as saldoawal,
					sum(tabTB.debet) as debet,sum(tabTB.kredit) as kredit,
					sum(tabTB.saldoawal)+sum(tabTB.debet)-sum(tabTB.kredit) as saldoakhir
				from (
					SELECT glsaldo.kd_akun, nilai_buku AS saldoawal,
						0 AS debet, 0 AS kredit
					FROM glsaldo
					WHERE glsaldo.tahun_buku='$tahun_kemarin' $dan_saldo

					UNION ALL

					select gltransjalan.kd_akun, sum(gltransjalan.jml_d)-sum(gltransjalan.jml_k) as saldoawal,
						0 as debet,0 as kredit
					from gltransjalan
						INNER JOIN ms_plant ON gltransjalan.id_plant= ms_plant.id_plant
					WHERE gltransjalan.tgl_trans >= '$awal_tahun' and
						gltransjalan.tgl_trans<'$tglawal_x' $dan_gl
					group by gltransjalan.kd_akun$dan_group

					UNION ALL

					select gltransjalan.kd_akun,0 as saldoawal,
						sum(gltransjalan.jml_d) as debet,sum(gltransjalan.jml_k) as kredit
					from gltransjalan
						INNER JOIN ms_plant ON gltransjalan.id_plant = ms_plant.id_plant
					WHERE (gltransjalan.tgl_trans between '$tglawal_x' and '$tglakhir_x') $dan_gl
					group by gltransjalan.kd_akun$dan_group
				   ) as tabTB
					LEFT JOIN masterakun ON tabTB.kd_akun=masterakun.kd_akun
				$dan
				group by tabTB.kd_akun";
		}
    $data['dt_unit_x_l1'] = $this->bis_model->manualQuery($query_rsDataLKH);
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
		$data['title'] = "TRIAL BALANCE";
		$this->load->view('report/Cetaktrialbalance',$data);
	}

	function get_lop_tahun_buku($tahun_simpan, $kd_unit_simpan){
		$q_cari_buku = "SELECT * FROM glsaldo
			WHERE tahun_buku = '$tahun_simpan'
				and id_plant = '$kd_unit_simpan'";
		$q_cari_buku = $this->db->query($q_cari_buku)->num_rows();
		return $q_cari_buku;
	}

	function get_nama_plant($kd_unit_pilih){
		$q_cari_unit = "SELECT nama FROM ms_plant
			WHERE id_plant = '$kd_unit_pilih'";
		$mq_cari_unit = $this->bis_model->manualQuery($q_cari_unit);
	   	foreach ($mq_cari_unit as $fq_cari_unit){
			$tampil_data = $fq_cari_unit->nama;
		}
		return $tampil_data;
	}
}
?>
