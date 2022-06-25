<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Potrans extends CI_Controller
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
       judul_po.kd_sub_unit = '$kd_sub_unit'";

    }
    $query_jml_po="SELECT
                	Count( judul_po.no_bukti ) AS jml
                FROM
                	judul_po
                  WHERE judul_po.no_bukti IS NOT NULL $dan";
    $query_data="SELECT
                	judul_po.no_bukti,
                  judul_po.no_bpb,
                	judul_po.tgl_trans,
                	judul_po.jenis_bayar,
                	judul_po.jenis_ppn,
                	judul_po.diskon,
                	judul_po.dpp,
                	judul_po.ppn,
                	judul_po.grandtotal as total,
                	judul_po.entry_user,
                	judul_po.entry_date,
                	a.nama AS nama_pegawai,
                	judul_po.kd_sub_unit,
                	ms_supplier.nama AS nama_supplier,
                	ms_supplier.id_supplier,
                  re.nama_unit,
                  cd.nama_sub_unit
                FROM
                	judul_po
                	LEFT JOIN `user` ON judul_po.entry_user = `user`.id_user
                	LEFT JOIN ms_pegawai AS a ON `user`.id_pegawai = a.id_pegawai
                	LEFT JOIN mastersubunit AS cd ON judul_po.kd_sub_unit = cd.kd_sub_unit
                	LEFT JOIN masterunit AS re ON cd.kd_unit = re.kd_unit
                	LEFT JOIN ms_supplier ON judul_po.id_supplier = ms_supplier.id_supplier
                WHERE judul_po.no_bukti IS NOT NULL
                  $dan limit 100";


            $data=array(
                'title'=>'Data PO (Purchase Order)',
                'xmenu'=>'Barang Masuk',
                'xsubmenu'=>'PO (Purchase Order)',
                'data_po'=>$this->Bis_model->manualQuery($query_data),
                'jml_po' => $this->Bis_model->manualQuery($query_jml_po),
                'users'=>$this->Hak_Akses_m->get_user($id),
                'menu'=>$this->Menu_m->get_menu($id),
                'submenu'=>$this->Menu_m->get_submenu($id),
            );

            $this->load->view('Potrans_view',$data);
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
               judul_po.kd_sub_unit = '$kd_sub_unit'";

            }

            $query_data="SELECT
                        	judul_po.no_bukti,
                          judul_po.no_bpb,
                        	judul_po.tgl_trans,
                        	judul_po.jenis_bayar,
                        	judul_po.jenis_ppn,
                        	judul_po.diskon,
                        	judul_po.dpp,
                        	judul_po.ppn,
                        	judul_po.grandtotal as total,
                        	judul_po.entry_user,
                        	judul_po.entry_date,
                        	a.nama AS nama_pegawai,
                        	judul_po.kd_sub_unit,
                        	ms_supplier.nama AS nama_supplier,
                        	ms_supplier.id_supplier,
                          re.nama_unit,
                          cd.nama_sub_unit
                        FROM
                        	judul_po
                        	LEFT JOIN `user` ON judul_po.entry_user = `user`.id_user
                        	LEFT JOIN ms_pegawai AS a ON `user`.id_pegawai = a.id_pegawai
                        	LEFT JOIN mastersubunit AS cd ON judul_po.kd_sub_unit = cd.kd_sub_unit
                        	LEFT JOIN masterunit AS re ON cd.kd_unit = re.kd_unit
                        	LEFT JOIN ms_supplier ON judul_po.id_supplier = ms_supplier.id_supplier
                        WHERE judul_po.no_bukti IS NOT NULL
                        $dan AND (judul_po.no_bukti like '%$filter%' OR ms_supplier.nama like '%$filter%' OR judul_po.no_bpb like '%$filter%' OR a.nama like '%$filter%') limit 100";


                    $data=array(
                        'title'=>'Data PO (Purchase Order)',
                        'xmenu'=>'Barang Masuk',
                        'xsubmenu'=>'PO (Purchase Order)',
                        'data_po'=>$this->Bis_model->manualQuery($query_data),
                        'users'=>$this->Hak_Akses_m->get_user($id),
                        'menu'=>$this->Menu_m->get_menu($id),
                        'submenu'=>$this->Menu_m->get_submenu($id),
                    );

                    $this->load->view('Potrans_view',$data);
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
        'title'=>'Pembuatan PO (Purchase Order)',
        'xmenu'=>'Barang Masuk',
        'xsubmenu'=>'Purchase Order (PO)',
        'data_supplier'=>$this->Bis_model->manualQuery($query_supplier),
        //'data_anggota'=>$this->Bis_model->manualQuery($query_anggota),
        'data_barang'=>$this->Bis_model->manualQuery($query_barang),
        'data_sub_unit'=>$this->Bis_model->manualQuery($query_sub_unit),
        'users'=>$this->Hak_Akses_m->get_user(),
        'menu'=>$this->Menu_m->get_menu($id),
        'submenu'=>$this->Menu_m->get_submenu($id),
    );
    $this->load->view('Potrans_baru_new',$data);
  }

  function get_data(){
      $npa=$this->input->post('npa');
      $q_data="select * from armaster  WHERE armaster.nama = '$npa'";
      $data['detail_anggota'] = $this->Bis_model->manualQuery($q_data);
      //$this->load->view('ajax_data_supplier_po',$data);
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

      $data['data_jabatan'] = $this->Bis_model->getAllData('ms_jabatan');

       $query_data="select * from ms_supplier";

      $query_data_edit="SELECT
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
                    judul_po.subtotal,
                  	judul_po.dpp,
                  	judul_po.ppn,
                  	judul_po.diskon,
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
                  	judul_po.no_bukti = '$no_bukti'";
      //echo $query_data_edit;
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
                judul_po.no_bukti = '$no_bukti'
              GROUP BY
                detail_po.kd_barang";

     $data=array(
          'title'=>'Edit Purchase Order (PO)',
          'data_supplier'=>$this->Bis_model->manualQuery($query_data),
          'menu' => $this->Menu_m->get_menu($idx),
          'submenu' => $this->Menu_m->get_submenu($idx),
          'xmenu'=>'Barang Masuk',
          'xsubmenu'=>'PO (Purchase Order)',
          'users' => $this->Hak_Akses_m->get_user(),
          'data_edit' => $this->Bis_model->manualQuery($query_data_edit),
          'data_detail' => $this->Bis_model->manualQuery($q_detail),
          'data_sub_unit'=>$this->Bis_model->manualQuery($query_sub_unit),
      );

      $this->load->view('Potrans_edit_view',$data);
    }

  function ambil_data_divisi(){

      $id_plant=$this->input->post('id_plant');
      $q_data_divisi="select id_divisi,nama from ms_divisi where id_divisi not in (
        SELECT
        plant_divisi.id_divisi
        FROM
        plant_divisi
        WHERE
        plant_divisi.id_plant = $id_plant)";
     // $data=array('detail_po_rent'=>$this->Bis_model->getSelectedData('trans_po_rental',$id)->result(),);
      $data=array(
          'data_div_child'=>$this->Bis_model->getDataX($q_data_divisi),
      );
      $this->load->view('ajax_div_child',$data);
  }

  function ambil_data_departement(){

      $id_plant_div=$this->input->post('id_plant_div');
      $q_data_divisi="select id_departement,nama from ms_departement where id_departement not in (
                      SELECT
                      plant_div_dept.id_departement
                      FROM
                      plant_div_dept
                      WHERE
                      plant_div_dept.id_plant_divisi = $id_plant_div)";
     // $data=array('detail_po_rent'=>$this->Bis_model->getSelectedData('trans_po_rental',$id)->result(),);
      $data=array(
          'data_dept_child'=>$this->Bis_model->getDataX($q_data_divisi),
      );
      $this->load->view('ajax_dept_child',$data);
  }

  function get_detail_plant(){
      $id['id_plant']=$this->input->post('id_plant');
      $data=array(
          'detail_plant'=>$this->Bis_model->getSelectedData('ms_plant',$id)->result(),
      );
      $this->load->view('ajax_detail_plant',$data);
  }

  function ambil_data(){
    $modul=$this->input->post('modul');
    $id=$this->input->post('id');

    if($modul=="unit"){
      echo $this->Model_select_idh->unit($id);
    } else if($modul=="driver"){
      echo $this->model_select_idh->driver($id);
    } else if($modul=="kelurahan"){
      echo $this->model_select->kelurahan($id);
    }
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

      $kode_bukti="PO".$pad_kd_sub_unit.$year.$month;

      $no_bukti= $this->Bis_model->getIdPO($kode_bukti);

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
      $this->Bis_model->insertData('judul_po',$data);


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
          $this->Bis_model->insertData('detail_po',$data);
      }
      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE)
      {
              $this->db->trans_rollback();
              $this->session->set_flashdata('message', 'Gagal input data produksi.');
              $this->session->set_flashdata('jenis', 'danger');
              $this->session->set_flashdata('no_penjuaan', $no_bukti);
              redirect(site_url('Potrans'));
      }
      else
      {
              $this->db->trans_commit();
              $this->session->set_flashdata('message', 'Sukses tambah data baru.');
              $this->session->set_flashdata('jenis', 'success');
              $this->session->set_flashdata('no_penjuaan', $no_bukti);
              redirect(site_url('Potrans/cetak/'.$no_bukti));
              redirect(site_url('Potrans'));
      }
      }

      function simpan_edit()
      {
        //$id = get_cookie('eklinik');
        $cookie_id_user = get_cookie('eklinik');
        $now = date('Y-m-d H:i:s');
        $date = new DateTime($this->input->post('tgl_produksi'));
        $kd_sub_unit=$this->session->userdata('kd_sub_unit'.$cookie_id_user);


        $id['no_bukti'] = $this->input->post('no_bukti');
        $no_bukti= $this->input->post('no_bukti');

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
          'status_po'=>$this->input->post(''),
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
        $this->Bis_model->updateData('judul_po',$data,$id);
        $this->Bis_model->deleteData('detail_po',$id);


    		foreach ($this->input->post('rowsBM') as $key => $count )
        {
          if($jenis_ppn=="NON"){
          $ppn=0;
          }
          else {
            $ppn=$this->input->post('hj_'.$count)*0.1;
          }
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
          $this->Bis_model->insertData('detail_po',$data);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                $this->session->set_flashdata('message', 'Gagal input data.');
                $this->session->set_flashdata('jenis', 'danger');
                redirect(site_url('Potrans'));
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses tambah data baru.');
                $this->session->set_flashdata('jenis', 'success');
                redirect(site_url('Potrans/cetak/'.$no_bukti));
                redirect(site_url('Potrans'));
        }
        }

  function hapus()
  {
    $id['no_bukti'] = $this->uri->segment(3);
    $this->db->trans_begin();
    $this->Bis_model->deleteData('judul_po',$id);
    $this->Bis_model->deleteData('detail_po',$id);
    if ($this->db->trans_status() === FALSE)
    {
            $this->db->trans_rollback();
    }
    else
    {
            $this->db->trans_commit();
            $this->session->set_flashdata('message', 'Sukses delete.');
            $this->session->set_flashdata('jenis', 'danger');
            redirect(site_url('Potrans'));
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
                  	ms_supplier.top
                  FROM
                  	judul_po
                  	LEFT JOIN ms_supplier ON judul_po.id_supplier = ms_supplier.id_supplier
                  	LEFT JOIN `user` ON judul_po.entry_user = `user`.id_user
                  	LEFT JOIN ms_pegawai AS a ON `user`.id_pegawai = a.id_pegawai
                  	LEFT JOIN mastersubunit AS cd ON judul_po.kd_sub_unit = cd.kd_sub_unit
                  	LEFT JOIN masterunit AS re ON cd.kd_unit = re.kd_unit
                  WHERE
                  	judul_po.no_bukti = '$no_bukti'";
         //echo($query_data);
                      //$query_driver="SELECT * from ms_pegawai where id_jabatan=40";

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
                    	judul_po.no_bukti = '$no_bukti'
                    GROUP BY
                    	detail_po.kd_barang";

	    $data['data_po'] = $this->Bis_model->manualQuery($query_data);
      $data['detail_po'] = $this->Bis_model->manualQuery($q_detail);

      $data['users'] = $this->Hak_Akses_m->get_user();
      $data['menu'] = $this->Menu_m->get_menu($id);
      $data['submenu'] = $this->Menu_m->get_submenu($id);
      $this->load->view('report/Cetakpotrans2',$data);
    }


  function exportexcel()
  {

    $this->load->model('idh/IDH_m');
    $data['idh'] = $this->IDH_m->get_data_hauling();
    $this->load->view('Karyawan_export',$data);
  }
}
?>
