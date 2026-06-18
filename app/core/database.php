<?php
class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db_name = DB_NAME;

    private $dbh; // Database Handler
    private $stmt; // Statement

    public function __construct() {
        // Konfigurasi koneksi database
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;
        $option = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    // Fungsi untuk menyiapkan perintah SQL (SELECT, INSERT, UPDATE, dll)
    public function query($query) {
        $this->stmt = $this->dbh->prepare($query);
    }

    // Fungsi untuk memasukkan data variabel ke dalam SQL (agar aman dari hacker)
    public function bind($param, $value, $type = null) {
        if(is_null($type)) {
            switch(true) {
                case is_int($value): $type = PDO::PARAM_INT; break;
                case is_bool($value): $type = PDO::PARAM_BOOL; break;
                case is_null($value): $type = PDO::PARAM_NULL; break;
                default: $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Mengeksekusi SQL
    public function execute() {
        $this->stmt->execute();
    }

    // Mengambil satu baris data
    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tambahkan ini di bawah fungsi single() di file Database.php kamu
    public function all() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
// Fungsi untuk mengambil ID dari data yang baru saja dimasukkan (berguna untuk Inheritance)
    public function lastInsertId() {
        return $this->dbh->lastInsertId();
    }
    // Menghitung berapa baris data yang berhasil diubah/ditambah
    public function rowCount() {
        return $this->stmt->rowCount();
    }
}
