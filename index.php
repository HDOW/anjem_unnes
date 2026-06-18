<?php
    
// Wajib diletakkan di baris paling atas sebelum kode lain
if( !session_id() ) session_start();

require_once 'app/init.php';

$app = new App();

// Menyalakan fitur session agar sistem ingat siapa yang sedang login