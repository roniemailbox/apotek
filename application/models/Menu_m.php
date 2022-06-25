<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_m extends CI_model
{
    function get_menu($id)
    {
        return $this->db->query('select * from hak_akses h, daftar_menu d where h.id_user = "'.$id.'"
                                 and h.id_daftar_menu = d.id_daftar_menu group by menu')->result();
    }
    function get_submenu($id)
    {
        return $this->db->query("SELECT
                                  	*
                                  FROM
                                  	hak_akses AS h
                                  INNER JOIN daftar_menu AS d ON h.id_daftar_menu = d.id_daftar_menu
                                  WHERE
                                  h.id_user = '$id' AND
                                  d.status_aktif = 1
                                  ORDER BY
                                  	menu ASC,
                                  	submenu ASC")->result();
    }
    function get_menu_user_in($id)
    {
      return $this->db->query("SELECT
                                	*
                                FROM
                                	daftar_menu d,
                                	hak_akses h
                                WHERE
                                	d.id_daftar_menu = h.id_daftar_menu
                                AND h.id_user = '$id'
                                AND d.status_aktif = 1
                                ORDER BY
                                	menu ASC,
                                	submenu ASC")->result();
    }
    function get_menu_user_out($id)
    {
      return $this->db->query("SELECT
                                	*
                                FROM
                                	daftar_menu
                                WHERE
                                	NOT EXISTS (
                                		SELECT
                                			*
                                		FROM
                                			hak_akses
                                		WHERE
                                			hak_akses.id_daftar_menu = daftar_menu.id_daftar_menu
                                		AND id_user = '$id'
                                	)
                                AND daftar_menu.status_aktif = 1")->result();
    }
}
