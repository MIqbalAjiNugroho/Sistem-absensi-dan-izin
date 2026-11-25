<?php
// Pembuka halaman: <head>, Bootstrap, dan style.css
// Akses: internal
require_once __DIR__ . '/../config/koneksi.php';

$judul_halaman = $judul_halaman ?? 'Beranda';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($judul_halaman) ?> | Sistem Absensi dan Izin</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>/assets/css/style.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <?php if (isset($_SESSION['id_user'])): ?>
<nav class="navbar bg-white border-bottom">
    <div class="container d-flex justify-content-end align-items-center gap-3 small">
        <span class="badge rounded-pill pil-teal px-3 py-2">
            <?= htmlspecialchars($_SESSION['nama'] ?? '') ?> &middot; <?= htmlspecialchars($_SESSION['peran'] ?? '') ?>
        </span>
        <a href="<?= BASE_URL ?>/auth/logout.php" class="btn btn-danger btn-sm fw-semibold">Logout</a>
    </div>
</nav>
<?php endif; ?>
<main class="flex-grow-1">