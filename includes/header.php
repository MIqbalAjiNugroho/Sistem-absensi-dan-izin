<?php ?>
<?php
// Pembuka halaman: <head>, CSS, dan bar atas (hanya tampil setelah login)
// Akses: internal
//
// Cara pakai:
//   $judul_halaman = 'Dashboard';        // opsional
//   include __DIR__ . '/../includes/header.php';
//   ... isi halaman ...
//   include __DIR__ . '/../includes/footer.php';

require_once __DIR__ . '/../config/koneksi.php';
require_once __DIR__ . '/fungsi.php';

$judul_halaman = $judul_halaman ?? 'Beranda';

// Dianggap login hanya jika id_user ada (bukan sekadar peran)
$sudah_login = isset($_SESSION['id_user']);
$peran = $sudah_login ? ($_SESSION['peran'] ?? null) : null;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= h($judul_halaman) ?> | Sistem Absensi dan Izin</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>
<?php if ($peran): ?>
<header class="header">
    <nav class="menu">
        <a href="<?= h(url_dashboard($peran)) ?>">Dashboard</a>
        <span class="user"><?= h($_SESSION['nama'] ?? '') ?> (<?= h($peran) ?>)</span>
        <a href="<?= BASE_URL ?>/auth/ganti_password.php">Ganti Password</a>
        <a href="<?= BASE_URL ?>/auth/logout.php" class="keluar">Logout</a>
    </nav>
</header>
<?php endif; ?>
<main class="konten">