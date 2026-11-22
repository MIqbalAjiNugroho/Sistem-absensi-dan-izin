<?php
// Beranda publik: hanya tombol Login. Kalau sudah login, langsung ke dashboard.
require __DIR__ . '/config/koneksi.php';
require __DIR__ . '/includes/fungsi.php';

if (isset($_SESSION['id_user'])) {
    redirect(url_dashboard($_SESSION['peran']));
}

$judul_halaman = 'Beranda';
include __DIR__ . '/includes/header.php';
?>
<section class="hero">
    <h1>Sistem Absensi dan Izin Karyawan</h1>
    <a class="tombol" href="<?= BASE_URL ?>/auth/login.php">Login</a>
    <p class="keterangan">Absensi dengan scan QR dan validasi lokasi, serta pengajuan izin.</p>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>