<?php
// Penjaga akses: cek sesi dan peran, tolak jika tidak sesuai (dipanggil di awal tiap halaman)
// Akses: internal
//
// Cara pakai (taruh di baris paling atas halaman, SEBELUM include header.php):
//   require __DIR__ . '/../includes/auth_guard.php';
//   wajib_login('admin');       // hanya admin
//   wajib_login('karyawan');    // hanya karyawan
//   wajib_login();              // semua yang sudah login

require_once __DIR__ . '/../config/koneksi.php';   // memulai sesi + BASE_URL
require_once __DIR__ . '/fungsi.php';

function wajib_login($peran = null)
{
    // 1. Belum login -> ke halaman login
    if (!isset($_SESSION['id_user'])) {
        redirect(BASE_URL . '/auth/login.php');
    }

    // 2. Login pertama -> wajib ganti password dulu (kecuali sedang di halaman ganti password)
    if (!empty($_SESSION['wajib_ganti']) && basename($_SERVER['SCRIPT_NAME']) !== 'ganti_password.php') {
        redirect(BASE_URL . '/auth/ganti_password.php');
    }

    // 3. Peran tidak sesuai -> tolak
    if ($peran !== null && $_SESSION['peran'] !== $peran) {
        http_response_code(403);
        exit('Akses ditolak. Halaman ini bukan untuk peran Anda.');
    }
}
