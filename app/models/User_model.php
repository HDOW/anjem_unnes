<?php
class User_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Fungsi untuk mengambil data 1 user
    public function getUserById($id) {
        $this->db->query("SELECT * FROM tb_user WHERE id_user = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    // Fungsi untuk update profil user
    public function updateDataProfil($data) {
        // Jika user upload foto baru
        if($data['foto_profil'] != '') {
            $this->db->query("UPDATE tb_user SET nama = :nama, foto_profil = :foto_profil WHERE id_user = :id_user");
            $this->db->bind('foto_profil', $data['foto_profil']);
        } else {
            // Jika tidak upload foto baru, hanya update nama
            $this->db->query("UPDATE tb_user SET nama = :nama WHERE id_user = :id_user");
        }
        
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('id_user', $data['id_user']);
        $this->db->execute();

        return $this->db->rowCount();
    }
}