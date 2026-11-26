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
<div class="container text-center py-5">
    <div class="bg-beranda mb-4">
        <h1 class="display-5 fw-bolder mb-4">Sistem Absensi dan Izin Karyawan</h1>
        <a class="btn btn-light btn-lg px-5 rounded-pill fw-bold" href="<?= BASE_URL ?>/auth/login.php">Login</a>
        <p class="text-white mt-4">Absensi dengan scan QR dan validasi lokasi, serta pengajuan izin.</p>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>