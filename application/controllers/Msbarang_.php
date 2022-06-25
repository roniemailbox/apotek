<?php
class Msbarang extends CI_Controller{
  function __construct(){
        parent::__construct();
        $this->load->model('umum/Bis_model');
        $this->load->model('umum/Bis_model_ant');
        $this->load->model('Menu_m');
        $this->load->model('Hak_Akses_m');
        $this->load->model('Login_m');
        //$this->load->helper('currency_format_helper');
  }
  function index()
  {
    $id = get_cookie('eklinik');
    $query_supplier="select * from ms_supplier";
    $query_jenis="select * from ms_jenis_barang";
    $query_kategori="select * from ms_kategori";
    $query_satuan="select * from ms_satuan";
    $query_merk   ="select * from ms_merk";
    //$query_tipe   ="select * from ms_tipe";
    //$query_status ="select * from ms_status_aktif";
    $query_data="SELECT
                ms_barang.id_barang,
                ms_barang.nama_alias,
                ms_merk.id_merk,
                ms_merk.nama AS nama_merk,
                ms_barang.nama AS nama_barang,
                ms_kategori.id_kategori,
                ms_kategori.nama AS nama_kategori,
                ms_status_aktif.nama_status_aktif,
                ms_status_aktif.id_status_aktif,
                ms_barang.edit_date,
                ms_barang.ppn,
                ms_barang.barcode,
                ms_barang.harga_beli,
                ms_barang.harga_jual,
                ms_barang.harga_tranfer,
                ms_barang.status_aktif,
                ms_barang.akun_pembelian,
                ms_barang.akun_hpp,
                ms_barang.akun_penjualan,
                ms_barang.akun_retur_penjualan,
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
                ms_supplier.id_supplier
                FROM
                ms_barang
                LEFT JOIN ms_merk ON ms_barang.id_merk = ms_merk.id_merk
                LEFT JOIN ms_kategori ON ms_barang.id_kategori = ms_kategori.id_kategori
                LEFT JOIN ms_status_aktif ON ms_barang.status_aktif = ms_status_aktif.id_status_aktif
                LEFT JOIN ms_supplier ON ms_barang.id_supplier = ms_supplier.id_supplier
                LEFT JOIN ms_jenis_barang ON ms_barang.id_jenis = ms_jenis_barang.id_jenis
                LEFT JOIN ms_satuan ON ms_barang.satuan = ms_satuan.id_satuan
                LEFT JOIN ms_tipe ON ms_barang.id_tipe = ms_tipe.id_tipe LIMIT 100";
                $query_count_detail="SELECT
                                count(ms_barang.id_barang) as jumlah_item
                                FROM
                                ms_barang
                                LEFT JOIN ms_merk ON ms_barang.id_merk = ms_merk.id_merk
                                LEFT JOIN ms_kategori ON ms_barang.id_kategori = ms_kategori.id_kategori
                                LEFT JOIN ms_status_aktif ON ms_barang.status_aktif = ms_status_aktif.id_status_aktif
                                LEFT JOIN ms_supplier ON ms_barang.id_supplier = ms_supplier.id_supplier
                                LEFT JOIN ms_jenis_barang ON ms_barang.id_jenis = ms_jenis_barang.id_jenis
                                LEFT JOIN ms_satuan ON ms_barang.satuan = ms_satuan.id_satuan
                                LEFT JOIN ms_tipe ON ms_barang.id_tipe = ms_tipe.id_tipe";


      $data=array(
          'perintah' => 'Baru',
          'title'=>'Master Barang',
          'title_filter' => 'Cari Master Barang',
          'title_tambah' => 'Input Barang Baru',
          'title_report' => 'Laporan Barang',
          'jml_item'=>$this->Bis_model->manualQuery($query_count_detail),
          'data_barang'=>$this->Bis_model->manualQuery($query_data),
          'data_jenis'=>$this->Bis_model->manualQuery($query_jenis),
          'data_satuan'=>$this->Bis_model->manualQuery($query_satuan),
          'data_kategori'=>$this->Bis_model->manualQuery($query_kategori),
          'data_supplier'=>$this->Bis_model->manualQuery($query_supplier),
          'data_status_aktif' => $this->Bis_model->getAllData('ms_status_aktif'),
          #'data_merk' => $this->Bis_model->getAllData('ms_merk'),
          'data_merk'=>$this->Bis_model->manualQuery($query_merk),
          'data_tipe' => $this->Bis_model->getAllData('ms_tipe'),
          'users'=>$this->Hak_Akses_m->get_user($id),
          'menu'=>$this->Menu_m->get_menu($id),
          'submenu'=>$this->Menu_m->get_submenu($id),
      );

      $this->load->view('Msbarang_view',$data);
  }

  function Dataedit()
  {
    $id = get_cookie('eklinik');
    $id_barang = $this->input->post('id_barang');
    $query_supplier="select * from ms_supplier";
    $query_jenis="SELECT
                  	ms_jenis_barang.id_jenis,
                  	ms_jenis_barang.nama
                  FROM
                  	ms_jenis_barang";
    $query_kategori ="select * from ms_kategori";
    $query_satuan   ="select * from ms_satuan";
    $query_merk   ="select * from ms_merk";

    $query_data="SELECT
                    ms_barang.id_barang,
                    ms_barang.nama_alias,
                    ms_barang.nama AS nama_barang,
                    ms_kategori.id_kategori,
                    ms_kategori.nama AS nama_kategori,
                    ms_status_aktif.nama_status_aktif,
                    ms_status_aktif.id_status_aktif,
                    ms_barang.edit_date,
                    ms_barang.ppn,
                    ms_barang.barcode,
                    ms_barang.harga_beli,
                    ms_barang.harga_jual,
                    ms_barang.harga_tranfer,
                    ms_barang.status_aktif,
                    ms_barang.akun_pembelian,
                    ms_barang.akun_hpp,
                    ms_barang.akun_penjualan,
                    ms_barang.akun_retur_penjualan,
                    ms_barang.keterangan,
                    ms_barang.foto,
                    ms_barang.edit_user,
                    ms_barang.entry_date,
                    ms_barang.entry_user,
                    ms_jenis_barang.id_jenis,
                    ms_jenis_barang.nama AS nama_jenis,
                    ms_satuan.nama AS nama_satuan,
                    ms_tipe.nama AS nama_tipe,
                    ms_supplier.id_supplier,
                    ms_merk.nama AS nama_merk
                    FROM
                    ms_barang
                    LEFT JOIN ms_merk ON ms_barang.id_merk = ms_merk.id_merk
                    LEFT JOIN ms_kategori ON ms_barang.id_kategori = ms_kategori.id_kategori
                    LEFT JOIN ms_status_aktif ON ms_barang.status_aktif = ms_status_aktif.id_status_aktif
                    LEFT JOIN ms_supplier ON ms_barang.id_supplier = ms_supplier.id_supplier
                    LEFT JOIN ms_jenis_barang ON ms_barang.id_jenis = ms_jenis_barang.id_jenis
                    LEFT JOIN ms_satuan ON ms_barang.satuan = ms_satuan.id_satuan
                    LEFT JOIN ms_tipe ON ms_barang.id_tipe = ms_tipe.id_tipe
                    ORDER BY
                    nama_barang ASC LIMIT 10 ";

                $query_data_edit="SELECT
                          	ms_barang.id_barang,
                          	ms_barang.nama_alias,
                          	ms_merk.id_merk,
                          	ms_merk.nama AS nama_merk,
                          	ms_barang.nama AS nama_barang,
                          	ms_kategori.id_kategori,
                          	ms_kategori.nama AS nama_kategori,
                          	ms_status_aktif.nama_status_aktif,
                          	ms_status_aktif.id_status_aktif,
                          	ms_barang.edit_date,
                          	ms_barang.ppn,
                          	ms_barang.barcode,
                          	ms_barang.harga_beli,
                          	ms_barang.harga_jual,
                          	ms_barang.harga_tranfer,
                          	ms_barang.status_aktif,
                          	ms_barang.akun_pembelian,
                          	ms_barang.akun_hpp,
                          	ms_barang.akun_penjualan,
                          	ms_barang.akun_retur_penjualan,
                          	ms_barang.keterangan,
                          	ms_barang.foto,
                          	ms_barang.edit_user,
                          	ms_barang.entry_date,
                          	ms_barang.entry_user,
                          	ms_jenis_barang.id_jenis,
                          	ms_jenis_barang.nama AS nama_jenis,
                          	ms_barang.id_tipe,
                          	ms_tipe.nama AS nama_tipe,
                          	ms_supplier.id_supplier,
                          	ms_satuan.nama,
                          	ms_satuan.id_satuan
                          FROM
                          	ms_barang
                          	LEFT JOIN ms_merk ON ms_barang.id_merk = ms_merk.id_merk
                          	LEFT JOIN ms_kategori ON ms_barang.id_kategori = ms_kategori.id_kategori
                          	LEFT JOIN ms_status_aktif ON ms_barang.status_aktif = ms_status_aktif.id_status_aktif
                          	LEFT JOIN ms_supplier ON ms_barang.id_supplier = ms_supplier.id_supplier
                          	LEFT JOIN ms_jenis_barang ON ms_barang.id_jenis = ms_jenis_barang.id_jenis
                          	LEFT JOIN ms_satuan ON ms_barang.satuan = ms_satuan.id_satuan
                          	LEFT JOIN ms_tipe ON ms_barang.id_tipe = ms_tipe.id_tipe
                          WHERE
                          	ms_barang.id_barang = '$id_barang' ";
                 //echo $query_data_edit;
                 $query_count_detail="SELECT
                                 count(ms_barang.id_barang) as jumlah_item
                                 FROM
                                 ms_barang
                                 LEFT JOIN ms_merk ON ms_barang.id_merk = ms_merk.id_merk
                                 LEFT JOIN ms_kategori ON ms_barang.id_kategori = ms_kategori.id_kategori
                                 LEFT JOIN ms_status_aktif ON ms_barang.status_aktif = ms_status_aktif.id_status_aktif
                                 LEFT JOIN ms_supplier ON ms_barang.id_supplier = ms_supplier.id_supplier
                                 LEFT JOIN ms_jenis_barang ON ms_barang.id_jenis = ms_jenis_barang.id_jenis
                                 LEFT JOIN ms_satuan ON ms_barang.satuan = ms_satuan.id_satuan
                                 LEFT JOIN ms_tipe ON ms_barang.id_tipe = ms_tipe.id_tipe";
      $data=array(
          'perintah' => 'Edit',
          'title'=>'Master Barang',
          'title_filter' => 'Cari Master Barang',
          'title_tambah' => 'Edit Barang Baru',
          'title_report' => 'Laporan Barang',
          'jml_item'=>$this->Bis_model->manualQuery($query_count_detail),
          'data_barang'=>$this->Bis_model->manualQuery($query_data),
          'data_barang_edit'=>$this->Bis_model->manualQuery($query_data_edit),
          'data_supplier'=>$this->Bis_model->manualQuery($query_supplier),

          'data_kategori'=>$this->Bis_model->manualQuery($query_kategori),
          'data_satuan'=>$this->Bis_model->getAllData('ms_satuan'),
          'data_status_aktif' => $this->Bis_model->getAllData('ms_status_aktif'),
          'data_merk' =>$this->Bis_model->manualQuery($query_merk),
          'data_jenisx' =>$this->Bis_model->manualQuery($query_jenis),
          'data_tipe' => $this->Bis_model->getAllData('ms_tipe'),
          'users'=>$this->Hak_Akses_m->get_user($id),
          'menu'=>$this->Menu_m->get_menu($id),
          'submenu'=>$this->Menu_m->get_submenu($id),
      );

      $this->load->view('Msbarang_view',$data);
  }

// FILTER FUNCTION //
  function filter(){
    $id = get_cookie('eklinik');
    $filter = $this->input->post('katakunci');
    $query_supplier="select * from ms_supplier";
    $query_jenis="select * from ms_jenis_barang";
    $query_kategori="select * from ms_kategori";
    $query_satuan="select * from ms_satuan";
    $query_data="SELECT
                ms_barang.id_barang,
                ms_barang.nama_alias,
                ms_merk.id_merk,
                ms_merk.nama AS nama_merk,
                ms_barang.nama AS nama_barang,
                ms_kategori.id_kategori,
                ms_kategori.nama AS nama_kategori,
                ms_status_aktif.nama_status_aktif,
                ms_status_aktif.id_status_aktif,
                ms_barang.edit_date,
                ms_barang.ppn,
                ms_barang.barcode,
                ms_barang.harga_beli,
                ms_barang.harga_jual,
                ms_barang.harga_tranfer,
                ms_barang.status_aktif,
                ms_barang.akun_pembelian,
                ms_barang.akun_hpp,
                ms_barang.akun_penjualan,
                ms_barang.akun_retur_penjualan,
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
                ms_supplier.id_supplier
                FROM
                ms_barang
                LEFT JOIN ms_merk ON ms_barang.id_merk = ms_merk.id_merk
                LEFT JOIN ms_kategori ON ms_barang.id_kategori = ms_kategori.id_kategori
                LEFT JOIN ms_status_aktif ON ms_barang.status_aktif = ms_status_aktif.id_status_aktif
                LEFT JOIN ms_supplier ON ms_barang.id_supplier = ms_supplier.id_supplier
                LEFT JOIN ms_jenis_barang ON ms_barang.id_jenis = ms_jenis_barang.id_jenis
                LEFT JOIN ms_satuan ON ms_barang.satuan = ms_satuan.id_satuan
                LEFT JOIN ms_tipe ON ms_barang.id_tipe = ms_tipe.id_tipe
                  WHERE ms_barang.nama like '%$filter%' OR ms_barang.barcode like '%$filter%' OR ms_barang.id_barang like '%$filter%' OR ms_barang.nama_alias like '%$filter%'
                  ORDER BY ms_barang.nama ASC
                  ";
                  $query_count_detail="SELECT
                                  count(ms_barang.id_barang) as jumlah_item
                                  FROM
                                  ms_barang
                                  LEFT JOIN ms_merk ON ms_barang.id_merk = ms_merk.id_merk
                                  LEFT JOIN ms_kategori ON ms_barang.id_kategori = ms_kategori.id_kategori
                                  LEFT JOIN ms_status_aktif ON ms_barang.status_aktif = ms_status_aktif.id_status_aktif
                                  LEFT JOIN ms_supplier ON ms_barang.id_supplier = ms_supplier.id_supplier
                                  LEFT JOIN ms_jenis_barang ON ms_barang.id_jenis = ms_jenis_barang.id_jenis
                                  LEFT JOIN ms_satuan ON ms_barang.satuan = ms_satuan.id_satuan
                                  LEFT JOIN ms_tipe ON ms_barang.id_tipe = ms_tipe.id_tipe";
    $data=array(
        'perintah' => 'Baru',
        'title'=>'Master Barang',
        'title_filter' => 'Cari Master Barang',
        'title_tambah' => 'Input Barang Baru',
        'title_report' => 'Laporan Barang',
        'data_jenis'=>$this->Bis_model->manualQuery($query_jenis),
        'data_satuan'=>$this->Bis_model->manualQuery($query_satuan),
        'data_kategori'=>$this->Bis_model->manualQuery($query_kategori),
        'data_supplier'=>$this->Bis_model->manualQuery($query_supplier),
        'data_barang'=>$this->Bis_model->manualQuery($query_data),
        'jml_item'=>$this->Bis_model->manualQuery($query_count_detail),
        'data_status_aktif' => $this->Bis_model->getAllData('ms_status_aktif'),
        'data_merk' => $this->Bis_model->getAllData('ms_merk'),
        'data_tipe' => $this->Bis_model->getAllData('ms_tipe'),
        'users'=>$this->Hak_Akses_m->get_user(),
        'menu'=>$this->Menu_m->get_menu($id),
        'submenu'=>$this->Menu_m->get_submenu($id),
    );


    $this->load->view('Msbarang_view',$data);
  }
//    ===================== INSERT =====================
    function tambah()
    {
      $now = date('Y-m-d H:i:s');
      $cookie_id_user = get_cookie('eklinik');
      $date = new DateTime($now);
      //$id_jenis =  $this->input->post('id_jenis');
      $year = $date -> format('y');
      $month = $date -> format('m');
      //$day = $date -> format('d');
      //$kode_bukti=$this->input->post('id_jenis');
      //$id_barang= $this->Bis_model->getIdBarang($kode_bukti);
      $kode_bukti="REG".$year.$month."-";
      $id_barang= $this->Bis_model->getIdBarang($kode_bukti);
      //$id_barang='ITM'.time();
      $data=array(
          'id_barang'=>$id_barang,
          'id_kategori'=>$this->input->post('id_kategori'),
          'id_jenis'=>$this->input->post('id_jenis'),
          'id_tipe'=>$this->input->post('id_tipe'),
          'id_merk'=>$this->input->post('id_merk'),
          'id_supplier'=>$this->input->post('id_supplier'),
          'barcode'=>$this->input->post('barcode'),
          'nama'=>$this->input->post('nama'),
          'nama_alias'=>$this->input->post('nama_alias'),
          'harga_beli'=>$this->input->post('harga_beli'),
          'harga_jual'=>$this->input->post('harga_jual'),
          'harga_tranfer'=>$this->input->post('harga_tranfer'),
          'satuan'=>$this->input->post('id_satuan'),
          'ppn'=>$this->input->post('ppn'),
          'status_aktif'=>$this->input->post('id_status_aktif'),
          'keterangan'=>$this->input->post('keterangan'),
          'entry_user'=>$cookie_id_user,
          'entry_date'=>$now,
      );
      $this->db->trans_begin();
      $this->Bis_model->insertData('ms_barang',$data);

      if ($this->db->trans_status() === FALSE)
      {
              $this->db->trans_rollback();
      }
      else
      {
              $this->db->trans_commit();
              $this->session->set_flashdata('message', 'Sukses tambah data baru.');
              $this->session->set_flashdata('jenis', 'success');
              redirect(site_url('Msbarang'));
      }

      }

//    ======================== EDIT =======================
    function edit(){
        $id['id_barang'] = $this->input->post('id_barang');
		    //$id=$this->input->post('id_barang');
        $now = date('Y-m-d H:i:s');
        $cookie_id_user = get_cookie('eklinik');

        $data=array(
          'id_kategori'=>$this->input->post('id_kategori'),
          'id_jenis'=>$this->input->post('id_jenis'),
          'id_tipe'=>$this->input->post('id_tipe'),
          'id_merk'=>$this->input->post('id_merk'),
          'id_supplier'=>$this->input->post('id_supplier'),
          'barcode'=>$this->input->post('barcode'),
          'nama'=>$this->input->post('nama'),
          'nama_alias'=>$this->input->post('nama_alias'),
          'harga_beli'=>$this->input->post('harga_beli'),
          'harga_jual'=>$this->input->post('harga_jual'),
          'harga_tranfer'=>$this->input->post('harga_tranfer'),
          'satuan'=>$this->input->post('id_satuan'),
          'ppn'=>$this->input->post('ppn'),
          'status_aktif'=>$this->input->post('id_status_aktif'),
          'edit_user'=>$cookie_id_user,
          'edit_date'=>$now,
        );

        $this->db->trans_begin();
        $this->Bis_model->updateData('ms_barang',$data,$id);

        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses edit data.');
                $this->session->set_flashdata('jenis', 'info');
                redirect(site_url('Msbarang'));
        }

    }

//    ========================== DELETE =======================
    function hapus(){
        //$id['id_barang'] = $this->uri->segment(3);
        $id['id_barang'] = $this->input->post('id_barang');
        $this->db->trans_begin();
        $this->Bis_model->deleteData('ms_barang',$id);
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses hapus data.');
                $this->session->set_flashdata('jenis', 'danger');
                redirect(site_url('msbarang'));
        }

    }
//    ====================== EXPORT KE EXCEL ===================
function exportexcel()
{
  $this->load->model('umum/Bis_model');

  $query_data="SELECT
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
                ms_barang.harga_beli,
                ms_barang.harga_jual,
                ms_barang.harga_tranfer,
                ms_barang.status_aktif,
                ms_barang.akun_pembelian,
                ms_barang.akun_hpp,
                ms_barang.akun_penjualan,
                ms_barang.akun_retur_penjualan,
                ms_barang.keterangan,
                ms_barang.foto,
                ms_barang.edit_user,
                ms_barang.entry_date,
                ms_barang.entry_user,
                ms_jenis_barang.id_jenis,
                ms_jenis_barang.nama AS nama_jenis,
                ms_satuan.nama AS nama_satuan,
                ms_barang.id_tipe,
                ms_tipe.nama AS nama_tipe
                FROM
                ms_barang
                LEFT JOIN ms_merk ON ms_barang.id_merk = ms_merk.id_merk
                LEFT JOIN ms_kategori ON ms_barang.id_kategori = ms_kategori.id_kategori
                LEFT JOIN ms_status_aktif ON ms_barang.status_aktif = ms_status_aktif.id_status_aktif
                LEFT JOIN ms_supplier ON ms_barang.id_supplier = ms_supplier.id_supplier
                LEFT JOIN ms_jenis_barang ON ms_barang.id_jenis = ms_jenis_barang.id_jenis
                LEFT JOIN ms_satuan ON ms_barang.satuan = ms_satuan.id_satuan
                LEFT JOIN ms_tipe ON ms_barang.id_tipe = ms_tipe.id_tipe
                WHERE
                ms_barang.status_aktif = 1";
                $data=array(
                    'title'=>'Master Barang',
                    'data_barang'=>$this->Bis_model->manualQuery($query_data),
                );
                $this->load->view('export/master_barang_export',$data);
}
}
