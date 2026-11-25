<?php
require __DIR__ . '/../includes/auth_guard.php';
wajib_login('admin');

$judul_halaman = 'Dashboard Admin';
include __DIR__ . '/../includes/header.php';
?>
<h1>Dashboard Admin</h1>
<p>Selamat datang, <?= h($_SESSION['nama']) ?>.</p>

<div class="grid-menu">
    <?php foreach (daftar_menu('admin') as $m): ?>
        <a class="kartu-menu" href="<?= BASE_URL . $m[1] ?>"><?= h($m[0]) ?></a>
    <?php endforeach; ?>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>