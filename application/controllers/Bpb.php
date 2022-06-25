<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bpb extends CI_Controller
{
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
    $kd_unit=$this->session->userdata('kd_unit'.$id);
    //$id = get_cookie('eklinik');
    $kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
    $ses_id_jenis=$this->session->userdata('id_jenis'.$id);

    if($ses_id_jenis<3)
    {
      //$dan=" WHERE ms_barang.status_aktif=1";
       $dan="";
    }
    else {
       //$dan=" WHERE detail_ms_barang.kd_sub_unit = '$kd_sub_unit' AND ms_barang.status_aktif=1";
       $dan =" WHERE
         masterunit.kd_unit = '$kd_unit'";

    }


    $query_supplier="SELECT  DISTINCT
              ms_supplier.id_supplier,
              ms_supplier.nama as nama_supplier
              FROM
              trans_spp
              INNER JOIN ms_supplier ON trans_spp.id_supplier = ms_supplier.id_supplier";
    $query_po="SELECT judul_po.no_bukti AS no_po,
              judul_po.no_bpb,
              judul_po.tgl_trans,
              judul_po.id_supplier,
              ms_supplier.nama AS nama_supplier,
              judul_po.keterangan,
              CONCAT(judul_po.no_bukti,' | ',judul_po.tgl_trans,' | ',ms_supplier.nama) as ket
              FROM
              judul_po
              INNER JOIN ms_supplier ON judul_po.id_supplier = ms_supplier.id_supplier
              WHERE judul_po.no_bukti not in(select no_po from judul_bpb)";


    $query_data="SELECT
                	judul_bpb.no_bukti,
                	judul_bpb.no_po,
                	judul_bpb.tipe,
                	judul_bpb.tgl_trans,
                	judul_bpb.keterangan,
                	judul_bpb.id_supplier,
                	ms_supplier.nama AS nama_supplier,
                	judul_bpb.subtotal,
                	judul_bpb.diskon,
                	judul_bpb.dpp,
                	judul_bpb.ppn,
                	judul_bpb.total,
                	judul_bpb.jenis_bayar,
                	judul_bpb.top,
                	judul_bpb.jenis_ppn,
                	judul_bpb.no_ref,
                	ms_supplier.alamat,
                	masterunit.nama_unit,
                	ms_pegawai.nama AS nama_pegawai
                FROM
                	judul_bpb
                LEFT JOIN ms_supplier ON judul_bpb.id_supplier = ms_supplier.id_supplier
                LEFT JOIN mastersubunit ON judul_bpb.kd_sub_unit = mastersubunit.kd_sub_unit
                LEFT JOIN masterunit ON mastersubunit.kd_unit = masterunit.kd_unit
                INNER JOIN `user` ON judul_bpb.entry_user = `user`.id_user
                INNER JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
                $dan ";
$data=array(
    'title'=>'Data Pembelian',
    'xmenu'=>'Barang Masuk',
    'xsubmenu'=>'Pembelian',
    'data_po'=>$this->Bis_model->manualQuery($query_po),
    'data_bpb' =>$this->Bis_model->manualQuery($query_data),
    'users'=>$this->Hak_Akses_m->get_user(),
    'menu'=>$this->Menu_m->get_menu($id),
    'submenu'=>$this->Menu_m->get_submenu($id),
);

    $this->load->view('Bpb_view',$data);
  }

  function bpbpo()
  {
    $id = get_cookie('eklinik');
    $this->load->model('Menu_m');
    $this->load->model('Hak_Akses_m');
    $this->load->model('Login_m');
    $data['data_jabatan'] = $this->Bis_model->getAllData('ms_jabatan');
    $query_plant="SELECT * from ms_plant";
    $data['data_plant'] = $this->Bis_model->manualQuery($query_plant);
    $query_supplier="SELECT  DISTINCT
              ms_supplier.id_supplier,
              ms_supplier.nama as nama_supplier
              FROM
              trans_spp
              INNER JOIN ms_supplier ON trans_spp.id_supplier = ms_supplier.id_supplier";
    $query_po="SELECT
              judul_po.no_bukti AS no_po,
              judul_po.no_bpb,
              judul_po.tgl_trans,
              judul_po.id_supplier,
              ms_supplier.nama AS nama_supplier,
              judul_po.keterangan,
              CONCAT(
              		judul_po.no_bukti,
              		' | ',
              		judul_po.tgl_trans,
              		' | ',
              		ms_supplier.nama
              	) AS ket,
              judul_po.status_po
              FROM
              	judul_po
              INNER JOIN ms_supplier ON judul_po.id_supplier = ms_supplier.id_supplier
              WHERE judul_po.status_po=1";
    //echo $query_po;
    $data['data_po'] = $this->Bis_model->manualQuery($query_po);
    $query_pegawai="SELECT * from ms_pegawai order by nama asc";
    $data['data_pegawai'] = $this->Bis_model->manualQuery($query_pegawai);

    $data['jabatan'] = $this->Login_m->get_jabatan();
    $data['users'] = $this->Hak_Akses_m->get_user();
    $data['menu'] = $this->Menu_m->get_menu($id);
    $data['submenu'] = $this->Menu_m->get_submenu($id);
    $this->load->view('Bpb_po_view',$data);
  }
  function bpbnonpo()
  {
    $id = get_cookie('eklinik');
    $this->load->model('Menu_m');
    $this->load->model('Hak_Akses_m');
    $this->load->model('Login_m');
    $query_data="SELECT * from ms_supplier";

    $data=array(
        'title'=>'Pembelian Non PO',
        'data_supplier'=>$this->Model_app->manualQueryX($query_data),
        'menu' => $this->Menu_m->get_menu($id),
        'submenu' => $this->Menu_m->get_submenu($id),

    );
    //$this->load->view('Popart_baru',$data);
    $this->load->view('Bpbnonpo_tambah_view',$data);
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
  function get_data_barang(){
      //$id['id_supplier']=$this->input->post('id_supplier');
      $id = get_cookie('eklinik');
      $kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
      $no_po=$this->input->post('no_po');

      $id['no_bukti'] =$this->input->post('no_po');

      $no_bukti= $this->input->post('no_po');
      $id = get_cookie('eklinik');
      $this->load->model('Menu_m');
      $this->load->model('Hak_Akses_m');
      $this->load->model('Login_m');
      $data['data_jabatan'] = $this->Bis_model->getAllData('ms_jabatan');

       $query_data="select * from ms_supplier";
                   //$query_driver="SELECT * from ms_pegawai where id_jabatan=40";
       //$data['data_fpb'] = $this->Bis_model->manualQuery($query_data);

      $query_barang="select defTab.*,ms_barang.nama,ms_barang.part_number, ms_barang.nama_alias from
          (
          SELECT
          judul_bpb.no_bukti,
          judul_bpb.tgl_trans,
          judul_bpb.kd_sub_unit,
          detail_bpb.kd_barang,
          detail_bpb.hb AS harga,
          detail_bpb.qty as qty,
          detail_bpb.hb*detail_bpb.qty as total
          FROM
          judul_bpb
          INNER JOIN detail_bpb ON judul_bpb.no_bukti = detail_bpb.no_bukti
          union all
          SELECT
          judul_si.no_bukti,
          judul_si.tgl_trans,
          judul_si.kd_sub_unit,
          detail_si.kd_barang,
          detail_si.hj as harga,
          -1*detail_si.qty as qty,
          detail_si.hj*detail_si.qty as total
          FROM
          detail_si
          INNER JOIN judul_si ON judul_si.no_bukti = detail_si.no_bukti

          ) as defTab

          INNER JOIN ms_barang ON defTab.kd_barang=ms_barang.id_barang
          WHERE defTab.kd_barang='$no_po' and defTab.kd_sub_unit='$kd_sub_unit'
          ORDER BY defTab.tgl_trans asc ";

     $data=array(
          'title'=>'Edit Surat Permintaan Pembelian (PO)',
          'data_supplier'=>$this->Model_app->manualQueryX($query_data),
          'menu' => $this->Menu_m->get_menu($id),
          'submenu' => $this->Menu_m->get_submenu($id),
          'jabatan' => $this->Login_m->get_jabatan(),
          'users' => $this->Hak_Akses_m->get_user(),
          'data_barang' => $this->Bis_model->manualQuery($query_barang),


      );

      //$this->load->view('Popart_edit',$data);
      //$data['detail_data_po'] = $this->Bis_model->manualQuery($q_data);
      //$data['judul_data_po'] = $this->Bis_model->manualQuery($q_data_judul);
                                      // $data=array('detail_po_rent'=>$this->Bis_model->getSelectedData('trans_po_rental',$id)->result(),);
      //$data=array('detail_data_spp'=>$this->Bis_model->getDataX($q_data),);
      $this->load->view('ajax_data_barang',$data);
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


  function realisasipo()
  {
    $no_ppd = $this->uri->segment(3);
    $id = get_cookie('eklinik');
    $this->load->model('Menu_m');
    $this->load->model('Hak_Akses_m');
    $this->load->model('Login_m');
    $data['data_jabatan'] = $this->Bis_model->getAllData('ms_jabatan');

   $query_plant="SELECT * from ms_plant";
   $data['data_plant'] = $this->Bis_model->manualQuery($query_plant);
   $query_slock="SELECT * from ms_supplier";
   $data['data_supplier'] = $this->Bis_model->manualQuery($query_slock);
   $query_pegawai="SELECT * from ms_pegawai order by nama asc";
   $data['data_pegawai'] = $this->Bis_model->manualQuery($query_pegawai);
   $query_ppd="SELECT
                                trans_ppd.no_ppd,
                                trans_ppd.tgl_ppd,
                                trans_ppd.id_budget,
                                CONCAT(ms_divisi.nama,' : ',ms_departement.nama,' - ',ms_beban.nama) AS nama,
                                trans_ppd.kd_supplier,
                                trans_ppd.status_ppd,
                                trans_ppd.approved_ppd_1,
                                trans_ppd.approved_date_1,
                                trans_ppd.approved_ppd_2,
                                trans_ppd.approved_date_2,
                                trans_ppd.modul_asal as jenis,
                                trans_ppd.nominal,
                                trans_ppd.nominal1,
                                trans_ppd.nominal2 AS nominal2_lama,
                                IFNULL(-1*x.jml_trans, 0) AS cair,
                                trans_ppd.nominal2 + IFNULL(x.jml_trans, 0) AS nominal2,
                                trans_ppd.penerima,
                                trans_ppd.keterangan,
                                trans_ppd.entry_date,
                                trans_ppd.edit_user,
                                trans_ppd.edit_date,
                                set_budget.tahun,
                                set_budget.nominal AS budget_awal,
                                ms_departement.id_departement,
                                ms_departement.nama AS nama_departement,
                                ms_beban.id_beban,
                                ms_beban.nama AS nama_beban,
                                ms_divisi.id_divisi,
                                ms_divisi.nama AS nama_divisi,
                                ms_plant.id_plant,
                                ms_plant.nama AS nama_plant,
                                user_entry.id_user AS id_entry,
                                user_approve1.id_user AS id_ap1,
                                user_approve2.id_user AS id_ap2,
                                user_approve1.email,
                                user_entry.email,
                                user_approve2.email,
                                ucase(pentry.nama) as nama_pegawai,
                                ucase(p2.nama) as nama_approve2,
                                p2.id_pegawai as id_peg_ap2,
                                pentry.id_pegawai as id_peg_entry,
                                p1.id_pegawai as id_peg_ap1,
                                ucase(p1.nama) as nama_approve1
                                FROM
                                trans_ppd
                                INNER JOIN set_budget ON trans_ppd.id_budget = set_budget.id_budget
                                INNER JOIN ms_departement ON set_budget.id_departement = ms_departement.id_departement
                                INNER JOIN ms_divisi ON ms_departement.id_divisi = ms_divisi.id_divisi
                                INNER JOIN ms_plant ON ms_divisi.id_plant = ms_plant.id_plant
                                INNER JOIN ms_beban ON set_budget.id_beban = ms_beban.id_beban
                                LEFT JOIN (SELECT trans_kb.no_ppd,Sum(trans_kb.jml_trans) as jml_trans FROM trans_kb GROUP BY trans_kb.no_ppd ) AS x ON trans_ppd.no_ppd = x.no_ppd
                                INNER JOIN `user` AS user_entry ON trans_ppd.entry_user = user_entry.id_user
                                INNER JOIN `user` AS user_approve2 ON trans_ppd.user_approved_2 = user_approve2.id_user
                                INNER JOIN `user` AS user_approve1 ON trans_ppd.user_approved_1 = user_approve1.id_user
                                INNER JOIN ms_pegawai AS pentry ON user_entry.id_pegawai = pentry.id_pegawai
                                INNER JOIN ms_pegawai AS p2 ON user_approve2.id_pegawai = p2.id_pegawai
                                INNER JOIN ms_pegawai AS p1 ON user_approve1.id_pegawai = p1.id_pegawai
                                WHERE
                                trans_ppd.no_ppd='$no_ppd'";
  //echo $query_ppd;
    $query_data="SELECT
                judul_po.no_bukti,
                judul_po.tgl_trans,
                judul_po.jenis_bayar,
                judul_po.top,
                judul_po.jenis_ppn,
                judul_po.no_ref,
                judul_po.subtotal,
                judul_po.diskon,
                judul_po.dpp,
                judul_po.ppn,
                judul_po.total,
                judul_po.dp,
                judul_po.keterangan,
                ms_supplier.id_supplier,
                ms_supplier.nama AS nama_supplier,
                judul_po.no_ppd,
                trans_ppd.nominal2,
                trans_ppd.keterangan AS ket_ppd
                FROM
                judul_po
                LEFT JOIN ms_supplier ON judul_po.id_supplier = ms_supplier.id_supplier
                LEFT JOIN trans_ppd ON judul_po.no_ppd = trans_ppd.no_ppd";
                //$query_driver="SELECT * from ms_pegawai where id_jabatan=40";
    $data['data_po'] = $this->Bis_model->manualQuery($query_data);
    $data['data_ppd'] = $this->Bis_model->manualQuery($query_ppd);
  //  $data['data_driver'] = $this->Bis_model->manualQuery($query_driver);
    $data['jabatan'] = $this->Login_m->get_jabatan();
    $data['users'] = $this->Hak_Akses_m->get_user();
    $data['menu'] = $this->Menu_m->get_menu($id);
    $data['submenu'] = $this->Menu_m->get_submenu($id);
    $this->load->view('Potrans_view',$data);
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
	  //$query_data="SELECT * from ms_supplier";
    //$query_anggota="SELECT * from armaster where status_anggota='Aktif'";


    $data=array(
        'title'=>'Entri Pembelian',
        'xmenu'=>'Barang Masuk',
        'xsubmenu'=>'Pembelian',
        //'data_supplier'=>$this->Bis_model->manualQuery($query_data),
        //'data_anggota'=>$this->Bis_model->manualQuery($query_anggota),
        //'data_barang'=>$this->Bis_model->manualQuery($query_barang),
        'users'=>$this->Hak_Akses_m->get_user(),
        'menu'=>$this->Menu_m->get_menu($id),
        'submenu'=>$this->Menu_m->get_submenu($id),
    );


    $this->load->view('Bpb_baru',$data);
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
      $kode_bukti="BPB".$pad_kd_sub_unit.$year.$month;
      $cookie_id_user = get_cookie('eklinik');
      $tempo=$this->input->post('top');
      date_add($date,date_interval_create_from_date_string("$tempo days"));
      $newDate=date_format($date,"Y-m-d");
      $no_bukti= $this->Bis_model->getIdBPB($kode_bukti);
      $data=array(
              'no_bukti'=>$no_bukti,
              'no_ref'=>$this->input->post('no_ref'),
              'no_po'=>$this->input->post('no_po'),
              'tgl_trans'=>$this->input->post('tgl_trans'),
          		'id_supplier'=>$this->input->post('id_supplier'),
          		'id_sales'=>$this->input->post('id_pegawai'),
          		'jenis_bayar'=>$this->input->post('jenis_bayar'),
          		'top'=>$this->input->post('top'),
          		'jenis_ppn'=>$this->input->post('jenis_ppn'),
          		'no_ref'=>$this->input->post('no_ref'),
              'kd_sub_unit'=>$kd_sub_unit,
          		'subtotal'=>$this->input->post('grandtotal'),
          		//'diskon'=>$this->input->post('diskon'),
          		'dpp'=>$this->input->post('totdpp'),
          		'ppn'=>$this->input->post('totppn'),
              'tipe'=>$this->input->post('tipe'),
          		//'total'=>$this->input->post('grandtotal'),
          		//'dp'=>$this->input->post('dp'),
          		'keterangan'=>$this->input->post('keterangan'),
              'entry_user'=>$cookie_id_user,
              'entry_date'=>$now,
      );
      $kode_ap="/SUP/".$month."/".$year;
      $no_ap=$this->Bis_model->getIdAp($kode_ap);

      //$dp=$this->input->post('dp');
      $dataap=array(
        'no_bukti'=>$no_ap,
        'no_po'=>$no_bukti,
        'id_supplier'=>$this->input->post('id_supplier'),
        'tgl_trans'=>$this->input->post('tgl_trans'),
        'tgl_j_tmp'=>$newDate,
        'type_trans'=>'AP',
        'type_bayar'=>$this->input->post('jenis_bayar'),
        'type_invoice'=>'HUT',
        'jml_trans'=>$this->input->post('total'),
        'keterangan'=>$this->input->post('keterangan'),
        'entry_user'=>$cookie_id_user,
        'entry_date'=>$now,

      );
      $nilaiHutang=$this->input->post('total');
      $nilaiDpp=$this->input->post('dpp');
      $nilaiPpn=$this->input->post('ppn');
      $keterangan=$this->input->post('keterangan');
      $jurnalhutang=array(
              'no_bukti'=>$no_bukti,
              'kd_akun'=>$this->input->post('j_hutang'),
              'no_baris'=>1,
              'tgl_trans'=>$this->input->post('tgl_trans'),
              'modul_asal'=>$this->input->post('modul_asal'),
              'tipe_trans'=>1,
              'kd_reklas'=>$this->input->post('kd_reklas'),
              'keterangan'=>$keterangan,
              'jml_D'=>$nilaiHutang,
              'jml_K'=>0,
              'del_indek'=>"PO",
              'entry_date'=>$now,
              'user_entry'=>$cookie_id_user,
              'jml_trans'=>0,
              'tipe_bayar'=>$this->input->post('tipe_bayar'),
              'kd_jp'=>$this->input->post('kd_jp'),
              'id_sloc'=>$this->input->post('id_sloc'),
              'id_plant'=>$this->input->post('id_plant'),
      );
      $jurnaldpp=array(
              'no_bukti'=>$no_bukti,
              'kd_akun'=>$this->input->post('j_dpp'),
              'no_baris'=>2,
              'tgl_trans'=>$this->input->post('tgl_trans'),
              'modul_asal'=>$this->input->post('modul_asal'),
              'tipe_trans'=>1,
              //'kd_reklas'=>$this->input->post('kd_reklas'),
              'keterangan'=>$keterangan,
              'jml_D'=>0,
              'jml_K'=>$nilaiDpp,
              'del_indek'=>"SI",
              'entry_date'=>$now,
              'user_entry'=>$cookie_id_user,
              'jml_trans'=>0,
              'tipe_bayar'=>$this->input->post('tipe_bayar'),
              'kd_jp'=>$this->input->post('kd_jp'),
              'id_sloc'=>$this->input->post('id_sloc'),
              'id_plant'=>$this->input->post('id_plant'),
      );
      $jurnalppn=array(
              'no_bukti'=>$no_bukti,
              'kd_akun'=>$this->input->post('j_ppn'),
              'no_baris'=>3,
              'tgl_trans'=>$this->input->post('tgl_trans'),
              'modul_asal'=>$this->input->post('modul_asal'),
              'tipe_trans'=>1,
              //'kd_reklas'=>$this->input->post('kd_reklas'),
              'keterangan'=>$keterangan,
              'jml_D'=>0,
              'jml_K'=>$nilaiPpn,
              'del_indek'=>"SI",
              'entry_date'=>$now,
              'user_entry'=>$cookie_id_user,
              'jml_trans'=>0,
              'tipe_bayar'=>$this->input->post('tipe_bayar'),
              'kd_jp'=>$this->input->post('kd_jp'),
              'id_sloc'=>$this->input->post('id_sloc'),
              'id_plant'=>$this->input->post('id_plant'),
      );


      $this->db->trans_off();
      $this->db->trans_begin();
      $this->db->trans_strict(true);
      $this->Bis_model->insertData('judul_bpb',$data);
      //$this->Bis_model->insertData('ap_trans',$dataap);
      if ($nilaiHutang>0)
      {
           //$this->Bis_model->insertData('gltransjalan',$jurnalhutang);
      }

      if ($nilaiDpp>0)
      {
          //$this->Bis_model->insertData('gltransjalan',$jurnaldpp);
      }

      if ($nilaiPpn>0)
      {
        //$this->Bis_model->insertData('gltransjalan',$jurnalppn);
      }


      $inserted_count = 0;
  		//insert gl

  		foreach ($this->input->post('rowsBM') as $key => $count )
      {
            //if($jenis_ppn=="NON"){
            //$ppn=0;
            //}
            //else {
            //  $ppn=$this->input->post('hb_'.$count)*0.1;
            //}
            $datax=array(
            'no_bukti'=>$no_bukti,
            'kd_barang'=>$this->input->post('id_barang_'.$count),
            'hb'=>$this->input->post('hb_'.$count),
            'dpp'=>$this->input->post('dpp_'.$count),
            'nilaippn'=>$ppn,
            'qty'=>$this->input->post('qty_'.$count),
            'nama_barang'=>$this->input->post('nama_barang_'.$count),
            'diskon'=>$this->input->post('diskon_'.$count),
            'perc_diskon'=>$this->input->post('perc_diskon_'.$count),
            'total'=>$this->input->post('total_'.$count),
            'satuan'=>$this->input->post('satuan_'.$count),
          );
          $this->Bis_model->insertData('detail_bpb',$datax);

          $idbarang=array(
            'kd_barang' => $this->input->post('kode_barang_'.$count),
            'kd_sub_unit' => $kd_sub_unit,
          );

          $datapart=array(
          'hb'=>$this->input->post('hb_'.$count),
          //'harga_tranfer'=>$this->input->post('hb_'.$count),
          //'status_spp'=>4,
          );
          $this->Bis_model->updateData('detail_ms_barang',$datapart,$idbarang);

      }
      //update ke spp untuk spp sudah di POkan
            $xpo=$this->input->post('tipe');
            $id['no_bukti'] = $xpo;
            $datapo=array(
              'status_po'=>0,
            //'status_spp'=>4,
            );
            //$this->Bis_model->updateData('judul_po',$datapo,$id);
          //update ke harga terbaru



      $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE)
      {
              $this->db->trans_rollback();
              $this->session->set_flashdata('message', 'Gagal input data produksi.');
              $this->session->set_flashdata('jenis', 'danger');
              redirect(site_url('Bpb/baru'));
      }
      else
      {
              $this->db->trans_commit();
              $this->session->set_flashdata('message', 'Sukses tambah data baru.');
              $this->session->set_flashdata('jenis', 'success');
              redirect(site_url('Bpb/baru'));
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
          'no_ref'=>$this->input->post('no_ref'),
          'no_po'=>$this->input->post('no_po'),
          'tgl_trans'=>$this->input->post('tgl_trans'),
          'id_supplier'=>$this->input->post('id_supplier'),
          'id_sales'=>$this->input->post('id_pegawai'),
          'jenis_bayar'=>$this->input->post('jenis_bayar'),
          'top'=>$this->input->post('top'),
          'jenis_ppn'=>$this->input->post('jenis_ppn'),
          'subtotal'=>$this->input->post('subtotal'),
          'diskon'=>$this->input->post('diskon'),
          'dpp'=>$this->input->post('dpp'),
          'ppn'=>$this->input->post('ppn'),
          'tipe'=>$this->input->post('tipe'),
          'total'=>$this->input->post('total'),
          'dp'=>$this->input->post('dp'),
          'keterangan'=>$this->input->post('keterangan'),
          'entry_user'=>$cookie_id_user,
          'entry_date'=>$now,
          'edit_user'=>$cookie_id_user,
          'edit_date'=>$now,
        );
        $this->db->trans_off();
        $this->db->trans_begin();
        $this->db->trans_strict(true);
        $this->Bis_model->updateData('judul_bpb',$data,$id);
        $this->Bis_model->deleteData('detail_bpb',$id);
        //$inserted_count = 0;
    		//insert gl

    		foreach ($this->input->post('rowsBM') as $key => $count )
        {
          if($jenis_ppn=="NON"){
          $ppn=0;
          }
          else {
            $ppn=$this->input->post('hb_'.$count)*0.1;
          }
              $datax=array(
          'no_bukti'=>$no_bukti,
          'kd_barang'=>$this->input->post('kode_barang_'.$count),
          'qty'=>$this->input->post('qty_'.$count),
          'hb'=>$this->input->post('hb_'.$count),
          'ppn'=>$ppn,
          );
          $this->Bis_model->insertData('detail_bpb',$data);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                $this->session->set_flashdata('message', 'Gagal input data produksi.');
                $this->session->set_flashdata('jenis', 'danger');
                redirect(site_url('Bpb'));
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses edit data.');
                $this->session->set_flashdata('jenis', 'success');
                redirect(site_url('Bpb'));
        }
        }

      function edit()
      {
          $id['no_bukti'] = $this->uri->segment(3);

          $no_bukti= $this->uri->segment(3);
          $id = get_cookie('eklinik');

          $query_data="SELECT
                      	judul_bpb.no_bukti,
                      	judul_bpb.no_po,
                      	judul_bpb.tipe,
                      	judul_bpb.tgl_trans,
                      	judul_bpb.keterangan,
                      	judul_bpb.id_supplier,
                      	ms_supplier.nama AS nama_supplier,
                      	judul_bpb.subtotal,
                      	judul_bpb.diskon,
                      	judul_bpb.dpp,
                      	judul_bpb.ppn,
                      	judul_bpb.total,
                      	judul_bpb.jenis_bayar,
                      	judul_bpb.top,
                      	judul_bpb.jenis_ppn,
                      	judul_bpb.no_ref,
                      	ms_supplier.alamat
                      FROM
                      judul_bpb
                      INNER JOIN ms_supplier ON judul_bpb.id_supplier = ms_supplier.id_supplier
                      WHERE
                      judul_bpb.no_bukti = '$no_bukti'

                      ";
          //echo($query_data);
                      //$query_driver="SELECT * from ms_pegawai where id_jabatan=40";
          $q_detail="SELECT
                    	judul_bpb.no_bukti,
                    	judul_bpb.tgl_trans,
                    	judul_bpb.id_supplier,
                    	detail_bpb.kd_barang,
                    	detail_bpb.hb as harga_beli,
                    	detail_bpb.qty,
                    	ms_barang.part_number,
                    	upper(ms_barang.nama) as nama_barang
                    FROM
                    	judul_bpb
                    INNER JOIN detail_bpb ON judul_bpb.no_bukti = detail_bpb.no_bukti
                    INNER JOIN ms_barang ON detail_bpb.kd_barang = ms_barang.id_barang
                    WHERE
                    judul_bpb.no_bukti = '$no_bukti'";
                    //echo($q_detail);
          $q_pegawai="select * from ms_pegawai order by nama asc";
          $data['title'] = "Edit Pembelian Non PO";
          $data['data_bpb_edit'] = $this->Bis_model->manualQuery($query_data);
          $data['detail_data_bpb'] = $this->Bis_model->manualQuery($q_detail);
          $data['data_pegawai'] = $this->Bis_model->manualQuery($q_pegawai);
          $data['jabatan'] = $this->Login_m->get_jabatan();
          $data['users'] = $this->Hak_Akses_m->get_user();
          $data['menu'] = $this->Menu_m->get_menu($id);
          $data['submenu'] = $this->Menu_m->get_submenu($id);
          $this->load->view('Bpbnonpo_edit_view',$data);
        }
  function hapus()
  {
    $xno_bukti = str_replace('_', '/', $this->uri->segment(3));

    $id['no_bukti'] = $xno_bukti;
    $idx['no_po'] = $xno_bukti;
    $this->db->trans_begin();
    $no_pox='';
    $dataspp=array(
          'no_po'=>$no_pox,
          'status_spp'=>3,
          );
        //$this->Bis_model->updateData('trans_spp',$dataspp,$idx);


    $this->Bis_model->deleteData('judul_bpb',$id);
    $this->Bis_model->deleteData('detail_bpb',$id);
    if ($this->db->trans_status() === FALSE)
    {
            $this->db->trans_rollback();
    }
    else
    {
            $this->db->trans_commit();
            $this->session->set_flashdata('message', 'Sukses delete.');
            $this->session->set_flashdata('jenis', 'danger');
            redirect(site_url('Bpb'));
    }
  }

function cetak()
    {
      $xno_bukti = str_replace('_', '/', $this->uri->segment(3));

      $id['no_bukti'] = $xno_bukti;
      $no_bukti=$xno_bukti;

      $id = get_cookie('eklinik');

 	    $query_data="SELECT
                judul_bpb.no_bukti,
                judul_bpb.no_po,
                judul_bpb.tipe,
                judul_bpb.tgl_trans,
                judul_bpb.keterangan,
                judul_bpb.id_supplier,
                ms_supplier.nama AS nama_supplier,
                judul_bpb.subtotal,
                judul_bpb.diskon,
                judul_bpb.dpp,
                judul_bpb.ppn,
                judul_bpb.total,
                judul_bpb.jenis_bayar,
                judul_bpb.top,
                judul_bpb.jenis_ppn,
                judul_bpb.no_ref,
                ms_supplier.alamat,
                masterunit.nama_unit,
                ms_pegawai.nama AS nama_pegawai
                FROM
                judul_bpb
                LEFT JOIN ms_supplier ON judul_bpb.id_supplier = ms_supplier.id_supplier
                LEFT JOIN mastersubunit ON judul_bpb.kd_sub_unit = mastersubunit.kd_sub_unit
                LEFT JOIN masterunit ON mastersubunit.kd_unit = masterunit.kd_unit
                INNER JOIN `user` ON judul_bpb.entry_user = `user`.id_user
                INNER JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
                WHERE judul_bpb.no_bukti = '$no_bukti'";
          //echo($query_data);
                      //$query_driver="SELECT * from ms_pegawai where id_jabatan=40";
       $q_detail="SELECT
                    judul_bpb.no_bukti,
                    ms_barang.nama AS nama_barang,
                    ms_barang.barcode,
                    detail_bpb.hb,
                    detail_bpb.dpp,
                    detail_bpb.ppn,
                    detail_bpb.qty,
                    detail_bpb.nilaippn,
                    detail_bpb.diskon,
                    detail_bpb.perc_diskon,
                    detail_bpb.total,
                    detail_bpb.satuan,
                    detail_bpb.kd_barang
                    FROM
                    judul_bpb
                    INNER JOIN detail_bpb ON judul_bpb.no_bukti = detail_bpb.no_bukti
                    INNER JOIN ms_barang ON detail_bpb.kd_barang = ms_barang.id_barang
                    WHERE  judul_bpb.no_bukti = '$no_bukti'";

	    $data['data_bpb'] = $this->Bis_model->manualQuery($query_data);
      $data['detail_bpb'] = $this->Bis_model->manualQuery($q_detail);

      $data['users'] = $this->Hak_Akses_m->get_user();
      $data['menu'] = $this->Menu_m->get_menu($id);
      $data['submenu'] = $this->Menu_m->get_submenu($id);
      $this->load->view('report/Cetakbpb',$data);
    }

  function exportexcel()
  {

    $this->load->model('idh/IDH_m');
    $data['idh'] = $this->IDH_m->get_data_hauling();
    $this->load->view('Karyawan_export',$data);
  }
}
?>
