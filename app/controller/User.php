<?php
class User extends Controller {
    public function index() {
        // Ambil driver yang aktif dari Driver_model (Hanya untuk muatan pertama)
        $data['drivers'] = $this->model('Driver_model')->getReadyDriver();

        $this->view('templates/header');
        $this->view('user/index', $data);
        $this->view('templates/footer');
    }

    // Fungsi ini dipanggil diam-diam oleh JavaScript untuk update list driver
    public function ambilDriverLive() {
        if(isset($_SESSION['id_user'])) {
            // Ambil data driver yang statusnya Ready / Still Deliver
            $drivers = $this->model('Driver_model')->getReadyDriver();
            
            // Ubah menjadi format JSON
            echo json_encode($drivers);
        }
    }
}