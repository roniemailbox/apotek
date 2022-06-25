<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Spbpart extends CI_Controller
{
  function __construct(){
      parent::__construct();
       $this->load->model('umum/Bis_model');
       $this->load->model('umum/Bis_model_ant');
       $this->load->helper('currency_format_helper');
       $this->load->helper('format_romawi_helper');
    }
  function index()
  {
    $id = get_cookie('eklinik');
    $this->load->model('Menu_m');
    $this->load->model('Hak_Akses_m');
    $this->load->model('Login_m');
    $data['data_jabatan'] = $this->Bis_model->getAllData('ms_jabatan');
    //$data['data_unit'] = $this->Bis_model->getAllData('ms_unit');
    $data['data_shif'] = $this->Bis_model->getAllData('ms_shif');
    $data['data_status_aktif'] = $this->Bis_model->getAllData('ms_status_aktif');
    $query_pit="SELECT * from ms_pit_port where jenis='pit'";
    //$data['data_pit'] = $this->Bis_model->manualQuery($query_pit);
    //$query_port="SELECT * from ms_pit_port where jenis='port'";
    //$data['data_port'] = $this->Bis_model->manualQuery($query_port);
    //$data['plant']=$this->Model_select_idh->plant();
   $query_plant="SELECT * from ms_plant";
   $data['data_plant'] = $this->Bis_model->manualQuery($query_plant);
    //$data['data_driver'] = $this->Bis_model->getAllData('ms_plant');
    $query_data="SELECT
judul_spb.no_bukti,
judul_spb.tgl_trans,
judul_spb.keterangan,
judul_spb.status_spb,
p2.nama AS user_entry,
judul_spb.id_plant,
judul_spb.jenis,
ms_plant.nama AS nama_plant,
Sum(detail_spb.qty) as qty
FROM
judul_spb
LEFT JOIN `user` ON judul_spb.entry_user = `user`.id_user
LEFT JOIN ms_pegawai AS p2 ON `user`.id_pegawai = p2.id_pegawai
LEFT JOIN ms_plant ON judul_spb.id_plant = ms_plant.id_plant
INNER JOIN detail_spb ON detail_spb.no_bukti = judul_spb.no_bukti
WHERE
judul_spb.jenis = 'FUEL'
GROUP BY
judul_spb.no_bukti,
judul_spb.tgl_trans,
judul_spb.keterangan,
judul_spb.status_spb,
p2.nama,
judul_spb.id_plant,
judul_spb.jenis,
ms_plant.nama
ORDER BY
judul_spb.tgl_trans ASC

";
                //$query_driver="SELECT * from ms_pegawai where id_jabatan=40";
    $data['data_spb'] = $this->Bis_model->manualQuery($query_data);
  //  $data['data_driver'] = $this->Bis_model->manualQuery($query_driver);
    $data['jabatan'] = $this->Login_m->get_jabatan();
    $data['users'] = $this->Hak_Akses_m->get_user();
    $data['menu'] = $this->Menu_m->get_menu($id);
    $data['submenu'] = $this->Menu_m->get_submenu($id);
    $this->load->view('Spbsolar_view',$data);
  }

  function baru(){
    $id = get_cookie('eklinik');
    $this->load->model('Menu_m');
    $this->load->model('Hak_Akses_m');
    $this->load->model('Login_m');
	  $query_plant="SELECT * from ms_plant";
    $data['data_plant'] = $this->Bis_model->manualQuery($query_plant);


    $data['menu'] = $this->Menu_m->get_menu($id);
    $data['submenu'] = $this->Menu_m->get_submenu($id);
    $data['combo_plant']=$this->Bis_model_ant->get_combo_plant();
    $data['combo_bank']=$this->Bis_model_ant->get_combo_bank();

    $this->load->view('Spbsolar_baru',$data);
  }


  function make_idh_trans(){
      $id['no_bukti']=$this->input->post('no_bukti');
      $id_plant=$this->input->post('id_plant');
      $q_data_unit="SELECT
                    ms_unit.id_unit,
                    ms_unit.keterangan,
                    ms_plant.nama as nama_plant,
                    ms_plant.id_plant
                    FROM
                    ms_unit
                    INNER JOIN ms_plant ON ms_unit.id_plant = ms_plant.id_plant
                    WHERE
                    ms_plant.id_plant = $id_plant
                    order by ms_plant.nama asc, ms_unit.id_unit ASC";
      $q_data_driver="SELECT
                  ms_plant.nama AS nama_plant,
                  ms_plant.id_plant,
                  ms_pegawai.id_pegawai,
                  ms_pegawai.nama AS nama_pegawai
                  FROM
                  ms_plant
                  INNER JOIN ms_pegawai ON ms_pegawai.id_plant = ms_plant.id_plant
                  WHERE
                  ms_plant.id_plant = $id_plant AND
                  ms_pegawai.id_jenis = '03'
                  ORDER BY
                  nama_plant ASC, nama_pegawai asc";

      $q_data_pit="SELECT
                  ms_plant.nama AS nama_plant,
                  ms_plant.id_plant,
                  ms_pit_port.id_pit_port as id_pit,
                  ms_pit_port.nama as nama_pit,
                  ms_pit_port.jenis,
                  ms_pit_port.keterangan
                  FROM
                  ms_plant
                  INNER JOIN ms_pit_port ON ms_pit_port.id_plant = ms_plant.id_plant
                  WHERE
                  ms_plant.id_plant = $id_plant and jenis='pit'
                  ORDER BY
                  nama_plant ASC";

      $q_data_port="SELECT
                  ms_plant.nama AS nama_plant,
                  ms_plant.id_plant,
                  ms_pit_port.id_pit_port as id_port,
                  ms_pit_port.nama as nama_port,
                  ms_pit_port.jenis,
                  ms_pit_port.keterangan
                  FROM
                  ms_plant
                  INNER JOIN ms_pit_port ON ms_pit_port.id_plant = ms_plant.id_plant
                  WHERE
                  ms_plant.id_plant = $id_plant and jenis='port'
                  ORDER BY
                  nama_plant ASC
                  ";
      $q_data_shif="SELECT
                  ms_shif.id_shif,
                  ms_shif.nama
                  FROM
                  ms_shif   ";
                                      // $data=array('detail_po_rent'=>$this->Bis_model->getSelectedData('trans_po_rental',$id)->result(),);
      $data=array(
          'detail_unit_plant'=>$this->Bis_model->getDataX($q_data_unit),
          'detail_driver_plant'=>$this->Bis_model->getDataX($q_data_driver),
          'detail_pit_plant'=>$this->Bis_model->getDataX($q_data_pit),
          'detail_port_plant'=>$this->Bis_model->getDataX($q_data_port),
          'data_shif'=>$this->Bis_model->getDataX($q_data_shif),
        );
      $this->load->view('ajax_idh_trans',$data);
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




  function create()
  {

    $id = get_cookie('eklinik');
    $this->load->model('idh/IDH_m');
    $this->load->model('Menu_m');
    $data['menu'] = $this->Menu_m->get_menu($id);
    $data['submenu'] = $this->Menu_m->get_submenu($id);
    $data['idh'] = $this->IDH_m->get_data_hauling();

    $hasil = $this->IDH_m->get_max_kode();
    foreach ($hasil as $dt)
    {
      $kode = $dt->no_bukti;
    }
    $noUrut = (int) substr($kode,2);
    $noUrut++;
    $char = "RT";
    $data['no_bukti'] = $char . sprintf("%04s", $noUrut);
    $this->load->view('IDH_v',$data);
  	}


    function tambah()
    {
      $now = date('Y-m-d H:i:s');
      $date = new DateTime($this->input->post('tgl_produksi'));
      $id_plant = $this->input->post('id_plant');
      $year = $date -> format('Y');
      $month = $date -> format('m');
      $day = $date -> format('d');
      $month=format_romawi($month);
      $kode_bukti=$id_plant.'-BBM/'.$month.'/'.$year;
      $cookie_id_user = get_cookie('eklinik');
      //$kodejenis =  $this->input->post('id_status_pegawai');
      //$no_krit="EMP-";
      $no_bukti= $this->Bis_model->getIdSPS($kode_bukti);
      $data=array(
        'no_bukti'=>$no_bukti,
        'tgl_trans'=>$this->input->post('tgl_trans'),
        'jenis'=>'FUEL',
        'id_plant'=>$this->input->post('id_plant'),
        'keterangan'=>$this->input->post('keterangan'),
        'status_spb'=>1,
        'status_approve'=>0,
        'entry_user'=>$cookie_id_user,
        'entry_date'=>$now,
      );
      $this->db->trans_off();
      $this->db->trans_begin();
      $this->db->trans_strict(true);
      $this->Bis_model->insertData('judul_spb',$data);

      $inserted_count = 0;
  		//insert gl

  		foreach ($this->input->post('rowsBM') as $key => $count )
      {
          //echo ($no_bukti);
          //echo ($this->input->post('qty_'.$count));

          //echo ($this->input->post('kode_barang_'.$count));
          //echo ("<br>");
          $data=array(
            'no_bukti'=>$no_bukti,
            'kd_barang'=>$this->input->post('kode_barang_'.$count),
            'qty'=>$this->input->post('qty_'.$count),
          );
          $this->Bis_model->insertData('detail_spb',$data);
      }
      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE)
      {
              $this->db->trans_rollback();
              $this->session->set_flashdata('message', 'Gagal input data produksi.');
              $this->session->set_flashdata('jenis', 'danger');
              redirect(site_url('Spbsolar'));
      }
      else
      {
              $this->db->trans_commit();
              $this->session->set_flashdata('message', 'Sukses tambah data baru.');
              $this->session->set_flashdata('jenis', 'success');
              redirect(site_url('Spbsolar'));
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
        $id['no_bukti'] = $this->input->post('no_bukti');
        $no_bukti= $this->input->post('no_bukti');
        $data=array(
          'tgl_trans'=>$this->input->post('tgl_trans'),
          'jenis'=>'FUEL',
          'id_plant'=>$this->input->post('id_plant'),
          'keterangan'=>$this->input->post('keterangan'),
          'status_spb'=>1,
          'status_approve'=>0,
          'edit_user'=>$cookie_id_user,
          'edit_date'=>$now,
        );
        $this->db->trans_off();
        $this->db->trans_begin();
        $this->db->trans_strict(true);
        $this->Bis_model->updateData('judul_spb',$data,$id);
        $this->Bis_model->deleteData('detail_spb',$id);
        //$inserted_count = 0;
    		//insert gl

    		foreach ($this->input->post('rowsBM') as $key => $count )
        {
             //echo ($no_bukti);
             echo ($this->input->post('qty_'.$count));

             echo ($this->input->post('kode_barang_'.$count));
              echo ("<br>");
             $data=array(
              'no_bukti'=>$no_bukti,
              'kd_barang'=>$this->input->post('kode_barang_'.$count),
              'qty'=>$this->input->post('qty_'.$count),
             );
             $this->Bis_model->insertData('detail_spb',$data);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                $this->session->set_flashdata('message', 'Gagal input data produksi.');
                $this->session->set_flashdata('jenis', 'danger');
                redirect(site_url('Spbsolar'));
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 'Sukses tambah data baru.');
                $this->session->set_flashdata('jenis', 'success');
                redirect(site_url('Spbsolar'));
        }
        }

      function edit()
      {
          $xno_bukti = str_replace('_', '/', $this->uri->segment(3));
          $id['no_bukti'] = $xno_bukti;

          $no_bukti= $xno_bukti;
          $id = get_cookie('eklinik');
          $this->load->model('Menu_m');
          $this->load->model('Hak_Akses_m');
          $this->load->model('Login_m');
          $data['data_jabatan'] = $this->Bis_model->getAllData('ms_jabatan');
          $query_plant="SELECT * from ms_plant";
          $data['data_plant'] = $this->Bis_model->manualQuery($query_plant);
          $query_data=" SELECT
                  judul_spb.no_bukti,
                  judul_spb.tgl_trans,
                  ms_plant.nama AS nama_plant,
                  judul_spb.keterangan,
                  judul_spb.status_spb,
                  p2.nama AS user_entry,
                  ms_plant.id_plant
                  FROM
                  judul_spb
                  LEFT JOIN ms_unit ON judul_spb.id_unit = ms_unit.id_unit
                  LEFT JOIN `user` ON judul_spb.entry_user = `user`.id_user
                  LEFT JOIN ms_pegawai AS p2 ON `user`.id_pegawai = p2.id_pegawai
                  INNER JOIN ms_plant ON judul_spb.id_plant = ms_plant.id_plant
                  WHERE
                  judul_spb.no_bukti = '$no_bukti'
                  ORDER BY
                  judul_spb.tgl_trans ASC


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
          $data['data_detail_spb'] = $this->Bis_model->manualQuery($q_detail);

        //  $data['data_driver'] = $this->Bis_model->manualQuery($query_driver);
          $data['jabatan'] = $this->Login_m->get_jabatan();
          $data['users'] = $this->Hak_Akses_m->get_user();
          $data['menu'] = $this->Menu_m->get_menu($id);
          $data['submenu'] = $this->Menu_m->get_submenu($id);
          $this->load->view('Spbsolar_edit',$data);
        }
  function hapus()
  {
    $xno_bukti = str_replace('_', '/', $this->uri->segment(3));
    $id['no_bukti'] = $xno_bukti;

    //$id['no_bukti'] = $this->uri->segment(3);
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
            redirect(site_url('Spbsolar'));
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
}
?>
