<?php
set_time_limit(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Jp_2 extends CI_Controller{

	public $CI = NULL;

	function __construct(){
        parent::__construct();
		$this->load->helper('currency_format_helper');

		$this->CI = & get_instance();

		$this->load->helper(array('url'));
		$this->load->model('umum/Bis_model');
		$this->load->model('umum/Bis_model_ant');

    }

	function index(){
		$id = get_cookie('eklinik');
		$this->load->model('Menu_m');
		$this->load->model('Hak_Akses_m');
		$this->load->model('Login_m');

		$data['combo_plant']=$this->Bis_model_ant->get_combo_plant();
		//$data['data_plant'] = $this->Bis_model->getAllData('ms_plant');
		$data['data_sloc'] = $this->Bis_model->getAllData('mastersubunit');

		$query_sub_unit="SELECT
											mastersubunit.kd_sub_unit,
											mastersubunit.nama_sub_unit,
											masterunit.kd_unit,
											masterunit.nama_unit
										FROM
											mastersubunit
											INNER JOIN masterunit ON mastersubunit.kd_unit = masterunit.kd_unit";
		$data=array(
 				'title'=>'Bukti Memorial',
 				'xmenu'=>'Laporan',
 				'xsubmenu'=>'Stok',
 				//'data_item'=>$this->Bis_model->manualQuery($query_item),
 				//'data_unit'=>$this->Bis_model->manualQuery($query_unit),
 				'data_sub_unit'=>$this->Bis_model->manualQuery($query_sub_unit),
 				'users'=>$this->Hak_Akses_m->get_user(),
 				'menu'=>$this->Menu_m->get_menu($id),
 				'submenu'=>$this->Menu_m->get_submenu($id),
 		);
		$this->load->view('Jsesuai_v',$data);
	}

	// buat no_bukti awal
	function get_kode($cari2, $kd_tambah, $g_thn, $g_tgl){
		$q_cari_kode = 'SELECT DISTINCT(no_bukti) as id
			FROM gltransjalan
			WHERE no_bukti like "'.$cari2.'%"
			ORDER BY no_bukti desc limit 1';

		$mq_cari_kode = $this->Bis_model->manualQuery($q_cari_kode);
	   	foreach ($mq_cari_kode as $fq_cari_kode){
			$idx = $fq_cari_kode->id;
			$idx = substr($idx,-4);
		}
		$idx = $idx + 1;
		$idx = sprintf("%04s", $idx);
		$idx = 'BM'.$kd_tambah.''.$g_thn.$g_tgl.$idx;

		return $idx;
	}

	// buat no_bukti ubah tanggal
	public function create_bm(){
		ini_set('display_errors', 0);

		$data = $this->input->post();

		if(isset($data["var1"])){
			$var_1 =  $data["var1"];
			//$var_2 =  $data["var2"];

			$tglbbmataubkm = $var_1;
			//$kd_bayar = $var_2;
			$tglbbmataubkmfilter = strtotime($tglbbmataubkm);
			$g_thn = substr(date("Y",$tglbbmataubkmfilter),2,2);
			$g_tgl = date("m",$tglbbmataubkmfilter);
			$kd_tambah = '';

			$cari2 = 'BM'.$kd_tambah.''.$g_thn.$g_tgl;
			//echo $cari2;
			$q_cari_kode = 'SELECT DISTINCT(no_bukti) as id
				FROM gltransjalan
				WHERE no_bukti like "'.$cari2.'%"
				ORDER BY no_bukti desc limit 1';

			$mq_cari_kode = $this->Bis_model->manualQuery($q_cari_kode);
			foreach ($mq_cari_kode as $fq_cari_kode){
				$idx_2 = $fq_cari_kode->id;
				$idx_2 = substr($idx_2,-4);
			}
			$idx_2 = $idx_2 + 1;
			$idx_2 = sprintf("%04s", $idx_2);
			$idx_2 = 'BM'.$kd_tambah.''.$g_thn.$g_tgl.$idx_2;
			$nobbmataubkm = $idx_2;

			echo "<b>
					<font color=red>
						<input type='text' value='$nobbmataubkm' name='x_bm' id='x_bm' hidden />
					</font>
				</b>";
		}
	}

	//Insert Database
    function tambah(){
		$this->load->model('umum/Bis_model');
		set_time_limit(0);
		$now = date('Y-m-d H:i:s');
        $cookie_id_user = get_cookie('eklinik');
		$now = date('Y-m-d H:i:s');
		//$kd_sub_unit_login = $_SESSION['subunit'];
		$kd_sub_unit_login = '1';
		$user_login = 'theant';
		//$user_login = $_SESSION['userLogin'];

		$no_bukti = $this->input->post('no_bm');
		$tgl_trans = $this->input->post('tgl_trans');

		$q_cek_bukti = "SELECT * FROM gltransjalan
			WHERE no_bukti = '$no_bukti'";
		$numrows_bukti = $this->db->query($q_cek_bukti)->num_rows();
		if($numrows_bukti >= 1){

			$tglbbmataubkm = $tgl_trans;
			//$kd_bayar = $var_2;

			$tglbbmataubkmfilter = strtotime($tglbbmataubkm);
			$g_thn = substr(date("Y",$tglbbmataubkmfilter),2,2);
			$g_tgl = date("m",$tglbbmataubkmfilter);
			$kd_tambah = '';

			$cari2 = 'BM'.$kd_tambah.''.$g_thn.$g_tgl;
			//echo $cari2;
			$q_cari_kode = 'SELECT DISTINCT(no_bukti) as id
				FROM gltransjalan
				WHERE no_bukti like "'.$cari2.'%"
				ORDER BY no_bukti desc limit 1';

			$mq_cari_kode = $this->Bis_model->manualQuery($q_cari_kode);
			foreach ($mq_cari_kode as $fq_cari_kode){
				$idx_2 = $fq_cari_kode->id;
				$idx_2 = substr($idx_2,-4);
			}
			$idx_2 = $idx_2 + 1;
			$idx_2 = sprintf("%04s", $idx_2);
			$idx_2 = 'BM'.$kd_tambah.''.$g_thn.$g_tgl.$idx_2;
			$no_bukti = $idx_2;
		} else {
			$no_bukti = $no_bukti;
		}

		$this->db->trans_begin();
        //$this->Bis_model->updateData('ms_pegawai',$data,$id);
		$id['no_bukti']=$no_bukti;
		$this->Bis_model->deleteData('gltransjalan',$id);

		//$inserted_count = 0;
		foreach ($this->input->post('rowsBM') as $key => $count ){
			$kd_akun = $this->input->post('x_kode_akun_'.$count);
			$keterangan = $this->input->post('keterangan_'.$count);
			$nilaiDebet = $this->input->post('nilai_debet_'.$count);
			$nilaiKredit = $this->input->post('nilai_kredit_'.$count);
			$data=array(
			'no_bukti'=>$no_bukti,
			//'kd_sub_unit'=>$this->input->post('kd_sub_unit'),
			'kd_akun'=>$kd_akun,
			'no_baris'=>$count,
			'nama_akun'=>$this->input->post('nama_akun'),
			'tgl_trans'=>$tgl_trans,
			'modul_asal'=>$this->input->post('modul_asal'),
			'tipe_trans'=>1,
			'kd_reklas'=>$this->input->post('kd_reklas'),
			'keterangan'=>$keterangan,
			'jml_D'=>$nilaiDebet,
			'jml_K'=>$nilaiKredit,
			'del_indek'=>"BM",
			'entry_date'=>$now,
			'user_entry'=>$cookie_id_user,

			'jml_trans'=>0,
			'tipe_bayar'=>$this->input->post('tipe_bayar'),
			'kd_jp'=>$this->input->post('kd_jp'),
			//'id_sloc'=>$this->input->post('id_sloc'),
			'kd_sub_unit'=>$this->input->post('kd_sub_unit'),

             );
			$this->Bis_model->insertData('gltransjalan',$data);

		}



		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();

			$this->session->set_flashdata('message', 'Gagal Simpan JP.');
            $this->session->set_flashdata('jenis', 'danger');
            redirect(site_url('Jp_2'));
		} else {
			$this->db->trans_commit();


				$this->session->set_flashdata('message', 'Sukses Simpan JP.');
				$this->session->set_flashdata('jenis', 'success');

				$js_s = site_url('Jp_2/v_edit')."?no_bukti_fil=".$no_bukti;
				redirect($js_s);

		}



	}

	//edit view
	function v_edit(){
		$id = get_cookie('eklinik');

		$this->load->model('Menu_m');
		$this->load->model('Hak_Akses_m');
		$this->load->model('Login_m');

		$data['menu'] = $this->Menu_m->get_menu($id);
		$data['submenu'] = $this->Menu_m->get_submenu($id);
		$data['data_sloc'] = $this->Bis_model->getAllData('ms_slock');

		$no_bukti = $this->input->get('no_bukti_fil');
		$query_edit = "SELECT
										a.no_bukti AS no_bukti_x,
										a.tgl_trans AS tgl_trans_x,
										a.keterangan AS keterangan_x,
										a.no_baris AS no_baris_x,
										a.kd_akun AS kd_akun_x,
										ROUND(a.jml_D,2) AS jml_D_x,
									ROUND(a.jml_K,2) AS jml_K_x,
										a.kd_sub_unit AS kd_sub_unit_x,
										a.modul_asal AS modul_asal_x,
										a.tipe_trans AS tipe_trans_x,
										a.del_indek AS del_indek_x,
										a.kd_person AS kd_person_x,
										a.tipe_bayar AS tipe_bayar_x,
										a.kd_jp AS kd_jp_x,
										a.entry_date AS entry_date_x,
										a.user_entry AS user_entry_x,
										a.jml_trans AS jml_trans_x,
										a.nama_akun AS nama_akun_x,
										a.kd_reklas AS kd_reklas_x,
										b.nama AS nama_x,
										a.id_sloc
									FROM
										gltransjalan AS a
									INNER JOIN masterakun AS b ON a.kd_akun = b.kd_akun
									WHERE
										a.no_bukti = '$no_bukti'
									ORDER BY
										a.no_baris ASC";
		 //echo $query_edit;
		$data['jpen_edit'] = $this->Bis_model->manualQuery($query_edit);
		$this->load->view('Jsesuai_v',$data);
	}

	//Ubah Database
    function edit(){
		$this->load->model('umum/Bis_model');
		set_time_limit(0);

		$now = date('Y-m-d H:i:s');

        $user_login = get_cookie('eklinik');


		$no_bukti = $this->input->post('no_bm');
		$no_bukti_copy = $this->input->post('no_bm_copy');
		$tgl_trans = $this->input->post('tgl_trans');
		$id_plant=$this->input->post('id_plant');
		//$id_sloc=$this->input->post('id_sloc');
		//start rollback commit
		$this->db->trans_begin();

		$sql_hapus_gltransjalan = "DELETE
			FROM gltransjalan
			WHERE no_bukti ='$no_bukti_copy'";
		$this->db->query($sql_hapus_gltransjalan);

		$inserted_count = 0;
		foreach ($this->input->post('rowsBM') as $key => $count ){
			$kd_akun = $this->input->post('x_kode_akun_'.$count);
			$keterangan = $this->input->post('keterangan_'.$count);
			$nilaiDebet = $this->input->post('nilai_debet_'.$count);
			$nilaiKredit = $this->input->post('nilai_kredit_'.$count);

			//$copy_tt = $tt;
			$copy_tt = '';
			$tt = $this->input->post('tt_'.$count);
			if($tt == ''){
				$tt = $copy_tt;
			} else {
				$tt = $tt;
			}

			//$copy_kdp = $kdp;
			$copy_kdp = '';
			$kdp = $this->input->post('kdp_'.$count);
			if($kdp == ''){
				$kdp = $copy_kdp;
			} else {
				$kdp = $kdp;
			}

			//$copy_tp = $tp;
			$copy_tp = '';
			$tp = $this->input->post('tb_'.$count);
			if($tp == ''){
				$tp = $copy_tp;
			} else {
				$tp = $tp;
			}

			$bukti_xcv = substr($no_bukti, 0, 2);
			//,, echo $bukti_xcv;
			if($bukti_xcv == 'BM'){
				$kdjp = "BM";
				$ma = "";
				$di = "BM";
				$jml_transxx = 0;
				$nama_akunxx = '';
				$kd_reklasxx = '';
				//$kdsubunit = $kd_sub_unit_login;
			} else {
				//$copy_ma = $ma;
				$copy_ma = '';
				//$copy_di = $di;
				$copy_di = '';

				$kdjp = 'BM';
				$ma = $this->input->post('ma_'.$count);
				if($ma == ''){
					$ma = $copy_ma;
				} else {
					$ma = $ma;
				}

				$di = $this->input->post('di_'.$count);
				if($di == ''){
					$di = $copy_di;
				} else {
					$di = $di;
				}

				$jml_transxx = $this->input->post('jml_transxx_'.$count);
				$nama_akunxx = $this->input->post('nama_akunxx_'.$count);
				$kd_reklasxx = $this->input->post('kd_reklasxx_'.$count);
				//$id_sloc_x = $this->input->post('kdsubunit_'.$count);

			}

			$query_gl = "INSERT INTO gltransjalan (no_bukti, kd_sub_unit, kd_akun, tgl_trans, modul_asal, tipe_trans,
					keterangan,jml_D, jml_K, del_indek, user_entry, kd_person, jml_trans, no_baris, kd_jp,
					nama_akun, kd_reklas, tipe_bayar,id_sloc,id_plant)
				VALUES  ('$no_bukti','$kdsubunit','$kd_akun','$tgl_trans','$ma','$tt',
					'$keterangan', '$nilaiDebet','$nilaiKredit','$di','$user_login','$kdp','0', '$count', '$kdjp',
					 '$jml_transxx', '$nama_akunxx', '$kd_reklasxx','$id_sloc','$id_plant')";

			$this->db->query($query_gl);

			if($this->db->affected_rows() > 0){
				$inserted_count ++;
			}
		}

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();

			$this->session->set_flashdata('message', 'Gagal Ubah JP.');
            $this->session->set_flashdata('jenis', 'danger');
            redirect(site_url('Jp_2'));
		} else {
			$this->db->trans_commit();
			if($inserted_count >= 1 ){
				$this->session->set_flashdata('message', 'Sukses Simpan JP.');
				$this->session->set_flashdata('jenis', 'success');
				$js_s = site_url('Jp_2/v_edit')."?no_bukti_fil=".$no_bukti;
				redirect($js_s);
			} else {
				$this->session->set_flashdata('message', 'Gagal Simpan JP.');
				$this->session->set_flashdata('jenis', 'danger');
				redirect(site_url('Jp_2'));
			}
		}
	}

	//Delete Database
	function delete_key(){
		$no_bukti = $this->input->get('no_bukti_fil');

		//start rollback commit
		$this->db->trans_begin();

		$sql_hapus_gltransjalan = "DELETE
			FROM gltransjalan
			WHERE no_bukti = '$no_bukti'
				and del_indek = 'BM' ";
		$this->db->query($sql_hapus_gltransjalan);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();

			$this->session->set_flashdata('message', 'Gagal Hapus JP.');
            $this->session->set_flashdata('jenis', 'danger');
            redirect(site_url('Jp_2'));
		} else {
			$this->db->trans_commit();
			$this->session->set_flashdata('message', 'Sukses Hapus JP.');
            $this->session->set_flashdata('jenis', 'success');
            redirect(site_url('Jp_2'));
		}
	}
}
?>
