<?php
class Driver extends Controller {
    public function index() {
        // 1. Ambil data profil driver
        $data['profil'] = $this->model('Driver_model')->getDriverById($_SESSION['id_user']);
        
        // 2. Ambil data list chat masuk dari Chat_model
        $data['chats'] = $this->model('Chat_model')->getInboxDriver($_SESSION['id_user']);

        $this->view('templates/header');
        $this->view('driver/index', $data);
        $this->view('templates/footer');
    }

    public function gantiStatus() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $status = $_POST['status'];
            $id = $_SESSION['id_user'];
            
            $this->model('Driver_model')->updateStatus($id, $status);
            header('Location: ' . BASEURL . '/driver');
            exit;
        }
    }

    // Fungsi ini dipanggil diam-diam oleh JavaScript untuk mengecek orderan baru
    public function ambilInboxLive() {
        if(isset($_SESSION['id_user']) && $_SESSION['role'] == 'driver') {
            $id_driver = $_SESSION['id_user'];
            // Ambil data dari Chat_model
            $chats = $this->model('Chat_model')->getInboxDriver($id_driver);
            
            // Ubah menjadi format JSON
            echo json_encode($chats);
        }
    }
    // Memanggil halaman form edit profil
    public function edit() {
        // Ambil data lama agar muncul otomatis di kolom input
        $data['profil'] = $this->model('Driver_model')->getDriverById($_SESSION['id_user']);
        
        $this->view('templates/header');
        $this->view('driver/edit', $data); 
        $this->view('templates/footer');
    }

    // Memproses data yang dikirim dari form
    public function updateProfil() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id_user' => $_SESSION['id_user'],
                'nama' => $_POST['nama'],
                'jenis_motor' => $_POST['jenis_motor'],
                'plat_nomor' => $_POST['plat_nomor'],
                'foto_profil' => '' // Default string kosong
            ];

            // Cek apakah driver upload foto baru (Error 4 artinya tidak ada file yang diupload)
            if(isset($_FILES['foto_profil']) && $_FILES['foto_profil']['error'] !== 4) {
                $namaFile = $_FILES['foto_profil']['name'];
                $tmpName = $_FILES['foto_profil']['tmp_name'];
                
                // Ambil ekstensi gambar dan buat nama baru yang unik agar file tidak tertimpa
                $ekstensi = explode('.', $namaFile);
                $ekstensi = strtolower(end($ekstensi));
                $namaFileBaru = uniqid() . '.' . $ekstensi;
                
                // Tentukan lokasi simpan. Pastikan folder assets/img/ ada di project kamu!
                // Catatan: Jika gagal upload, pastikan relative path-nya sesuai dengan letak index.php kamu
                $path_tujuan = 'assets/img/' . $namaFileBaru; 
                
                if(move_uploaded_file($tmpName, $path_tujuan)) {
                    $data['foto_profil'] = $namaFileBaru;
                }
            }

            // Panggil model untuk update database
            $this->model('Driver_model')->updateDataProfil($data);
            
            // Kembalikan driver ke halaman dashboard
            header('Location: ' . BASEURL . '/driver');
            exit;
        }
    }
}