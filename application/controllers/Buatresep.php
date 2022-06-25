<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Buatresep extends CI_Controller
{
  public $CI = NULL;
	function __construct(){
    parent::__construct();
		$this->load->helper('currency_format_helper');
		$this->CI = & get_instance();
		$this->load->helper(array('url'));
		$this->load->model('umum/Bis_model');
		$this->load->model('umum/Bis_model_ant');
		$this->load->model('Menu_m');
		$this->load->model('Hak_Akses_m');
		$this->load->model('Login_m');
	  $this->load->helper('format_tanggal_helper');
    $this->load->helper('tgl_indo_helper');
    $this->load->model('Model_barcode_item');
    }

  function index()
  {
    $id = get_cookie('eklinik');
    $kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
    $ses_id_jenis=$this->session->userdata('id_jenis'.$id);

    if($ses_id_jenis<3)
    {
      //$dan=" WHERE ms_barang.status_aktif=1";
       $dan="";
    }
    else {
       //$dan=" WHERE detail_ms_barang.kd_sub_unit = '$kd_sub_unit' AND ms_barang.status_aktif=1";
       $dan ="AND
       judul_racikan.kd_sub_unit = '$kd_sub_unit'";

    }

    $query_data="SELECT
                	judul_racikan.no_bukti,
                  judul_racikan.id_barang,
                	judul_racikan.tgl_trans,
                	judul_racikan.jenis_bayar,
                	judul_racikan.jenis_ppn,
                	judul_racikan.diskon,
                	judul_racikan.dpp,
                	judul_racikan.ppn,
                	judul_racikan.grandtotal as total,
                	judul_racikan.entry_user,
                	judul_racikan.entry_date,
                	a.nama AS nama_pegawai,
                	judul_racikan.kd_sub_unit,
                	ms_customer.nama AS nama_customer,
                	ms_customer.id_customer,
                  re.nama_unit,
                  cd.nama_sub_unit
                FROM
                	judul_racikan
                	LEFT JOIN `user` ON judul_racikan.entry_user = `user`.id_user
                	LEFT JOIN ms_pegawai AS a ON `user`.id_pegawai = a.id_pegawai
                	LEFT JOIN mastersubunit AS cd ON judul_racikan.kd_sub_unit = cd.kd_sub_unit
                	LEFT JOIN masterunit AS re ON cd.kd_unit = re.kd_unit
                	LEFT JOIN ms_customer ON judul_racikan.id_customer = ms_customer.id_customer
                  LEFT JOIN ms_barang ON judul_racikan.id_barang = ms_barang.id_barang where judul_racikan.no_po is NULL $dan limit 100";
               //echo $query_data;

            $data=array(
                'title'=>'Daftar Racikan Obat Dengan Resep',
                'xmenu'=>'Reproduksi',
                'xsubmenu'=>'Resep',
                'data_pu'=>$this->Bis_model->manualQuery($query_data),
                'users'=>$this->Hak_Akses_m->get_user($id),
                'menu'=>$this->Menu_m->get_menu($id),
                'submenu'=>$this->Menu_m->get_submenu($id),
            );

            $this->load->view('Buatracikan_view',$data);
          }
          function get_data_item(){
              //$id['id_customer']=$this->input->post('id_customer');
              $id = get_cookie('eklinik');
              $kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
              $searchbarcode=$this->input->post('searchbarcode');

                    $q_data="SELECT
                              ms_barang.id_barang,
                              ms_barang.barcode,
                              detail_ms_barang.hb,
                              detail_ms_barang.hj,
                              ms_barang.nama,
                              ms_barang.satuan,
                              ms_barang.ppn
                              FROM
                              detail_ms_barang
                              INNER JOIN ms_barang ON ms_barang.id_barang = detail_ms_barang.kd_barang
                              WHERE detail_ms_barang.kd_sub_unit='$kd_sub_unit' AND (
                              ms_barang.barcode = '$searchbarcode' OR ms_barang.id_barang='$searchbarcode') LIMIT 1";

              $data['detail_data_item'] = $this->Bis_model->manualQuery($q_data);

              $this->load->view('ajax_detail_item',$data);
          }
          function get_data_jual(){
              //$id['id_customer']=$this->input->post('id_customer');
              $id = get_cookie('eklinik');
              $kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
              $searchbarcode=$this->input->get('searchbarcode');

                    $q_data="SELECT
                                ms_barang.id_barang,
                                ms_barang.nama,
                                ms_barang.barcode,
                                IFNULL(detail_ms_barang.hj,0) as hj,
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
                              WHERE (
                              ms_barang.barcode = '$searchbarcode' OR ms_barang.id_barang='$searchbarcode') LIMIT 1";

              $data['detail_data_jual'] = $this->Bis_model->manualQuery($q_data);

              $this->load->view('ajax_data_jual',$data);


          }
  function get_data_jual_json(){
          $id = get_cookie('eklinik');
          $kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
          $searchbarcode=$this->input->get('searchbarcode');

          $q_data="SELECT
                      ms_barang.id_barang,
                      ms_barang.nama,
                      ms_barang.barcode,
                      IFNULL(detail_ms_barang.hj,0) as hj,
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
                    WHERE (
                    ms_barang.barcode = '$searchbarcode' OR ms_barang.id_barang='$searchbarcode') LIMIT 1";
          $numrows_item = $this->db->query($q_data)->num_rows();
          $data = $this->db->query($q_cari_warga);
				 	foreach($data->result() as $row){
            $prod_name = $row->nama;
            $prod_price = $row->hj;
            $prod_price_2 = $row->satuan;
          }
        $qty=1;
        $response = array(
        'prod_name' => $prod_name,
        'price' => $prod_price,
        'price_2' => $prod_price_2,
        'qty' => $qty,
        );

    echo json_encode($response);
  }
  function baru(){
    $id = get_cookie('eklinik');
    $kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
    $ses_id_jenis=$this->session->userdata('id_jenis'.$id);
    if($ses_id_jenis<3)
    {
      $dan="";
      $dan2="";
    }
    else {
      $dan=" WHERE
      detail_ms_barang.kd_sub_unit = '$kd_sub_unit'";

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
    $query_barang="SELECT
                  CONCAT(mastersubunit.nama_sub_unit,' - ',ms_barang.id_barang,' - ',ms_barang.barcode,' - ',upper(ms_barang.nama)) as ket,
                  ms_barang.id_barang,
                  ms_barang.nama_alias,
                  ms_barang.id_barang,
                  ms_merk.id_merk,
                  ms_merk.nama AS merk,
                  ms_barang.nama AS nama_barang,
                  ms_kategori.id_kategori,
                  ms_kategori.nama AS nama_kategori,
                  ms_status_aktif.nama_status_aktif,
                  ms_status_aktif.id_status_aktif,
                  ms_barang.edit_date,
                  ms_barang.ppn,
                  ms_barang.barcode,
                  ms_barang.status_aktif,
                  ms_barang.keterangan,
                  ms_barang.foto,
                  ms_barang.edit_user,
                  ms_barang.entry_date,
                  ms_barang.entry_user,
                  ms_jenis_barang.id_jenis,
                  ms_jenis_barang.nama AS nama_jenis,
                  ms_satuan.nama AS nama_satuan,
                  ms_barang.id_tipe,
                  ms_tipe.nama AS nama_tipe,
                  detail_ms_barang.kd_barang,
                  detail_ms_barang.hb,
                  detail_ms_barang.hj,
                  detail_ms_barang.perc_margin,
                  detail_ms_barang.margin,
                  detail_ms_barang.max,
                  detail_ms_barang.min,
                  detail_ms_barang.hpp,
                  detail_ms_barang.lokasi,
                  detail_ms_barang.rak,
                  mastersubunit.nama_sub_unit,
                  masterunit.nama_unit,
                  mastersubunit.kd_sub_unit,
                  masterunit.kd_unit
                  FROM
                  ms_barang
                  LEFT JOIN ms_merk ON ms_barang.id_merk = ms_merk.id_merk
                  LEFT JOIN ms_kategori ON ms_barang.id_kategori = ms_kategori.id_kategori
                  LEFT JOIN ms_status_aktif ON ms_barang.status_aktif = ms_status_aktif.id_status_aktif

                  LEFT JOIN ms_jenis_barang ON ms_barang.id_jenis = ms_jenis_barang.id_jenis
                  LEFT JOIN ms_satuan ON ms_barang.satuan = ms_satuan.id_satuan
                  LEFT JOIN ms_tipe ON ms_barang.id_tipe = ms_tipe.id_tipe
                  INNER JOIN detail_ms_barang ON ms_barang.id_barang = detail_ms_barang.kd_barang
                  INNER JOIN mastersubunit ON detail_ms_barang.kd_sub_unit = mastersubunit.kd_sub_unit
                  INNER JOIN masterunit ON mastersubunit.kd_unit = masterunit.kd_unit
                  $dan ";
	  $query_customer="SELECT * from ms_customer";
    //$query_anggota="SELECT * from armaster where status_anggota='Aktif'";


    $data=array(
        'title'=>'Obat Resep',
        'xmenu'=>'Barang Keluar',
        'xsubmenu'=>'Resep',
        'data_customer'=>$this->Bis_model->manualQuery($query_customer),
        //'data_anggota'=>$this->Bis_model->manualQuery($query_anggota),
        'data_barang'=>$this->Bis_model->manualQuery($query_barang),
        'data_sub_unit'=>$this->Bis_model->manualQuery($query_sub_unit),
        'users'=>$this->Hak_Akses_m->get_user(),
        'menu'=>$this->Menu_m->get_menu($id),
        'submenu'=>$this->Menu_m->get_submenu($id),
    );
    $this->load->view('Buatracikan_baru_view',$data);
  }
  function ambil_data(){
    $modul=$this->input->post('modul');
    $id=$this->input->post('id');

    if($modul=="scanbarcode"){
      echo $this->Model_barcode_item->scanbarcode($id);
    }
  }

  function get_data(){
      $npa=$this->input->post('npa');
      $q_data="select * from armaster  WHERE armaster.nama = '$npa'";
      $data['detail_anggota'] = $this->Bis_model->manualQuery($q_data);
      //$this->load->view('ajax_data_customer_pu',$data);
      $this->load->view('ajax_data_anggota_aktif',$data);
  }

  function ambil_edit()
  {
      $id['no_bukti'] = $this->uri->segment(3);
      $no_bukti= $this->uri->segment(3);

      $idx = get_cookie('eklinik');
      $kd_sub_unit=$this->session->userdata('kd_sub_unit'.$idx);
      $ses_id_jenis=$this->session->userdata('id_jenis'.$idx);
      if($ses_id_jenis<3)
      {
        $dan="";
        $dan2="";
      }
      else {
        $dan=" WHERE
        detail_ms_barang.kd_sub_unit = '$kd_sub_unit'";

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

      $query_data="select * from ms_customer";
      $query_edit_cb="SELECT
                    	trans_cb.no_bukti,
                    	trans_cb.tgl_trans,
                    	trans_cb.no_ref,
                    	trans_cb.person,
                    	trans_cb.jml_trans,
                    	trans_cb.tipe_trans,
                    	trans_cb.kd_akun,
                    	trans_cb.modul_asal,
                    	trans_cb.keterangan,
                    	trans_cb.kd_sub_unit,
                    	trans_cb.kd_unit,
                    	trans_cb.`status`,
                    	trans_cb.entry_user,
                    	trans_cb.entry_date,
                    	trans_cb.edit_user,
                    	trans_cb.edit_date
                    FROM
                    	trans_cb
                    WHERE
                    	trans_cb.no_ref = '$no_bukti'";
      $query_data_edit="SELECT
                  	a.nama AS nama_pegawai,
                  	re.nama_unit AS nama_unit_transaksi,
                  	re.kd_unit AS kd_unit_transaksi,
                  	judul_racikan.no_bukti,
                    judul_racikan.id_barang,
                  	judul_racikan.no_po,
                  	judul_racikan.tgl_trans,
                  	judul_racikan.tgl_ed,
                  	judul_racikan.id_pegawai,
                  	judul_racikan.kd_sub_unit,
                  	judul_racikan.id_customer,
                  	judul_racikan.nama_customer,
                  	judul_racikan.alamat_customer,
                  	judul_racikan.jenis_bayar,
                  	judul_racikan.jenis_ppn,
                  	judul_racikan.top,
                  	judul_racikan.keterangan,
                    judul_racikan.subtotal,
                  	judul_racikan.dpp,
                  	judul_racikan.ppn,
                  	judul_racikan.diskon,
                  	judul_racikan.grandtotal,
                    judul_racikan.jml_bayar,
                    judul_racikan.jml_kembali,
                  	judul_racikan.status_pu,
                  	judul_racikan.status_approve,
                  	judul_racikan.user_approve,
                  	judul_racikan.approve_date,
                  	judul_racikan.entry_user,
                  	judul_racikan.entry_date,
                  	judul_racikan.edit_user,
                  	judul_racikan.edit_date,
                  	ms_customer.top,
                    cd.nama_sub_unit
                  FROM
                  	judul_racikan
                  	LEFT JOIN ms_customer ON judul_racikan.id_customer = ms_customer.id_customer
                  	LEFT JOIN `user` ON judul_racikan.entry_user = `user`.id_user
                  	LEFT JOIN ms_pegawai AS a ON `user`.id_pegawai = a.id_pegawai
                  	LEFT JOIN mastersubunit AS cd ON judul_racikan.kd_sub_unit = cd.kd_sub_unit
                  	LEFT JOIN masterunit AS re ON cd.kd_unit = re.kd_unit
                  WHERE
                  	judul_racikan.no_bukti = '$no_bukti'";
      //echo $query_edit_cb;
      $q_detail="SELECT
                detail_racikan.kd_barang,
                detail_racikan.hj as hb,
                detail_racikan.dpp,
                detail_racikan.nilaippn,
                Sum( detail_racikan.qty ) AS qty,
                detail_racikan.diskon,
                detail_racikan.perc_diskon,
                Sum( detail_racikan.total ) AS total,
                detail_racikan.satuan,
                ms_barang.barcode,
                detail_racikan.nama_barang,
                judul_racikan.no_bukti
              FROM
                judul_racikan
                INNER JOIN detail_racikan ON judul_racikan.no_bukti = detail_racikan.no_bukti
                INNER JOIN ms_barang ON detail_racikan.kd_barang = ms_barang.id_barang
              WHERE
                judul_racikan.no_bukti = '$no_bukti'
              GROUP BY
                detail_racikan.kd_barang";

     $data=array(
          'title'=>'Edit Resep',
          'data_customer'=>$this->Bis_model->manualQuery($query_data),
          'menu' => $this->Menu_m->get_menu($idx),
          'submenu' => $this->Menu_m->get_submenu($idx),
          'xmenu'=>'Reproduksi',
          'xsubmenu'=>'Obat Resep',
          'users' => $this->Hak_Akses_m->get_user(),
          'data_edit_cb' => $this->Bis_model->manualQuery($query_edit_cb),
          'data_edit' => $this->Bis_model->manualQuery($query_data_edit),
          'data_detail' => $this->Bis_model->manualQuery($q_detail),
          'data_sub_unit'=>$this->Bis_model->manualQuery($query_sub_unit),
      );

      $this->load->view('Buatracikan_edit_view',$data);
    }


    function tambah()
    {

      $id = get_cookie('eklinik');
      $kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
      $pad_kd_sub_unit = sprintf("%02d", $kd_sub_unit);
      $now = date('Y-m-d H:i:s');
      $date = new DateTime($this->input->post('tgl_produksi'));
      $id_plant = $this->input->post('id_plant');
      $year = $date -> format('Y');
      $month = $date -> format('m');
      $day = $date -> format('d');
      //$kode_bukti=$kode_bayar.$pad_kd_sub_unit.$year.$month;
      $cookie_id_user = get_cookie('eklinik');
      $tipe_trans="M";
      $kode_bukti="RCK".$pad_kd_sub_unit.$year.$month;
      $no_cb=  $kd_sub_unit."-".time();
      $no_bukti= $this->Bis_model->getIdRck($kode_bukti);
      $aktif="1";
      #$no_brg="REG".$year.$month."-";
      #$id_barang=$this->Bis_model->getIdBarang($no_brg);
      $datacb=array(
        'no_bukti'=>$no_cb,
        'tgl_trans'=>$this->input->post('tgl_trans'),
        'no_ref'=>$no_bukti,
        'jml_trans'=>$this->input->post('grandtotal'),
        'tipe_trans'=>$tipe_trans,
        'kd_sub_unit'=>$this->input->post('kd_sub_unit'),
        'modul_asal'=>'SI',
        'keterangan'=>$this->input->post('keterangan'),
        'entry_user'=>$cookie_id_user,
        'entry_date'=>$now,
      );
      $data=array(
        'no_bukti'=>$no_bukti,
        'tgl_trans'=>$this->input->post('tgl_trans'),
        'id_customer'=>$this->input->post('id_customer'),
        'nama_customer'=>$this->input->post('nama_customer'),
        'alamat_customer'=>$this->input->post('alamat_customer'),
        'kd_sub_unit'=>$this->input->post('kd_sub_unit'),
        'jenis_bayar'=>$this->input->post('jenis_bayar'),
        'jenis_ppn'=>$this->input->post('jenis_ppn'),
        'subtotal'=>$this->input->post('subtotal'),
        'grandtotal'=>$this->input->post('grandtotal'),
        'diskon'=>$this->input->post('diskon'),
        'dpp'=>$this->input->post('dpp'),
        'ppn'=>$this->input->post('ppn'),
        'status_aktif'=>$aktif,
        'jml_bayar'=>$this->input->post('jml_bayar'),
        'jml_kembali'=>$this->input->post('jml_kembali'),
        'keterangan'=>$this->input->post('keterangan'),
        'entry_user'=>$cookie_id_user,
        'entry_date'=>$now,
      );

      $data_b=array(
          'id_barang'=>$no_bukti,
          'no_bukti'=>$no_bukti,
          //'id_kategori'=>$this->input->post('id_kategori'),
        #  'id_jenis'=>$this->input->post('id_jenis'),
        #  'id_tipe'=>$this->input->post('id_tipe'),
        #  'id_merk'=>$this->input->post('id_merk'),
          'id_supplier'=>$this->input->post('nama_customer'),
        #  'barcode'=>$this->input->post('barcode'),
          'nama'=>$no_bukti,
          'nama_alias'=>$this->input->post('nama_alias'),
          'harga_beli'=>$this->input->post('grandtotal'),
          'harga_jual'=>$this->input->post('grandtotal'),
        #  'harga_tranfer'=>$this->input->post('harga_tranfer'),
        #  'satuan'=>$this->input->post('id_satuan'),
          'ppn'=>$this->input->post('ppn'),
          'status_aktif'=>$aktif,
        #  'keterangan'=>$this->input->post('keterangan'),
          'entry_user'=>$cookie_id_user,
          'entry_date'=>$now,
      );

      $this->db->trans_off();
      $this->db->trans_begin();
      $this->db->trans_strict(true);
      $this->Bis_model->insertData('judul_racikan',$data);
      $this->Bis_model->insertData('ms_barang',$data_b);
      if ($this->input->post('jenis_bayar')=="TUNAI")
      {
            $this->Bis_model->insertData('trans_cb',$datacb);
      }
      else {
        // code...
      }


  		foreach ($this->input->post('rowsBM') as $key => $count )
      {

          $data=array(
            'no_bukti'=>$no_bukti,
            'kd_barang'=>$this->input->post('id_barang_'.$count),
            'no_row'=>$this->input->post('no_row_'.$count),
            'hj'=>$this->input->post('hb_'.$count),
            'dpp'=>$this->input->post('dpp_'.$count),
            'nilaippn'=>$this->input->post('nilaippn_'.$count),
            'qty'=>$this->input->post('qty_'.$count),
            'nama_barang'=>$this->input->post('nama_barang_'.$count),
            'diskon'=>$this->input->post('diskon_'.$count),
            'perc_diskon'=>$this->input->post('perc_diskon_'.$count),
            'total'=>$this->input->post('total_'.$count),
            'satuan'=>$this->input->post('satuan_'.$count),
          );
          $data_in=array(
            'no_bukti'=>$no_bukti,
            'tgl_trans'=>$this->input->post('tgl_trans'),
            'kd_barang'=>$this->input->post('id_barang_'.$count),
            'no_row'=>$this->input->post('no_row_'.$count),
            'harga'=>$this->input->post('hb_'.$count),
            'hpp'=>$this->input->post(''),
            'qty'=>-1*$this->input->post('qty_'.$count),
            'nama_barang'=>$this->input->post('nama_barang_'.$count),
            'total'=>$this->input->post('total_'.$count),
            'satuan'=>$this->input->post('satuan_'.$count),
            'modul_asal'=>'PU',
            'kd_sub_unit'=>$this->input->post('kd_sub_unit'),

          );

          $this->Bis_model->insertData('detail_racikan',$data);
          $this->Bis_model->insertData('in_trans',$data_in);
          //$this->Bis_model->insertData('detail_ms_barang',$data_d);
      }
      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE)
      {
              $this->db->trans_rollback();
              $this->session->set_flashdata('message', 'Gagal input data produksi.');
              $this->session->set_flashdata('jenis', 'danger');
              $this->session->set_flashdata('no_penjuaan', $no_bukti);
              redirect(site_url('Buatresep'));
      }
      else
      {
              $this->db->trans_commit();
              $this->session->set_flashdata('message', 'Sukses tambah data baru.');
              $this->session->set_flashdata('jenis', 'success');
              $this->session->set_flashdata('no_penjuaan', $no_bukti);
              redirect(site_url('Buatresep/cetak/'.$no_bukti));
              redirect(site_url('Buatresep'));
      }
      }
      function simpan_resep()
      {

        $id = get_cookie('eklinik');
        $kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
        $pad_kd_sub_unit = sprintf("%02d", $kd_sub_unit);
        $now = date('Y-m-d H:i:s');
        $date = new DateTime($this->input->post('tgl_produksi'));
        $id_plant = $this->input->post('id_plant');
        $year = $date -> format('Y');
        $month = $date -> format('m');
        $day = $date -> format('d');
        //$kode_bukti=$kode_bayar.$pad_kd_sub_unit.$year.$month;
        $cookie_id_user = get_cookie('eklinik');
        $tipe_trans="M";
        $kode_bukti="RCK".$pad_kd_sub_unit.$year.$month;
        $no_cb=  $kd_sub_unit."-".time();
        $no_bukti= $this->Bis_model->getIdRck($kode_bukti);

        $idresep['no_bukti'] = $this->input->post('no_ref');
        $idrm['no_wo'] = $this->input->post('no_rm');

        $tipe_wo=$this->input->post('tipe_wo');

        $jenis_bayar=$this->input->post('jenis_bayar');
        //echo $tipe_wo;
        $datacb=array(
          'no_bukti'=>$no_cb,
          'tgl_trans'=>$this->input->post('tgl_trans'),
          //'no_ppd'=>$this->input->post('no_si'),
          'no_ref'=>$no_bukti,
          //'person'=>$this->input->post('id_customer'),
          'jml_trans'=>$this->input->post('grandtotal'),
          'tipe_trans'=>$tipe_trans,
          'kd_sub_unit'=>$this->input->post('kd_sub_unit'),
          //'kd_akun'=>$this->input->post('id_bank_fil'),
          //'kd_akun_gl'=>$this->input->post('kd_akun_gl'),
          'modul_asal'=>'RSP',
          'keterangan'=>$this->input->post('keterangan'),
          'entry_user'=>$cookie_id_user,
          'entry_date'=>$now,
        );
        $data=array(
          'no_bukti'=>$no_bukti,
          'tgl_trans'=>$this->input->post('tgl_trans'),
          'id_customer'=>$this->input->post('id_customer'),
          'nama_customer'=>$this->input->post('nama_customer'),
          'alamat_customer'=>$this->input->post('alamat_customer'),
          'dokter'=>$this->input->post('nama_dokter'),
          'kd_sub_unit'=>$this->input->post('kd_sub_unit'),
          //'kd_sub_unit_anggota'=>$this->input->post('kd_sub_unit'),
          //'id_slock'=>$this->input->post('id_slock'),
          //'id_plant'=>$this->input->post('id_plant'),
          'jenis_bayar'=>$this->input->post('jenis_bayar'),
          //'top'=>$this->input->post('top'),
          'jenis_ppn'=>$this->input->post('jenis_ppn'),
          'no_ref'=>$this->input->post('no_ref'),
          'subtotal'=>$this->input->post('subtotal'),
          'grandtotal'=>$this->input->post('grandtotal'),
          'diskon'=>$this->input->post('diskon'),
          'dpp'=>$this->input->post('dpp'),
          'ppn'=>$this->input->post('ppn'),
          'jml_bayar'=>$this->input->post('jml_bayar'),
          'jml_kembali'=>$this->input->post('jml_kembali'),
          //'total'=>$this->input->post('grandtotal'),
          //'voucher'=>$this->input->post('voucher'),
          //'dp'=>$this->input->post('dp'),
          //'ar'=>$this->input->post('ar'),
          //'jml_cicilan'=>$this->input->post('jml_cicilan'),
          'keterangan'=>$this->input->post('keterangan'),
          'entry_user'=>$cookie_id_user,
          'entry_date'=>$now,
        );
        $dataedit=array(
           'status'=>1,
        );
        $dataeditstatusrm=array(
           'status_resep'=>2,
        );
        $this->db->trans_off();
        $this->db->trans_begin();
        $this->db->trans_strict(true);
        $this->Bis_model->insertData('judul_racikan',$data);
        $this->Bis_model->updateData('judul_ro',$dataedit,$idresep);
        $this->Bis_model->updateData('trans_wo',$dataeditstatusrm,$idrm);

        if ($tipe_wo = 1 and $jenis_bayar=="TUNAI")
        {
              $this->Bis_model->insertData('trans_cb',$datacb);
        }
        else {
          // code...
        }


    		foreach ($this->input->post('rowsBM') as $key => $count )
        {

            $data=array(
              'no_bukti'=>$no_bukti,
              'kd_barang'=>$this->input->post('id_barang_'.$count),
              'no_row'=>$this->input->post('no_row_'.$count),
              'hj'=>$this->input->post('hb_'.$count),
              'dpp'=>$this->input->post('dpp_'.$count),
              'nilaippn'=>$this->input->post('nilaippn_'.$count),
              'qty'=>$this->input->post('qty_'.$count),
              'nama_barang'=>$this->input->post('nama_barang_'.$count),
              'diskon'=>$this->input->post('diskon_'.$count),
              'perc_diskon'=>$this->input->post('perc_diskon_'.$count),
              'total'=>$this->input->post('total_'.$count),
              'satuan'=>$this->input->post('satuan_'.$count),
            );
            $data_in=array(
              'no_bukti'=>$no_bukti,
              'tgl_trans'=>$this->input->post('tgl_trans'),
              'kd_barang'=>$this->input->post('id_barang_'.$count),
              'no_row'=>$this->input->post('no_row_'.$count),
              'harga'=>$this->input->post('hb_'.$count),
              'hpp'=>$this->input->post(''),
              'qty'=>-1*$this->input->post('qty_'.$count),
              'nama_barang'=>$this->input->post('nama_barang_'.$count),
              'total'=>$this->input->post('total_'.$count),
              'satuan'=>$this->input->post('satuan_'.$count),
              'modul_asal'=>'PU',
              'kd_sub_unit'=>$this->input->post('kd_sub_unit'),

            );
            $this->Bis_model->insertData('detail_racikan',$data);
            $this->Bis_model->insertData('in_trans',$data_in);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                $this->session->set_flashdata('message', 'Gagal input data produksi.');
                $this->session->set_flashdata('jenis', 'danger');
                $this->session->set_flashdata('no_penjuaan', $no_bukti);
                redirect(site_url('Buatresep'));
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses tambah data baru.');
                $this->session->set_flashdata('jenis', 'success');
                $this->session->set_flashdata('no_penjuaan', $no_bukti);
                redirect(site_url('Buatresep'));
        }
        }

      function simpan_edit()
      {
        $cookie_id_user = get_cookie('eklinik');
        $now = date('Y-m-d H:i:s');
        $date = new DateTime($this->input->post('tgl_produksi'));
        $kd_sub_unit=$this->session->userdata('kd_sub_unit'.$cookie_id_user);

        $id['no_bukti'] = $this->input->post('no_bukti');
        $idcb['no_bukti'] = $this->input->post('no_cb');
        $no_edit_cb = $this->input->post('no_cb');
        $no_bukti= $this->input->post('no_bukti');
        $tipe_trans="M";
        $jenis_bayar=$this->input->post('jenis_bayar');
        $no_cb=  $kd_sub_unit."-".time();
        $dataeditcb=array(
          //'no_bukti'=>$no_kb,
          'tgl_trans'=>$this->input->post('tgl_trans'),
          //'no_ppd'=>$this->input->post('no_si'),
          'no_ref'=>$no_bukti,
          'status'=>$this->input->post(''),
          'jml_trans'=>$this->input->post('grandtotal'),
          'tipe_trans'=>$tipe_trans,
          'kd_sub_unit'=>$this->input->post('kd_sub_unit'),
          //'kd_akun'=>$this->input->post('id_bank_fil'),
          //'kd_akun_gl'=>$this->input->post('kd_akun_gl'),
          'modul_asal'=>'SI',
          //'keterangan'=>$keterangan,
          'edit_user'=>$cookie_id_user,
          'edit_date'=>$now,
        );

        $datacb=array(
          'no_bukti'=>$no_cb,
          'tgl_trans'=>$this->input->post('tgl_trans'),
          //'no_ppd'=>$this->input->post('no_si'),
          'no_ref'=>$no_bukti,
          'status'=>$this->input->post(''),
          'jml_trans'=>$this->input->post('grandtotal'),
          'tipe_trans'=>$tipe_trans,
          'kd_sub_unit'=>$this->input->post('kd_sub_unit'),
          //'kd_akun'=>$this->input->post('id_bank_fil'),
          //'kd_akun_gl'=>$this->input->post('kd_akun_gl'),
          'modul_asal'=>'SI',
          //'keterangan'=>$keterangan,
          'entry_user'=>$cookie_id_user,
          'entry_date'=>$now,
        );
        $data=array(
          //'no_bukti'=>$no_bukti,
          'tgl_trans'=>$this->input->post('tgl_trans'),
          'id_customer'=>$this->input->post('id_customer'),
          'nama_customer'=>$this->input->post('nama_customer'),
          'alamat_customer'=>$this->input->post('alamat_customer'),
          //'id_sales'=>$this->input->post('id_sales'),
          'kd_sub_unit'=>$this->input->post('kd_sub_unit'),
          //'kd_sub_unit_anggota'=>$this->input->post('kd_sub_unit'),
          //'id_slock'=>$this->input->post('id_slock'),
          //'id_plant'=>$this->input->post('id_plant'),
          'jenis_bayar'=>$this->input->post('jenis_bayar'),
          //'top'=>$this->input->post('top'),
          'jenis_ppn'=>$this->input->post('jenis_ppn'),
          //'no_ref'=>$this->input->post('no_ref'),
          'subtotal'=>$this->input->post('subtotal'),
          'grandtotal'=>$this->input->post('grandtotal'),
          'diskon'=>$this->input->post('diskon'),
          'dpp'=>$this->input->post('dpp'),
          'ppn'=>$this->input->post('ppn'),
          'jml_bayar'=>$this->input->post('jml_bayar'),
          'jml_kembali'=>$this->input->post('jml_kembali'),
          //'total'=>$this->input->post('grandtotal'),
          //'voucher'=>$this->input->post('voucher'),
          //'dp'=>$this->input->post('dp'),
          //'ar'=>$this->input->post('ar'),
          //'jml_cicilan'=>$this->input->post('jml_cicilan'),
          'keterangan'=>$this->input->post('keterangan'),
          'edit_user'=>$cookie_id_user,
          'edit_date'=>$now,
        );

        $this->db->trans_off();
        $this->db->trans_begin();
        $this->db->trans_strict(true);
        $this->Bis_model->updateData('judul_racikan',$data,$id);
        $this->Bis_model->deleteData('detail_racikan',$id);
        $this->Bis_model->deleteData('in_trans',$id);
        //$this->Bis_model->deleteData('trans_cb',$idcb);
        if ($jenis_bayar=="TUNAI")
        {
          if (!empty($no_edit_cb))
          {
            $this->Bis_model->updateData('trans_cb',$dataeditcb,$idcb);
          }
          else {
            $this->Bis_model->insertData('trans_cb',$datacb);
          }


        }
        else {
              $this->Bis_model->deleteData('trans_cb',$idcb);
        }


        foreach ($this->input->post('rowsBM') as $key => $count )
        {

            $data=array(
              'no_bukti'=>$no_bukti,
              'kd_barang'=>$this->input->post('id_barang_'.$count),
              'no_row'=>$this->input->post('no_row_'.$count),
              'hj'=>$this->input->post('hb_'.$count),
              'dpp'=>$this->input->post('dpp_'.$count),
              'nilaippn'=>$this->input->post('nilaippn_'.$count),
              'qty'=>$this->input->post('qty_'.$count),
              'nama_barang'=>$this->input->post('nama_barang_'.$count),
              'diskon'=>$this->input->post('diskon_'.$count),
              'perc_diskon'=>$this->input->post('perc_diskon_'.$count),
              'total'=>$this->input->post('total_'.$count),
              'satuan'=>$this->input->post('satuan_'.$count),
            );
            $data_in=array(
              'no_bukti'=>$no_bukti,
              'tgl_trans'=>$this->input->post('tgl_trans'),
              'kd_barang'=>$this->input->post('id_barang_'.$count),
              'no_row'=>$this->input->post('no_row_'.$count),
              'harga'=>$this->input->post('hb_'.$count),
              'hpp'=>$this->input->post(''),
              'qty'=>$this->input->post('qty_'.$count),
              'nama_barang'=>$this->input->post('nama_barang_'.$count),
              'total'=>$this->input->post('total_'.$count),
              'satuan'=>$this->input->post('satuan_'.$count),
              'modul_asal'=>'PU',
              'kd_sub_unit'=>$this->input->post('kd_sub_unit'),

            );
            $this->Bis_model->insertData('detail_racikan',$data);
            $this->Bis_model->insertData('in_trans',$data_in);

        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                $this->session->set_flashdata('message', 'Gagal input data produksi.');
                $this->session->set_flashdata('jenis', 'danger');
                redirect(site_url('Buatresep'));
                redirect(site_url('/').'pos/view_invoice?id='.$order_id, 'refresh');
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses tambah data baru.');
                $this->session->set_flashdata('jenis', 'success');
                //redirect(site_url('Buatracikan'));
                redirect(site_url('/').'Buatresep/cetak/'.$no_bukti, 'refresh');
        }
        }

  function hapus()
  {
    $id['no_bukti'] = $this->uri->segment(3);
    $idcb['no_ref'] = $this->uri->segment(3);
    $this->db->trans_begin();
    $this->Bis_model->deleteData('judul_racikan',$id);
    $this->Bis_model->deleteData('detail_racikan',$id);
    $this->Bis_model->deleteData('in_trans',$id);
    $this->Bis_model->deleteData('trans_cb',$idcb);
    $this->Bis_model->deleteData('ms_barang',$id);
    if ($this->db->trans_status() === FALSE)
    {
            $this->db->trans_rollback();
    }
    else
    {
            $this->db->trans_commit();
            $this->session->set_flashdata('message', 'Sukses delete.');
            $this->session->set_flashdata('jenis', 'danger');
            redirect(site_url('Buatresep'));
    }
  }

function cetak()
    {
      $id['no_bukti'] = $this->uri->segment(3);
      $no_bukti=$this->uri->segment(3);
      $id = get_cookie('eklinik');

 	    $query_data="SELECT
                  	a.nama AS nama_pegawai,
                  	re.nama_unit AS nama_unit_transaksi,
                  	re.kd_unit AS kd_unit_transaksi,
                  	judul_racikan.no_bukti,
                  	judul_racikan.no_po,
                  	judul_racikan.tgl_trans,
                  	judul_racikan.tgl_ed,
                  	judul_racikan.id_pegawai,
                  	judul_racikan.kd_sub_unit,
                  	judul_racikan.id_customer,
                  	judul_racikan.nama_customer,
                  	judul_racikan.alamat_customer,
                  	judul_racikan.jenis_bayar,
                  	judul_racikan.jenis_ppn,
                  	judul_racikan.top,
                  	judul_racikan.keterangan,
                  	judul_racikan.dpp,
                  	judul_racikan.ppn,
                    judul_racikan.jml_bayar,
                    judul_racikan.jml_kembali,
                  	judul_racikan.diskon,
                    judul_racikan.subtotal,
                  	judul_racikan.grandtotal,
                  	judul_racikan.status_pu,
                  	judul_racikan.status_approve,
                  	judul_racikan.user_approve,
                  	judul_racikan.approve_date,
                  	judul_racikan.entry_user,
                  	judul_racikan.entry_date,
                  	judul_racikan.edit_user,
                  	judul_racikan.edit_date,
                  	ms_customer.top
                  FROM
                  	judul_racikan
                  	LEFT JOIN ms_customer ON judul_racikan.id_customer = ms_customer.id_customer
                  	LEFT JOIN `user` ON judul_racikan.entry_user = `user`.id_user
                  	LEFT JOIN ms_pegawai AS a ON `user`.id_pegawai = a.id_pegawai
                  	LEFT JOIN mastersubunit AS cd ON judul_racikan.kd_sub_unit = cd.kd_sub_unit
                  	LEFT JOIN masterunit AS re ON cd.kd_unit = re.kd_unit
                  WHERE
                  	judul_racikan.no_bukti = '$no_bukti'";
       //echo($query_data);
                      //$query_driver="SELECT * from ms_pegawai where id_jabatan=40";

            $q_detail="SELECT
                    	detail_racikan.kd_barang,
                    	detail_racikan.hj,
                    	detail_racikan.dpp,
                    	detail_racikan.nilaippn,
                    	Sum( detail_racikan.qty ) AS qty,
                    	detail_racikan.diskon,
                    	detail_racikan.perc_diskon,
                    	Sum( detail_racikan.total ) AS total,
                    	detail_racikan.satuan,
                    	ms_barang.barcode,
                    	detail_racikan.nama_barang,
                    	judul_racikan.no_bukti
                    FROM
                    	judul_racikan
                    	INNER JOIN detail_racikan ON judul_racikan.no_bukti = detail_racikan.no_bukti
                    	INNER JOIN ms_barang ON detail_racikan.kd_barang = ms_barang.id_barang
                    WHERE
                    	judul_racikan.no_bukti = '$no_bukti'
                    GROUP BY
                    	detail_racikan.kd_barang";

	    $data['data_pos'] = $this->Bis_model->manualQuery($query_data);
      $data['detail_pos'] = $this->Bis_model->manualQuery($q_detail);

      $data['users'] = $this->Hak_Akses_m->get_user();
      $data['menu'] = $this->Menu_m->get_menu($id);
      $data['submenu'] = $this->Menu_m->get_submenu($id);
      //$this->load->view('report/CetakBuatracikan2',$data);
      $this->load->view('report/Cetakrck',$data);
    }

    function cetak_penawaran()
        {
          $id['no_bukti'] = $this->uri->segment(3);
          $no_bukti=$this->uri->segment(3);
          $id = get_cookie('eklinik');
          $this->load->model('Menu_m');
          $this->load->model('Hak_Akses_m');
          $this->load->model('Login_m');
     	    $query_data="SELECT
                      judul_racikan.no_bukti,
                      judul_racikan.tgl_trans,
                      judul_racikan.id_pegawai,
                      judul_racikan.id_unit,
                      judul_racikan.id_slock,
                      judul_racikan.keterangan,
                      judul_racikan.status_pu,
                      judul_racikan.status_approve,
                      judul_racikan.user_approve,
                      judul_racikan.approve_date,
                      judul_racikan.no_spp,
                      ms_pegawai.nama AS user_entry,
                      ms_slock.nama AS slock,
                      ms_plant.nama AS nama_plant,
                      p1.nama AS nama_pegawai
    FROM
                      judul_racikan
                      LEFT JOIN judul_spb ON judul_racikan.no_spp = judul_spb.no_bukti
                      INNER JOIN `user` ON judul_racikan.entry_user = `user`.id_user
                      INNER JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
                      INNER JOIN ms_slock ON judul_racikan.id_slock = ms_slock.id_slock
                      INNER JOIN ms_plant ON ms_slock.id_plant = ms_plant.id_plant
                      INNER JOIN ms_pegawai AS p1 ON judul_racikan.id_pegawai = p1.id_pegawai

                          WHERE
                          judul_racikan.no_bukti = '$no_bukti'


                          ";
              //echo($query_data);
                          //$query_driver="SELECT * from ms_pegawai where id_jabatan=40";
              $q_detail="SELECT
    judul_racikan.no_bukti,
    detail_racikan.kd_barang,
    ms_barang.nama AS nama_barang,
    detail_racikan.qty,
    detail_racikan.hb as harga_beli,
    ms_barang.part_number
    FROM
                          detail_racikan
                          INNER JOIN judul_racikan ON judul_racikan.no_bukti = detail_racikan.no_bukti
                          INNER JOIN ms_barang ON detail_racikan.kd_barang = ms_barang.id_barang

                          WHERE
                          judul_racikan.no_bukti = '$no_bukti'";

    	  $data['data_pu'] = $this->Bis_model->manualQuery($query_data);
          $data['detail_racikan'] = $this->Bis_model->manualQuery($q_detail);

          $data['users'] = $this->Hak_Akses_m->get_user();
          $data['menu'] = $this->Menu_m->get_menu($id);
          $data['submenu'] = $this->Menu_m->get_submenu($id);
          $this->load->view('report/Cetakpopenawaran',$data);
        }

  function exportexcel()
  {

    $this->load->model('idh/IDH_m');
    $data['idh'] = $this->IDH_m->get_data_hauling();
    $this->load->view('Karyawan_export',$data);
  }
}
?>