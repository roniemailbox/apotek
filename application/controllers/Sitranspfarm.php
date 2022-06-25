<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sitranspfarm extends CI_Controller
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
       $dan ="WHERE
       cd.kd_sub_unit = '$kd_sub_unit'";

    }

    $query_data="SELECT
                judul_si.no_bukti,
                judul_si.tgl_trans,
                armaster.npa,
                armaster.nama AS nama_customer,
                judul_si.jenis_bayar,
                judul_si.jenis_ppn,
                judul_si.diskon,
                judul_si.dpp,
                judul_si.ppn,
                judul_si.total,
                judul_si.subtotal,
                judul_si.voucher,
                judul_si.jml_cicilan,
                judul_si.entry_user,
                judul_si.entry_date,
                a.nama AS nama_pegawai,
                judul_si.kd_sub_unit_anggota,
                judul_si.kd_sub_unit,
                c.kd_unit,
                `x2`.nama_unit AS nama_unit_anggota,
                re.nama_unit AS nama_unit_transaksi,
                re.kd_unit AS kd_unit_transaksi
                FROM
                judul_si
                LEFT JOIN armaster ON judul_si.id_customer = armaster.npa
                LEFT JOIN mastersubunit AS c ON judul_si.kd_sub_unit_anggota = c.kd_sub_unit
                LEFT JOIN `user` ON judul_si.entry_user = `user`.id_user
                LEFT JOIN ms_pegawai AS a ON `user`.id_pegawai = a.id_pegawai
                LEFT JOIN masterunit AS `x2` ON c.kd_unit = `x2`.kd_unit
                LEFT JOIN mastersubunit AS cd ON judul_si.kd_sub_unit = cd.kd_sub_unit
                LEFT JOIN masterunit AS re ON cd.kd_unit = re.kd_unit
                $dan limit 100";


            $data=array(
                'title'=>'Data Penjualan Obat',
                'xmenu'=>'Farmasi',
                'xsubmenu'=>'Penjualan Obat',
                'data_po'=>$this->Bis_model->manualQuery($query_data),
                'users'=>$this->Hak_Akses_m->get_user($id),
                'menu'=>$this->Menu_m->get_menu($id),
                'submenu'=>$this->Menu_m->get_submenu($id),
            );

            $this->load->view('Sitranspfarm_view',$data);
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
    }
    else {
      $dan=" WHERE
      detail_ms_barang.kd_sub_unit = '$kd_sub_unit'";
    }
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
	  $query_data="SELECT * from ms_supplier";
    //$query_anggota="SELECT * from armaster where status_anggota='Aktif'";


    $data=array(
        'title'=>'Entri Penjualan Obat',
        'xmenu'=>'Farmasi',
        'xsubmenu'=>'Penjualan Obat',
        //'data_supplier'=>$this->Bis_model->manualQuery($query_data),
        //'data_anggota'=>$this->Bis_model->manualQuery($query_anggota),
        'data_barang'=>$this->Bis_model->manualQuery($query_barang),
        'users'=>$this->Hak_Akses_m->get_user(),
        'menu'=>$this->Menu_m->get_menu($id),
        'submenu'=>$this->Menu_m->get_submenu($id),
    );
    $this->load->view('Sitranspfarm_baru_new',$data);
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
      $id = get_cookie('eklinik');
      $this->load->model('Menu_m');
      $this->load->model('Hak_Akses_m');
      $this->load->model('Login_m');
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

    //  $data['data_driver'] = $this->Bis_model->manualQuery($query_driver);
      //$data['jabatan'] = $this->Login_m->get_jabatan();
      //$data['users'] = $this->Hak_Akses_m->get_user();
      //$data['menu'] = $this->Menu_m->get_menu($id);
      //$data['submenu'] = $this->Menu_m->get_submenu($id);
      $this->load->view('Sitranst_edit',$data);
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
      $year = $date -> format('y');
      $month = $date -> format('m');
      $day = $date -> format('d');
      $jenis_bayar=$this->input->post('jenis_bayar');
      if ($jenis_bayar=="TUNAI") {
        $kode_bayar="NPT";
      }
      else {
        $kode_bayar="NPK";
      }
      $kode_bukti=$kode_bayar.$pad_kd_sub_unit.$year.$month;
      $cookie_id_user = get_cookie('eklinik');
      //$kodejenis =  $this->input->post('id_status_pegawai');
      //$no_krit="EMP-";
      $no_bukti= $this->Bis_model->getIdSi($kode_bukti);
      $data=array(
        'no_bukti'=>$no_bukti,
        'tgl_trans'=>$this->input->post('tgl_trans'),
        'id_customer'=>$this->input->post('npa'),
        //'id_sales'=>$this->input->post('id_sales'),
        'kd_sub_unit'=>$kd_sub_unit,
        'kd_sub_unit_anggota'=>$this->input->post('kd_sub_unit'),
        //'id_slock'=>$this->input->post('id_slock'),
        //'id_plant'=>$this->input->post('id_plant'),
        'jenis_bayar'=>$this->input->post('jenis_bayar'),
        //'top'=>$this->input->post('top'),
        'jenis_ppn'=>$this->input->post('jenis_ppn'),
        //'no_ref'=>$this->input->post('no_ref'),
        'subtotal'=>$this->input->post('subtotal'),
        'diskon'=>$this->input->post('diskon'),
        'dpp'=>$this->input->post('dpp'),
        'ppn'=>$this->input->post('ppn'),
        'total'=>$this->input->post('grandtotal'),
        'voucher'=>$this->input->post('voucher'),
        'dp'=>$this->input->post('dp'),
        //'ar'=>$this->input->post('ar'),
        'jml_cicilan'=>$this->input->post('jml_cicilan'),
        'keterangan'=>$this->input->post('keterangan'),
        'entry_user'=>$cookie_id_user,
        'entry_date'=>$now,
      );
      $this->db->trans_off();
      $this->db->trans_begin();
      $this->db->trans_strict(true);
      $this->Bis_model->insertData('judul_si',$data);


  		foreach ($this->input->post('rowsBM') as $key => $count )
      {

          $data=array(
            'no_bukti'=>$no_bukti,
            'kd_barang'=>$this->input->post('id_barang_'.$count),
            'no_row'=>$this->input->post('no_row_'.$count),
            'hj'=>$this->input->post('hj_'.$count),
            'dpp'=>$this->input->post('dpp_'.$count),
            'nilaippn'=>$this->input->post('nilaippn_'.$count),
            'qty'=>$this->input->post('qty_'.$count),
            'nama_barang'=>$this->input->post('nama_barang_'.$count),
            'diskon'=>$this->input->post('diskon_'.$count),
            'perc_diskon'=>$this->input->post('perc_diskon_'.$count),
            'total'=>$this->input->post('total_'.$count),
            'satuan'=>$this->input->post('satuan_'.$count),
          );
          $this->Bis_model->insertData('detail_si',$data);
      }
      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE)
      {
              $this->db->trans_rollback();
              $this->session->set_flashdata('message', 'Gagal input data produksi.');
              $this->session->set_flashdata('jenis', 'danger');
              $this->session->set_flashdata('no_penjuaan', $no_bukti);
              redirect(site_url('Sitranst/baru'));
      }
      else
      {
              $this->db->trans_commit();
              $this->session->set_flashdata('message', 'Sukses tambah data baru.');
              $this->session->set_flashdata('jenis', 'success');
              $this->session->set_flashdata('no_penjuaan', $no_bukti);
              redirect(site_url('Sitranst/baru'));
      }
      }

      function simpan_edit()
      {
        $now = date('Y-m-d H:i:s');
        $date = new DateTime($this->input->post('tgl_produksi'));
        $id_plant = $this->input->post('id_plant');
        $year = $date -> format('Y');
        $month = $date -> format('m');
        $day = $date -> format('d');
        $kode_bukti="SPP".$year.$month;
        $cookie_id_user = get_cookie('eklinik');
        $id['no_bukti'] = $this->input->post('no_bukti');
        $no_bukti= $this->input->post('no_bukti');
        $data=array(
          'tgl_trans'=>$this->input->post('tgl_trans'),
          'tgl_ed'=>$this->input->post('tgl_ed'),
          'id_pegawai'=>$this->input->post('id_pegawai'),
          'id_unit'=>$this->input->post('id_unit'),
          'id_slock'=>$this->input->post('id_slock'),
          'top'=>$this->input->post('top'),
          'id_supplier'=>$this->input->post('id_supplier'),
          'jenis_bayar'=>$this->input->post('jenis_bayar'),
          'jenis_ppn'=>$this->input->post('jenis_ppn'),
          'no_spp'=>$this->input->post('no_spp'),
          'keterangan'=>$this->input->post('keterangan'),
          'dpp'=>$this->input->post('dpp'),
          'ppn'=>$this->input->post('ppn'),
          'total'=>$this->input->post('total'),
          'status_po'=>1,
          'edit_user'=>$cookie_id_user,
          'edit_date'=>$now,
        );
        $this->db->trans_off();
        $this->db->trans_begin();
        $this->db->trans_strict(true);
        $this->Bis_model->updateData('judul_po',$data,$id);
        $this->Bis_model->deleteData('detail_po',$id);
        //$inserted_count = 0;
    		//insert gl

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
            'kd_barang'=>$this->input->post('kode_barang_'.$count),
            'hb'=>$this->input->post('hb_'.$count),
            'qty'=>$this->input->post('qty_'.$count),
            'ppn'=>$ppn,
          );
             $this->Bis_model->insertData('detail_po',$data);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                $this->session->set_flashdata('message', 'Gagal input data produksi.');
                $this->session->set_flashdata('jenis', 'danger');
                redirect(site_url('Sitranst'));
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses tambah data baru.');
                $this->session->set_flashdata('jenis', 'success');
                redirect(site_url('Sitranst'));
        }
        }

      function buatpo()
      {
          $id['no_bukti'] = $this->uri->segment(3);

          $no_bukti= $this->uri->segment(3);
          $id = get_cookie('eklinik');
          $this->load->model('Menu_m');
          $this->load->model('Hak_Akses_m');
          $this->load->model('Login_m');
          $data['data_jabatan'] = $this->Bis_model->getAllData('ms_jabatan');
          $query_plant="SELECT * from ms_plant";
          $data['data_plant'] = $this->Bis_model->manualQuery($query_plant);
          $query_supplier="SELECT * from ms_supplier";
          $data['data_supplier'] = $this->Bis_model->manualQuery($query_supplier);
          $query_data="SELECT
                      judul_spb.no_bukti,
                      judul_spb.tgl_trans,
                      ms_pegawai.id_pegawai,
                      ms_pegawai.nama AS nama_pegawai,
                      ms_plant.nama AS nama_plant,
                      ms_slock.nama AS slock,
                      ms_unit.id_unit,
                      judul_spb.keterangan,
                      judul_spb.status_spb,
                      p2.nama AS user_entry,
                      ms_slock.id_slock
                      FROM
                                              judul_spb
                                              LEFT JOIN ms_slock ON judul_spb.id_slock = ms_slock.id_slock
                                              INNER JOIN ms_pegawai ON judul_spb.id_pegawai = ms_pegawai.id_pegawai
                                              LEFT JOIN ms_plant ON ms_slock.id_plant = ms_plant.id_plant
                                              LEFT JOIN ms_unit ON judul_spb.id_unit = ms_unit.id_unit
                                              LEFT JOIN `user` ON judul_spb.entry_user = `user`.id_user
                                              LEFT JOIN ms_pegawai AS p2 ON `user`.id_pegawai = p2.id_pegawai
                      WHERE
                      judul_spb.no_bukti = '$no_bukti'
                      ORDER BY
                                              judul_spb.tgl_trans asc


                      ";
          //echo($query_data);
                      //$query_driver="SELECT * from ms_pegawai where id_jabatan=40";
          $q_detail="SELECT
                      judul_spb.no_bukti,
                      detail_spb.kd_barang,
                      ms_barang.nama AS nama_barang,
                      ms_barang.part_number AS part_number,
                      detail_spb.qty,
                      IFNULL(ms_barang.harga_beli,0) as harga_beli
                      FROM
                      detail_spb
                      INNER JOIN judul_spb ON judul_spb.no_bukti = detail_spb.no_bukti
                      INNER JOIN ms_barang ON detail_spb.kd_barang = ms_barang.id_barang
                      WHERE
                      detail_spb.no_bukti = '$no_bukti'";
          $q_unit="SELECT
                      ms_plant.id_plant,
                      ms_plant.nama,
                      ms_unit.id_unit
                      FROM
                      judul_spb
                      INNER JOIN ms_slock ON judul_spb.id_slock = ms_slock.id_slock
                      INNER JOIN ms_plant ON ms_slock.id_plant = ms_plant.id_plant
                      INNER JOIN ms_unit ON ms_unit.id_plant = ms_plant.id_plant
                      WHERE
                      judul_spb.no_bukti = '$no_bukti'
                      ORDER BY
                      judul_spb.tgl_trans asc";
          $q_pegawai="SELECT
                      ms_plant.id_plant,
                      ms_plant.nama as nama_plant,
                      ms_pegawai.id_pegawai,
                      ms_pegawai.nama as nama_pegawai
                      FROM
                      judul_spb
                      INNER JOIN ms_slock ON judul_spb.id_slock = ms_slock.id_slock
                      INNER JOIN ms_plant ON ms_slock.id_plant = ms_plant.id_plant
                      INNER JOIN ms_pegawai ON ms_pegawai.id_plant = ms_plant.id_plant
                      WHERE
                      judul_spb.no_bukti = '$no_bukti'
                      ORDER BY
          judul_spb.tgl_trans asc";
          $data['data_spb'] = $this->Bis_model->manualQuery($query_data);
          $data['data_detail_spb'] = $this->Bis_model->manualQuery($q_detail);
          $data['data_unit'] = $this->Bis_model->manualQuery($q_unit);
          $data['data_pegawai'] = $this->Bis_model->manualQuery($q_pegawai);
        //  $data['data_driver'] = $this->Bis_model->manualQuery($query_driver);
          $data['jabatan'] = $this->Login_m->get_jabatan();
          $data['users'] = $this->Hak_Akses_m->get_user();
          $data['menu'] = $this->Menu_m->get_menu($id);
          $data['submenu'] = $this->Menu_m->get_submenu($id);
          $this->load->view('Sitranst_baru',$data);
        }
  function hapus()
  {
    $id['no_bukti'] = $this->uri->segment(3);
    $this->db->trans_begin();
    $this->Bis_model->deleteData('judul_si',$id);
    $this->Bis_model->deleteData('detail_si',$id);
    if ($this->db->trans_status() === FALSE)
    {
            $this->db->trans_rollback();
    }
    else
    {
            $this->db->trans_commit();
            $this->session->set_flashdata('message', 'Sukses delete.');
            $this->session->set_flashdata('jenis', 'danger');
            redirect(site_url('Sitranst'));
    }
  }

function cetak()
    {
      $id['no_bukti'] = $this->uri->segment(3);
      $no_bukti=$this->uri->segment(3);
      $id = get_cookie('eklinik');

 	    $query_data="SELECT
                  judul_si.no_bukti,
                  judul_si.tgl_trans,
                  armaster.npa,
                  armaster.nama AS nama_customer,
                  judul_si.jenis_bayar,
                  judul_si.jenis_ppn,
                  judul_si.diskon,
                  judul_si.dpp,
                  judul_si.ppn,
                  judul_si.total,
                  judul_si.subtotal,
                  judul_si.voucher,
                  judul_si.jml_cicilan,
                  judul_si.entry_user,
                  judul_si.entry_date,
                  a.nama AS nama_pegawai,
                  judul_si.kd_sub_unit_anggota,
                  judul_si.kd_sub_unit,
                  c.kd_unit,
                  `x2`.nama_unit AS nama_unit_anggota,
                  re.nama_unit AS nama_unit_transaksi,
                  re.kd_unit AS kd_unit_transaksi
                  FROM
                  judul_si
                  LEFT JOIN armaster ON judul_si.id_customer = armaster.npa
                  LEFT JOIN mastersubunit AS c ON judul_si.kd_sub_unit_anggota = c.kd_sub_unit
                  LEFT JOIN `user` ON judul_si.entry_user = `user`.id_user
                  LEFT JOIN ms_pegawai AS a ON `user`.id_pegawai = a.id_pegawai
                  LEFT JOIN masterunit AS `x2` ON c.kd_unit = `x2`.kd_unit
                  LEFT JOIN mastersubunit AS cd ON judul_si.kd_sub_unit = cd.kd_sub_unit
                  LEFT JOIN masterunit AS re ON cd.kd_unit = re.kd_unit
                  WHERE judul_si.no_bukti  = '$no_bukti'";
         //echo($query_data);
                      //$query_driver="SELECT * from ms_pegawai where id_jabatan=40";
          $q_detail="SELECT
                      detail_si.kd_barang,
                      detail_si.hj,
                      detail_si.dpp,
                      detail_si.nilaippn,
                      detail_si.qty,
                      detail_si.diskon,
                      detail_si.perc_diskon,
                      detail_si.total,
                      detail_si.satuan,
                      ms_barang.barcode,
                      detail_si.nama_barang,
                      judul_si.no_bukti
                      FROM
                      judul_si
                      INNER JOIN detail_si ON judul_si.no_bukti = detail_si.no_bukti
                      INNER JOIN ms_barang ON detail_si.kd_barang = ms_barang.id_barang
                      WHERE
                      judul_si.no_bukti = '$no_bukti'";
            $q_detail="SELECT
detail_si.kd_barang,
detail_si.hj,
detail_si.dpp,
detail_si.nilaippn,
Sum(detail_si.qty) AS qty,
detail_si.diskon,
detail_si.perc_diskon,
Sum(detail_si.total) AS total,
detail_si.satuan,
ms_barang.barcode,
detail_si.nama_barang,
judul_si.no_bukti
FROM
                      judul_si
                      INNER JOIN detail_si ON judul_si.no_bukti = detail_si.no_bukti
                      INNER JOIN ms_barang ON detail_si.kd_barang = ms_barang.id_barang
WHERE
                      judul_si.no_bukti = '$no_bukti'
GROUP BY
detail_si.kd_barang ";

	    $data['data_si'] = $this->Bis_model->manualQuery($query_data);
      $data['detail_si'] = $this->Bis_model->manualQuery($q_detail);

      $data['users'] = $this->Hak_Akses_m->get_user();
      $data['menu'] = $this->Menu_m->get_menu($id);
      $data['submenu'] = $this->Menu_m->get_submenu($id);
      $this->load->view('report/Cetaksitranst',$data);
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
                      judul_po.no_bukti,
                      judul_po.tgl_trans,
                      judul_po.id_pegawai,
                      judul_po.id_unit,
                      judul_po.id_slock,
                      judul_po.keterangan,
                      judul_po.status_po,
                      judul_po.status_approve,
                      judul_po.user_approve,
                      judul_po.approve_date,
                      judul_po.no_spp,
                      ms_pegawai.nama AS user_entry,
                      ms_slock.nama AS slock,
                      ms_plant.nama AS nama_plant,
                      p1.nama AS nama_pegawai
    FROM
                      judul_po
                      LEFT JOIN judul_spb ON judul_po.no_spp = judul_spb.no_bukti
                      INNER JOIN `user` ON judul_po.entry_user = `user`.id_user
                      INNER JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
                      INNER JOIN ms_slock ON judul_po.id_slock = ms_slock.id_slock
                      INNER JOIN ms_plant ON ms_slock.id_plant = ms_plant.id_plant
                      INNER JOIN ms_pegawai AS p1 ON judul_po.id_pegawai = p1.id_pegawai

                          WHERE
                          judul_po.no_bukti = '$no_bukti'


                          ";
              //echo($query_data);
                          //$query_driver="SELECT * from ms_pegawai where id_jabatan=40";
              $q_detail="SELECT
    judul_po.no_bukti,
    detail_po.kd_barang,
    ms_barang.nama AS nama_barang,
    detail_po.qty,
    detail_po.hb as harga_beli,
    ms_barang.part_number
    FROM
                          detail_po
                          INNER JOIN judul_po ON judul_po.no_bukti = detail_po.no_bukti
                          INNER JOIN ms_barang ON detail_po.kd_barang = ms_barang.id_barang

                          WHERE
                          judul_po.no_bukti = '$no_bukti'";

    	  $data['data_po'] = $this->Bis_model->manualQuery($query_data);
          $data['detail_po'] = $this->Bis_model->manualQuery($q_detail);

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
