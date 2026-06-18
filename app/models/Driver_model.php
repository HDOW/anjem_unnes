<?php
class Driver_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Mengambil info lengkap 1 driver berdasarkan id_user sesionnya
    public function getDriverById($id) {
        $this->db->query("SELECT tb_user.*, tb_driver.* FROM tb_user 
                          JOIN tb_driver ON tb_user.id_user = tb_driver.id_user 
                          WHERE tb_user.id_user = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    // Mengubah status Ready / Off / Still Deliver
    public function updateStatus($id, $status) {
        $this->db->query("UPDATE tb_driver SET status = :status WHERE id_user = :id");
        $this->db->bind('id', $id);
        $this->db->bind('status', $status);
        $this->db->execute();
        return $this->db->rowCount();
    }

    // Mengambil semua driver yang statusnya Ready atau Still Deliver (Untuk dipantau User)
    public function getReadyDriver() {
        $this->db->query("SELECT tb_user.nama, tb_user.no_hp, tb_driver.* FROM tb_user 
                          JOIN tb_driver ON tb_user.id_user = tb_driver.id_user 
                          WHERE tb_driver.status IN ('Ready', 'Still Deliver')");
        return $this->db->all();
    }
}