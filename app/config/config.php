<?php
// Base URL websitemu
define('BASEURL', 'https://anjemunnes.my.id/');

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || ($_SERVER['SERVER_PORT'] ?? '') == 443 ? 'https' : 'http';
$basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
define('BASEURL', $protocol . '://' . $_SERVER['HTTP_HOST'] . ($basePath === '' ? '' : $basePath));

// Data untuk menyambung ke database phpMyAdmin
define('DB_HOST', 'localhost');
define('DB_USER', 'anjemunn_zuto');
define('DB_PASS', "###ZUTOzuto111");
define('DB_NAME', 'anjemunn_anjem_unnes'); // Pastikan namanya sama dengan yang kamu buat tadi

