<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Autocomplete extends CI_Controller{
	public function __construct(){
		parent::__construct();

		$this->load->helper(array('url'));
		$this->load->model('umum/Bis_model');
		$this->load->model('umum/Bis_model_ant');
	}

	function index(){
		$this->load->view('v_auto_complete');
	}
	public function search_akun(){
		// tangkap variabel keyword dari URL
		$keyword = $this->uri->segment(3);
		//$keyword = escape_str($keyword);

		// cari di database
		//$data = $this->db->from('masterakun')->like('nama', $keyword)->get();
	$keyword = str_replace('%20',' ',$keyword);
		$q_cari_unit = 'SELECT kd_akun, nama as nama_akun
			from masterakun
			where nama like "%'. $keyword .'%"
				or kd_akun like "%'. $keyword .'%"
			order by nama asc
			LIMIT 10';


		$numrows_unit = $this->db->query($q_cari_unit)->num_rows();
		if($numrows_unit >= 1){
			$data = $this->db->query($q_cari_unit);
			// format keluaran di dalam array
			foreach($data->result() as $row){
				//$arr['query'] = $keyword;
				$nama_x = ucwords(strtolower($row->nama_akun));
				$arr['suggestions'][] = array(
					'value'			=>$row->kd_akun.' - '.$nama_x,
					'nama_akun'			=>$nama_x,
					'kd_akun'		=>$row->kd_akun
				);
			}
		} else {
			$bukti_x = 'No Result';
			$kosong = '';
			$arr['suggestions'][] = array(
				'value'			=>$bukti_x,
				'nama'			=>$kosong,
				'kd_akun'		=>$kosong
			);
		}
		echo json_encode($arr);
	}
	public function search_jpen(){
		// tangkap variabel keyword dari URL
		$keyword = $this->uri->segment(3);
		//$keyword = escape_str($keyword);
		$keyword = str_replace('%20',' ',$keyword);
		$kd_sub_unit_login = '1';

		$q_cari_unit = 'SELECT DISTINCT no_bukti
			FROM gltransjalan
			WHERE no_bukti like "%'.$keyword.'%"
			order by tgl_trans desc
			LIMIT 20';

		$numrows_unit = $this->db->query($q_cari_unit)->num_rows();
		if($numrows_unit >= 1){
			$data = $this->db->query($q_cari_unit);
			// format keluaran di dalam array
			foreach($data->result() as $row){
				$pembanding_x = 'ada';
				$arr['suggestions'][] = array(
					'value'			=>$row->no_bukti,
					'pembanding_x'	=>$pembanding_x
				);
			}

		} else {
			$bukti_x = 'No Result';
			$pembanding_x = 'no';
			$arr['suggestions'][] = array(
					'value'			=>$bukti_x,
					'pembanding_x'	=>$pembanding_x
				);
		}
		echo json_encode($arr);
	}
	public function cari_pasien(){
		  $id = get_cookie('eklinik');
			//$ses_kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
			$keyword = $this->uri->segment(3);
			$keyword = str_replace('%20',' ',$keyword);
			$q_cari_warga = "SELECT
												ms_pasien.no_register,
												ms_pasien.ktp,
												ms_pasien.nama,
												ms_pasien.alamat,
												ms_pasien.kotalahir,
												ms_pasien.tgllahir,
												ms_pasien.jk,
												ms_pasien.telepon,
												ms_pasien.email,
												ms_pasien.keterangan,
												IFNULL(ms_pasien.bpjs_kes,'Tidak Ada') as bpjs_kes,
												a.`name` as kota_lahir
											FROM
												ms_pasien
												LEFT JOIN ms_kabupaten AS a ON ms_pasien.kotalahir = a.id
											WHERE
												ms_pasien.nama LIKE '%$keyword%'
												OR ms_pasien.ktp LIKE '%$keyword%'
												OR ms_pasien.no_register LIKE '%$keyword%'
												OR ms_pasien.alamat LIKE '%$keyword%'
											ORDER BY
												ms_pasien.nama ASC";

//echo $q_cari_unit;
			$numrows_warga = $this->db->query($q_cari_warga)->num_rows();
			if($numrows_warga >= 1){
				  $data = $this->db->query($q_cari_warga);
				 	foreach($data->result() as $row){

				 	$nama_x = $row->no_register." | ".$row->nama." | ".$row->bpjs_kes ;
					$arr['suggestions'][] = array(
						'value' =>$nama_x,
						'nama'	=>$row->nama,
						'ktp'		=>$row->ktp,
						'telepon'		=>$row->telepon,
						'no_register' =>$row->no_register,
						'alamat'=>$row->alamat,
					 	'kotalahir'=>$row->kotalahir,
						'kota_lahir'=>$row->kota_lahir,
						'tgllahir'=>$row->tgllahir,
						'keterangan'=>$row->keterangan,
						'bpjs_kes'=>$row->bpjs_kes,
					 	'jk'=>$row->jk

					);
				}
			} else {
				$bukti_x = "Data Tidak Ditemukan";
				$kosong = '';
				$arr['suggestions'][] = array(
					'value'			=>$bukti_x,
					'nama'	=>$kosong,
					'no_register'	=>$kosong,
					'ktp'		=>$kosong,
					'telepon'		=>$kosong,
					'alamat'=>$kosong,
					'kotalahir'=>$kosong,
					'kota_lahir'=>$kosong,
					'tgllahir'=>$kosong,
					'keterangan'=>$kosong,
					'bpjs_kes'=>$kosong,
					'jk'=>$row->$kosong
				);
			}
			echo json_encode($arr);
		}

	public function anggota_aktif(){
			$id = get_cookie('eklinik');
			//$ses_kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
			$keyword = $this->uri->segment(3);
			$keyword = str_replace('%20',' ',$keyword);
			$q_cari = "SELECT
									upper(CONCAT(
									armaster.nama,' - ',
									armaster.npa,' - ',
									armaster.nik,' - ',
									mastersubunit.nama_sub_unit,' - ',
									masterunit.nama_unit)) as ket,
									armaster.npa,
									mastersubunit.nama_sub_unit,
									mastersubunit.kd_sub_unit,
									masterunit.kd_unit,
									masterunit.nama_unit,
									armaster.nik,
									armaster.nama
									FROM
									armaster
									INNER JOIN mastersubunit ON armaster.kd_sub_unit = mastersubunit.kd_sub_unit
									INNER JOIN masterunit ON mastersubunit.kd_unit = masterunit.kd_unit
									WHERE
									armaster.status_anggota='aktif'
									AND (armaster.nama like '%$keyword%' OR armaster.npa like '%$keyword%' OR armaster.nik like '%$keyword%')
						order by armaster.nama asc
						LIMIT 10";

			$numrows = $this->db->query($q_cari)->num_rows();
			if($numrows >= 1){
				$data = $this->db->query($q_cari);
					foreach($data->result() as $rowz){

					$nama_x = ucwords(strtolower($rowz->ket));
					$arr['suggestions'][] = array(
						'value'	=>$nama_x,
						'npa'	=>$rowz->npa,
						'nik'	=>$rowz->nik,
						'nama'		=>$rowz->ket,
						'nama_unit'		=>$rowz->nama_unit,
						'kd_sub_unit'		=>$rowz->kd_sub_unit,
						'nama_sub_unit'		=>$rowz->nama_sub_unit
					);
				}
			} else {
				$nama_x = "Data Tidak Ditemukan";
				$kosong = '';
				$arr['suggestions'][] = array(
					'value'			=>$nama_x,
					'nama'	=>$kosong,
					'npa'		=>$kosong,
					'nik'	      	=>$kosong,
					'nama_unit'		      =>$kosong,
					'kd_sub_unit'		=>$kosong,
					'nama_sub_unit'		      =>$kosong
				);
			}
			echo json_encode($arr);
		}
	public function supplier_aktif(){
			$id = get_cookie('eklinik');
			//$ses_kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
			$keyword = $this->uri->segment(3);
			$keyword = str_replace('%20',' ',$keyword);
			$q_cari = "SELECT
						CONCAT(upper(ms_supplier.id_supplier),' - ',upper(ms_supplier.nama)) AS ket,
						ms_supplier.id_supplier,
						ms_supplier.id_kota,
						upper(ms_supplier.nama) as nama,
						ms_supplier.alamat,
						ifnull(ms_supplier.top,0) as top,
						ms_supplier.telepon,
						ms_supplier.hp,
						ms_supplier.fax,
						ms_supplier.email,
						ms_kabupaten.id,
						ms_kabupaten.`name` AS nama_kabupaten
						FROM
						ms_supplier
						INNER JOIN ms_kabupaten ON ms_supplier.id_kota = ms_kabupaten.id
						WHERE ms_supplier.nama like '%$keyword%' OR ms_supplier.id_supplier like '%$keyword%'
						order by ms_supplier.nama asc
						LIMIT 10";

			$numrows = $this->db->query($q_cari)->num_rows();
			if($numrows >= 1){
				$data = $this->db->query($q_cari);
					foreach($data->result() as $rowz){

					$nama_x = ucwords(strtolower($rowz->ket));
					$arr['suggestions'][] = array(
						'value'	=>$nama_x,
						'id_supplier'	=>$rowz->id_supplier,
						'nama'		=>$rowz->nama,
						'alamat'		=>$rowz->alamat,
						'telepon'		=>$rowz->telepon,
						'top'		=>$rowz->top,
						'nama_kabupaten'		=>$rowz->nama_kabupaten
					);
				}
			} else {
				$nama_x = "Data Tidak Ditemukan";
				$kosong = '';
				$arr['suggestions'][] = array(
					'value'			=>$nama_x,
					'nama'		=>$kosong,
					'alamat'		=>$kosong,
					'top'		=>$kosong,
					'telepon'		=>$kosong,
					'nama_kabupaten'		=>$kosong
				);
			}
			echo json_encode($arr);
		}

	public function item_detail_barang(){
		  $id = get_cookie('eklinik');
			$ses_kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
			$ses_id_jenis=$this->session->userdata('id_jenis'.$id);
			if($ses_id_jenis<3)
			{
			  $dan="";

			}
			else {

			  $dan=" AND ms_barang.id_barang NOT IN (
					SELECT
						detail_ms_barang.kd_barang
					FROM
						detail_ms_barang
					WHERE
						detail_ms_barang.kd_sub_unit = $ses_kd_sub_unit
				)";
			}

			$keyword = $this->uri->segment(3);
			$keyword = str_replace('%20',' ',$keyword);
			$q_cari_unit = "SELECT
											CONCAT(
													UPPER(ms_barang.nama),
													' - ',
													ms_barang.id_barang,
													' - ',
													IFNULL(ms_barang.barcode,' No Barcode')
												) AS ket,
											ms_barang.id_barang,
											ms_barang.barcode,
											upper(ms_barang.nama) as nama_barang,
											upper(ms_barang.nama_alias) as nama_alias,
											IFNULL(ms_barang.harga_beli,0) AS hb,
											IFNULL(ms_barang.harga_jual,0) AS hj,
											ms_barang.satuan,
											ms_barang.ppn,
											ms_barang.id_kategori,
											ms_barang.id_jenis,
											ms_barang.id_merk,
											ms_barang.id_tipe,
											upper(ms_kategori.nama) AS nama_kategori,
											upper(ms_jenis_barang.nama) AS nama_jenis,
											upper(ms_merk.nama) AS nama_merk,
											upper(ms_tipe.nama) AS nama_tipe
											FROM
											ms_barang
											LEFT JOIN ms_kategori ON ms_barang.id_kategori = ms_kategori.id_kategori
											LEFT JOIN ms_jenis_barang ON ms_barang.id_jenis = ms_jenis_barang.id_jenis
											LEFT JOIN ms_merk ON ms_barang.id_merk = ms_merk.id_merk
											LEFT JOIN ms_tipe ON ms_barang.id_tipe = ms_tipe.id_tipe
											WHERE
												ms_barang.status_aktif = 1
											$dan
											AND (ms_barang.nama like '%$keyword%' OR ms_barang.barcode like '%$keyword%' OR ms_barang.id_barang like '%$keyword%' OR ms_barang.nama_alias like '%$keyword%' OR ms_barang.id_lama like '%$keyword%') ORDER BY ms_barang.nama ASC";

//echo $q_cari_unit;
			$numrows_unit = $this->db->query($q_cari_unit)->num_rows();
			if($numrows_unit >= 1){
				  $data = $this->db->query($q_cari_unit);
				 	foreach($data->result() as $row){
					$ppn=$row->ppn;
					$hb=$row->hb;
					$hj=$row->hj;
				 	$nama_x = $row->ket;
					$arr['suggestions'][] = array(
						'value'				=>$nama_x,
						'nama_barang'	=>$row->nama_barang,
						'id_barang'		=>$row->id_barang,
						'barcode'		  =>$row->barcode,
						'nama_alias'	=>$row->nama_alias,
						'hb'					=>$hb,
						'hj'					=>$hj,
						'satuan'			=>$row->satuan,
						'ppn'					=>$row->ppn,
						'nama_kategori'		=>$row->nama_kategori,
						'merk'		=>$row->nama_merk,
						'jenis'		=>$row->nama_jenis,
						'tipe'		=>$row->nama_tipe
					);
				}
			} else {
				$bukti_x = "Data Tidak Ditemukan";
				$kosong = '';
				$arr['suggestions'][] = array(
					'value'			=>$bukti_x,
					'nama_barang'	=>$kosong,
					'id_barang'		=>$kosong,
					'barcode'		  =>$kosong,
					'nama_alias'	=>$kosong,
					'hb'					=>$hb,
					'hj'					=>$hj,
					'satuan'			=>$kosong,
					'ppn'					=>$kosong,
					'nama_kategori'		=>$kosong,
					'merk'		=>$kosong,
					'jenis'		=>$kosong,
					'tipe'		=>$kosong
				);
			}
			echo json_encode($arr);
		}


	public function item_beli(){
			$id = get_cookie('eklinik');
			$ses_kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
			$ses_kd_unit=$this->session->userdata('kd_unit'.$id);
		 	$keyword = $this->uri->segment(3);
			$keyword = str_replace('%20',' ',$keyword);
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
												ms_barang.satuan,
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
												WHERE
													mastersubunit.kd_sub_unit = $ses_kd_sub_unit  UNION ALL
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
											AND ( ms_barang.nama LIKE '%$keyword%' OR ms_barang.barcode LIKE '%$keyword%' OR ms_barang.id_barang LIKE '%$keyword%' OR ms_barang.nama_alias LIKE '%$keyword%' )
										ORDER BY
											ms_barang.nama ASC";

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
					$arr['suggestions'][] = array(
						'value'				=>$nama_x,
						'nama_barang'	=>$row->nama,
						'id_barang'		=>$row->id_barang,
						/*'hb'					=>$row->hb,*/
						'hb'					=>number_format($row->hb,0,",","."),
						'dpp'					=>$dpp,
						'satuan'			=>$row->satuan,
						'ppn'					=>$row->ppn,
						'nilaippn'		=>$nilaippn
					);
				}
			} else {
				$bukti_x = "Data Tidak Ditemukan";
				$kosong = '';
				$arr['suggestions'][] = array(
					'value'			=>$bukti_x,
					'nama_barang'	=>$kosong,
					'id_barang'		=>$kosong,
					'hb'	      	=>$kosong,
					'dpp'		      =>$kosong,
					'satuan'		  =>$kosong,
					'ppn'		      =>$kosong,
					'nilaippn'	  =>$kosong
				);
			}
			echo json_encode($arr);
		}

		public function item_jual(){
			$id = get_cookie('eklinik');
			$ses_kd_unit=$this->session->userdata('kd_unit'.$id);
			$ses_kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);

			$keyword = $this->uri->segment(3);
			$keyword = str_replace('%20',' ',$keyword);

						$q_cari_unit="SELECT
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
														AND ( ms_barang.nama LIKE '%$keyword%' OR ms_barang.barcode LIKE '%$keyword%' OR ms_barang.id_barang LIKE '%$keyword%' OR ms_barang.nama_alias LIKE '%$keyword%' )
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
					$arr['suggestions'][] = array(
						'value'				=>$nama_x,
						'nama_barang'	=>$row->nama,
						'id_barang'		=>$row->id_barang,
						/*'hb'					=>$row->hb,*/
						'hb'					=>number_format($row->hb,0,",","."),
						'dpp'					=>$dpp,
						'satuan'			=>$row->satuan,
						'ppn'					=>$row->ppn,
						'nilaippn'		=>$nilaippn
					);
				}
			} else {
				$bukti_x = "Data Tidak Ditemukan";
				$kosong = '';
				$arr['suggestions'][] = array(
					'value'			=>$bukti_x,
					'nama_barang'	=>$kosong,
					'id_barang'		=>$kosong,
					'hb'	      	=>$kosong,
					'dpp'		      =>$kosong,
					'satuan'		  =>$kosong,
					'ppn'		      =>$kosong,
					'nilaippn'	  =>$kosong
				);
			}
			echo json_encode($arr);
			}

			public function item_obat(){
				$id = get_cookie('eklinik');
				$ses_kd_unit=$this->session->userdata('kd_unit'.$id);
				$ses_kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);

				$keyword = $this->uri->segment(3);
				$keyword = str_replace('%20',' ',$keyword);

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
															 	ms_barang.satuan,
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
															AND ( ms_barang.nama LIKE '%$keyword%' OR ms_barang.barcode LIKE '%$keyword%' OR ms_barang.id_barang LIKE '%$keyword%' OR ms_barang.nama_alias LIKE '%$keyword%' )
															AND xx.qty_akhir > 0
														ORDER BY
															ms_barang.nama ASC";
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
						$arr['suggestions'][] = array(
							'value'				=>$nama_x,
							'nama_barang'	=>$row->nama,
							'id_barang'		=>$row->id_barang,
							'hb'					=>$row->hb,
							'dpp'					=>$dpp,
							'satuan'			=>$row->satuan,
							'ppn'					=>$row->ppn,
							'nilaippn'		=>$nilaippn
						);
					}
				} else {
					$bukti_x = "Data Tidak Ditemukan";
					$kosong = '';
					$arr['suggestions'][] = array(
						'value'			=>$bukti_x,
						'nama_barang'	=>$kosong,
						'id_barang'		=>$kosong,
						'hb'	      	=>$kosong,
						'dpp'		      =>$kosong,
						'satuan'		  =>$kosong,
						'ppn'		      =>$kosong,
						'nilaippn'	  =>$kosong
					);
				}
				echo json_encode($arr);
				}

			public function xitem_obat(){
				  $id = get_cookie('eklinik');
					$ses_kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
					$keyword = $this->uri->segment(3);
					$keyword = str_replace('%20',' ',$keyword);
					$q_cari_unit = "SELECT
											ms_barang.id_barang,
											ms_barang.nama,
											ms_barang.barcode,
											detail_ms_barang.hj as hj,
											0 as hb,
											ms_barang.ppn,
											detail_ms_barang.kd_sub_unit,
											ms_barang.satuan,
											ms_barang.status_aktif,
											CONCAT(UPPER(ms_barang.nama),' : ',ms_barang.id_barang,' (',ms_barang.satuan,')') as ket
											FROM
											ms_barang
											INNER JOIN detail_ms_barang ON detail_ms_barang.kd_barang = ms_barang.id_barang
											WHERE detail_ms_barang.kd_sub_unit = 17
											AND (ms_barang.nama like '%$keyword%' OR ms_barang.barcode like '%$keyword%' OR ms_barang.id_barang like '%$keyword%')
								order by ms_barang.nama asc
								LIMIT 10";

					$numrows_unit = $this->db->query($q_cari_unit)->num_rows();
					if($numrows_unit >= 1){
						$data = $this->db->query($q_cari_unit);
						 	foreach($data->result() as $row){
							$itemppn=$row->ppn;
							$hj=$row->hj;

							if ($itemppn=="PPN"){
									$dpp=$hj/1.1;
									$dpp=round($dpp,2);
									$nilaippn=$hj-$dpp;
									$nilaippn=round($nilaippn,2);
							}
							else {
								$nilaippn=0;
								$dpp=round($hj,2);
							}

						 	$nama_x = $row->ket;
							$arr['suggestions'][] = array(
								'value'				=>$nama_x,
								'nama_barang'	=>$row->nama,
								'id_barang'		=>$row->id_barang,
								'hj'					=>$row->hj,
								'dpp'					=>$dpp,
								'hb'					=>$row->hb,
								'satuan'			=>$row->satuan,
								'ppn'					=>$row->ppn,
								'nilaippn'		=>$nilaippn
							);
						}
					} else {
						$bukti_x = "Data Tidak Ditemukan";
						$kosong = '';
						$arr['suggestions'][] = array(
							'value'			=>$bukti_x,
							'nama_barang'	=>$kosong,
							'id_barang'		=>$kosong,
							'hb'	      	=>$kosong,
							'hj'		      =>$kosong,
							'dpp'		      =>$kosong,
							'satuan'		  =>$kosong,
							'ppn'		      =>$kosong,
							'nilaippn'		      =>$kosong
						);
					}
					echo json_encode($arr);
				}

}
?>
