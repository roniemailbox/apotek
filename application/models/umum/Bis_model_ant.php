<?php
class Bis_model_ant extends CI_Model{
	public function __construct(){
		parent::__construct();

		$this->load->helper(array('url'));
		$this->load->model('umum/bis_model');
		$this->load->model('umum/bis_model_ant');
	}

	//combo box unit
	function get_combo_plant(){
		$this->db->order_by('id_plant','ASC');
		$get_plant= $this->db->get('ms_plant');
		return $get_plant->result_array();
	}

	//combo box unit
	function get_combo_bank(){
		$query_bank= "SELECT kd_bank, nama_bank, kd_akun
			FROM ms_bank_copy
			order by nama_bank asc";
		$query_Q = $this->db->query($query_bank);
		return $query_Q->result_array();
	}
	function get_combo_bank2(){
		$query_bank= "SELECT
ms_bank.id_bank,
ms_bank.nama AS nama_bank,
masterakun.kd_akun,
masterakun.nama
FROM
ms_bank
INNER JOIN masterakun ON ms_bank.kd_akun = masterakun.kd_akun";
		$query_Q = $this->db->query($query_bank);
		return $query_Q->result_array();
	}

	//menu autocomplete
	public function search(){
		// tangkap variabel keyword dari URL
		$keyword = $this->uri->segment(3);
		//$keyword = escape_str($keyword);

		// cari di database
		//$data = $this->db->from('masterakun')->like('nama', $keyword)->get();

		$q_cari_unit = 'SELECT kd_akun, nama as nama_akun
			from masterakun
			where nama like "%'. $keyword .'%"
				or kd_akun like "%'. $keyword .'%"
			order by nama asc
			LIMIT 10';
		$data = $this->db->query($q_cari_unit);
		// format keluaran di dalam array
		foreach($data->result() as $row){
			//$arr['query'] = $keyword;
			$nama_x = ucwords(strtolower($row->nama_akun));
			$arr['suggestions'][] = array(
				'value'			=>$row->kd_akun.' - '.$nama_x,
				'nama'			=>$nama_x,
				'kd_akun'		=>$row->kd_akun
			);
		}
		echo json_encode($arr);
	}
}
