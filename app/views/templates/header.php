<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anjem UNNES</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/style.css">
</head>
<body>

   <nav class="navbar">
        <h2>Anjem UNNES</h2>
        <div>
            <?php if( isset($_SESSION['id_user']) ) : ?>
                <a href="<?= BASEURL; ?>/auth/logout" class="btn-utama" style="background-color: var(--merah-alert); color: white;">Logout (<?= $_SESSION['nama']; ?>)</a>
            <?php else : ?>
                <a href="<?= BASEURL; ?>/auth" class="btn-utama">Login / Sign In</a>
            <?php endif; ?>
        </div>
    </nav>