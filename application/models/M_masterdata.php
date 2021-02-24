<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_masterdata extends CI_Model{

    function __construct() {
        parent::__construct();
    }

    /** load data user admin */
    function get_loaddataadmin(){
        $sql = "SELECT a.*, b.name_lvl_admin, b.description
                FROM users a
                LEFT JOIN tbl_level_admin b ON a.id_lvl_admin = b.id_lvl_admin
                ORDER BY a.id DESC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }


    function get_loadkonfirmasi(){
        $sql = "SELECT a.*,b.jenis_pembayaran, c.nama_pelatihan, d.nama, b.status_pembayaran, b.keterangan
                FROM tbl_konfirmasi_bayar a
                LEFT JOIN tbl_peserta_daftar b ON a.id_peserta_daftar = b.id_peserta_daftar
                LEFT JOIN tbl_pelatihan_master c ON b.id_m_pelatihan = c.id_m_pelatihan
                LEFT JOIN tbl_peserta_akun d ON d.id_akun_peserta = a.id_akun_peserta
                ORDER BY a.id_konfirmasi_bayar ASC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function get_loadvalidasi(){
        // $sql = "SELECT a.*,b.jenis_pembayaran, c.nama_pelatihan, d.nama, b.status_pembayaran, b.keterangan, b.status_validasi
        //         FROM tbl_konfirmasi_bayar a
        //         LEFT JOIN tbl_peserta_daftar b ON a.id_peserta_daftar = b.id_peserta_daftar
        //         LEFT JOIN tbl_pelatihan_master c ON b.id_m_pelatihan = c.id_m_pelatihan
        //         LEFT JOIN tbl_peserta_akun d ON d.id_akun_peserta = a.id_akun_peserta
        //         ORDER BY a.id_konfirmasi_bayar ASC";
        $sql = "SELECT b.*,c.nama_pelatihan, d.nama
                FROM tbl_peserta_daftar b
                LEFT JOIN tbl_pelatihan_master c ON b.id_m_pelatihan = c.id_m_pelatihan
                LEFT JOIN tbl_peserta_akun d ON b.id_akun_peserta = d.id_akun_peserta
                ORDER BY b.id_peserta_daftar DESC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function get_lengkapdaftar($id) {
		$sql = "SELECT a.*, b.*, c.nama, c.email, c.agama, c.tgl_lahir, c.tempat_lahir, c.file_foto, c.file_ktp, c.no_ktp, c.jenis_kelamin
				FROM tbl_peserta_daftar a
				LEFT JOIN tbl_pelatihan_master b ON a.id_m_pelatihan = b.id_m_pelatihan
				LEFT JOIN tbl_peserta_akun c ON a.id_akun_peserta = c.id_akun_peserta
				WHERE id_peserta_daftar = '$id'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

    /* === BUAT MENU PESERTA === */

    /* GET DATAFILE BY ID*/
    function getdatafile_id() {
        $id = $this->input->post('id');
        $sql = "SELECT a.*,b.jenis_pembayaran, c.nama_pelatihan, d.nama, b.status_pembayaran, b.keterangan
        FROM tbl_konfirmasi_bayar a
        LEFT JOIN tbl_peserta_daftar b ON a.id_peserta_daftar = b.id_peserta_daftar
        LEFT JOIN tbl_pelatihan_master c ON b.id_m_pelatihan = c.id_m_pelatihan
        LEFT JOIN tbl_peserta_akun d ON d.id_akun_peserta = a.id_akun_peserta
        WHERE a.id_konfirmasi_bayar = '$id'
        ORDER BY a.create_date DESC";

        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function update_sts_konfirmasi($id_konfirmasi_bayar, $data){

        $this->db->where('id_konfirmasi_bayar', $id_konfirmasi_bayar);
        $this->db->update('tbl_konfirmasi_bayar', $data);
    }
    public function update_sts_pendaftaran($id_peserta_daftar, $data){

        $this->db->where('id_peserta_daftar', $id_peserta_daftar);
        $this->db->update('tbl_peserta_daftar', $data);
    }

    public function get_data_ttp($id_konfirmasi_bayar){

        $sql = "SELECT c.nama, c.email, d.nama_pelatihan, d.kd_pelatihan, a.total_bayar, a.sts_pembayaran, a.tgl_transfer
        FROM tbl_konfirmasi_bayar a
        LEFT JOIN tbl_peserta_daftar b ON a.id_peserta_daftar = b.id_peserta_daftar
        LEFT JOIN tbl_peserta_akun c ON a.id_akun_peserta = c.id_akun_peserta
        LEFT JOIN tbl_pelatihan_master d ON b.id_m_pelatihan = d.id_m_pelatihan
        WHERE a.id_konfirmasi_bayar = '$id_konfirmasi_bayar'";

        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function getpelatihan_id(){
        $id_m_pelatihan = $this->input->post('id_m_pelatihan');
        $sql = "SELECT *
        FROM tbl_pelatihan_master
        WHERE id_m_pelatihan = '$id_m_pelatihan'";

        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    
    // ==================ANDRE=================================//

    public function get_loadtahunpelatihan() {
        $sql = "SELECT DISTINCT tahun
                FROM tbl_pelatihan_master
                ORDER BY tahun ASC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function get_loadpelatihan($tahunpelatihan) {
        $sql = "SELECT DISTINCT nama_pelatihan
		FROM tbl_pelatihan_master
        WHERE tahun = '$tahunpelatihan'
		ORDER BY id_m_pelatihan ASC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function get_loadkdpelatihan($namapelatihan) {
        $sql = "SELECT DISTINCT kd_angkatan
                FROM tbl_pelatihan_master
                WHERE nama_pelatihan = '$namapelatihan'
                ORDER BY id_m_pelatihan ASC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function get_loadpeserta($kdpelatihan) {
        $sql = "SELECT c.*, a.*, b.*
                FROM tbl_peserta_daftar a
                LEFT JOIN tbl_pelatihan_master b ON b.id_m_pelatihan = a.id_m_pelatihan
                LEFT JOIN tbl_peserta_akun c ON c.id_akun_peserta = a.id_akun_peserta
                WHERE b.kd_angkatan = '$kdpelatihan' AND a.sts_aktif_peserta = 1
                ORDER BY a.id_peserta_daftar ASC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function get_loadpesertabatal($kdpelatihan) {
        $sql = "SELECT c.*, a.*, b.*
                FROM tbl_peserta_daftar a
                LEFT JOIN tbl_pelatihan_master b ON b.id_m_pelatihan = a.id_m_pelatihan
                LEFT JOIN tbl_peserta_akun c ON c.id_akun_peserta = a.id_akun_peserta
                WHERE b.kd_angkatan = '$kdpelatihan' AND a.sts_aktif_peserta = 0
                ORDER BY a.id_peserta_daftar ASC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function getdatapeserta_id($id) {
		$sql = "SELECT a.*, b.*, c.nama
				FROM tbl_peserta_daftar a
				LEFT JOIN tbl_pelatihan_master b ON a.id_m_pelatihan = b.id_m_pelatihan
                LEFT JOIN tbl_peserta_akun c ON c.id_akun_peserta = a.id_akun_peserta
				WHERE id_peserta_daftar = '$id'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
    }
    
    public function getdatadocument_id($id) {
		$sql = "SELECT a.jenis_pembayaran, a.file_smp, a.file_gl, b.nama_pelatihan, c.nama
                FROM tbl_peserta_daftar a
                LEFT JOIN tbl_pelatihan_master b ON a.id_m_pelatihan = b.id_m_pelatihan
                LEFT JOIN tbl_peserta_akun c ON c.id_akun_peserta = a.id_akun_peserta
                WHERE id_peserta_daftar = '$id'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

    public function get_searchPeserta($kdpelatihan) {
        $sql = "SELECT c.*, a.*, b.*
                FROM tbl_peserta_daftar a
                LEFT JOIN tbl_pelatihan_master b ON b.id_m_pelatihan = a.id_m_pelatihan
                LEFT JOIN tbl_peserta_akun c ON c.id_akun_peserta = a.id_akun_peserta
                WHERE b.kd_pelatihan = '$kdpelatihan'
                ORDER BY a.id_peserta_daftar ASC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    /** Modul Prodi */

    public function get_loadnamapel(){
        $sql = "SELECT id_nama_pelatihan, kd_pelatihan, nama_pelatihan
        FROM tbl_pelatihan_nama
        ORDER BY id_nama_pelatihan DESC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function GetRow($keyword) {
        $sql = "SELECT a.id_peserta_daftar, b.nama, c.nama_pelatihan, c.kd_angkatan, c.investasi, a.jenis_pembayaran
        FROM tbl_peserta_daftar a
        LEFT JOIN tbl_peserta_akun b ON b.id_akun_peserta = a.id_akun_peserta
        LEFT JOIN tbl_pelatihan_master c ON c.id_m_pelatihan = a.id_m_pelatihan
        WHERE b.nama LIKE '%$keyword%'
        ORDER BY a.id_peserta_daftar DESC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    public function getTransaksiPeserta($idpeserta){
        $sql = "SELECT b.nama, c.nama_pelatihan, c.kd_angkatan, a.pembayaran1, a.pembayaran2, a.pembayaran3, c.investasi, a.status_pembayaran
        FROM tbl_peserta_daftar a
        LEFT JOIN tbl_peserta_akun b ON b.id_akun_peserta = a.id_akun_peserta
        LEFT JOIN tbl_pelatihan_master c ON c.id_m_pelatihan = a.id_m_pelatihan
        WHERE a.id_peserta_daftar = '$idpeserta'
        ORDER BY a.id_peserta_daftar DESC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function getStatusBayar(){
        $sql = "SELECT a.jenis_pembayaran
        FROM tbl_peserta_daftar a
        WHERE a.id_peserta_daftar = '$idpeserta'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function get_namapel($kdpelatihan){
        $sql = "SELECT *
        FROM tbl_pelatihan_nama
        WHERE kd_pelatihan = '$kdpelatihan'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function kdangkatan_exists($kdAngkatan)
    {
        $this->db->select('*');
			$this->db->from('tbl_pelatihan_master');
			$this->db->where('kd_angkatan', $kdAngkatan);
			$this->db->limit(1);

        $query = $this->db->get();
        
        if ($query->num_rows() == 1){
            $a =  "ada";
            return $a;
        }
        else{
            $a = "tidak ada";
            return $a;
        }
    }

    function ttp_exists($no_ttp)
    {
        $this->db->select('*');
			$this->db->from('tbl_konfirmasi_bayar');
			$this->db->where('no_ttp', $no_ttp);
			$this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1){
            $a =  "ada";
            return $a;
        }
        else{
            $a = "tidak ada";
            return $a;
        }
    }

    // Peserta
    public function getdatadaftar_id($id) {
		$sql = "SELECT a.*, b.*, c.*
				FROM tbl_peserta_daftar a
				LEFT JOIN tbl_pelatihan_master b ON a.id_m_pelatihan = b.id_m_pelatihan
                LEFT JOIN tbl_peserta_akun c ON c.id_akun_peserta = a.id_akun_peserta
				WHERE id_peserta_daftar = '$id'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
    }
    
    //Data Keuangan
    public function get_loadpeserta_keu($kdpelatihan) {
        $sql = "SELECT c.*, a.*, b.*
                FROM tbl_peserta_daftar a
                LEFT JOIN tbl_pelatihan_master b ON b.id_m_pelatihan = a.id_m_pelatihan
                LEFT JOIN tbl_peserta_akun c ON c.id_akun_peserta = a.id_akun_peserta
                WHERE b.kd_angkatan = '$kdpelatihan'
                ORDER BY a.id_peserta_daftar ASC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function get_payment_byid($id) {
        $sql = "SELECT a.* 
                FROM tbl_konfirmasi_bayar a
                LEFT JOIN tbl_peserta_daftar b ON b.id_peserta_daftar = a.id_peserta_daftar
                WHERE a.id_peserta_daftar = '$id'
                ORDER BY a.id_konfirmasi_bayar ASC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    /** Notification */
    public function get_countnotif() {
		$sql = "SELECT *
				FROM tbl_notif_admin
				WHERE status = 1";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
    }
    public function get_shortnotif() {
		$sql = "SELECT *
				FROM tbl_notif_admin
				ORDER BY id_notif_admin DESC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
    }
    public function get_pushnotif() {
		$sql = "UPDATE tbl_notif SET status=1 WHERE status=0 and id_akun_peserta='$id_akun_peserta'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
    }
    
    /** Reminder */
    public function data_reminder($datenow){
        $sql = "SELECT c.nama, b.nama_pelatihan, a.jenis_pembayaran, a.status_pembayaran, b.tgl_mulai, b.tgl_selesai
        FROM tbl_peserta_daftar a
        LEFT JOIN tbl_pelatihan_master b ON a.id_m_pelatihan = b.id_m_pelatihan
        LEFT JOIN tbl_peserta_akun c ON c.id_akun_peserta = a.id_akun_peserta
        WHERE a.status_pembayaran = 'Belum Lunas'
        ORDER BY tgl_mulai ASC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
    }

    public function data_reminderNow($datenow){
        $sql = "SELECT c.nama, b.nama_pelatihan, a.jenis_pembayaran, a.status_pembayaran, b.tgl_mulai, b.tgl_selesai, c.email, b.kd_pelatihan, b.kd_angkatan, b.investasi
        FROM tbl_peserta_daftar a
        LEFT JOIN tbl_pelatihan_master b ON a.id_m_pelatihan = b.id_m_pelatihan
        LEFT JOIN tbl_peserta_akun c ON c.id_akun_peserta = a.id_akun_peserta
        WHERE a.status_pembayaran = 'Belum Lunas' AND b.tgl_mulai >= '$datenow'
        ORDER BY b.tgl_mulai ASC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
    }

    public function data_reminder7Days($tgl_mulai){
        $sql = "SELECT c.nama, b.nama_pelatihan, a.jenis_pembayaran, a.status_pembayaran, b.tgl_mulai, b.tgl_selesai, c.email, b.kd_pelatihan, b.kd_angkatan, b.investasi
        FROM tbl_peserta_daftar a
        LEFT JOIN tbl_pelatihan_master b ON a.id_m_pelatihan = b.id_m_pelatihan
        LEFT JOIN tbl_peserta_akun c ON c.id_akun_peserta = a.id_akun_peserta
        WHERE a.status_pembayaran = 'Belum Lunas' AND b.tgl_mulai = '$tgl_mulai'
        ORDER BY b.tgl_mulai ASC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
    }

    public function data_reminderPiutang($datenow){
        $sql = "SELECT c.nama, b.nama_pelatihan, a.jenis_pembayaran, a.status_pembayaran, b.tgl_mulai, b.tgl_selesai, c.email, b.kd_pelatihan, b.kd_angkatan, b.investasi
        FROM tbl_peserta_daftar a
        LEFT JOIN tbl_pelatihan_master b ON a.id_m_pelatihan = b.id_m_pelatihan
        LEFT JOIN tbl_peserta_akun c ON c.id_akun_peserta = a.id_akun_peserta
        WHERE a.status_pembayaran = 'Belum Lunas' AND b.tgl_mulai <= '$datenow'
        ORDER BY b.tgl_mulai ASC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
    }

    public function get_dateReminder($datenow){
        $sql = "SELECT b.nama_pelatihan, b.tgl_mulai, b.tgl_selesai
        FROM tbl_peserta_daftar a
        LEFT JOIN tbl_pelatihan_master b ON a.id_m_pelatihan = b.id_m_pelatihan
        WHERE a.status_pembayaran = 'Belum Lunas' AND b.tgl_mulai >= '$datenow'
        ORDER BY b.tgl_mulai ASC
        LIMIT 1";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
    }

    public function get_loadhistoryPembayaran() {
        $sql = "SELECT a.*, b.nama
				FROM tbl_history_midtrans a
				LEFT JOIN tbl_peserta_akun b ON a.id_akun_peserta = b.id_akun_peserta
				ORDER BY a.transaction_time DESC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
  	}

}

?>