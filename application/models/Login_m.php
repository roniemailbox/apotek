<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_m extends CI_model
{
    function get_jabatan()
    {
        //return $this->db->query('select * from ms_jabatan')->result();
    }
    function register()
    {
      $data = array
        (
            'id_user' => NULL,
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            //'nama' => $this->input->post('nama'),
            //'id_jabatan' => $this->input->post('id_jabatan'),
            'user_entry' => $this->session->userdata('id_user'.$id_login),
            'foto' => NULL,
        );
      return $this->db->insert('user',$data);
    }
    function delete($id)
    {
      $this->db->query('delete FROM user WHERE id_user = "'.$id.'"');
      $this->db->query('delete FROM hak_akses WHERE id_user = "'.$id.'"');
    }
    function update($id)
    {
      return $this->db->query('update user SET password = "'.$this->input->post('password').'",
                               nama = "'.$this->input->post('nama').'" WHERE id_user = "'.$id.'"');
    }
    function get_user_edit($id)
    {
      return $this->db->query("SELECT
            u.id_user,
            u.email,
            u.`password`,
            u.id_jabatan FROM
            `user` AS u
            INNER JOIN ms_pegawai ON u.id_pegawai = ms_pegawai.id_pegawai
            WHERE
            u.id_user = '.$id.'")->result();
    }
}
