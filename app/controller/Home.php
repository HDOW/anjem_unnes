<?php
class Home extends Controller {
    public function index() {
        // Memanggil rakitan view secara berurutan
        $this->view('templates/header');
        $this->view('home/index');
        $this->view('templates/footer');
    }
    
    public function kirimPesan() {
        if( $this->model('Admin_model')->tambahKritikSaran($_POST) > 0 ) {
            // Jika berhasil, beri pop-up sukses dan kembali ke home
            echo "<script>alert('Terima kasih! Pesan, Kritik, dan Saran Anda berhasil dikirim ke Admin.'); window.location.href='".BASEURL."/home';</script>";
        } else {
            // Jika gagal
            echo "<script>alert('Gagal mengirim pesan. Silakan coba lagi.'); window.location.href='".BASEURL."/home';</script>";
        }
    }
    
}