<?php 

class Umum_m extends CI_model
{
function get_karyawan()
    {
      return $this->db->query('select ms_karyawan.*,site.alamat_site as nama_site,jabatan.nama as nama_jabatan from ms_karyawan 
	  left join site on ms_karyawan.id_lokasi=site.id_site left join jabatan on ms_karyawan.id_jabatan=jabatan.id_jabatan order 
	  by ms_karyawan.id_karyawan')->result();
    }
    
    function get_karyawan_edit($id)
    {
      return $this->db->query('select * from ms_karyawan where id_karyawan = "'.$id.'" order by nama')->result();
    }
	
	function get_aset()
    {
        return $this->db->query('select * from jabatan order by id_jabatan')->result();
    }
	
	function get_aset_edit()
    {
        return $this->db->query('select * from jabatan order by id_jabatan')->result();
    }
	
	function get_lokasi_edit()
    {
        return $this->db->query('select * from jabatan order by id_jabatan')->result();
    }
}
	
	?>