<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hak_Akses_m extends CI_model
{
    function get_user()
    {
        /* return $this->db->query('select u.id_user, u.email, u.password, u.nama, j.nama as nama_jabatan, u.foto
                                 from user u, jabatan j where u.id_jabatan = j.id_jabatan')->result(); */
        $Query_id="SELECT
            u.id_user,
            u.email,
            u.`password`,
            ms_pegawai.nama,
            u.foto,
            ms_jabatan.nama as nama_jabatan
            FROM
            `user` AS u
            INNER JOIN ms_pegawai ON u.id_pegawai = ms_pegawai.id_pegawai
            INNER JOIN ms_jabatan ON ms_pegawai.id_jabatan = ms_jabatan.id_jabatan";

            return $this->db->query($Query_id)->result();
    }
    function get_user_id($id)
    {
        /* return $this->db->query('select u.id_user, u.email, u.password, u.nama, j.nama as nama_jabatan, u.foto
                                 from user u, jabatan j where u.id_jabatan = j.id_jabatan and u.id_user = "'.$id.'"')->result(); */
          $Query_id="SELECT
              u.id_user,
              u.email,
              u.`password`,
              ms_pegawai.nama,
              u.foto,
              ms_jabatan.nama as nama_jabatan
              FROM
              `user` AS u
              INNER JOIN ms_pegawai ON u.id_pegawai = ms_pegawai.id_pegawai
              INNER JOIN ms_jabatan ON ms_pegawai.id_jabatan = ms_jabatan.id_jabatan
              WHERE u.id_user = '$id'";
        return $this->db->query($Query_id)->result();
    }
    function insert_hak($id_user,$c,$r,$u,$d,$p,$id_daftar_menu)
    {
      $data = array
      (
        'id_hak_akses' => NULL,
        'id_user' => $id_user,
        'c' => $c,
        'r' => $r,
        'u' => $u,
        'd' => $d,
        'p' => $p,
        'id_daftar_menu' => $id_daftar_menu,
      );
      return $this->db->insert('hak_akses',$data);
    }
    function hapus_hak_akses($id)
    {
      return $this->db->query('delete FROM hak_akses WHERE id_user = "'.$id.'"');
    }
}
