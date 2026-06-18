<?php
class Chat_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Fungsi untuk menyimpan pesan baru
    // Fungsi untuk menyimpan pesan baru (ditambah dukungan gambar)
    public function kirimPesan($pengirim, $penerima, $pesan, $gambar) {
        // Kita tambahkan kolom gambar di dalam query INSERT ini
        $this->db->query("INSERT INTO tb_chat (pengirim_id, penerima_id, pesan, gambar) 
                          VALUES (:pengirim, :penerima, :pesan, :gambar)");
        
        $this->db->bind('pengirim', $pengirim);
        $this->db->bind('penerima', $penerima);
        $this->db->bind('pesan', $pesan);
        $this->db->bind('gambar', $gambar); // Mengikat nama file gambar ke database
        
        $this->db->execute();
        return $this->db->rowCount();
    }
    // Fungsi untuk mengambil riwayat obrolan antara 2 orang
    public function getRiwayatChat($id_saya, $id_lawan) {
        // Ambil pesan di mana (saya pengirim DAN dia penerima) ATAU (dia pengirim DAN saya penerima)
        $this->db->query("SELECT * FROM tb_chat 
                          WHERE (pengirim_id = :id_saya AND penerima_id = :id_lawan) 
                             OR (pengirim_id = :id_lawan AND penerima_id = :id_saya) 
                          ORDER BY waktu ASC");
        $this->db->bind('id_saya', $id_saya);
        $this->db->bind('id_lawan', $id_lawan);
        return $this->db->all();
    }
    
    // Fungsi sederhana untuk mengambil nama lawan bicara
    public function getNamaLawan($id_lawan) {
        $this->db->query("SELECT nama FROM tb_user WHERE id_user = :id");
        $this->db->bind('id', $id_lawan);
        $hasil = $this->db->single();
        return $hasil['nama'];
    }

   // Mengambil daftar chat masuk yang aktif dalam 24 jam terakhir beserta jumlah pesan unread
    // Mengambil daftar chat masuk tanpa batasan waktu 24 jam
    public function getInboxDriver($id_driver) {
        $this->db->query("
            SELECT 
                u.id_user, 
                u.nama, 
                u.no_hp,
                MAX(c.waktu) as waktu_terbaru,
                (SELECT COUNT(*) FROM tb_chat WHERE pengirim_id = u.id_user AND penerima_id = :id_driver AND is_read = 0) as unread_count
            FROM tb_chat c
            JOIN tb_user u ON c.pengirim_id = u.id_user
            WHERE c.penerima_id = :id_driver
            GROUP BY u.id_user, u.nama, u.no_hp
            ORDER BY waktu_terbaru DESC
        ");
        $this->db->bind('id_driver', $id_driver);
        return $this->db->all();
    }   

    // Fungsi mengubah status pesan menjadi sudah dibaca (is_read = 1)
    public function tandaiSudahBaca($id_saya, $id_lawan) {
        $this->db->query("UPDATE tb_chat SET is_read = 1 WHERE pengirim_id = :id_lawan AND penerima_id = :id_saya");
        $this->db->bind('id_saya', $id_saya);
        $this->db->bind('id_lawan', $id_lawan);
        $this->db->execute();
    }

    // Fungsi untuk menghapus seluruh riwayat chat driver saat logout
    public function hapusRiwayatChatDriver($id_driver) {
        // Menghapus semua pesan di mana driver ini adalah penerima atau pengirim
        $this->db->query("DELETE FROM tb_chat WHERE pengirim_id = :id_driver OR penerima_id = :id_driver");
        $this->db->bind('id_driver', $id_driver);
        $this->db->execute();
        
        return $this->db->rowCount();
    }
}