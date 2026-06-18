<?php
class Auth_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // 1. Fungsi Login (HANYA BUTUH 1 FUNGSI SAJA SEKARANG!)
    public function cekLogin($no_hp, $password) {
        // Cukup cari di tabel induk (tb_user)
        $this->db->query("SELECT * FROM tb_user WHERE no_hp = :no_hp AND password = :password");
        $this->db->bind('no_hp', $no_hp);
        $this->db->bind('password', $password);
        return $this->db->single();
    }

    // 2. Fungsi Daftar User/Mahasiswa
    public function tambahUser($data) {
        $this->db->query("INSERT INTO tb_user (nama, no_hp, password, role) VALUES (:nama, :no_hp, :password, 'user')");
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('no_hp', $data['no_hp']);
        $this->db->bind('password', $data['password']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    // 3. Fungsi Daftar Driver (INI CONTOH INHERITANCE DI PHP)
   public function tambahDriver($data, $nama_foto) {
        // A. Masukkan data dasarnya ke tabel Induk (tb_user)
        $this->db->query("INSERT INTO tb_user (nama, no_hp, password, role) VALUES (:nama, :no_hp, :password, 'driver')");
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('no_hp', $data['no_hp']);
        $this->db->bind('password', $data['password']);
        $this->db->execute();

        // B. CARA ANTI-GAGAL: Cari ID user yang baru mendaftar pakai nomor HP-nya
        $this->db->query("SELECT id_user FROM tb_user WHERE no_hp = :no_hp");
        $this->db->bind('no_hp', $data['no_hp']);
        $user_baru = $this->db->single();
        $id_baru = $user_baru['id_user']; // ID yang pasti valid 100%

        // C. Masukkan data tambahannya ke tabel Anak (tb_driver)
       // Ganti query Bagian C milikmu dengan ini:
$this->db->query("INSERT INTO tb_driver (id_user, foto_profil, jenis_motor, plat_nomor, status) VALUES (:id_user, :foto_profil, :jenis_motor, :plat_nomor, 'Off')");
        $this->db->bind('id_user', $id_baru);
        $this->db->bind('foto_profil', $nama_foto);
        $this->db->bind('jenis_motor', $data['jenis_motor']);
        $this->db->bind('plat_nomor', $data['plat_nomor']);
        $this->db->execute();

        return $this->db->rowCount();
    }
}