<?php
// Fungsi bantu yang dipakai di banyak halaman
// Akses: internal

// Amankan teks sebelum ditampilkan di HTML (cegah XSS). Pakai: echo h($teks);
function h($teks)
{
    return htmlspecialchars((string) $teks, ENT_QUOTES, 'UTF-8');
}

// Alamat dashboard sesuai peran
function url_dashboard($peran)
{
    return BASE_URL . ($peran === 'admin' ? '/admin/dashboard.php' : '/karyawan/dashboard.php');
}

// Pindah halaman lalu hentikan skrip
function redirect($url)
{
    header('Location: ' . $url);
    exit;
}

// Daftar fitur per peran: [teks, alamat]. Ditampilkan sebagai kartu di dashboard.
// Mau menambah fitur baru? Cukup tambah satu baris di sini.
function daftar_menu($peran)
{
    if ($peran === 'admin') {
        return [
            ['QR Absen', '/admin/qr.php'],
            ['Data Karyawan', '/admin/karyawan.php'],
            ['Persetujuan Izin', '/admin/izin_persetujuan.php'],
            ['Koreksi Absensi', '/admin/koreksi.php'],
            ['Kalender Libur', '/admin/kalender_libur.php'],
            ['Kategori Izin', '/admin/kategori_izin.php'],
            ['Pengaturan', '/admin/pengaturan.php'],
            ['Rekap (Excel)', '/admin/rekap.php'],
        ];
    }
    if ($peran === 'karyawan') {
        return [
            ['Scan Absen', '/karyawan/scan.php'],
            ['Riwayat Absensi', '/karyawan/riwayat.php'],
            ['Ajukan Izin', '/karyawan/izin_ajukan.php'],
            ['Izin Saya', '/karyawan/izin_saya.php'],
        ];
    }
    return [];
}