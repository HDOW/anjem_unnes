<?php
class Chat extends Controller {
    
    // Membuka halaman chat dengan seseorang
    public function index($id_lawan = null) {
        if($id_lawan == null) {
            header('Location: ' . BASEURL);
            exit;
        }

        // TANDAI SUDAH BACA SAAT HALAMAN DIBUKA
        $id_saya = $_SESSION['id_user'];
        $this->model('Chat_model')->tandaiSudahBaca($id_saya, $id_lawan);

        $data['id_lawan'] = $id_lawan;
        $data['nama_lawan'] = $this->model('Chat_model')->getNamaLawan($id_lawan);

        $this->view('templates/header');
        $this->view('chat/index', $data);
    }

    public function ambilPesan($id_lawan) {
        $id_saya = $_SESSION['id_user'];
        
        // TANDAI SUDAH BACA SECARA REAL-TIME SAAT SEDANG CHATTING
        $this->model('Chat_model')->tandaiSudahBaca($id_saya, $id_lawan);
        
        $pesan = $this->model('Chat_model')->getRiwayatChat($id_saya, $id_lawan);
        echo json_encode($pesan);
    }

    // Fungsi ini dipanggil diam-diam oleh JavaScript untuk mengirim pesan
    // Fungsi ini dipanggil untuk mengirim pesan (teks & gambar)
    public function kirim() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $pengirim = $_SESSION['id_user'];
            $penerima = $_POST['id_lawan']; // Memakai id_lawan sesuai kode aslimu
            $pesan = $_POST['pesan'];
            $gambar = NULL; // Nilai bawaan jika user tidak melampirkan gambar

            // LOGIKA UPLOAD GAMBAR
            if (isset($_FILES['gambar']['name']) && $_FILES['gambar']['name'] != '') {
                $namaFile = $_FILES['gambar']['name'];
                $tmpName = $_FILES['gambar']['tmp_name'];
                $error = $_FILES['gambar']['error'];

                if ($error === 0) {
                    // Ambil ekstensi file (jpg, png, jpeg)
                    $ekstensiFile = explode('.', $namaFile);
                    $ekstensiFile = strtolower(end($ekstensiFile));
                    
                    // Buat nama acak agar file tidak tertumpuk jika namanya sama
                    $namaBaru = uniqid() . '.' . $ekstensiFile;
                    
                    // Pindahkan ke folder aslimu
                    move_uploaded_file($tmpName, 'assets/img/chat/' . $namaBaru);
                    
                    $gambar = $namaBaru;
                }
            }

            // Cek agar tidak mengirim pesan kosong (harus ada teks ATAU ada gambar)
            if(!empty($pesan) || $gambar != NULL) {
                // Panggil model dan selipkan variabel $gambar ke dalamnya
                $this->model('Chat_model')->kirimPesan($pengirim, $penerima, $pesan, $gambar);
            }
            
            // Kembalikan otomatis ke layar obrolan semula
            header('Location: ' . BASEURL . '/chat/index/' . $penerima);
            exit;
        }
    }
}