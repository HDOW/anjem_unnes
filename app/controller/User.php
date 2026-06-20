<?php
class User extends Controller {
    public function index() {
        // Ambil data profil user dari model yang baru kita buat
        $data['profil'] = $this->model('User_model')->getUserById($_SESSION['id_user']);
        
        // Ambil driver yang aktif dari Driver_model
        $data['drivers'] = $this->model('Driver_model')->getReadyDriver();

        $this->view('templates/header');
        $this->view('user/index', $data);
        $this->view('templates/footer');
    }

    // Fungsi untuk update list driver (Tidak diubah)
    public function ambilDriverLive() {
        if(isset($_SESSION['id_user'])) {
            $drivers = $this->model('Driver_model')->getReadyDriver();
            echo json_encode($drivers);
        }
    }

    // Fungsi memanggil halaman edit profil
    public function edit() {
        $data['profil'] = $this->model('User_model')->getUserById($_SESSION['id_user']);
        
        $this->view('templates/header');
        $this->view('user/edit', $data); 
        $this->view('templates/footer');
    }

    // Fungsi pemroses form edit profil
    public function updateProfil() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id_user' => $_SESSION['id_user'],
                'nama' => $_POST['nama'],
                'foto_profil' => '' 
            ];

            // Proses upload foto
            if(isset($_FILES['foto_profil']) && $_FILES['foto_profil']['error'] !== 4) {
                $namaFile = $_FILES['foto_profil']['name'];
                $tmpName = $_FILES['foto_profil']['tmp_name'];
                
                $ekstensi = explode('.', $namaFile);
                $ekstensi = strtolower(end($ekstensi));
                $namaFileBaru = uniqid() . '.' . $ekstensi;
                
                $path_tujuan = 'assets/img/' . $namaFileBaru; 
                
                if(move_uploaded_file($tmpName, $path_tujuan)) {
                    $data['foto_profil'] = $namaFileBaru;
                }
            }

            $this->model('User_model')->updateDataProfil($data);
            
            // Perbarui session nama agar langsung berubah di pojok kanan atas navbar (jika ada)
            $_SESSION['nama'] = $_POST['nama'];
            
            header('Location: ' . BASEURL . '/user');
            exit;
        }
    }
}