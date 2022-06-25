<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utama extends CI_Controller
{
  function __construct(){
        parent::__construct();
        $this->load->model('umum/Bis_model');
        $this->load->model('Menu_m');
        $this->load->model('Hak_Akses_m');
        $this->load->model('Login_m');
        $this->load->helper('currency_format_helper');
    }
  function index()
  {
      $id = get_cookie('eklinik');
      $kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
      $ses_id_jenis=$this->session->userdata('id_jenis'.$id);
      if($ses_id_jenis<3)
      {
        //$dan=" WHERE ms_barang.status_aktif=1";
        $dan=" WHERE ms_barang.status_aktif=1";
      }
      else {
         $dan=" WHERE detail_ms_barang.kd_sub_unit = '$kd_sub_unit' AND ms_barang.status_aktif=1";
        //$dan=" WHERE ms_barang.status_aktif=1";
      }
      $query_obat="SELECT
                    	Count( detail_ms_barang.kd_barang ) AS jml
                    FROM
                    	detail_ms_barang
                    	INNER JOIN ms_barang ON detail_ms_barang.kd_barang = ms_barang.id_barang $dan ";
      $query_anggota="SELECT
                      	COUNT( ms_pasien.no_register ) AS jml
                      FROM
                      	ms_pasien
                      WHERE
                      	ms_pasien.id_status_aktif = 1";
      $query_px="SELECT
                     COUNT( ms_pasien.no_register ) AS jml
                     FROM
                     ms_pasien";
      $query_wo="SELECT
                	Count( trans_wo.no_wo ) AS jml
                FROM
                	trans_wo";
      $query_data="SELECT
            u.id_user,
            u.email,
            u.`password`,
            u.id_jabatan,
            ms_jabatan.nama as nama_jabatan
            FROM
            `user` AS u
            INNER JOIN ms_pegawai ON u.id_pegawai = ms_pegawai.id_pegawai
            INNER JOIN ms_jabatan ON ms_pegawai.id_jabatan = ms_jabatan.id_jabatan
            WHERE
            u.id_user = '$id'";
     $query_chart_kelamin="SELECT
                          	Count( ms_pasien.no_register ) AS jumlah,
                          	ms_pasien.jk
                          FROM
                          	ms_pasien
                          GROUP BY
                          	ms_pasien.jk
                          ORDER BY
                          	ms_pasien.jk ASC";
              $query_jenis_chart="SELECT
                        	Count( ms_pasien.no_register ) AS jumlah,
                        	ms_jenis_pasien.nama AS nama_jenis_pasien
                        FROM
                        	ms_pasien
                        	LEFT JOIN ms_jenis_pasien ON ms_pasien.id_jenis_pasien = ms_jenis_pasien.id_jenis_pasien
                        GROUP BY
                        	ms_pasien.id_jenis_pasien
                        ORDER BY
                        	ms_pasien.jk ASC";
            $query_kunjungan_chart="SELECT
                        	ms_poli.nama_poli,
                        	Count( trans_wo.no_wo ) as jumlah
                        FROM
                        	trans_wo
                        	LEFT JOIN ms_poli ON trans_wo.id_poli = ms_poli.id_poli
                        GROUP BY
                        	ms_poli.nama_poli";
            $query_kun="SELECT
                        	defTab.bulan,
                        	sum( defTab.jumlah_umum ) AS 'poli_umum',
                        	sum( defTab.jumlah_gigi ) AS 'poli_gigi'
                        FROM
                        	(
                        	SELECT MONTH
                        		( trans_wo.tgl_masuk ) AS bulan,
                        		Count( trans_wo.no_wo ) AS jumlah_umum,
                        		0 AS jumlah_gigi
                        	FROM
                        		trans_wo
                        		INNER JOIN ms_poli ON trans_wo.id_poli = ms_poli.id_poli
                        	WHERE
                        		trans_wo.id_poli = 1
                        		AND YEAR ( trans_wo.tgl_masuk ) = YEAR ( now( ) )
                        	GROUP BY
                        		trans_wo.id_poli,
                        		MONTH(trans_wo.tgl_masuk) UNION ALL
                        	SELECT MONTH
                        		( trans_wo.tgl_masuk ) AS bulan,
                        		0 AS jumlah_umum,
                        		Count( trans_wo.no_wo ) AS jumlah_gigi
                        	FROM
                        		trans_wo
                        		INNER JOIN ms_poli ON trans_wo.id_poli = ms_poli.id_poli
                        	WHERE
                        		trans_wo.id_poli = 2
                        		AND YEAR ( trans_wo.tgl_masuk ) = YEAR ( now( ) )
                        	GROUP BY
                        		trans_wo.id_poli,
                        		MONTH(trans_wo.tgl_masuk)
                        	) AS defTab
                        GROUP BY
                        	defTab.bulan";

            $query_chart_jml_jk="SELECT
                                  	defTab.bulan,
                                  	Sum( defTab.jumlah_laki ) AS lk,
                                  	sum( defTab.jumlah_perempuan ) AS pr
                                  FROM
                                  	(
                                  	SELECT MONTH
                                  		( trans_wo.tgl_masuk ) AS bulan,
                                  		Count( ms_pasien.jk ) AS jumlah_perempuan,
                                  		0 AS jumlah_laki
                                  	FROM
                                  		trans_wo
                                  		INNER JOIN ms_pasien ON trans_wo.no_register_px = ms_pasien.no_register
                                  	WHERE
                                  		ms_pasien.jk = 'P'
                                  		AND YEAR ( trans_wo.tgl_masuk ) = YEAR ( now( ) )
                                  	GROUP BY
                                  		ms_pasien.jk,
                                  		MONTH ( trans_wo.tgl_masuk ) UNION ALL
                                  	SELECT MONTH
                                  		( trans_wo.tgl_masuk ) AS bulan,
                                  		0 AS jumlah_perempuan,
                                  		Count( ms_pasien.jk ) AS jumlah_laki
                                  	FROM
                                  		trans_wo
                                  		INNER JOIN ms_pasien ON trans_wo.no_register_px = ms_pasien.no_register
                                  	WHERE
                                  		ms_pasien.jk = 'L'
                                  		AND YEAR ( trans_wo.tgl_masuk ) = YEAR ( now( ) )
                                  	GROUP BY
                                  		ms_pasien.jk,
                                  		MONTH ( trans_wo.tgl_masuk )
                                  	) AS defTab
                                  GROUP BY
                                  	defTab.bulan";
            //$data['data_chart_y'] = $this->Bis_model->manualQuery($query_chart_year);
            $data=array(
                    'perintah'=>'Baru',
                    'title'=>'Daftar Kunjungan',
                    'title_filter'=>'Cari Kunjungan',
                    'title_tambah'=>'Input Kunjungan',
                    'title_report'=>'Laporan Kunjungan',
                    'title_penduduk'=>'Data Pasien Terdaftar',
                    'data_profil' => $this->Bis_model->manualQuery($query_data),
                    'data_kapitasi' => $this->Bis_model->manualQuery($query_anggota),
                    'data_px' => $this->Bis_model->manualQuery($query_px),
                    'data_obat' => $this->Bis_model->manualQuery($query_obat),
                    'data_wo' => $this->Bis_model->manualQuery($query_wo),
                    'data_jk' => $this->Bis_model->manualQuery($query_chart_kelamin),
                    'data_jenis_pasien' => $this->Bis_model->manualQuery($query_jenis_chart),
                    'data_kunjungan' => $this->Bis_model->manualQuery($query_kunjungan_chart),
                    'data_kun' => $this->Bis_model->manualQuery($query_kun),
                    'data_jk_bulanan' => $this->Bis_model->manualQuery($query_chart_jml_jk),
                    'users'=>$this->Hak_Akses_m->get_user($id),
                    'menu'=>$this->Menu_m->get_menu($id),
                    'submenu'=>$this->Menu_m->get_submenu($id),
             );



      $this->load->view('home',$data);
      //$this->load->view('laporan/viewsetoranbasad_opsi',$data);
  }
}
?>
