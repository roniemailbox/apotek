<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cariharga extends CI_Controller
{
  function __construct(){
      parent::__construct();
       $this->load->model('umum/Bis_model');
       $this->load->model('umum/Bis_model_ant');
       $this->load->helper('currency_format_helper');

    }
  function index()
  {
    $id = get_cookie('eklinik');
    //print_r($this->session->userdata());
    //$nama_usaha= $this->session->userdata('alias_perusahaan1');
    $id_log_dept=$this->session->userdata('id_departement'.$id);
    $id_log_div=$this->session->userdata('id_divisi'.$id);
    $id_log_jab=$this->session->userdata('id_jabatan'.$id);


    $this->load->model('Menu_m');
    $this->load->model('Hak_Akses_m');
    $this->load->model('Login_m');
    $data['jabatan'] = $this->Login_m->get_jabatan();
    $data['users'] = $this->Hak_Akses_m->get_user();
    $data['menu'] = $this->Menu_m->get_menu($id);
    $data['submenu'] = $this->Menu_m->get_submenu($id);

    $query_slock="SELECT * from ms_supplier";
    $data['data_supplier'] = $this->Bis_model->manualQuery($query_slock);

    $query_budget="SELECT
                  set_budget.id_budget,
                  CONCAT(ms_divisi.nama,' : ',ms_departement.nama,' - ',ms_beban.nama) as nama,
                  set_budget.tahun,
                  set_budget.nominal,
                  set_budget.entry_user,
                  set_budget.entry_date,
                  set_budget.edit_user,
                  set_budget.edit_date,
                  ms_beban.id_beban,
                  ms_beban.nama as nama_beban,
                  ms_departement.id_departement,
                  ms_departement.nama as nama_departement,
                  ms_divisi.id_divisi,
                  ms_divisi.nama as nama_divisi,
                  ms_plant.id_plant,
                  ms_plant.nama as nama_plant
                  FROM
                  set_budget
                  INNER JOIN ms_beban ON set_budget.id_beban = ms_beban.id_beban
                  INNER JOIN ms_departement ON set_budget.id_departement = ms_departement.id_departement
                  INNER JOIN ms_divisi ON ms_departement.id_divisi = ms_divisi.id_divisi
                  INNER JOIN ms_plant ON ms_divisi.id_plant = ms_plant.id_plant
                  WHERE
                  ms_departement.id_departement = $id_log_dept
                  ORDER BY
                  nama_divisi asc,nama_departement asc, nama_beban ASC";
                  $query_budget_all="SELECT
                                set_budget.id_budget,
                                CONCAT(ms_divisi.nama,' : ',ms_departement.nama,' - ',ms_beban.nama) as nama,
                                set_budget.tahun,
                                set_budget.nominal,
                                set_budget.entry_user,
                                set_budget.entry_date,
                                set_budget.edit_user,
                                set_budget.edit_date,
                                ms_beban.id_beban,
                                ms_beban.nama as nama_beban,
                                ms_departement.id_departement,
                                ms_departement.nama as nama_departement,
                                ms_divisi.id_divisi,
                                ms_divisi.nama as nama_divisi,
                                ms_plant.id_plant,
                                ms_plant.nama as nama_plant
                                FROM
                                set_budget
                                INNER JOIN ms_beban ON set_budget.id_beban = ms_beban.id_beban
                                INNER JOIN ms_departement ON set_budget.id_departement = ms_departement.id_departement
                                INNER JOIN ms_divisi ON ms_departement.id_divisi = ms_divisi.id_divisi
                                INNER JOIN ms_plant ON ms_divisi.id_plant = ms_plant.id_plant
                                ORDER BY
                                  nama_divisi asc,nama_departement asc, nama_beban ASC";
    if ($id_log_jab<6){
                  $data['data_budget'] = $this->Bis_model->manualQuery($query_budget_all);
                        //print_r($query_budget_all);
                        //print_r("<br>");
                        //print_r($id_log_jab);
                  }

    else{
                  $data['data_budget'] = $this->Bis_model->manualQuery($query_budget);
                        //print_r($query_budget);
                        //print_r("<br>");
                        //print_r($id_log_jab);
                  }


      $query_data_per_user="SELECT
                            trans_spp.no_spp,
                            trans_spp.tgl_spp,
                            trans_spp.tgl_cair,
                            trans_spp.id_budget,
                            CONCAT(ms_divisi.nama,' : ',ms_departement.nama,' - ',ms_beban.nama) AS nama,
                            trans_spp.kd_supplier,
                            trans_spp.status_spp,
                            trans_spp.approved_spp_1,
                            trans_spp.user_approved_1,
                            trans_spp.approved_date_1,
                            trans_spp.approved_spp_2,
                            trans_spp.user_approved_2,
                            trans_spp.approved_date_2,
                            trans_spp.modul_asal AS jenis,
                            trans_spp.nominal1,
                            trans_spp.nominal2,
                            trans_spp.penerima,
                            trans_spp.keterangan,
                            trans_spp.entry_date,
                            set_budget.tahun,
                            set_budget.nominal AS budget_awal,
                            ms_beban.id_beban,
                            ms_beban.nama AS nama_beban,
                            ms_divisi.id_divisi,
                            ms_divisi.nama AS nama_divisi,
                            ms_plant.id_plant,
                            ms_plant.nama AS nama_plant,
                            trans_spp.id_budget,
                            trans_spp.id_barang,
                            trans_spp.qty,
                            ms_barang.part_number,
                            ms_barang.nama AS nama_barang,
                            trans_spp.entry_user,
                            ms_departement.nama AS nama_departement,
                            ms_pegawai.alamat,
                            ms_pegawai.nama AS nama_pegawai
                            FROM
                            set_budget
                            INNER JOIN ms_departement ON set_budget.id_departement = ms_departement.id_departement
                            INNER JOIN ms_divisi ON ms_departement.id_divisi = ms_divisi.id_divisi
                            INNER JOIN ms_plant ON ms_divisi.id_plant = ms_plant.id_plant
                            INNER JOIN ms_beban ON set_budget.id_beban = ms_beban.id_beban
                            INNER JOIN trans_spp ON trans_spp.id_budget = set_budget.id_budget
                            INNER JOIN ms_barang ON trans_spp.id_barang = ms_barang.id_barang
                            INNER JOIN `user` ON trans_spp.entry_user = `user`.id_user
                            INNER JOIN ms_pegawai ON ms_pegawai.id_pegawai = `user`.id_pegawai
                            WHERE YEAR(trans_spp.tgl_spp)=YEAR(NOW()) AND trans_spp.status_spp = 1 AND trans_spp.id_supplier1 is null AND trans_spp.id_supplier2 is null is NULL and trans_spp.entry_user=$id
                            ORDER BY
                            trans_spp.tgl_spp ASC";
                  $query_data="SELECT
                            trans_spp.no_spp,
                            trans_spp.tgl_spp,
                            trans_spp.tgl_cair,
                            trans_spp.id_budget,
                            CONCAT(ms_divisi.nama,' : ',ms_departement.nama,' - ',ms_beban.nama) AS nama,
                            trans_spp.kd_supplier,
                            trans_spp.status_spp,
                            trans_spp.approved_spp_1,
                            trans_spp.user_approved_1,
                            trans_spp.approved_date_1,
                            trans_spp.approved_spp_2,
                            trans_spp.user_approved_2,
                            trans_spp.approved_date_2,
                            trans_spp.modul_asal AS jenis,
                            trans_spp.nominal1,
                            trans_spp.nominal2,
                            trans_spp.penerima,
                            trans_spp.keterangan,
                            trans_spp.entry_date,
                            set_budget.tahun,
                            set_budget.nominal AS budget_awal,
                            ms_beban.id_beban,
                            ms_beban.nama AS nama_beban,
                            ms_divisi.id_divisi,
                            ms_divisi.nama AS nama_divisi,
                            ms_plant.id_plant,
                            ms_plant.nama AS nama_plant,
                            trans_spp.id_budget,
                            trans_spp.id_barang,
                            trans_spp.qty,
                            ms_barang.part_number,
                            ms_barang.nama AS nama_barang,
                            trans_spp.entry_user,
                            ms_departement.nama AS nama_departement,
                            ms_pegawai.alamat,
                            ms_pegawai.nama AS nama_pegawai
                            FROM
                            set_budget
                            INNER JOIN ms_departement ON set_budget.id_departement = ms_departement.id_departement
                            INNER JOIN ms_divisi ON ms_departement.id_divisi = ms_divisi.id_divisi
                            INNER JOIN ms_plant ON ms_divisi.id_plant = ms_plant.id_plant
                            INNER JOIN ms_beban ON set_budget.id_beban = ms_beban.id_beban
                            INNER JOIN trans_spp ON trans_spp.id_budget = set_budget.id_budget
                            INNER JOIN ms_barang ON trans_spp.id_barang = ms_barang.id_barang
                            INNER JOIN `user` ON trans_spp.entry_user = `user`.id_user
                            INNER JOIN ms_pegawai ON ms_pegawai.id_pegawai = `user`.id_pegawai
                            WHERE YEAR(trans_spp.tgl_spp)=YEAR(NOW()) AND trans_spp.status_spp = 1 AND trans_spp.id_supplier1 is null AND trans_spp.id_supplier2 is null
                            ORDER BY
                            trans_spp.tgl_spp ASC
                            ";
    if ($id_log_jab<6)
    {
          $data['data_spp'] = $this->Bis_model->manualQuery($query_data);
          //echo $query_data.' '.$id_log_jab;
          //echo $id_log_jab."-".$id;
    }

    else
    {
          $data['data_spp'] = $this->Bis_model->manualQuery($query_data_per_user);
          //echo $query_data_per_user.' '.$id_log_jab;
          //echo $id_log_jab."-".$id;
    }


    $query_data_per_user2="SELECT
trans_spp.no_spp,
trans_spp.tgl_spp,
trans_spp.tgl_cair,
trans_spp.id_budget,
CONCAT(ms_divisi.nama,' : ',ms_departement.nama,' - ',ms_beban.nama) AS nama,
trans_spp.kd_supplier,
trans_spp.status_spp,
trans_spp.approved_spp_1,
trans_spp.user_approved_1,
trans_spp.approved_date_1,
trans_spp.approved_spp_2,
trans_spp.user_approved_2,
trans_spp.approved_date_2,
trans_spp.modul_asal AS jenis,
trans_spp.penerima,
trans_spp.keterangan,
trans_spp.entry_date,
set_budget.tahun,
set_budget.nominal AS budget_awal,
ms_beban.id_beban,
ms_beban.nama AS nama_beban,
ms_divisi.id_divisi,
ms_divisi.nama AS nama_divisi,
ms_plant.id_plant,
ms_plant.nama AS nama_plant,
trans_spp.id_budget,
trans_spp.id_barang,
trans_spp.qty,
ms_barang.part_number,
ms_barang.nama AS nama_barang,
trans_spp.entry_user,
ms_departement.nama AS nama_departement,
ms_pegawai.alamat,
ms_pegawai.nama AS nama_pegawai,
trans_spp.tgl_harga,
trans_spp.id_suppentry,
trans_spp.id_supplier1,
trans_spp.ket_supp1,
trans_spp.nominal1,
trans_spp.id_supplier2,
trans_spp.ket_supp2,
trans_spp.nominal2,
supp1.nama AS nama_supplier1,
supp2.nama AS nama_supplier2,
pegawai_banding.nama AS nama_pembanding
FROM
set_budget
INNER JOIN ms_departement ON set_budget.id_departement = ms_departement.id_departement
INNER JOIN ms_divisi ON ms_departement.id_divisi = ms_divisi.id_divisi
INNER JOIN ms_plant ON ms_divisi.id_plant = ms_plant.id_plant
INNER JOIN ms_beban ON set_budget.id_beban = ms_beban.id_beban
INNER JOIN trans_spp ON trans_spp.id_budget = set_budget.id_budget
INNER JOIN ms_barang ON trans_spp.id_barang = ms_barang.id_barang
INNER JOIN `user` AS user_input ON trans_spp.entry_user = user_input.id_user
INNER JOIN ms_pegawai ON ms_pegawai.id_pegawai = user_input.id_pegawai
LEFT JOIN ms_supplier AS supp1 ON trans_spp.id_supplier1 = supp1.id_supplier
LEFT JOIN ms_supplier AS supp2 ON trans_spp.id_supplier2 = supp2.id_supplier
LEFT JOIN `user` AS user_banding ON user_banding.id_user = trans_spp.id_suppentry
LEFT JOIN ms_pegawai AS pegawai_banding ON pegawai_banding.id_pegawai = user_banding.id_pegawai


                          WHERE YEAR(trans_spp.tgl_spp)=YEAR(NOW()) AND trans_spp.status_spp = 1 AND trans_spp.id_supplier1 is not null AND trans_spp.id_supplier2 is not null and trans_spp.entry_user=$id
                          ORDER BY
                          trans_spp.tgl_spp ASC";
                $query_data2="SELECT
trans_spp.no_spp,
trans_spp.tgl_spp,
trans_spp.tgl_cair,
trans_spp.id_budget,
CONCAT(ms_divisi.nama,' : ',ms_departement.nama,' - ',ms_beban.nama) AS nama,
trans_spp.kd_supplier,
trans_spp.status_spp,
trans_spp.approved_spp_1,
trans_spp.user_approved_1,
trans_spp.approved_date_1,
trans_spp.approved_spp_2,
trans_spp.user_approved_2,
trans_spp.approved_date_2,
trans_spp.modul_asal AS jenis,
trans_spp.penerima,
trans_spp.keterangan,
trans_spp.entry_date,
set_budget.tahun,
set_budget.nominal AS budget_awal,
ms_beban.id_beban,
ms_beban.nama AS nama_beban,
ms_divisi.id_divisi,
ms_divisi.nama AS nama_divisi,
ms_plant.id_plant,
ms_plant.nama AS nama_plant,
trans_spp.id_budget,
trans_spp.id_barang,
trans_spp.qty,
ms_barang.part_number,
ms_barang.nama AS nama_barang,
trans_spp.entry_user,
ms_departement.nama AS nama_departement,
ms_pegawai.alamat,
ms_pegawai.nama AS nama_pegawai,
trans_spp.tgl_harga,
trans_spp.id_suppentry,
trans_spp.id_supplier1,
trans_spp.ket_supp1,
trans_spp.nominal1,
trans_spp.id_supplier2,
trans_spp.ket_supp2,
trans_spp.nominal2,
supp1.nama AS nama_supplier1,
supp2.nama AS nama_supplier2,
pegawai_banding.nama AS nama_pembanding
FROM
set_budget
INNER JOIN ms_departement ON set_budget.id_departement = ms_departement.id_departement
INNER JOIN ms_divisi ON ms_departement.id_divisi = ms_divisi.id_divisi
INNER JOIN ms_plant ON ms_divisi.id_plant = ms_plant.id_plant
INNER JOIN ms_beban ON set_budget.id_beban = ms_beban.id_beban
INNER JOIN trans_spp ON trans_spp.id_budget = set_budget.id_budget
INNER JOIN ms_barang ON trans_spp.id_barang = ms_barang.id_barang
INNER JOIN `user` AS user_input ON trans_spp.entry_user = user_input.id_user
INNER JOIN ms_pegawai ON ms_pegawai.id_pegawai = user_input.id_pegawai
LEFT JOIN ms_supplier AS supp1 ON trans_spp.id_supplier1 = supp1.id_supplier
LEFT JOIN ms_supplier AS supp2 ON trans_spp.id_supplier2 = supp2.id_supplier
LEFT JOIN `user` AS user_banding ON user_banding.id_user = trans_spp.id_suppentry
LEFT JOIN ms_pegawai AS pegawai_banding ON pegawai_banding.id_pegawai = user_banding.id_pegawai


                          WHERE YEAR(trans_spp.tgl_spp)=YEAR(NOW()) AND trans_spp.status_spp = 1 AND trans_spp.id_supplier1 is not null AND trans_spp.id_supplier2 is not null
                          ORDER BY
                          trans_spp.tgl_spp ASC
                          ";
  if ($id_log_jab<6)
  {
        $data['data_spp2'] = $this->Bis_model->manualQuery($query_data2);
        //echo $query_data.' '.$id_log_jab;
        //echo $id_log_jab."-".$id;
  }

  else
  {
        $data['data_spp2'] = $this->Bis_model->manualQuery($query_data_per_user2);
        //echo $query_data_per_user.' '.$id_log_jab;
        //echo $id_log_jab."-".$id;
  }

    $this->load->view('Cariharga_view',$data);
  }





    function simpan()
    {
      $now = date('Y-m-d H:i:s');
      $date = new DateTime($this->input->post('tgl_produksi'));
      $id_plant = $this->input->post('id_plant');
      $year = $date -> format('Y');
      $month = $date -> format('m');
      $day = $date -> format('d');
      $kode_bukti="SPP".$year.$month;
      $cookie_id_user = get_cookie('eklinik');
      $id['no_spp'] = $this->input->post('no_spp');
      $no_bukti= $this->input->post('no_spp');
      $data=array(

        //'tgl_spp'=>$this->input->post('tgl_spp'),
        //'tgl_cair'=>$this->input->post('tgl_cair'),
        //'id_budget'=>$this->input->post('id_budget'),
        //'id_barang'=>$this->input->post('id_barang'),
        //'kd_supplier'=>$this->input->post('kd_supplier'),
        //'status_spp'=>1,
        //'approved_spp_1'=>$this->input->post('approved_spp_1'),
        //'user_approved_1'=>$this->input->post('user_approved_1'),
        //'approved_date_1'=>$this->input->post('approved_date_1'),
        //'approved_spp_2'=>$this->input->post('approved_spp_2'),
        //'user_approved_2'=>$this->input->post('user_approved_2'),
        //'approved_date_2'=>$this->input->post('approved_date_2'),
        //'modul_asal'=>$this->input->post('modul_asal'),
        'qty'=>$this->input->post('qty'),
        'tgl_harga'=>$this->input->post('tgl_harga'),
        'id_suppentry'=>$cookie_id_user,
        'id_supplier1'=>$this->input->post('id_supplier1'),
        'ket_supp1'=>$this->input->post('note1'),
        'nominal1'=>$this->input->post('harga1'),
        'id_supplier2'=>$this->input->post('id_supplier2'),
        'ket_supp2'=>$this->input->post('note2'),
        'nominal2'=>$this->input->post('harga2'),
        //'penerima'=>$this->input->post('penerima'),
        'keterangan'=>$this->input->post('keterangan'),
        //'id_supplier'=>$this->input->post('id_supplier'),
        //'harga'=>$this->input->post('harga'),
        //'entry_user'=>$cookie_id_user,
        //'entry_date'=>$now,
      );
      $this->db->trans_off();
      $this->db->trans_begin();
      $this->db->trans_strict(true);
    //  $this->Bis_model->insertData('Trans_spp',$data);
      $this->Bis_model->updateData('trans_spp',$data,$id);
     //  $inserted_count = 0;
  		//insert gl

  		//foreach ($this->input->post('rowsBM') as $key => $count )
      //{
          //echo ($no_bukti);
          //echo ($this->input->post('qty_'.$count));

          //echo ($this->input->post('kode_barang_'.$count));
          //echo ("<br>");
          //$data=array(
          //  'no_bukti'=>$no_bukti,
          //  'kd_barang'=>$this->input->post('kode_barang_'.$count),
          //  'qty'=>$this->input->post('qty_'.$count),
          //);
          //$this->Bis_model->insertData('detail_spb',$data);
      //}
      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE)
      {
              $this->db->trans_rollback();
              $this->session->set_flashdata('message', 'Gagal input data produksi.');
              $this->session->set_flashdata('jenis', 'danger');
              redirect(site_url('Cariharga'));
      }
      else
      {
              $this->db->trans_commit();
              $this->session->set_flashdata('message', 'Sukses tambah data baru.');
              $this->session->set_flashdata('jenis', 'success');
              redirect(site_url('Cariharga'));
      }
      }

      function edit_supp_harga()
      {
        $now = date('Y-m-d H:i:s');
        $date = new DateTime($this->input->post('tgl_produksi'));
        $id_plant = $this->input->post('id_plant');
        $year = $date -> format('Y');
        $month = $date -> format('m');
        $day = $date -> format('d');
        $kode_bukti="SPP".$year.$month;
        $cookie_id_user = get_cookie('eklinik');
        $id['no_spp'] = $this->input->post('no_spp');
        $id_po['no_spp'] = $this->input->post('no_spp');
        $id_po['kd_barang'] = $this->input->post('id_barang');
        $no_bukti= $this->input->post('no_spp');
        $data=array(

          //'tgl_spp'=>$this->input->post('tgl_spp'),
          //'tgl_cair'=>$this->input->post('tgl_cair'),
          //'id_budget'=>$this->input->post('id_budget'),
          //'id_barang'=>$this->input->post('id_barang'),
          //'kd_supplier'=>$this->input->post('kd_supplier'),
          //'status_spp'=>1,
          //'approved_spp_1'=>$this->input->post('approved_spp_1'),
          //'user_approved_1'=>$this->input->post('user_approved_1'),
          //'approved_date_1'=>$this->input->post('approved_date_1'),
          //'approved_spp_2'=>$this->input->post('approved_spp_2'),
          //'user_approved_2'=>$this->input->post('user_approved_2'),
          //'approved_date_2'=>$this->input->post('approved_date_2'),
          //'modul_asal'=>$this->input->post('modul_asal'),
          'qty'=>$this->input->post('qty'),
          'tgl_harga'=>$this->input->post('tgl_harga'),
          'id_suppentry'=>$cookie_id_user,
          'id_supplier1'=>$this->input->post('id_supplier1'),
          'ket_supp1'=>$this->input->post('note1'),
          'nominal1'=>$this->input->post('harga1'),
          'id_supplier2'=>$this->input->post('id_supplier2'),
          'ket_supp2'=>$this->input->post('note2'),
          'nominal2'=>$this->input->post('harga2'),
          //'penerima'=>$this->input->post('penerima'),
          'keterangan'=>$this->input->post('keterangan'),
          //'id_supplier'=>$this->input->post('id_supplier'),
          //'harga'=>$this->input->post('harga'),
          //'entry_user'=>$cookie_id_user,
          //'entry_date'=>$now,
        );

        $data_po=array(


          'qty'=>$this->input->post('qty'),
          'hb'=>$this->input->post('hb'),

        );

        $this->db->trans_off();
        $this->db->trans_begin();
        $this->db->trans_strict(true);
      //  $this->Bis_model->insertData('Trans_spp',$data);
        $this->Bis_model->updateData('trans_spp',$data,$id);
        $this->Bis_model->updateData('detail_po',$data_po,$id_po);
       //  $inserted_count = 0;
    		//insert gl

    		//foreach ($this->input->post('rowsBM') as $key => $count )
        //{
            //echo ($no_bukti);
            //echo ($this->input->post('qty_'.$count));

            //echo ($this->input->post('kode_barang_'.$count));
            //echo ("<br>");
            //$data=array(
            //  'no_bukti'=>$no_bukti,
            //  'kd_barang'=>$this->input->post('kode_barang_'.$count),
            //  'qty'=>$this->input->post('qty_'.$count),
            //);
            //$this->Bis_model->insertData('detail_spb',$data);
        //}
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                $this->session->set_flashdata('message', 'Gagal input data produksi.');
                $this->session->set_flashdata('jenis', 'danger');
                redirect(site_url('Cariharga'));
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses tambah data baru.');
                $this->session->set_flashdata('jenis', 'success');
                redirect(site_url('Cariharga'));
        }
        }


      function edit_data()
      {
        $now = date('Y-m-d H:i:s');
        $date = new DateTime($this->input->post('tgl_produksi'));
        $id_plant = $this->input->post('id_plant');
        $year = $date -> format('Y');
        $month = $date -> format('m');
        $day = $date -> format('d');
        $kode_bukti="SPP".$year.$month;
        $cookie_id_user = get_cookie('eklinik');
        $id['no_spp'] = $this->input->post('no_spp');
        $no_bukti= $this->input->post('no_spp');
        $data=array(


          'tgl_spp'=>$this->input->post('tgl_spp'),
          'tgl_cair'=>$this->input->post('tgl_cair'),
          'id_budget'=>$this->input->post('id_budget'),
          'id_barang'=>$this->input->post('id_barang'),
          //'kd_supplier'=>$this->input->post('kd_supplier'),
          'status_spp'=>1,
          //'approved_spp_1'=>$this->input->post('approved_spp_1'),
          //'user_approved_1'=>$this->input->post('user_approved_1'),
          //'approved_date_1'=>$this->input->post('approved_date_1'),
          //'approved_spp_2'=>$this->input->post('approved_spp_2'),
          //'user_approved_2'=>$this->input->post('user_approved_2'),
          //'approved_date_2'=>$this->input->post('approved_date_2'),
          'modul_asal'=>$this->input->post('modul_asal'),
          'qty'=>$this->input->post('qty'),
          //'id_supplier1'=>$this->input->post('id_supplier1'),
          //'ket_supp1'=>$this->input->post('ket_supp1'),
          //'nominal1'=>$this->input->post('nominal1'),
          //'id_supplier2'=>$this->input->post('id_supplier2'),
          //'ket_supp2'=>$this->input->post('ket_supp2'),
          //'nominal2'=>$this->input->post('nominal2'),
          //'penerima'=>$this->input->post('penerima'),
         'keterangan'=>$this->input->post('keterangan'),
          //'id_supplier'=>$this->input->post('id_supplier'),
          //'harga'=>$this->input->post('harga'),
          'edit_user'=>$cookie_id_user,
          'edit_date'=>$now,

        );
        $this->db->trans_off();
        $this->db->trans_begin();
        $this->db->trans_strict(true);
        $this->Bis_model->updateData('trans_spp',$data,$id);
        //$this->Bis_model->deleteData('detail_spb',$id);
        //$inserted_count = 0;
    		//insert gl

    		//foreach ($this->input->post('rowsBM') as $key => $count )
        //{
             //echo ($no_bukti);
        //     echo ($this->input->post('qty_'.$count));

        //     echo ($this->input->post('kode_barang_'.$count));
        //      echo ("<br>");
        //     $data=array(
        //      'no_bukti'=>$no_bukti,
        //      'kd_barang'=>$this->input->post('kode_barang_'.$count),
        //      'qty'=>$this->input->post('qty_'.$count),
        //     );
        //     $this->Bis_model->insertData('detail_spb',$data);
        //}
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                $this->session->set_flashdata('message', 'Gagal Edit data permintaan barang.');
                $this->session->set_flashdata('jenis', 'danger');
                redirect(site_url('Spb'));
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses Edit data permintaan barang.');
                $this->session->set_flashdata('jenis', 'success');
                redirect(site_url('Spb'));
        }
        }

      function edit()
      {
          $id['no_spp'] = $this->uri->segment(3);

          $no_bukti= $this->uri->segment(3);
          $id = get_cookie('eklinik');
          $this->load->model('Menu_m');
          $this->load->model('Hak_Akses_m');
          $this->load->model('Login_m');
          $data['data_jabatan'] = $this->Bis_model->getAllData('ms_jabatan');
          $query_plant="SELECT * from ms_plant";
          $data['data_plant'] = $this->Bis_model->manualQuery($query_plant);

          $query_data="SELECT
                    trans_spp.no_spp,
                    trans_spp.tgl_spp,
                    trans_spp.tgl_cair,
                    trans_spp.id_budget,
                    CONCAT(ms_divisi.nama,' : ',ms_departement.nama,' - ',ms_beban.nama) AS nama,
                    trans_spp.kd_supplier,
                    trans_spp.status_spp,
                    trans_spp.approved_spp_1,
                    trans_spp.user_approved_1,
                    trans_spp.approved_date_1,
                    trans_spp.approved_spp_2,
                    trans_spp.user_approved_2,
                    trans_spp.approved_date_2,
                    trans_spp.modul_asal,
                    trans_spp.nominal1,
                    trans_spp.nominal2,
                    trans_spp.penerima,
                    trans_spp.keterangan,
                    trans_spp.entry_date,
                    set_budget.tahun,
                    set_budget.nominal AS budget_awal,
                    ms_beban.id_beban,
                    ms_beban.nama AS nama_beban,
                    ms_divisi.id_divisi,
                    ms_divisi.nama AS nama_divisi,
                    ms_plant.id_plant,
                    ms_plant.nama AS nama_plant,
                    trans_spp.id_budget,
                    trans_spp.id_barang,
                    trans_spp.qty,
                    trans_spp.keterangan,
                    ms_barang.part_number,
                    ms_barang.nama AS nama_barang,
                    trans_spp.entry_user,
                    ms_departement.nama AS nama_departement,
                    ms_pegawai.alamat,
                    ms_pegawai.nama AS nama_pegawai
                    FROM
                    set_budget
                    INNER JOIN ms_departement ON set_budget.id_departement = ms_departement.id_departement
                    INNER JOIN ms_divisi ON ms_departement.id_divisi = ms_divisi.id_divisi
                    INNER JOIN ms_plant ON ms_divisi.id_plant = ms_plant.id_plant
                    INNER JOIN ms_beban ON set_budget.id_beban = ms_beban.id_beban
                    INNER JOIN trans_spp ON trans_spp.id_budget = set_budget.id_budget
                    INNER JOIN ms_barang ON trans_spp.id_barang = ms_barang.id_barang
                    INNER JOIN `user` ON trans_spp.entry_user = `user`.id_user
                    INNER JOIN ms_pegawai ON ms_pegawai.id_pegawai = `user`.id_pegawai
                      WHERE
                      trans_spp.no_spp = '$no_bukti'


                      ";
           //echo($query_data);
                      //$query_driver="SELECT * from ms_pegawai where id_jabatan=40";
          $q_detail="SELECT
                      judul_spb.no_bukti,
                      detail_spb.kd_barang,
                      ms_barang.nama as nama_barang,
                      detail_spb.qty
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
          $data['data_spp'] = $this->Bis_model->manualQuery($query_data);
          //$data['data_detail_spb'] = $this->Bis_model->manualQuery($q_detail);
          //$data['data_unit'] = $this->Bis_model->manualQuery($q_unit);
          //$data['data_pegawai'] = $this->Bis_model->manualQuery($q_pegawai);
        //  $data['data_driver'] = $this->Bis_model->manualQuery($query_driver);
          $data['jabatan'] = $this->Login_m->get_jabatan();
          $data['users'] = $this->Hak_Akses_m->get_user();
          $data['menu'] = $this->Menu_m->get_menu($id);
          $data['submenu'] = $this->Menu_m->get_submenu($id);
          $this->load->view('Spb_view',$data);
        }
  function hapus()
  {
    $id['no_bukti'] = $this->uri->segment(3);
    $this->db->trans_begin();
    $this->Bis_model->deleteData('judul_spb',$id);
    if ($this->db->trans_status() === FALSE)
    {
            $this->db->trans_rollback();
    }
    else
    {
            $this->db->trans_commit();
            $this->session->set_flashdata('message', 'Sukses delete.');
            $this->session->set_flashdata('jenis', 'danger');
            redirect(site_url('Spb'));
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
                      ms_barang.nama as nama_barang,
                      detail_spb.qty
                      FROM
                      detail_spb
                      INNER JOIN judul_spb ON judul_spb.no_bukti = detail_spb.no_bukti
                      INNER JOIN ms_barang ON detail_spb.kd_barang = ms_barang.id_barang
                      WHERE
                      detail_spb.no_bukti = '$no_bukti'";

	  $data['data_spb'] = $this->Bis_model->manualQuery($query_data);
      $data['detail_spb'] = $this->Bis_model->manualQuery($q_detail);

      $data['users'] = $this->Hak_Akses_m->get_user();
      $data['menu'] = $this->Menu_m->get_menu($id);
      $data['submenu'] = $this->Menu_m->get_submenu($id);
      $this->load->view('report/Cetakspp',$data);
    }

  function exportexcel()
  {

    $this->load->model('idh/IDH_m');
    $data['idh'] = $this->IDH_m->get_data_hauling();
    $this->load->view('Karyawan_export',$data);
  }

  function baru(){
    $id = get_cookie('eklinik');
    //print_r($this->session->userdata());
    //$nama_usaha= $this->session->userdata('alias_perusahaan1');
    $id_log_dept=$this->session->userdata('id_departement'.$id);
    $id_log_div=$this->session->userdata('id_divisi'.$id);
    $id_log_jab=$this->session->userdata('id_jabatan'.$id);


    $this->load->model('Menu_m');
    $this->load->model('Hak_Akses_m');
    $this->load->model('Login_m');
    $data['jabatan'] = $this->Login_m->get_jabatan();
    $data['users'] = $this->Hak_Akses_m->get_user();
    $data['menu'] = $this->Menu_m->get_menu($id);
    $data['submenu'] = $this->Menu_m->get_submenu($id);

    $query_budget="SELECT
                  set_budget.id_budget,
                  CONCAT(ms_divisi.nama,' : ',ms_departement.nama,' - ',ms_beban.nama) as nama,
                  set_budget.tahun,
                  set_budget.nominal,
                  set_budget.entry_user,
                  set_budget.entry_date,
                  set_budget.edit_user,
                  set_budget.edit_date,
                  ms_beban.id_beban,
                  ms_beban.nama as nama_beban,
                  ms_departement.id_departement,
                  ms_departement.nama as nama_departement,
                  ms_divisi.id_divisi,
                  ms_divisi.nama as nama_divisi,
                  ms_plant.id_plant,
                  ms_plant.nama as nama_plant
                  FROM
                  set_budget
                  INNER JOIN ms_beban ON set_budget.id_beban = ms_beban.id_beban
                  INNER JOIN ms_departement ON set_budget.id_departement = ms_departement.id_departement
                  INNER JOIN ms_divisi ON ms_departement.id_divisi = ms_divisi.id_divisi
                  INNER JOIN ms_plant ON ms_divisi.id_plant = ms_plant.id_plant
                  WHERE
                  ms_departement.id_departement = $id_log_dept
                  ORDER BY
                  nama_divisi asc,nama_departement asc, nama_beban ASC";
                  $query_budget_all="SELECT
                                set_budget.id_budget,
                                CONCAT(ms_divisi.nama,' : ',ms_departement.nama,' - ',ms_beban.nama) as nama,
                                set_budget.tahun,
                                set_budget.nominal,
                                set_budget.entry_user,
                                set_budget.entry_date,
                                set_budget.edit_user,
                                set_budget.edit_date,
                                ms_beban.id_beban,
                                ms_beban.nama as nama_beban,
                                ms_departement.id_departement,
                                ms_departement.nama as nama_departement,
                                ms_divisi.id_divisi,
                                ms_divisi.nama as nama_divisi,
                                ms_plant.id_plant,
                                ms_plant.nama as nama_plant
                                FROM
                                set_budget
                                INNER JOIN ms_beban ON set_budget.id_beban = ms_beban.id_beban
                                INNER JOIN ms_departement ON set_budget.id_departement = ms_departement.id_departement
                                INNER JOIN ms_divisi ON ms_departement.id_divisi = ms_divisi.id_divisi
                                INNER JOIN ms_plant ON ms_divisi.id_plant = ms_plant.id_plant
                                ORDER BY
                                  nama_divisi asc,nama_departement asc, nama_beban ASC";
    if ($id_log_jab<6){
                  $data['data_budget'] = $this->Bis_model->manualQuery($query_budget_all);
                        //print_r($query_budget_all);
                        //print_r("<br>");
                        //print_r($id_log_jab);
                  }

    else{
                  $data['data_budget'] = $this->Bis_model->manualQuery($query_budget);
                        //print_r($query_budget);
                        //print_r("<br>");
                        //print_r($id_log_jab);
                  }


      $query_data_per_user="SELECT
                    trans_ppd.no_ppd,
                    trans_ppd.tgl_ppd,
                    trans_ppd.tgl_cair,
                    trans_ppd.id_budget,
                    CONCAT(ms_divisi.nama,' : ',ms_departement.nama,' - ',ms_beban.nama) AS nama,
                    trans_ppd.kd_supplier,
                    trans_ppd.status_ppd,
                    trans_ppd.approved_ppd_1,
                    trans_ppd.user_approved_1,
                    trans_ppd.approved_date_1,
                    trans_ppd.approved_ppd_2,
                    trans_ppd.user_approved_2,
                    trans_ppd.approved_date_2,
                    trans_ppd.modul_asal as jenis,
                    trans_ppd.nominal,
                    trans_ppd.nominal1,
                    trans_ppd.nominal2,
                    trans_ppd.penerima,
                    trans_ppd.keterangan,
                    trans_ppd.entry_user,
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
                    ms_pegawai.nama as nama_pegawai
                    FROM
                    trans_ppd
                    INNER JOIN set_budget ON trans_ppd.id_budget = set_budget.id_budget
                    INNER JOIN ms_departement ON set_budget.id_departement = ms_departement.id_departement
                    INNER JOIN ms_divisi ON ms_departement.id_divisi = ms_divisi.id_divisi
                    INNER JOIN ms_plant ON ms_divisi.id_plant = ms_plant.id_plant
                    INNER JOIN ms_beban ON set_budget.id_beban = ms_beban.id_beban
                    INNER JOIN `user` ON trans_ppd.entry_user = `user`.id_user
                    INNER JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
                    WHERE YEAR(trans_ppd.tgl_ppd)=YEAR(NOW()) AND trans_ppd.status_ppd = 1 AND trans_ppd.approved_ppd_1 is NULL and trans_ppd.entry_user=$id
                    ORDER BY trans_ppd.tgl_ppd ASC";
                  $query_data="SELECT
                                trans_ppd.no_ppd,
                                trans_ppd.tgl_ppd,
                                trans_ppd.tgl_cair,
                                trans_ppd.id_budget,
                                CONCAT(ms_divisi.nama,' : ',ms_departement.nama,' - ',ms_beban.nama) AS nama,
                                trans_ppd.kd_supplier,
                                trans_ppd.status_ppd,
                                trans_ppd.approved_ppd_1,
                                trans_ppd.user_approved_1,
                                trans_ppd.approved_date_1,
                                trans_ppd.approved_ppd_2,
                                trans_ppd.user_approved_2,
                                trans_ppd.approved_date_2,
                                trans_ppd.modul_asal as jenis,
                                trans_ppd.nominal,
                                trans_ppd.nominal1,
                                trans_ppd.nominal2,
                                trans_ppd.penerima,
                                trans_ppd.keterangan,
                                trans_ppd.entry_user,
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
                                ms_pegawai.nama as nama_pegawai
                                FROM
                                trans_ppd
                                INNER JOIN set_budget ON trans_ppd.id_budget = set_budget.id_budget
                                INNER JOIN ms_departement ON set_budget.id_departement = ms_departement.id_departement
                                INNER JOIN ms_divisi ON ms_departement.id_divisi = ms_divisi.id_divisi
                                INNER JOIN ms_plant ON ms_divisi.id_plant = ms_plant.id_plant
                                INNER JOIN ms_beban ON set_budget.id_beban = ms_beban.id_beban
                                INNER JOIN `user` ON trans_ppd.entry_user = `user`.id_user
                                INNER JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
                                WHERE YEAR(trans_ppd.tgl_ppd)=YEAR(NOW()) AND trans_ppd.status_ppd = 1 AND trans_ppd.approved_ppd_1 is NULL
                                ORDER BY trans_ppd.tgl_ppd ASC";
    if ($id_log_jab<6)
    {
          $data['data_ppd'] = $this->Bis_model->manualQuery($query_data);
          //echo $query_data.' '.$id_log_jab;
          //echo $id_log_jab."-".$id;
    }

    else
    {
          $data['data_ppd'] = $this->Bis_model->manualQuery($query_data_per_user);
          //echo $query_data_per_user.' '.$id_log_jab;
          //echo $id_log_jab."-".$id;
    }

    $this->load->view('Spb2_v',$data);
  }
}
?>
