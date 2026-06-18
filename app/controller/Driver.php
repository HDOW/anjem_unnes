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
}