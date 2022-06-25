<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sitrans extends CI_Controller
{
  function __construct(){
      parent::__construct();
       $this->load->model('umum/Bis_model');
       $this->load->model('umum/Bis_model_ant');
       $this->load->helper('currency_format_helper');
  	   $this->load->helper('terbilang_helper');
  	   $this->load->helper('format_tanggal_helper');
       $this->load->model('Menu_m');
       $this->load->model('Hak_Akses_m');
       $this->load->model('Login_m');
    }
  function index()
  {
    $id = get_cookie('eklinik');
    $data['data_jabatan'] = $this->Bis_model->getAllData('ms_jabatan');
    $query_plant="SELECT * from ms_plant";
    $data['data_plant'] = $this->Bis_model->manualQuery($query_plant);
    //$data['data_driver'] = $this->Bis_model->getAllData('ms_plant');

    $query_data="SELECT
        judul_si.no_bukti,
        judul_si.tgl_trans,
        judul_si.id_customer,
        judul_si.id_unit,
        judul_si.id_slock,
        judul_si.id_plant,
        judul_si.no_ref,
        judul_si.total,
        judul_si.ppn,
        judul_si.dpp,
        judul_si.ar,
        judul_si.keterangan,
        judul_si.status_approve,
        judul_si.user_approve,
        judul_si.approve_date,
        judul_si.entry_user,
        judul_si.entry_date,
        judul_si.edit_user,
        judul_si.edit_date,
        ms_customer.nama AS nama_customer,
        judul_si.jenis_bayar,
        judul_si.jenis_ppn,
        judul_si.subtotal,
        ms_pegawai.nama AS nama_pegawai
        FROM
        judul_si
        LEFT JOIN ms_customer ON judul_si.id_customer = ms_customer.id_customer
        INNER JOIN `user` ON judul_si.entry_user = `user`.id_user
        INNER JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
        ORDER BY
        judul_si.entry_date ASC ";
                //$query_driver="SELECT * from ms_pegawai where id_jabatan=40";
    $data['data_si'] = $this->Bis_model->manualQuery($query_data);
    $data['jabatan'] = $this->Login_m->get_jabatan();
    $data['users'] = $this->Hak_Akses_m->get_user();
    $data['menu'] = $this->Menu_m->get_menu($id);
    $data['submenu'] = $this->Menu_m->get_submenu($id);
    $this->load->view('Si_view',$data);
  }

  function baru(){
    $id = get_cookie('eklinik');

	  $query_slock="SELECT * from ms_customer";
    $data['data_customer'] = $this->Bis_model->manualQuery($query_slock);
    $q_data_barang="SELECT
                  ms_barang.barcode,
                  detail_ms_barang.hb,
                  detail_ms_barang.hj,
                  ms_barang.nama,
                  ms_barang.satuan,
                  ms_barang.ppn,
                  detail_ms_barang.kd_barang
                  FROM
                  	detail_ms_barang
                  INNER JOIN ms_barang ON ms_barang.id_barang = detail_ms_barang.kd_barang";
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
    $data['title'] = 'Penjualan Umum / Customer';
    $data['data_barang'] = $this->Bis_model->manualQuery($q_data_barang);
    $data['menu'] = $this->Menu_m->get_menu($id);
    $data['submenu'] = $this->Menu_m->get_submenu($id);


    $this->load->view('Sitrans_baru',$data);
  }

  function get_data_item(){
      //$id['id_supplier']=$this->input->post('id_supplier');
      $searchbarcode=$this->input->post('searchbarcode');

            $q_data="SELECT
                      ms_barang.barcode,
                      detail_ms_barang.hb,
                      detail_ms_barang.hj,
                      ms_barang.nama,
                      ms_barang.satuan,
                      ms_barang.ppn
                      FROM
                      detail_ms_barang
                      INNER JOIN ms_barang ON ms_barang.id_barang = detail_ms_barang.kd_barang
                      WHERE
                      ms_barang.barcode = '$searchbarcode'";

      $data['detail_data_item'] = $this->Bis_model->manualQuery($q_data);

      $this->load->view('ajax_detail_item',$data);
  }

  function tambah()
    {
      $now = date('Y-m-d H:i:s');
      $date = new DateTime($this->input->post('tgl_trans'));
      $id_plant = $this->input->post('id_plant');
      $jenis_ppn = $this->input->post('jenis_ppn');
      $year = $date -> format('Y');
      $month = $date -> format('m');
      $day = $date -> format('d');
      $kode_bukti="SI".$year.$month;
      $cookie_id_user = get_cookie('eklinik');


      $tempo=$this->input->post('top');

      date_add($date,date_interval_create_from_date_string("$tempo days"));
      $newDate=date_format($date,"Y-m-d");

      $no_bukti= $this->Bis_model->getIdSi($kode_bukti);
      $no_si=$this->Bis_model->getIdSi($kode_bukti);
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
        'no_bukti'=>$no_bukti,
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


        'entry_user'=>$cookie_id_user,
        'entry_date'=>$now,
      );
      $this->db->trans_off();
      $this->db->trans_begin();
      $this->db->trans_strict(true);
      $this->Bis_model->insertData('judul_si',$data);
      $this->Bis_model->insertData('ar_trans',$dataar);
      if ($dp>0)
      {
          $this->Bis_model->insertData('ar_trans',$datadp);
      }
      $inserted_count = 0;
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
            'qty'=>$this->input->post('qty_'.$count),
            'hj'=>$this->input->post('hj_'.$count),
            'ppn'=>$ppn,
      			'nama'=>$this->input->post('nama_barang_'.$count),
      			'ket1'=>$this->input->post('ket1_'.$count),
            'ket2'=>$this->input->post('ket2_'.$count),
          );
          $this->Bis_model->insertData('detail_si',$data);
		  // UPDATE BARANG
      }
      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE)
      {
              $this->db->trans_rollback();
              $this->session->set_flashdata('message', 'Gagal input data produksi.');
              $this->session->set_flashdata('jenis', 'danger');
              redirect(site_url('Sitrans'));
      }
      else
      {
              $this->db->trans_commit();
              $this->session->set_flashdata('message', 'Sukses tambah data baru.');
              $this->session->set_flashdata('jenis', 'success');
              redirect(site_url('Sitrans'));
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
                redirect(site_url('Sitrans'));
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses edit data.');
                $this->session->set_flashdata('jenis', 'success');
                redirect(site_url('Sitrans'));
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
          $this->load->view('Sitrans_edit_view',$data);
        }
  function hapus()
  {
    $id['no_bukti'] = $this->uri->segment(3);
    $idx['no_si'] = $this->uri->segment(3);
    $this->db->trans_begin();
    $this->Bis_model->deleteData('judul_si',$id);
	$this->Bis_model->deleteData('detail_si',$id);
    $this->Bis_model->deleteData('ar_trans',$idx);
    if ($this->db->trans_status() === FALSE)
    {
            $this->db->trans_rollback();
    }
    else
    {
            $this->db->trans_commit();
            $this->session->set_flashdata('message', 'Sukses delete.');
            $this->session->set_flashdata('jenis', 'danger');
            redirect(site_url('Sitrans'));
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
                    judul_si.no_bukti,
                    judul_si.tgl_trans,
                    judul_si.jenis_bayar,
                    judul_si.top,
                    judul_si.jenis_ppn,
                    judul_si.subtotal,
                    judul_si.diskon,
                    judul_si.dpp,
                    judul_si.ppn,
                    judul_si.total,
                    judul_si.dp,
                    judul_si.ar,
                    judul_si.keterangan,
                    ms_customer.nama,
                    ms_customer.alamat,
                    judul_si.id_customer
                    FROM
                    	judul_si
                    LEFT JOIN ms_customer ON judul_si.id_customer = ms_customer.id_customer
                    WHERE
                    judul_si.no_bukti = '$no_bukti'";
           //echo($query_data);
                      //$query_driver="SELECT * from ms_pegawai where id_jabatan=40";
          $q_detail="SELECT
                    	judul_si.no_bukti,
                    	judul_si.tgl_trans,
                    	judul_si.total,
                    	judul_si.ppn,
                    	judul_si.dpp,
                    	judul_si.keterangan,
                    	ms_customer.nama,
                    	ms_customer.alamat,
                    	ms_customer.kontak_person,
                    	detail_si.kd_barang,
                    	detail_si.hj,
                    	detail_si.qty,
                    	detail_si.hj * detail_si.qty AS ammount,
                    	ms_barang.nama AS nama_barang_asli,
                    	ms_barang.keterangan,
                    	detail_si.ket1,
                    	detail_si.ket2,
                    	UPPER(detail_si.nama) AS nama_barang
                    FROM
                    	judul_si
                    LEFT JOIN ms_customer ON judul_si.id_customer = ms_customer.id_customer
                    INNER JOIN detail_si ON judul_si.no_bukti = detail_si.no_bukti
                    INNER JOIN ms_barang ON detail_si.kd_barang = ms_barang.id_barang
                    WHERE  judul_si.no_bukti = '$no_bukti'";
      //echo $q_detail;
	    $data['data_spb'] = $this->Bis_model->manualQuery($query_data);
      $data['detail_spb'] = $this->Bis_model->manualQuery($q_detail);

      $data['users'] = $this->Hak_Akses_m->get_user();
      $data['menu'] = $this->Menu_m->get_menu($id);
      $data['submenu'] = $this->Menu_m->get_submenu($id);
      $this->load->view('report/Cetaksi',$data);
    }

  function exportexcel()
  {

    $this->load->model('idh/IDH_m');
    $data['idh'] = $this->IDH_m->get_data_hauling();
    $this->load->view('Karyawan_export',$data);
  }
}
?>
