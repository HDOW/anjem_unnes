<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Wajib diletakkan di baris paling atas sebelum kode lain
if( !session_id() ) session_start();

require_once 'app/init.php';

$app = new App();

// Menyalakan fitur session agar sistem ingat siapa yang sedang login