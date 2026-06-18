<?php
class App {
    protected $controller = 'Home'; // Jika URL kosong, arahkan ke controller Home
    protected $method = 'index';    // Method default
    protected $params = [];         // Parameter jika ada

    public function __construct() {
        $url = $this->parseURL();

        // 1. Mencari File Controller
        if(isset($url[0]) && file_exists('app/controller/' . ucfirst($url[0]) . '.php')) {
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        }
        require_once 'app/controller/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // 2. Mencari Method (Fungsi di dalam Controller)
        if(isset($url[1])) {
            if(method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // 3. Mengambil Parameter (Data tambahan dari URL)
        if(!empty($url)) {
            $this->params = array_values($url);
        }

        // 4. Jalankan Controller dan Method-nya
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL() {
        if(isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}