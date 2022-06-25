<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Itempo extends CI_Controller{
	public function __construct(){
		parent::__construct();

		$this->load->helper(array('url'));
		$this->load->model('umum/Bis_model');
		$this->load->model('umum/Bis_model_ant');
	}

	function index(){
		$this->load->view('v_auto_complete');
	}

	public function cari(){

			$keyword = $this->uri->segment(3);
			$keyword = str_replace('%20',' ',$keyword);
			$q_cari_unit = 'SELECT
					ms_barang.id_barang,
					ms_barang.nama,
					ms_barang.barcode,
					ms_barang.harga_beli,
					ms_barang.harga_jual
				FROM
					ms_barang
				where (ms_barang.nama like "%'. $keyword .'%")
				order by ms_barang.nama asc
				LIMIT 10';
			$numrows_unit = $this->db->query($q_cari_unit)->num_rows();
			if($numrows_unit >= 1){
				$data = $this->db->query($q_cari_unit);
				 	foreach($data->result() as $row){
				 	$nama_x = ucwords(strtolower($row->nama));
					$arr['suggestions'][] = array(
						'value'			=>$nama_x,
						'nama_barang'	=>$nama_x,
						'id_barang'		=>$row->id_barang,
						'hb'			=>$row->harga_beli,
						'hj'			=>$row->harga_jual
					);
				}
			} else {
				$bukti_x = 'Tidak Ditemukan';
				$kosong = '';
				$arr['suggestions'][] = array(
					'value'			=>$bukti_x,
					'nama_barang'	=>$kosong,
					'id_barang'		=>$kosong,
					'harga_beli'		=>$kosong,
					'harga_jual'		=>$kosong
				);
			}
			echo json_encode($arr);
		}

}
?>
