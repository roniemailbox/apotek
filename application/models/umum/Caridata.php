<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caridata extends CI_Model{

  function nextIDNo($nowYear, $Nunit, $Ndept, $Nitem){
   $nowMonthYear = date('my');
   $this->db->select_max("id_no");      // select max (id_no)
   $this->db->where("unit_loct", $Nunit);            // where unit_loct
   $this->db->where("dept_unit_loct", $Ndept);   // and dept_unit_loct
   $this->db->where("item_type", $Nitem);    // and item_type
   $this->db->where("DATE_FORMAT(datepublish, '%y') = ", $nowYear);  // and month to year
   $query = $this->db->get('id_item');

   if(!empty($query)){
    foreach ($query->result() as $value) {
     $kode = $value->id_no;                 // contoh : X01.Y02.Z03.MMYY.0001
                                        //no urut kode hanya diteruskan jika Nunit and Ndept and Nitem sudah pernah ada record sebelumnya
     $lastkode = substr($kode,17,4);    // urutan digit mulai ke 17 sepanjang 4 karakter
     $nextkode = $lastkode + 1;
     $tempnextno = $Nunit.".".$Ndept.".".$Nitem.".".$nowMonthYear.".";
     $nextnoreg = $tempnextno.sprintf('%04s',$nextkode);    // %04s untuk penyesuaian 4 digit no urut
    }
   }else{
                                // jika kondisi  Nunit and Ndept and Nitem tidak dipenuhi maka no urut reset dari 1
    $tempnextno = $Nunit.".".$Ndept.".".$Nitem.".".date('ym').".";
    $nextnoreg = $tempnextno.sprintf('%04s',$nextkode);
   }
   return $nextnoreg;
  }

}
