<?php


class Model_app extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    //  ================= AUTOMATIC CODE ==================

    //    KODE PENJUALAN
    public function getKodePenjualan()
    {
        $q = $this->db->query("select MAX(RIGHT(kd_penjualan,3)) as kd_max from tbl_penjualan_header");
        $kd = "";
        if($q->num_rows()>0)
        {
            foreach($q->result() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }
        else
        {
            $kd = "001";
        }
        return "O-".$kd;
    }

    //    KODE BARANG
    function getKodeBarang(){
        $q = $this->db->query("select MAX(RIGHT(kd_barang,3)) as kd_max from tbl_barang");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        return "B-".$kd;
    }
    //    KODE budget
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
    public function getKodePelanggan(){
        $q = $this->db->query("select MAX(RIGHT(kd_pelanggan,3)) as kd_max from tbl_pelanggan");
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
    public function getKodePegawai(){
        $q = $this->db->query("select MAX(RIGHT(kd_pegawai,3)) as kd_max from tbl_pegawai");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        return "K-".$kd;
    }

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
    function getAllDataFieldBonus($id_pegawai){
        return $this->db->query("SELECT
        judul_fb.no_fb,
        judul_fb.tgl_perjadin,
        detail_fb.nilai_bonus,
        detail_fb.id_pegawai,
        ms_pegawai.nama
        FROM
        judul_fb
        INNER JOIN detail_fb ON judul_fb.no_fb = detail_fb.no_fb
        INNER JOIN ms_pegawai ON detail_fb.id_pegawai = ms_pegawai.id_pegawai
        WHERE ms_pegawai.id_pegawai='$id_pegawai'")->result();
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

    function getLapFieldBonus($id_pegawai,$tgl_awal,$tgl_akhir){
        return $this->db->query("SELECT
                judul_fb.no_fb,
                judul_fb.tgl_perjadin,
                detail_fb.nilai_bonus,
                detail_fb.id_pegawai,
                UPPER(ms_pegawai.nama) as nama
                FROM
                judul_fb
                INNER JOIN detail_fb ON judul_fb.no_fb = detail_fb.no_fb
                INNER JOIN ms_pegawai ON detail_fb.id_pegawai = ms_pegawai.id_pegawai
                where judul_fb.user_approved_1 IS NOT NULL
                AND judul_fb.user_approved_2 IS NOT NULL
                AND judul_fb.status_fb = 2 AND detail_fb.id_pegawai='$id_pegawai' AND (judul_fb.tgl_perjadin between '$tgl_awal' and '$tgl_akhir')")->result();
    }
    function getLapFieldBonusUser($id_pegawai){
        return $this->db->query("SELECT
                judul_fb.no_fb,
                judul_fb.tgl_perjadin,
                detail_fb.nilai_bonus,
                detail_fb.id_pegawai,
                UPPER(ms_pegawai.nama) as nama
                FROM
                judul_fb
                INNER JOIN detail_fb ON judul_fb.no_fb = detail_fb.no_fb
                INNER JOIN ms_pegawai ON detail_fb.id_pegawai = ms_pegawai.id_pegawai
                where judul_fb.user_approved_1 IS NOT NULL
                AND judul_fb.user_approved_2 IS NOT NULL
                AND judul_fb.status_fb = 2 AND detail_fb.id_pegawai='$id_pegawai' ")->result();
    }

    function getAllDataPerjadinUser($id_pegawai){
        return $this->db->query("SELECT
                                  trans_pjd.no_pjd,
                                  trans_pjd.tgl_pengajuan,
                                  trans_pjd.tgl_perjadin,
                                  trans_pjd.tgl_finish_perjadin,
                                  trans_pjd.nominal AS nominal_lama,
                                  upper(trans_pjd.keterangan) AS keterangan,
                                  ms_pegawai.nama AS nama,
                                  IFNULL(ms_perjadin.mkn_pagi,0)*IFNULL(ms_perjadin.x_mkn_pagi,0) +
                                  IFNULL(ms_perjadin.mkn_siang,0)*IFNULL(ms_perjadin.x_mkn_siang,0) +
                                  IFNULL(ms_perjadin.mkn_malam,0)*IFNULL(ms_perjadin.x_mkn_malam,0) +
                                  IFNULL(ms_perjadin.konsumsi,0)*IFNULL(ms_perjadin.x_konsumsi,0) +
                                  IFNULL(ms_perjadin.lain_lain_1,0)*IFNULL(ms_perjadin.x_lain_lain_1,0) +
                                  IFNULL(ms_perjadin.lain_lain_2,0)*IFNULL(ms_perjadin.x_lain_lain_2,0) +
                                  IFNULL(ms_perjadin.lain_lain_3,0)*IFNULL(ms_perjadin.x_lain_lain_3,0) +
                                  IFNULL(ms_perjadin.hotel,0)* IFNULL(ms_perjadin.x_hotel,0) AS nominal,
                                  detail_pjd.id_pegawai,
                                  aa.nama AS nama_pegawai
                                  FROM
                                  trans_pjd
                                  INNER JOIN user ON trans_pjd.entry_user = user.id_user
                                  INNER JOIN ms_pegawai ON user.id_pegawai = ms_pegawai.id_pegawai
                                  INNER JOIN ms_perjadin ON trans_pjd.id_perjadin = ms_perjadin.id_perjadin
                                  INNER JOIN detail_pjd ON trans_pjd.no_pjd = detail_pjd.no_pjd
                                  INNER JOIN ms_pegawai AS aa ON detail_pjd.id_pegawai = aa.id_pegawai
                                  WHERE
                                  aa.id_pegawai='$id_pegawai'
                                  ")->result();
    }

    function getAllDataPerjadinNo($no_pjd){
        return $this->db->query("SELECT
                      trans_pjd.no_pjd,
                      trans_pjd.tgl_pengajuan,
                      trans_pjd.tgl_perjadin,
                      trans_pjd.nominal as nomional_lama,
                      trans_pjd.keterangan,
                      ms_pegawai.nama,
                      ms_beban.nama AS nama_beban,
                      ms_departement.nama AS nama_departement,
                      ms_divisi.nama AS nama_divisi,
                      ms_pegawai.foto,
                      ms_perjadin.id_customer_1,
                      ms_perjadin.id_customer_2,
                      ms_perjadin.id_customer_3,
                      ms_perjadin.id_customer_4,
                      ms_perjadin.id_customer_5,
                      c1.nama AS nc1,
                      c2.nama AS nc2,
                      c3.nama AS nc3,
                      c4.nama AS nc4,
                      c5.nama AS nc5,
                      trans_pjd.id_budget,
                      trans_pjd.id_perjadin,
                      ms_perjadin.nama_perjadin,
                      ms_perjadin.lokasi_1,
                      ms_perjadin.item_1,
                      ms_perjadin.lokasi_2,
                      ms_perjadin.item_2,
                      ms_perjadin.lokasi_3,
                      ms_perjadin.item_3,
                      ms_perjadin.lokasi_4,
                      ms_perjadin.item_4,
                      ms_perjadin.lokasi_5,
                      ms_perjadin.item_5,
                      ms_perjadin.jml_orang,
                      ms_perjadin.jml_hari,
                      ms_perjadin.mkn_pagi,
                      ms_perjadin.x_mkn_pagi,
                      ms_perjadin.mkn_siang,
                      ms_perjadin.x_mkn_siang,
                      ms_perjadin.mkn_malam,
                      ms_perjadin.x_mkn_malam,
                      ms_perjadin.konsumsi,
                      ms_perjadin.x_konsumsi,
                      ms_perjadin.lain_lain_1,
                      ms_perjadin.x_lain_lain_1,
                      ms_perjadin.ket_lain_1,
                      ms_perjadin.lain_lain_2,
                      ms_perjadin.x_lain_lain_2,
                      ms_perjadin.ket_lain_2,
                      ms_perjadin.lain_lain_3,
                      ms_perjadin.x_lain_lain_3,
                      ms_perjadin.ket_lain_3,
                      ms_perjadin.hotel,
                      ms_perjadin.x_hotel,

                      IFNULL(ms_perjadin.mkn_pagi,0)*IFNULL(ms_perjadin.x_mkn_pagi,0) +
                      IFNULL(ms_perjadin.mkn_siang,0)*IFNULL(ms_perjadin.x_mkn_siang,0) +
                      IFNULL(ms_perjadin.mkn_malam,0)*IFNULL(ms_perjadin.x_mkn_malam,0) +
                      IFNULL(ms_perjadin.konsumsi,0)*IFNULL(ms_perjadin.x_konsumsi,0) +
                      IFNULL(ms_perjadin.lain_lain_1,0)*IFNULL(ms_perjadin.x_lain_lain_1,0) +
                      IFNULL(ms_perjadin.lain_lain_2,0)*IFNULL(ms_perjadin.x_lain_lain_2,0) +
                      IFNULL(ms_perjadin.lain_lain_3,0)*IFNULL(ms_perjadin.x_lain_lain_3,0) +
                      IFNULL(ms_perjadin.hotel,0)* IFNULL(ms_perjadin.x_hotel,0) AS nominal

                      FROM
                      trans_pjd
                      INNER JOIN `user` ON trans_pjd.entry_user = `user`.id_user
                      INNER JOIN ms_pegawai ON `user`.id_pegawai = ms_pegawai.id_pegawai
                      INNER JOIN set_budget ON trans_pjd.id_budget = set_budget.id_budget
                      INNER JOIN ms_beban ON set_budget.id_beban = ms_beban.id_beban
                      INNER JOIN ms_departement ON set_budget.id_departement = ms_departement.id_departement
                      INNER JOIN ms_divisi ON ms_departement.id_divisi = ms_divisi.id_divisi
                      INNER JOIN ms_perjadin ON trans_pjd.id_perjadin = ms_perjadin.id_perjadin
                      LEFT JOIN ms_customer AS c1 ON ms_perjadin.id_customer_1 = c1.id_customer
                      LEFT JOIN ms_customer AS c2 ON ms_perjadin.id_customer_2 = c2.id_customer
                      LEFT JOIN ms_customer AS c3 ON ms_perjadin.id_customer_3 = c3.id_customer
                      LEFT JOIN ms_customer AS c4 ON ms_perjadin.id_customer_4 = c4.id_customer
                      LEFT JOIN ms_customer AS c5 ON ms_perjadin.id_customer_5 = c5.id_customer
                      WHERE set_budget.tahun=YEAR(now()) AND trans_pjd.no_pjd = '$no_pjd'")->result();
    }

    function getDetailTeamPerjadin($noppd){
    return $this->db->query("SELECT
                  ms_pegawai.id_pegawai,
                  upper(ms_pegawai.nama) as nama,
                  detail_pjd.posisi,
                  detail_pjd.no_pjd
                  FROM
                  detail_pjd
                  INNER JOIN ms_pegawai ON detail_pjd.id_pegawai = ms_pegawai.id_pegawai
                  WHERE
                  detail_pjd.no_pjd = '$noppd'
                  order by detail_pjd.posisi DESC")->result();
    }
    function getDataPegawaiLogin($id_pegawai){
        return $this->db->query("SELECT
                                mastersubunit.nama_sub_unit,
                                masterunit.nama_unit,
                                armaster.npa,
                                armaster.nik,
                                armaster.nama,
                                armaster.password,
                                armaster.alamat,
                                armaster.tempat_lahir,
                                armaster.tgl_lahir,
                                armaster.telpon_1,
                                armaster.telpon_2,
                                armaster.email,
                                armaster.npwp,
                                armaster.ktp,
                                armaster.jenis_anggota,
                                armaster.jenis_kelamin,
                                armaster.status,
                                armaster.kd_sub_unit,
                                armaster.kd_gudang,
                                armaster.kd_bagian,
                                armaster.kd_kelompok,
                                armaster.no_urut,
                                armaster.kd_kota,
                                armaster.potong_gaji,
                                armaster.tgl_trans,
                                armaster.kd_bank,
                                armaster.no_rekening,
                                armaster.tgl_mutasi,
                                armaster.status_anggota,
                                armaster.tgl_keluar,
                                armaster.default_simpanan_sukarela,
                                armaster.nama_gambar,
                                armaster.lokasi,
                                armaster.user_entry,
                                armaster.date_entry,
                                armaster.user_edit,
                                armaster.date_edit,
                                armaster.no_bagian,
                                armaster.alamat_s,
                                armaster.role,
                                armaster.no_atm,
                                armaster.keterangan
                                FROM
                                armaster
                                INNER JOIN mastersubunit ON armaster.kd_sub_unit = mastersubunit.kd_sub_unit
                                INNER JOIN masterunit ON mastersubunit.kd_unit = masterunit.kd_unit
                                WHERE
                                armaster.npa = '$id_pegawai'")->result();
    }
    function login($username,$password){
      //$pass=md5($password);

      $query_login="SELECT
                                  u.id_user,
                                  u.username,
                                  u.email,
                                  u.`password`,
                                  u.id_pegawai,
                                  u.foto,
                                  ms_pegawai.nama,
                                  mastersubunit.kd_sub_unit,
                                  mastersubunit.nama_sub_unit,
                                  ms_jenis.nama AS nama_jenis,
                                  ms_jabatan.nama AS nama_jabatan,
                                  ms_jenis.id_jenis,
                                  ms_jabatan.id_jabatan,
                                  masterunit.nama_unit,
                                  ms_perusahaan.nama AS nama_perusahaan,
                                  ms_perusahaan.alias AS alias_perusahaan,
                                  ms_perusahaan.alamat AS alamat_perusahaan,
                                  ms_perusahaan.kota AS kota_perusahaan,
                                  ms_perusahaan.telepon AS telepon_perusahaan,
                                  ms_perusahaan.email AS email_perusahaan,
                                  ms_perusahaan.fax AS fax_perusahaan,
                                  ms_perusahaan.siup AS siup_perusahaan,
                                  ms_perusahaan.npwp AS npwp_perusahaan,
                                  ms_perusahaan.diskripsi AS diskripsi_perusahaan,
                                  ms_perusahaan.id_perusahaan,
                                  IFNULL(tbl_galeri.gambar,'user.png') AS foto_pic,
                                  masterunit.kd_unit,
                                  ms_pegawai.tgl_masuk
                                  FROM
                                  `user` AS u
                                  INNER JOIN ms_pegawai ON u.id_pegawai = ms_pegawai.id_pegawai
                                  LEFT JOIN mastersubunit ON ms_pegawai.id_subunit = mastersubunit.kd_sub_unit
                                  INNER JOIN ms_jenis ON ms_pegawai.id_jenis = ms_jenis.id_jenis
                                  INNER JOIN ms_jabatan ON ms_pegawai.id_jabatan = ms_jabatan.id_jabatan
                                  INNER JOIN masterunit ON mastersubunit.kd_unit = masterunit.kd_unit
                                  INNER JOIN ms_perusahaan ON masterunit.id_perusahaan = ms_perusahaan.id_perusahaan
                                  LEFT JOIN tbl_galeri ON u.id_user = tbl_galeri.judul
                                WHERE
                                u.email = '$username' AND u.password = '$password'";
      return $this->db->query($query_login)->result();
      echo $query_login;
    }

    function login_lama($username,$password){
      $pass=md5($password);
      return $this->db->query("SELECT
      mastersubunit.nama_sub_unit,
      masterunit.nama_unit,
      armaster.npa,
      armaster.nik,
      armaster.nama,
      armaster.password,
      armaster.alamat
      FROM
      armaster
      INNER JOIN mastersubunit ON armaster.kd_sub_unit = mastersubunit.kd_sub_unit
      INNER JOIN masterunit ON mastersubunit.kd_unit = masterunit.kd_unit
      WHERE
      armaster.npa = '$username' AND
      armaster.password = '$pass' LIMIT 1")->result();
    }
    function login2($username, $password) {
        //create query to connect user login database
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $username);
        $this->db->where('password', $password);
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
