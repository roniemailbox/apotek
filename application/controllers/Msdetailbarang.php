<?php
class Msdetailbarang extends CI_Controller{
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
      $dan="";
      $dan2="";
    }
    else {
      $dan=" AND
      detail_ms_barang.kd_sub_unit = '$kd_sub_unit'";

      $dan2=" AND
      mastersubunit.kd_sub_unit = '$kd_sub_unit'";
    }

    $query_sub_unit="SELECT
                        mastersubunit.kd_sub_unit,
                        mastersubunit.nama_sub_unit,
                        mastersubunit.kd_unit
                      FROM
                        mastersubunit
                      WHERE
                        mastersubunit.status = '1'
                      $dan2
                      ORDER BY
                        mastersubunit.kd_sub_unit ASC";

    $query_supplier= "SELECT
              ms_supplier.id_supplier,
              ms_supplier.nama
            FROM
              ms_supplier
            ORDER BY
            ms_supplier.nama ASC";

    $query_barang= "SELECT
                    ms_barang.id_barang,
                    ms_barang.id_lama,
                    ms_barang.id_kategori,
                    ms_barang.id_jenis,
                    ms_barang.id_merk,
                    ms_barang.id_supplier,
                    ms_barang.id_tipe,
                    ms_barang.barcode,
                    ms_barang.nama,
                    ms_barang.nama_alias,
                    ms_barang.harga_beli,
                    ms_barang.harga_jual,
                    ms_barang.satuan,
                    ms_barang.ppn,
                    ms_barang.keterangan,
                    ms_barang.edit_date,
                    ms_barang.edit_user,
                    ms_barang.entry_date,
                    ms_barang.entry_user
                    FROM
                    ms_barang
                    INNER JOIN detail_ms_barang ON ms_barang.id_barang = detail_ms_barang.kd_barang
                    WHERE
                    ms_barang.id_barang = detail_ms_barang.kd_barang
                    $dan LIMIT 100
                    ";

    $query_detail="SELECT
                  	detail_ms_barang.kd_barang,
                  	detail_ms_barang.kd_sub_unit,
                  	detail_ms_barang.id_supplier,
                  	detail_ms_barang.hj,
                  	detail_ms_barang.hb,
			detail_ms_barang.nilai_ppn,
                  	detail_ms_barang.perc_margin,
                  	detail_ms_barang.margin,
                  	detail_ms_barang.max,
                  	detail_ms_barang.min,
                  	detail_ms_barang.hpp,
                  	detail_ms_barang.lokasi,
                  	detail_ms_barang.rak,
                  	detail_ms_barang.keterangan,
                  	detail_ms_barang.edit_date,
                  	detail_ms_barang.edit_user,
                  	detail_ms_barang.entry_date,
                  	detail_ms_barang.entry_user,
                  	ms_barang.id_barang AS kd_barang,
                  	ms_barang.id_tipe,
                  	ms_barang.id_kategori,
                  	ms_barang.id_merk,
                  	ms_barang.id_jenis,
                  	ms_barang.barcode,
                  	ms_barang.ppn,
                  	ms_barang.satuan,
                  	mastersubunit.nama_sub_unit,
                  	ms_supplier.nama,
                  	aa.nama AS nama_pegawai,
                  	bb.nama AS nama_edit_pegawai,
                  	ms_barang.nama AS nama_barang,
                  	ms_barang.nama_alias,
                    ms_supplier.nama AS nama_supplier
                  FROM
                  	detail_ms_barang
                    LEFT JOIN mastersubunit ON detail_ms_barang.kd_sub_unit = mastersubunit.kd_sub_unit
                    LEFT JOIN ms_barang ON detail_ms_barang.kd_barang = ms_barang.id_barang
                    LEFT JOIN ms_supplier ON detail_ms_barang.id_supplier = ms_supplier.id_supplier
                    LEFT JOIN `user` AS a ON detail_ms_barang.edit_user = a.id_user
                    LEFT JOIN `user` AS b ON detail_ms_barang.entry_user = b.id_user
                    LEFT JOIN ms_pegawai AS bb ON a.id_pegawai = bb.id_pegawai
                    LEFT JOIN ms_pegawai AS aa ON b.id_pegawai = aa.id_pegawai
                  WHERE
                  	detail_ms_barang.kd_barang = ms_barang.id_barang
                  $dan LIMIT 100 ";
                  $query_count_detail="SELECT
                                	count(detail_ms_barang.kd_barang) as jumlah_item
                                FROM
                                	detail_ms_barang
                                  LEFT JOIN mastersubunit ON detail_ms_barang.kd_sub_unit = mastersubunit.kd_sub_unit
                                  LEFT JOIN ms_barang ON detail_ms_barang.kd_barang = ms_barang.id_barang
                                  LEFT JOIN ms_supplier ON detail_ms_barang.id_supplier = ms_supplier.id_supplier
                                  LEFT JOIN `user` AS a ON detail_ms_barang.edit_user = a.id_user
                                  LEFT JOIN `user` AS b ON detail_ms_barang.entry_user = b.id_user
                                  LEFT JOIN ms_pegawai AS bb ON a.id_pegawai = bb.id_pegawai
                                  LEFT JOIN ms_pegawai AS aa ON b.id_pegawai = aa.id_pegawai
                                WHERE
                                	detail_ms_barang.kd_barang = ms_barang.id_barang
                                $dan ";
       //echo $query_count_detail;
       $query_count_detail="SELECT
                       count(detail_ms_barang.kd_barang) as jumlah_item
                     FROM
                       detail_ms_barang
                       LEFT JOIN mastersubunit ON detail_ms_barang.kd_sub_unit = mastersubunit.kd_sub_unit
                       LEFT JOIN ms_barang ON detail_ms_barang.kd_barang = ms_barang.id_barang
                       LEFT JOIN ms_supplier ON detail_ms_barang.id_supplier = ms_supplier.id_supplier
                       LEFT JOIN `user` AS a ON detail_ms_barang.edit_user = a.id_user
                       LEFT JOIN `user` AS b ON detail_ms_barang.entry_user = b.id_user
                       LEFT JOIN ms_pegawai AS bb ON a.id_pegawai = bb.id_pegawai
                       LEFT JOIN ms_pegawai AS aa ON b.id_pegawai = aa.id_pegawai
                     WHERE
                       detail_ms_barang.kd_barang = ms_barang.id_barang
                     $dan ";

      $data=array(

          'perintah'=>'Baru',
          'title'=>'Detail Barang',
          'title_filter'=>'Cari Detail Barang',
          'title_tambah'=>'Input Detail Barang',
          //'title_repopasien'=>'Laporan Detail Barang',
          'data_detail'=>$this->Bis_model->manualQuery($query_detail),
          'data_barang'=>$this->Bis_model->manualQuery($query_barang),
          //'data_jenis'=>$this->Bis_model->manualQuery($query_jenis),
          'data_sub' =>$this->Bis_model->manualQuery($query_sub_unit),
          //'data_status'=>$this->Bis_model->manualQuery($query_aktif),
          'users'=>$this->Hak_Akses_m->get_user($id),
          'menu'=>$this->Menu_m->get_menu($id),
          'submenu'=>$this->Menu_m->get_submenu($id),
          'jml_item'=>$this->Bis_model->manualQuery($query_count_detail),
          #'data_satuan'=>$this->Bis_model->manualQuery($query_satuan),
          #'data_kategori'=>$this->Bis_model->manualQuery($query_kategori),
          'data_supplier'=>$this->Bis_model->manualQuery($query_supplier),
          #'data_merk'=>$this->Bis_model->manualQuery($query_merk),
          #'data_tipe'=>$this->Bis_model->manualQuery($query_tipe),
      );

      $this->load->view('msdetailbarang_view',$data);
  }


  function Dataedit()
  {
    $id = get_cookie('eklinik');
    $kd_barang=$this->input->post('kd_barang');
    $kd_sub_unit=$this->input->post('kd_sub_unit');
    $ses_id_jenis=$this->session->userdata('id_jenis'.$id);
    if($ses_id_jenis<3)
    {
      $dan="";
      $dan2="";
    }
    else {
      $dan=" AND 
      detail_ms_barang.kd_sub_unit = '$kd_sub_unit'";

      $dan2=" AND
      mastersubunit.kd_sub_unit = '$kd_sub_unit'";
    }
    $query_barang= "SELECT
                    ms_barang.id_barang,
                    ms_barang.id_lama,
                    ms_barang.id_kategori,
                    ms_barang.id_jenis,
                    ms_barang.id_merk,
                    ms_barang.id_supplier,
                    ms_barang.id_tipe,
                    ms_barang.barcode,
                    ms_barang.nama,
                    ms_barang.nama_alias,
                    ms_barang.harga_beli,
                    ms_barang.harga_jual,
                    ms_barang.satuan,
                    ms_barang.ppn,
                    ms_barang.keterangan,
                    ms_barang.edit_date,
                    ms_barang.edit_user,
                    ms_barang.entry_date,
                    ms_barang.entry_user

                    FROM
                    ms_barang
                    INNER JOIN detail_ms_barang ON ms_barang.id_barang = detail_ms_barang.kd_barang
                    WHERE
                    ms_barang.id_barang = detail_ms_barang.kd_barang
                    $dan LIMIT 100
                    ";

                    $query_detail="SELECT
                                  detail_ms_barang.kd_barang,
                                  detail_ms_barang.kd_sub_unit,
                                  detail_ms_barang.id_supplier,
                                  detail_ms_barang.hj,
                                  detail_ms_barang.hb,
				  detail_ms_barang.nilai_ppn,
                                  detail_ms_barang.perc_margin,
                                  detail_ms_barang.margin,
                                  detail_ms_barang.max,
                                  detail_ms_barang.min,
                                  detail_ms_barang.hpp,
                                  detail_ms_barang.lokasi,
                                  detail_ms_barang.rak,
                                  detail_ms_barang.keterangan,
                                  detail_ms_barang.edit_date,
                                  detail_ms_barang.edit_user AS nama_pegawai_edit,
                                  detail_ms_barang.entry_date,
                                  detail_ms_barang.entry_user AS nama_pegawai,
                                  ms_barang.id_barang AS kd_barang,
                                  ms_barang.nama AS nama_barang,
                                  ms_barang.id_tipe,
                                  ms_barang.id_kategori,
                                  ms_barang.id_merk,
                                  ms_barang.id_jenis,
                                  ms_barang.barcode,
                                  ms_barang.nama_alias AS alias,
                                  ms_barang.ppn,
                                  ms_barang.satuan,
                                  mastersubunit.nama_sub_unit,
                                  #ms_supplier.id_supplier,
                                  ms_supplier.nama as nama_supplier
                                  FROM
                                  detail_ms_barang
                                  LEFT JOIN mastersubunit ON detail_ms_barang.kd_sub_unit = mastersubunit.kd_sub_unit
                                  LEFT JOIN ms_barang ON detail_ms_barang.kd_barang = ms_barang.id_barang
                                  LEFT JOIN ms_supplier ON detail_ms_barang.id_supplier = ms_supplier.id_supplier
                                  $dan LIMIT 100
                                  ";

    $query_detail1="SELECT
                  detail_ms_barang.kd_barang,
                  detail_ms_barang.kd_sub_unit,
                  detail_ms_barang.id_supplier,
                  detail_ms_barang.hj,
                  detail_ms_barang.hb,
		  detail_ms_barang.nilai_ppn,
                  detail_ms_barang.perc_margin,
                  detail_ms_barang.margin,
                  detail_ms_barang.max,
                  detail_ms_barang.min,
                  detail_ms_barang.hpp,
                  detail_ms_barang.lokasi,
                  detail_ms_barang.rak,
                  detail_ms_barang.keterangan,
                  detail_ms_barang.edit_date,
                  detail_ms_barang.edit_user AS nama_pegawai_edit,
                  detail_ms_barang.entry_date,
                  detail_ms_barang.entry_user AS nama_pegawai,
                  ms_barang.nama AS nama_barang,
                  ms_barang.id_tipe,
                  ms_barang.id_kategori,
                  ms_barang.id_merk,
                  ms_barang.id_jenis,
                  ms_barang.barcode,
                  ms_barang.nama_alias AS alias,
                  ms_barang.ppn,
                  ms_barang.satuan,
                  mastersubunit.nama_sub_unit,
                  ms_supplier.nama as nama_supplier,
                  ms_supplier.id_supplier
                  FROM
                  detail_ms_barang
                  LEFT JOIN mastersubunit ON detail_ms_barang.kd_sub_unit = mastersubunit.kd_sub_unit
                  LEFT JOIN ms_barang ON detail_ms_barang.kd_barang = ms_barang.id_barang
                  LEFT JOIN ms_supplier ON detail_ms_barang.id_supplier = ms_supplier.id_supplier
                  WHERE
                  detail_ms_barang.kd_barang = '$kd_barang'
                  and detail_ms_barang.kd_sub_unit='$kd_sub_unit'

                  ";
      $query_sub="SELECT * FROM mastersubunit
                  WHERE
                  status = '1'
                  ";
      $query_sup="SELECT
	               ms_supplier.id_supplier,
	               ms_supplier.nama
                 FROM
	                ms_supplier";
//echo $query_detail1;
$query_count_detail="SELECT
                count(detail_ms_barang.kd_barang) as jumlah_item
              FROM
                detail_ms_barang
                LEFT JOIN mastersubunit ON detail_ms_barang.kd_sub_unit = mastersubunit.kd_sub_unit
                LEFT JOIN ms_barang ON detail_ms_barang.kd_barang = ms_barang.id_barang
                LEFT JOIN ms_supplier ON detail_ms_barang.id_supplier = ms_supplier.id_supplier
                LEFT JOIN `user` AS a ON detail_ms_barang.edit_user = a.id_user
                LEFT JOIN `user` AS b ON detail_ms_barang.entry_user = b.id_user
                LEFT JOIN ms_pegawai AS bb ON a.id_pegawai = bb.id_pegawai
                LEFT JOIN ms_pegawai AS aa ON b.id_pegawai = aa.id_pegawai
              WHERE
                detail_ms_barang.kd_barang = ms_barang.id_barang
              $dan ";
      $data=array(
            'perintah'=>'Edit',
            'title'=>'Edit Master Detail Barang',
            'title_filter'=>'Cari Data',
            'title_tambah'=>'Edit Detail Barang',
            //'title_repopasien'=>'Laporan Pasien',
            'data_barang'=>$this->Bis_model->manualQuery($query_barang),
            'data_detail'=>$this->Bis_model->manualQuery($query_detail),
            'data_detail_edit'=>$this->Bis_model->manualQuery($query_detail1),
            'data_sub'=>$this->Bis_model->manualQuery($query_sub),
            'data_sup'=>$this->Bis_model->manualQuery($query_sup),
            //'data_jabatan_edit'=>$this->Bis_model->manualQuery($query_jabatan_edit),
            #'data_status_aktif' => $this->Bis_model->getAllData('ms_status_aktif'),
            'jml_item'=>$this->Bis_model->manualQuery($query_count_detail),
            'users'=>$this->Hak_Akses_m->get_user($id),
            'menu'=>$this->Menu_m->get_menu($id),
            'submenu'=>$this->Menu_m->get_submenu($id),
          );
            $this->load->view('msdetailbarang_view',$data);
  }

  function filter()
  {
    $id = get_cookie('eklinik');
    $filter = $this->input->post('katakunci');


    $kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
    $ses_id_jenis=$this->session->userdata('id_jenis'.$id);
    if($ses_id_jenis<3)
    {
      $dan="";
      $dan2="";
    }
    else {
      $dan=" AND
      detail_ms_barang.kd_sub_unit = '$kd_sub_unit'";

      $dan2=" AND
      mastersubunit.kd_sub_unit = '$kd_sub_unit'";
    }

    $query_sub_unit="SELECT
                        mastersubunit.kd_sub_unit,
                        mastersubunit.nama_sub_unit,
                        mastersubunit.kd_unit
                      FROM
                        mastersubunit
                      WHERE
                        mastersubunit.status = '1'
                      $dan2
                      ORDER BY
                        mastersubunit.kd_sub_unit ASC";
                  $query_data="SELECT
                              detail_ms_barang.kd_barang,
                              detail_ms_barang.kd_sub_unit,
                              detail_ms_barang.id_supplier,
                              detail_ms_barang.hj,
                              detail_ms_barang.hb,
			      detail_ms_barang.nilai_ppn,
                              detail_ms_barang.perc_margin,
                              detail_ms_barang.margin,
                              detail_ms_barang.max,
                              detail_ms_barang.min,
                              detail_ms_barang.hpp,
                              detail_ms_barang.lokasi,
                              detail_ms_barang.rak,
                              detail_ms_barang.keterangan,
                              detail_ms_barang.edit_date,
                              detail_ms_barang.edit_user AS nama_pegawai_edit,
                              detail_ms_barang.entry_date,
                              detail_ms_barang.entry_user AS nama_pegawai,
                              ms_barang.id_tipe,
                              ms_barang.id_kategori,
                              ms_barang.id_merk,
                              ms_barang.id_jenis,
                              ms_barang.barcode,
                              ms_barang.nama_alias AS alias,
                              ms_barang.ppn,
                              ms_barang.satuan,
                              mastersubunit.nama_sub_unit,
                              ms_supplier.nama
                              FROM
                              detail_ms_barang
                              LEFT JOIN mastersubunit ON detail_ms_barang.kd_sub_unit = mastersubunit.kd_sub_unit
                              LEFT JOIN ms_barang ON detail_ms_barang.kd_barang = ms_barang.id_barang
                              LEFT JOIN ms_supplier ON detail_ms_barang.id_supplier = ms_supplier.id_supplier
                              WHERE
                              detail_ms_barang.kd_barang = ms_barang.id_barang AND
                  (detail_ms_barang.kd_barang LIKE '%$filter%'
                  OR detail_ms_barang.id_supplier LIKE '%$filter%'
                  OR detail_ms_barang.keterangan LIKE '%$filter%')
                  AND detail_ms_barang.kd_sub_unit = '$kd_sub_unit'
                  $dan LIMIT 100
                  ";

                  $query_data="SELECT
                                	detail_ms_barang.kd_barang,
                                	detail_ms_barang.kd_sub_unit,
                                	detail_ms_barang.id_supplier,
                                	detail_ms_barang.hj,
                                	detail_ms_barang.hb,
					detail_ms_barang.nilai_ppn,
                                	detail_ms_barang.perc_margin,
                                	detail_ms_barang.margin,
                                	detail_ms_barang.max,
                                	detail_ms_barang.min,
                                	detail_ms_barang.hpp,
                                	detail_ms_barang.lokasi,
                                	detail_ms_barang.rak,
                                	detail_ms_barang.keterangan,
                                	detail_ms_barang.edit_date,
                                	detail_ms_barang.edit_user,
                                	detail_ms_barang.entry_date,
                                	detail_ms_barang.entry_user,
                                	ms_barang.id_barang AS kd_barang,
                                	ms_barang.id_tipe,
                                	ms_barang.id_kategori,
                                	ms_barang.id_merk,
                                	ms_barang.id_jenis,
                                	ms_barang.barcode,
                                	ms_barang.ppn,
                                	ms_barang.satuan,
                                	mastersubunit.nama_sub_unit,
                                	ms_supplier.nama,
                                	aa.nama AS nama_pegawai,
                                	bb.nama AS nama_edit_pegawai,
                                	ms_barang.nama AS nama_barang,
                                	ms_barang.nama_alias,
                                  ms_supplier.nama AS nama_supplier
                                FROM
                                	detail_ms_barang
                                  LEFT JOIN mastersubunit ON detail_ms_barang.kd_sub_unit = mastersubunit.kd_sub_unit
                                  LEFT JOIN ms_barang ON detail_ms_barang.kd_barang = ms_barang.id_barang
                                  LEFT JOIN ms_supplier ON detail_ms_barang.id_supplier = ms_supplier.id_supplier
                                  LEFT JOIN `user` AS a ON detail_ms_barang.edit_user = a.id_user
                                  LEFT JOIN `user` AS b ON detail_ms_barang.entry_user = b.id_user
                                  LEFT JOIN ms_pegawai AS bb ON a.id_pegawai = bb.id_pegawai
                                  LEFT JOIN ms_pegawai AS aa ON b.id_pegawai = aa.id_pegawai
                                  WHERE
                                  detail_ms_barang.kd_barang = ms_barang.id_barang AND
                                  (detail_ms_barang.kd_barang LIKE '%$filter%'
                                  OR detail_ms_barang.id_supplier LIKE '%$filter%'
                                  OR detail_ms_barang.keterangan LIKE '%$filter%'
                                  OR ms_barang.nama LIKE '%$filter%')
                                  AND detail_ms_barang.kd_sub_unit = '$kd_sub_unit'";
      //echo $query_data;
      $query_count_detail="SELECT
                      count(detail_ms_barang.kd_barang) as jumlah_item
                    FROM
                      detail_ms_barang
                      LEFT JOIN mastersubunit ON detail_ms_barang.kd_sub_unit = mastersubunit.kd_sub_unit
                      LEFT JOIN ms_barang ON detail_ms_barang.kd_barang = ms_barang.id_barang
                      LEFT JOIN ms_supplier ON detail_ms_barang.id_supplier = ms_supplier.id_supplier
                      LEFT JOIN `user` AS a ON detail_ms_barang.edit_user = a.id_user
                      LEFT JOIN `user` AS b ON detail_ms_barang.entry_user = b.id_user
                      LEFT JOIN ms_pegawai AS bb ON a.id_pegawai = bb.id_pegawai
                      LEFT JOIN ms_pegawai AS aa ON b.id_pegawai = aa.id_pegawai
                    WHERE
                      detail_ms_barang.kd_barang = ms_barang.id_barang
                    $dan ";
//echo $query_count_detail;
      $data=array(
          'title'=>'Detail Barang',
          'perintah'=>'Baru',
          'title_filter'=>'Cari Detail Barang',
          'title_tambah'=>'Input Detail Barang',
          'title_repopasien'=>'Laporan Detail Barang',
          'jml_item'=>$this->Bis_model->manualQuery($query_count_detail),
          'data_detail'=>$this->Bis_model->manualQuery($query_data),
          'users'=>$this->Hak_Akses_m->get_user($id),
          'menu'=>$this->Menu_m->get_menu($id),
          'submenu'=>$this->Menu_m->get_submenu($id),
      );

      $this->load->view('msdetailbarang_view',$data);
  }


//    ===================== INSERT =====================
    function tambah()
    {

      #$kd_barang=$this->input->post('kd_barang');
      #$kd_sub_unit=$this->input->post('kd_sub_unit');
      $now = date('Y-m-d H:i:s');
      $cookie_id_user = get_cookie('eklinik');


      $data=array(
          'kd_barang'=>$this->input->post('kd_barang'),
          'kd_sub_unit'=>$this->input->post('kd_sub_unit'),
          'id_supplier'=>$this->input->post('id_supplier'),
          'hb'=>$this->input->post('hb'),
          'hj'=>$this->input->post('hj'),
	  'nilai_ppn'=>$this->input->post('nilai_ppn'),
          'perc_margin'=>$this->input->post('perc_margin'),
          'margin'=>$this->input->post('margin'),
          'max'=>$this->input->post('max'),
          'min'=>$this->input->post('min'),
          'hpp'=>$this->input->post('hpp'),
          'lokasi'=>$this->input->post('lokasi'),
          'rak'=>$this->input->post('rak'),
          'keterangan'=>$this->input->post('keterangan'),

          'entry_user'=>$cookie_id_user,
          'entry_date'=>$now,
      );
      $this->db->trans_begin();
      $this->Bis_model->insertData('detail_ms_barang',$data,$id);

      if ($this->db->trans_status() === FALSE)
      {
              $this->db->trans_rollback();
              $this->session->set_flashdata('message', 'Gagal tambah data baru.');
              $this->session->set_flashdata('jenis', 'danger');
              redirect(site_url('Msdetailbarang'));
      }
      else
      {
              $this->db->trans_commit();
              $this->session->set_flashdata('message', 'Sukses tambah data baru.');
              $this->session->set_flashdata('jenis', 'success');
              redirect(site_url('Msdetailbarang'));
      }

      }



//    ======================== EDIT =======================
    function edit(){
        $id=array(
          'kd_barang' => $this->input->post('kd_barang'),
          'kd_sub_unit' => $this->input->post('kd_sub_unit')
        );
		    //$kd_barang=$this->input->post('kd_barang');
        $now = date('Y-m-d H:i:s');
        $cookie_id_user = get_cookie('eklinik');
        $data=array(
          'id_supplier'=>$this->input->post('id_supplier'),
          'hb'=>$this->input->post('hb'),
          'hj'=>$this->input->post('hj'),
	  'nilai_ppn'=>$this->input->post('nilai_ppn'),
          'perc_margin'=>$this->input->post('perc_margin'),
          'margin'=>$this->input->post('margin'),
          'max'=>$this->input->post('max'),
          'min'=>$this->input->post('min'),
          'hpp'=>$this->input->post('hpp'),
          'lokasi'=>$this->input->post('lokasi'),
          'rak'=>$this->input->post('rak'),
          'keterangan'=>$this->input->post('keterangan'),
          'edit_user'=>$cookie_id_user,
          'edit_date'=>$now,
        );

        $this->db->trans_begin();
        $this->Bis_model->updateData('detail_ms_barang',$data,$id);

        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                $this->session->set_flashdata('message', 'Gagal edit data.');
                $this->session->set_flashdata('jenis', 'danger');
                redirect(site_url('Msdetailbarang'));
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses edit data.');
                $this->session->set_flashdata('jenis', 'info');
                redirect(site_url('Msdetailbarang'));
        }



    }

//    ========================== DELETE =======================
    function hapus(){
        #$id['id_barang'] = $this->uri->segment(3);
        $id['kd_barang'] = $this->input->post('kd_barang');
        $this->db->trans_begin();
        $this->Bis_model->deleteData('detail_ms_barang',$id);
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses hapus data.');
                $this->session->set_flashdata('jenis', 'danger');
                redirect(site_url('Msdetailbarang'));
        }

    }
//    ====================== EXPORT KE EXCEL ===================
function exportexcel()
{
  $id = get_cookie('eklinik');
  $kd_sub_unit=$this->session->userdata('kd_sub_unit'.$id);
  $ses_id_jenis=$this->session->userdata('id_jenis'.$id);
  if($ses_id_jenis<3)
  {
    //$dan=" WHERE ms_barang.status_aktif=1";
    $dan=" WHERE detail_ms_barang.kd_barang";
  }
  else {
     $dan=" WHERE detail_ms_barang.kd_sub_unit = '$kd_sub_unit'";
    //$dan=" WHERE ms_barang.status_aktif=1";
  }
  $query_data="SELECT
              detail_ms_barang.kd_barang,
              detail_ms_barang.kd_sub_unit,
              detail_ms_barang.id_supplier,
              detail_ms_barang.hj,
              detail_ms_barang.hb,
	      detail_ms_barang.nilai_ppn,
              detail_ms_barang.perc_margin,
              detail_ms_barang.margin,
              detail_ms_barang.max,
              detail_ms_barang.min,
              detail_ms_barang.hpp,
              detail_ms_barang.lokasi,
              detail_ms_barang.rak,
              detail_ms_barang.keterangan,
              detail_ms_barang.edit_date,
              detail_ms_barang.edit_user AS nama_pegawai_edit,
              detail_ms_barang.entry_date,
              detail_ms_barang.entry_user AS nama_pegawai,
              ms_barang.id_barang,
              ms_barang.id_tipe,
              ms_barang.id_kategori,
              ms_barang.id_merk,
              ms_barang.id_jenis,
              ms_barang.barcode,
              mastersubunit.nama_sub_unit,
              ms_supplier.nama
              FROM
              detail_ms_barang
              LEFT JOIN mastersubunit ON detail_ms_barang.kd_sub_unit = mastersubunit.kd_sub_unit
              LEFT JOIN ms_barang ON detail_ms_barang.kd_barang = ms_barang.id_barang
              LEFT JOIN ms_supplier ON detail_ms_barang.id_supplier = ms_supplier.id_supplier
              WHERE
              detail_ms_barang.kd_barang = ms_barang.id_barang
              $dan ";
                $data=array(
                    'title'=>'Detail Master Barang',
                    'data_barang'=>$this->Bis_model->manualQuery($query_data),
                );

  $this->load->view('export/detail_barang_export',$data);
}
}
