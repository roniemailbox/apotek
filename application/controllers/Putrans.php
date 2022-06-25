<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Putrans extends CI_Controller
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
       judul_pu.kd_sub_unit = '$kd_sub_unit'";

    }
    $query_jml_pu="SELECT
                  Count( judul_pu.no_bukti ) AS jml
                FROM
                  judul_pu
                  WHERE judul_pu.no_bukti IS NOT NULL AND judul_pu.no_po is NULL $dan";
    $query_data="SELECT
                	judul_pu.no_bukti,
                	judul_pu.tgl_trans,
                	judul_pu.jenis_bayar,
                	judul_pu.jenis_ppn,
                	judul_pu.diskon,
                	judul_pu.dpp,
                	judul_pu.ppn,
                	judul_pu.grandtotal as total,
                	judul_pu.entry_user,
                	judul_pu.entry_date,
                	a.nama AS nama_pegawai,
                	judul_pu.kd_sub_unit,
                	ms_supplier.nama AS nama_supplier,
                	ms_supplier.id_supplier,
                  re.nama_unit,
                  cd.nama_sub_unit
                FROM
                	judul_pu
                	LEFT JOIN `user` ON judul_pu.entry_user = `user`.id_user
                	LEFT JOIN ms_pegawai AS a ON `user`.id_pegawai = a.id_pegawai
                	LEFT JOIN mastersubunit AS cd ON judul_pu.kd_sub_unit = cd.kd_sub_unit
                	LEFT JOIN masterunit AS re ON cd.kd_unit = re.kd_unit
                	LEFT JOIN ms_supplier ON judul_pu.id_supplier = ms_supplier.id_supplier
                  where judul_pu.no_po is NULL $dan limit 100";
                 //echo $query_data;

            $data=array(
                'title'=>'Data Pembelian',
                'xmenu'=>'Barang Masuk',
                'xsubmenu'=>'Pembelian (Non PO)',
                'data_pu'=>$this->Bis_model->manualQuery($query_data),
                'jml_pu' => $this->Bis_model->manualQuery($query_jml_pu),
                'users'=>$this->Hak_Akses_m->get_user($id),
                'menu'=>$this->Menu_m->get_menu($id),
                'submenu'=>$this->Menu_m->get_submenu($id),
            );

            $this->load->view('Putrans_view',$data);
          }

          function filter()
          {
            $id = get_cookie('eklinik');
            $kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
            $ses_id_jenis=$this->session->userdata('id_jenis'.$id);
            $filter=$this->input->post('katakunci');
            //$filter=5;
            if($ses_id_jenis<3)
            {
              //$dan=" WHERE ms_barang.status_aktif=1";
               $dan="";
            }
            else {
               //$dan=" WHERE detail_ms_barang.kd_sub_unit = '$kd_sub_unit' AND ms_barang.status_aktif=1";
               $dan ="AND
               judul_pu.kd_sub_unit = '$kd_sub_unit'";

            }
            $query_jml_pu="SELECT
                          Count( judul_pu.no_bukti ) AS jml
                        FROM
                          judul_pu
                          WHERE judul_pu.no_bukti IS NOT NULL AND judul_pu.no_po is NULL $dan";
            $query_data="SELECT
                        	judul_pu.no_bukti,
                        	judul_pu.tgl_trans,
                        	judul_pu.jenis_bayar,
                        	judul_pu.jenis_ppn,
                        	judul_pu.diskon,
                        	judul_pu.dpp,
                        	judul_pu.ppn,
                        	judul_pu.grandtotal as total,
                        	judul_pu.entry_user,
                        	judul_pu.entry_date,
                        	a.nama AS nama_pegawai,
                        	judul_pu.kd_sub_unit,
                        	ms_supplier.nama AS nama_supplier,
                        	ms_supplier.id_supplier,
                          re.nama_unit,
                          cd.nama_sub_unit
                        FROM
                        	judul_pu
                        	LEFT JOIN `user` ON judul_pu.entry_user = `user`.id_user
                        	LEFT JOIN ms_pegawai AS a ON `user`.id_pegawai = a.id_pegawai
                        	LEFT JOIN mastersubunit AS cd ON judul_pu.kd_sub_unit = cd.kd_sub_unit
                        	LEFT JOIN masterunit AS re ON cd.kd_unit = re.kd_unit
                        	LEFT JOIN ms_supplier ON judul_pu.id_supplier = ms_supplier.id_supplier
                          where judul_pu.no_po is NULL $dan
                          AND (judul_pu.no_bukti like '%$filter%' OR ms_supplier.nama like '%$filter%' OR cd.nama_sub_unit like '%$filter%' OR a.nama like '%$filter%')
                          limit 100";
                     //echo $query_data;

                    $data=array(
                        'title'=>'Data Pembelian',
                        'xmenu'=>'Barang Masuk',
                        'xsubmenu'=>'Pembelian (Non PO)',
                        'data_pu'=>$this->Bis_model->manualQuery($query_data),
                        'jml_pu' => $this->Bis_model->manualQuery($query_jml_pu),
                        'users'=>$this->Hak_Akses_m->get_user($id),
                        'menu'=>$this->Menu_m->get_menu($id),
                        'submenu'=>$this->Menu_m->get_submenu($id),
                    );

                    $this->load->view('Putrans_view',$data);
                  }

          function get_data_item(){
              //$id['id_supplier']=$this->input->post('id_supplier');
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
                  detail_ms_barang.id_supplier,
                  detail_ms_barang.hb,
                  detail_ms_barang.hj,
                  detail_ms_barang.perc_margin,
                  detail_ms_barang.margin,
                  detail_ms_barang.max,
                  detail_ms_barang.min,
                  detail_ms_barang.hpp,
                  detail_ms_barang.lokasi,
                  detail_ms_barang.rak,
                  ms_supp.nama AS nama_supplier,
                  mastersubunit.nama_sub_unit,
                  masterunit.nama_unit,
                  mastersubunit.kd_sub_unit,
                  masterunit.kd_unit
                  FROM
                  ms_barang
                  LEFT JOIN ms_merk ON ms_barang.id_merk = ms_merk.id_merk
                  LEFT JOIN ms_kategori ON ms_barang.id_kategori = ms_kategori.id_kategori
                  LEFT JOIN ms_status_aktif ON ms_barang.status_aktif = ms_status_aktif.id_status_aktif
                  LEFT JOIN ms_supplier ON ms_barang.id_supplier = ms_supplier.id_supplier
                  LEFT JOIN ms_jenis_barang ON ms_barang.id_jenis = ms_jenis_barang.id_jenis
                  LEFT JOIN ms_satuan ON ms_barang.satuan = ms_satuan.id_satuan
                  LEFT JOIN ms_tipe ON ms_barang.id_tipe = ms_tipe.id_tipe
                  INNER JOIN detail_ms_barang ON ms_barang.id_barang = detail_ms_barang.kd_barang
                  LEFT JOIN ms_supplier AS ms_supp ON detail_ms_barang.id_supplier = ms_supp.id_supplier
                  INNER JOIN mastersubunit ON detail_ms_barang.kd_sub_unit = mastersubunit.kd_sub_unit
                  INNER JOIN masterunit ON mastersubunit.kd_unit = masterunit.kd_unit
                  $dan ";
	  $query_supplier="SELECT * from ms_supplier";
    //$query_anggota="SELECT * from armaster where status_anggota='Aktif'";


    $data=array(
        'title'=>'Pembelian Non PO',
        'xmenu'=>'Barang Masuk',
        'xsubmenu'=>'Pembelian Non PO',
        'data_supplier'=>$this->Bis_model->manualQuery($query_supplier),
        //'data_anggota'=>$this->Bis_model->manualQuery($query_anggota),
        'data_barang'=>$this->Bis_model->manualQuery($query_barang),
        'data_sub_unit'=>$this->Bis_model->manualQuery($query_sub_unit),
        'users'=>$this->Hak_Akses_m->get_user(),
        'menu'=>$this->Menu_m->get_menu($id),
        'submenu'=>$this->Menu_m->get_submenu($id),
    );
    $this->load->view('Putrans_baru_new',$data);
  }

  function get_data(){
      $npa=$this->input->post('npa');
      $q_data="select * from armaster  WHERE armaster.nama = '$npa'";
      $data['detail_anggota'] = $this->Bis_model->manualQuery($q_data);
      //$this->load->view('ajax_data_supplier_pu',$data);
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
       $query_data="select * from ms_supplier";
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
                  	judul_pu.no_bukti,
                  	judul_pu.no_po,
                  	judul_pu.tgl_trans,
                  	judul_pu.tgl_ed,
                  	judul_pu.id_pegawai,
                  	judul_pu.kd_sub_unit,
                  	judul_pu.id_supplier,
                  	judul_pu.nama_supplier,
                  	judul_pu.alamat_supplier,
                  	judul_pu.jenis_bayar,
                  	judul_pu.jenis_ppn,
                  	judul_pu.top,
                  	judul_pu.keterangan,
                    judul_pu.subtotal,
                  	judul_pu.dpp,
                  	judul_pu.ppn,
                  	judul_pu.diskon,
                  	judul_pu.grandtotal,
                  	judul_pu.status_pu,
                  	judul_pu.status_approve,
                  	judul_pu.user_approve,
                  	judul_pu.approve_date,
                  	judul_pu.entry_user,
                  	judul_pu.entry_date,
                  	judul_pu.edit_user,
                  	judul_pu.edit_date,
                  	ms_supplier.top,
                    cd.nama_sub_unit
                  FROM
                  	judul_pu
                  	LEFT JOIN ms_supplier ON judul_pu.id_supplier = ms_supplier.id_supplier
                  	LEFT JOIN `user` ON judul_pu.entry_user = `user`.id_user
                  	LEFT JOIN ms_pegawai AS a ON `user`.id_pegawai = a.id_pegawai
                  	LEFT JOIN mastersubunit AS cd ON judul_pu.kd_sub_unit = cd.kd_sub_unit
                  	LEFT JOIN masterunit AS re ON cd.kd_unit = re.kd_unit
                  WHERE
                  	judul_pu.no_bukti = '$no_bukti'";
      //echo $query_data_edit;
      $q_detail="SELECT
                detail_pu.kd_barang,
                detail_pu.hb,
                detail_pu.dpp,
                detail_pu.nilaippn,
                Sum( detail_pu.qty ) AS qty,
                detail_pu.diskon,
                detail_pu.perc_diskon,
                Sum( detail_pu.total ) AS total,
                detail_pu.satuan,
                ms_barang.barcode,
                detail_pu.nama_barang,
                judul_pu.no_bukti
              FROM
                judul_pu
                INNER JOIN detail_pu ON judul_pu.no_bukti = detail_pu.no_bukti
                INNER JOIN ms_barang ON detail_pu.kd_barang = ms_barang.id_barang
              WHERE
                judul_pu.no_bukti = '$no_bukti'
              GROUP BY
                detail_pu.kd_barang";

     $data=array(
          'title'=>'Edit Pembelian Non PO',
          'data_supplier'=>$this->Bis_model->manualQuery($query_data),
          'menu' => $this->Menu_m->get_menu($idx),
          'submenu' => $this->Menu_m->get_submenu($idx),
          'xmenu'=>'Barang Masuk',
          'xsubmenu'=>'Pembelian',
          'users' => $this->Hak_Akses_m->get_user(),
          'data_edit' => $this->Bis_model->manualQuery($query_data_edit),
          'data_edit_cb' => $this->Bis_model->manualQuery($query_edit_cb),
          'data_detail' => $this->Bis_model->manualQuery($q_detail),
          'data_sub_unit'=>$this->Bis_model->manualQuery($query_sub_unit),
      );

      $this->load->view('Putrans_edit_view',$data);
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
      $kode_bukti="BPB".$pad_kd_sub_unit.$year.$month;
      $no_bukti= $this->Bis_model->getIdBPB($kode_bukti);
      $tipe_trans="K";
      $no_cb=  $kd_sub_unit."-".time();
      $datacb=array(
        'no_bukti'=>$no_cb,
        'tgl_trans'=>$this->input->post('tgl_trans'),
        'no_ref'=>$no_bukti,
        'jml_trans'=>-1*$this->input->post('grandtotal'),
        'tipe_trans'=>$tipe_trans,
        'kd_sub_unit'=>$this->input->post('kd_sub_unit'),
        'modul_asal'=>'PU',
        'keterangan'=>$keterangan,
        'entry_user'=>$cookie_id_user,
        'entry_date'=>$now,
      );
      $data=array(
        'no_bukti'=>$no_bukti,
        'tgl_trans'=>$this->input->post('tgl_trans'),
        'id_supplier'=>$this->input->post('id_supplier'),
        'nama_supplier'=>$this->input->post('nama_supplier'),
        'alamat_supplier'=>$this->input->post('alamat_supplier'),
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
        //'total'=>$this->input->post('grandtotal'),
        //'voucher'=>$this->input->post('voucher'),
        //'dp'=>$this->input->post('dp'),
        //'ar'=>$this->input->post('ar'),
        //'jml_cicilan'=>$this->input->post('jml_cicilan'),
        'keterangan'=>$this->input->post('keterangan'),
        'entry_user'=>$cookie_id_user,
        'entry_date'=>$now,
      );
      $this->db->trans_off();
      $this->db->trans_begin();
      $this->db->trans_strict(true);
      $this->Bis_model->insertData('judul_pu',$data);
      if ($this->input->post('jenis_bayar')=="TUNAI")
      {
            //$this->Bis_model->insertData('trans_cb',$datacb);
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
            'hb'=>$this->input->post('hb_'.$count),
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
            'kd_sub_unit'=>$kd_sub_unit,

          );
          $this->Bis_model->insertData('detail_pu',$data);
          $this->Bis_model->insertData('in_trans',$data_in);
      }
      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE)
      {
              $this->db->trans_rollback();
              $this->session->set_flashdata('message', 'Gagal input data produksi.');
              $this->session->set_flashdata('jenis', 'danger');
              $this->session->set_flashdata('no_penjuaan', $no_bukti);
              //$this->load->view('report/Cetakputrans2',$data);
              redirect(site_url('Putrans'));
      }
      else
      {
              $this->db->trans_commit();
              $this->session->set_flashdata('message', 'Sukses tambah data baru.');
              $this->session->set_flashdata('jenis', 'success');
              $this->session->set_flashdata('no_penjuaan', $no_bukti);
              redirect(site_url('Putrans/cetak/'.$no_bukti));
              redirect(site_url('Putrans'));
      }
      }

      function simpan_edit()
      {
        $cookie_id_user = get_cookie('eklinik');
        $now = date('Y-m-d H:i:s');
        $date = new DateTime($this->input->post('tgl_produksi'));
        $kd_sub_unit=$this->session->userdata('kd_sub_unit'.$cookie_id_user);

        $id['no_bukti'] = $this->input->post('no_bukti');
        $no_bukti= $this->input->post('no_bukti');
        $idcb['no_bukti'] = $this->input->post('no_cb');
        $no_edit_cb = $this->input->post('no_cb');

        $tipe_trans="K";
        $jenis_bayar=$this->input->post('jenis_bayar');
        $no_cb=  $kd_sub_unit."-".time();
        $dataeditcb=array(
          //'no_bukti'=>$no_kb,
          'tgl_trans'=>$this->input->post('tgl_trans'),
          //'no_ppd'=>$this->input->post('no_si'),
          'no_ref'=>$no_bukti,
          'status'=>$this->input->post(''),
          'jml_trans'=>-1*$this->input->post('grandtotal'),
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
          'jml_trans'=>-1*$this->input->post('grandtotal'),
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
          'id_supplier'=>$this->input->post('id_supplier'),
          'nama_supplier'=>$this->input->post('nama_supplier'),
          'alamat_supplier'=>$this->input->post('alamat_supplier'),
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
        $this->Bis_model->updateData('judul_pu',$data,$id);
        $this->Bis_model->deleteData('detail_pu',$id);
        $this->Bis_model->deleteData('in_trans',$id);
        if ($jenis_bayar=="TUNAI")
        {
          if (!empty($no_edit_cb))
          {
            //$this->Bis_model->updateData('trans_cb',$dataeditcb,$idcb);
          }
          else {
            //$this->Bis_model->insertData('trans_cb',$datacb);
          }


        }
        else {
              //$this->Bis_model->deleteData('trans_cb',$idcb);
        }
        foreach ($this->input->post('rowsBM') as $key => $count )
        {

            $data=array(
              'no_bukti'=>$no_bukti,
              'kd_barang'=>$this->input->post('id_barang_'.$count),
              'no_row'=>$this->input->post('no_row_'.$count),
              'hb'=>$this->input->post('hb_'.$count),
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
              'kd_sub_unit'=>$kd_sub_unit,

            );
            $this->Bis_model->insertData('detail_pu',$data);
            $this->Bis_model->insertData('in_trans',$data_in);

        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                $this->session->set_flashdata('message', 'Gagal input data produksi.');
                $this->session->set_flashdata('jenis', 'danger');
                redirect(site_url('Putrans'));
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses tambah data baru.');
                $this->session->set_flashdata('jenis', 'success');
                redirect(site_url('Putrans/cetak/'.$no_bukti));
                redirect(site_url('Putrans'));
        }
        }

  function hapus()
  {
    $id['no_bukti'] = $this->uri->segment(3);
    $this->db->trans_begin();
    $this->Bis_model->deleteData('judul_pu',$id);
    $this->Bis_model->deleteData('detail_pu',$id);
    if ($this->db->trans_status() === FALSE)
    {
            $this->db->trans_rollback();
    }
    else
    {
            $this->db->trans_commit();
            $this->session->set_flashdata('message', 'Sukses delete.');
            $this->session->set_flashdata('jenis', 'danger');
            redirect(site_url('Putrans'));
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
                  	judul_pu.no_bukti,
                  	judul_pu.no_po,
                  	judul_pu.tgl_trans,
                  	judul_pu.tgl_ed,
                  	judul_pu.id_pegawai,
                  	judul_pu.kd_sub_unit,
                  	judul_pu.id_supplier,
                  	judul_pu.nama_supplier,
                  	judul_pu.alamat_supplier,
                  	judul_pu.jenis_bayar,
                  	judul_pu.jenis_ppn,
                  	judul_pu.top,
                  	judul_pu.keterangan,
                  	judul_pu.dpp,
                  	judul_pu.ppn,
                  	judul_pu.diskon,
                    judul_pu.subtotal,
                  	judul_pu.grandtotal,
                  	judul_pu.status_pu,
                  	judul_pu.status_approve,
                  	judul_pu.user_approve,
                  	judul_pu.approve_date,
                  	judul_pu.entry_user,
                  	judul_pu.entry_date,
                  	judul_pu.edit_user,
                  	judul_pu.edit_date,
                  	ms_supplier.top
                  FROM
                  	judul_pu
                  	LEFT JOIN ms_supplier ON judul_pu.id_supplier = ms_supplier.id_supplier
                  	LEFT JOIN `user` ON judul_pu.entry_user = `user`.id_user
                  	LEFT JOIN ms_pegawai AS a ON `user`.id_pegawai = a.id_pegawai
                  	LEFT JOIN mastersubunit AS cd ON judul_pu.kd_sub_unit = cd.kd_sub_unit
                  	LEFT JOIN masterunit AS re ON cd.kd_unit = re.kd_unit
                  WHERE
                  	judul_pu.no_bukti = '$no_bukti'";
       //echo($query_data);
                      //$query_driver="SELECT * from ms_pegawai where id_jabatan=40";

            $q_detail="SELECT
                    	detail_pu.kd_barang,
                    	detail_pu.hb,
                    	detail_pu.dpp,
                    	detail_pu.nilaippn,
                    	Sum( detail_pu.qty ) AS qty,
                    	detail_pu.diskon,
                    	detail_pu.perc_diskon,
                    	Sum( detail_pu.total ) AS total,
                    	detail_pu.satuan,
                    	ms_barang.barcode,
                    	detail_pu.nama_barang,
                    	judul_pu.no_bukti
                    FROM
                    	judul_pu
                    	INNER JOIN detail_pu ON judul_pu.no_bukti = detail_pu.no_bukti
                    	INNER JOIN ms_barang ON detail_pu.kd_barang = ms_barang.id_barang
                    WHERE
                    	judul_pu.no_bukti = '$no_bukti'
                    GROUP BY
                    	detail_pu.kd_barang";

	    $data['data_pu'] = $this->Bis_model->manualQuery($query_data);
      $data['detail_pu'] = $this->Bis_model->manualQuery($q_detail);

      $data['users'] = $this->Hak_Akses_m->get_user();
      $data['menu'] = $this->Menu_m->get_menu($id);
      $data['submenu'] = $this->Menu_m->get_submenu($id);
      $this->load->view('report/Cetakputrans2',$data);
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
                      judul_pu.no_bukti,
                      judul_pu.tgl_trans,
                      judul_pu.id_pegawai,
                      judul_pu.id_unit,
                      judul_pu.id_slock,
                      judul_pu.keterangan,
                      judul_pu.status_pu,
                      judul_pu.status_approve,
                      judul_pu.user_approve,
                      judul_pu.approve_date,
                      judul_pu.no_spp,
                      ms_pegawai.nama AS user_entry,
                      ms_slock.nama AS slock,
                      ms_plant.nama AS nama_plant,
                      p1.nama AS nama_pegawai
    FROM
                      judul_pu
                      LEFT JOIN judul_spb ON judul_pu.no_spp = judul_spb.no_bukti
                      INNER JOIN `user` ON judul_pu.entry_user = `user`.id_user
                      INNER JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
                      INNER JOIN ms_slock ON judul_pu.id_slock = ms_slock.id_slock
                      INNER JOIN ms_plant ON ms_slock.id_plant = ms_plant.id_plant
                      INNER JOIN ms_pegawai AS p1 ON judul_pu.id_pegawai = p1.id_pegawai

                          WHERE
                          judul_pu.no_bukti = '$no_bukti'


                          ";
              //echo($query_data);
                          //$query_driver="SELECT * from ms_pegawai where id_jabatan=40";
              $q_detail="SELECT
    judul_pu.no_bukti,
    detail_pu.kd_barang,
    ms_barang.nama AS nama_barang,
    detail_pu.qty,
    detail_pu.hb as harga_beli,
    ms_barang.part_number
    FROM
                          detail_pu
                          INNER JOIN judul_pu ON judul_pu.no_bukti = detail_pu.no_bukti
                          INNER JOIN ms_barang ON detail_pu.kd_barang = ms_barang.id_barang

                          WHERE
                          judul_pu.no_bukti = '$no_bukti'";

    	  $data['data_pu'] = $this->Bis_model->manualQuery($query_data);
          $data['detail_pu'] = $this->Bis_model->manualQuery($q_detail);

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
