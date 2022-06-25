<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sktrans extends CI_Controller
{
  function __construct(){
      parent::__construct();
       $this->load->model('umum/Bis_model');
       $this->load->model('umum/Bis_model_ant');
       $this->load->helper('currency_format_helper');
	   $this->load->helper('terbilang_helper');
	   $this->load->helper('format_tanggal_helper');
    }
  function index()
  {
    $id = get_cookie('eklinik');
    $this->load->model('Menu_m');
    $this->load->model('Hak_Akses_m');
    $this->load->model('Login_m');
    $data['data_jabatan'] = $this->Bis_model->getAllData('ms_jabatan');

   $query_plant="SELECT * from ms_unit";
   $data['data_unit'] = $this->Bis_model->manualQuery($query_plant);
    //$data['data_driver'] = $this->Bis_model->getAllData('ms_plant');

    $query_data="SELECT
judul_sk.no_bukti,
judul_sk.tgl_trans,
judul_sk.id_beban,
judul_sk.id_unit,
judul_sk.id_slock,
judul_sk.id_plant,
judul_sk.no_ref,
judul_sk.total,
judul_sk.ppn,
judul_sk.dpp,
judul_sk.ar,
judul_sk.keterangan,
judul_sk.status_approve,
judul_sk.user_approve,
judul_sk.approve_date,
judul_sk.entry_user,
judul_sk.entry_date,
judul_sk.edit_user,
judul_sk.edit_date,
judul_sk.jenis_bayar,
judul_sk.jenis_ppn,
judul_sk.subtotal,
ms_pegawai.nama AS nama_pegawai,
masterakun.nama AS nama_beban
FROM
judul_sk
INNER JOIN `user` ON judul_sk.entry_user = `user`.id_user
INNER JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
LEFT JOIN ms_unit ON judul_sk.id_unit = ms_unit.id_unit
LEFT JOIN masterakun ON judul_sk.id_beban = masterakun.kd_akun
ORDER BY
judul_sk.entry_date ASC
";
                //$query_driver="SELECT * from ms_pegawai where id_jabatan=40";
    $data['data_sk'] = $this->Bis_model->manualQuery($query_data);
  //  $data['data_driver'] = $this->Bis_model->manualQuery($query_driver);
    $data['jabatan'] = $this->Login_m->get_jabatan();
    $data['users'] = $this->Hak_Akses_m->get_user();
    $data['menu'] = $this->Menu_m->get_menu($id);
    $data['submenu'] = $this->Menu_m->get_submenu($id);
    $this->load->view('Sk_view',$data);
  }

  function baru(){
    $id = get_cookie('eklinik');
    $this->load->model('Menu_m');
    $this->load->model('Hak_Akses_m');
    $this->load->model('Login_m');
	  $query_slock="SELECT * from ms_customer";
    $data['data_customer'] = $this->Bis_model->manualQuery($query_slock);
    $query_plant="SELECT CONCAT(
                  ms_unit.id_unit,' | ',
                  ms_unit.keterangan,' | ',
                  ms_unit.serial_number,' | ',
                  ms_unit.tahun_produksi) as ket,
                  ms_unit.id_unit
                  from ms_unit
                  Order BY ms_unit.id_unit ASC
                  ";
    $data['data_unit'] = $this->Bis_model->manualQuery($query_plant);
    $query_beban="SELECT CONCAT(  masterakun.kd_akun,' | ',masterakun.nama) as ket,
                  masterakun.kd_akun,
                  masterakun.nama,
                  masterakun.induk,
                  masterakun.detail,
                  masterakun.`level`,
                  masterakun.`group`,
                  masterakun.total,
                  masterakun.jenis_akun,
                  masterakun.saldo_normal,
                  masterakun.finance,
                  masterakun.status_akun,
                  masterakun.user_entry,
                  masterakun.date_entry,
                  masterakun.user_edit,
                  masterakun.date_edit
                  FROM
                  masterakun
                  WHERE
                  masterakun.kd_akun LIKE '5%' and level =1";
    $data['data_beban'] = $this->Bis_model->manualQuery($query_beban);

    $query_pegawai="SELECT
            ms_pegawai.id_pegawai,
            ms_pegawai.id_departement,
            ms_pegawai.id_jabatan,
            ms_pegawai.nama,
            ms_departement.nama AS nama_departement
            FROM
            ms_pegawai
            LEFT JOIN ms_departement ON ms_pegawai.id_departement = ms_departement.id_departement
            WHERE
            ms_pegawai.id_departement = 9
            order by ms_departement.nama asc";
    $data['data_pegawai'] = $this->Bis_model->manualQuery($query_pegawai);
    $data['title'] = 'Pemakaian Beban Jo';

    $data['menu'] = $this->Menu_m->get_menu($id);
    $data['submenu'] = $this->Menu_m->get_submenu($id);


    $this->load->view('Sktrans_view',$data);
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
      $now = date('Y-m-d H:i:s');
      $date = new DateTime($this->input->post('tgl_trans'));
      $id_plant = $this->input->post('id_plant');
      $year = $date -> format('Y');
      $month = $date -> format('m');
      $day = $date -> format('d');
      $kode_bukti="SK".$year.$month;
      $cookie_id_user = get_cookie('eklinik');


      $tempo=$this->input->post('top');

      date_add($date,date_interval_create_from_date_string("$tempo days"));
      $newDate=date_format($date,"Y-m-d");

      $no_bukti= $this->Bis_model->getIdSi($kode_bukti);
      $no_sk=$this->Bis_model->getIdSk($kode_bukti);
      $kode_ar="/ENV/".$month."/".$year;
      $no_ar=$this->Bis_model->getIdAr($kode_ar);

      $dp=$this->input->post('dp');
      $dataar=array(
        'no_bukti'=>$no_ar,
        'no_si'=>$no_si,
        'id_customer'=>$this->input->post('id_customer'),
        'tgl_trans'=>$this->input->post('tgl_trans'),
        'tgl_j_tmp'=>$newDate,
        'type_trans'=>'AR',
        'type_bayar'=>$this->input->post('jenis_bayar'),
        'type_invoice'=>'PIU',
        'jml_trans'=>$this->input->post('ar'),
        'keterangan'=>$this->input->post('keterangan'),
        'entry_user'=>$cookie_id_user,
        'entry_date'=>$now,

      );
      $datadp=array(
        'no_bukti'=>$no_ar,
        'no_si'=>$no_si,
        'id_customer'=>$this->input->post('id_customer'),
        'tgl_trans'=>$this->input->post('tgl_trans'),
        'tgl_j_tmp'=>$newDate,
        'type_trans'=>'AR',
        'type_bayar'=>$this->input->post('jenis_bayar'),
        'type_invoice'=>'DP',
        'jml_trans'=>$this->input->post('dp'),
        'keterangan'=>$this->input->post('keterangan'),
        'entry_user'=>$cookie_id_user,
        'entry_date'=>$now,

      );
      $data=array(
        'no_bukti'=>$no_sk,
        'tgl_trans'=>$this->input->post('tgl_trans'),
    		'id_unit'=>$this->input->post('id_unit'),
        'id_beban'=>$this->input->post('kd_akun'),
    		'id_sales'=>$this->input->post('id_pegawai'),
    		'jenis_bayar'=>$this->input->post('jenis_bayar'),
    		'top'=>$this->input->post('top'),
    		'jenis_ppn'=>$this->input->post('jenis_ppn'),
    		'no_ref'=>$this->input->post('no_ref'),
    		'subtotal'=>$this->input->post('subtotal'),
    		'diskon'=>$this->input->post('diskon'),
    		'dpp'=>$this->input->post('dpp'),
    		'ppn'=>$this->input->post('ppn'),
    		'total'=>$this->input->post('total'),
    		'dp'=>$this->input->post('dp'),
        //'ar'=>$this->input->post('ar'),
    		'keterangan'=>$this->input->post('keterangan'),


        'entry_user'=>$cookie_id_user,
        'entry_date'=>$now,
      );
      $this->db->trans_off();
      $this->db->trans_begin();
      $this->db->trans_strict(true);
      $this->Bis_model->insertData('judul_sk',$data);
      //$this->Bis_model->insertData('ar_trans',$dataar);
      if ($dp>0)
      {
          //$this->Bis_model->insertData('ar_trans',$datadp);
      }
      $inserted_count = 0;
  		//insert gl

  		foreach ($this->input->post('rowsBM') as $key => $count )
      {
            $data=array(
            'no_bukti'=>$no_sk,
            'kd_barang'=>$this->input->post('kode_barang_'.$count),
            'qty'=>$this->input->post('qty_'.$count),
            'hj'=>$this->input->post('hj_'.$count),
      			'nama'=>$this->input->post('nama_barang_'.$count),
      			'ket1'=>$this->input->post('ket1_'.$count),
            'ket2'=>$this->input->post('ket2_'.$count),
          );
          $this->Bis_model->insertData('detail_sk',$data);
		  // UPDATE BARANG
      }
      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE)
      {
              $this->db->trans_rollback();
              $this->session->set_flashdata('message', 'Gagal input data produksi.');
              $this->session->set_flashdata('jenis', 'danger');
              redirect(site_url('Sktrans'));
      }
      else
      {
              $this->db->trans_commit();
              $this->session->set_flashdata('message', 'Sukses tambah data baru.');
              $this->session->set_flashdata('jenis', 'success');
              redirect(site_url('Sktrans'));
      }
      }

      function edit_data()
      {
        $now = date('Y-m-d H:i:s');
        $date = new DateTime($this->input->post('tgl_trans'));
        $id_plant = $this->input->post('id_plant');
        $year = $date -> format('Y');
        $month = $date -> format('m');
        $day = $date -> format('d');
        $kode_bukti="SPP".$year.$month;
        $cookie_id_user = get_cookie('eklinik');
        $id['no_bukti'] = $this->input->post('no_bukti');
        $no_bukti= $this->input->post('no_bukti');
        $no_si=$this->input->post('no_bukti');
        $idar['no_bukti']= $this->input->post('no_ar');
        $no_ar=$this->input->post('no_ar');

        $tempo=$this->input->post('top');
        //$date=date_create("2013-03-15");
        date_add($date,date_interval_create_from_date_string("$tempo days"));
        $newDate=date_format($date,"Y-m-d");

        $kode_ar="/ENV/".$month."/".$year;
        $no_ar_new=$this->Bis_model->getIdAr($kode_ar);

        $dataar_entry=array(
          'no_bukti'=>$no_ar_new,
          'no_si'=>$no_si,
          'id_customer'=>$this->input->post('id_customer'),
          'tgl_trans'=>$this->input->post('tgl_trans'),
          'tgl_j_tmp'=>$newDate,
          'type_trans'=>'AR',
          'type_bayar'=>$this->input->post('jenis_bayar'),
          'jml_trans'=>$this->input->post('ar'),
          'keterangan'=>$this->input->post('keterangan'),
          'entry_user'=>$cookie_id_user,
          'entry_date'=>$now,

        );


        $dataar=array(
          'no_bukti'=>$no_ar,
          'no_si'=>$no_si,
          'id_customer'=>$this->input->post('id_customer'),
          'tgl_trans'=>$this->input->post('tgl_trans'),
          'tgl_j_tmp'=>$newDate,
          'type_trans'=>'AR',
          'type_bayar'=>$this->input->post('jenis_bayar'),
          'jml_trans'=>$this->input->post('ar'),
          'keterangan'=>$this->input->post('keterangan'),
          'edit_user'=>$cookie_id_user,
          'edit_date'=>$now,

        );

        $data=array(
          'tgl_trans'=>$this->input->post('tgl_trans'),
      		'id_customer'=>$this->input->post('id_customer'),
      		'id_sales'=>$this->input->post('id_pegawai'),
      		'jenis_bayar'=>$this->input->post('jenis_bayar'),
      		'top'=>$this->input->post('top'),
      		'jenis_ppn'=>$this->input->post('jenis_ppn'),
      		'no_ref'=>$this->input->post('no_ref'),
      		'subtotal'=>$this->input->post('subtotal'),
      		'diskon'=>$this->input->post('diskon'),
      		'dpp'=>$this->input->post('dpp'),
      		'ppn'=>$this->input->post('ppn'),
      		'total'=>$this->input->post('total'),
      		'dp'=>$this->input->post('dp'),
          	'ar'=>$this->input->post('ar'),
      		'keterangan'=>$this->input->post('keterangan'),
          'edit_user'=>$cookie_id_user,
          'edit_date'=>$now,
        );
        $this->db->trans_off();
        $this->db->trans_begin();
        $this->db->trans_strict(true);
        $this->Bis_model->updateData('judul_si',$data,$id);
        if (empty($no_ar))
        {
          $this->Bis_model->insertData('ar_trans',$dataar_entry);
        }
        else
        {
          $this->Bis_model->updateData('ar_trans',$dataar,$idar);
        }


        $this->Bis_model->deleteData('detail_si',$id);
        //$inserted_count = 0;
    		//insert gl

    		foreach ($this->input->post('rowsBM') as $key => $count )
        {
             //echo ($no_bukti);
             //echo ($this->input->post('qty_'.$count));

             //echo ($this->input->post('kode_barang_'.$count));
              //echo ("<br>");
// edit_detail
               $data=array(
               'no_bukti'=>$no_bukti,
               'kd_barang'=>$this->input->post('kode_barang_'.$count),
               'qty'=>$this->input->post('qty_'.$count),
               'hj'=>$this->input->post('hj_'.$count),
			   'nama'=>$this->input->post('nama_barang_'.$count),
			   'ket1'=>$this->input->post('ket1_'.$count),
			   'ket2'=>$this->input->post('ket2_'.$count),
             );
             $this->Bis_model->insertData('detail_si',$data);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                $this->session->set_flashdata('message', 'Gagal input data produksi.');
                $this->session->set_flashdata('jenis', 'danger');
                redirect(site_url('Sktrans'));
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses edit data.');
                $this->session->set_flashdata('jenis', 'success');
                redirect(site_url('Sktrans'));
        }
        }

      function edit()
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
          $query_data_ar="SELECT
                      IFNULL(ar_trans.no_bukti,'non')  AS no_ar,
                      ar_trans.no_si,
                      ar_trans.id_customer,
                      ar_trans.tgl_trans,
                      ar_trans.tgl_j_tmp,
                      ar_trans.type_trans,
                      ar_trans.type_bayar,
                      ar_trans.jml_trans,
                      ar_trans.keterangan
                      FROM `ar_trans`
                      WHERE
                      ar_trans.no_si = '$no_bukti' AND
                      ar_trans.type_trans = 'AR'
          ";
          $querccy_data_ar="SELECT
                      IFNULL(ar_trans.no_bukti,'non')  AS no_ar,
                      ar_trans.id_customer,
                      ar_trans.tgl_trans,
                      ar_trans.tgl_j_tmp,
                      ar_trans.type_trans,
                      ar_trans.type_bayar,
                      ar_trans.jml_trans,
                      ar_trans.keterangan,
                      judul_si.no_bukti as no_si
                      FROM
                      ar_trans
                      RIGHT JOIN judul_si ON ar_trans.no_si = judul_si.no_bukti WHERE
                      ar_trans.no_si = '$no_bukti'";
          $query_data="SELECT
                      judul_si.no_bukti,
                      judul_si.tgl_trans,
                      ms_pegawai.id_pegawai,
                      ms_pegawai.nama AS nama_pegawai,
                      ms_customer.nama,
                      ms_customer.alamat,
                      judul_si.jenis_bayar,

                      IFNULL(judul_si.top,0) as top,
                      judul_si.jenis_ppn,
                      judul_si.no_ref,
                      IFNULL(judul_si.subtotal,0) as subtotal,
                      IFNULL(judul_si.diskon,0) as diskon,
                      IFNULL(judul_si.dpp,0) as dpp,
                      IFNULL(judul_si.ppn,0) as ppn ,
                      IFNULL(judul_si.total,0) as total,
                      IFNULL(judul_si.dp,0) as dp,
                      IFNULL(judul_si.ar,0) as ar,
                      judul_si.keterangan,
                      ms_customer.id_customer
                      FROM
                      judul_si
                      INNER JOIN ms_customer ON judul_si.id_customer = ms_customer.id_customer
                      LEFT JOIN ms_pegawai ON judul_si.id_sales = ms_pegawai.id_pegawai
                      WHERE
                      judul_si.no_bukti = '$no_bukti'
                      ORDER BY
                      judul_si.tgl_trans asc
                      ";
          //echo($query_data);
                      //$query_driver="SELECT * from ms_pegawai where id_jabatan=40";
          $q_detail="SELECT
						judul_si.no_bukti,
						detail_si.kd_barang,
						detail_si.hj,
						detail_si.qty,
						detail_si.nama AS nama_barang,
						detail_si.ket1 AS ket1,
						detail_si.ket2 AS ket2
						FROM
						judul_si
						INNER JOIN detail_si ON judul_si.no_bukti = detail_si.no_bukti
                      WHERE
                      judul_si.no_bukti = '$no_bukti'";
          $q_pegawai="select * from ms_pegawai order by nama asc";
          $data['data_ar'] = $this->Bis_model->manualQuery($query_data_ar);
          $data['data_si'] = $this->Bis_model->manualQuery($query_data);
          $data['data_detail_si'] = $this->Bis_model->manualQuery($q_detail);
          $data['data_pegawai'] = $this->Bis_model->manualQuery($q_pegawai);
          $data['jabatan'] = $this->Login_m->get_jabatan();
          $data['users'] = $this->Hak_Akses_m->get_user();
          $data['menu'] = $this->Menu_m->get_menu($id);
          $data['submenu'] = $this->Menu_m->get_submenu($id);
          $this->load->view('Sktrans_edit_view',$data);
        }
  function hapus()
  {
    $id['no_bukti'] = $this->uri->segment(3);
    $idx['no_sk'] = $this->uri->segment(3);
    $this->db->trans_begin();
    $this->Bis_model->deleteData('judul_sk',$id);
	  $this->Bis_model->deleteData('detail_sk',$id);
    //$this->Bis_model->deleteData('ar_trans',$idx);
    if ($this->db->trans_status() === FALSE)
    {
            $this->db->trans_rollback();
    }
    else
    {
            $this->db->trans_commit();
            $this->session->set_flashdata('message', 'Sukses delete.');
            $this->session->set_flashdata('jenis', 'danger');
            redirect(site_url('Sktrans'));
    }
  }

function cetak()
    {
      $id['no_bukti'] = $this->uri->segment(3);
      $no_bukti=$this->uri->segment(3);
      $id = get_cookie('eklinik');
      $this->load->model('Menu_m');
      $this->load->model('Hak_Akses_m');
      $this->load->model('Login_m');
 	    $query_data="SELECT
                    judul_sk.no_bukti,
                    judul_sk.tgl_trans,
                    judul_sk.jenis_bayar,
                    judul_sk.id_unit,
                    judul_sk.jenis_ppn,
                    judul_sk.subtotal,
                    judul_sk.diskon,
                    judul_sk.dpp,
                    judul_sk.ppn,
                    judul_sk.total,
                    judul_sk.dp,
                    judul_sk.ar,
                    judul_sk.keterangan,
                    judul_sk.id_beban,
                    masterakun.nama
                    FROM
                    judul_sk
                    INNER JOIN masterakun ON judul_sk.id_beban = masterakun.kd_akun

                    WHERE
                    judul_sk.no_bukti = '$no_bukti'";
           //echo($query_data);
                      //$query_driver="SELECT * from ms_pegawai where id_jabatan=40";
          $q_detail="SELECT
                      	judul_sk.no_bukti,
                      	judul_sk.tgl_trans,
                      	detail_sk.kd_barang,
                      	detail_sk.hj,
                      	detail_sk.qty,
                        detail_sk.hj*detail_sk.qty as ammount,
                      	ms_barang.nama AS nama_barang,
                        '' as ket1,
                        '' as ket2
                      FROM
                      	judul_sk
                      INNER JOIN detail_sk ON judul_sk.no_bukti = detail_sk.no_bukti
                      INNER JOIN ms_barang ON detail_sk.kd_barang = ms_barang.id_barang
                      WHERE  judul_sk.no_bukti = '$no_bukti'";
      //echo $q_detail;
	    $data['data_spb'] = $this->Bis_model->manualQuery($query_data);
      $data['detail_spb'] = $this->Bis_model->manualQuery($q_detail);

      $data['users'] = $this->Hak_Akses_m->get_user();
      $data['menu'] = $this->Menu_m->get_menu($id);
      $data['submenu'] = $this->Menu_m->get_submenu($id);
      $this->load->view('report/Cetaksk',$data);
    }

  function exportexcel()
  {

    $this->load->model('idh/IDH_m');
    $data['idh'] = $this->IDH_m->get_data_hauling();
    $this->load->view('Karyawan_export',$data);
  }
}
?>
