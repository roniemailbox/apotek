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

  function scanbarcode($barcode){
   		$id = get_cookie('eklinik');
      $ses_kd_unit=$this->session->userdata('kd_unit'.$id);
      $ses_kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);

      /*$keyword = $this->uri->segment(3);*/
      /*$keyword = str_replace('%20',' ',$keyword);*/

            $q_cari_unit="SELECT
                            ms_barang.id_barang,
                            ms_barang.nama,
                            ms_barang.barcode,
                            detail_ms_barang.hb AS hb,
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
                              IFNULL( ms_barang.satuan, ' No Satuan' ),
                              ' - ',
                              IFNULL( xx.qty_akhir, ' KOSONG ' )
                            ) AS ket
                          FROM
                            ms_barang
                            INNER JOIN detail_ms_barang ON detail_ms_barang.kd_barang = ms_barang.id_barang
                            LEFT JOIN (
                            SELECT
                              defTab.kd_barang,
                              sum( defTab.qty ) AS qty_akhir
                            FROM
                              (
                              SELECT
                                in_trans.no_bukti,
                                in_trans.tgl_trans,
                                in_trans.kd_barang,
                                in_trans.harga,
                                in_trans.qty,
                                in_trans.harga * in_trans.qty AS total,
                                '' AS keterangan
                              FROM
                                in_trans
                                INNER JOIN mastersubunit ON in_trans.kd_sub_unit = mastersubunit.kd_sub_unit
                                INNER JOIN masterunit ON mastersubunit.kd_unit = masterunit.kd_unit
                              WHERE
                                mastersubunit.kd_sub_unit =$ses_kd_sub_unit UNION ALL
                              SELECT
                                'SA' AS no_bukti,
                                saldoawalstok.tgl_trans,
                                saldoawalstok.kd_barang,
                                saldoawalstok.hpp AS harga,
                                saldoawalstok.qty,
                                saldoawalstok.qty * saldoawalstok.hpp AS total,
                                'Saldo Awal' AS keterangan
                              FROM
                                saldoawalstok
                                INNER JOIN mastersubunit ON saldoawalstok.kd_sub_unit = mastersubunit.kd_sub_unit
                              WHERE
                                mastersubunit.kd_sub_unit = $ses_kd_sub_unit
                              ) AS defTab
                              INNER JOIN ms_barang ON defTab.kd_barang = ms_barang.id_barang
                            GROUP BY
                              defTab.kd_barang
                            ) AS xx ON xx.kd_barang = ms_barang.id_barang
                          WHERE
                            detail_ms_barang.kd_sub_unit = $ses_kd_sub_unit
                            AND ( ms_barang.barcode = '$barcode' )
                            AND xx.qty_akhir > 0
                          ORDER BY
                            ms_barang.nama ASC";

                            //
      $numrows_unit = $this->db->query($q_cari_unit)->num_rows();
      if($numrows_unit >= 1){
        $data = $this->db->query($q_cari_unit);
          foreach($data->result() as $row){
          $itemppn=$row->ppn;
          $hb=$row->hb;

          if ($itemppn=="PPN"){
              $dpp=$hb/1.1;
              $dpp=round($dpp,2);
              $nilaippn=$hb-$dpp;
              $nilaippn=round($nilaippn,2);
              //$dpp=0;
              //$dpp=0;
              //$nilaippn=0;
              //$nilaippn=0;
          }
          else {
            $nilaippn=0;
            $dpp=0;
          }

          $nama_x = $row->ket;
          $data = array(
            'value'       =>$nama_x,
            'nama_barang' =>$row->nama,
            'id_barang'   =>$row->id_barang,
            /*'hb'          =>$row->hb,*/
            'hb'          =>number_format($row->hb,0,",","."),
            'dpp'         =>$dpp,
            'satuan'      =>$row->satuan,
            'ppn'         =>$row->ppn,
            'nilaippn'    =>$nilaippn
          );

          $scanbarcode = $data['value']."^".$data['nama_barang']."^".$data['id_barang']."^".$data['hb']."^".$data['dpp']."^".$data['satuan']."^".$data['ppn']."^".$data['nilaippn'];
        }
      } else {
        $bukti_x = "Data Tidak Ditemukan";
        $kosong = '';
        $data = array(
          'value'     =>$bukti_x,
          'nama_barang' =>$kosong,
          'id_barang'   =>$kosong,
          'hb'          =>$kosong,
          'dpp'         =>$kosong,
          'satuan'      =>$kosong,
          'ppn'         =>$kosong,
          'nilaippn'    =>$kosong
        );

        $scanbarcode = $data['value']."^".$data['nama_barang']."^".$data['id_barang']."^".$data['hb']."^".$data['dpp']."^".$data['satuan']."^".$data['ppn']."^".$data['nilaippn'];
      }

    return $scanbarcode;

  }

}
