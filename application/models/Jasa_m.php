<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jasa_m extends CI_model
{
     function get_jasa_in($no_wo,$tipe_wo)
    {
      return $this->db->query("SELECT
                              	ms_jasa.id_jasa,
                              	ms_jasa.nama,
                              	trans_jasa_wo.nilai,
                                0 as diskon
                              FROM
                              	trans_jasa_wo
                              INNER JOIN ms_jasa ON trans_jasa_wo.id_jasa = ms_jasa.id_jasa
                              WHERE
                              	trans_jasa_wo.no_wo = '$no_wo' ")->result();
    }
    function get_jasa_out($no_wo,$tipe_wo)
    {
      return $this->db->query("SELECT
                              	ms_jasa.id_jasa,
                              	ms_jasa.nama,
                              	ms_jasa.nilai,
                                0 as diskon
                              FROM
                              	ms_jasa
                              WHERE
                              ms_jasa.id_jasa NOT IN ((
                              		SELECT
                              			trans_jasa_wo.id_jasa
                              		FROM
                              			trans_jasa_wo
                              		WHERE
                              			trans_jasa_wo.no_wo = '$no_wo'
                              	)) ")->result();
    }
}
