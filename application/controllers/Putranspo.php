<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Putranspo extends CI_Controller
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
                  WHERE judul_pu.no_bukti IS NOT NULL AND judul_pu.no_po is NOT NULL $dan";
    $query_data="SELECT
                	judul_pu.no_bukti,
                  judul_pu.no_po,
                  judul_pu.no_ref,
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
                	LEFT JOIN ms_supplier ON judul_pu.id_supplier = ms_supplier.id_supplier where judul_pu.no_po is not null  $dan  limit 100";
                  //echo $query_data;

            $data=array(
                'title'=>'Data Pembelian Dengan PO',
                'xmenu'=>'Barang Masuk',
                'xsubmenu'=>'Pembelian (PO)',
                'data_pu'=>$this->Bis_model->manualQuery($query_data),
                'jml_pu' => $this->Bis_model->manualQuery($query_jml_pu),
                'users'=>$this->Hak_Akses_m->get_user($id),
                'menu'=>$this->Menu_m->get_menu($id),
                'submenu'=>$this->Menu_m->get_submenu($id),
            );

            $this->load->view('Putranspo_view',$data);
          }
          function filter()
          {
            $id = get_cookie('eklinik');
            $kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
            $ses_id_jenis=$this->session->userdata('id_jenis'.$id);
            $filter=$this->input->post('katakunci');
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
                          WHERE judul_pu.no_bukti IS NOT NULL AND judul_pu.no_po is NOT NULL $dan";
            $query_data="SELECT
                        	judul_pu.no_bukti,
                          judul_pu.no_po,
                          judul_pu.no_ref,
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
                        	LEFT JOIN ms_supplier ON judul_pu.id_supplier = ms_supplier.id_supplier where judul_pu.no_po is not null  $dan
                          AND (judul_pu.no_bukti like '%$filter%' OR ms_supplier.nama like '%$filter%' OR cd.nama_sub_unit like '%$filter%' OR a.nama like '%$filter%')  limit 100";
                          //echo $query_data;

                    $data=array(
                        'title'=>'Data Pembelian Dengan PO',
                        'xmenu'=>'Barang Masuk',
                        'xsubmenu'=>'Pembelian (PO)',
                        'data_pu'=>$this->Bis_model->manualQuery($query_data),
                        'jml_pu' => $this->Bis_model->manualQuery($query_jml_pu),
                        'users'=>$this->Hak_Akses_m->get_user($id),
                        'menu'=>$this->Menu_m->get_menu($id),
                        'submenu'=>$this->Menu_m->get_submenu($id),
                    );

                    $this->load->view('Putranspo_view',$data);
                  }
          function get_data_po(){
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
              $no_po=$this->input->post('no_po');
              $query_data="SELECT
                          	a.nama AS nama_pegawai,
                          	re.nama_unit AS nama_unit_transaksi,
                          	re.kd_unit AS kd_unit_transaksi,
                          	judul_po.no_bukti,
                          	judul_po.no_bpb,
                          	judul_po.tgl_trans,
                          	judul_po.tgl_ed,
                          	judul_po.id_pegawai,
                          	judul_po.kd_sub_unit,
                          	judul_po.id_supplier,
                          	judul_po.nama_supplier,
                          	judul_po.alamat_supplier,
                          	judul_po.jenis_bayar,
                          	judul_po.jenis_ppn,
                          	judul_po.top,
                          	judul_po.keterangan,
                          	judul_po.dpp,
                          	judul_po.ppn,
                          	judul_po.diskon,
                            judul_po.subtotal,
                          	judul_po.grandtotal,
                          	judul_po.status_po,
                          	judul_po.status_approve,
                          	judul_po.user_approve,
                          	judul_po.approve_date,
                          	judul_po.entry_user,
                          	judul_po.entry_date,
                          	judul_po.edit_user,
                          	judul_po.edit_date,
                          	ms_supplier.top,
                            cd.nama_sub_unit
                          FROM
                          	judul_po
                          	LEFT JOIN ms_supplier ON judul_po.id_supplier = ms_supplier.id_supplier
                          	LEFT JOIN `user` ON judul_po.entry_user = `user`.id_user
                          	LEFT JOIN ms_pegawai AS a ON `user`.id_pegawai = a.id_pegawai
                          	LEFT JOIN mastersubunit AS cd ON judul_po.kd_sub_unit = cd.kd_sub_unit
                          	LEFT JOIN masterunit AS re ON cd.kd_unit = re.kd_unit
                          WHERE
                          	judul_po.no_bukti = '$no_po'";
           $q_detail="SELECT
                        	detail_po.kd_barang,
                        	detail_po.hb,
                        	detail_po.dpp,
                        	detail_po.nilaippn,
                        	Sum( detail_po.qty ) AS qty,
                        	detail_po.diskon,
                        	detail_po.perc_diskon,
                        	Sum( detail_po.total ) AS total,
                        	detail_po.satuan,
                        	ms_barang.barcode,
                        	detail_po.nama_barang,
                        	judul_po.no_bukti
                        FROM
                        	judul_po
                        	INNER JOIN detail_po ON judul_po.no_bukti = detail_po.no_bukti
                        	INNER JOIN ms_barang ON detail_po.kd_barang = ms_barang.id_barang
                        WHERE
                        	judul_po.no_bukti = '$no_po'
                        GROUP BY
                        	detail_po.kd_barang";
           $q_akun="select kd_akun,UPPER(nama) as nama_akun from masterakun";
           $data=array(
                 'data_detail'=>$this->Bis_model->manualQuery($q_detail),
                 'data_judul'=>$this->Bis_model->manualQuery($query_data),
                 'data_akun'=>$this->Bis_model->manualQuery($q_akun),
                 'data_sub_unit'=>$this->Bis_model->manualQuery($query_sub_unit),
                  );

           $this->load->view('ajax_data_po',$data);
          }

  function baru(){
    $id = get_cookie('eklinik');
    $kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
    $ses_id_jenis=$this->session->userdata('id_jenis'.$id);
    if($ses_id_jenis<3)
    {
      $dan="";
    }
    else {
      $dan=" AND judul_po.kd_sub_unit = '$kd_sub_unit'";
    }

	  $query_po="SELECT
                	judul_po.no_bukti,
                	CONCAT( judul_po.no_bukti, ' | ', judul_po.tgl_trans, ' | ', judul_po.nama_supplier, ' | ', judul_po.alamat_supplier ) AS ket
                FROM
                	judul_po
                WHERE
                	judul_po.status_po IS NULL
                	$dan
                ORDER BY
                	judul_po.no_bukti DESC,
                	judul_po.tgl_trans DESC
              ";



    $data=array(
        'title'=>'Pembelian Dengan PO',
        'xmenu'=>'Barang Masuk',
        'xsubmenu'=>'Pembelian (PO)',
        'data_po'=>$this->Bis_model->manualQuery($query_po),
        //'data_anggota'=>$this->Bis_model->manualQuery($query_anggota),
        //'data_barang'=>$this->Bis_model->manualQuery($query_barang),
        'users'=>$this->Hak_Akses_m->get_user(),
        'menu'=>$this->Menu_m->get_menu($id),
        'submenu'=>$this->Menu_m->get_submenu($id),
    );
    $this->load->view('Putranspo_baru_new',$data);
  }

  function ambil_edit()
  {
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
      $id['no_bukti'] = $this->uri->segment(3);
      $no_bukti= $this->uri->segment(3);
      $data['data_jabatan'] = $this->Bis_model->getAllData('ms_jabatan');
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
                    judul_pu.no_ref,
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
          'title'=>"Edit Pembelian No. $no_bukti Dengan PO",
          'data_supplier'=>$this->Bis_model->manualQuery($query_data),

          'xmenu'=>'Barang Masuk',
          'xsubmenu'=>'Pembelian',
          'data_edit_cb' => $this->Bis_model->manualQuery($query_edit_cb),
          'data_edit' => $this->Bis_model->manualQuery($query_data_edit),
          'data_detail' => $this->Bis_model->manualQuery($q_detail),
          'users'=>$this->Hak_Akses_m->get_user($idx),
          'menu'=>$this->Menu_m->get_menu($idx),
          'submenu'=>$this->Menu_m->get_submenu($idx),
          'data_sub_unit'=>$this->Bis_model->manualQuery($query_sub_unit),
      );

      $this->load->view('Putranspo_edit_view',$data);
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
        'no_ref'=>$this->input->post('no_ref'),
        'no_po'=>$this->input->post('no_po'),
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
      $update_status_po=array(
        'status_po'=>1,
        'no_bpb'=>$no_bukti,
      );
      $this->db->trans_off();
      $this->db->trans_begin();
      $this->db->trans_strict(true);
      $this->Bis_model->insertData('judul_pu',$data);
      $idpo['no_bukti'] = $this->input->post('no_po');
      $this->Bis_model->updateData('judul_po',$update_status_po,$idpo);
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
              redirect(site_url('Putranspo'));
      }
      else
      {
              $this->db->trans_commit();
              $this->session->set_flashdata('message', 'Sukses tambah data baru.');
              $this->session->set_flashdata('jenis', 'success');
              $this->session->set_flashdata('no_penjuaan', $no_bukti);
              redirect(site_url('Putranspo/cetak/'.$no_bukti));
              redirect(site_url('Putranspo'));
      }
      }

      function simpan_edit()
      {
        $cookie_id_user = get_cookie('eklinik');
        $now = date('Y-m-d H:i:s');
        $date = new DateTime($this->input->post('tgl_produksi'));
        $kd_sub_unit=$this->session->userdata('kd_sub_unit'.$cookie_id_user);

        $year = $date -> format('Y');
        $month = $date -> format('m');
        $day = $date -> format('d');
        $kode_bukti="SPP".$year.$month;

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
          'no_ref'=>$this->input->post('no_ref'),
          //'no_po'=>$this->input->post('no_po'),
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
        $update_status_po=array(
          'status_po'=>1,
          'no_bpb'=>$no_bukti,
        );

        $this->db->trans_off();
        $this->db->trans_begin();
        $this->db->trans_strict(true);
        $this->Bis_model->updateData('judul_pu',$data,$id);
        $this->Bis_model->deleteData('detail_pu',$id);

        $this->Bis_model->deleteData('in_trans',$id);

        $idpo['no_bukti'] = $this->input->post('no_po');
        $this->Bis_model->updateData('judul_po',$update_status_po,$idpo);
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
                redirect(site_url('Putranspo'));
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses tambah data baru.');
                $this->session->set_flashdata('jenis', 'success');
                redirect(site_url('Putranspo/cetak/'.$no_bukti));
                redirect(site_url('Putranspo'));
        }
        }
  function hapus()
  {
    $id['no_bukti'] = $this->uri->segment(3);
    $update_status_po=array(
      'status_po'=>$this->input->post(''),
      'no_bpb'=>$this->input->post(''),
    );

    $idpo['no_bukti'] =$this->uri->segment(4);


    $this->db->trans_off();
    $this->db->trans_begin();
    $this->Bis_model->updateData('judul_po',$update_status_po,$idpo);
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
            redirect(site_url('Putranspo'));
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
                    judul_pu.no_ref,
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
      $this->load->view('report/Cetakputranspo2',$data);
    }


  function exportexcel()
  {

    $this->load->model('idh/IDH_m');
    $data['idh'] = $this->IDH_m->get_data_hauling();
    $this->load->view('Karyawan_export',$data);
  }
}
?>
