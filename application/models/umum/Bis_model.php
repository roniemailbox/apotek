<?php
class Bis_model extends CI_Model{

  function getIdJasa($kode_unit){
    $query = $this->db->query("SELECT MAX(id_jasa) as max_id FROM ms_jasa where id_jasa like '".$kode_unit."%'");
      $row = $query->row_array();
      $max_id = $row['max_id'];
      $max_id1 =(int) substr($max_id,1,4);
      $id_unit = $max_id1 +1;
      $maxUnit = $kode_unit.sprintf("%04s",$id_unit);
      //echo $maxkode_ppd;
      return $maxUnit;

  }
function getIdPOS($kode){
      $query = $this->db->query("SELECT MAX(no_bukti) as max_id FROM judul_si where no_bukti like '".$kode."%'");
      $row = $query->row_array();
      $max_id = $row['max_id'];
      $max_id1 =(int) substr($max_id,11,4);
      $nobukti = $max_id1 +1;
      $no_idh = $kode.sprintf("%04s",$nobukti);
      //echo $maxkode_ppd;
      return $no_idh;}

    function getIdRck($kode){
      $query = $this->db->query("SELECT MAX(no_bukti) as max_id FROM judul_racikan where no_bukti like '".$kode."%'");
      $row = $query->row_array();
      $max_id = $row['max_id'];
      $max_id1 =(int) substr($max_id,11,4);
      $nobukti = $max_id1 +1;
      $no_idh = $kode.sprintf("%04s",$nobukti);
      //echo $maxkode_ppd;
      return $no_idh;

    }
    public function get_kode_ppd($kodetgl_ppd) {
        //$query_data="SELECT MAX(no_ppd) as max_id FROM trans_ppd where no_ppd like '".$kodetgl_ppd."%'";
        //echo $query_data;
        $query = $this->db->query("SELECT MAX(no_ppd) as max_id FROM trans_ppd where no_ppd like '".$kodetgl_ppd."%'");
        $row = $query->row_array();
        $max_id = $row['max_id'];
        $max_id1 =(int) substr($max_id,7,5);
        $kode_ppd = $max_id1 +1;
        $maxkode_ppd = $kodetgl_ppd.sprintf("%05s",$kode_ppd);
        //echo $maxkode_ppd;
        return $maxkode_ppd;
    }

    function getIdWO($kode_unit){
        $query = $this->db->query("SELECT MAX(no_wo) as max_id FROM trans_wo where no_wo like '".$kode_unit."%'");
        $row = $query->row_array();
        $max_id = $row['max_id'];
        $max_id1 =(int) substr($max_id,7,4);
        $id_model = $max_id1 +1;
        $maxUnit = $kode_unit.sprintf("%04s",$id_model);
        //echo $maxkode_ppd;
        return $maxUnit;

    }
    public function get_kode_pjd($kodetgl_ppd) {
        //$query_data="SELECT MAX(no_ppd) as max_id FROM trans_ppd where no_ppd like '".$kodetgl_ppd."%'";
        //echo $query_data;
        $query = $this->db->query("SELECT MAX(no_pjd) as max_id FROM trans_pjd where no_pjd like '".$kodetgl_ppd."%'");
        $row = $query->row_array();
        $max_id = $row['max_id'];
        $max_id1 =(int) substr($max_id,7,5);
        $kode_ppd = $max_id1 +1;
        $maxkode_ppd = $kodetgl_ppd.sprintf("%05s",$kode_ppd);
        //echo $maxkode_ppd;
        return $maxkode_ppd;
    }

    public function get_kode_fb($kodetgl_ppd) {
        //$query_data="SELECT MAX(no_ppd) as max_id FROM trans_ppd where no_ppd like '".$kodetgl_ppd."%'";
        //echo $query_data;
        $query = $this->db->query("SELECT MAX(no_fb) as max_id FROM judul_fb where no_fb like '".$kodetgl_ppd."%'");
        $row = $query->row_array();
        $max_id = $row['max_id'];
        $max_id1 =(int) substr($max_id,7,5);
        $kode_ppd = $max_id1 +1;
        $maxkode_ppd = $kodetgl_ppd.sprintf("%05s",$kode_ppd);
        //echo $maxkode_ppd;
        return $maxkode_ppd;
    }


    function getIdSPP($kode){
        $query = $this->db->query("SELECT MAX(no_spp) as max_id FROM trans_spp where no_spp like '".$kode."%'");
        $row = $query->row_array();
        $max_id = $row['max_id'];
        $max_id1 =(int) substr($max_id,9,5);
        $nobukti = $max_id1 +1;
        $no_idh = $kode.sprintf("%05s",$nobukti);
        //echo $maxkode_ppd;
        return $no_idh;

    }
    public function get_kode_kb($kodetgl_kb) {
        //$query_data="SELECT MAX(no_ppd) as max_id FROM trans_ppd where no_ppd like '".$kodetgl_ppd."%'";
        //echo $query_data;
        $query = $this->db->query("SELECT MAX(no_bukti) as max_id FROM trans_kb where no_bukti like '".$kodetgl_kb."%'");
        $row = $query->row_array();
        $max_id = $row['max_id'];
        $max_id1 =(int) substr($max_id,7,5);
        $kode_kb = $max_id1 +1;
        $maxkode_kb = $kodetgl_kb.sprintf("%05s",$kode_kb);
        //echo $maxkode_ppd;
        return $maxkode_kb;
    }
    function getIdSi($kode){
      $query = $this->db->query("SELECT MAX(no_bukti) as max_id FROM judul_si where no_bukti like '".$kode."%'");
      $row = $query->row_array();
      $max_id = $row['max_id'];
      $max_id1 =(int) substr($max_id,9,5);
      $nobukti = $max_id1 +1;
      $no_idh = $kode.sprintf("%05s",$nobukti);
      //echo $maxkode_ppd;
      return $no_idh;

    }
    function getIdRo($kode){
      $query = $this->db->query("SELECT MAX(no_bukti) as max_id FROM judul_ro where no_bukti like '".$kode."%'");
      $row = $query->row_array();
      $max_id = $row['max_id'];
      $max_id1 =(int) substr($max_id,7,5);
      $nobukti = $max_id1 +1;
      $no_idh = $kode.sprintf("%05s",$nobukti);
      //echo $maxkode_ppd;
      return $no_idh;

    }

    function getIdPo($kode){
        $query = $this->db->query("SELECT MAX(no_bukti) as max_id FROM judul_po where no_bukti like '".$kode."%'");
        $row = $query->row_array();
        $max_id = $row['max_id'];
        $max_id1 =(int) substr($max_id,10,4);
        $nobukti = $max_id1 +1;
        $no_idh = $kode.sprintf("%04s",$nobukti);
        //echo $maxkode_ppd;
        return $no_idh;

    }
    function getIdBPB($kode){
      $query = $this->db->query("SELECT MAX(no_bukti) as max_id FROM judul_bpb where no_bukti like '".$kode."%'");
      $row = $query->row_array();
      $max_id = $row['max_id'];
      $max_id1 =(int) substr($max_id,9,5);
      $nobukti = $max_id1 +1;
      $no_idh = $kode.sprintf("%05s",$nobukti);
      //echo $maxkode_ppd;
      return $no_idh;

    }

    function getIdAr($kode){
        //$query = $this->db->query("SELECT MAX(no_bukti) as max_id FROM ar_trans where no_bukti like '%".$kode."'  ");
        $query = $this->db->query("SELECT MAX(no_bukti) as max_id FROM ar_trans");
        $row = $query->row_array();
        $max_id = $row['max_id'];
        $max_id1 =(int) substr($max_id,0,4);
        $nobukti = $max_id1 +1;
        $no_ar = sprintf("%04s",$nobukti).$kode;
        //echo $maxkode_ppd;
        return $no_ar;

    }
    function getIdAp($kode){
        //$query = $this->db->query("SELECT MAX(no_bukti) as max_id FROM ar_trans where no_bukti like '%".$kode."'  ");
        $query = $this->db->query("SELECT MAX(no_bukti) as max_id FROM ap_trans");
        $row = $query->row_array();
        $max_id = $row['max_id'];
        $max_id1 =(int) substr($max_id,0,4);
        $nobukti = $max_id1 +1;
        $no_ap = sprintf("%04s",$nobukti).$kode;
        //echo $maxkode_ppd;
        return $no_ap;

    }
    function getIdKwitansi($kode){
         $query = $this->db->query("SELECT MAX(no_kwitansi) as max_id FROM kwitansi where no_kwitansi like '%".$kode."'  ");
         $row = $query->row_array();
         $max_id = $row['max_id'];
         $max_id1 =(int) substr($max_id,0,4);
         $nobukti = $max_id1 +1;
         $no_kwi = sprintf("%04s",$nobukti).$kode;
         //echo $maxkode_ppd;
         return $no_kwi;

     }
	 function getIdKwitansix($kode){
        $query = $this->db->query("SELECT MAX(no_kwitansi) as max_id FROM kwitansi where no_kwitansi like '%".$kode."'  ");
        $row = $query->row_array();
        $max_id = $row['max_id'];
        $max_id1 =(int) substr($max_id,0,4);
        $nobukti = $max_id1 +1;
        $no_kwi = sprintf("%04s",$nobukti).$kode;
        //echo $maxkode_ppd;
        return $no_kwi;

    }
	function getIdTagihan($kode){
		$qq="SELECT right(no_tagihan,1) as max_id FROM ar_trans_tagihan where no_tagihan like '".$kode."%' ORDER BY max_id desc limit 1";
        $query = $this->db->query($qq);
        $row = $query->row_array();
        $max_id = $row['max_id'];
        //$max_id1 =(int) substr($max_id,0,1);
        $nobukti = $max_id +1;
        $no_kwi =$nobukti;
        //echo $maxkode_ppd;
        return $no_kwi;

    }
    function getIdTagihanx($kode){
  		$qq="SELECT right(no_tagihan,1) as max_id FROM ar_trans_tagihan where no_tagihan like '".$kode."%%' ORDER BY max_id desc limit 1";
          $query = $this->db->query($qq);
          $row = $query->row_array();
          $max_id = $row['max_id'];
          //$max_id1 =(int) substr($max_id,0,1);
          $nobukti = $max_id +1;
          $no_kwi =$kode."-".$nobukti;
          //echo $maxkode_ppd;
          return $no_kwi;

      }
	public function get_kode_bs($kodetgl_bs) {
        //$query_data="SELECT MAX(no_ppd) as max_id FROM trans_ppd where no_ppd like '".$kodetgl_ppd."%'";
        //echo $query_data;
        $query = $this->db->query("SELECT MAX(no_bukti) as max_id FROM trans_bs where no_bukti like '".$kodetgl_bs."%'");
        $row = $query->row_array();
        $max_id = $row['max_id'];
        $max_id1 =(int) substr($max_id,6,5);
        $kode_bs = $max_id1 +1;
        $maxkode_bs = $kodetgl_bs.sprintf("%05s",$kode_bs);
        return $maxkode_bs;
    }


    function getIdPlant(){
        $q = $this->db->query("select MAX(id_plant) as id_max from ms_plant");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_max)+1;
                $kd =  $tmp;
            }
        }
        else
        {
            $kd = "1";
        }
        return "".$kd;
    }
    function getIdDepartement(){
        $q = $this->db->query("select MAX(id_departement) as id_max from ms_departement");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_max)+1;
                $kd =  $tmp;
            }
        }else{
            $kd = "1";
        }
        return "".$kd;
    }

    function getIdPegawai($kode_pegawai){
        /*
                $q = $this->db->query("select MAX(id_pegawai) as id_max from ms_pegawai");
                $kd = "";
                if($q->num_rows()>0){
                    foreach($q->result() as $k){
                        $tmp = ((int)$k->id_max)+1;
                        $kd =  $tmp;
                    }
                }else{
                    $kd = "1";
                }
                return "".$kd;
        */
        $query = $this->db->query("SELECT MAX(id_pegawai) as max_id FROM ms_pegawai where id_pegawai like '".$kode_pegawai."%'");
        $row = $query->row_array();
        $max_id = $row['max_id'];
        $max_id1 =(int) substr($max_id,4,3);
        $id_pegawai = $max_id1 +1;
        $maxkode_pegawai = $kode_pegawai.sprintf("%03s",$id_pegawai);
        //echo $maxkode_ppd;
        return $maxkode_pegawai;

    }

    function getIdSupplier($kode_pegawai){

        $query = $this->db->query("SELECT MAX(id_supplier) as max_id FROM ms_supplier where id_supplier like '".$kode_pegawai."%'");
        $row = $query->row_array();
        $max_id = $row['max_id'];
        $max_id1 =(int) substr($max_id,4,4);
        $id_supplier = $max_id1 +1;
        $maxkode_pegawai = $kode_pegawai.sprintf("%04s",$id_supplier);
        //echo $maxkode_ppd;
        return $maxkode_pegawai;

    }

    function getIdPerjadin($kode_pegawai){
        /*
                $q = $this->db->query("select MAX(id_pegawai) as id_max from ms_pegawai");
                $kd = "";
                if($q->num_rows()>0){
                    foreach($q->result() as $k){
                        $tmp = ((int)$k->id_max)+1;
                        $kd =  $tmp;
                    }
                }else{
                    $kd = "1";
                }
                return "".$kd;
        */
        $query = $this->db->query("SELECT MAX(id_perjadin) as max_id FROM ms_perjadin where id_perjadin like '".$kode_pegawai."%'");
        $row = $query->row_array();
        $max_id = $row['max_id'];
        $max_id1 =(int) substr($max_id,8,8);
        $id_perjadin = $max_id1 +1;
        $maxkode_pegawai = $kode_pegawai.sprintf("%08s",$id_perjadin);
        //echo $maxkode_ppd;
        return $maxkode_pegawai;

    }

    function getIdJabatan(){
        $q = $this->db->query("select MAX(id_jabatan) as id_max from ms_jabatan");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_max)+1;
                $kd =  $tmp;
            }
        }else{
            $kd = "1";
        }
        return "".$kd;
    }

    function getIdDivisi(){
        $q = $this->db->query("select MAX(id_divisi) as id_max from ms_divisi");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_max)+1;
                $kd =  $tmp;
            }
        }else{
            $kd = "1";
        }
        return "".$kd;
    }

    //    KODE PENJUALAN
    public function getKodeModel()
    {
        $q = $this->db->query("select MAX(RIGHT(id_model,3)) as id_model from ms_model");
        $kd = "";
        if($q->num_rows()>0)
        {
            foreach($q->result() as $k)
            {
                $tmp = ((int)$k->id_model)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }
        else
        {
            $kd = "001";
        }
        return "M-".$kd;
    }

    //    KODE BARANG
    function getIDBarang($kdx){
        $q = $this->db->query("select MAX(RIGHT(id_barang,6)) as kd_max from ms_barang where id_barang like '$kdx%'");
        //$q = $this->db->query("select MAX(RIGHT(id_barang,6)) as kd_max from ms_barang");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%06s", $tmp);
            }
        }else{
            $kd = "000001";
        }
        return $kdx.$kd;
    }
    function getIDBarangPO(){
        $q = $this->db->query("select MAX(RIGHT(id_barang,6)) as kd_max from ms_barang where id_barang like 'B-ENVI%'");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%06s", $tmp);
            }
        }else{
            $kd = "000001";
        }
        return "B-ENVI".$kd;
    }

    function getIdCustomer($kode_customer){
        $query = $this->db->query("SELECT MAX(id_customer) as max_id FROM ms_customer where id_customer like '".$kode_customer."%'");
        $row = $query->row_array();
        $max_id = $row['max_id'];
        $max_id1 =(int) substr($max_id,3,3);
        $id_cust = $max_id1 +1;
        $maxkode_customer = $kode_customer.sprintf("%03s",$id_cust);
        //echo $maxkode_ppd;
        return $maxkode_customer;

    }
     function getIdBudget(){
         $q = $this->db->query("select MAX(RIGHT(id_budget,4)) as kd_max from set_budget");
         $kd = "";
         if($q->num_rows()>0){
             foreach($q->result() as $k){
                 $tmp = ((int)$k->kd_max)+1;
                 $kd = sprintf("%04s", $tmp);
             }
         }else{
             $kd = "0001";
         }
         return "B-".$kd;
     }

    //    KODE PELANGGAN
    public function getKodePegawai(){
        $q = $this->db->query("select MAX(RIGHT(id_pegawai,3)) as kd_max from tbl_pelanggan");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        return "P-".$kd;
    }

    //    KODE PEGAWAI

    public function getTambahStok($kd_barang,$tambah)
    {
        $q = $this->db->query("select stok from tbl_barang where kd_barang='".$kd_barang."'");
        $stok = "";
        foreach($q->result() as $d)
        {
            $stok = $d->stok + $tambah;
        }
        return $stok;
    }
    public function getKurangStok($kd_barang,$kurangi)
    {
        $q = $this->db->query("select stok from tbl_barang where kd_barang='".$kd_barang."'");
        $stok = "";
        foreach($q->result() as $d)
        {
            $stok = $d->stok - $kurangi;
        }
        return $stok;
    }
    public function getKembalikanStok($kd_barang)
    {
        $q = $this->db->query("select stok from tbl_barang where kd_barang='".$kd_barang."'");
        $stok = "";
        foreach($q->result() as $d)
        {
            $stok = $d->stok;
        }
        return $stok;
    }

// UMUM MODELS
    public function getAllData($table)
    {
        return $this->db->get($table)->result();
    }

    public function getSelectedData($table,$data)
    {
        return $this->db->get_where($table, $data);
    }

    function updateData($table,$data,$field_key)
    {
        $this->db->update($table,$data,$field_key);
    }

    function deleteData($table,$data)
    {
        $this->db->delete($table,$data);
    }

    function insertData($table,$data)
    {
        $this->db->insert($table,$data);
    }

    function manualQuery($q)
    {
        return $this->db->query($q)->result();
    }

    function getBarangJual(){
        return $this->db->query ("SELECT * from tbl_barang where stok > 0")->result();
    }

    function getAllDataPenjualan(){
        return $this->db->query("SELECT
                a.kd_penjualan,
                a.tanggal_penjualan,
                a.total_harga,
			    (select count(kd_penjualan) as jum from tbl_penjualan_detail where kd_penjualan=a.kd_penjualan) as jumlah
			    from tbl_penjualan_header a
			    ORDER BY a.kd_penjualan DESC
		")->result();
    }

    function getDataPenjualan($id){
        return $this->db->query("SELECT * from tbl_penjualan_header a
                left join tbl_pelanggan b on a.kd_pelanggan=b.kd_pelanggan
                left join tbl_pegawai c on a.kd_pegawai=c.kd_pegawai
                where a.kd_penjualan = '$id'")->result();
    }

    function getBarangPenjualan($id){
        return $this->db->query("
                select a.kd_barang,a.qty,b.nm_barang,b.harga
                from tbl_penjualan_detail a
                left join tbl_barang b on a.kd_barang=b.kd_barang
                where a.kd_penjualan = '$id'")->result();
    }

    function getLapPenjualan($tgl_awal,$tgl_akhir){
        return $this->db->query("SELECT *,sum(a.total_harga) as total_all from tbl_penjualan_header a
                left join tbl_pelanggan b on a.kd_pelanggan=b.kd_pelanggan
                left join tbl_pegawai c on a.kd_pegawai=c.kd_pegawai
                where a.tanggal_penjualan between '$tgl_awal' and '$tgl_akhir'
                ")->result();
    }

    function login($username, $password) {
        //create query to connect user login database
        $this->db->select('*');
        $this->db->from('tbl_pegawai');
        $this->db->where('username', $username);
        $this->db->where('password', MD5($password));
        $this->db->limit(1);

        //get query and processing
        $query = $this->db->get();
        if($query->num_rows() == 1) {
            return $query->result(); //if data is true
        } else {
            return false; //if data is wrong
        }
    }

}
