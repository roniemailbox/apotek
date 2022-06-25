<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$id = get_cookie('eklinik');
if(empty($this->session->userdata('id_user'.$id))
OR empty($this->session->userdata('email'.$id))
OR empty($this->session->userdata('password'.$id)))
{
  redirect(site_url('Login'));
}
else
{
  $user = array
    (
        'id_user' => $this->session->userdata('id_user'.$id),
        'email' => $this->session->userdata('email'.$id),
        'password' => $this->session->userdata('password'.$id),
    );
  $usr = $this->db->get_where('user',$user)->num_rows();
  if($usr < 1)
  {
   redirect(site_url('Login'));
  }
  $link = explode('/',$_SERVER['REQUEST_URI']);
  $query_x="SELECT
            	*
            FROM
            	hak_akses AS h
            	INNER JOIN daftar_menu AS d ON h.id_daftar_menu = d.id_daftar_menu
            WHERE
            	h.id_user = '$id'
            	AND d.link = '$link[3]'";
  $hasil = $this->db->query($query_x)->num_rows();
  //echo $hasil;
  if($hasil <= 0 AND $link[3] != 'Error')
  {
    redirect(site_url('Error'));
  }
  $data = $this->db->query($query_x)->result();
  $hak_c = 0; $hak_r = 0; $hak_u = 0; $hak_d = 0; $hak_p = 0;
  foreach ($data as $dt)
  {
    $hak_c = $dt->c;
    $hak_r = $dt->r;
    $hak_u = $dt->u;
    $hak_d = $dt->d;
    $hak_p = $dt->p;
  }
}
?>
