<?php
class Admin extends Controller {
    public function index() {
        // Halaman awal saat baru dibuka
        $data['users'] = $this->model('Admin_model')->getAllUser();
        $data['drivers'] = $this->model('Admin_model')->getAllDriver();
        
        // FUNGSI BARU: Menarik data pesan masuk dari tabel kritik_saran
        $data['kritik'] = $this->model('Admin_model')->getAllKritikSaran();

        $this->view('templates/header');
        $this->view('admin/index', $data);
        $this->view('templates/footer');
    }

    public function hapus($id) {
        if($this->model('Admin_model')->hapusAkun($id) > 0) {
            echo "<script>alert('Akun berhasil dihapus!'); window.location.href='" . BASEURL . "/admin';</script>";
        }
    }

    // FUNGSI BARU: Dipanggil secara diam-diam oleh JavaScript untuk update live
    public function ambilDataLive() {
        // Opsional: Pastikan yang mengakses ini benar-benar admin
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
            
            // Tarik data dari model
            $users = $this->model('Admin_model')->getAllUser();
            $drivers = $this->model('Admin_model')->getAllDriver();
            $kritik = $this->model('Admin_model')->getAllKritikSaran(); // Menambahkan kritik ke fungsi live

            // Gabungkan menjadi satu paket array
            $paket_data = [
                'users' => $users,
                'drivers' => $drivers,
                'kritik' => $kritik
            ];

            // Kirim ke JavaScript dalam bahasa JSON
            echo json_encode($paket_data);
        }
    }
}
?>