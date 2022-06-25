<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kartustok extends CI_Controller{

	public $CI = NULL;

	function __construct(){
        parent::__construct();
		$this->load->helper('currency_format_helper');

		$this->CI = & get_instance();

		$this->load->helper(array('url'));
		$this->load->model('umum/Bis_model');
		$this->load->model('umum/Bis_model_ant');
		$this->load->helper('format_tanggal_helper');
		$this->load->model('Menu_m');
    $this->load->model('Hak_Akses_m');
    $this->load->model('Login_m');
    }

	function index(){
		$id = get_cookie('eklinik');
    $kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
		$kd_unit=$this->session->userdata('kd_unit'.$id);
		$ses_id_jenis=$this->session->userdata('id_jenis'.$id);

		if($ses_id_jenis<3)
    {

      $dan2="";
    }
    else {

			$dan2=" WHERE
			mastersubunit.kd_sub_unit = '$kd_sub_unit'";
    }

		$query_sub_unit="SELECT
												mastersubunit.kd_sub_unit,
												mastersubunit.nama_sub_unit,
												mastersubunit.kd_unit
											FROM
												mastersubunit
												$dan2
											ORDER BY
												mastersubunit.nama_sub_unit ASC";

    $query_item="SELECT DISTINCT
									in_trans.kd_barang AS kd_barang,
									CONCAT ( ms_barang.nama, ' - ', IFNULL( ms_barang.barcode, 'NON BARCODE' ), ' - ', IFNULL( ms_barang.nama_alias, 'NON ALIAS' ) ) AS nama,
									ms_barang.satuan
								FROM
									in_trans
									INNER JOIN ms_barang ON in_trans.kd_barang = ms_barang.id_barang
								ORDER BY
									ms_barang.nama ASC";
	// echo 	$query_sub_unit;
   $data=array(
				'title'=>'Kartu Stock',
				'xmenu'=>'Laporan',
				'xsubmenu'=>'Stok',
				'data_item'=>$this->Bis_model->manualQuery($query_item),
				//'data_unit'=>$this->Bis_model->manualQuery($query_unit),
				'data_sub_unit'=>$this->Bis_model->manualQuery($query_sub_unit),
				'users'=>$this->Hak_Akses_m->get_user(),
				'menu'=>$this->Menu_m->get_menu($id),
				'submenu'=>$this->Menu_m->get_submenu($id),
		);
    $this->load->view('Kartustok_view',$data);
	}
	function get_data_barang(){


      $kd_barang= $this->input->get('kd_barang');
			$kd_unit= $this->input->get('kd_unit');
			$kd_sub_unit= $this->input->get('kd_sub_unit');

      $id = get_cookie('eklinik');
      $this->load->model('Menu_m');
      $this->load->model('Hak_Akses_m');
      $this->load->model('Login_m');
			$ses_kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
			$ses_kd_unit=$this->session->userdata('kd_unit'.$id);

		$query_barang="SELECT
												defTab.*,
												ms_barang.nama,
												ms_barang.barcode
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
														in_trans.kd_sub_unit = $kd_sub_unit
													UNION ALL
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
														saldoawalstok.kd_sub_unit = $kd_sub_unit
												) AS defTab
												INNER JOIN ms_barang ON defTab.kd_barang = ms_barang.id_barang
											WHERE
												defTab.kd_barang = '$kd_barang'
											ORDER BY
												defTab.tgl_trans ASC";
		//echo $query_barang;
     $data=array(
          'menu' => $this->Menu_m->get_menu($id),
          'submenu' => $this->Menu_m->get_submenu($id),
          'jabatan' => $this->Login_m->get_jabatan(),
          'users' => $this->Hak_Akses_m->get_user(),
          'data_barang' => $this->Bis_model->manualQuery($query_barang),
      );
      $this->load->view('ajax_data_barang',$data);
  }

	function get_data_po(){
      //$id['id_supplier']=$this->input->post('id_supplier');
      $no_po=$this->input->post('no_po');

      $id['no_bukti'] =$this->input->post('no_po');

      $no_bukti= $this->input->post('no_po');
      $id = get_cookie('eklinik');

      $data['data_jabatan'] = $this->Bis_model->getAllData('ms_jabatan');

       $query_data="select * from ms_supplier";
                   //$query_driver="SELECT * from ms_pegawai where id_jabatan=40";
       //$data['data_fpb'] = $this->Bis_model->manualQuery($query_data);

      $query_data_edit="SELECT
                      	judul_po.no_bukti,
                      	judul_po.tgl_trans,
                      	judul_po.keterangan,
                      	judul_po.status_po,
                      	judul_po.status_approve,
                      	judul_po.user_approve,
                      	judul_po.approve_date,
                      	judul_po.no_spp,
                      	ms_pegawai.nama AS user_entry,
                      	judul_po.tgl_ed,
                      	ms_supplier.nama AS nama_supplier,
                      	judul_po.dpp,
                      	judul_po.ppn,
                      	judul_po.total,
                      	judul_po.jenis_bayar,
                      	judul_po.jenis_ppn,
                      	judul_po.id_supplier,
                      	ms_supplier.alamat,
                      	judul_po.top
                      FROM
                      	judul_po
                      LEFT JOIN judul_spb ON judul_po.no_spp = judul_spb.no_bukti
                      INNER JOIN `user` ON judul_po.entry_user = `user`.id_user
                      INNER JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
                      LEFT JOIN ms_supplier ON judul_po.id_supplier = ms_supplier.id_supplier
                      WHERE judul_po.no_bukti  = '$no_bukti'";
      //echo $query_data_edit;
      $q_detail="SELECT
                  judul_po.no_bukti,
                  detail_po.kd_barang,
                  ms_barang.nama AS nama_barang,
                  detail_po.qty,
                  ms_barang.part_number,
                  detail_po.hb AS harga_beli
                  FROM
                  detail_po
                  INNER JOIN judul_po ON judul_po.no_bukti = detail_po.no_bukti
                  INNER JOIN ms_barang ON detail_po.kd_barang = ms_barang.id_barang
                  WHERE
                  detail_po.no_bukti = '$no_bukti'";
    //echo $query_data_edit;
     $data=array(
          'title'=>'Edit Surat Permintaan Pembelian (PO)',
          'data_supplier'=>$this->Model_app->manualQueryX($query_data),
          'menu' => $this->Menu_m->get_menu($id),
          'submenu' => $this->Menu_m->get_submenu($id),
          'jabatan' => $this->Login_m->get_jabatan(),
          'users' => $this->Hak_Akses_m->get_user(),
          'data_po_edit' => $this->Bis_model->manualQuery($query_data_edit),
          'data_detail_po' => $this->Bis_model->manualQuery($q_detail),

      );

      //$this->load->view('Popart_edit',$data);
      //$data['detail_data_po'] = $this->Bis_model->manualQuery($q_data);
      //$data['judul_data_po'] = $this->Bis_model->manualQuery($q_data_judul);
                                      // $data=array('detail_po_rent'=>$this->Bis_model->getSelectedData('trans_po_rental',$id)->result(),);
      //$data=array('detail_data_spp'=>$this->Bis_model->getDataX($q_data),);
      $this->load->view('ajax_data_po',$data);
  }
	function cetakkartu(){
			$id = get_cookie('eklinik');
			$tipe=$this->input->get('get');
			$ses_kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
			$ses_kd_unit=$this->session->userdata('kd_unit'.$id);
			$kd_barang= $this->input->post('kd_barang');
			$kd_unit= $this->input->post('kd_unit');
			$kd_sub_unit= $this->input->post('kd_sub_unit');

			if (!empty($kd_barang)){
				$dan_kode= " AND ms_barang.id_barang='$kd_barang'";
			}
			else {
				$dan_kode="";

			}
	  	$query_barang_detail="SELECT
												defTab.*,
												ms_barang.nama,
												ms_barang.satuan,
												ms_barang.barcode
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
														in_trans.kd_sub_unit = $kd_sub_unit
													UNION ALL
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
														saldoawalstok.kd_sub_unit = $kd_sub_unit
												) AS defTab
												INNER JOIN ms_barang ON defTab.kd_barang = ms_barang.id_barang
											WHERE
												defTab.kd_barang = '$kd_barang'
											ORDER BY
												defTab.tgl_trans ASC";


		$query_barang="SELECT
											sum( defTab.qty ) AS stok,
											ms_barang.nama,
											ms_barang.id_barang,
										  ms_barang.satuan,
											ms_barang.barcode
										FROM
											(
											SELECT
												in_trans.kd_barang,
												in_trans.harga,
												in_trans.qty
											FROM
												in_trans
												INNER JOIN mastersubunit ON in_trans.kd_sub_unit = mastersubunit.kd_sub_unit
											WHERE
												in_trans.kd_sub_unit = 	$kd_sub_unit UNION ALL
											SELECT
												saldoawalstok.kd_barang,
												saldoawalstok.hpp AS harga,
												saldoawalstok.qty
											FROM
												saldoawalstok
												INNER JOIN mastersubunit ON saldoawalstok.kd_sub_unit = mastersubunit.kd_sub_unit
											WHERE
												saldoawalstok.kd_sub_unit = $kd_sub_unit
											) AS defTab
											INNER JOIN ms_barang ON defTab.kd_barang = ms_barang.id_barang
										GROUP BY
											defTab.kd_barang
										ORDER BY
											ms_barang.nama ASC";
											$query_harga ="SELECT
																	Sum(defTab.qty) AS stok,
																	ms_barang.nama,
																	ms_barang.nama_alias,
																	ms_barang.id_barang,
																	ms_barang.satuan,
																	ms_barang.barcode,
																	detail_ms_barang.hb,
																	detail_ms_barang.hj,
																	detail_ms_barang.perc_margin,
																	detail_ms_barang.margin
																	FROM
																	(
																		SELECT
																			in_trans.kd_barang,
																			in_trans.harga,
																			in_trans.qty
																		FROM
																			in_trans
																			INNER JOIN mastersubunit ON in_trans.kd_sub_unit = mastersubunit.kd_sub_unit
																		WHERE
																			in_trans.kd_sub_unit = $kd_sub_unit UNION ALL
																		SELECT
																			saldoawalstok.kd_barang,
																			saldoawalstok.hpp AS harga,
																			saldoawalstok.qty
																		FROM
																			saldoawalstok
																			INNER JOIN mastersubunit ON saldoawalstok.kd_sub_unit = mastersubunit.kd_sub_unit
																		WHERE
																			saldoawalstok.kd_sub_unit = $kd_sub_unit
																		) AS defTab
																	INNER JOIN ms_barang ON defTab.kd_barang= ms_barang.id_barang
																	INNER JOIN detail_ms_barang ON ms_barang.id_barang = detail_ms_barang.kd_barang
																	WHERE
																	detail_ms_barang.kd_sub_unit = $kd_sub_unit
																	GROUP BY
																	defTab.kd_barang
																	ORDER BY
																	ms_barang.nama ASC
																	";

											$query_harga_nol="SELECT
																	Sum(defTab.qty) AS stok,
																	ms_barang.nama,
																	ms_barang.id_barang,
																	ms_barang.satuan,
																	ms_barang.barcode,
																	detail_ms_barang.hb,
																	detail_ms_barang.hj,
																	detail_ms_barang.perc_margin,
																	detail_ms_barang.margin
																	FROM
																	(
																		SELECT
																			in_trans.kd_barang,
																			in_trans.harga,
																			in_trans.qty
																		FROM
																			in_trans
																			INNER JOIN mastersubunit ON in_trans.kd_sub_unit = mastersubunit.kd_sub_unit
																		WHERE
																			in_trans.kd_sub_unit = $kd_sub_unit UNION ALL
																		SELECT
																			saldoawalstok.kd_barang,
																			saldoawalstok.hpp AS harga,
																			saldoawalstok.qty
																		FROM
																			saldoawalstok
																			INNER JOIN mastersubunit ON saldoawalstok.kd_sub_unit = mastersubunit.kd_sub_unit
																		WHERE
																			saldoawalstok.kd_sub_unit = $kd_sub_unit
																		) AS defTab
																	INNER JOIN ms_barang ON defTab.kd_barang= ms_barang.id_barang
																	INNER JOIN detail_ms_barang ON ms_barang.id_barang = detail_ms_barang.kd_barang
																	WHERE
																	detail_ms_barang.kd_sub_unit = $kd_sub_unit AND detail_ms_barang.hj=0
																	GROUP BY
																	defTab.kd_barang
																	ORDER BY
																	ms_barang.nama ASC
																	";
																	$query_label="SELECT
																							Sum(defTab.qty) AS stok,
																							ms_barang.nama,
																							ms_barang.nama_alias,
																							ms_barang.id_barang,
																							ms_barang.satuan,
																							ms_barang.barcode,
																							detail_ms_barang.hb,
																							detail_ms_barang.hj,
																							detail_ms_barang.perc_margin,
																							detail_ms_barang.margin
																							FROM
																							(
																								SELECT
																									in_trans.kd_barang,
																									in_trans.harga,
																									in_trans.qty
																								FROM
																									in_trans
																									INNER JOIN mastersubunit ON in_trans.kd_sub_unit = mastersubunit.kd_sub_unit
																								WHERE
																									in_trans.kd_sub_unit = $kd_sub_unit UNION ALL
																								SELECT
																									saldoawalstok.kd_barang,
																									saldoawalstok.hpp AS harga,
																									saldoawalstok.qty
																								FROM
																									saldoawalstok
																									INNER JOIN mastersubunit ON saldoawalstok.kd_sub_unit = mastersubunit.kd_sub_unit
																								WHERE
																									saldoawalstok.kd_sub_unit = $kd_sub_unit
																								) AS defTab
																							INNER JOIN ms_barang ON defTab.kd_barang= ms_barang.id_barang
																							INNER JOIN detail_ms_barang ON ms_barang.id_barang = detail_ms_barang.kd_barang
																							WHERE
																							detail_ms_barang.kd_sub_unit = $kd_sub_unit $dan_kode
																							GROUP BY
																							defTab.kd_barang
																							ORDER BY
																							ms_barang.nama ASC
																							";
	    //echo $query_label;
		 $data=array(
					'menu' => $this->Menu_m->get_menu($id),
					'submenu' => $this->Menu_m->get_submenu($id),
					'jabatan' => $this->Login_m->get_jabatan(),
					'users' => $this->Hak_Akses_m->get_user(),
					'data_barang' => $this->Bis_model->manualQuery($query_barang),
					'data_harga_nol' => $this->Bis_model->manualQuery($query_harga_nol),
					'data_harga' => $this->Bis_model->manualQuery($query_harga),
					'data_label' => $this->Bis_model->manualQuery($query_label),
					'data_barang_detail' => $this->Bis_model->manualQuery($query_barang_detail),
			);
			//$this->load->view('ajax_data_barang',$data);
			if( $tipe == '1' ){
	      //$this->load->view('report/Cetak_rekap_si',$data);
				$this->load->view('report/Cetakkartustok2',$data);
			}
	  	 elseif($tipe == '2')
			 {
	   	  //$this->load->view('report/Cetak_detail_si',$data);
				$this->load->view('report/Cetakkartustokdetail',$data);
			 }
			 elseif($tipe == '3')
			{
			 //$this->load->view('report/Cetak_detail_si',$data);
			 $this->load->view('report/Cetakqtynol',$data);
			}
			elseif ($tipe == '4')
			{
			 //$this->load->view('report/Cetak_detail_si',$data);aa
			 $this->load->view('report/Cetaklabelkecil',$data);
			}
			elseif ($tipe == '5')
			{
			 //$this->load->view('report/Cetak_detail_si',$data);aa
			 $this->load->view('report/Cetakqty',$data);
			}

	}
	function cetak()
	{
		$id = get_cookie('eklinik');

		$id_plant=$this->input->post('id_plant');
		$tgl_awal=$this->input->post('tgl_awal');
		$tgl_akhir=$this->input->post('tgl_akhir');
		$tipe=$this->input->get('get');
		$query_plant="select * from ms_plant where id_plant='$id_plant'";

		$id_customer=$this->input->post('id_customer');
		$jenis_bayar=$this->input->post('jenis_bayar');

		if(!empty($id_supplier))
		{
				$dan1=" AND judul_si.id_customer = '$id_customer' ";
		}
		else {
			$dan1="";
		}

		if(!empty($jenis_bayar))
		{
				$dan2=" AND judul_bpb.jenis_bayar = '$jenis_bayar' ";
		}
		else {
			$dan2="";
		}



		 //echo ($id_driver.'-'.$id_unit);

		$query_data="SELECT
								judul_si.no_bukti,
								judul_si.tgl_trans,
								judul_si.id_customer,
								judul_si.id_sales,
								judul_si.jenis_bayar,
								judul_si.jenis_ppn,
								judul_si.no_ref,
								judul_si.subtotal,
								judul_si.diskon,
								judul_si.dpp,
								judul_si.ppn,
								judul_si.total,
								judul_si.dp,
								judul_si.keterangan,
								ms_customer.nama AS nama_customer
							FROM
								judul_si
							LEFT JOIN ms_customer ON judul_si.id_customer = ms_customer.id_customer
							WHERE		(judul_si.tgl_trans BETWEEN '$tgl_awal' AND '$tgl_akhir') $dan1 $dan2 ORDER BY judul_si.tgl_trans ASC";

		$data['data_bpb'] = $this->Bis_model->manualQuery($query_data);
		$data['data_plant']= $this->Bis_model->manualQuery($query_plant);
		$data['jabatan'] = $this->Login_m->get_jabatan();
		$data['users'] = $this->Hak_Akses_m->get_user();
		$data['menu'] = $this->Menu_m->get_menu($id);
		$data['submenu'] = $this->Menu_m->get_submenu($id);

		if( $tipe == '1' )
      $this->load->view('report/Cetak_rekap_si',$data);
  	 else
   	  $this->load->view('export/Bpb_export',$data);


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
