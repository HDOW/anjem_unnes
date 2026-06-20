<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anjem UNNES</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/style.css">
</head>
<body>

    <?php
        // Logika untuk menentukan rute tombol Menu
        $linkMenu = '#';
        $aksiKlik = 'onclick="alert(\'login terlebih dahulu\'); return false;"';

        // Cek apakah user sudah login dan memiliki role
        if (isset($_SESSION['id_user']) && isset($_SESSION['role'])) {
            $aksiKlik = ''; // Hapus pop-up karena sudah login
            
            // Arahkan ke dashboard masing-masing sesuai tipe akun
            if ($_SESSION['role'] == 'admin') {
                $linkMenu = BASEURL . '/admin';
            } elseif ($_SESSION['role'] == 'driver') {
                $linkMenu = BASEURL . '/driver';
            } else {
                $linkMenu = BASEURL . '/user'; 
            }
        }
    ?>

   <nav class="navbar">
        <a href="<?= BASEURL; ?>" style="text-decoration: none; color: white;">
            <h2 style="margin: 0;">Anjem UNNES</h2>
        </a>
        
        <div style="display: flex; gap: 20px; align-items: center;">
            
            <a href="<?= $linkMenu; ?>" <?= $aksiKlik; ?> style="color: white; text-decoration: none; font-weight: bold; font-size: 16px; cursor: pointer;">
                Menu
            </a>

            <?php if( isset($_SESSION['id_user']) ) : ?>
                <a href="<?= BASEURL; ?>/auth/logout" class="btn-utama" style="background-color: var(--merah-alert); color: white;">Logout (<?= $_SESSION['nama']; ?>)</a>
            <?php else : ?>
                <a href="<?= BASEURL; ?>/auth" class="btn-utama">Login / Sign In</a>
            <?php endif; ?>
            
        </div>
    </nav>