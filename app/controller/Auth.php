<?php
class Auth extends Controller {
    
    // 1. Menampilkan Halaman Login & Sign In
    public function index() {
        $this->view('templates/header');
        $this->view('auth/index');
        $this->view('templates/footer');
    }

    // 2. Fungsi Pendaftaran User (Driver sudah ditiadakan di form sesuai request sebelumnya)
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $role_daftar = $_POST['role_daftar']; 
            
            // 1. JALUR UNTUK MAHASISWA / USER
            if ($role_daftar == 'user') {
                if ($this->model('Auth_model')->tambahUser($_POST) > 0) {
                    echo "<script>alert('Pendaftaran Berhasil! Silakan Login.'); window.location.href='" . BASEURL . "/auth';</script>";
                } else {
                    echo "<script>alert('Pendaftaran Gagal!'); window.location.href='" . BASEURL . "/auth';</script>";
                }
            } 
            
            // 2. JALUR UNTUK DRIVER (Tambahkan Else If ini!)
            else if ($role_daftar == 'driver') {
                // Karena kita belum membuat sistem upload file, kita beri nama default dulu
                $nama_foto = 'default.jpg'; 

                // Kirim 2 data sekaligus ke model: $_POST dan $nama_foto
                if ($this->model('Auth_model')->tambahDriver($_POST, $nama_foto) > 0) {
                    echo "<script>alert('Pendaftaran Driver Berhasil! Silakan Login.'); window.location.href='" . BASEURL . "/auth';</script>";
                } else {
                    echo "<script>alert('Pendaftaran Driver Gagal!'); window.location.href='" . BASEURL . "/auth';</script>";
                }
            }
            
            exit; // Pastikan ada exit agar layar putih tidak muncul lagi
        }
    }

    // 3. FUNGSI LOGIN & REDIRECT OTOMATIS
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $no_hp = $_POST['no_hp']; 
            $password = $_POST['password'];

            // Cek kecocokan data ke Model (Database)
            $data_login = $this->model('Auth_model')->cekLogin($no_hp, $password);

            // Jika username dan password benar
            if ($data_login) {
                
                // Simpan identitas ke dalam Session
                $_SESSION['role'] = $data_login['role'];
                $_SESSION['nama'] = $data_login['nama'];
                $_SESSION['id_user'] = $data_login['id_user']; 
                
                // === LOGIKA PINDAH HALAMAN (REDIRECT) ===
                if ($data_login['role'] == 'admin') {
                    header('Location: ' . BASEURL . '/admin');
                } else if ($data_login['role'] == 'driver') {
                    header('Location: ' . BASEURL . '/driver');
                } else {
                    header('Location: ' . BASEURL . '/user');
                }
                
                exit; // Wajib diakhiri dengan exit setelah header location

            } else {
                // Jika salah password / username tidak terdaftar
                echo "<script>alert('Login Gagal! Username/No HP atau Password salah.'); window.location.href='" . BASEURL . "/auth';</script>";
            }
        }
    }

    // FUNGSI UNTUK KELUAR (LOGOUT)
    // FUNGSI UNTUK KELUAR (LOGOUT)
   // FUNGSI UNTUK KELUAR (LOGOUT)
    public function logout() {
        // 1. Cek apakah yang sedang login dan menekan tombol logout ini adalah seorang driver
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'driver') {
            
            $id_driver = $_SESSION['id_user'];

            // 2. Panggil Driver_model untuk mengubah statusnya menjadi 'Off'
            $this->model('Driver_model')->updateStatus($id_driver, 'Off');

            // 3. Panggil Chat_model untuk menyapu bersih riwayat chat driver ini
            $this->model('Chat_model')->hapusRiwayatChatDriver($id_driver);
        }

        // 4. Hapus semua data memori login (Session)
        session_unset();
        session_destroy();
        
        // 5. Kembalikan ke halaman utama (Home)
        header('Location: ' . BASEURL);
        exit;
    }
}