<?php
class Admin_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Mengambil semua data user biasa
    public function getAllUser() {
        $this->db->query("SELECT * FROM tb_user WHERE role = 'user' ORDER BY id_user DESC");
        return $this->db->all(); // Menggunakan all()
    }

    // Mengambil semua data driver beserta info motornya (Join Parent-Child)
    public function getAllDriver() {
        $this->db->query("SELECT tb_user.*, tb_driver.jenis_motor, tb_driver.plat_nomor, tb_driver.status, tb_driver.foto_profil 
                          FROM tb_user 
                          JOIN tb_driver ON tb_user.id_user = tb_driver.id_user 
                          WHERE tb_user.role = 'driver' ORDER BY tb_user.id_user DESC");
        return $this->db->all(); // Menggunakan all()
    }

    // Menghapus akun (Otomatis menghapus data di tabel anak karena ON DELETE CASCADE)
    public function hapusAkun($id) {
        $this->db->query("DELETE FROM tb_user WHERE id_user = :id");
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
    
    // Fungsi untuk menyimpan pesan dari Home
    public function tambahKritikSaran($data) {
        $query = "INSERT INTO kritik_saran (nama, pesan) VALUES (:nama, :pesan)";
        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('pesan', $data['pesan']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    // Fungsi untuk mengambil semua pesan untuk ditampilkan di Admin
    public function getAllKritikSaran() {
        $this->db->query('SELECT * FROM kritik_saran ORDER BY id_pesan DESC');
        return $this->db->all(); // <--- SUDAH DIGANTI MENJADI all()
    }
}