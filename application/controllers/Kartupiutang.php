<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kartupiutang extends CI_Controller{

	public $CI = NULL;

	function __construct(){
        parent::__construct();
		$this->load->helper('currency_format_helper');

		$this->CI = & get_instance();

		$this->load->helper(array('url'));
		$this->load->model('umum/Bis_model');
		$this->load->model('umum/Bis_model_ant');
		 $this->load->helper('format_tanggal_helper');
    }

	function index(){
		$id = get_cookie('eklinik');
		$this->load->model('Menu_m');
		$this->load->model('Hak_Akses_m');
		$this->load->model('Login_m');
		$data['menu'] = $this->Menu_m->get_menu($id);
		$data['submenu'] = $this->Menu_m->get_submenu($id);
		//$data['combo_plant']=$this->Bis_model_ant->get_combo_plant();
		$data['combo_bank']=$this->Bis_model_ant->get_combo_bank();
		//$query_plant="SELECT * from ms_plant where production='1'";
    //$data['combo_plant'] = $this->Bis_model->manualQuery($query_plant);
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

    //$data['data_chart'] = $this->Bis_model->manualQuery($query_chart);
		$query_data="SELECT
				ar_trans.id_customer,
				ms_customer.nama,
				Sum(ar_trans.jml_trans) AS jml_trans
				FROM
							ar_trans
							INNER JOIN ms_customer ON ar_trans.id_customer = ms_customer.id_customer
				GROUP BY
				ar_trans.id_customer
				";

  //echo $query_customer;


		$data['data_piutang'] = $this->Bis_model->manualQuery($query_data);
		$this->load->view('Kartupiutang_view',$data);
	}
	function preview()
	{
		$id_customer=$this->uri->segment(3);
		if ($id_customer==""){
					$id_customer=$this->input->post('id_customer');
		}

		$id = get_cookie('eklinik');
		$this->load->model('Menu_m');
		$this->load->model('Hak_Akses_m');
		$this->load->model('Login_m');
		$id_plant=$this->input->post('id_plant');
		$tgl_awal=$this->input->post('tgl_awal');
		$tgl_akhir=$this->input->post('tgl_akhir');
		$query_customer="select * from ms_customer where id_customer='$id_customer'";
		$query_data="SELECT
            ar_trans.no_bukti,
            ar_trans.no_kb,
            ar_trans.id_customer,
            ar_trans.tgl_trans,
            ar_trans.tgl_j_tmp,
            ar_trans.jml_trans,
            ar_trans.remark,
            ms_customer.nama
            FROM
            ar_trans
            INNER JOIN ms_customer ON ar_trans.id_customer = ms_customer.id_customer
            WHERE
            ar_trans.id_customer = '$id_customer'
            ORDER BY
            ar_trans.no_bukti ASC";

  //echo $query_customer;


		$data['data_piutang'] = $this->Bis_model->manualQuery($query_data);
		$data['data_customer']= $this->Bis_model->manualQuery($query_customer);
		$data['jabatan'] = $this->Login_m->get_jabatan();
		$data['users'] = $this->Hak_Akses_m->get_user();
		$data['menu'] = $this->Menu_m->get_menu($id);
		$data['submenu'] = $this->Menu_m->get_submenu($id);
		$this->load->view('Kartupiutangshow_view',$data);
	}

	function tampil_datax(){
		$id = get_cookie('eklinik');
		$this->load->model('Menu_m');
		$this->load->model('Hak_Akses_m');
		$this->load->model('Login_m');

		$data['menu'] = $this->Menu_m->get_menu($id);
		$data['submenu'] = $this->Menu_m->get_submenu($id);

		$kd_unit = $this->input->post('id_plant');
		$tglawal_x = $this->input->post('tglawal');
		$tglakhir_x = $this->input->post('tglakhir');
		$kd_akun_x = $this->input->post('kd_bank');

		$tahun_rep = substr($tglawal_x,0,4);
		$bln_repx = substr($tglawal_x,5,2);
		$awal_tahun = $tahun_rep."-01-01";
		$tahun_kemarin = $tahun_rep-1;

		if ($kd_akun_x <> "pilih"){
			$dan = " AND gltransjalan.kd_akun = '$kd_akun_x'";
			$dan_x = " AND glsaldo.kd_akun = '$kd_akun_x'";
		} else {
			$dan = "";
			$dan_x = "";
		}

		$query_saldoLKH = "SELECT defTab.kd_akun,SUM(defTab.saldo) AS SALDO
			FROM (
				SELECT gltransjalan.kd_akun AS kd_akun, SUM(jml_d)-SUM(jml_k) AS SALDO
				FROM gltransjalan
					INNER JOIN ms_plant ON gltransjalan.kd_sub_unit = ms_plant.id_plant
				WHERE ms_plant.id_plant = '$kd_unit'
					AND gltransjalan.tgl_trans < '$tglawal_x'
					$dan
				GROUP BY gltransjalan.kd_akun

				UNION

				SELECT glsaldo.kd_akun AS kd_akun, nilai_buku AS SALDO
				FROM glsaldo
				WHERE glsaldo.`kd_unit`='$kd_unit'
					AND glsaldo.`tahun_buku`='$tahun_kemarin'
					$dan_x
			) AS defTab
			GROUP BY defTab.kd_akun";

		$query_saldoLKH = $this->db->query($query_saldoLKH);
		$data['dt_saldo_xx'] = $query_saldoLKH->result_array();

		$query_Q = "select gltransjalan.*
			FROM gltransjalan
				INNER JOIN ms_plant ON gltransjalan.kd_sub_unit = ms_plant.id_plant
			WHERE ms_plant.id_plant = '$kd_unit'
				and (gltransjalan.tgl_trans between '$tglawal_x' and '$tglakhir_x')
				$dan
			order by gltransjalan.tgl_trans asc, gltransjalan.no_bukti asc";

		$query_Q = $this->db->query($query_Q);
		$data['dt_unit_x_l1'] = $query_Q->result_array();

		$data['combo_plant'] = $this->Bis_model_ant->get_combo_plant();
		$data['combo_bank'] = $this->Bis_model_ant->get_combo_bank();

		$this->load->view('Lkasharian_v',$data);
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
