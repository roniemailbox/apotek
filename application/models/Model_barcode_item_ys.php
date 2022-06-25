<?php
Class Model_barcode_item extends CI_Model {
	function __construct(){
		parent::__construct();

	}
	function scanbarcode1($barcode){
		$scanbarcode1="<option value=''>-- Pilih --</pilih>";
		$this->db->order_by('nama','ASC');
		$dept= $this->db->get_where('ms_barang',array('barcode'=>$barcode));
		foreach ($dept->result_array() as $data ){
				$scanbarcode1.= "<option value='$data[id_barang]'>$data[nama]</option>";
		}
		return $scanbarcode1;
	}

  function  scanbarcode($barcode){
   		$query_Q="SELECT
                ms_barang.id_barang,
                ms_barang.nama,
                ms_barang.barcode,
                detail_ms_barang.hj AS hb,
                ms_barang.ppn,
                detail_ms_barang.kd_sub_unit,
                ms_barang.satuan,
                ms_barang.status_aktif,
                CONCAT(
                  UPPER( ms_barang.nama ),
                  ' - ',
                  ms_barang.id_barang,
                  ' - ',
                  IFNULL( ms_barang.barcode, ' No Barcode' ),
                  ' - ',
                  ms_barang.satuan
                ) AS ket
              FROM
                detail_ms_barang
                INNER JOIN ms_barang ON detail_ms_barang.kd_barang = ms_barang.id_barang
              WHERE ms_barang.barcode = '$barcode' ";
    $hasil_query = $this->db->query($query_Q);

    foreach($hasil_query->result_array() as $data){
		 /*$scanbarcode.= "<option value='$data[id_barang]'>$data[nama]</option>";*/
      $scanbarcode = $data['id_barang']."^".$data['nama']."^".$data['hb']."^".$data['satuan'];
			//$departement.="<input name='kode_barang' type='text' id='kode_barang' value='$data[nama]' >";
    }

	  return $scanbarcode;

  }

}
