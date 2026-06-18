<?php
class Home extends Controller {
    public function index() {
        // Memanggil rakitan view secara berurutan
        $this->view('templates/header');
        $this->view('home/index');
        $this->view('templates/footer');
    }
}