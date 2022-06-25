<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$id = get_cookie('eklinik');
if(empty($this->session->userdata('id_user'.$id))
OR empty($this->session->userdata('email'.$id))
OR empty($this->session->userdata('password'.$id)))
{
  redirect(site_url('login'));
}
else
{
  $user = array
    (
        'id_user' => $this->session->userdata('id_user'.$id),
        'email' => $this->session->userdata('email'.$id),
        'email' => $this->session->userdata('email'.$id),
        'password' => $this->session->userdata('password'.$id),
    );
  $usr = $this->db->get_where('user',$user)->num_rows();
  //echo $id;
  if($usr < 1)
  {
    redirect(site_url('login'));
  }
  $link = explode('/',$_SERVER['REQUEST_URI']);
  $qx='select * from hak_akses h, daftar_menu d where h.id_daftar_menu = d.id_daftar_menu
                             and h.id_user = '.$id.' and d.link like "'.$link[2].'"';
  //echo $qx;
  $hasil = $this->db->query('select * from hak_akses h, daftar_menu d where h.id_daftar_menu = d.id_daftar_menu
                             and h.id_user = '.$id.' and d.link like "'.$link[2].'"')->num_rows();
  if($hasil <= 0 AND $link[2] != 'Error')
  {
    redirect(site_url('Error'));
  }
  $data = $this->db->query('select * from hak_akses h, daftar_menu d where h.id_daftar_menu = d.id_daftar_menu
                            and h.id_user = '.$id.' and d.link like "'.$link[2].'"')->result();
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
